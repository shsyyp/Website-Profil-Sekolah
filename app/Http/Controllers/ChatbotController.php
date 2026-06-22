<?php

namespace App\Http\Controllers;

use App\Models\Chatbot;
use App\Services\GeminiChatbotService;
use Illuminate\Http\Request;

class ChatbotController extends Controller
{
    public function index()
    {
        $chatbots = Chatbot::latest()->paginate(10);
        return view('admin.chatbot.index', compact('chatbots'));
    }

    public function create()
    {
        return view('admin.chatbot.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'pertanyaan' => ['required', 'string', 'max:500'],
            'jawaban' => ['required', 'string'],
        ], [
            'pertanyaan.required' => 'Pertanyaan wajib diisi.',
            'jawaban.required' => 'Jawaban wajib diisi.',
        ]);
        $data['kategori'] = 'Umum';

        Chatbot::create($data);
        return redirect()->route('chatbot.index')->with('success', 'Pertanyaan berhasil ditambahkan');
    }

    public function edit(Chatbot $chatbot)
    {
        return view('admin.chatbot.edit', compact('chatbot'));
    }

    public function update(Request $request, Chatbot $chatbot)
    {
        $data = $request->validate([
            'pertanyaan' => ['required', 'string', 'max:500'],
            'jawaban' => ['required', 'string'],
        ], [
            'pertanyaan.required' => 'Pertanyaan wajib diisi.',
            'jawaban.required' => 'Jawaban wajib diisi.',
        ]);
        $data['kategori'] = $chatbot->kategori ?: 'Umum';

        $chatbot->update($data);
        return redirect()->route('chatbot.index')->with('success', 'Pertanyaan berhasil diupdate');
    }

    public function destroy(Chatbot $chatbot)
    {
        $chatbot->delete();
        return back()->with('success', 'Pertanyaan berhasil dihapus');
    }

    public function ask(Request $request, GeminiChatbotService $chatbot)
    {
        $data = $request->validate([
            'question' => ['required', 'string', 'max:500'],
        ]);

        $answer = $chatbot->answer($data['question']);

        return response()->json([
            'answer' => $answer,
            'fallback' => $answer === GeminiChatbotService::FALLBACK_RESPONSE,
        ]);
    }
}
