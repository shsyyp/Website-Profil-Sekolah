@extends('layouts.admin')

@section('title', 'Edit Chatbot | Admin SMAN Pintar')

@section('content')
<div class="max-w-7xl mx-auto space-y-8">
    <div>
        <h2 class="text-3xl font-extrabold text-primary tracking-tight font-headline">Edit Chatbot</h2>
    </div>

    <div class="bg-surface-container-lowest rounded-2xl shadow-sm p-8">
        <form action="{{ route('chatbot.update', $chatbot->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label class="text-xs font-bold uppercase text-tertiary block mb-2">Pertanyaan</label>
                <input name="pertanyaan" type="text" value="{{ old('pertanyaan', $chatbot->pertanyaan) }}"
                    class="w-full bg-surface-container border-none rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-primary"
                    placeholder="Contoh: Bagaimana cara mendaftar?" required>
                @error('pertanyaan') <span class="text-error text-xs">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="text-xs font-bold uppercase text-tertiary block mb-2">Jawaban Bot</label>
                <textarea name="jawaban" rows="5"
                    class="w-full bg-surface-container border-none rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-primary"
                    required>{{ old('jawaban', $chatbot->jawaban) }}</textarea>
                @error('jawaban') <span class="text-error text-xs">{{ $message }}</span> @enderror
            </div>

            <div class="pt-6 flex gap-3 border-t border-surface-container">
                <a href="{{ route('chatbot.index') }}" class="btn-cancel">
                    Batal
                </a>
                <button type="submit"
                    class="px-8 py-3 bg-primary text-white font-bold rounded-xl text-sm shadow-lg shadow-primary/20 hover:scale-[1.02] transition-transform">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
