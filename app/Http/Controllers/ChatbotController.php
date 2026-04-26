<?php

namespace App\Http\Controllers;

use App\Models\Chatbot;
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
            'kategori'   => 'required',
            'pertanyaan' => 'required',
            'jawaban'    => 'required'
        ]);

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
            'kategori'   => 'required',
            'pertanyaan' => 'required',
            'jawaban'    => 'required'
        ]);

        $chatbot->update($data);
        return redirect()->route('chatbot.index')->with('success', 'Pertanyaan berhasil diupdate');
    }

    public function destroy(Chatbot $chatbot)
    {
        $chatbot->delete();
        return back()->with('success', 'Pertanyaan berhasil dihapus');
    }
}