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
$defaultHeroImage = 'https://lh3.googleusercontent.com/aida-public/AB6AXuCnyXL0n2V3ExwtRVjX6KOHtBjTOnVIX58cuwpTdsZ10cb_nCteZuARseMIS6crt1FFD6gNKlnBSigsoGo0P74haJ1Jyw94LOUG4oD5wQ79xQsCwHhuZ_bIF7y4n85MRdei8AZO8g-PC6vcDuMy5pwC_Kh6ZtrTRWEPXY6npGoVCdpwai3TpB4H79IomqONsqfd1asST1pPbdHvVm2Gp65yxax3CTGeOntbO7zMGDevw0loDMm0UX5LVbukJzyxTd_NawUdj_UgYnsu';
$defaultProfileImage = 'https://lh3.googleusercontent.com/aida-public/AB6AXuBrZysYUdrrL-V6NkqRMcowI2PjJ3jJSnWaNfnkHkl-Cx_NlmDk7BWkZhqAzzuuqAWmuPDc3PFbbjm11r7Adqf3FEw_tC6POJL4IzaJKA1rh3cJBuPq3bCTGxQMldXLtlBmbWI7fNmV9YTpfHBXkJvuXFCJ85hF4zpr0pNx7LNg7GYKf0E6kv2oMcBp26bf8SSu8Er4npt_Fho9tE00K6tCPXKGkntv1FjLo9t1o6e2qcTa7n6HkbNo0FuojG1nRk1I7zj0QFoN02Lw';
$heroImage = $about->hero_image ? asset('storage/' . $about->hero_image) : $defaultHeroImage;
$profileImage = $about->profile_image ? asset('storage/' . $about->profile_image) : $defaultProfileImage;
$defaultTags = ['#Creativity', '#Leadership', '#Innovation'];
$missionItems = collect($about->missions ?? $defaultMissions)
    ->filter(fn ($mission) => filled($mission))
    ->values();

if ($missionItems->isEmpty()) {
    $missionItems = collect($defaultMissions);
}

$missionsText = $missionItems
    ->map(fn ($mission, $index) => ($index + 1) . '. ' . $mission)
    ->implode("\n");

$facilityItems = collect($about->facilities ?? [])
    ->filter(fn ($facility) => ($facility['title'] ?? null) || ($facility['desc'] ?? null) || ($facility['image'] ?? null))
    ->values();

if ($facilityItems->isEmpty()) {
    $facilityItems = collect($defaultFacilities);
}

$facilitySlots = $facilityItems->count();

$extracurricularItems = collect($about->extracurriculars ?? [])
    ->filter(fn ($item) => ($item['title'] ?? null) || ($item['desc'] ?? null) || ($item['icon'] ?? null))
    ->values();

if ($extracurricularItems->isEmpty()) {
    $extracurricularItems = collect($defaultExtracurriculars);
}

$extracurricularSlots = $extracurricularItems->count();

$components = [
    [
        'id' => 'hero-profile-section',
        'icon' => 'account_balance',
        'title' => 'Hero & Profil',
        'meta' => $about->profile_label ?? 'Ekselerasi Pendidikan',
        'content' => $about->profile_title ?? 'Mencetak Generasi Unggul Riau',
    ],
    [
        'id' => 'school-profile-section',
        'icon' => 'groups',
        'title' => 'Data Sekolah & SDM',
        'meta' => (($about->male_student_count ?? 168) + ($about->female_student_count ?? 182)) . ' siswa',
        'content' => ($about->class_count ?? 12) . ' kelas, ' . ($about->educator_count ?? 42) . ' pendidik, ' . ($about->staff_count ?? 18) . ' tenaga kependidikan',
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
        'title' => 'Fasilitas',
        'meta' => 'Pengaturan section',
        'content' => $about->facilities_title ?? 'Fasilitas Unggulan',
    ],
    [
        'id' => 'facility-management-section',
        'icon' => 'inventory_2',
        'title' => 'Manajemen Fasilitas',
        'meta' => $facilitySlots . ' data fasilitas',
        'content' => 'Kelola daftar fasilitas yang ditampilkan di halaman Tentang Kami dan Beranda.',
    ],
    [
        'id' => 'extracurricular-section',
        'icon' => 'groups',
        'title' => 'Ekstrakurikuler',
        'meta' => 'Pengaturan section',
        'content' => $about->extracurricular_title ?? 'Ekstrakurikuler Pilihan',
    ],
    [
        'id' => 'extracurricular-management-section',
        'icon' => 'list_alt',
        'title' => 'Manajemen Ekstrakurikuler',
        'meta' => $extracurricularSlots . ' data ekstrakurikuler',
        'content' => 'Kelola daftar ekstrakurikuler yang ditampilkan di halaman Tentang Kami.',
    ],
];
@endphp

<style>
    #about-editors summary [data-save-editor],
    #about-editors summary .group-open\:rotate-180 {
        display: none;
    }

    #about-editors .editor-actions {
        border-top: 1px solid rgb(226 232 240);
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
                <input type="hidden" name="hero_title" value="{{ $about->hero_title ?? 'Tentang Kami' }}">
                <input type="hidden" name="profile_label" value="{{ $about->profile_label ?? 'Eksplorasi Pendidikan' }}">
                <input type="hidden" name="profile_button_1_text" value="{{ $about->profile_button_1_text ?? 'Selengkapnya' }}">
                <input type="hidden" name="profile_button_1_link" value="{{ $about->profile_button_1_link ?? '#visi-misi' }}">

                <div class="grid grid-cols-1 xl:grid-cols-2 gap-8">
                    <div class="space-y-6">
                        <div>
                            <label>Judul Profil</label>
                            <input name="profile_title" placeholder="Judul profil" value="{{ $about->profile_title ?? 'Mencetak Generasi Unggul Riau' }}">
                        </div>
                        <div>
                            <label>Paragraf Profil 1</label>
                            <textarea name="profile_paragraph_1" rows="4">{{ $about->profile_paragraph_1 ?? 'SMAN Pintar Provinsi Riau berdiri sebagai mercusuar pendidikan berkualitas yang memadukan kurikulum nasional dengan inovasi teknologi terkini.' }}</textarea>
                        </div>
                        <div>
                            <label>Paragraf Profil 2</label>
                            <textarea name="profile_paragraph_2" rows="4">{{ $about->profile_paragraph_2 ?? 'Berlokasi di lingkungan yang asri namun modern, sekolah kami menjadi laboratorium masa depan bagi putra-putri terbaik daerah.' }}</textarea>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div>
                            <label>Gambar Hero</label>
                            <div class="overflow-hidden rounded-2xl bg-slate-100 shadow-sm">
                                <img class="h-72 w-full object-cover" src="{{ $heroImage }}" alt="Preview gambar hero">
                            </div>
                            <input class="mt-4" name="hero_image" type="file" accept="image/*">
                            <p class="mt-2 text-xs text-on-surface-variant">Gunakan gambar landscape yang jelas. Biarkan kosong jika tidak ingin mengganti gambar.</p>
                        </div>

                        <div>
                            <label>Gambar Profil</label>
                            <div class="overflow-hidden rounded-2xl bg-slate-100 shadow-sm">
                                <img class="h-72 w-full object-cover" src="{{ $profileImage }}" alt="Preview gambar profil">
                            </div>
                            <input class="mt-4" name="profile_image" type="file" accept="image/*">
                            <p class="mt-2 text-xs text-on-surface-variant">Biarkan kosong jika tidak ingin mengganti gambar profil.</p>
                        </div>
                    </div>
                </div>
            </div>
        </details>

        <details id="school-profile-section" data-about-panel class="hidden group bg-surface-container-lowest rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            <summary class="list-none flex items-center justify-between gap-4">
                <div>
                    <span>Component 02</span>
                    <h3 class="font-headline text-primary">Data Sekolah & SDM</h3>
                </div>
                <button type="button" data-about-back class="inline-flex items-center gap-2 rounded-xl bg-slate-100 px-4 py-2 text-sm font-bold text-slate-600 hover:bg-slate-200 transition-colors">
                    <span class="material-symbols-outlined text-[18px]">arrow_back</span>
                    Kembali
                </button>
            </summary>
            <div class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
                    <div>
                        <label>Jumlah Siswa Laki-laki</label>
                        <input name="male_student_count" type="number" min="0" placeholder="Contoh: 168" value="{{ $about->male_student_count ?? 168 }}">
                    </div>
                    <div>
                        <label>Jumlah Siswa Perempuan</label>
                        <input name="female_student_count" type="number" min="0" placeholder="Contoh: 182" value="{{ $about->female_student_count ?? 182 }}">
                    </div>
                    <div>
                        <label>Total Kelas</label>
                        <input name="class_count" type="number" min="0" placeholder="Contoh: 12" value="{{ $about->class_count ?? 12 }}">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label>Jumlah Tenaga Pendidik</label>
                        <input name="educator_count" type="number" min="0" placeholder="Contoh: 42" value="{{ $about->educator_count ?? 42 }}">
                    </div>
                    <div>
                        <label>Jumlah Tenaga Kependidikan</label>
                        <input name="staff_count" type="number" min="0" placeholder="Contoh: 18" value="{{ $about->staff_count ?? 18 }}">
                    </div>
                </div>
            </div>
        </details>

        <details id="highlight-section" data-about-panel class="hidden group bg-surface-container-lowest rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            <summary class="list-none flex items-center justify-between gap-4">
                <div>
                    <span>Component 03</span>
                    <h3 class="font-headline text-primary">Highlight Atas</h3>
                </div>
                <button type="button" data-about-back class="inline-flex items-center gap-2 rounded-xl bg-slate-100 px-4 py-2 text-sm font-bold text-slate-600 hover:bg-slate-200 transition-colors">
                    <span class="material-symbols-outlined text-[18px]">arrow_back</span>
                    Kembali
                </button>
            </summary>
            <div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @for ($i = 0; $i < 3; $i++)
                    <div class="bg-surface-container-lowest p-6 rounded-2xl shadow-sm border border-slate-100 space-y-5">
                        <h4 class="text-lg font-bold text-primary font-headline">Highlight {{ $i + 1 }}</h4>
                        <input type="hidden" name="highlights[{{ $i }}][icon]" value="{{ $defaultHighlights[$i]['icon'] }}">
                        <div>
                            <label>Judul</label>
                            <input name="highlights[{{ $i }}][label]" placeholder="Contoh: Status" value="{{ data_get($about->highlights, $i.'.label') ?? $defaultHighlights[$i]['label'] }}">
                        </div>
                        <div>
                            <label>Isi</label>
                            <input name="highlights[{{ $i }}][title]" placeholder="Contoh: Akreditasi A" value="{{ data_get($about->highlights, $i.'.title') ?? $defaultHighlights[$i]['title'] }}">
                        </div>
                    </div>
                    @endfor
                </div>
            </div>
        </details>

        <details id="vision-section" data-about-panel class="hidden group bg-surface-container-lowest rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            <summary class="list-none flex items-center justify-between gap-4">
                <div>
                    <span>Component 04</span>
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
                <div>
                    <label>Misi</label>
                    <textarea name="missions_text" rows="8" placeholder="1. Tulis misi pertama&#10;2. Tulis misi kedua&#10;3. Tulis misi ketiga">{{ $missionsText }}</textarea>
                    <p class="mt-2 text-xs text-on-surface-variant">Tulis satu misi per baris. Nomor seperti 1, 2, 3 boleh ditulis dan akan dirapikan otomatis.</p>
                </div>
            </div>
        </details>

        <details id="facilities-section" data-about-panel class="hidden group bg-surface-container-lowest rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            <summary class="list-none flex items-center justify-between gap-4">
                <div>
                    <span>Component 05</span>
                    <h3 class="font-headline text-primary">Fasilitas</h3>
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
                </div>
                <input type="hidden" name="facilities_button_text" value="{{ $about->facilities_button_text ?? 'Lihat Semua Fasilitas' }}">
                <input type="hidden" name="facilities_button_link" value="{{ $about->facilities_button_link ?? '#' }}">
            </div>
        </details>

        <details id="facility-management-section" data-about-panel class="hidden group bg-surface-container-lowest rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            <summary class="list-none flex items-center justify-between gap-4">
                <div>
                    <span>Component 06</span>
                    <h3 class="font-headline text-primary">Manajemen Fasilitas</h3>
                </div>
                <div class="flex items-center gap-3">
                    <button type="button" data-about-back class="inline-flex items-center gap-2 rounded-xl bg-slate-100 px-4 py-2 text-sm font-bold text-slate-600 hover:bg-slate-200 transition-colors">
                        <span class="material-symbols-outlined text-[18px]">arrow_back</span>
                        Kembali
                    </button>
                    <a href="{{ route('admin.about.facilities.create') }}"
                        class="inline-flex items-center justify-center gap-2 rounded-xl bg-primary px-5 py-3 text-sm font-bold text-white shadow-lg hover:bg-primary-container transition-colors">
                        <span class="material-symbols-outlined text-[18px]">add</span>
                        Tambah Fasilitas
                    </a>
                </div>
            </summary>
            <div class="space-y-6">
                <div class="bg-surface-container-lowest rounded-2xl overflow-hidden shadow-[0_8px_30px_rgb(0,0,0,0.04)]">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-surface-container-low/50">
                                    <th class="px-8 py-5 text-[11px] font-bold text-slate-400 uppercase tracking-widest">No</th>
                                    <th class="px-6 py-5 text-[11px] font-bold text-slate-400 uppercase tracking-widest">Fasilitas</th>
                                    <th class="px-6 py-5 text-[11px] font-bold text-slate-400 uppercase tracking-widest">Deskripsi</th>
                                    <th class="px-6 py-5 text-[11px] font-bold text-slate-400 uppercase tracking-widest">Status</th>
                                    <th class="px-8 py-5 text-[11px] font-bold text-slate-400 uppercase tracking-widest text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="facility-table-body" class="divide-y divide-surface-container">
                                @foreach ($facilityItems as $i => $facility)
                                <tr class="group hover:bg-surface-container-low/30 transition-colors">
                                    <td class="px-8 py-4">
                                        <span class="inline-flex h-8 w-8 items-center justify-center rounded-lg bg-blue-50 text-sm font-bold text-primary">
                                            {{ $i + 1 }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <p class="font-bold text-blue-900 group-hover:text-primary transition-colors">
                                            {{ data_get($facility, 'title') }}
                                        </p>
                                    </td>
                                    <td class="px-6 py-4">
                                        <p class="max-w-xl text-sm text-on-surface-variant font-medium leading-relaxed line-clamp-2">
                                            {{ data_get($facility, 'desc') }}
                                        </p>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="flex items-center gap-1.5 text-xs font-bold text-emerald-600 bg-emerald-50 px-3 py-1 rounded-full w-fit">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Aktif
                                        </span>
                                    </td>
                                    <td class="px-8 py-4">
                                        <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('admin.about.facilities.edit', $i) }}"
                                            class="inline-flex h-10 w-10 items-center justify-center rounded-xl bg-slate-100 text-slate-500 hover:bg-amber-100 hover:text-amber-600 transition-colors"
                                            aria-label="Edit fasilitas">
                                            <span class="material-symbols-outlined text-[20px]">edit</span>
                                        </a>
                                        <button type="submit" form="delete-facility-{{ $i }}" onclick="return confirm('Hapus fasilitas ini?')"
                                            class="inline-flex h-10 w-10 items-center justify-center rounded-xl bg-error/10 text-error hover:bg-error hover:text-white transition-colors"
                                            aria-label="Hapus fasilitas">
                                            <span class="material-symbols-outlined text-[20px]">delete</span>
                                        </button>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </details>

        <details id="extracurricular-section" data-about-panel class="hidden group bg-surface-container-lowest rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            <summary class="list-none flex items-center justify-between gap-4">
                <div>
                    <span>Component 07</span>
                    <h3 class="font-headline text-primary">Ekstrakurikuler</h3>
                </div>
                <button type="button" data-about-back class="inline-flex items-center gap-2 rounded-xl bg-slate-100 px-4 py-2 text-sm font-bold text-slate-600 hover:bg-slate-200 transition-colors">
                    <span class="material-symbols-outlined text-[18px]">arrow_back</span>
                    Kembali
                </button>
            </summary>
            <div class="space-y-6">
                <input type="hidden" name="extracurricular_label" value="{{ $about->extracurricular_label ?? 'Pengembangan Diri' }}">
                @for ($i = 0; $i < 3; $i++)
                <input type="hidden" name="extracurricular_tags[{{ $i }}]" value="{{ data_get($about->extracurricular_tags, $i) ?? $defaultTags[$i] }}">
                @endfor

                <div>
                    <label>Judul Ekstrakurikuler</label>
                    <input name="extracurricular_title" value="{{ $about->extracurricular_title ?? 'Ekstrakurikuler Pilihan' }}">
                </div>
                <div>
                    <label>Deskripsi</label>
                    <textarea name="extracurricular_desc" rows="5">{{ $about->extracurricular_desc ?? 'Kami menyediakan wadah bagi siswa untuk mengeksplorasi minat di luar jam akademik dengan mentor yang kompeten.' }}</textarea>
                </div>
            </div>
        </details>

        <details id="extracurricular-management-section" data-about-panel class="hidden group bg-surface-container-lowest rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            <summary class="list-none flex items-center justify-between gap-4">
                <div>
                    <span>Component 08</span>
                    <h3 class="font-headline text-primary">Manajemen Ekstrakurikuler</h3>
                </div>
                <div class="flex items-center gap-3">
                    <button type="button" data-about-back class="inline-flex items-center gap-2 rounded-xl bg-slate-100 px-4 py-2 text-sm font-bold text-slate-600 hover:bg-slate-200 transition-colors">
                        <span class="material-symbols-outlined text-[18px]">arrow_back</span>
                        Kembali
                    </button>
                    <a href="{{ route('admin.about.extracurriculars.create') }}"
                        class="inline-flex items-center justify-center gap-2 rounded-xl bg-primary px-5 py-3 text-sm font-bold text-white shadow-lg hover:bg-primary-container transition-colors">
                        <span class="material-symbols-outlined text-[18px]">add</span>
                        Tambah Ekstrakurikuler
                    </a>
                </div>
            </summary>
            <div class="space-y-6">
                <div class="bg-surface-container-lowest rounded-2xl overflow-hidden shadow-[0_8px_30px_rgb(0,0,0,0.04)]">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-surface-container-low/50">
                                    <th class="px-8 py-5 text-[11px] font-bold text-slate-400 uppercase tracking-widest">No</th>
                                    <th class="px-6 py-5 text-[11px] font-bold text-slate-400 uppercase tracking-widest">Ekstrakurikuler</th>
                                    <th class="px-6 py-5 text-[11px] font-bold text-slate-400 uppercase tracking-widest">Deskripsi</th>
                                    <th class="px-6 py-5 text-[11px] font-bold text-slate-400 uppercase tracking-widest">Status</th>
                                    <th class="px-8 py-5 text-[11px] font-bold text-slate-400 uppercase tracking-widest text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-surface-container">
                                @foreach ($extracurricularItems as $i => $item)
                                <tr class="group hover:bg-surface-container-low/30 transition-colors">
                                    <td class="px-8 py-4">
                                        <span class="inline-flex h-8 w-8 items-center justify-center rounded-lg bg-blue-50 text-sm font-bold text-primary">
                                            {{ $i + 1 }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <p class="font-bold text-blue-900 group-hover:text-primary transition-colors">
                                            {{ data_get($item, 'title') }}
                                        </p>
                                    </td>
                                    <td class="px-6 py-4">
                                        <p class="max-w-xl text-sm text-on-surface-variant font-medium leading-relaxed line-clamp-2">
                                            {{ data_get($item, 'desc') }}
                                        </p>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="flex items-center gap-1.5 text-xs font-bold text-emerald-600 bg-emerald-50 px-3 py-1 rounded-full w-fit">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Aktif
                                        </span>
                                    </td>
                                    <td class="px-8 py-4">
                                        <div class="flex items-center justify-end gap-2">
                                            <a href="{{ route('admin.about.extracurriculars.edit', $i) }}"
                                                class="inline-flex h-10 w-10 items-center justify-center rounded-xl bg-slate-100 text-slate-500 hover:bg-amber-100 hover:text-amber-600 transition-colors"
                                                aria-label="Edit ekstrakurikuler">
                                                <span class="material-symbols-outlined text-[20px]">edit</span>
                                            </a>
                                            <button type="submit" form="delete-extracurricular-{{ $i }}" onclick="return confirm('Hapus ekstrakurikuler ini?')"
                                                class="inline-flex h-10 w-10 items-center justify-center rounded-xl bg-error/10 text-error hover:bg-error hover:text-white transition-colors"
                                                aria-label="Hapus ekstrakurikuler">
                                                <span class="material-symbols-outlined text-[20px]">delete</span>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </details>

        <div class="editor-actions bg-surface-container-lowest rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] px-8 py-6">
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

@foreach ($facilityItems as $i => $facility)
<form id="delete-facility-{{ $i }}" action="{{ route('admin.about.facilities.destroy', $i) }}" method="POST" class="hidden">
    @csrf
    @method('DELETE')
</form>
@endforeach

@foreach ($extracurricularItems as $i => $item)
<form id="delete-extracurricular-{{ $i }}" action="{{ route('admin.about.extracurriculars.destroy', $i) }}" method="POST" class="hidden">
    @csrf
    @method('DELETE')
</form>
@endforeach

<script>
const aboutOverview = document.getElementById('about-overview');
const aboutEditors = document.getElementById('about-editors');
const aboutPanels = document.querySelectorAll('[data-about-panel]');

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

@if(session('open_facility_management'))
showAboutEditor('facility-management-section');
@endif

@if(session('open_extracurricular_management'))
showAboutEditor('extracurricular-management-section');
@endif
</script>
@endsection
