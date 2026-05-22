@extends('layouts.admin')

@section('title', 'Tambah Berita | Admin SMAN Pintar')

@section('content')
<div class="max-w-7xl mx-auto space-y-8">
    <div>
        <h2 class="text-4xl font-extrabold text-primary tracking-tight font-headline">Tambah Berita</h2>
    </div>

    <div class="bg-surface-container-lowest rounded-2xl shadow-sm p-8">
        <form action="{{ route('berita.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div>
                <label class="text-xs font-bold uppercase text-tertiary block mb-2">Judul Berita</label>
                <input type="text" name="judul" value="{{ old('judul') }}"
                    class="w-full bg-surface-container border-none rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-primary"
                    placeholder="Masukkan judul..." required>
                @error('judul') <span class="text-error text-xs">{{ $message }}</span> @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="text-xs font-bold uppercase text-tertiary block mb-2">Kategori</label>
                    <select name="kategori"
                        class="w-full bg-surface-container border-none rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-primary"
                        required>
                        <option value="Akademik" @selected(old('kategori') === 'Akademik')>Akademik</option>
                        <option value="Prestasi" @selected(old('kategori') === 'Prestasi')>Prestasi</option>
                        <option value="Kegiatan" @selected(old('kategori') === 'Kegiatan')>Kegiatan</option>
                        <option value="Pengumuman" @selected(old('kategori') === 'Pengumuman')>Pengumuman</option>
                    </select>
                    @error('kategori') <span class="text-error text-xs">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="text-xs font-bold uppercase text-tertiary block mb-2">Tanggal Publish</label>
                    <input type="date" name="tanggal" value="{{ old('tanggal') ?? date('Y-m-d') }}"
                        class="w-full bg-surface-container border-none rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-primary"
                        required>
                    @error('tanggal') <span class="text-error text-xs">{{ $message }}</span> @enderror
                </div>
            </div>

            <div>
                <label class="text-xs font-bold uppercase text-tertiary block mb-2">Thumbnail/Gambar</label>
                <input type="file" name="gambar"
                    class="w-full bg-surface-container border-none rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-primary"
                    accept="image/*">
                @error('gambar') <span class="text-error text-xs">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="text-xs font-bold uppercase text-tertiary block mb-2">Isi Berita</label>
                <textarea name="isi" rows="6"
                    class="w-full bg-surface-container border-none rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-primary"
                    placeholder="Tulis konten berita di sini..." required>{{ old('isi') }}</textarea>
                @error('isi') <span class="text-error text-xs">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="text-xs font-bold uppercase text-tertiary block mb-2">Status Publikasi</label>
                <div class="flex flex-wrap gap-6 text-sm font-medium text-on-surface">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="radio" name="status" value="publish" @checked(old('status', 'publish') === 'publish')
                            class="text-primary focus:ring-primary">
                        <span>Publish</span>
                    </label>
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="radio" name="status" value="draft" @checked(old('status') === 'draft')
                            class="text-primary focus:ring-primary">
                        <span>Simpan sebagai Draft</span>
                    </label>
                </div>
                @error('status') <span class="text-error text-xs">{{ $message }}</span> @enderror
            </div>

            <div class="pt-6 flex gap-3 border-t border-surface-container">
                <a href="{{ route('berita.index') }}" class="btn-cancel">
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
