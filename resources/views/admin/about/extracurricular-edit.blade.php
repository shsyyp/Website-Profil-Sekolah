@extends('layouts.admin')

@section('title', 'Edit Ekstrakurikuler | Admin SMAN Pintar')

@section('content')
<div class="max-w-7xl mx-auto space-y-8">
    <div>
        <h2 class="text-4xl font-extrabold text-primary tracking-tight font-headline">Edit Ekstrakurikuler</h2>
    </div>

    <div class="bg-surface-container-lowest rounded-2xl shadow-sm p-8">
        <form action="{{ route('admin.about.extracurriculars.update', $index) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            <input type="hidden" name="icon" value="{{ data_get($extracurricular, 'icon', 'groups') }}">

            <div>
                <label class="text-xs font-bold uppercase text-tertiary block mb-2">Nama Ekstrakurikuler</label>
                <input type="text" name="title" value="{{ old('title', data_get($extracurricular, 'title')) }}"
                    class="w-full bg-surface-container border-none rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-primary"
                    required>
                @error('title') <span class="text-error text-xs">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="text-xs font-bold uppercase text-tertiary block mb-2">Deskripsi</label>
                <textarea name="desc" rows="7"
                    class="w-full bg-surface-container border-none rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-primary">{{ old('desc', data_get($extracurricular, 'desc')) }}</textarea>
                @error('desc') <span class="text-error text-xs">{{ $message }}</span> @enderror
            </div>

            <div class="pt-6 flex gap-3 border-t border-surface-container">
                <a href="{{ route('admin.about.index') }}" class="btn-cancel">
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
