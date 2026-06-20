<?php

namespace App\Services;

use App\Models\Chatbot;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GeminiChatbotService
{
    public function answer(string $question): ?string
    {
        $apiKey = config('services.gemini.api_key');

        if (! $apiKey) {
            return $this->fallbackAnswer($question);
        }

        $knowledge = $this->knowledgeBase();

        try {
            $response = Http::timeout(20)
                ->acceptJson()
                ->post($this->endpoint($apiKey), [
                    'contents' => [
                        [
                            'role' => 'user',
                            'parts' => [
                                ['text' => $this->prompt($question, $knowledge)],
                            ],
                        ],
                    ],
                    'generationConfig' => [
                        'temperature' => 0.3,
                        'maxOutputTokens' => 280,
                    ],
                ]);

            if (! $response->successful()) {
                Log::warning('Gemini chatbot request failed', [
                    'status' => $response->status(),
                    'message' => data_get($response->json(), 'error.message'),
                ]);

                return $this->fallbackAnswer($question);
            }

            return data_get($response->json(), 'candidates.0.content.parts.0.text')
                ?: $this->fallbackAnswer($question);
        } catch (\Throwable $exception) {
            Log::warning('Gemini chatbot exception', [
                'message' => $this->sanitizeError($exception->getMessage()),
            ]);

            return $this->fallbackAnswer($question);
        }
    }

    private function endpoint(string $apiKey): string
    {
        $model = config('services.gemini.model', 'gemini-3.1-flash-lite');

        return "https://generativelanguage.googleapis.com/v1beta/models/{$model}:generateContent?key={$apiKey}";
    }

    private function prompt(string $question, Collection $knowledge): string
    {
        $items = $knowledge
            ->map(fn (Chatbot $item, int $index) => sprintf(
                "%d. Pertanyaan: %s\nJawaban: %s",
                $index + 1,
                $item->pertanyaan,
                $item->jawaban
            ))
            ->implode("\n\n");

        return <<<PROMPT
Kamu adalah Pintar Assistant, chatbot resmi website SMAN Pintar Provinsi Riau.

Aturan:
- Jawab dalam Bahasa Indonesia yang sopan, singkat, dan mudah dipahami.
- Jawab hanya berdasarkan knowledge base di bawah.
- Jika informasi tidak ada di knowledge base, katakan bahwa informasi tersebut belum tersedia dan sarankan menghubungi Humas.
- Jangan mengarang tanggal, biaya, link, syarat, atau kebijakan.
- Maksimal 3 kalimat.

Knowledge base:
{$items}

Pertanyaan pengguna:
{$question}
PROMPT;
    }

    private function knowledgeBase(): Collection
    {
        return Chatbot::latest()->limit(30)->get(['pertanyaan', 'jawaban']);
    }

    private function fallbackAnswer(string $question): ?string
    {
        $normalized = mb_strtolower($question);
        $questionTokens = $this->tokens($normalized);

        return $this->knowledgeBase()
            ->first(function (Chatbot $item) use ($normalized) {
                $storedQuestion = mb_strtolower($item->pertanyaan);

                return str_contains($storedQuestion, $normalized)
                    || str_contains($normalized, $storedQuestion);
            })
            ?->jawaban
            ?? $this->knowledgeBase()
                ->sortByDesc(function (Chatbot $item) use ($questionTokens) {
                    return $this->tokenScore($questionTokens, $this->tokens($item->pertanyaan));
                })
                ->first(function (Chatbot $item) use ($questionTokens) {
                    return $this->tokenScore($questionTokens, $this->tokens($item->pertanyaan)) >= 1;
                })
            ?->jawaban;
    }

    private function tokenScore(array $questionTokens, array $storedTokens): int
    {
        return count(array_intersect($questionTokens, $storedTokens));
    }

    private function tokens(string $text): array
    {
        $normalized = str_replace(
            ['daftar', 'mendaftar', 'pendaftaran', 'mulai'],
            ['pendaftaran', 'pendaftaran', 'pendaftaran', 'dibuka'],
            mb_strtolower($text)
        );

        $tokens = preg_split('/[^\pL\pN]+/u', $normalized, -1, PREG_SPLIT_NO_EMPTY);

        return array_values(array_unique(array_filter($tokens, fn (string $token) => mb_strlen($token) >= 4)));
    }

    private function sanitizeError(string $message): string
    {
        return preg_replace('/key=[^&\s]+/', 'key=[hidden]', $message);
    }
}
