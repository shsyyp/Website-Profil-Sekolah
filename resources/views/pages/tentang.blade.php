@extends('layouts.main')

@section('title', 'Tentang Kami - SMAN Pintar Provinsi Riau')

@section('content')
@php
$defaultHeroImage = 'https://lh3.googleusercontent.com/aida-public/AB6AXuCnyXL0n2V3ExwtRVjX6KOHtBjTOnVIX58cuwpTdsZ10cb_nCteZuARseMIS6crt1FFD6gNKlnBSigsoGo0P74haJ1Jyw94LOUG4oD5wQ79xQsCwHhuZ_bIF7y4n85MRdei8AZO8g-PC6vcDuMy5pwC_Kh6ZtrTRWEPXY6npGoVCdpwai3TpB4H79IomqONsqfd1asST1pPbdHvVm2Gp65yxax3CTGeOntbO7zMGDevw0loDMm0UX5LVbukJzyxTd_NawUdj_UgYnsu';
$defaultProfileImage = 'https://lh3.googleusercontent.com/aida-public/AB6AXuBrZysYUdrrL-V6NkqRMcowI2PjJ3jJSnWaNfnkHkl-Cx_NlmDk7BWkZhqAzzuuqAWmuPDc3PFbbjm11r7Adqf3FEw_tC6POJL4IzaJKA1rh3cJBuPq3bCTGxQMldXLtlBmbWI7fNmV9YTpfHBXkJvuXFCJ85hF4zpr0pNx7LNg7GYKf0E6kv2oMcBp26bf8SSu8Er4npt_Fho9tE00K6tCPXKGkntv1FjLo9t1o6e2qcTa7n6HkbNo0FuojG1nRk1I7zj0QFoN02Lw';
$defaultFacilityImages = [
    'https://lh3.googleusercontent.com/aida-public/AB6AXuAKvhx9m3BO3VGIlQ-Z9A8lNb3RRRMUFGkFJk4jYkdX1ScYp9XOVkpCvR7b6uc8dLAY-Rjolvrc0r-mZ731MdXazRSAh8GBUNLJYsWldyvnuEPXpfIgk2FDJELNglVmcVp1h4uImcx9_k43mqrkFclYpsADl7TDwn-Liw8vGAi-_9UJzZ2TRgxYfiGlW0Wu2mkaeVai9ez2Eb0R5AiRtDtYltD_xIZjYICj1sd1viNNrai4theGWcUpsl7pV1EeErbC6e8PYDBGNlC8',
    'https://lh3.googleusercontent.com/aida-public/AB6AXuCBnDSZhDHoTUMPzDc8y_N7GtbRP15yn4aWR7suk8dr24hgMGarPYoe5qO42athlDPdB6iw-oxrNqAHMJV-yEKcAgAFVIxSGZPhoj2ikI90lvjJiow4ylvxKN4wHiM1N2K4JUt5ucLdW1iFr-hhbdqEnFvE6ZLWou80HXjULYo24l2I1dxzI8NhtCLHwdpX6_l2kAalQpDcJWfJDUKfdBMC-c5UynbdKNas2BNvFGFnnauFCRUP9EWQbp2rifhub8lmxmcVvQ46p6kc',
    'https://lh3.googleusercontent.com/aida-public/AB6AXuDfLykeBHg41Q0_Qyy3eGYtFtUv98HhcL0FUA00xUEvBElOJboHZtbsbr9l-RUgstBml92mO736qUVR8ETJId9bD7FYHj5BZA8ANlMal-1zm5VIAEfOlFlV-hOi8A3AMZQ6dXUIqhjZTpowcSeKvRvFvMzeZtAdSL88oa6WMy_jq4Liv_njRPPc81TgDoKZuwd6Ho8W_u41Ts9CqqmTDYHqwXdp6rjQQdx9LZDpopmXv8CCCQXjb6Ks-xEuWm8Rs1a4ahQ6mUoYWakc',
    'https://lh3.googleusercontent.com/aida-public/AB6AXuAEZCrDWutJV_jSkfohmrSodNxQTzTaa8XBbytISjCG135BplLearA3wHbuUVRvYg1CkZ4ybt-1KSMsYd1UTaAf40UapAWgcKdRk-wpzYX3aILzW6clEQgf4CbxMiBy1PD3LZ-EHyH27OS02rgemNFMKxGIaCyDCc7EoBtPwCgrlel1g4Qmp0PQ3yJGpzf-A7DMPp5gX90jQgbhsWc_3Ijj7SEEn9TBR_a4Pw4yfSoVWy_MClML9lGPzAGBW9BGAgj5EyPN9Lwj9JHI',
];
$highlights = $about?->highlights ?: [
    ['icon' => 'verified', 'label' => 'Status', 'title' => 'Akreditasi A'],
    ['icon' => 'memory', 'label' => 'Metode', 'title' => 'Berbasis Teknologi'],
    ['icon' => 'home_work', 'label' => 'Layanan', 'title' => 'Asrama Eksklusif'],
];
$missions = $about?->missions ?: [
    'Menyelenggarakan pembelajaran berbasis ICT yang inovatif dan interaktif.',
    'Mengembangkan potensi minat dan bakat siswa melalui program pembinaan intensif.',
    'Membangun ekosistem sekolah yang religius, jujur, dan berdisiplin tinggi.',
    'Mewujudkan kolaborasi strategis dengan institusi pendidikan internasional.',
];
$facilities = $about?->facilities ?: [
    ['icon' => 'biotech', 'title' => 'Lab Riset & Sains', 'desc' => 'Dilengkapi peralatan standar olimpiade internasional.'],
    ['icon' => 'auto_stories', 'title' => 'Perpustakaan Digital', 'desc' => 'Akses ke ribuan jurnal dan e-book global 24/7.'],
    ['icon' => 'sports_basketball', 'title' => 'Sport Center', 'desc' => 'Gedung olahraga indoor untuk basket, futsal, dan badminton.'],
    ['icon' => 'theater_comedy', 'title' => 'Teater Seni', 'desc' => 'Ruang pertunjukan dengan sistem tata suara mutakhir.'],
];
$facilities = collect($facilities)
    ->filter(fn ($facility) => filled($facility['title'] ?? null))
    ->values();
$extracurricularTags = $about?->extracurricular_tags ?: ['#Creativity', '#Leadership', '#Innovation'];
$extracurriculars = $about?->extracurriculars ?: [
    ['icon' => 'robot_2', 'title' => 'Robotic Club', 'desc' => 'Mengembangkan kecerdasan buatan dan perakitan mekanik robotik tingkat lanjut.'],
    ['icon' => 'public', 'title' => 'English Debate', 'desc' => 'Mengasah kemampuan argumentasi dan diplomasi internasional dalam bahasa Inggris.'],
    ['icon' => 'palette', 'title' => 'Visual Arts', 'desc' => 'Eksplorasi seni lukis, desain grafis, dan multimedia kreatif.'],
    ['icon' => 'campaign', 'title' => 'Journalism', 'desc' => 'Pelatihan penulisan berita, fotografi jurnalistik, dan penyiaran radio sekolah.'],
];
$extracurriculars = collect($extracurriculars)
    ->filter(fn ($item) => filled($item['title'] ?? null))
    ->values();
$maleStudentCount = (int) ($about?->male_student_count ?? 168);
$femaleStudentCount = (int) ($about?->female_student_count ?? 182);
$studentCount = $maleStudentCount + $femaleStudentCount;
$classCount = (int) ($about?->class_count ?? 12);
$educatorCount = (int) ($about?->educator_count ?? 42);
$staffCount = (int) ($about?->staff_count ?? 18);
$maleBar = $studentCount > 0 ? (int) round(($maleStudentCount / $studentCount) * 100) : 0;
$femaleBar = $studentCount > 0 ? 100 - $maleBar : 0;
$malePercentage = $maleBar . '%';
$femalePercentage = $femaleBar . '%';
@endphp

{{-- Hero Section & Breadcrumb --}}
<section class="relative h-64 flex items-center overflow-hidden bg-primary-container">
    <div class="absolute inset-0 opacity-20">
        <img alt="School background" class="w-full h-full object-cover"
            data-alt="abstract blurred view of a modern school library with soft lighting and bookshelves in the background"
            src="{{ $about?->hero_image ? asset('storage/' . $about->hero_image) : $defaultHeroImage }}" />
    </div>
    <div class="relative z-10 max-w-7xl mx-auto px-8 w-full">
        <nav class="flex mb-4 text-on-primary-container/80 text-sm font-medium">
            <a href="{{ url('/') }}"
                class="hover:text-on-primary-container cursor-pointer transition-colors">Beranda</a>
            <span class="mx-2 material-symbols-outlined text-sm leading-none">chevron_right</span>
            <span class="text-on-primary-container">Tentang Kami</span>
        </nav>
        <h1 class="text-4xl md:text-5xl font-extrabold text-on-primary-container font-headline tracking-tight">{{ $about?->hero_title ?? 'Tentang Kami' }}</h1>
    </div>
</section>

{{-- Highlights (Status, Metode, Layanan) --}}
<section class="py-8 -mt-12 relative z-20 max-w-7xl mx-auto px-8">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach ($highlights as $index => $item)
        <div
            class="bg-surface-container-lowest p-6 rounded-xl shadow-[0_24px_40px_rgba(25,27,34,0.04)] flex items-center gap-5 group hover:translate-y-[-4px] transition-all min-h-[112px]">
            <div class="w-14 h-14 rounded-lg {{ $index === 0 ? 'bg-tertiary-container/20 text-tertiary' : ($index === 1 ? 'bg-primary-container/10 text-primary' : 'bg-secondary-container/30 text-secondary') }} flex shrink-0 items-center justify-center">
                <span class="material-symbols-outlined text-2xl">{{ $item['icon'] ?? 'verified' }}</span>
            </div>
            <div class="text-left">
                <p class="{{ $index === 0 ? 'text-tertiary' : ($index === 1 ? 'text-primary' : 'text-secondary') }} text-xs font-bold uppercase tracking-widest mb-1">{{ $item['label'] ?? 'Status' }}</p>
                <h3 class="text-xl font-bold font-headline">{{ $item['title'] ?? 'Akreditasi A' }}</h3>
            </div>
        </div>
        @endforeach
    </div>
</section>

{{-- Profil Sekolah --}}
<section class="py-20 max-w-7xl mx-auto px-8 grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
    <div class="order-2 lg:order-1">
        <span class="text-tertiary font-bold text-sm tracking-[0.2em] uppercase mb-4 block">{{ $about?->profile_label ?? 'Ekselerasi Pendidikan' }}</span>
        <h2 class="text-4xl md:text-5xl font-extrabold font-headline leading-tight mb-8">{{ $about?->profile_title ?? 'Mencetak Generasi Unggul Riau' }}</h2>
        <div class="space-y-6 text-on-surface-variant leading-relaxed text-lg">
            <p>{{ $about?->profile_paragraph_1 ?? 'SMAN Pintar Provinsi Riau berdiri sebagai mercusuar pendidikan berkualitas yang memadukan kurikulum nasional dengan inovasi teknologi terkini.' }}</p>
            <p>{{ $about?->profile_paragraph_2 ?? 'Berlokasi di lingkungan yang asri namun modern, sekolah kami menjadi laboratorium masa depan bagi putra-putri terbaik daerah.' }}</p>
        </div>
        <div class="mt-10 flex gap-4">
            <a href="{{ $about?->profile_button_1_link ?? '#visi-misi' }}"
                class="bg-primary text-on-primary px-8 py-4 rounded-xl font-bold font-headline hover:shadow-lg transition-shadow">{{ $about?->profile_button_1_text ?? 'Selengkapnya' }}</a>
        </div>
    </div>
    <div class="order-1 lg:order-2 relative">
        <div class="aspect-square rounded-2xl overflow-hidden shadow-2xl">
            <img alt="School building architecture" class="w-full h-full object-cover"
                data-alt="Modern architectural view of a university or high school campus"
                src="{{ $about?->profile_image ? asset('storage/' . $about->profile_image) : $defaultProfileImage }}" />
        </div>
    </div>
</section>

{{-- Data Sekolah & SDM --}}
<section class="pb-20 max-w-7xl mx-auto px-8">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2 grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div class="bg-surface-container-lowest rounded-xl border border-slate-100 p-6 shadow-[0_24px_40px_rgba(25,27,34,0.04)]">
                <p class="text-sm font-bold uppercase tracking-widest text-primary">Jumlah Siswa</p>
                <p class="mt-5 text-4xl font-extrabold font-headline text-on-surface">{{ $studentCount }}</p>
            </div>
            <div class="bg-surface-container-lowest rounded-xl border border-slate-100 p-6 shadow-[0_24px_40px_rgba(25,27,34,0.04)]">
                <p class="text-sm font-bold uppercase tracking-widest text-tertiary">Jumlah Kelas</p>
                <p class="mt-5 text-4xl font-extrabold font-headline text-on-surface">{{ $classCount }}</p>
            </div>
            <div class="sm:col-span-2 bg-surface-container-lowest rounded-xl border border-slate-100 p-6 shadow-[0_24px_40px_rgba(25,27,34,0.04)]">
                <p class="mb-6 text-sm font-bold uppercase tracking-widest text-secondary">Perbandingan Siswa</p>
                <div class="space-y-5">
                    <div>
                        <div class="mb-2 flex items-center justify-between text-sm font-bold">
                            <span>Laki-laki</span>
                            <span>{{ $malePercentage }}</span>
                        </div>
                        <div class="h-3 rounded-full bg-surface-container overflow-hidden">
                            <div class="h-full rounded-full bg-primary" style="width: {{ $maleBar }}%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="mb-2 flex items-center justify-between text-sm font-bold">
                            <span>Perempuan</span>
                            <span>{{ $femalePercentage }}</span>
                        </div>
                        <div class="h-3 rounded-full bg-surface-container overflow-hidden">
                            <div class="h-full rounded-full bg-tertiary" style="width: {{ $femaleBar }}%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-primary text-on-primary rounded-xl p-8 shadow-[0_24px_40px_rgba(25,27,34,0.08)]">
            <p class="text-tertiary-fixed font-bold text-sm tracking-[0.2em] uppercase mb-4">Profil SDM</p>
            <h3 class="text-2xl font-extrabold font-headline leading-tight mb-5">Tenaga pendidik dan kependidikan profesional</h3>
            <p class="text-on-primary/75 leading-relaxed">Kegiatan belajar didampingi guru, tenaga kependidikan, dan tim layanan sekolah yang bekerja terpadu untuk mendukung perkembangan akademik, karakter, dan keseharian siswa.</p>
            <div class="mt-8 grid grid-cols-2 gap-4">
                <div class="rounded-lg bg-white/10 p-4">
                    <p class="text-3xl font-extrabold font-headline">{{ $educatorCount }}</p>
                    <p class="mt-1 text-xs font-bold uppercase tracking-widest text-on-primary/65">Pendidik</p>
                </div>
                <div class="rounded-lg bg-white/10 p-4">
                    <p class="text-3xl font-extrabold font-headline">{{ $staffCount }}</p>
                    <p class="mt-1 text-xs font-bold uppercase tracking-widest text-on-primary/65">Kependidikan</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Visi & Misi --}}
<section id="visi-misi" class="py-24 bg-surface-container-low">
    <div class="max-w-7xl mx-auto px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-extrabold font-headline mb-4">{{ $about?->vision_mission_title ?? 'Visi & Misi Kami' }}</h2>
            <div class="w-24 h-1.5 bg-tertiary mx-auto rounded-full"></div>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <div
                class="bg-surface-container-lowest p-10 rounded-2xl shadow-[0_24px_40px_rgba(25,27,34,0.04)] border-l-8 border-primary">
                <div class="flex items-center gap-4 mb-6">
                    <span class="material-symbols-outlined text-4xl text-primary">visibility</span>
                    <h3 class="text-2xl font-extrabold font-headline uppercase tracking-tight">Visi</h3>
                </div>
                <p class="text-xl font-medium leading-relaxed italic text-primary/80">"{{ $about?->vision ?? 'Menjadi institusi pendidikan model yang unggul dalam prestasi akademik, berwawasan teknologi global, serta berakar kuat pada nilai-nilai karakter bangsa.' }}"</p>
            </div>
            <div
                class="bg-surface-container-lowest p-10 rounded-2xl shadow-[0_24px_40px_rgba(25,27,34,0.04)] border-l-8 border-tertiary">
                <div class="flex items-center gap-4 mb-6">
                    <span class="material-symbols-outlined text-4xl text-tertiary">flag</span>
                    <h3 class="text-2xl font-extrabold font-headline uppercase tracking-tight">Misi</h3>
                </div>
                <ul class="space-y-4">
                    @foreach ($missions as $mission)
                    <li class="flex items-start gap-4">
                        <span class="material-symbols-outlined text-tertiary shrink-0 mt-1">check_circle</span>
                        <p class="text-on-surface-variant font-medium">{{ $mission }}</p>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</section>

<style>
    .facility-scrollbar {
        scrollbar-width: none;
    }

    .facility-scrollbar::-webkit-scrollbar {
        display: none;
    }

    .extracurricular-scrollbar {
        scrollbar-width: none;
    }

    .extracurricular-scrollbar::-webkit-scrollbar {
        display: none;
    }
</style>

{{-- Fasilitas --}}
<section class="py-24 max-w-7xl mx-auto px-8">
    <div class="flex flex-col md:flex-row md:items-end justify-between mb-16 gap-6">
        <div>
            <span class="text-primary font-bold text-sm tracking-[0.2em] uppercase mb-4 block">{{ $about?->facilities_label ?? 'Infrastruktur Modern' }}</span>
            <h2 class="text-3xl md:text-4xl font-extrabold font-headline">{{ $about?->facilities_title ?? 'Fasilitas Unggulan' }}</h2>
        </div>
        <div class="flex items-center gap-3">
            <button type="button" data-facility-prev
                class="w-11 h-11 rounded-xl bg-surface-container text-primary flex items-center justify-center hover:bg-primary hover:text-on-primary transition-colors"
                aria-label="Fasilitas sebelumnya">
                <span class="material-symbols-outlined">chevron_left</span>
            </button>
            <button type="button" data-facility-next
                class="w-11 h-11 rounded-xl bg-surface-container text-primary flex items-center justify-center hover:bg-primary hover:text-on-primary transition-colors"
                aria-label="Fasilitas berikutnya">
                <span class="material-symbols-outlined">chevron_right</span>
            </button>
        </div>
    </div>
    <div data-facility-slider class="facility-scrollbar flex gap-8 overflow-x-auto scroll-smooth snap-x snap-mandatory pb-4">
        @foreach ($facilities as $index => $facility)
        <div class="group cursor-pointer min-w-[280px] sm:min-w-[320px] lg:min-w-[360px] snap-start">
            <div class="relative h-64 rounded-xl overflow-hidden mb-4 shadow-md">
                <img alt="{{ $facility['title'] ?? 'Fasilitas' }}"
                    class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                    src="{{ isset($facility['image']) && $facility['image'] ? asset('storage/' . $facility['image']) : ($defaultFacilityImages[$index] ?? $defaultFacilityImages[0]) }}" />
            </div>
            <h4 class="text-lg font-bold font-headline group-hover:text-primary transition-colors">{{ $facility['title'] ?? 'Fasilitas' }}</h4>
            <p class="text-sm text-on-surface-variant">{{ $facility['desc'] ?? 'Deskripsi fasilitas akan diperbarui.' }}</p>
        </div>
        @endforeach
    </div>
</section>

<script>
const facilitySlider = document.querySelector('[data-facility-slider]');
const facilityPrev = document.querySelector('[data-facility-prev]');
const facilityNext = document.querySelector('[data-facility-next]');

function scrollFacilities(direction) {
    if (!facilitySlider) {
        return;
    }

    const card = facilitySlider.querySelector('.snap-start');
    const distance = card ? card.getBoundingClientRect().width + 32 : 360;
    facilitySlider.scrollBy({ left: direction * distance, behavior: 'smooth' });
}

facilityPrev?.addEventListener('click', () => scrollFacilities(-1));
facilityNext?.addEventListener('click', () => scrollFacilities(1));

</script>

{{-- Ekstrakurikuler --}}
<section class="py-24 bg-primary text-on-primary">
    <div class="max-w-7xl mx-auto px-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-16 items-start">
            <div>
                <span class="text-tertiary-fixed font-bold text-sm tracking-[0.2em] uppercase mb-4 block">{{ $about?->extracurricular_label ?? 'Pengembangan Diri' }}</span>
                <h2 class="text-4xl font-extrabold font-headline leading-tight mb-6">{{ $about?->extracurricular_title ?? 'Ekstrakurikuler Pilihan' }}</h2>
                <p class="text-on-primary/70 text-lg">{{ $about?->extracurricular_desc ?? 'Kami menyediakan wadah bagi siswa untuk mengeksplorasi minat di luar jam akademik dengan mentor yang kompeten.' }}</p>
            </div>
            <div class="lg:col-span-2 min-w-0">
                <div class="mb-8 flex items-center justify-end gap-3">
                    <button type="button" data-extracurricular-prev
                        class="w-11 h-11 rounded-xl bg-white/10 text-on-primary flex items-center justify-center hover:bg-tertiary-fixed hover:text-on-tertiary-fixed transition-colors"
                        aria-label="Ekstrakurikuler sebelumnya">
                        <span class="material-symbols-outlined">chevron_left</span>
                    </button>
                    <button type="button" data-extracurricular-next
                        class="w-11 h-11 rounded-xl bg-white/10 text-on-primary flex items-center justify-center hover:bg-tertiary-fixed hover:text-on-tertiary-fixed transition-colors"
                        aria-label="Ekstrakurikuler berikutnya">
                        <span class="material-symbols-outlined">chevron_right</span>
                    </button>
                </div>
                <div data-extracurricular-slider class="extracurricular-scrollbar flex gap-6 overflow-x-auto scroll-smooth snap-x snap-mandatory pb-4">
                    @foreach ($extracurriculars as $index => $item)
                    <div class="min-w-[240px] sm:min-w-[280px] lg:min-w-[320px] min-h-[150px] snap-start bg-white/5 backdrop-blur-md p-6 rounded-xl border border-white/10 hover:bg-white/10 transition-colors">
                        <h4 class="text-xl font-bold font-headline mb-2">{{ $item['title'] ?? 'Ekstrakurikuler' }}</h4>
                        <p class="text-sm text-on-primary/60">{{ $item['desc'] ?? 'Deskripsi ekstrakurikuler akan diperbarui.' }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

<script>
const extracurricularSlider = document.querySelector('[data-extracurricular-slider]');
const extracurricularPrev = document.querySelector('[data-extracurricular-prev]');
const extracurricularNext = document.querySelector('[data-extracurricular-next]');

function scrollExtracurriculars(direction) {
    if (!extracurricularSlider) {
        return;
    }

    const card = extracurricularSlider.querySelector('.snap-start');
    const distance = card ? card.getBoundingClientRect().width + 24 : 360;
    extracurricularSlider.scrollBy({ left: direction * distance, behavior: 'smooth' });
}

extracurricularPrev?.addEventListener('click', () => scrollExtracurriculars(-1));
extracurricularNext?.addEventListener('click', () => scrollExtracurriculars(1));
</script>
@endsection
