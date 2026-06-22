<?php

namespace App\Services;

use App\Models\Chatbot;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GeminiChatbotService
{
    public const FALLBACK_RESPONSE = 'Maaf, saya belum menemukan informasi yang sesuai dengan pertanyaan Anda. Untuk mendapatkan informasi lebih lanjut, silakan menghubungi Humas SMAN Pintar Provinsi Riau melalui telepon (0760) 561925, email smanpintar@yahoo.co.id, atau media sosial resmi sekolah.';

    public function answer(string $question): string
    {
        $knowledge = $this->knowledgeBase();
        $apiKey = config('services.gemini.api_key');

        if (! $apiKey) {
            return $this->databaseOrFallback($question, $knowledge);
        }

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

                return $this->databaseOrFallback($question, $knowledge);
            }

            $answer = trim((string) data_get($response->json(), 'candidates.0.content.parts.0.text'));

            return $this->isUsableAiAnswer($answer)
                ? $answer
                : $this->databaseOrFallback($question, $knowledge);
        } catch (\Throwable $exception) {
            Log::warning('Gemini chatbot exception', [
                'message' => $this->sanitizeError($exception->getMessage()),
            ]);

            return $this->databaseOrFallback($question, $knowledge);
        }
    }

    private function databaseOrFallback(string $question, Collection $knowledge): string
    {
        return $this->databaseAnswer($question, $knowledge)
            ?: self::FALLBACK_RESPONSE;
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
- Jika informasi tidak ada atau tidak cukup jelas di knowledge base, jawab persis dengan: __NO_ANSWER__
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

    private function databaseAnswer(string $question, Collection $knowledge): ?string
    {
        $normalized = mb_strtolower($question);
        $questionTokens = $this->tokens($normalized);

        return $knowledge
            ->first(function (Chatbot $item) use ($normalized) {
                $storedQuestion = mb_strtolower($item->pertanyaan);

                return $storedQuestion === $normalized
                    || (mb_strlen($normalized) >= 4 && str_contains($storedQuestion, $normalized))
                    || (mb_strlen($storedQuestion) >= 4 && str_contains($normalized, $storedQuestion));
            })
            ?->jawaban
            ?? $knowledge
                ->sortByDesc(function (Chatbot $item) use ($questionTokens) {
                    return $this->tokenScore($questionTokens, $this->tokens($item->pertanyaan));
                })
                ->first(function (Chatbot $item) use ($questionTokens) {
                    return $this->tokenScore($questionTokens, $this->tokens($item->pertanyaan)) >= 1;
                })
            ?->jawaban;
    }

    private function isUsableAiAnswer(string $answer): bool
    {
        if ($answer === '' || str_contains($answer, '__NO_ANSWER__')) {
            return false;
        }

        $normalized = mb_strtolower($answer);

        return ! str_contains($normalized, 'informasi tersebut belum tersedia')
            && ! str_contains($normalized, 'informasi belum tersedia')
            && ! str_contains($normalized, 'tidak menemukan jawaban');
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

        $stopWords = [
            'adalah', 'apakah', 'bagaimana', 'dengan', 'informasi', 'lainnya',
            'pintar', 'provinsi', 'sekolah', 'sman', 'tentang', 'untuk', 'yang',
        ];

        return array_values(array_unique(array_filter(
            $tokens,
            fn (string $token) => mb_strlen($token) >= 4 && ! in_array($token, $stopWords, true)
        )));
    }

    private function sanitizeError(string $message): string
    {
        return preg_replace('/key=[^&\s]+/', 'key=[hidden]', $message);
    }
}
