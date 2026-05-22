@extends('layouts.admin')

@section('title', 'Tentang Kami - SMAN Pintar')

@section('content')
@php
$defaultHighlights = [
    ['icon' => 'verified', 'label' => 'Status', 'title' => 'Akreditasi A'],
    ['icon' => 'memory', 'label' => 'Metode', 'title' => 'Berbasis Teknologi'],
    ['icon' => 'home_work', 'label' => 'Layanan', 'title' => 'Asrama Eksklusif'],
];
$defaultMissions = [
    'Menyelenggarakan pembelajaran berbasis ICT yang inovatif dan interaktif.',
    'Mengembangkan potensi minat dan bakat siswa melalui program pembinaan intensif.',
    'Membangun ekosistem sekolah yang religius, jujur, dan berdisiplin tinggi.',
    'Mewujudkan kolaborasi strategis dengan institusi pendidikan internasional.',
];
$defaultFacilities = [
    ['icon' => 'biotech', 'title' => 'Lab Riset & Sains', 'desc' => 'Dilengkapi peralatan standar olimpiade internasional.'],
    ['icon' => 'auto_stories', 'title' => 'Perpustakaan Digital', 'desc' => 'Akses ke ribuan jurnal dan e-book global 24/7.'],
    ['icon' => 'sports_basketball', 'title' => 'Sport Center', 'desc' => 'Gedung olahraga indoor untuk basket, futsal, dan badminton.'],
    ['icon' => 'theater_comedy', 'title' => 'Teater Seni', 'desc' => 'Ruang pertunjukan dengan sistem tata suara mutakhir.'],
    ['icon' => 'apartment', 'title' => 'Asrama Siswa', 'desc' => 'Hunian nyaman dengan pembinaan karakter dan pengawasan terarah.'],
    ['icon' => 'restaurant', 'title' => 'Kantin Sehat', 'desc' => 'Area makan bersih dengan pilihan menu harian yang mendukung aktivitas siswa.'],
    ['icon' => 'computer', 'title' => 'Lab Komputer', 'desc' => 'Perangkat pembelajaran digital untuk coding, desain, dan riset teknologi.'],
    ['icon' => 'local_hospital', 'title' => 'UKS', 'desc' => 'Layanan kesehatan sekolah untuk kebutuhan pertolongan pertama siswa.'],
];
$defaultExtracurriculars = [
    ['icon' => 'robot_2', 'title' => 'Robotic Club', 'desc' => 'Mengembangkan kecerdasan buatan dan perakitan mekanik robotik tingkat lanjut.'],
    ['icon' => 'public', 'title' => 'English Debate', 'desc' => 'Mengasah kemampuan argumentasi dan diplomasi internasional dalam bahasa Inggris.'],
    ['icon' => 'palette', 'title' => 'Visual Arts', 'desc' => 'Eksplorasi seni lukis, desain grafis, dan multimedia kreatif.'],
    ['icon' => 'campaign', 'title' => 'Journalism', 'desc' => 'Pelatihan penulisan berita, fotografi jurnalistik, dan penyiaran radio sekolah.'],
];
$defaultTags = ['#Creativity', '#Leadership', '#Innovation'];
$facilitySlots = max(8, count($about->facilities ?? []));

$components = [
    [
        'id' => 'hero-profile-section',
        'icon' => 'account_balance',
        'title' => 'Hero & Profil',
        'meta' => $about->profile_label ?? 'Ekselerasi Pendidikan',
        'content' => $about->profile_title ?? 'Dedikasi Mencetak Generasi Unggul Riau',
    ],
    [
        'id' => 'highlight-section',
        'icon' => 'verified',
        'title' => 'Highlight Atas',
        'meta' => '3 highlight utama',
        'content' => collect(range(0, 2))->map(fn ($i) => data_get($about->highlights, $i . '.title') ?? $defaultHighlights[$i]['title'])->implode(', '),
    ],
    [
        'id' => 'vision-section',
        'icon' => 'flag',
        'title' => 'Visi & Misi',
        'meta' => count($about->missions ?? $defaultMissions) . ' misi',
        'content' => $about->vision_mission_title ?? 'Visi & Misi Kami',
    ],
    [
        'id' => 'facilities-section',
        'icon' => 'domain',
        'title' => 'Fasilitas Unggulan',
        'meta' => $facilitySlots . ' slot fasilitas',
        'content' => $about->facilities_title ?? 'Fasilitas Unggulan',
    ],
    [
        'id' => 'extracurricular-section',
        'icon' => 'groups',
        'title' => 'Ekstrakurikuler',
        'meta' => '4 kegiatan pilihan',
        'content' => $about->extracurricular_title ?? 'Ekstrakurikuler Pilihan',
    ],
];
@endphp

<style>
    #about-editors {
        width: 100%;
    }

    #about-editors summary {
        cursor: default;
        list-style: none;
        padding: 0;
        margin-bottom: 2.5rem;
    }

    #about-editors summary::-webkit-details-marker {
        display: none;
    }

    #about-editors summary > div:first-child span {
        display: none;
    }

    #about-editors summary h3 {
        font-size: 2.25rem;
        line-height: 2.5rem;
        font-weight: 800;
    }

    #about-editors summary h3::after {
        content: "Kelola konten halaman Tentang Kami";
        display: block;
        margin-top: .5rem;
        color: rgb(71 85 105);
        font-family: "Plus Jakarta Sans", sans-serif;
        font-size: 1.125rem;
        line-height: 1.75rem;
        font-weight: 500;
    }

    #about-editors [data-about-panel] {
        border: 0;
        background: transparent;
        box-shadow: none;
        overflow: visible;
    }

    #about-editors [data-about-panel] > div {
        border-top: 0;
        border-radius: 1rem;
        background: rgb(255 255 255);
        box-shadow: 0 8px 30px rgb(0 0 0 / 0.04);
        padding: 2rem;
    }

    #about-editors label {
        display: block;
        margin-bottom: .5rem;
        color: rgb(15 23 42);
        font-size: .875rem;
        font-weight: 700;
    }

    #about-editors input,
    #about-editors textarea,
    #about-editors select {
        width: 100%;
        border: 0;
        border-radius: .75rem;
        background: rgb(226 227 237);
        padding: .75rem 1rem;
        color: rgb(15 23 42);
        font-weight: 500;
    }

    #about-editors input:focus,
    #about-editors textarea:focus,
    #about-editors select:focus {
        outline: 0;
        box-shadow: 0 0 0 2px rgb(0 74 173 / 0.2);
    }
</style>

<form action="{{ route('admin.about.update') }}" method="POST" enctype="multipart/form-data" class="px-8 pb-8 pt-0 space-y-10">
    @csrf

    @if(session('success'))
    <div class="bg-emerald-50 text-emerald-600 p-4 rounded-xl font-bold flex items-center gap-2 shadow-sm border border-emerald-100">
        <span class="material-symbols-outlined">check_circle</span>
        {{ session('success') }}
    </div>
    @endif

    <div id="about-overview" class="space-y-10">
        <section>
            <h2 class="text-4xl font-extrabold text-primary tracking-tight font-headline">Tentang Kami</h2>
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
                        @foreach ($components as $component)
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
                                <a href="#{{ $component['id'] }}" data-about-edit-target="{{ $component['id'] }}"
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

    <section id="about-editors" class="hidden space-y-4">
        <details id="hero-profile-section" data-about-panel class="group bg-surface-container-lowest rounded-2xl shadow-sm border border-slate-100 overflow-hidden" open>
            <summary class="list-none flex items-center justify-between gap-4">
                <div>
                    <span>Component 01</span>
                    <h3 class="font-headline text-primary">Hero & Profil</h3>
                </div>
                <button type="button" data-about-back class="inline-flex items-center gap-2 rounded-xl bg-slate-100 px-4 py-2 text-sm font-bold text-slate-600 hover:bg-slate-200 transition-colors">
                    <span class="material-symbols-outlined text-[18px]">arrow_back</span>
                    Kembali
                </button>
            </summary>
            <div class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label>Judul Hero</label>
                        <input name="hero_title" placeholder="Judul hero" value="{{ $about->hero_title ?? 'Tentang Kami' }}">
                    </div>
                    <div>
                        <label>Gambar Hero</label>
                        <input name="hero_image" type="file" accept="image/*">
                    </div>
                    <div>
                        <label>Label Profil</label>
                        <input name="profile_label" placeholder="Label profil" value="{{ $about->profile_label ?? 'Ekselerasi Pendidikan' }}">
                    </div>
                    <div>
                        <label>Judul Profil</label>
                        <input name="profile_title" placeholder="Judul profil" value="{{ $about->profile_title ?? 'Dedikasi Mencetak Generasi Unggul Riau' }}">
                    </div>
                    <div class="md:col-span-2">
                        <label>Paragraf Profil 1</label>
                        <textarea name="profile_paragraph_1" rows="3">{{ $about->profile_paragraph_1 ?? 'SMAN Pintar Provinsi Riau berdiri sebagai mercusuar pendidikan berkualitas yang memadukan kurikulum nasional dengan inovasi teknologi terkini.' }}</textarea>
                    </div>
                    <div class="md:col-span-2">
                        <label>Paragraf Profil 2</label>
                        <textarea name="profile_paragraph_2" rows="3">{{ $about->profile_paragraph_2 ?? 'Berlokasi di lingkungan yang asri namun modern, sekolah kami menjadi laboratorium masa depan bagi putra-putri terbaik daerah.' }}</textarea>
                    </div>
                    <div>
                        <label>Tombol Utama</label>
                        <input name="profile_button_1_text" value="{{ $about->profile_button_1_text ?? 'Selengkapnya' }}">
                    </div>
                    <div>
                        <label>Link Tombol Utama</label>
                        <input name="profile_button_1_link" value="{{ $about->profile_button_1_link ?? '#visi-misi' }}">
                    </div>
                    <div>
                        <label>Tombol Kedua</label>
                        <input name="profile_button_2_text" value="{{ $about->profile_button_2_text ?? 'Lihat Video Profil' }}">
                    </div>
                    <div>
                        <label>Link Tombol Kedua</label>
                        <input name="profile_button_2_link" value="{{ $about->profile_button_2_link ?? '#' }}">
                    </div>
                    <div>
                        <label>Angka Dedikasi</label>
                        <input name="dedication_number" value="{{ $about->dedication_number ?? '15+' }}">
                    </div>
                    <div>
                        <label>Label Dedikasi</label>
                        <input name="dedication_label" value="{{ $about->dedication_label ?? 'Tahun Dedikasi' }}">
                    </div>
                    <div class="md:col-span-2">
                        <label>Gambar Profil</label>
                        <input name="profile_image" type="file" accept="image/*">
                    </div>
                </div>
            </div>
        </details>

        <details id="highlight-section" data-about-panel class="hidden group bg-surface-container-lowest rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            <summary class="list-none flex items-center justify-between gap-4">
                <div>
                    <span>Component 02</span>
                    <h3 class="font-headline text-primary">Highlight Atas</h3>
                </div>
                <button type="button" data-about-back class="inline-flex items-center gap-2 rounded-xl bg-slate-100 px-4 py-2 text-sm font-bold text-slate-600 hover:bg-slate-200 transition-colors">
                    <span class="material-symbols-outlined text-[18px]">arrow_back</span>
                    Kembali
                </button>
            </summary>
            <div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    @for ($i = 0; $i < 3; $i++)
                    <div class="bg-surface-container-low p-5 rounded-xl space-y-3">
                        <label>Highlight {{ $i + 1 }}</label>
                        <input name="highlights[{{ $i }}][icon]" value="{{ data_get($about->highlights, $i.'.icon') ?? $defaultHighlights[$i]['icon'] }}">
                        <input name="highlights[{{ $i }}][label]" value="{{ data_get($about->highlights, $i.'.label') ?? $defaultHighlights[$i]['label'] }}">
                        <input name="highlights[{{ $i }}][title]" value="{{ data_get($about->highlights, $i.'.title') ?? $defaultHighlights[$i]['title'] }}">
                    </div>
                    @endfor
                </div>
            </div>
        </details>

        <details id="vision-section" data-about-panel class="hidden group bg-surface-container-lowest rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            <summary class="list-none flex items-center justify-between gap-4">
                <div>
                    <span>Component 03</span>
                    <h3 class="font-headline text-primary">Visi & Misi</h3>
                </div>
                <button type="button" data-about-back class="inline-flex items-center gap-2 rounded-xl bg-slate-100 px-4 py-2 text-sm font-bold text-slate-600 hover:bg-slate-200 transition-colors">
                    <span class="material-symbols-outlined text-[18px]">arrow_back</span>
                    Kembali
                </button>
            </summary>
            <div class="space-y-6">
                <div>
                    <label>Judul Section</label>
                    <input name="vision_mission_title" value="{{ $about->vision_mission_title ?? 'Visi & Misi Kami' }}">
                </div>
                <div>
                    <label>Visi</label>
                    <textarea name="vision" rows="4">{{ $about->vision ?? 'Menjadi institusi pendidikan model yang unggul dalam prestasi akademik, berwawasan teknologi global, serta berakar kuat pada nilai-nilai karakter bangsa.' }}</textarea>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @for ($i = 0; $i < 4; $i++)
                    <div>
                        <label>Misi {{ $i + 1 }}</label>
                        <textarea name="missions[{{ $i }}]" rows="2">{{ data_get($about->missions, $i) ?? $defaultMissions[$i] }}</textarea>
                    </div>
                    @endfor
                </div>
            </div>
        </details>

        <details id="facilities-section" data-about-panel class="hidden group bg-surface-container-lowest rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            <summary class="list-none flex items-center justify-between gap-4">
                <div>
                    <span>Component 04</span>
                    <h3 class="font-headline text-primary">Fasilitas Unggulan</h3>
                </div>
                <button type="button" data-about-back class="inline-flex items-center gap-2 rounded-xl bg-slate-100 px-4 py-2 text-sm font-bold text-slate-600 hover:bg-slate-200 transition-colors">
                    <span class="material-symbols-outlined text-[18px]">arrow_back</span>
                    Kembali
                </button>
            </summary>
            <div class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label>Label Fasilitas</label>
                        <input name="facilities_label" value="{{ $about->facilities_label ?? 'Infrastruktur Modern' }}">
                    </div>
                    <div>
                        <label>Judul Fasilitas</label>
                        <input name="facilities_title" value="{{ $about->facilities_title ?? 'Fasilitas Unggulan' }}">
                    </div>
                    <div>
                        <label>Teks Tombol</label>
                        <input name="facilities_button_text" value="{{ $about->facilities_button_text ?? 'Lihat Semua Fasilitas' }}">
                    </div>
                    <div>
                        <label>Link Tombol</label>
                        <input name="facilities_button_link" value="{{ $about->facilities_button_link ?? '#' }}">
                    </div>
                </div>
                <div class="bg-surface-container-low rounded-2xl overflow-hidden border border-slate-100">
                    <div class="flex flex-col gap-4 p-5 md:flex-row md:items-center md:justify-between">
                        <div>
                            <h4 class="text-lg font-bold text-primary">Daftar Fasilitas</h4>
                            <p class="text-sm text-on-surface-variant">Edit langsung di tabel. Beranda otomatis memakai 4 fasilitas pertama.</p>
                        </div>
                        <button type="button" data-add-facility
                            class="inline-flex items-center justify-center gap-2 rounded-xl bg-primary px-5 py-3 text-sm font-bold text-white hover:bg-primary-container transition-colors">
                            <span class="material-symbols-outlined text-[18px]">add</span>
                            Tambah Fasilitas
                        </button>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse table-fixed">
                            <thead>
                                <tr class="bg-surface-container-lowest/70">
                                    <th class="w-28 px-5 py-4 text-[11px] font-bold text-slate-400 uppercase tracking-widest">Preview</th>
                                    <th class="w-48 px-5 py-4 text-[11px] font-bold text-slate-400 uppercase tracking-widest">Fasilitas</th>
                                    <th class="px-5 py-4 text-[11px] font-bold text-slate-400 uppercase tracking-widest">Deskripsi</th>
                                    <th class="w-28 px-5 py-4 text-[11px] font-bold text-slate-400 uppercase tracking-widest">Status</th>
                                    <th class="w-28 px-5 py-4 text-[11px] font-bold text-slate-400 uppercase tracking-widest text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="facility-table-body" class="divide-y divide-surface-container">
                                @for ($i = 0; $i < $facilitySlots; $i++)
                                @php
                                    $facilityImage = data_get($about->facilities, $i.'.image');
                                    $facilityIcon = data_get($about->facilities, $i.'.icon') ?? data_get($defaultFacilities, $i.'.icon');
                                @endphp
                                <tr data-facility-row data-facility-display-row class="group hover:bg-surface-container-low/30 transition-colors">
                                    <td class="px-5 py-4">
                                        @if($facilityImage)
                                        <img data-facility-preview src="{{ asset('storage/' . $facilityImage) }}" class="h-14 w-20 rounded-lg object-cover" alt="Preview fasilitas">
                                        @else
                                        <div data-facility-preview class="h-14 w-20 rounded-lg bg-blue-50 text-primary flex items-center justify-center text-[10px] font-bold uppercase">
                                            No Image
                                        </div>
                                        @endif
                                    </td>
                                    <td class="px-5 py-4">
                                        <p data-facility-title class="font-bold text-blue-900 group-hover:text-primary transition-colors">
                                            {{ data_get($about->facilities, $i.'.title') ?? data_get($defaultFacilities, $i.'.title') }}
                                        </p>
                                        <input data-facility-field="icon" name="facilities[{{ $i }}][icon]" type="hidden" value="{{ $facilityIcon }}">
                                    </td>
                                    <td class="px-5 py-4">
                                        <p data-facility-desc class="max-w-xl text-sm text-on-surface-variant font-medium leading-relaxed line-clamp-2">
                                            {{ data_get($about->facilities, $i.'.desc') ?? data_get($defaultFacilities, $i.'.desc') }}
                                        </p>
                                    </td>
                                    <td class="px-5 py-4">
                                        <span class="flex items-center gap-1.5 text-xs font-bold text-emerald-600 bg-emerald-50 px-3 py-1 rounded-full w-fit">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Aktif
                                        </span>
                                    </td>
                                    <td class="px-5 py-4 text-right">
                                        <button type="button" data-edit-facility
                                            class="inline-flex h-10 w-10 items-center justify-center rounded-xl bg-slate-100 text-slate-500 hover:bg-amber-100 hover:text-amber-600 transition-colors"
                                            aria-label="Edit fasilitas">
                                            <span class="material-symbols-outlined text-[20px]">edit</span>
                                        </button>
                                        <button type="button" data-remove-facility
                                            class="inline-flex h-10 w-10 items-center justify-center rounded-xl bg-error/10 text-error hover:bg-error hover:text-white transition-colors"
                                            aria-label="Hapus fasilitas">
                                            <span class="material-symbols-outlined text-[20px]">delete</span>
                                        </button>
                                    </td>
                                </tr>
                                <tr data-facility-edit-row class="hidden bg-surface-container-low/50">
                                    <td colspan="5" class="px-5 py-5">
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 rounded-2xl bg-white p-5">
                                            <div>
                                                <label>Nama Fasilitas</label>
                                                <input data-facility-field="title" name="facilities[{{ $i }}][title]" placeholder="Nama fasilitas" value="{{ data_get($about->facilities, $i.'.title') ?? data_get($defaultFacilities, $i.'.title') }}">
                                            </div>
                                            <div class="md:col-span-2">
                                                <label>Deskripsi</label>
                                                <textarea data-facility-field="desc" name="facilities[{{ $i }}][desc]" rows="3" placeholder="Deskripsi fasilitas">{{ data_get($about->facilities, $i.'.desc') ?? data_get($defaultFacilities, $i.'.desc') }}</textarea>
                                            </div>
                                            <div class="md:col-span-2">
                                                <label>Gambar</label>
                                                <input data-facility-image name="facility_images[{{ $i }}]" type="file" accept="image/*">
                                                <input data-facility-field="image" name="facilities[{{ $i }}][image]" type="hidden" value="{{ $facilityImage }}">
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endfor
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </details>

        <details id="extracurricular-section" data-about-panel class="hidden group bg-surface-container-lowest rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            <summary class="list-none flex items-center justify-between gap-4">
                <div>
                    <span>Component 05</span>
                    <h3 class="font-headline text-primary">Ekstrakurikuler</h3>
                </div>
                <button type="button" data-about-back class="inline-flex items-center gap-2 rounded-xl bg-slate-100 px-4 py-2 text-sm font-bold text-slate-600 hover:bg-slate-200 transition-colors">
                    <span class="material-symbols-outlined text-[18px]">arrow_back</span>
                    Kembali
                </button>
            </summary>
            <div class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label>Label Ekstrakurikuler</label>
                        <input name="extracurricular_label" value="{{ $about->extracurricular_label ?? 'Pengembangan Diri' }}">
                    </div>
                    <div>
                        <label>Judul Ekstrakurikuler</label>
                        <input name="extracurricular_title" value="{{ $about->extracurricular_title ?? 'Ekstrakurikuler Pilihan' }}">
                    </div>
                    <div class="md:col-span-2">
                        <label>Deskripsi</label>
                        <textarea name="extracurricular_desc" rows="3">{{ $about->extracurricular_desc ?? 'Kami menyediakan wadah bagi siswa untuk mengeksplorasi minat di luar jam akademik dengan mentor yang kompeten.' }}</textarea>
                    </div>
                    @for ($i = 0; $i < 3; $i++)
                    <div>
                        <label>Tag {{ $i + 1 }}</label>
                        <input name="extracurricular_tags[{{ $i }}]" value="{{ data_get($about->extracurricular_tags, $i) ?? $defaultTags[$i] }}">
                    </div>
                    @endfor
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @for ($i = 0; $i < 4; $i++)
                    <div class="bg-surface-container-low p-5 rounded-xl space-y-3">
                        <label>Ekstrakurikuler {{ $i + 1 }}</label>
                        <input name="extracurriculars[{{ $i }}][icon]" value="{{ data_get($about->extracurriculars, $i.'.icon') ?? $defaultExtracurriculars[$i]['icon'] }}">
                        <input name="extracurriculars[{{ $i }}][title]" value="{{ data_get($about->extracurriculars, $i.'.title') ?? $defaultExtracurriculars[$i]['title'] }}">
                        <textarea name="extracurriculars[{{ $i }}][desc]" rows="3">{{ data_get($about->extracurriculars, $i.'.desc') ?? $defaultExtracurriculars[$i]['desc'] }}</textarea>
                    </div>
                    @endfor
                </div>
            </div>
        </details>

        <div class="bg-surface-container-lowest rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] px-8 py-6">
            <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end sm:items-center">
                <button type="button" data-about-back class="btn-cancel">
                    Batal
                </button>
                <button type="submit" class="bg-primary text-white px-8 py-3 rounded-xl font-bold shadow-lg hover:scale-105 transition-all">
                    Simpan
                </button>
            </div>
        </div>
    </section>
</form>

<script>
const aboutOverview = document.getElementById('about-overview');
const aboutEditors = document.getElementById('about-editors');
const aboutPanels = document.querySelectorAll('[data-about-panel]');
const facilityTableBody = document.getElementById('facility-table-body');
const addFacilityButton = document.querySelector('[data-add-facility]');

function facilityRowTemplate() {
    return `
        <td class="px-5 py-4">
            <div class="h-14 w-20 rounded-lg bg-blue-50 text-primary flex items-center justify-center text-[10px] font-bold uppercase">
                No Image
            </div>
        </td>
        <td class="px-5 py-4">
            <p data-facility-title class="font-bold text-blue-900 group-hover:text-primary transition-colors">Fasilitas Baru</p>
            <input data-facility-field="icon" type="hidden" value="domain">
        </td>
        <td class="px-5 py-4">
            <p data-facility-desc class="max-w-xl text-sm text-on-surface-variant font-medium leading-relaxed line-clamp-2">Deskripsi fasilitas akan diperbarui.</p>
        </td>
        <td class="px-5 py-4">
            <span class="flex items-center gap-1.5 text-xs font-bold text-emerald-600 bg-emerald-50 px-3 py-1 rounded-full w-fit">
                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Aktif
            </span>
        </td>
        <td class="px-5 py-4 text-right">
            <button type="button" data-edit-facility
                class="inline-flex h-10 w-10 items-center justify-center rounded-xl bg-slate-100 text-slate-500 hover:bg-amber-100 hover:text-amber-600 transition-colors"
                aria-label="Edit fasilitas">
                <span class="material-symbols-outlined text-[20px]">edit</span>
            </button>
            <button type="button" data-remove-facility
                class="inline-flex h-10 w-10 items-center justify-center rounded-xl bg-error/10 text-error hover:bg-error hover:text-white transition-colors"
                aria-label="Hapus fasilitas">
                <span class="material-symbols-outlined text-[20px]">delete</span>
            </button>
        </td>
    `;
}

function facilityEditRowTemplate() {
    return `
        <td colspan="5" class="px-5 py-5">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 rounded-2xl bg-white p-5">
                <div>
                    <label>Nama Fasilitas</label>
                    <input data-facility-field="title" placeholder="Nama fasilitas" value="Fasilitas Baru">
                </div>
                <div class="md:col-span-2">
                    <label>Deskripsi</label>
                    <textarea data-facility-field="desc" rows="3" placeholder="Deskripsi fasilitas">Deskripsi fasilitas akan diperbarui.</textarea>
                </div>
                <div class="md:col-span-2">
                    <label>Gambar</label>
                    <input data-facility-image type="file" accept="image/*">
                    <input data-facility-field="image" type="hidden" value="">
                </div>
            </div>
        </td>
    `;
}

function reindexFacilityRows() {
    if (!facilityTableBody) {
        return;
    }

    facilityTableBody.querySelectorAll('[data-facility-display-row]').forEach((row, index) => {
        const editRow = row.nextElementSibling?.matches('[data-facility-edit-row]')
            ? row.nextElementSibling
            : null;

        row.querySelectorAll('[data-facility-field]').forEach((field) => {
            field.name = `facilities[${index}][${field.dataset.facilityField}]`;
        });

        editRow?.querySelectorAll('[data-facility-field]').forEach((field) => {
            field.name = `facilities[${index}][${field.dataset.facilityField}]`;
        });

        const imageInput = editRow?.querySelector('[data-facility-image]');
        if (imageInput) {
            imageInput.name = `facility_images[${index}]`;
        }
    });
}

addFacilityButton?.addEventListener('click', () => {
    const displayRow = document.createElement('tr');
    displayRow.dataset.facilityRow = '';
    displayRow.dataset.facilityDisplayRow = '';
    displayRow.className = 'group hover:bg-surface-container-low/30 transition-colors';
    displayRow.innerHTML = facilityRowTemplate();

    const editRow = document.createElement('tr');
    editRow.dataset.facilityEditRow = '';
    editRow.className = 'bg-surface-container-low/50';
    editRow.innerHTML = facilityEditRowTemplate();

    facilityTableBody.appendChild(displayRow);
    facilityTableBody.appendChild(editRow);
    reindexFacilityRows();
});

facilityTableBody?.addEventListener('click', (event) => {
    const removeButton = event.target.closest('[data-remove-facility]');
    const editButton = event.target.closest('[data-edit-facility]');

    if (editButton) {
        const displayRow = editButton.closest('[data-facility-display-row]');
        const editRow = displayRow?.nextElementSibling;

        if (editRow?.matches('[data-facility-edit-row]')) {
            editRow.classList.toggle('hidden');
        }

        return;
    }

    if (!removeButton) {
        return;
    }

    const displayRow = removeButton.closest('[data-facility-display-row]');
    const editRow = displayRow?.nextElementSibling;

    if (editRow?.matches('[data-facility-edit-row]')) {
        editRow.remove();
    }

    displayRow?.remove();
    reindexFacilityRows();
});

facilityTableBody?.addEventListener('input', (event) => {
    const field = event.target.closest('[data-facility-field]');

    if (!field) {
        return;
    }

    const editRow = field.closest('[data-facility-edit-row]');
    const displayRow = editRow?.previousElementSibling;

    if (!displayRow?.matches('[data-facility-display-row]')) {
        return;
    }

    if (field.dataset.facilityField === 'title') {
        displayRow.querySelector('[data-facility-title]').textContent = field.value || 'Fasilitas Baru';
    }

    if (field.dataset.facilityField === 'desc') {
        displayRow.querySelector('[data-facility-desc]').textContent = field.value || 'Deskripsi fasilitas akan diperbarui.';
    }
});

reindexFacilityRows();

function showAboutOverview() {
    aboutEditors.classList.add('hidden');
    aboutOverview.classList.remove('hidden');
    aboutPanels.forEach((panel) => panel.classList.add('hidden'));
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

function showAboutEditor(panelId) {
    const target = document.getElementById(panelId);

    if (!target) {
        return;
    }

    aboutOverview.classList.add('hidden');
    aboutEditors.classList.remove('hidden');
    aboutPanels.forEach((panel) => panel.classList.add('hidden'));
    target.classList.remove('hidden');
    target.open = true;
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

document.querySelectorAll('[data-about-edit-target]').forEach((link) => {
    link.addEventListener('click', (event) => {
        event.preventDefault();
        showAboutEditor(link.dataset.aboutEditTarget);
    });
});

document.querySelectorAll('[data-about-back]').forEach((button) => {
    button.addEventListener('click', (event) => {
        event.preventDefault();
        event.stopPropagation();
        showAboutOverview();
    });
});
</script>
@endsection
