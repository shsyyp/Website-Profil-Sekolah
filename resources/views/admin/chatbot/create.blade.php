@extends('layouts.admin')

@section('title', 'Tambah Chatbot | Admin SMAN Pintar')

@section('content')
<div class="max-w-4xl mx-auto space-y-8">
    <div class="mb-8">
        <h2 class="text-3xl font-extrabold text-on-surface tracking-tight">Tambah Pengetahuan Bot</h2>
    </div>

    <div class="bg-surface-container-lowest rounded-2xl shadow-sm p-8">
        <form action="{{ route('chatbot.store') }}" method="POST" class="space-y-6">
            @csrf

            <div>
                <label class="text-xs font-bold uppercase text-tertiary block mb-2">Kategori</label>
                <select name="kategori"
                    class="w-full bg-surface-container border-none rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-primary"
                    required>
                    <option value="Profil">Profil</option>
                    <option value="Fasilitas">Fasilitas</option>
                    <option value="PMB">PMB</option>
                    <option value="Alumni">Alumni</option>
                    <option value="Umum">Umum</option>
                </select>
                @error('kategori') <span class="text-error text-xs">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="text-xs font-bold uppercase text-tertiary block mb-2">Pertanyaan (Keywords)</label>
                <input name="pertanyaan" type="text" value="{{ old('pertanyaan') }}"
                    class="w-full bg-surface-container border-none rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-primary"
                    placeholder="Contoh: Bagaimana cara mendaftar?" required>
                @error('pertanyaan') <span class="text-error text-xs">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="text-xs font-bold uppercase text-tertiary block mb-2">Jawaban Bot</label>
                <textarea name="jawaban" rows="5"
                    class="w-full bg-surface-container border-none rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-primary"
                    required>{{ old('jawaban') }}</textarea>
                @error('jawaban') <span class="text-error text-xs">{{ $message }}</span> @enderror
            </div>

            <div class="pt-6 flex gap-3 border-t border-surface-container">
                <a href="{{ route('chatbot.index') }}"
                    class="px-8 py-3 border-2 border-outline-variant/30 text-on-surface font-bold rounded-xl text-sm hover:bg-surface-container transition-colors">Batal</a>
                <button type="submit"
                    class="px-8 py-3 bg-primary text-white font-bold rounded-xl text-sm shadow-lg shadow-primary/20 hover:scale-[1.02] transition-transform">Simpan
                    Data</button>
            </div>
        </form>
    </div>
</div>
@endsection