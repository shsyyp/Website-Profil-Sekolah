@extends('layouts.admin')

@section('title', 'Edit Alumni | Admin SMAN Pintar')

@section('content')
@php
    $profession = strtolower($alumnus->profesi ?? '');
    $institution = strtolower($alumnus->instansi ?? '');
    $isStudying = str_contains($profession, 'mahasiswa')
        || str_contains($profession, 'kuliah')
        || str_contains($profession, 'student')
        || str_contains($institution, 'universitas')
        || str_contains($institution, 'university')
        || str_contains($institution, 'kampus')
        || str_contains($institution, 'institut')
        || str_contains($institution, 'politeknik');
    $alumniCondition = old('alumni_condition', $isStudying ? 'kuliah' : 'kerja');
    $selectedLocation = old('lokasi', $alumnus->lokasi);
    if ($selectedLocation && ! in_array($selectedLocation, $locationOptions, true)) {
        array_unshift($locationOptions, $selectedLocation);
    }
@endphp

<div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between mb-8">
    <h2 class="text-4xl font-extrabold text-primary tracking-tight font-headline">Edit Alumni</h2>
    <a href="{{ route('alumni.index') }}"
        class="inline-flex items-center justify-center gap-2 rounded-xl bg-slate-100 px-6 py-3 font-bold text-slate-600 hover:bg-slate-200 transition-colors">
        <span class="material-symbols-outlined text-[18px]">arrow_back</span>
        Kembali
    </a>
</div>

<form action="{{ route('alumni.update', $alumnus->id) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
    @csrf
    @method('PUT')

    <div class="bg-surface-container-lowest rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] p-8 lg:p-10 space-y-6">
        <div>
            <label class="block text-xs font-extrabold uppercase text-tertiary mb-3">Foto Alumni</label>
            @if($alumnus->foto)
            <img class="mb-3 h-24 w-24 rounded-2xl object-cover ring-2 ring-surface" src="{{ asset('storage/' . $alumnus->foto) }}" alt="{{ $alumnus->nama }}">
            @endif
            <input type="file" name="foto" accept="image/*"
                class="w-full bg-surface-container border-none rounded-xl px-4 py-3 text-base focus:ring-2 focus:ring-primary">
            <p class="mt-2 text-sm font-medium text-slate-500">Biarkan kosong jika foto tidak ingin diganti.</p>
            @error('foto') <span class="text-error text-xs">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-xs font-extrabold uppercase text-tertiary mb-3">Nama Alumni</label>
            <input name="nama" type="text" value="{{ old('nama', $alumnus->nama) }}"
                class="w-full bg-surface-container border-none rounded-xl px-4 py-3 text-base focus:ring-2 focus:ring-primary"
                placeholder="Contoh: Luthfi" required>
            @error('nama') <span class="text-error text-xs">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-xs font-extrabold uppercase text-tertiary mb-3">Kondisi Alumni Saat Ini</label>
            <select name="alumni_condition" data-alumni-condition
                class="w-full bg-surface-container border-none rounded-xl px-4 py-3 text-base focus:ring-2 focus:ring-primary">
                <option value="kerja" @selected($alumniCondition === 'kerja')>Sudah Kerja</option>
                <option value="kuliah" @selected($alumniCondition === 'kuliah')>Masih Kuliah</option>
            </select>
            <p class="mt-2 text-sm font-medium text-slate-500">Pilihan ini hanya membantu menyesuaikan isian profesi dan instansi.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label id="profesi_label" class="block text-xs font-extrabold uppercase text-tertiary mb-3">Profesi / Jabatan</label>
                <input id="profesi_input" name="profesi" type="text" value="{{ old('profesi', $alumnus->profesi) }}"
                    class="w-full bg-surface-container border-none rounded-xl px-4 py-3 text-base focus:ring-2 focus:ring-primary"
                    placeholder="Contoh: Dokter" required>
                @error('profesi') <span class="text-error text-xs">{{ $message }}</span> @enderror
            </div>
            <div>
                <label id="instansi_label" class="block text-xs font-extrabold uppercase text-tertiary mb-3">Instansi / Tempat Kerja</label>
                <input id="instansi_input" name="instansi" type="text" value="{{ old('instansi', $alumnus->instansi) }}"
                    class="w-full bg-surface-container border-none rounded-xl px-4 py-3 text-base focus:ring-2 focus:ring-primary"
                    placeholder="Contoh: RS">
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-xs font-extrabold uppercase text-tertiary mb-3">Tahun Lulus</label>
                <input name="tahun_lulus" type="number" value="{{ old('tahun_lulus', $alumnus->tahun_lulus) }}"
                    class="w-full bg-surface-container border-none rounded-xl px-4 py-3 text-base focus:ring-2 focus:ring-primary"
                    placeholder="Contoh: 2022" required>
                @error('tahun_lulus') <span class="text-error text-xs">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-xs font-extrabold uppercase text-tertiary mb-3">Lokasi Saat Ini</label>
                <div class="relative">
                    <input name="lokasi" type="text" value="{{ $selectedLocation }}" list="location_options"
                        class="location-combobox w-full bg-surface-container border-none rounded-xl px-4 py-3 pr-12 text-base focus:ring-2 focus:ring-primary"
                        placeholder="Pilih atau ketik nama kota" required>
                    <span class="material-symbols-outlined pointer-events-none absolute right-4 top-1/2 -translate-y-1/2 text-[22px] text-slate-500">
                        expand_more
                    </span>
                </div>
                <datalist id="location_options">
                    @foreach($locationOptions as $location)
                        <option value="{{ $location }}"></option>
                    @endforeach
                </datalist>
                @error('lokasi') <span class="text-error text-xs">{{ $message }}</span> @enderror
            </div>
        </div>

        <div>
            <label class="block text-xs font-extrabold uppercase text-tertiary mb-3">Cerita Singkat</label>
            <textarea name="deskripsi" rows="5"
                class="w-full bg-surface-container border-none rounded-xl px-4 py-3 text-base leading-relaxed focus:ring-2 focus:ring-primary"
                placeholder="Tulis kutipan atau cerita singkat alumni.">{{ old('deskripsi', $alumnus->deskripsi) }}</textarea>
        </div>
    </div>

    <div class="bg-surface-container-lowest rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] px-8 py-6">
        <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end sm:items-center">
            <a href="{{ route('alumni.index') }}" class="btn-cancel">Batal</a>
            <button type="submit" class="bg-primary text-white px-8 py-3 rounded-xl font-bold shadow-lg hover:scale-105 transition-all">
                Simpan
            </button>
        </div>
    </div>
</form>

<style>
    .location-combobox::-webkit-calendar-picker-indicator {
        display: none !important;
        opacity: 0;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const condition = document.querySelector('[data-alumni-condition]');
        const profesiLabel = document.getElementById('profesi_label');
        const profesiInput = document.getElementById('profesi_input');
        const instansiLabel = document.getElementById('instansi_label');
        const instansiInput = document.getElementById('instansi_input');

        const labels = {
            kerja: {
                profesi: 'Profesi / Jabatan',
                profesiPlaceholder: 'Contoh: Dokter',
                instansi: 'Instansi / Tempat Kerja',
                instansiPlaceholder: 'Contoh: RS'
            },
            kuliah: {
                profesi: 'Jurusan / Program Studi',
                profesiPlaceholder: 'Contoh: Kedokteran',
                instansi: 'Kampus',
                instansiPlaceholder: 'Contoh: Universitas Riau'
            }
        };

        const updateLabels = () => {
            const current = labels[condition.value] || labels.kerja;
            profesiLabel.textContent = current.profesi;
            profesiInput.placeholder = current.profesiPlaceholder;
            instansiLabel.textContent = current.instansi;
            instansiInput.placeholder = current.instansiPlaceholder;
        };

        condition.addEventListener('change', updateLabels);
        updateLabels();
    });
</script>
@endsection
