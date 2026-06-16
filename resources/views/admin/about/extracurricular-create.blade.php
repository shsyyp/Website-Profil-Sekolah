@extends('layouts.admin')

@section('title', 'Tambah Ekstrakurikuler | Admin SMAN Pintar')

@section('content')
<div class="max-w-7xl mx-auto space-y-8">
    <div>
        <h2 class="text-4xl font-extrabold text-primary tracking-tight font-headline">Tambah Ekstrakurikuler</h2>
    </div>

    <div class="bg-surface-container-lowest rounded-2xl shadow-sm p-8">
        <form action="{{ route('admin.about.extracurriculars.store') }}" method="POST" class="space-y-6">
            @csrf
            <input type="hidden" name="icon" value="groups">

            <div>
                <label class="text-xs font-bold uppercase text-tertiary block mb-2">Nama Ekstrakurikuler</label>
                <input type="text" name="title" value="{{ old('title') }}"
                    class="w-full bg-surface-container border-none rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-primary"
                    placeholder="Masukkan nama ekstrakurikuler..." required>
                @error('title') <span class="text-error text-xs">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="text-xs font-bold uppercase text-tertiary block mb-2">Deskripsi</label>
                <textarea name="desc" rows="7"
                    class="w-full bg-surface-container border-none rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-primary"
                    placeholder="Tulis deskripsi ekstrakurikuler di sini...">{{ old('desc') }}</textarea>
                @error('desc') <span class="text-error text-xs">{{ $message }}</span> @enderror
            </div>

            <div class="pt-6 flex gap-3 border-t border-surface-container">
                <a href="{{ route('admin.about.index', ['panel' => 'extracurricular-management-section']) }}" class="btn-cancel">
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
