@extends('layouts.admin')

@section('title', 'Tambah Berita | Admin SMAN Pintar')

@section('content')

<section class="mb-10">
    <div class="space-y-1">
        <h2 class="text-4xl font-extrabold text-primary tracking-tight font-headline">Tambah Berita</h2>
        <p class="text-on-surface-variant text-lg">Buat artikel baru untuk dipublikasikan</p>
    </div>
</section>

<div class="bg-surface-container-lowest rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] p-8 max-w-4xl">

    {{-- Form Tambah --}}
    <form action="{{ route('berita.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div>
            <label class="block text-sm font-bold text-on-surface mb-2">Judul Berita</label>
            <input type="text" name="judul" value="{{ old('judul') }}"
                class="w-full bg-surface-container-high border-none rounded-xl py-3 px-4 focus:ring-2 focus:ring-primary/20"
                placeholder="Masukkan judul..." required>
            @error('judul') <span class="text-error text-xs mt-1">{{ $message }}</span> @enderror
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-bold text-on-surface mb-2">Kategori</label>
                <select name="kategori"
                    class="w-full bg-surface-container-high border-none rounded-xl py-3 px-4 focus:ring-2 focus:ring-primary/20"
                    required>
                    <option value="Akademik">Akademik</option>
                    <option value="Prestasi">Prestasi</option>
                    <option value="Kegiatan">Kegiatan</option>
                    <option value="Pengumuman">Pengumuman</option>
                </select>
                @error('kategori') <span class="text-error text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-bold text-on-surface mb-2">Tanggal Publish</label>
                <input type="date" name="tanggal" value="{{ old('tanggal') ?? date('Y-m-d') }}"
                    class="w-full bg-surface-container-high border-none rounded-xl py-3 px-4 focus:ring-2 focus:ring-primary/20"
                    required>
                @error('tanggal') <span class="text-error text-xs mt-1">{{ $message }}</span> @enderror
            </div>
        </div>

        <div>
            <label class="block text-sm font-bold text-on-surface mb-2">Thumbnail/Gambar</label>
            <input type="file" name="gambar"
                class="w-full bg-surface-container-high border-none rounded-xl py-3 px-4 focus:ring-2 focus:ring-primary/20"
                accept="image/*">
            @error('gambar') <span class="text-error text-xs mt-1">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-bold text-on-surface mb-2">Isi Berita</label>
            <textarea name="isi" rows="6"
                class="w-full bg-surface-container-high border-none rounded-xl py-3 px-4 focus:ring-2 focus:ring-primary/20"
                placeholder="Tulis konten berita di sini..." required>{{ old('isi') }}</textarea>
            @error('isi') <span class="text-error text-xs mt-1">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-bold text-on-surface mb-2">Status Publikasi</label>
            <div class="flex gap-6">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="radio" name="status" value="publish" checked class="text-primary focus:ring-primary">
                    <span>Publish</span>
                </label>
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="radio" name="status" value="draft"
                        class="text-tertiary-container focus:ring-tertiary-container">
                    <span>Simpan sebagai Draft</span>
                </label>
            </div>
            @error('status') <span class="text-error text-xs mt-1">{{ $message }}</span> @enderror
        </div>

        <div class="pt-6 flex justify-end gap-4 border-t border-surface-container">
            <a href="{{ route('berita.index') }}"
                class="px-6 py-3 rounded-xl font-bold text-slate-500 hover:bg-slate-100 transition-colors">Batal</a>
            <button type="submit"
                class="bg-primary text-on-primary px-8 py-3 rounded-xl font-bold shadow-lg hover:scale-105 transition-all">Simpan
                Berita</button>
        </div>
    </form>
</div>
@endsection