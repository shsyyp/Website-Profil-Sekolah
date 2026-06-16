@extends('layouts.admin')

@section('title', 'Edit Berita | Admin SMAN Pintar')

@section('content')
<div class="max-w-7xl mx-auto space-y-8">
    <div>
        <h2 class="text-4xl font-extrabold text-primary tracking-tight font-headline">Edit Berita</h2>
    </div>

    <div class="bg-surface-container-lowest rounded-2xl shadow-sm p-8">
        <form action="{{ route('berita.update', $berita->id) }}" method="POST" enctype="multipart/form-data"
            class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label class="text-xs font-bold uppercase text-tertiary block mb-2">Judul Berita</label>
                <input type="text" name="judul" value="{{ old('judul', $berita->judul) }}"
                    class="w-full bg-surface-container border-none rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-primary"
                    required>
                @error('judul') <span class="text-error text-xs">{{ $message }}</span> @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="text-xs font-bold uppercase text-tertiary block mb-2">Kategori</label>
                    <select name="kategori"
                        class="w-full bg-surface-container border-none rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-primary"
                        required>
                        @foreach (['Akademik', 'Prestasi', 'Kegiatan', 'Pengumuman'] as $kategori)
                        <option value="{{ $kategori }}" @selected(old('kategori', $berita->kategori) === $kategori)>
                            {{ $kategori }}
                        </option>
                        @endforeach
                    </select>
                    @error('kategori') <span class="text-error text-xs">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="text-xs font-bold uppercase text-tertiary block mb-2">Tanggal Publish</label>
                    <input type="date" name="tanggal" value="{{ old('tanggal', $berita->tanggal) }}"
                        class="w-full bg-surface-container border-none rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-primary"
                        required>
                    @error('tanggal') <span class="text-error text-xs">{{ $message }}</span> @enderror
                </div>
            </div>

            <div>
                <label class="text-xs font-bold uppercase text-tertiary block mb-2">Thumbnail/Gambar</label>
                @if($berita->gambar)
                <div class="mb-3">
                    <img src="{{ asset('storage/' . $berita->gambar) }}" alt="Current Thumbnail"
                        class="h-32 rounded-lg object-cover border border-outline-variant">
                    <p class="text-xs text-on-surface-variant mt-1">Gambar saat ini. Biarkan kosong jika tidak ingin mengubah.</p>
                </div>
                @endif
                <input type="file" name="gambar"
                    class="w-full bg-surface-container border-none rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-primary"
                    accept="image/*">
                @error('gambar') <span class="text-error text-xs">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="text-xs font-bold uppercase text-tertiary block mb-2">Isi Berita</label>
                <textarea name="isi" rows="6"
                    class="w-full bg-surface-container border-none rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-primary"
                    required>{{ old('isi', $berita->isi) }}</textarea>
                @error('isi') <span class="text-error text-xs">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="text-xs font-bold uppercase text-tertiary block mb-2">Status Publikasi</label>
                <div class="flex flex-wrap gap-6 text-sm font-medium text-on-surface">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="radio" name="status" value="publish"
                            @checked(old('status', $berita->status) === 'publish')
                            class="text-primary focus:ring-primary">
                        <span>Publish</span>
                    </label>
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="radio" name="status" value="draft"
                            @checked(old('status', $berita->status) === 'draft')
                            class="text-primary focus:ring-primary">
                        <span>Simpan sebagai Draft</span>
                    </label>
                </div>
                @error('status') <span class="text-error text-xs">{{ $message }}</span> @enderror
            </div>

            <div class="pt-6 flex gap-3 border-t border-surface-container">
                <a href="{{ route('berita.index', ['panel' => 'news-management-section']) }}" class="btn-cancel">
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
