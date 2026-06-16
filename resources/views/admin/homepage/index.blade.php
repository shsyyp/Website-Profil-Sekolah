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

$allFacilities = collect($about->facilities ?? [])
->filter(fn ($facility) => filled($facility['title'] ?? null))
->values();

$selectedFacilityIndexes = collect($homepage->fasilitas ?? [0, 1, 2, 3])
->map(fn ($index) => (int) $index)
->filter(fn ($index) => $allFacilities->has($index))
->unique()
->take(4)
->values();

$sharedFacilities = $selectedFacilityIndexes->isNotEmpty()
? $selectedFacilityIndexes->map(fn ($index) => $allFacilities->get($index))->values()
: $allFacilities->take(4)->values();

$tradisiTitles = collect(range(0, 3))
->map(fn ($i) => data_get($homepage->tradisi, $i . '.title') ?? ($i == 0 ? 'Kurikulum' : ($i == 1 ? 'Boarding' : ($i ==
2 ? 'Pembinaan' : 'Alumni'))))
->implode(', ');

$facilityTitles = collect(range(0, 3))
->map(fn ($i) => data_get($sharedFacilities, $i . '.title') ?? $defaultFasilitas[$i]['title'])
->implode(', ');

$selectedAlumniIds = collect($homepage->selected_alumni_ids ?? ($homepage->featured_alumni_id ? [$homepage->featured_alumni_id] : []))
->map(fn ($id) => (int) $id)
->filter(fn ($id) => $alumni->contains('id', $id))
->unique()
->take(3)
->values();

$selectedAlumniNames = $selectedAlumniIds->isNotEmpty()
? $selectedAlumniIds->map(fn ($id) => optional($alumni->firstWhere('id', $id))->nama)->filter()->implode(', ')
: 'Belum dipilih';

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
'title' => 'Keunggulan',
'content' => $homepage->about_title ?? 'Keunggulan, Masa Depan Gemilang',
'meta' => $tradisiTitles,
],
[
'id' => 'fasilitas-section',
'preview' => $facilityImage ? 'image' : 'icon',
'image' => $facilityImage,
'icon' => 'domain',
'title' => 'Fasilitas',
'content' => $homepage->facilities_title ?? 'Fasilitas',
'meta' => $facilityTitles,
],
[
'id' => 'berita-section',
'preview' => 'icon',
'icon' => 'newspaper',
'title' => 'Berita',
'content' => str_replace('Warta', 'Berita', $homepage->news_title ?? 'Berita SMAN Pintar'),
'meta' => 'Limit berita: ' . ($homepage->news_limit ?? 3) . ' item',
],
[
'id' => 'alumni-section',
'preview' => 'icon',
'icon' => 'groups',
'title' => 'Alumni',
'content' => $homepage->alumni_title ?? 'Jejak Langkah Kesuksesan',
'meta' => $selectedAlumniNames,
],
[
'id' => 'cta-section',
'preview' => 'icon',
'icon' => 'campaign',
'title' => 'PMB',
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
#component-editors summary [data-save-editor],
#component-editors summary .group-open\:rotate-180 {
    display: none;
}

#component-editors .editor-actions {
    border-top: 1px solid rgb(226 232 240);
}

#component-editors[data-active-panel="footer-section"] .editor-actions {
    display: none;
}
</style>

<form action="{{ url('admin/homepage') }}" method="POST" enctype="multipart/form-data" class="px-8 pb-8 pt-0 space-y-10">
    @csrf
    <input type="hidden" name="active_panel" id="activePanelInput" value="">

    @if(session('success'))
    <div
        class="bg-emerald-50 text-emerald-600 p-4 rounded-xl font-bold flex items-center gap-2 shadow-sm border border-emerald-100">
        <span class="material-symbols-outlined">check_circle</span>
        {{ session('success') }}
    </div>
    @endif

    <div id="component-overview" class="space-y-10">
        <section>
            <h2 class="text-4xl font-extrabold text-primary tracking-tight font-headline">Beranda</h2>
        </section>

        <section class="bg-surface-container-lowest rounded-2xl overflow-hidden shadow-[0_8px_30px_rgb(0,0,0,0.04)]">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-surface-container-low/50">
                            <th class="px-8 py-5 text-[11px] font-bold text-slate-400 uppercase tracking-widest">No</th>
                            <th class="px-6 py-5 text-[11px] font-bold text-slate-400 uppercase tracking-widest">
                                Komponen</th>
                            <th class="px-6 py-5 text-[11px] font-bold text-slate-400 uppercase tracking-widest">
                                Deskripsi</th>
                            <th
                                class="px-8 py-5 text-[11px] font-bold text-slate-400 uppercase tracking-widest text-right">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-surface-container">
                        @foreach ($components as $component)
                        <tr class="group hover:bg-surface-container-low/30 transition-colors">
                            <td class="px-8 py-4">
                                <span
                                    class="inline-flex h-8 w-8 items-center justify-center rounded-lg bg-blue-50 text-sm font-bold text-primary">
                                    {{ $loop->iteration }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <p class="font-bold text-blue-900 group-hover:text-primary transition-colors">
                                    {{ $component['title'] }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <p
                                    class="max-w-xl text-sm text-on-surface-variant font-medium leading-relaxed line-clamp-2">
                                    {{ $component['content'] }}</p>
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
            <div class="border-t border-slate-100 p-6 lg:p-8 space-y-8">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <div class="space-y-6">
                        <div>
                            <label>Judul Utama</label>
                            <textarea name="hero_title" rows="2"
                                placeholder="Contoh: Membentuk Generasi Berkarakter dan Berilmu">{{ $homepage->hero_title ?? 'Membentuk Generasi Unggul Berkarakter & Berdaya Saing Global' }}</textarea>
                        </div>
                        <div>
                            <label>Deskripsi Singkat</label>
                            <textarea name="hero_subtitle" rows="4"
                                placeholder="Tuliskan kalimat singkat tentang keunggulan sekolah.">{{ $homepage->hero_subtitle ?? 'Pusat pendidikan menengah terbaik di Provinsi Riau.' }}</textarea>
                        </div>
                        <div>
                            <label>Gambar Utama</label>
                            <input name="hero_image" type="file" accept="image/*">
                            <p class="mt-2 text-xs text-on-surface-variant">Gunakan gambar landscape yang jelas. Biarkan kosong jika tidak ingin mengganti gambar.</p>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div class="overflow-hidden rounded-2xl bg-slate-100 shadow-sm">
                            <img class="h-80 w-full object-cover" src="{{ $heroImage }}" alt="Preview gambar utama">
                        </div>
                    </div>
                </div>

                <div class="border-t border-surface-container pt-8">
                    <h4 class="mb-5 text-lg font-bold text-primary font-headline">Sorotan</h4>
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <div class="space-y-6">
                            <div>
                                <label>Judul Sorotan</label>
                                <input name="success_title" type="text"
                                    value="{{ $homepage->success_title ?? 'Mencetak 500+ Alumni di Universitas Terbaik Dunia' }}"
                                    placeholder="Contoh: Mengukir Prestasi, Menjaga Karakter">
                            </div>
                            <div>
                                <label>Deskripsi Sorotan</label>
                                <textarea name="success_desc" rows="3"
                                    placeholder="Tuliskan satu atau dua kalimat singkat.">{{ $homepage->success_desc ?? 'Cerita sukses siswa dan alumni SMAN Pintar Provinsi Riau.' }}</textarea>
                            </div>
                            <div>
                                <label>Gambar Sorotan</label>
                                <input name="success_image" type="file" accept="image/*">
                                <p class="mt-2 text-xs text-on-surface-variant">Biarkan kosong jika tidak ingin mengganti gambar.</p>
                            </div>
                        </div>
                        <div class="overflow-hidden rounded-2xl bg-slate-100 shadow-sm">
                            <img class="h-64 w-full object-cover" src="{{ $successImage }}" alt="Preview gambar sorotan">
                        </div>
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
                    <h3 class="text-2xl font-headline font-extrabold text-primary">Keunggulan</h3>
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
            <div class="border-t border-slate-100 p-6 lg:p-8 space-y-8">
                <input type="hidden" name="about_label" value="{{ $homepage->about_label ?? 'Tentang SMAN Pintar' }}">

                <div class="space-y-6">
                    <div>
                        <label>Judul Bagian</label>
                        <input name="about_title" type="text"
                            value="{{ $homepage->about_title ?? 'Keunggulan, Masa Depan Gemilang' }}"
                            placeholder="Contoh: Karakter Kuat, Ilmu Berdaya">
                    </div>
                    <div>
                        <label>Akreditasi</label>
                        <input name="accreditation_title" type="text"
                            value="{{ $homepage->accreditation_title ?? 'Akreditasi A' }}"
                            placeholder="Contoh: Akreditasi A">
                    </div>
                    <div class="lg:col-span-2">
                        <label>Deskripsi Singkat</label>
                        <textarea name="about_desc" rows="4"
                            placeholder="Tuliskan penjelasan singkat tentang keunggulan sekolah.">{{ $homepage->about_desc ?? 'Didirikan sebagai pusat inkubasi talenta terbaik di Provinsi Riau, SMAN Pintar menerapkan sistem asrama terintegrasi yang fokus pada pembentukan karakter dan penguasaan sains teknologi.' }}</textarea>
                    </div>
                    <div class="lg:col-span-2">
                        <label>Keterangan Akreditasi</label>
                        <input name="accreditation_desc" type="text"
                            value="{{ $homepage->accreditation_desc ?? 'Sertifikasi Nasional & Internasional' }}"
                            placeholder="Contoh: Sekolah unggulan berstandar nasional">
                    </div>
                </div>

                <div class="border-t border-surface-container pt-8">
                    <h4 class="mb-5 text-lg font-bold text-primary font-headline">Daftar Keunggulan</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @for ($i = 0; $i < 4; $i++)
                        <div class="bg-surface-container-lowest p-6 rounded-2xl shadow-sm border border-slate-100 space-y-5">
                            <div>
                                <label>Judul Keunggulan {{ $i + 1 }}</label>
                                <input name="tradisi[{{$i}}][title]" type="text"
                                    value="{{ data_get($homepage->tradisi, $i.'.title') ?? ($i == 0 ? 'Kurikulum' : ($i == 1 ? 'Boarding' : ($i == 2 ? 'Pembinaan' : 'Alumni'))) }}"
                                    placeholder="Contoh: Kurikulum">
                            </div>
                            <div>
                                <label>Deskripsi Keunggulan {{ $i + 1 }}</label>
                                <textarea name="tradisi[{{$i}}][desc]" rows="5"
                                    placeholder="Tuliskan penjelasan singkat untuk keunggulan ini.">{{ data_get($homepage->tradisi, $i.'.desc') ?? 'Deskripsi konten keunggulan di sini...' }}</textarea>
                            </div>
                        </div>
                        @endfor
                    </div>
                </div>
            </div>
        </details>

        <details id="fasilitas-section" data-editor-panel
            class="hidden group bg-surface-container-lowest rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            <summary class="cursor-pointer list-none p-6 flex items-center justify-between gap-4">
                <div>
                    <span class="text-xs font-bold text-tertiary uppercase tracking-widest mb-1 block">Component
                        03</span>
                    <h3 class="text-2xl font-headline font-extrabold text-primary">Fasilitas</h3>
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
            <div class="border-t border-slate-100 p-6 lg:p-8 space-y-8">
                <div class="space-y-6">
                    <div>
                        <label>Judul Bagian</label>
                        <input name="facilities_title" type="text"
                            value="{{ $homepage->facilities_title ?? 'Fasilitas' }}"
                            placeholder="Contoh: Fasilitas">
                    </div>
                    <div>
                        <label>Deskripsi Singkat</label>
                        <textarea name="facilities_subtitle" rows="4"
                            placeholder="Tuliskan penjelasan singkat tentang fasilitas sekolah.">{{ $homepage->facilities_subtitle ?? 'Kami menyediakan infrastruktur terbaik untuk mendukung setiap langkah eksplorasi siswa.' }}</textarea>
                    </div>
                </div>

                <div class="border-t border-surface-container pt-8">
                    <div class="mb-5">
                        <h4 class="text-lg font-bold text-primary font-headline">Fasilitas</h4>
                    </div>
                    @if($allFacilities->isNotEmpty())
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @for ($slot = 0; $slot < 4; $slot++)
                        @php
                            $selectedIndex = $selectedFacilityIndexes->get($slot, $slot);
                        @endphp
                        <div>
                            <label>Fasilitas {{ $slot + 1 }}</label>
                            <div class="relative">
                                <select name="fasilitas[]"
                                    class="appearance-none pr-12">
                                    <option value="">Tidak ditampilkan</option>
                                    @foreach ($allFacilities as $i => $facility)
                                    <option value="{{ $i }}" {{ $selectedIndex === $i ? 'selected' : '' }}>
                                        {{ data_get($facility, 'title') }}
                                    </option>
                                    @endforeach
                                </select>
                                <span
                                    class="pointer-events-none material-symbols-outlined absolute right-4 top-1/2 -translate-y-1/2 text-slate-500">
                                    expand_more
                                </span>
                            </div>
                        </div>
                        @endfor
                    </div>
                    @else
                    <div class="rounded-2xl border border-dashed border-slate-200 bg-slate-50 p-6 text-sm text-on-surface-variant">
                        Belum ada data fasilitas. Tambahkan fasilitas terlebih dahulu di menu Tentang Kami.
                    </div>
                    @endif
                </div>
            </div>
        </details>

        <details id="berita-section" data-editor-panel
            class="hidden group bg-surface-container-lowest rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            <summary class="cursor-pointer list-none p-6 flex items-center justify-between gap-4">
                <div>
                    <span class="text-xs font-bold text-tertiary uppercase tracking-widest mb-1 block">Component
                        04</span>
                    <h3 class="text-2xl font-headline font-extrabold text-primary">Berita</h3>
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
            <div class="border-t border-slate-100 p-6 lg:p-8 space-y-8">
                <input type="hidden" name="news_button_text" value="{{ $homepage->news_button_text ?? 'Semua Berita' }}">

                <div class="space-y-6">
                    <div>
                        <label>Judul Berita</label>
                        <input name="news_title" type="text"
                            placeholder="Contoh: Berita SMAN Pintar"
                            value="{{ str_replace('Warta', 'Berita', $homepage->news_title ?? 'Berita SMAN Pintar') }}">
                    </div>
                    <div>
                        <label>Deskripsi Berita</label>
                        <textarea name="news_subtitle" rows="4"
                            placeholder="Tuliskan penjelasan singkat tentang berita sekolah.">{{ $homepage->news_subtitle ?? 'Update terbaru seputar kegiatan dan prestasi sekolah.' }}</textarea>
                    </div>
                </div>

                <div class="border-t border-surface-container pt-8">
                    <h4 class="mb-5 text-lg font-bold text-primary font-headline">Pengaturan Tampilan</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label>Jumlah Berita</label>
                            <div class="relative">
                                <select name="news_limit" class="appearance-none pr-12">
                                    <option value="3" {{ ($homepage->news_limit ?? 3) == 3 ? 'selected' : '' }}>3 Berita</option>
                                    <option value="4" {{ ($homepage->news_limit ?? 3) == 4 ? 'selected' : '' }}>4 Berita</option>
                                    <option value="6" {{ ($homepage->news_limit ?? 3) == 6 ? 'selected' : '' }}>6 Berita</option>
                                </select>
                                <span class="pointer-events-none material-symbols-outlined absolute right-4 top-1/2 -translate-y-1/2 text-slate-500">expand_more</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </details>

        <details id="alumni-section" data-editor-panel
            class="hidden group bg-surface-container-lowest rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            <summary class="cursor-pointer list-none p-6 flex items-center justify-between gap-4">
                <div>
                    <span class="text-xs font-bold text-tertiary uppercase tracking-widest mb-1 block">Component
                        05</span>
                    <h3 class="text-2xl font-headline font-extrabold text-primary">Alumni</h3>
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
            <div class="border-t border-slate-100 p-6 lg:p-8 space-y-8">
                <div class="space-y-6">
                    <div>
                        <label>Label Alumni</label>
                        <input name="alumni_label" type="text"
                            placeholder="Contoh: Alumni"
                            value="{{ str_replace('Our Alumni', 'Alumni', $homepage->alumni_label ?? 'Alumni') }}">
                    </div>
                    <div>
                        <label>Judul Alumni</label>
                        <input name="alumni_title" type="text"
                            placeholder="Contoh: Jejak Langkah Kesuksesan"
                            value="{{ $homepage->alumni_title ?? 'Jejak Langkah Kesuksesan' }}">
                    </div>
                </div>

                <div class="border-t border-surface-container pt-8">
                    <h4 class="mb-5 text-lg font-bold text-primary font-headline">Pilihan Alumni</h4>
                    @if($alumni->isNotEmpty())
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        @for ($slot = 0; $slot < 3; $slot++)
                        @php
                            $selectedAlumniId = $selectedAlumniIds->get($slot);
                        @endphp
                        <div>
                            <label>Alumni {{ $slot + 1 }}</label>
                            <div class="relative">
                                <select name="selected_alumni_ids[]" class="appearance-none pr-12">
                                    <option value="">Tidak ditampilkan</option>
                                    @foreach ($alumni as $item)
                                    <option value="{{ $item->id }}"
                                        {{ $selectedAlumniId === $item->id ? 'selected' : '' }}>
                                        {{ $item->nama }}{{ $item->tahun_lulus ? ' - ' . $item->tahun_lulus : '' }}
                                    </option>
                                    @endforeach
                                </select>
                                <span class="pointer-events-none material-symbols-outlined absolute right-4 top-1/2 -translate-y-1/2 text-slate-500">expand_more</span>
                            </div>
                        </div>
                        @endfor
                    </div>
                    @else
                    <div class="rounded-2xl border border-dashed border-slate-200 bg-slate-50 p-6 text-sm text-on-surface-variant">
                        Belum ada data alumni aktif. Tambahkan alumni terlebih dahulu di menu Alumni.
                    </div>
                    @endif
                </div>
            </div>
        </details>

        <details id="cta-section" data-editor-panel
            class="hidden group bg-surface-container-lowest rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            <summary class="cursor-pointer list-none p-6 flex items-center justify-between gap-4">
                <div>
                    <span class="text-xs font-bold text-tertiary uppercase tracking-widest mb-1 block">Component
                        06</span>
                    <h3 class="text-2xl font-headline font-extrabold text-primary">PMB</h3>
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
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label>Tahun PMB</label>
                            <input name="cta_year" placeholder="Contoh: 2026"
                                value="{{ $homepage->cta_year ?? '2025' }}">
                        </div>
                        <div>
                            <label>Batas Waktu Pendaftaran</label>
                            <input name="cta_deadline_at" type="datetime-local"
                                value="{{ $homepage->cta_deadline_at ? $homepage->cta_deadline_at->format('Y-m-d\TH:i') : now()->addDays((int) ($homepage->cta_countdown_days ?? 14))->addHours((int) ($homepage->cta_countdown_hours ?? 8))->format('Y-m-d\TH:i') }}">
                        </div>
                    </div>
                    <div>
                        <input type="hidden" name="cta_is_active" value="0">
                        <label class="inline-flex items-center gap-3 normal-case tracking-normal text-on-surface">
                            <input type="checkbox" name="cta_is_active" value="1"
                                class="h-5 w-5 rounded border-outline-variant bg-surface-container-low text-primary focus:ring-primary"
                                @checked((bool) ($homepage->cta_is_active ?? true))>
                            <span class="text-sm font-medium text-on-surface-variant">Aktif di Website</span>
                        </label>
                    </div>
                </div>
            </div>
        </details>

        <details id="footer-section" data-editor-panel
            class="hidden group bg-surface-container-lowest rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            <summary class="cursor-pointer list-none p-6 flex items-center justify-between gap-4">
                <div>
                    <span class="text-xs font-bold text-tertiary uppercase tracking-widest mb-1 block">Component
                        07</span>
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
            <div class="border-t border-slate-100 p-6 lg:p-8 space-y-8">
                <div>
                    <label>Nama Sekolah</label>
                    <input name="site_name" placeholder="Contoh: SMAN Pintar"
                        value="{{ $homepage->site_name ?? 'SMAN Pintar' }}">
                </div>

                <div>
                    <label>Deskripsi Singkat Sekolah</label>
                    <textarea name="footer_desc" rows="4"
                        placeholder="Contoh: Mewujudkan pendidikan menengah berkualitas melalui pembinaan karakter dan ilmu.">{{ $homepage->footer_desc ?? 'Mewujudkan pendidikan menengah berkualitas melalui pembinaan karakter, penguatan ilmu, dan lingkungan belajar yang inspiratif.' }}</textarea>
                </div>

                <div>
                    <label>Link WhatsApp</label>
                    <input name="footer_whatsapp_url" placeholder="Contoh: https://wa.me/6281234567890"
                        value="{{ $homepage->footer_whatsapp_url ?? '' }}">
                </div>

                <div>
                    <label>Link Instagram</label>
                    <input name="footer_instagram_url" placeholder="Contoh: https://instagram.com/smanpintar"
                        value="{{ $homepage->footer_instagram_url ?? '' }}">
                </div>

                <div>
                    <label>Link Facebook</label>
                    <input name="footer_facebook_url" placeholder="Contoh: https://facebook.com/smanpintar"
                        value="{{ $homepage->footer_facebook_url ?? '' }}">
                </div>

                <div>
                    <label>Link YouTube</label>
                    <input name="footer_youtube_url" placeholder="Contoh: https://youtube.com/@smanpintar"
                        value="{{ $homepage->footer_youtube_url ?? '' }}">
                </div>

                <div>
                    <label>Alamat</label>
                    <input name="footer_address"
                        placeholder="Contoh: Jl. Proklamasi, Sei. Jering, Kuantan Tengah"
                        value="{{ $homepage->footer_address ?? 'Jl. Pendidikan No. 01, Pekanbaru, Provinsi Riau' }}">
                </div>

                <div>
                    <label>Email</label>
                    <input name="footer_email" placeholder="Contoh: info@smanpintar.sch.id"
                        value="{{ $homepage->footer_email ?? '' }}">
                </div>

                <div>
                    <label>Telepon</label>
                    <input name="footer_phone" placeholder="Contoh: (0760) 561925"
                        value="{{ $homepage->footer_phone ?? '(0761) 1234567' }}">
                </div>

                <div>
                    <label>Jam Operasional</label>
                    <textarea name="footer_operational_hours" rows="4"
                        placeholder="Contoh: Senin - Jumat: 07.30 - 16.00&#10;Sabtu: 08.00 - 12.00">{{ $homepage->footer_operational_hours ?? 'Senin - Jumat: 07.30 - 16.00' }}</textarea>
                </div>

                <div>
                    <label>Copyright</label>
                    <input name="footer_copyright" placeholder="Contoh: SMAN Pintar Provinsi Riau."
                        value="{{ $homepage->footer_copyright ?? 'SMAN Pintar Provinsi Riau.' }}">
                </div>

                <div>
                    <label>Slogan Singkat</label>
                    <input name="footer_note" placeholder="Contoh: Karakter Kuat, Ilmu Berdaya."
                        value="{{ $homepage->footer_note ?? 'Karakter Kuat, Ilmu Berdaya.' }}">
                </div>

                <div class="border-t border-surface-container pt-8">
                    <div class="flex flex-col-reverse gap-3 sm:flex-row sm:items-center">
                        <button type="button" data-back-overview class="btn-cancel">
                            Batal
                        </button>
                        <button type="submit"
                            class="bg-primary text-white px-8 py-3 rounded-xl font-bold shadow-lg hover:scale-105 transition-all">
                            Simpan
                        </button>
                    </div>
                </div>
            </div>
        </details>

        <div
            class="editor-actions bg-surface-container-lowest rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] px-8 py-6">
            <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end sm:items-center">
                <button type="button" data-back-overview class="btn-cancel">
                    Batal
                </button>
                <button type="submit"
                    class="bg-primary text-white px-8 py-3 rounded-xl font-bold shadow-lg hover:scale-105 transition-all">
                    Simpan
                </button>
            </div>
        </div>
    </section>
</form>

<script>
const overview = document.getElementById('component-overview');
const editors = document.getElementById('component-editors');
const panels = document.querySelectorAll('[data-editor-panel]');
const activePanelInput = document.getElementById('activePanelInput');

function showOverview() {
    editors.classList.add('hidden');
    overview.classList.remove('hidden');
    editors.removeAttribute('data-active-panel');
    if (activePanelInput) {
        activePanelInput.value = '';
    }
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
    editors.dataset.activePanel = panelId;
    if (activePanelInput) {
        activePanelInput.value = panelId;
    }
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

@if(session('open_homepage_panel'))
showEditor(@json(session('open_homepage_panel')));
@endif

</script>
@endsection
