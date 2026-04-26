@extends('layouts.admin')

@section('title', 'CMS Tentang Kami - SMAN Pintar')

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
];
$defaultExtracurriculars = [
    ['icon' => 'robot_2', 'title' => 'Robotic Club', 'desc' => 'Mengembangkan kecerdasan buatan dan perakitan mekanik robotik tingkat lanjut.'],
    ['icon' => 'public', 'title' => 'English Debate', 'desc' => 'Mengasah kemampuan argumentasi dan diplomasi internasional dalam bahasa Inggris.'],
    ['icon' => 'palette', 'title' => 'Visual Arts', 'desc' => 'Eksplorasi seni lukis, desain grafis, dan multimedia kreatif.'],
    ['icon' => 'campaign', 'title' => 'Journalism', 'desc' => 'Pelatihan penulisan berita, fotografi jurnalistik, dan penyiaran radio sekolah.'],
];
$defaultTags = ['#Creativity', '#Leadership', '#Innovation'];
@endphp

<form action="{{ route('admin.about.update') }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-12">
    @csrf

    @if(session('success'))
    <div class="bg-emerald-50 text-emerald-600 p-4 rounded-xl font-bold flex items-center gap-2 shadow-sm border border-emerald-100">
        <span class="material-symbols-outlined">check_circle</span>
        {{ session('success') }}
    </div>
    @endif

    <div class="flex justify-between items-end">
        <div>
            <span class="text-xs font-bold text-tertiary uppercase tracking-widest mb-1 block">CMS Page</span>
            <h2 class="text-3xl font-headline font-extrabold text-primary">Tentang Kami</h2>
        </div>
        <button type="submit" class="bg-gradient-to-br from-[#00357f] to-[#004aad] text-white px-6 py-2.5 rounded-xl font-bold text-sm shadow-lg">
            Save Changes
        </button>
    </div>

    <section class="bg-surface-container-lowest p-8 rounded-2xl shadow-sm space-y-6">
        <h3 class="text-2xl font-bold text-primary">Hero & Profil</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <input name="hero_title" class="bg-surface-container-low border-none rounded-xl px-4 py-3 font-bold" placeholder="Judul hero" value="{{ $about->hero_title ?? 'Tentang Kami' }}">
            <input name="hero_image" type="file" class="bg-surface-container-low border-none rounded-xl px-4 py-3">
            <input name="profile_label" class="bg-surface-container-low border-none rounded-xl px-4 py-3" placeholder="Label profil" value="{{ $about->profile_label ?? 'Ekselerasi Pendidikan' }}">
            <input name="profile_title" class="bg-surface-container-low border-none rounded-xl px-4 py-3 font-bold" placeholder="Judul profil" value="{{ $about->profile_title ?? 'Dedikasi Mencetak Generasi Unggul Riau' }}">
            <textarea name="profile_paragraph_1" class="bg-surface-container-low border-none rounded-xl px-4 py-3 md:col-span-2" rows="3">{{ $about->profile_paragraph_1 ?? 'SMAN Pintar Provinsi Riau berdiri sebagai mercusuar pendidikan berkualitas yang memadukan kurikulum nasional dengan inovasi teknologi terkini.' }}</textarea>
            <textarea name="profile_paragraph_2" class="bg-surface-container-low border-none rounded-xl px-4 py-3 md:col-span-2" rows="3">{{ $about->profile_paragraph_2 ?? 'Berlokasi di lingkungan yang asri namun modern, sekolah kami menjadi laboratorium masa depan bagi putra-putri terbaik daerah.' }}</textarea>
            <input name="profile_button_1_text" class="bg-surface-container-low border-none rounded-xl px-4 py-3" value="{{ $about->profile_button_1_text ?? 'Selengkapnya' }}">
            <input name="profile_button_1_link" class="bg-surface-container-low border-none rounded-xl px-4 py-3" value="{{ $about->profile_button_1_link ?? '#visi-misi' }}">
            <input name="profile_button_2_text" class="bg-surface-container-low border-none rounded-xl px-4 py-3" value="{{ $about->profile_button_2_text ?? 'Lihat Video Profil' }}">
            <input name="profile_button_2_link" class="bg-surface-container-low border-none rounded-xl px-4 py-3" value="{{ $about->profile_button_2_link ?? '#' }}">
            <input name="dedication_number" class="bg-surface-container-low border-none rounded-xl px-4 py-3" value="{{ $about->dedication_number ?? '15+' }}">
            <input name="dedication_label" class="bg-surface-container-low border-none rounded-xl px-4 py-3" value="{{ $about->dedication_label ?? 'Tahun Dedikasi' }}">
            <input name="profile_image" type="file" class="bg-surface-container-low border-none rounded-xl px-4 py-3 md:col-span-2">
        </div>
    </section>

    <section class="bg-surface-container-low p-8 rounded-2xl space-y-6">
        <h3 class="text-2xl font-bold text-primary">Highlight Atas</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            @for ($i = 0; $i < 3; $i++)
            <div class="bg-white p-5 rounded-xl space-y-3">
                <input name="highlights[{{ $i }}][icon]" class="w-full bg-surface-container-low border-none rounded-xl px-4 py-2" value="{{ data_get($about->highlights, $i.'.icon') ?? $defaultHighlights[$i]['icon'] }}">
                <input name="highlights[{{ $i }}][label]" class="w-full bg-surface-container-low border-none rounded-xl px-4 py-2" value="{{ data_get($about->highlights, $i.'.label') ?? $defaultHighlights[$i]['label'] }}">
                <input name="highlights[{{ $i }}][title]" class="w-full bg-surface-container-low border-none rounded-xl px-4 py-2 font-bold" value="{{ data_get($about->highlights, $i.'.title') ?? $defaultHighlights[$i]['title'] }}">
            </div>
            @endfor
        </div>
    </section>

    <section class="bg-surface-container-lowest p-8 rounded-2xl shadow-sm space-y-6">
        <h3 class="text-2xl font-bold text-primary">Visi & Misi</h3>
        <input name="vision_mission_title" class="w-full bg-surface-container-low border-none rounded-xl px-4 py-3 font-bold" value="{{ $about->vision_mission_title ?? 'Visi & Misi Kami' }}">
        <textarea name="vision" class="w-full bg-surface-container-low border-none rounded-xl px-4 py-3" rows="4">{{ $about->vision ?? 'Menjadi institusi pendidikan model yang unggul dalam prestasi akademik, berwawasan teknologi global, serta berakar kuat pada nilai-nilai karakter bangsa.' }}</textarea>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @for ($i = 0; $i < 4; $i++)
            <textarea name="missions[{{ $i }}]" class="bg-surface-container-low border-none rounded-xl px-4 py-3" rows="2">{{ data_get($about->missions, $i) ?? $defaultMissions[$i] }}</textarea>
            @endfor
        </div>
    </section>

    <section class="bg-surface-container-low p-8 rounded-2xl space-y-6">
        <h3 class="text-2xl font-bold text-primary">Fasilitas Unggulan</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <input name="facilities_label" class="bg-white border-none rounded-xl px-4 py-3" value="{{ $about->facilities_label ?? 'Infrastruktur Modern' }}">
            <input name="facilities_title" class="bg-white border-none rounded-xl px-4 py-3 font-bold" value="{{ $about->facilities_title ?? 'Fasilitas Unggulan' }}">
            <input name="facilities_button_text" class="bg-white border-none rounded-xl px-4 py-3" value="{{ $about->facilities_button_text ?? 'Lihat Semua Fasilitas' }}">
            <input name="facilities_button_link" class="bg-white border-none rounded-xl px-4 py-3" value="{{ $about->facilities_button_link ?? '#' }}">
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4">
            @for ($i = 0; $i < 4; $i++)
            <div class="bg-white p-5 rounded-xl space-y-3">
                <input name="facilities[{{ $i }}][icon]" class="w-full bg-surface-container-low border-none rounded-xl px-4 py-2" value="{{ data_get($about->facilities, $i.'.icon') ?? $defaultFacilities[$i]['icon'] }}">
                <input name="facilities[{{ $i }}][title]" class="w-full bg-surface-container-low border-none rounded-xl px-4 py-2 font-bold" value="{{ data_get($about->facilities, $i.'.title') ?? $defaultFacilities[$i]['title'] }}">
                <textarea name="facilities[{{ $i }}][desc]" class="w-full bg-surface-container-low border-none rounded-xl px-4 py-2" rows="3">{{ data_get($about->facilities, $i.'.desc') ?? $defaultFacilities[$i]['desc'] }}</textarea>
                <input name="facility_images[{{ $i }}]" type="file" class="w-full bg-surface-container-low border-none rounded-xl px-4 py-2">
                <input name="facilities[{{ $i }}][image]" type="hidden" value="{{ data_get($about->facilities, $i.'.image') }}">
            </div>
            @endfor
        </div>
    </section>

    <section class="bg-primary text-white p-8 rounded-2xl space-y-6">
        <h3 class="text-2xl font-bold">Ekstrakurikuler</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <input name="extracurricular_label" class="bg-white/10 border-white/10 rounded-xl px-4 py-3" value="{{ $about->extracurricular_label ?? 'Pengembangan Diri' }}">
            <input name="extracurricular_title" class="bg-white/10 border-white/10 rounded-xl px-4 py-3 font-bold" value="{{ $about->extracurricular_title ?? 'Ekstrakurikuler Pilihan' }}">
            <textarea name="extracurricular_desc" class="bg-white/10 border-white/10 rounded-xl px-4 py-3 md:col-span-2" rows="3">{{ $about->extracurricular_desc ?? 'Kami menyediakan wadah bagi siswa untuk mengeksplorasi minat di luar jam akademik dengan mentor yang kompeten.' }}</textarea>
            @for ($i = 0; $i < 3; $i++)
            <input name="extracurricular_tags[{{ $i }}]" class="bg-white/10 border-white/10 rounded-xl px-4 py-3" value="{{ data_get($about->extracurricular_tags, $i) ?? $defaultTags[$i] }}">
            @endfor
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4">
            @for ($i = 0; $i < 4; $i++)
            <div class="bg-white/10 p-5 rounded-xl space-y-3">
                <input name="extracurriculars[{{ $i }}][icon]" class="w-full bg-white/10 border-white/10 rounded-xl px-4 py-2" value="{{ data_get($about->extracurriculars, $i.'.icon') ?? $defaultExtracurriculars[$i]['icon'] }}">
                <input name="extracurriculars[{{ $i }}][title]" class="w-full bg-white/10 border-white/10 rounded-xl px-4 py-2 font-bold" value="{{ data_get($about->extracurriculars, $i.'.title') ?? $defaultExtracurriculars[$i]['title'] }}">
                <textarea name="extracurriculars[{{ $i }}][desc]" class="w-full bg-white/10 border-white/10 rounded-xl px-4 py-2" rows="3">{{ data_get($about->extracurriculars, $i.'.desc') ?? $defaultExtracurriculars[$i]['desc'] }}</textarea>
            </div>
            @endfor
        </div>
    </section>
</form>
@endsection
