@extends('layouts.admin')

@section('title', 'Manajemen Alumni | Admin SMAN Pintar')

@section('content')
@php
    $defaultStats = [
        ['icon' => 'groups', 'value' => ($alumni->total() ?? 0) . '+', 'label' => 'Total Alumni'],
        ['icon' => 'school', 'value' => '95%', 'label' => 'Lolos PTN'],
        ['icon' => 'work', 'value' => '30%', 'label' => 'Fortune 500'],
        ['icon' => 'public', 'value' => $lokasi_sebaran->count() . '+', 'label' => 'Lokasi Alumni'],
    ];
    $stats = old('stats', $settings->stats ?? $defaultStats);
    $stats = count($stats) ? $stats : $defaultStats;
    $pageComponents = [
        ['id' => 'alumni-hero-section', 'icon' => 'auto_stories', 'title' => 'Hero & Statistik', 'meta' => $settings->hero_breadcrumb_label ?? 'Alumni', 'content' => $settings->hero_title ?? 'Jejak Alumni Kami'],
        ['id' => 'alumni-map-section', 'icon' => 'public', 'title' => 'Sebaran Alumni', 'meta' => $settings->map_label ?? 'Global Network', 'content' => $settings->map_title ?? 'Sebaran Alumni Global'],
        ['id' => 'alumni-featured-section', 'icon' => 'workspace_premium', 'title' => 'Featured Alumni', 'meta' => $settings->featured_badge ?? 'Featured Alumna', 'content' => $settings->featured_button_text ?? 'Baca Kisah Selengkapnya'],
        ['id' => 'alumni-grid-section', 'icon' => 'grid_view', 'title' => 'Grid Alumni', 'meta' => $settings->grid_button_text ?? 'Lihat Semua Direktori Alumni', 'content' => $settings->grid_title ?? 'Inspirasi Alumni'],
        ['id' => 'alumni-testimonial-section', 'icon' => 'format_quote', 'title' => 'Testimoni', 'meta' => $settings->testimonial_name ?? 'Fandi Ahmad', 'content' => $settings->testimonial_quote ?? 'Berada di SMAN Pintar membuka mata saya...'],
        ['id' => 'alumni-cta-section', 'icon' => 'campaign', 'title' => 'CTA Alumni', 'meta' => $settings->cta_primary_text ?? 'Daftar PMB', 'content' => $settings->cta_title ?? 'Jadilah Bagian dari Alumni Hebat Kami'],
        ['id' => 'alumni-management-section', 'icon' => 'manage_accounts', 'title' => 'Manajemen Alumni', 'meta' => $alumni->total() . ' alumni', 'content' => 'Kelola data lulusan SMAN Pintar seluruh angkatan.', 'type' => 'management'],
    ];
@endphp

{{-- Load CSS Leaflet --}}
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

@if(session('success'))
<div class="bg-emerald-50 text-emerald-600 p-4 rounded-xl mb-6 font-bold flex items-center gap-2">
    <span class="material-symbols-outlined">check_circle</span>
    {{ session('success') }}
</div>
@endif

{{-- Pengaturan Tampilan Halaman Alumni --}}
<form action="{{ route('admin.alumni.page-setting.update') }}" method="POST" enctype="multipart/form-data" class="mb-12 space-y-8">
    @csrf

    <div id="alumni-page-overview" class="space-y-8">
        <section>
            <h2 class="text-4xl font-extrabold text-primary tracking-tight font-headline">Alumni</h2>
        </section>

        <section class="bg-surface-container-lowest rounded-2xl overflow-hidden shadow-[0_8px_30px_rgb(0,0,0,0.04)]">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-surface-container-low/50">
                            <th class="px-8 py-5 text-[11px] font-bold text-slate-400 uppercase tracking-widest">No</th>
                            <th class="px-6 py-5 text-[11px] font-bold text-slate-400 uppercase tracking-widest">Komponen</th>
                            <th class="px-6 py-5 text-[11px] font-bold text-slate-400 uppercase tracking-widest">Deskripsi</th>
                            <th class="px-6 py-5 text-[11px] font-bold text-slate-400 uppercase tracking-widest">Status</th>
                            <th class="px-8 py-5 text-[11px] font-bold text-slate-400 uppercase tracking-widest text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-surface-container">
                        @foreach ($pageComponents as $component)
                        <tr class="group hover:bg-surface-container-low/30 transition-colors">
                            <td class="px-8 py-4">
                                <span class="inline-flex h-8 w-8 items-center justify-center rounded-lg bg-blue-50 text-sm font-bold text-primary">
                                    {{ $loop->iteration }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <p class="font-bold text-blue-900 group-hover:text-primary transition-colors">{{ $component['title'] }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <p class="max-w-xl text-sm text-on-surface-variant font-medium leading-relaxed line-clamp-2">{{ $component['content'] }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <span class="flex items-center gap-1.5 text-xs font-bold text-emerald-600 bg-emerald-50 px-3 py-1 rounded-full w-fit">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Aktif
                                </span>
                            </td>
                            <td class="px-8 py-4 text-right">
                                @if(($component['type'] ?? 'editor') === 'management')
                                <a href="#{{ $component['id'] }}" data-alumni-management-target="{{ $component['id'] }}"
                                    class="inline-flex w-9 h-9 items-center justify-center rounded-xl bg-slate-100 text-slate-500 hover:bg-amber-100 hover:text-amber-600 transition-all">
                                    <span class="material-symbols-outlined text-[20px]">edit</span>
                                </a>
                                @else
                                <a href="#{{ $component['id'] }}" data-alumni-page-edit-target="{{ $component['id'] }}"
                                    class="inline-flex w-9 h-9 items-center justify-center rounded-xl bg-slate-100 text-slate-500 hover:bg-amber-100 hover:text-amber-600 transition-all">
                                    <span class="material-symbols-outlined text-[20px]">edit</span>
                                </a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>
    </div>

    <section id="alumni-page-editors" class="hidden max-w-4xl space-y-4">
        <details id="alumni-hero-section" data-alumni-page-panel class="group bg-surface-container-lowest rounded-2xl shadow-sm border border-slate-100 overflow-hidden" open>
            <summary class="list-none p-6 flex items-center justify-between gap-4">
                <div><span class="text-xs font-bold text-tertiary uppercase tracking-widest mb-1 block">Component 01</span><h3 class="text-2xl font-headline font-extrabold text-primary">Hero & Statistik</h3></div>
                <button type="button" data-alumni-page-back class="inline-flex items-center gap-2 rounded-xl bg-slate-100 px-4 py-2 text-sm font-bold text-slate-600 hover:bg-slate-200 transition-colors"><span class="material-symbols-outlined text-[18px]">arrow_back</span>Kembali</button>
            </summary>
            <div class="border-t border-slate-100 p-6 lg:p-8 bg-surface-container-low/40 space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <input name="hero_breadcrumb_label" class="bg-white border-none rounded-xl px-4 py-3" value="{{ old('hero_breadcrumb_label', $settings->hero_breadcrumb_label ?? 'Alumni') }}" placeholder="Label breadcrumb">
                    <input name="hero_title" class="bg-white border-none rounded-xl px-4 py-3 font-bold" value="{{ old('hero_title', $settings->hero_title ?? 'Jejak Alumni Kami') }}" placeholder="Judul hero">
                    <textarea name="hero_description" rows="3" class="bg-white border-none rounded-xl px-4 py-3 md:col-span-2" placeholder="Deskripsi hero">{{ old('hero_description', $settings->hero_description ?? 'Membangun masa depan melalui warisan keunggulan. Alumni SMAN Pintar Riau tersebar di seluruh penjuru dunia, membawa semangat inovasi dan integritas dari tanah Lancang Kuning ke panggung global.') }}</textarea>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-bold text-slate-700 mb-2">Gambar Background Hero</label>
                        <input name="hero_image" type="file" accept="image/*" class="w-full bg-white border-none rounded-xl px-4 py-3">
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4">
                    @for ($i = 0; $i < 4; $i++)
                    <div class="bg-white p-5 rounded-xl space-y-3">
                        <label class="block text-sm font-bold text-slate-700">Statistik {{ $i + 1 }}</label>
                        <input name="stats[{{ $i }}][icon]" class="w-full bg-surface-container-low border-none rounded-xl px-4 py-3" value="{{ data_get($stats, $i.'.icon') }}" placeholder="Icon">
                        <input name="stats[{{ $i }}][value]" class="w-full bg-surface-container-low border-none rounded-xl px-4 py-3 font-bold" value="{{ data_get($stats, $i.'.value') }}" placeholder="Nilai">
                        <input name="stats[{{ $i }}][label]" class="w-full bg-surface-container-low border-none rounded-xl px-4 py-3" value="{{ data_get($stats, $i.'.label') }}" placeholder="Label">
                    </div>
                    @endfor
                </div>
            </div>
        </details>

        <details id="alumni-map-section" data-alumni-page-panel class="hidden group bg-surface-container-lowest rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            <summary class="list-none p-6 flex items-center justify-between gap-4">
                <div><span class="text-xs font-bold text-tertiary uppercase tracking-widest mb-1 block">Component 02</span><h3 class="text-2xl font-headline font-extrabold text-primary">Sebaran Alumni</h3></div>
                <button type="button" data-alumni-page-back class="inline-flex items-center gap-2 rounded-xl bg-slate-100 px-4 py-2 text-sm font-bold text-slate-600 hover:bg-slate-200 transition-colors"><span class="material-symbols-outlined text-[18px]">arrow_back</span>Kembali</button>
            </summary>
            <div class="border-t border-slate-100 p-6 lg:p-8 bg-surface-container-low/40 grid grid-cols-1 md:grid-cols-2 gap-6">
                <input name="map_label" class="bg-white border-none rounded-xl px-4 py-3" value="{{ old('map_label', $settings->map_label ?? 'Global Network') }}" placeholder="Label map">
                <input name="map_title" class="bg-white border-none rounded-xl px-4 py-3 font-bold" value="{{ old('map_title', $settings->map_title ?? 'Sebaran Alumni Global') }}" placeholder="Judul map">
                <textarea name="map_description" rows="3" class="bg-white border-none rounded-xl px-4 py-3 md:col-span-2" placeholder="Deskripsi map">{{ old('map_description', $settings->map_description ?? 'Dari Riau untuk Dunia. Lihat bagaimana komunitas alumni kami berkembang di berbagai pusat ekonomi dan pendidikan global.') }}</textarea>
                <div class="md:col-span-2">
                    <label class="block text-sm font-bold text-slate-700 mb-2">Gambar Map</label>
                    <input name="map_image" type="file" accept="image/*" class="w-full bg-white border-none rounded-xl px-4 py-3">
                </div>
            </div>
        </details>

        <details id="alumni-featured-section" data-alumni-page-panel class="hidden group bg-surface-container-lowest rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            <summary class="list-none p-6 flex items-center justify-between gap-4">
                <div><span class="text-xs font-bold text-tertiary uppercase tracking-widest mb-1 block">Component 03</span><h3 class="text-2xl font-headline font-extrabold text-primary">Featured Alumni</h3></div>
                <button type="button" data-alumni-page-back class="inline-flex items-center gap-2 rounded-xl bg-slate-100 px-4 py-2 text-sm font-bold text-slate-600 hover:bg-slate-200 transition-colors"><span class="material-symbols-outlined text-[18px]">arrow_back</span>Kembali</button>
            </summary>
            <div class="border-t border-slate-100 p-6 lg:p-8 bg-surface-container-low/40 grid grid-cols-1 md:grid-cols-2 gap-6">
                <input name="featured_badge" class="bg-white border-none rounded-xl px-4 py-3" value="{{ old('featured_badge', $settings->featured_badge ?? 'Featured Alumna') }}" placeholder="Badge featured">
                <input name="featured_button_text" class="bg-white border-none rounded-xl px-4 py-3" value="{{ old('featured_button_text', $settings->featured_button_text ?? 'Baca Kisah Selengkapnya') }}" placeholder="Teks tombol featured">
            </div>
        </details>

        <details id="alumni-grid-section" data-alumni-page-panel class="hidden group bg-surface-container-lowest rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            <summary class="list-none p-6 flex items-center justify-between gap-4">
                <div><span class="text-xs font-bold text-tertiary uppercase tracking-widest mb-1 block">Component 04</span><h3 class="text-2xl font-headline font-extrabold text-primary">Grid Alumni</h3></div>
                <button type="button" data-alumni-page-back class="inline-flex items-center gap-2 rounded-xl bg-slate-100 px-4 py-2 text-sm font-bold text-slate-600 hover:bg-slate-200 transition-colors"><span class="material-symbols-outlined text-[18px]">arrow_back</span>Kembali</button>
            </summary>
            <div class="border-t border-slate-100 p-6 lg:p-8 bg-surface-container-low/40 grid grid-cols-1 md:grid-cols-2 gap-6">
                <input name="grid_title" class="bg-white border-none rounded-xl px-4 py-3 font-bold" value="{{ old('grid_title', $settings->grid_title ?? 'Inspirasi Alumni') }}" placeholder="Judul grid">
                <input name="grid_button_text" class="bg-white border-none rounded-xl px-4 py-3" value="{{ old('grid_button_text', $settings->grid_button_text ?? 'Lihat Semua Direktori Alumni') }}" placeholder="Teks tombol grid">
                <textarea name="grid_description" rows="3" class="bg-white border-none rounded-xl px-4 py-3 md:col-span-2" placeholder="Deskripsi grid">{{ old('grid_description', $settings->grid_description ?? 'Mengenal lebih dekat para alumni berprestasi yang kini berkarya di berbagai sektor industri strategis.') }}</textarea>
            </div>
        </details>

        <details id="alumni-testimonial-section" data-alumni-page-panel class="hidden group bg-surface-container-lowest rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            <summary class="list-none p-6 flex items-center justify-between gap-4">
                <div><span class="text-xs font-bold text-tertiary uppercase tracking-widest mb-1 block">Component 05</span><h3 class="text-2xl font-headline font-extrabold text-primary">Testimoni</h3></div>
                <button type="button" data-alumni-page-back class="inline-flex items-center gap-2 rounded-xl bg-slate-100 px-4 py-2 text-sm font-bold text-slate-600 hover:bg-slate-200 transition-colors"><span class="material-symbols-outlined text-[18px]">arrow_back</span>Kembali</button>
            </summary>
            <div class="border-t border-slate-100 p-6 lg:p-8 bg-surface-container-low/40 space-y-6">
                <textarea name="testimonial_quote" rows="4" class="w-full bg-white border-none rounded-xl px-4 py-3" placeholder="Quote testimoni">{{ old('testimonial_quote', $settings->testimonial_quote ?? 'Berada di SMAN Pintar membuka mata saya bahwa keterbatasan geografis bukan penghalang untuk bersaing secara global. Kurikulum dan dukungan pengajarnya benar-benar mempersiapkan mentalitas juara.') }}</textarea>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <input name="testimonial_name" class="bg-white border-none rounded-xl px-4 py-3" value="{{ old('testimonial_name', $settings->testimonial_name ?? 'Fandi Ahmad') }}" placeholder="Nama testimoni">
                    <input name="testimonial_meta" class="bg-white border-none rounded-xl px-4 py-3" value="{{ old('testimonial_meta', $settings->testimonial_meta ?? 'PhD Candidate, University of Oxford | Class of 2016') }}" placeholder="Meta testimoni">
                </div>
            </div>
        </details>

        <details id="alumni-cta-section" data-alumni-page-panel class="hidden group bg-surface-container-lowest rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            <summary class="list-none p-6 flex items-center justify-between gap-4">
                <div><span class="text-xs font-bold text-tertiary uppercase tracking-widest mb-1 block">Component 06</span><h3 class="text-2xl font-headline font-extrabold text-primary">CTA Alumni</h3></div>
                <button type="button" data-alumni-page-back class="inline-flex items-center gap-2 rounded-xl bg-slate-100 px-4 py-2 text-sm font-bold text-slate-600 hover:bg-slate-200 transition-colors"><span class="material-symbols-outlined text-[18px]">arrow_back</span>Kembali</button>
            </summary>
            <div class="border-t border-slate-100 p-6 lg:p-8 bg-surface-container-low/40 grid grid-cols-1 md:grid-cols-2 gap-6">
                <input name="cta_title" class="bg-white border-none rounded-xl px-4 py-3 font-bold" value="{{ old('cta_title', $settings->cta_title ?? 'Jadilah Bagian dari Alumni Hebat Kami') }}" placeholder="Judul CTA">
                <textarea name="cta_description" rows="3" class="bg-white border-none rounded-xl px-4 py-3 md:col-span-2" placeholder="Deskripsi CTA">{{ old('cta_description', $settings->cta_description ?? 'Lanjutkan legacy keunggulan ini. Apakah Anda calon siswa yang ambisius atau alumni yang ingin kembali berkontribusi?') }}</textarea>
                <input name="cta_primary_text" class="bg-white border-none rounded-xl px-4 py-3" value="{{ old('cta_primary_text', $settings->cta_primary_text ?? 'Daftar PMB') }}" placeholder="Tombol utama">
                <input name="cta_primary_link" class="bg-white border-none rounded-xl px-4 py-3" value="{{ old('cta_primary_link', $settings->cta_primary_link ?? url('/pmb')) }}" placeholder="Link tombol utama">
                <input name="cta_secondary_text" class="bg-white border-none rounded-xl px-4 py-3" value="{{ old('cta_secondary_text', $settings->cta_secondary_text ?? 'Gabung Alumni') }}" placeholder="Tombol kedua">
                <input name="cta_secondary_link" class="bg-white border-none rounded-xl px-4 py-3" value="{{ old('cta_secondary_link', $settings->cta_secondary_link ?? '#') }}" placeholder="Link tombol kedua">
            </div>
        </details>

        <div class="bg-surface-container-lowest rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] px-8 py-6">
            <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end sm:items-center">
                <button type="button" data-alumni-page-back class="btn-cancel">Batal</button>
                <button type="submit" class="bg-primary text-white px-8 py-3 rounded-xl font-bold shadow-lg hover:scale-105 transition-all">Simpan</button>
            </div>
        </div>
    </section>
</form>

<section id="alumni-management-section" class="hidden space-y-8">
    <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
        <h2 class="text-4xl font-extrabold text-primary tracking-tight font-headline">Manajemen Alumni</h2>
        <div class="flex flex-col-reverse gap-3 sm:flex-row sm:items-center">
            <button type="button" data-alumni-management-back
                class="inline-flex items-center justify-center gap-2 rounded-xl bg-slate-100 px-6 py-3 font-bold text-slate-600 hover:bg-slate-200 transition-colors">
                <span class="material-symbols-outlined text-[18px]">arrow_back</span>
                Kembali
            </button>
            <a href="{{ route('alumni.create') }}"
                class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-gradient-to-r from-primary to-primary-container text-white rounded-xl font-bold shadow-xl shadow-primary/10 hover:scale-[1.02] active:scale-95 transition-all">
                <span class="material-symbols-outlined">add</span>
                Tambah Alumni
            </a>
        </div>
    </div>

    {{-- Visual Analytics Grid --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
    {{-- Map Section --}}
    <div class="lg:col-span-2 bg-surface-container-lowest rounded-xl shadow-sm overflow-hidden flex flex-col">
        <div class="p-6 flex justify-between items-center border-b border-surface-container-high/30">
            <h3 class="font-bold flex items-center gap-2">
                <span class="material-symbols-outlined text-tertiary">public</span>
                Persebaran Alumni
            </h3>
        </div>
        <div class="flex-1 relative bg-[#f0f4f9] p-6 flex flex-col gap-4">
            <div>
                <p class="text-xs text-outline mb-2">Lokasi terdaftar saat ini:</p>
                <div class="flex flex-wrap gap-2">
                    @foreach($lokasi_sebaran as $lok)
                    <span
                        class="px-3 py-1 bg-white border border-outline-variant/30 rounded-full text-xs font-bold text-primary">{{ $lok->lokasi }}</span>
                    @endforeach
                </div>
            </div>

            {{-- Container Map Leaflet --}}
            <div id="mapAlumni" class="w-full h-[350px] rounded-xl border border-outline-variant/30"
                style="z-index: 10;"></div>
        </div>
    </div>

    {{-- Chart Section --}}
    <div class="bg-surface-container-lowest rounded-xl shadow-sm p-6 flex flex-col space-y-6">
        <h3 class="font-bold flex items-center gap-2">
            <span class="material-symbols-outlined text-tertiary">analytics</span>
            Statistik
        </h3>
        <div class="flex-1 flex flex-col justify-center gap-4">
            <div class="p-4 bg-surface-container-low rounded-xl text-center">
                <p class="text-3xl font-extrabold text-primary">{{ $alumni->total() }}</p>
                <p class="text-xs font-bold text-outline uppercase tracking-widest mt-1">Total Terdata</p>
            </div>
        </div>
    </div>
    </div>

    {{-- Table Alumni --}}
    <div class="bg-surface-container-lowest rounded-xl shadow-sm overflow-hidden">
    <div class="p-6 border-b border-surface-container-high/30 flex justify-between items-center">
        <h3 class="font-bold">Database Alumni Terbaru</h3>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr
                    class="bg-surface-container-low text-on-surface-variant text-[11px] uppercase tracking-wider font-bold">
                    <th class="px-6 py-4">Foto</th>
                    <th class="px-6 py-4">Nama Lengkap</th>
                    <th class="px-6 py-4">Profesi / Instansi</th>
                    <th class="px-6 py-4">Angkatan</th>
                    <th class="px-6 py-4">Lokasi Saat Ini</th>
                    <th class="px-6 py-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-surface-container-high/50 text-sm">
                @forelse ($alumni as $item)
                <tr class="hover:bg-surface-container-low/30 transition-colors">
                    <td class="px-6 py-4">
                        @if($item->foto)
                        <img class="w-10 h-10 rounded-full object-cover ring-2 ring-surface"
                            src="{{ asset('storage/' . $item->foto) }}" />
                        @else
                        <div
                            class="w-10 h-10 rounded-full bg-slate-200 flex items-center justify-center text-[10px] font-bold text-slate-400 ring-2 ring-surface">
                            No Pic</div>
                        @endif
                    </td>
                    <td class="px-6 py-4 font-bold text-on-surface">{{ $item->nama }}</td>
                    <td class="px-6 py-4">{{ $item->profesi }} <br> <span
                            class="text-xs text-outline">{{ $item->instansi }}</span></td>
                    <td class="px-6 py-4">
                        <span
                            class="px-3 py-1 bg-secondary-container text-on-secondary-container rounded-full text-[10px] font-bold">LULUS
                            {{ $item->tahun_lulus }}</span>
                    </td>
                    <td class="px-6 py-4 flex items-center gap-2">
                        <span class="material-symbols-outlined text-tertiary text-lg">location_on</span>
                        {{ $item->lokasi }}
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex justify-center gap-2">
                            <a href="{{ route('alumni.edit', $item->id) }}"
                                class="p-2 bg-surface-container-high text-secondary rounded-lg hover:scale-110 transition-transform">
                                <span class="material-symbols-outlined text-[18px]">edit</span>
                            </a>
                            <form action="{{ route('alumni.destroy', $item->id) }}" method="POST"
                                onsubmit="return confirm('Hapus data alumni ini?');">
                                @csrf @method('DELETE')
                                <button type="submit"
                                    class="p-2 bg-surface-container-high text-error rounded-lg hover:scale-110 transition-transform">
                                    <span class="material-symbols-outlined text-[18px]">delete</span>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-8 text-center text-slate-400">Belum ada data alumni.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="p-6 bg-surface-container-low/50">
        {{ $alumni->links() }}
    </div>
    </div>
</section>

{{-- Load JS Leaflet & Init Map --}}
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
const alumniPageOverview = document.getElementById('alumni-page-overview');
const alumniPageEditors = document.getElementById('alumni-page-editors');
const alumniManagementSection = document.getElementById('alumni-management-section');
const alumniPagePanels = document.querySelectorAll('[data-alumni-page-panel]');
let alumniMap = null;

function showAlumniPageOverview() {
    alumniPageEditors.classList.add('hidden');
    alumniManagementSection.classList.add('hidden');
    alumniPageOverview.classList.remove('hidden');
    alumniPagePanels.forEach((panel) => panel.classList.add('hidden'));
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

function showAlumniPageEditor(panelId) {
    const target = document.getElementById(panelId);

    if (!target) {
        return;
    }

    alumniPageOverview.classList.add('hidden');
    alumniManagementSection.classList.add('hidden');
    alumniPageEditors.classList.remove('hidden');
    alumniPagePanels.forEach((panel) => panel.classList.add('hidden'));
    target.classList.remove('hidden');
    target.open = true;
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

function showAlumniManagement() {
    alumniPageOverview.classList.add('hidden');
    alumniPageEditors.classList.add('hidden');
    alumniPagePanels.forEach((panel) => panel.classList.add('hidden'));
    alumniManagementSection.classList.remove('hidden');
    window.scrollTo({ top: 0, behavior: 'smooth' });

    setTimeout(() => {
        if (alumniMap) {
            alumniMap.invalidateSize();
        }
    }, 250);
}

document.querySelectorAll('[data-alumni-page-edit-target]').forEach((link) => {
    link.addEventListener('click', (event) => {
        event.preventDefault();
        showAlumniPageEditor(link.dataset.alumniPageEditTarget);
    });
});

document.querySelectorAll('[data-alumni-management-target]').forEach((link) => {
    link.addEventListener('click', (event) => {
        event.preventDefault();
        showAlumniManagement();
    });
});

document.querySelectorAll('[data-alumni-page-back]').forEach((button) => {
    button.addEventListener('click', (event) => {
        event.preventDefault();
        event.stopPropagation();
        showAlumniPageOverview();
    });
});

document.querySelectorAll('[data-alumni-management-back]').forEach((button) => {
    button.addEventListener('click', (event) => {
        event.preventDefault();
        showAlumniPageOverview();
    });
});

document.addEventListener("DOMContentLoaded", function() {
    // Set view awal ke tengah Indonesia
    alumniMap = L.map('mapAlumni').setView([-0.789275, 113.921327], 4);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(alumniMap);

    // Ambil data lokasi dari controller
    const lokasiData = JSON.parse('{!! json_encode($lokasi_sebaran) !!}');

    // Hit API Nominatim buat dapet koordinat dari nama kota
    lokasiData.forEach(function(item) {
        fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${item.lokasi}`)
            .then(res => res.json())
            .then(data => {
                if (data.length > 0) {
                    L.marker([data[0].lat, data[0].lon])
                        .addTo(alumniMap)
                        .bindPopup(`<b>${item.lokasi}</b>`);
                }
            }).catch(err => console.log("Gagal load lokasi: ", err));
    });
});
</script>
@endsection
