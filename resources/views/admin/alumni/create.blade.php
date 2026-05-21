@extends('layouts.admin')

@section('title', 'Tambah Alumni | Admin SMAN Pintar')

@section('content')
<div class="mb-8">
    <h2 class="text-3xl font-extrabold text-on-surface tracking-tight">Tambah Alumni Baru</h2>
    <p class="text-outline text-sm">Lengkapi data profil alumni di bawah ini.</p>
</div>

<div class="bg-surface-container-lowest rounded-2xl shadow-sm border border-outline-variant/10 p-8 max-w-4xl">
    {{-- Form Alumni --}}
    <form action="{{ route('alumni.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        {{-- Upload Foto --}}
        <div>
            <label class="text-xs font-bold uppercase text-tertiary block mb-2">Foto Profil</label>
            <input type="file" name="foto"
                class="w-full bg-surface-container border-none rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-primary"
                accept="image/*">
            @error('foto') <span class="text-error text-xs">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="text-xs font-bold uppercase text-tertiary block mb-2">Nama Lengkap</label>
            <input name="nama" type="text" value="{{ old('nama') }}"
                class="w-full bg-surface-container border-none rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-primary"
                required>
            @error('nama') <span class="text-error text-xs">{{ $message }}</span> @enderror
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="text-xs font-bold uppercase text-tertiary block mb-2">Angkatan (Tahun Lulus)</label>
                <input name="tahun_lulus" type="number" value="{{ old('tahun_lulus') }}"
                    class="w-full bg-surface-container border-none rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-primary"
                    placeholder="Contoh: 2020" required>
                @error('tahun_lulus') <span class="text-error text-xs">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="text-xs font-bold uppercase text-tertiary block mb-2">Status</label>
                <select name="status"
                    class="w-full bg-surface-container border-none rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-primary"
                    required>
                    <option value="aktif">Aktif</option>
                    <option value="nonaktif">Nonaktif</option>
                </select>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="text-xs font-bold uppercase text-tertiary block mb-2">Profesi</label>
                <input name="profesi" type="text" value="{{ old('profesi') }}"
                    class="w-full bg-surface-container border-none rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-primary"
                    placeholder="Software Engineer, Mahasiswa, dll" required>
                @error('profesi') <span class="text-error text-xs">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="text-xs font-bold uppercase text-tertiary block mb-2">Instansi / Kampus</label>
                <input name="instansi" type="text" value="{{ old('instansi') }}"
                    class="w-full bg-surface-container border-none rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-primary"
                    placeholder="Google, UI, dll">
            </div>
        </div>

        <div>
            <label class="text-xs font-bold uppercase text-tertiary block mb-2">Lokasi Saat Ini</label>
            <input name="lokasi" type="text" value="{{ old('lokasi') }}"
                class="w-full bg-surface-container border-none rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-primary"
                placeholder="Jakarta, California, dll" required>
            @error('lokasi') <span class="text-error text-xs">{{ $message }}</span> @enderror
        </div>

        <div class="pt-6 flex gap-3 border-t border-surface-container">
            <a href="{{ route('alumni.index') }}" class="btn-cancel">Batal</a>
            <button type="submit"
                class="px-8 py-3 bg-primary text-white font-bold rounded-xl text-sm shadow-lg shadow-primary/20 hover:scale-[1.02] transition-transform">Simpan
                Data</button>
        </div>
    </form>
</div>
@endsection
