@extends('layouts.admin')

@section('title', 'Beranda - SMAN Pintar')

@section('content')
@php
$defaultFasilitas = [
['icon' => 'local_library', 'title' => 'Perpustakaan Digital', 'desc' => 'Akses ke ribuan jurnal internasional dan
koleksi buku fisik terlengkap di Riau.'],
['icon' => 'science', 'title' => 'Lab Terpadu', 'desc' => 'Fisika, Kimia, Biologi, dan Lab Komputer terbaru.'],
['icon' => 'apartment', 'title' => 'Asrama Modern', 'desc' => 'Kamar yang nyaman dengan pengawasan 24 jam.'],
['icon' => 'sports_basketball', 'title' => 'Sport Center', 'desc' => 'Lapangan basket indoor, futsal, dan area atletik
standar nasional.'],
];

$heroImage = $homepage->hero_image
? asset('storage/' . $homepage->hero_image)
:
'https://lh3.googleusercontent.com/aida-public/AB6AXuC4oiXy_ZGxrC-CdAJ_E1oRCE9oH6xoDMFgA-gaGDsLdbdftaQu5ODBiA7VwHQqugcJTXn_gxDgRyUe32juEQUjJPcwkPS9BPJIR0QMkdkIKJsZF91VYCpXF6WNRsk8D9ltN1F72XysomzR1L9iMFgDbeM-TbX0ZdkyM1HLqAactkXBPLXmQbUFjls5C6vqTiPBZZOwaI01eAb-ia3atja9sU_GLD59jb9IpUPCYKt_Bj7gCQRD738g192USO2vfjfDg6bc4FdlOGia';

$successImage = $homepage->success_image
? asset('storage/' . $homepage->success_image)
:
'https://lh3.googleusercontent.com/aida-public/AB6AXuDSEccOsqSQv6m5MulAy7Nai2PfFp8lKz-h91phjw5wssfC3smtyVexwy_Ow0nA1lCuM9flw1DdmR5TWSyZs56dIUnjLILXGeLbVgzUYMBdbr92lwAbffStPJtyPaFd3V3r2pKQ0EXFGyaTQyEyuNcJZSRXnoXq4-Gj4GBP7y2IVSJzdlYAUNiN98WWyFnuIsXNWm6MhtTjqoL15p0HF3SLiAny79rJ4rHIpXdFO6715mKQpwPbm-23nCXeX4Gazj3SDdeAZCs6jtf8';

$facilityImage = $homepage->facility_main_image
? asset('storage/' . $homepage->facility_main_image)
: null;

$tradisiTitles = collect(range(0, 3))
->map(fn ($i) => data_get($homepage->tradisi, $i . '.title') ?? ($i == 0 ? 'Kurikulum' : ($i == 1 ? 'Boarding' : ($i ==
2 ? 'Pembinaan' : 'Alumni'))))
->implode(', ');

$facilityTitles = collect(range(0, 3))
->map(fn ($i) => data_get($homepage->fasilitas, $i . '.title') ?? $defaultFasilitas[$i]['title'])
->implode(', ');

$components = [
[
'id' => 'hero-section',
'preview' => 'image',
'image' => $heroImage,
'title' => 'Hero Section',
'content' => $homepage->hero_title ?? 'Membentuk Generasi Unggul Berkarakter & Berdaya Saing Global',
'meta' => $homepage->hero_label ?? 'Provinsi Riau',
],
[
'id' => 'tradisi-section',
'preview' => 'icon',
'icon' => 'military_tech',
'title' => 'Tradisi Keunggulan',
'content' => $homepage->about_title ?? 'Tradisi Keunggulan, Masa Depan Gemilang',
'meta' => $tradisiTitles,
],
[
'id' => 'fasilitas-section',
'preview' => $facilityImage ? 'image' : 'icon',
'image' => $facilityImage,
'icon' => 'domain',
'title' => 'Fasilitas & Ekosistem',
'content' => $homepage->facilities_title ?? 'Fasilitas & Ekosistem',
'meta' => $facilityTitles,
],
[
'id' => 'warta-section',
'preview' => 'icon',
'icon' => 'newspaper',
'title' => 'Warta & Alumni',
'content' => $homepage->news_title ?? 'Warta SMAN Pintar',
'meta' => 'Limit berita: ' . ($homepage->news_limit ?? 3) . ' item',
],
[
'id' => 'cta-section',
'preview' => 'icon',
'icon' => 'campaign',
'title' => 'CTA PMB',
'content' => $homepage->cta_title ?? 'Jadilah Bagian dari SMAN Pintar',
'meta' => 'Tahun ' . ($homepage->cta_year ?? '2025'),
],
[
'id' => 'footer-section',
'preview' => 'icon',
'icon' => 'notes',
'title' => 'Footer Website',
'content' => $homepage->footer_address ?? 'Jl. Pendidikan No. 01, Pekanbaru, Provinsi Riau',
'meta' => $homepage->footer_phone ?? '(0761) 1234567',
],
];
@endphp

<style>
#component-editors {
    max-width: 56rem;
}

#component-editors summary {
    cursor: default;
    list-style: none;
    padding: 0;
    margin-bottom: 2.5rem;
}

#component-editors summary::-webkit-details-marker {
    display: none;
}

#component-editors summary>div:first-child span {
    display: none;
}

#component-editors summary h3 {
    font-size: 2.25rem;
    line-height: 2.5rem;
    font-weight: 800;
}

#component-editors summary h3::after {
    content: "Kelola konten komponen beranda";
    display: block;
    margin-top: .5rem;
    color: rgb(71 85 105);
    font-family: "Plus Jakarta Sans", sans-serif;
    font-size: 1.125rem;
    line-height: 1.75rem;
    font-weight: 500;
}

#component-editors summary [data-save-editor],
#component-editors summary .group-open\:rotate-180 {
    display: none;
}

#component-editors [data-editor-panel] {
    border: 0;
    background: transparent;
    box-shadow: none;
    overflow: visible;
}

#component-editors [data-editor-panel]>div {
    border-top: 0;
    border-radius: 1rem;
    background: rgb(255 255 255);
    box-shadow: 0 8px 30px rgb(0 0 0 / 0.04);
    padding: 2rem;
}

#component-editors label {
    display: block;
    margin-bottom: .5rem;
    color: rgb(15 23 42);
    font-size: .875rem;
    font-weight: 700;
    letter-spacing: 0;
    text-transform: none;
}

#component-editors input,
#component-editors textarea,
#component-editors select {
    width: 100%;
    border: 0;
    border-radius: .75rem;
    background: rgb(226 227 237);
    padding: .75rem 1rem;
    color: rgb(15 23 42);
    font-weight: 500;
}

#component-editors input:focus,
#component-editors textarea:focus,
#component-editors select:focus {
    outline: 0;
    box-shadow: 0 0 0 2px rgb(0 74 173 / 0.2);
}

#component-editors .editor-actions {
    border-top: 1px solid rgb(226 232 240);
}
</style>

<form action="{{ url('admin/homepage') }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-10">
    @csrf

    @if(session('success'))
    <div
        class="bg-emerald-50 text-emerald-600 p-4 rounded-xl font-bold flex items-center gap-2 shadow-sm border border-emerald-100">
        <span class="material-symbols-outlined">check_circle</span>
        {{ session('success') }}
    </div>
    @endif

    <div id="component-overview" class="space-y-10">
        <section class="flex flex-col gap-5 lg:flex-row lg:items-end lg:justify-between">
            <div class="space-y-1">
                <span class="text-[11px] font-bold tracking-[0.2em] text-tertiary uppercase">Pengelolaan Halaman</span>
                <h2 class="text-4xl font-extrabold text-primary tracking-tight font-headline">Beranda</h2>
                <p class="text-on-surface-variant text-lg">Kelola komponen utama halaman depan sekolah.</p>
            </div>
            <button type="submit"
                class="bg-gradient-to-br from-[#00357f] to-[#004aad] text-white px-8 py-4 rounded-xl font-bold flex items-center justify-center gap-2 shadow-lg shadow-primary/20 hover:scale-[1.02] active:scale-95 transition-all duration-200">
                <span class="material-symbols-outlined">save</span>
                Simpan Perubahan
            </button>
        </section>

        <section class="bg-surface-container-lowest rounded-2xl overflow-hidden shadow-[0_8px_30px_rgb(0,0,0,0.04)]">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-surface-container-low/50">
                            <th class="px-8 py-5 text-[11px] font-bold text-slate-400 uppercase tracking-widest">Preview
                            </th>
                            <th class="px-6 py-5 text-[11px] font-bold text-slate-400 uppercase tracking-widest">
                                Komponen</th>
                            <th class="px-6 py-5 text-[11px] font-bold text-slate-400 uppercase tracking-widest">Konten
                                Utama</th>
                            <th class="px-6 py-5 text-[11px] font-bold text-slate-400 uppercase tracking-widest">Status
                            </th>
                            <th
                                class="px-8 py-5 text-[11px] font-bold text-slate-400 uppercase tracking-widest text-right">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-surface-container">
                        @foreach ($components as $component)
                        <tr class="group hover:bg-surface-container-low/30 transition-colors">
                            <td class="px-8 py-4">
                                @if($component['preview'] === 'image' && $component['image'])
                                <img src="{{ $component['image'] }}" class="w-20 h-14 object-cover rounded-lg shadow-sm"
                                    alt="{{ $component['title'] }}">
                                @else
                                <div
                                    class="w-20 h-14 rounded-lg bg-blue-50 text-primary flex items-center justify-center">
                                    <span class="material-symbols-outlined">{{ $component['icon'] }}</span>
                                </div>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <p class="font-bold text-blue-900 group-hover:text-primary transition-colors">
                                    {{ $component['title'] }}</p>
                                <p class="text-xs text-slate-400 mt-1">{{ $component['meta'] }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <p
                                    class="max-w-xl text-sm text-on-surface-variant font-medium leading-relaxed line-clamp-2">
                                    {{ $component['content'] }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <span
                                    class="flex items-center gap-1.5 text-xs font-bold text-emerald-600 bg-emerald-50 px-3 py-1 rounded-full w-fit">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Aktif
                                </span>
                            </td>
                            <td class="px-8 py-4 text-right">
                                <a href="#{{ $component['id'] }}" data-edit-target="{{ $component['id'] }}"
                                    class="inline-flex w-9 h-9 items-center justify-center rounded-xl bg-slate-100 text-slate-500 hover:bg-amber-100 hover:text-amber-600 transition-all">
                                    <span class="material-symbols-outlined text-[20px]">edit</span>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>
    </div>

    <section id="component-editors" class="hidden space-y-4">
        <details id="hero-section" data-editor-panel
            class="group bg-surface-container-lowest rounded-2xl shadow-sm border border-slate-100 overflow-hidden"
            open>
            <summary class="cursor-pointer list-none p-6 flex items-center justify-between gap-4">
                <div>
                    <span class="text-xs font-bold text-tertiary uppercase tracking-widest mb-1 block">Component
                        01</span>
                    <h3 class="text-2xl font-headline font-extrabold text-primary">Hero Section</h3>
                </div>
                <div class="flex items-center gap-3">
                    <button type="submit" data-save-editor
                        class="inline-flex items-center gap-2 rounded-xl bg-primary px-4 py-2 text-sm font-bold text-white hover:bg-primary-container transition-colors">
                        <span class="material-symbols-outlined text-[18px]">save</span>
                        Simpan
                    </button>
                    <button type="button" data-back-overview
                        class="inline-flex items-center gap-2 rounded-xl bg-slate-100 px-4 py-2 text-sm font-bold text-slate-600 hover:bg-slate-200 transition-colors">
                        <span class="material-symbols-outlined text-[18px]">arrow_back</span>
                        Kembali
                    </button>
                    <span
                        class="material-symbols-outlined text-slate-400 group-open:rotate-180 transition-transform">expand_more</span>
                </div>
            </summary>
            <div class="border-t border-slate-100 p-6 lg:p-8 grid grid-cols-12 gap-8">
                <div class="col-span-12 lg:col-span-7 space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-xs font-bold text-slate-500 uppercase tracking-tighter">Site Name</label>
                            <input name="site_name"
                                class="w-full bg-surface-container-low border-none focus:ring-2 focus:ring-primary rounded-xl px-4 py-3 font-medium text-on-surface"
                                type="text" value="{{ $homepage->site_name ?? 'SMAN Pintar' }}" />
                        </div>
                        <div class="space-y-2">
                            <label class="text-xs font-bold text-slate-500 uppercase tracking-tighter">Login
                                Button</label>
                            <input name="login_button_text"
                                class="w-full bg-surface-container-low border-none focus:ring-2 focus:ring-primary rounded-xl px-4 py-3 font-medium text-on-surface"
                                type="text" value="{{ $homepage->login_button_text ?? 'Login Admin' }}" />
                        </div>
                        <div class="space-y-2">
                            <label class="text-xs font-bold text-slate-500 uppercase tracking-tighter">Small
                                Label</label>
                            <input name="hero_label"
                                class="w-full bg-surface-container-low border-none focus:ring-2 focus:ring-primary rounded-xl px-4 py-3 font-medium text-on-surface"
                                type="text" value="{{ $homepage->hero_label ?? 'Provinsi Riau' }}" />
                        </div>
                        <div class="space-y-2">
                            <label class="text-xs font-bold text-slate-500 uppercase tracking-tighter">Success Story
                                Title</label>
                            <input name="success_title"
                                class="w-full bg-surface-container-low border-none focus:ring-2 focus:ring-primary rounded-xl px-4 py-3 font-medium text-on-surface"
                                type="text"
                                value="{{ $homepage->success_title ?? 'Mencetak 500+ Alumni di Universitas Terbaik Dunia' }}" />
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-slate-500 uppercase tracking-tighter">Success Story
                            Description</label>
                        <textarea name="success_desc"
                            class="w-full bg-surface-container-low border-none focus:ring-2 focus:ring-primary rounded-xl px-4 py-3 text-on-surface-variant leading-relaxed"
                            rows="2">{{ $homepage->success_desc ?? 'Cerita sukses siswa dan alumni SMAN Pintar Provinsi Riau.' }}</textarea>
                    </div>
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-slate-500 uppercase tracking-tighter">Gambar Success
                            Story</label>
                        <input name="success_image" type="file" accept="image/*"
                            class="w-full bg-surface-container-low border-none focus:ring-2 focus:ring-primary rounded-xl px-4 py-3">
                        <div class="mt-3 h-40 overflow-hidden rounded-xl bg-slate-100">
                            <img class="h-full w-full object-cover" src="{{ $successImage }}"
                                alt="Success story image preview">
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-slate-500 uppercase tracking-tighter">Main Title</label>
                        <textarea name="hero_title"
                            class="w-full bg-surface-container-low border-none focus:ring-2 focus:ring-primary rounded-xl px-4 py-3 font-bold text-xl text-primary leading-tight"
                            rows="2">{{ $homepage->hero_title ?? 'Membentuk Generasi Unggul Berkarakter & Berdaya Saing Global' }}</textarea>
                    </div>
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-slate-500 uppercase tracking-tighter">Subtitle</label>
                        <textarea name="hero_subtitle"
                            class="w-full bg-surface-container-low border-none focus:ring-2 focus:ring-primary rounded-xl px-4 py-3 text-on-surface-variant leading-relaxed"
                            rows="3">{{ $homepage->hero_subtitle ?? 'Pusat pendidikan menengah terbaik di Provinsi Riau.' }}</textarea>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-xs font-bold text-slate-500 uppercase tracking-tighter">Button 1 Text &
                                Link</label>
                            <div class="flex gap-2">
                                <input name="hero_button1_text"
                                    class="flex-1 bg-surface-container-low border-none focus:ring-2 focus:ring-primary rounded-xl px-4 py-2 text-sm"
                                    type="text" value="{{ $homepage->hero_button1_text ?? 'Mulai Daftar' }}" />
                                <input name="hero_button1_link"
                                    class="w-28 bg-surface-container-low border-none focus:ring-2 focus:ring-primary rounded-xl px-4 py-2 text-sm text-slate-400"
                                    type="text" value="{{ $homepage->hero_button1_link ?? '/pmb' }}" />
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label class="text-xs font-bold text-slate-500 uppercase tracking-tighter">URL Video Profil
                                YouTube</label>
                            <input name="hero_video_url"
                                class="w-full bg-surface-container-low border-none focus:ring-2 focus:ring-primary rounded-xl px-4 py-2 text-sm"
                                type="url" placeholder="https://www.youtube.com/watch?v=..."
                                value="{{ $homepage->hero_video_url ?? '' }}" />
                        </div>
                    </div>
                </div>

                <div class="col-span-12 lg:col-span-5 space-y-6">
                    <div
                        class="relative group/image h-[420px] rounded-2xl overflow-hidden bg-slate-200 border-4 border-white shadow-xl">
                        <img class="w-full h-full object-cover" src="{{ $heroImage }}" alt="Hero image preview" />
                        <div class="absolute inset-0 bg-primary/20 group-hover/image:bg-primary/10 transition-all">
                        </div>
                        <div
                            class="absolute inset-0 flex items-center justify-center opacity-0 group-hover/image:opacity-100 transition-opacity">
                            <label
                                class="bg-white/90 cursor-pointer px-6 py-3 rounded-full shadow-2xl font-bold text-primary flex items-center gap-2 hover:bg-white active:scale-95 transition-all">
                                <span class="material-symbols-outlined">image</span>
                                Replace Hero Image
                                <input name="hero_image" type="file" class="hidden" />
                            </label>
                        </div>
                    </div>
                    <div class="bg-tertiary-container/10 p-4 rounded-xl border-l-4 border-tertiary">
                        <p class="text-xs text-on-tertiary-container leading-relaxed">
                            <strong>Tips:</strong> Gunakan gambar landscape kualitas tinggi agar tampilan Hero maksimal.
                        </p>
                    </div>
                </div>
            </div>
        </details>

        <details id="tradisi-section" data-editor-panel
            class="hidden group bg-surface-container-lowest rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            <summary class="cursor-pointer list-none p-6 flex items-center justify-between gap-4">
                <div>
                    <span class="text-xs font-bold text-tertiary uppercase tracking-widest mb-1 block">Component
                        02</span>
                    <h3 class="text-2xl font-headline font-extrabold text-primary">Tradisi Keunggulan</h3>
                </div>
                <div class="flex items-center gap-3">
                    <button type="submit" data-save-editor
                        class="inline-flex items-center gap-2 rounded-xl bg-primary px-4 py-2 text-sm font-bold text-white hover:bg-primary-container transition-colors">
                        <span class="material-symbols-outlined text-[18px]">save</span>
                        Simpan
                    </button>
                    <button type="button" data-back-overview
                        class="inline-flex items-center gap-2 rounded-xl bg-slate-100 px-4 py-2 text-sm font-bold text-slate-600 hover:bg-slate-200 transition-colors">
                        <span class="material-symbols-outlined text-[18px]">arrow_back</span>
                        Kembali
                    </button>
                    <span
                        class="material-symbols-outlined text-slate-400 group-open:rotate-180 transition-transform">expand_more</span>
                </div>
            </summary>
            <div class="border-t border-slate-100 p-6 lg:p-8 space-y-8 bg-surface-container-low/40">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <input name="about_label"
                        class="bg-surface-container-lowest border-none rounded-xl px-4 py-3 font-bold"
                        placeholder="Label section" value="{{ $homepage->about_label ?? 'About SMAN Pintar' }}">
                    <input name="about_title"
                        class="bg-surface-container-lowest border-none rounded-xl px-4 py-3 font-bold"
                        placeholder="Judul section"
                        value="{{ $homepage->about_title ?? 'Tradisi Keunggulan, Masa Depan Gemilang' }}">
                    <textarea name="about_desc"
                        class="md:col-span-2 bg-surface-container-lowest border-none rounded-xl px-4 py-3" rows="3"
                        placeholder="Deskripsi tentang sekolah">{{ $homepage->about_desc ?? 'Didirikan sebagai pusat inkubasi talenta terbaik di Provinsi Riau, SMAN Pintar menerapkan sistem asrama terintegrasi yang fokus pada pembentukan karakter dan penguasaan sains teknologi.' }}</textarea>
                    <input name="accreditation_title"
                        class="bg-surface-container-lowest border-none rounded-xl px-4 py-3 font-bold"
                        placeholder="Judul akreditasi" value="{{ $homepage->accreditation_title ?? 'Akreditasi A' }}">
                    <input name="accreditation_desc"
                        class="bg-surface-container-lowest border-none rounded-xl px-4 py-3"
                        placeholder="Deskripsi akreditasi"
                        value="{{ $homepage->accreditation_desc ?? 'Sertifikasi Nasional & Internasional' }}">
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">
                    @for ($i = 0; $i < 4; $i++) <div
                        class="bg-surface-container-lowest p-6 rounded-2xl shadow-sm border border-slate-50 space-y-4">
                        <input name="tradisi[{{$i}}][title]"
                            class="w-full border-none p-0 focus:ring-0 font-bold text-primary bg-transparent text-lg"
                            type="text"
                            value="{{ data_get($homepage->tradisi, $i.'.title') ?? ($i == 0 ? 'Kurikulum' : ($i == 1 ? 'Boarding' : ($i == 2 ? 'Pembinaan' : 'Alumni'))) }}" />
                        <textarea name="tradisi[{{$i}}][desc]"
                            class="w-full border-none p-0 focus:ring-0 text-xs text-on-surface-variant bg-transparent resize-none"
                            rows="4">{{ data_get($homepage->tradisi, $i.'.desc') ?? 'Deskripsi konten keunggulan di sini...' }}</textarea>
                </div>
                @endfor
            </div>
            </div>
        </details>

        <details id="fasilitas-section" data-editor-panel
            class="hidden group bg-surface-container-lowest rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            <summary class="cursor-pointer list-none p-6 flex items-center justify-between gap-4">
                <div>
                    <span class="text-xs font-bold text-tertiary uppercase tracking-widest mb-1 block">Component
                        03</span>
                    <h3 class="text-2xl font-headline font-extrabold text-primary">Fasilitas & Ekosistem</h3>
                </div>
                <div class="flex items-center gap-3">
                    <button type="submit" data-save-editor
                        class="inline-flex items-center gap-2 rounded-xl bg-primary px-4 py-2 text-sm font-bold text-white hover:bg-primary-container transition-colors">
                        <span class="material-symbols-outlined text-[18px]">save</span>
                        Simpan
                    </button>
                    <button type="button" data-back-overview
                        class="inline-flex items-center gap-2 rounded-xl bg-slate-100 px-4 py-2 text-sm font-bold text-slate-600 hover:bg-slate-200 transition-colors">
                        <span class="material-symbols-outlined text-[18px]">arrow_back</span>
                        Kembali
                    </button>
                    <span
                        class="material-symbols-outlined text-slate-400 group-open:rotate-180 transition-transform">expand_more</span>
                </div>
            </summary>
            <div class="border-t border-slate-100 p-6 lg:p-8 space-y-8 bg-surface-container-low/40">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <input name="facilities_title"
                        class="bg-surface-container-lowest border-none rounded-xl px-4 py-3 font-bold"
                        placeholder="Judul fasilitas"
                        value="{{ $homepage->facilities_title ?? 'Fasilitas & Ekosistem' }}">
                    <textarea name="facilities_subtitle"
                        class="bg-surface-container-lowest border-none rounded-xl px-4 py-3 md:row-span-2" rows="3"
                        placeholder="Subjudul fasilitas">{{ $homepage->facilities_subtitle ?? 'Kami menyediakan infrastruktur terbaik untuk mendukung setiap langkah eksplorasi siswa.' }}</textarea>
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-slate-500 uppercase tracking-tighter">Gambar Fasilitas
                            Utama</label>
                        <input name="facility_main_image" type="file"
                            class="w-full bg-surface-container-lowest border-none rounded-xl px-4 py-3">
                    </div>
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-slate-500 uppercase tracking-tighter">Gambar Fasilitas
                            Kecil</label>
                        <input name="facility_side_image" type="file"
                            class="w-full bg-surface-container-lowest border-none rounded-xl px-4 py-3">
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">
                    @for ($i = 0; $i < 4; $i++) <div
                        class="bg-surface-container-lowest p-6 rounded-2xl shadow-sm border border-slate-50 space-y-4">
                        <div class="space-y-2">
                            <label class="text-xs font-bold text-slate-500 uppercase tracking-tighter">Icon</label>
                            <input name="fasilitas[{{$i}}][icon]"
                                class="w-full border-none focus:ring-2 focus:ring-primary rounded-xl px-4 py-2 bg-surface-container-low text-sm"
                                type="text"
                                value="{{ data_get($homepage->fasilitas, $i.'.icon') ?? $defaultFasilitas[$i]['icon'] }}" />
                        </div>
                        <input name="fasilitas[{{$i}}][title]"
                            class="w-full border-none p-0 focus:ring-0 font-bold text-primary bg-transparent text-lg"
                            type="text"
                            value="{{ data_get($homepage->fasilitas, $i.'.title') ?? $defaultFasilitas[$i]['title'] }}" />
                        <textarea name="fasilitas[{{$i}}][desc]"
                            class="w-full border-none p-0 focus:ring-0 text-xs text-on-surface-variant bg-transparent resize-none"
                            rows="4">{{ data_get($homepage->fasilitas, $i.'.desc') ?? $defaultFasilitas[$i]['desc'] }}</textarea>
                </div>
                @endfor
            </div>
            </div>
        </details>

        <details id="warta-section" data-editor-panel
            class="hidden group bg-surface-container-lowest rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            <summary class="cursor-pointer list-none p-6 flex items-center justify-between gap-4">
                <div>
                    <span class="text-xs font-bold text-tertiary uppercase tracking-widest mb-1 block">Component
                        04</span>
                    <h3 class="text-2xl font-headline font-extrabold text-primary">Warta & Alumni Section</h3>
                </div>
                <div class="flex items-center gap-3">
                    <button type="submit" data-save-editor
                        class="inline-flex items-center gap-2 rounded-xl bg-primary px-4 py-2 text-sm font-bold text-white hover:bg-primary-container transition-colors">
                        <span class="material-symbols-outlined text-[18px]">save</span>
                        Simpan
                    </button>
                    <button type="button" data-back-overview
                        class="inline-flex items-center gap-2 rounded-xl bg-slate-100 px-4 py-2 text-sm font-bold text-slate-600 hover:bg-slate-200 transition-colors">
                        <span class="material-symbols-outlined text-[18px]">arrow_back</span>
                        Kembali
                    </button>
                    <span
                        class="material-symbols-outlined text-slate-400 group-open:rotate-180 transition-transform">expand_more</span>
                </div>
            </summary>
            <div
                class="border-t border-slate-100 p-6 lg:p-8 grid grid-cols-1 md:grid-cols-2 gap-8 bg-surface-container-low/40">
                <div class="md:col-span-2 bg-surface-container-lowest p-8 rounded-2xl shadow-sm space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <input name="news_title"
                            class="bg-surface-container-low border-none rounded-xl px-4 py-3 font-bold"
                            placeholder="Judul berita" value="{{ $homepage->news_title ?? 'Warta SMAN Pintar' }}">
                        <input name="news_button_text" class="bg-surface-container-low border-none rounded-xl px-4 py-3"
                            placeholder="Teks tombol berita"
                            value="{{ $homepage->news_button_text ?? 'Semua Berita' }}">
                        <textarea name="news_subtitle"
                            class="bg-surface-container-low border-none rounded-xl px-4 py-3 md:col-span-2" rows="2"
                            placeholder="Subjudul berita">{{ $homepage->news_subtitle ?? 'Update terbaru seputar kegiatan dan prestasi sekolah.' }}</textarea>
                        <input name="alumni_label" class="bg-surface-container-low border-none rounded-xl px-4 py-3"
                            placeholder="Label alumni" value="{{ $homepage->alumni_label ?? 'Our Alumni' }}">
                        <input name="alumni_title"
                            class="bg-surface-container-low border-none rounded-xl px-4 py-3 font-bold"
                            placeholder="Judul alumni"
                            value="{{ $homepage->alumni_title ?? 'Jejak Langkah Kesuksesan' }}">
                    </div>
                </div>

                <div class="bg-surface-container-lowest p-8 rounded-2xl shadow-sm space-y-6">
                    <h4 class="text-xl font-bold text-on-surface">Limit Berita</h4>
                    <select name="news_limit"
                        class="w-full bg-surface-container-low border-none rounded-xl px-4 py-3 font-medium">
                        <option value="3" {{ ($homepage->news_limit ?? 3) == 3 ? 'selected' : '' }}>3 Items
                            (Rekomendasi)</option>
                        <option value="4" {{ ($homepage->news_limit ?? 3) == 4 ? 'selected' : '' }}>4 Items</option>
                        <option value="6" {{ ($homepage->news_limit ?? 3) == 6 ? 'selected' : '' }}>6 Items</option>
                    </select>
                </div>

                <div class="bg-surface-container-lowest p-8 rounded-2xl shadow-sm space-y-6">
                    <h4 class="text-xl font-bold text-on-surface">Featured Alumni</h4>
                    <select name="featured_alumni_id"
                        class="w-full bg-surface-container-low border-none rounded-xl px-4 py-3 font-medium">
                        <option value="">Pilih Alumni untuk Highlight</option>
                        @foreach ($alumni as $item)
                        <option value="{{ $item->id }}"
                            {{ ($homepage->featured_alumni_id ?? '') == $item->id ? 'selected' : '' }}>
                            {{ $item->nama }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </details>

        <details id="cta-section" data-editor-panel
            class="hidden group bg-surface-container-lowest rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            <summary class="cursor-pointer list-none p-6 flex items-center justify-between gap-4">
                <div>
                    <span class="text-xs font-bold text-tertiary uppercase tracking-widest mb-1 block">Component
                        05</span>
                    <h3 class="text-2xl font-headline font-extrabold text-primary">CTA PMB Section</h3>
                </div>
                <div class="flex items-center gap-3">
                    <button type="submit" data-save-editor
                        class="inline-flex items-center gap-2 rounded-xl bg-primary px-4 py-2 text-sm font-bold text-white hover:bg-primary-container transition-colors">
                        <span class="material-symbols-outlined text-[18px]">save</span>
                        Simpan
                    </button>
                    <button type="button" data-back-overview
                        class="inline-flex items-center gap-2 rounded-xl bg-slate-100 px-4 py-2 text-sm font-bold text-slate-600 hover:bg-slate-200 transition-colors">
                        <span class="material-symbols-outlined text-[18px]">arrow_back</span>
                        Kembali
                    </button>
                    <span
                        class="material-symbols-outlined text-slate-400 group-open:rotate-180 transition-transform">expand_more</span>
                </div>
            </summary>
            <div class="border-t border-slate-100 p-6 lg:p-8 bg-surface-container-low/40">
                <div class="bg-surface-container-lowest p-8 rounded-2xl shadow-sm space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <input name="cta_title"
                            class="bg-surface-container-low border-none rounded-xl px-4 py-3 font-bold"
                            placeholder="Judul CTA"
                            value="{{ $homepage->cta_title ?? 'Jadilah Bagian dari SMAN Pintar' }}">
                        <input name="cta_year" class="bg-surface-container-low border-none rounded-xl px-4 py-3"
                            placeholder="Tahun" value="{{ $homepage->cta_year ?? '2025' }}">
                        <input name="cta_button" class="bg-surface-container-low border-none rounded-xl px-4 py-3"
                            placeholder="Teks Tombol" value="{{ $homepage->cta_button ?? 'Daftar Sekarang' }}">
                        <input name="cta_secondary_button"
                            class="bg-surface-container-low border-none rounded-xl px-4 py-3"
                            placeholder="Teks Tombol Kedua"
                            value="{{ $homepage->cta_secondary_button ?? 'Panduan Pendaftaran' }}">
                        <input name="cta_secondary_link"
                            class="bg-surface-container-low border-none rounded-xl px-4 py-3"
                            placeholder="Link Tombol Kedua" value="{{ $homepage->cta_secondary_link ?? route('pmb') }}">
                        <input name="cta_badge" class="bg-surface-container-low border-none rounded-xl px-4 py-3"
                            placeholder="Label tahun" value="{{ $homepage->cta_badge ?? 'Batch Admission' }}">
                        <input name="cta_deadline_label"
                            class="bg-surface-container-low border-none rounded-xl px-4 py-3"
                            placeholder="Label countdown"
                            value="{{ $homepage->cta_deadline_label ?? 'Pendaftaran Berakhir Dalam' }}">
                        <input name="cta_countdown_days"
                            class="bg-surface-container-low border-none rounded-xl px-4 py-3" placeholder="Hari"
                            value="{{ $homepage->cta_countdown_days ?? '14' }}">
                        <input name="cta_countdown_hours"
                            class="bg-surface-container-low border-none rounded-xl px-4 py-3" placeholder="Jam"
                            value="{{ $homepage->cta_countdown_hours ?? '08' }}">
                        <textarea name="cta_desc"
                            class="bg-surface-container-low border-none rounded-xl px-4 py-3 col-span-1 md:col-span-2"
                            placeholder="Deskripsi Singkat"
                            rows="3">{{ $homepage->cta_desc ?? 'Daftarkan diri Anda hari ini...' }}</textarea>
                    </div>
                </div>
            </div>
        </details>

        <details id="footer-section" data-editor-panel
            class="hidden group bg-surface-container-lowest rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            <summary class="cursor-pointer list-none p-6 flex items-center justify-between gap-4">
                <div>
                    <span class="text-xs font-bold text-tertiary uppercase tracking-widest mb-1 block">Component
                        06</span>
                    <h3 class="text-2xl font-headline font-extrabold text-primary">Footer Website</h3>
                </div>
                <div class="flex items-center gap-3">
                    <button type="submit" data-save-editor
                        class="inline-flex items-center gap-2 rounded-xl bg-primary px-4 py-2 text-sm font-bold text-white hover:bg-primary-container transition-colors">
                        <span class="material-symbols-outlined text-[18px]">save</span>
                        Simpan
                    </button>
                    <button type="button" data-back-overview
                        class="inline-flex items-center gap-2 rounded-xl bg-slate-100 px-4 py-2 text-sm font-bold text-slate-600 hover:bg-slate-200 transition-colors">
                        <span class="material-symbols-outlined text-[18px]">arrow_back</span>
                        Kembali
                    </button>
                    <span
                        class="material-symbols-outlined text-slate-400 group-open:rotate-180 transition-transform">expand_more</span>
                </div>
            </summary>
            <div class="border-t border-slate-100 p-6 lg:p-8 bg-surface-container-low/40">
                <div class="bg-surface-container-lowest p-8 rounded-2xl shadow-sm space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <textarea name="footer_desc"
                            class="bg-surface-container-low border-none rounded-xl px-4 py-3 md:col-span-2" rows="2"
                            placeholder="Deskripsi footer">{{ $homepage->footer_desc ?? 'Mewujudkan pendidikan menengah berkualitas dunia di bumi Lancang Kuning, Provinsi Riau.' }}</textarea>
                        <input name="footer_address" class="bg-surface-container-low border-none rounded-xl px-4 py-3"
                            placeholder="Alamat"
                            value="{{ $homepage->footer_address ?? 'Jl. Pendidikan No. 01, Pekanbaru, Provinsi Riau' }}">
                        <input name="footer_phone" class="bg-surface-container-low border-none rounded-xl px-4 py-3"
                            placeholder="Telepon" value="{{ $homepage->footer_phone ?? '(0761) 1234567' }}">
                        <textarea name="newsletter_desc"
                            class="bg-surface-container-low border-none rounded-xl px-4 py-3 md:col-span-2" rows="2"
                            placeholder="Deskripsi newsletter">{{ $homepage->newsletter_desc ?? 'Dapatkan info pendaftaran dan prestasi terbaru langsung di email Anda.' }}</textarea>
                        <input name="footer_copyright" class="bg-surface-container-low border-none rounded-xl px-4 py-3"
                            placeholder="Copyright"
                            value="{{ $homepage->footer_copyright ?? 'SMAN Pintar. Excellence in Education.' }}">
                        <input name="footer_note" class="bg-surface-container-low border-none rounded-xl px-4 py-3"
                            placeholder="Catatan footer"
                            value="{{ $homepage->footer_note ?? 'Made with Passion in Riau' }}">
                    </div>
                </div>
            </div>
        </details>

        <div
            class="editor-actions bg-surface-container-lowest rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] px-8 py-6">
            <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end sm:items-center">
                <button type="button" data-back-overview
                    class="px-6 py-3 rounded-xl font-bold text-slate-500 hover:bg-slate-100 transition-colors">
                    Batal
                </button>
                <button type="submit"
                    class="bg-primary text-on-primary px-8 py-3 rounded-xl font-bold shadow-lg hover:scale-105 transition-all">
                    Simpan Beranda
                </button>
            </div>
        </div>
    </section>
</form>

<script>
const overview = document.getElementById('component-overview');
const editors = document.getElementById('component-editors');
const panels = document.querySelectorAll('[data-editor-panel]');

function showOverview() {
    editors.classList.add('hidden');
    overview.classList.remove('hidden');
    panels.forEach((panel) => panel.classList.add('hidden'));
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
}

function showEditor(panelId) {
    const target = document.getElementById(panelId);

    if (!target) {
        return;
    }

    overview.classList.add('hidden');
    editors.classList.remove('hidden');
    panels.forEach((panel) => panel.classList.add('hidden'));
    target.classList.remove('hidden');
    target.open = true;
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
}

document.querySelectorAll('[data-edit-target]').forEach((link) => {
    link.addEventListener('click', (event) => {
        event.preventDefault();
        showEditor(link.dataset.editTarget);
    });
});

document.querySelectorAll('[data-back-overview]').forEach((button) => {
    button.addEventListener('click', (event) => {
        event.preventDefault();
        event.stopPropagation();
        showOverview();
    });
});

document.querySelectorAll('[data-save-editor]').forEach((button) => {
    button.addEventListener('click', (event) => {
        event.stopPropagation();
    });
});
</script>
@endsection