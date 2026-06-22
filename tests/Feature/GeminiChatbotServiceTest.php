<?php

namespace Tests\Feature;

use App\Models\Chatbot;
use App\Services\GeminiChatbotService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class GeminiChatbotServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_uses_a_matching_database_answer_without_ai(): void
    {
        Chatbot::create([
            'kategori' => 'Umum',
            'pertanyaan' => 'Kapan pendaftaran dibuka?',
            'jawaban' => 'Pendaftaran dibuka pada bulan Maret.',
        ]);
        config(['services.gemini.api_key' => null]);

        $answer = app(GeminiChatbotService::class)->answer('Kapan pendaftaran dibuka?');

        $this->assertSame('Pendaftaran dibuka pada bulan Maret.', $answer);
    }

    public function test_it_returns_the_humas_fallback_when_no_answer_is_available(): void
    {
        config(['services.gemini.api_key' => null]);

        $answer = app(GeminiChatbotService::class)->answer('Pertanyaan yang tidak tersedia');

        $this->assertSame(GeminiChatbotService::FALLBACK_RESPONSE, $answer);
    }

    public function test_it_hides_ai_no_answer_responses_behind_the_humas_fallback(): void
    {
        config(['services.gemini.api_key' => 'test-key']);
        Http::fake([
            '*' => Http::response([
                'candidates' => [[
                    'content' => ['parts' => [['text' => '__NO_ANSWER__']]],
                ]],
            ]),
        ]);

        $answer = app(GeminiChatbotService::class)->answer('Pertanyaan yang tidak tersedia');

        $this->assertSame(GeminiChatbotService::FALLBACK_RESPONSE, $answer);
    }

    public function test_it_prioritizes_ai_over_a_matching_database_answer(): void
    {
        Chatbot::create([
            'kategori' => 'Umum',
            'pertanyaan' => 'Kapan pendaftaran dibuka?',
            'jawaban' => 'Jawaban dari database.',
        ]);
        config(['services.gemini.api_key' => 'test-key']);
        Http::fake([
            '*' => Http::response([
                'candidates' => [[
                    'content' => ['parts' => [['text' => 'Jawaban dari AI.']]],
                ]],
            ]),
        ]);

        $answer = app(GeminiChatbotService::class)->answer('Kapan pendaftaran dibuka?');

        $this->assertSame('Jawaban dari AI.', $answer);
    }

    public function test_it_uses_the_database_when_ai_has_no_answer(): void
    {
        Chatbot::create([
            'kategori' => 'Umum',
            'pertanyaan' => 'Kapan pendaftaran dibuka?',
            'jawaban' => 'Jawaban dari database.',
        ]);
        config(['services.gemini.api_key' => 'test-key']);
        Http::fake([
            '*' => Http::response([
                'candidates' => [[
                    'content' => ['parts' => [['text' => '__NO_ANSWER__']]],
                ]],
            ]),
        ]);

        $answer = app(GeminiChatbotService::class)->answer('Kapan pendaftaran dibuka?');

        $this->assertSame('Jawaban dari database.', $answer);
    }
}
