@extends('layouts.main')

@section('title', 'Beranda - SMAN Pintar Provinsi Riau')

@section('content')
@php
$tradisiItems = $homepage?->tradisi ?: [
    ['title' => 'Kurikulum Adaptif', 'desc' => 'Kurikulum yang memadukan standar nasional dengan program persiapan olimpiade dan masuk PTN unggulan.', 'icon' => 'school'],
    ['title' => 'Sistem Boarding', 'desc' => 'Lingkungan asrama yang aman dan kondusif untuk mendukung pertumbuhan kemandirian dan spiritual siswa.', 'icon' => 'home'],
    ['title' => 'Pembinaan Intensif', 'desc' => 'Program bimbingan khusus untuk lomba akademik dan non-akademik di tingkat provinsi hingga internasional.', 'icon' => 'emoji_events'],
    ['title' => 'Alumni Network', 'desc' => 'Jaringan alumni luas yang tersebar di berbagai sektor profesional dan perguruan tinggi bergengsi.', 'icon' => 'groups'],
];

$fasilitasItems = $homepage?->fasilitas ?: [
    ['title' => 'Perpustakaan Digital', 'desc' => 'Akses ke ribuan jurnal internasional dan koleksi buku fisik terlengkap di Riau.', 'icon' => 'local_library'],
    ['title' => 'Lab Terpadu', 'desc' => 'Fisika, Kimia, Biologi, dan Lab Komputer terbaru.', 'icon' => 'science'],
    ['title' => 'Asrama Modern', 'desc' => 'Kamar yang nyaman dengan pengawasan 24 jam.', 'icon' => 'apartment'],
    ['title' => 'Sport Center', 'desc' => 'Lapangan basket indoor, futsal, dan area atletik standar nasional.', 'icon' => 'sports_basketball'],
];
@endphp

<section class="relative min-h-[921px] flex items-center px-6 overflow-hidden">
    <div class="absolute inset-0 z-0">
        <img alt="Campus" class="w-full h-full object-cover grayscale-[20%]"
            data-alt="Modern architectural school campus building with large windows and lush green landscaping during soft morning sunlight"
            src="{{ $homepage?->hero_image ? asset('storage/' . $homepage->hero_image) : 'https://lh3.googleusercontent.com/aida-public/AB6AXuDbEck_1x1stX4kchIbJmQMOkVAduOZd4f80kqVCezJu1ZPVyguVYNDL5J6jQ6RVzMqbhygErZsT4V8P-fxYVDwYzlMttzIfP62ovhKKLfCPlilDx86OV070AZP_8SMSMY7bygnj6RNhcWA1DwWMsiVxh09boINlQt8HhHEQtpRtqSzzb-UkIYCBhEIi9fQ8-WNqs63W2-8a9nb87slf6_D6CYIR18dJHvs0aToJMtqNm3_LQ3i81UWuadyHm6uGv29SFF2kEu0c3DG' }}" />
        <div class="absolute inset-0 bg-gradient-to-r from-surface via-surface/80 to-transparent"></div>
    </div>
    <div class="relative z-10 max-w-7xl mx-auto w-full grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
        <div class="space-y-8">
            <div
                class="inline-block px-4 py-1.5 rounded-full bg-tertiary-fixed text-on-tertiary-fixed text-xs font-bold uppercase tracking-widest">
                {{ $homepage?->hero_label ?? 'Provinsi Riau' }}
            </div>
            <h1 class="text-5xl md:text-7xl font-black font-headline text-primary tracking-tight leading-[1.1]">
                {{ $homepage?->hero_title ?? 'Mencetak Generasi Unggul dan Berprestasi' }}
            </h1>
            <p class="text-lg text-secondary max-w-lg leading-relaxed">
                {{ $homepage?->hero_subtitle ?? 'Sekolah Unggulan Berbasis Asrama di Riau yang mengintegrasikan kecerdasan akademik, karakter mulia, dan inovasi teknologi.' }}
            </p>
            <div class="flex flex-wrap gap-4">
                <a href="{{ $homepage?->hero_button1_link ?: ($pmb?->link_pendaftaran ?: route('pmb')) }}"
                    class="primary-gradient text-on-primary px-8 py-4 rounded-md font-bold text-lg hover:scale-105 active:scale-95 transition-all shadow-xl shadow-primary/20">
                    {{ $homepage?->hero_button1_text ?? 'Daftar PMB' }}
                </a>
                <a href="{{ $homepage?->hero_button2_link ?: route('tentang') }}"
                    class="px-8 py-4 rounded-md font-bold text-lg border-2 border-primary/20 text-primary hover:bg-primary/5 transition-all">
                    {{ $homepage?->hero_button2_text ?? 'Lihat Profil' }}
                </a>
            </div>
        </div>
        <div class="hidden md:block relative">
            <div class="absolute -top-10 -right-10 w-64 h-64 bg-tertiary/10 rounded-full blur-3xl"></div>
            <div
                class="relative bg-white/40 backdrop-blur-xl border border-white/40 p-8 rounded-md shadow-2xl overflow-hidden group">
                <img alt="Student"
                    class="rounded-md w-full h-[400px] object-cover transition-transform duration-700 group-hover:scale-110"
                    data-alt="High school students in neat blue uniforms discussing a project with a tablet in a modern sunlit library setting"
                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuDSEccOsqSQv6m5MulAy7Nai2PfFp8lKz-h91phjw5wssfC3smtyVexwy_Ow0nA1lCuM9flw1DdmR5TWSyZs56dIUnjLILXGeLbVgzUYMBdbr92lwAbffStPJtyPaFd3V3r2pKQ0EXFGyaTQyEyuNcJZSRXnoXq4-Gj4GBP7y2IVSJzdlYAUNiN98WWyFnuIsXNWm6MhtTjqoL15p0HF3SLiAny79rJ4rHIpXdFO6715mKQpwPbm-23nCXeX4Gazj3SDdeAZCs6jtf8" />
                <div
                    class="absolute bottom-12 left-12 right-12 bg-primary-container/90 backdrop-blur-lg p-6 rounded-md text-on-primary-container">
                    <p class="text-sm uppercase tracking-widest font-bold opacity-80 mb-2">Success Story</p>
                    <p class="text-xl font-bold leading-tight">{{ $homepage?->success_title ?? 'Mencetak 500+ Alumni di Universitas Terbaik Dunia' }}</p>
                    <p class="text-sm opacity-80 mt-2">{{ $homepage?->success_desc ?? 'Cerita sukses siswa dan alumni SMAN Pintar Provinsi Riau.' }}</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-24 bg-surface">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-16 items-start">
            <div class="lg:col-span-1">
                <p class="text-tertiary font-bold text-sm tracking-[0.2em] uppercase mb-4">{{ $homepage?->about_label ?? 'About SMAN Pintar' }}</p>
                <h2 class="text-4xl font-black font-headline text-primary mb-6 leading-tight">{{ $homepage?->about_title ?? 'Tradisi Keunggulan, Masa Depan Gemilang' }}</h2>
                <p class="text-secondary leading-relaxed mb-8">
                    {{ $homepage?->about_desc ?? 'Didirikan sebagai pusat inkubasi talenta terbaik di Provinsi Riau, SMAN Pintar menerapkan sistem asrama terintegrasi yang fokus pada pembentukan karakter dan penguasaan sains teknologi.' }}
                </p>
                <div class="flex items-center gap-4 p-4 bg-surface-container rounded-md">
                    <div
                        class="w-12 h-12 rounded-full primary-gradient flex items-center justify-center text-on-primary">
                        <span class="material-symbols-outlined">verified</span>
                    </div>
                    <div>
                        <p class="font-bold text-primary">{{ $homepage?->accreditation_title ?? 'Akreditasi A' }}</p>
                        <p class="text-xs text-secondary">{{ $homepage?->accreditation_desc ?? 'Sertifikasi Nasional & Internasional' }}</p>
                    </div>
                </div>
            </div>
            <div class="lg:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach ($tradisiItems as $index => $item)
                <div
                    class="p-8 bg-surface-container-lowest rounded-md shadow-sm hover:shadow-xl hover:-translate-y-2 transition-all duration-300">
                    <div class="flex items-center justify-between {{ $index === 2 ? 'mb-4' : '' }}">
                        <span class="material-symbols-outlined text-tertiary text-4xl {{ $index === 2 ? '' : 'mb-4' }}">{{ $item['icon'] ?? ['school', 'home', 'emoji_events', 'groups'][$index] ?? 'verified' }}</span>
                        @if ($index === 2)
                        <span
                            class="px-3 py-1 bg-tertiary-container/20 text-on-tertiary-container rounded-full text-[10px] font-bold uppercase">Prestasi</span>
                        @endif
                    </div>
                    <h3 class="text-xl font-bold text-primary mb-3">{{ $item['title'] ?? 'Keunggulan SMAN Pintar' }}</h3>
                    <p class="text-on-surface-variant text-sm leading-relaxed">{{ $item['desc'] ?? 'Deskripsi konten keunggulan akan diperbarui.' }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<section class="py-24 bg-surface-container-low">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center max-w-2xl mx-auto mb-16">
            <h2 class="text-4xl font-black font-headline text-primary mb-4">{{ $homepage?->facilities_title ?? 'Fasilitas & Ekosistem' }}</h2>
            <p class="text-secondary">{{ $homepage?->facilities_subtitle ?? 'Kami menyediakan infrastruktur terbaik untuk mendukung setiap langkah eksplorasi siswa.' }}</p>
        </div>
        <div class="grid grid-cols-12 gap-6 h-auto md:h-[600px]">
            <div
                class="col-span-12 md:col-span-6 bg-surface-container-lowest rounded-md overflow-hidden relative group">
                <img alt="Library"
                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                    data-alt="Wide shot of a modern school library with minimalist wooden shelves and contemporary seating areas"
                    src="{{ $homepage?->facility_main_image ? asset('storage/' . $homepage->facility_main_image) : 'https://lh3.googleusercontent.com/aida-public/AB6AXuD417E3dgIUxQGWqRCoqdXqxu8yR4a30EnLqcC9rIDImv3s0LE6a8tkHH60K9VKoEjmn4Am3tWOqh9jp8EZJdt9-saTV9Z7N1azsnBw36gtoMMIgPMZOtugkLboFU69n3QwrntuGihtM_Lizgvo84XzLNwIYK8fqB0q8bldWxcbtE_IKg7byygsjFzQg40FdYiCRV7eezm4Dlqbzc9Ks19xtlvvZ966NB8fe-4Hgt3En2C9rImVzmR180hnRhoO-bFo3Vl-ykkxSQp0' }}" />
                <div
                    class="absolute inset-0 bg-gradient-to-t from-primary/90 via-primary/20 to-transparent p-10 flex flex-col justify-end">
                    <span class="material-symbols-outlined text-tertiary-fixed text-4xl mb-4"
                        data-weight="fill">{{ $fasilitasItems[0]['icon'] ?? 'local_library' }}</span>
                    <h3 class="text-2xl font-bold text-white mb-2">{{ $fasilitasItems[0]['title'] ?? 'Perpustakaan Digital' }}</h3>
                    <p class="text-white/80 max-w-md">{{ $fasilitasItems[0]['desc'] ?? 'Akses ke ribuan jurnal internasional dan koleksi buku fisik terlengkap di Riau.' }}</p>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 grid grid-cols-2 grid-rows-2 gap-6">
                <div
                    class="bg-surface-container-lowest p-8 rounded-md shadow-sm flex flex-col justify-between border-t-4 border-tertiary">
                    <span class="material-symbols-outlined text-primary text-3xl">{{ $fasilitasItems[1]['icon'] ?? 'science' }}</span>
                    <div>
                        <h4 class="font-bold text-primary text-lg mb-1">{{ $fasilitasItems[1]['title'] ?? 'Lab Terpadu' }}</h4>
                        <p class="text-xs text-secondary leading-relaxed">{{ $fasilitasItems[1]['desc'] ?? 'Fisika, Kimia, Biologi, dan Lab Komputer terbaru.' }}</p>
                    </div>
                </div>
                <div
                    class="bg-primary-container p-8 rounded-md shadow-sm flex flex-col justify-between text-on-primary-container">
                    <span class="material-symbols-outlined text-3xl">{{ $fasilitasItems[2]['icon'] ?? 'apartment' }}</span>
                    <div>
                        <h4 class="font-bold text-lg mb-1">{{ $fasilitasItems[2]['title'] ?? 'Asrama Modern' }}</h4>
                        <p class="text-xs opacity-80 leading-relaxed">{{ $fasilitasItems[2]['desc'] ?? 'Kamar yang nyaman dengan pengawasan 24 jam.' }}</p>
                    </div>
                </div>
                <div class="col-span-2 bg-surface-container-lowest p-8 rounded-md shadow-sm flex items-center gap-6">
                    <div class="w-20 h-20 rounded-md overflow-hidden flex-shrink-0">
                        <img alt="Sports" class="w-full h-full object-cover"
                            data-alt="Outdoor athletic track and sports field at a modern school campus"
                            src="{{ $homepage?->facility_side_image ? asset('storage/' . $homepage->facility_side_image) : 'https://lh3.googleusercontent.com/aida-public/AB6AXuBfpUQT7Bp-kRATE-a2hTWVD1CZNqGsxKdLz2LnbrR0DZju1OCziqPYz4b--UT5MeSSdMre87oIxJcXRAmEFpg8IYMlyCuugv_oi05yiTMNpCLkr-051IYwXmARPFsmzFwrFCziV8iOldqF6MHM3hejCgIQWTEg4IXFNxNWmwvjwQtpNATFtnvnbtob2WRTetjrZT9h22QyjGkl8yP22GL7GI9a2OrfgPk15GRyHzsKv24X2wTqqBPln8WX81gHYUGqCRIwI4fHFY1d' }}" />
                    </div>
                    <div>
                        <div class="flex items-center gap-2 mb-1">
                            <span class="material-symbols-outlined text-primary text-2xl">{{ $fasilitasItems[3]['icon'] ?? 'sports_basketball' }}</span>
                            <h4 class="font-bold text-primary text-lg">{{ $fasilitasItems[3]['title'] ?? 'Sport Center' }}</h4>
                        </div>
                        <p class="text-sm text-secondary">{{ $fasilitasItems[3]['desc'] ?? 'Lapangan basket indoor, futsal, dan area atletik standar nasional.' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-24">
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex justify-between items-end mb-12">
            <div>
                <h2 class="text-4xl font-black font-headline text-primary leading-tight">{{ $homepage?->news_title ?? 'Warta SMAN Pintar' }}</h2>
                <p class="text-secondary mt-2">{{ $homepage?->news_subtitle ?? 'Update terbaru seputar kegiatan dan prestasi sekolah.' }}</p>
            </div>
            <a href="{{ route('berita') }}"
                class="flex items-center gap-2 text-primary font-bold hover:gap-4 transition-all">
                {{ $homepage?->news_button_text ?? 'Semua Berita' }} <span class="material-symbols-outlined">trending_flat</span>
            </a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            {{-- LOOPING BERITA DARI DATABASE --}}
            @forelse ($berita as $item)
            <div
                class="group bg-surface-container-lowest rounded-md overflow-hidden shadow-sm hover:shadow-2xl transition-all border border-outline-variant/10">
                <div class="h-56 overflow-hidden">
                    <img alt="News"
                        class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                        data-alt="{{ $item->judul }}"
                        src="{{ $item->gambar ? asset('storage/' . $item->gambar) : 'https://lh3.googleusercontent.com/aida-public/AB6AXuAUSqq79Uw_F-kdwXiJyOEP54AMX5t94IDTF9iVSXlu5ZE84GXdTQL5-bp-VqtOqm-W51p5Se_xxjWGRbu9UJLxwk6d11z3HF2_py9UKO5L_0vt78jQXJz_lMAcS78Lkvjba-_lCrL5eZLY_lvjMZIaBjnDLZKrZdn3GmwNBWpfeQzR-gPu5mSkTuatXeW5SBJ4tAVFRAZCWIdnBjdFLEDMxuT1zg5wQG_AnkMtNVZFQclNLVPjCWvKoJk36vMmagZzbWSiDSAMjPnU' }}" />
                </div>
                <div class="p-8">
                    <div class="flex gap-4 text-[10px] font-bold uppercase tracking-widest text-tertiary mb-4">
                        <span>{{ $item->kategori }}</span>
                        <span
                            class="text-outline">{{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d M Y') }}</span>
                    </div>
                    <h3
                        class="text-xl font-bold text-primary mb-3 leading-tight group-hover:text-primary-container transition-colors">
                        {{ $item->judul }}</h3>
                    <p class="text-sm text-on-surface-variant line-clamp-2">
                        {{ \Illuminate\Support\Str::limit(strip_tags($item->isi), 120) }}</p>
                </div>
            </div>
            @empty
            <div class="md:col-span-3 bg-surface-container-lowest rounded-md p-10 text-center text-on-surface-variant">
                Belum ada berita publish yang tersedia.
            </div>
            @endforelse
        </div>
    </div>
</section>

<section class="py-24 px-6">
    <div class="max-w-7xl mx-auto primary-gradient rounded-md overflow-hidden shadow-2xl relative">
        <div class="absolute top-0 right-0 w-1/3 h-full opacity-10 pointer-events-none">
            <svg class="w-full h-full" preserveaspectratio="none" viewbox="0 0 100 100">
                <path d="M0 100 L100 0 L100 100 Z" fill="white"></path>
            </svg>
        </div>
        <div class="relative z-10 p-12 md:p-20 flex flex-col md:flex-row items-center justify-between gap-12">
            <div class="max-w-2xl text-center md:text-left">
                <h2 class="text-4xl md:text-5xl font-black font-headline text-white mb-6 leading-tight">
                    {{ $homepage?->cta_title ?? 'Siap Menjadi Bagian dari SMAN Pintar?' }}
                </h2>
                <p class="text-on-primary-container text-lg mb-8 leading-relaxed">
                    {{ $homepage?->cta_desc ?? 'Jangan lewatkan kesempatan untuk berkembang di lingkungan akademik yang prestisius. Pendaftaran Peserta Didik Baru telah dibuka secara online.' }}
                </p>
                <div class="flex flex-wrap gap-4 justify-center md:justify-start">
                    <a href="{{ $pmb?->link_pendaftaran ?: route('pmb') }}"
                        class="bg-tertiary-fixed text-on-tertiary-fixed px-10 py-4 rounded-md font-bold text-lg hover:bg-tertiary-fixed-dim transition-colors shadow-lg">
                        {{ $homepage?->cta_button ?? 'Daftar Sekarang' }}
                    </a>
                    <a href="{{ $homepage?->cta_secondary_link ?: route('pmb') }}"
                        class="border border-white/30 text-white px-10 py-4 rounded-md font-bold text-lg hover:bg-white/10 transition-colors">
                        {{ $homepage?->cta_secondary_button ?? 'Panduan Pendaftaran' }}
                    </a>
                </div>
            </div>
            <div class="bg-white/10 backdrop-blur-md p-10 rounded-md border border-white/20 text-white text-center">
                <div class="text-5xl font-black mb-2">{{ $homepage?->cta_year ?? '2025' }}</div>
                <div class="text-sm font-bold uppercase tracking-widest opacity-80">{{ $homepage?->cta_badge ?? 'Batch Admission' }}</div>
                <div class="mt-6 pt-6 border-t border-white/20">
                    <p class="text-xs opacity-60">{{ $homepage?->cta_deadline_label ?? 'Pendaftaran Berakhir Dalam' }}</p>
                    <div class="flex gap-4 mt-2 justify-center font-headline font-bold text-2xl">
                        <div>{{ $homepage?->cta_countdown_days ?? '14' }}<span class="block text-[10px] opacity-60">HARI</span></div>
                        <div>:</div>
                        <div>{{ $homepage?->cta_countdown_hours ?? '08' }}<span class="block text-[10px] opacity-60">JAM</span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-24 bg-surface-container">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-16">
            <p class="text-tertiary font-bold text-sm tracking-[0.2em] uppercase mb-4">{{ $homepage?->alumni_label ?? 'Our Alumni' }}</p>
            <h2 class="text-4xl font-black font-headline text-primary">{{ $homepage?->alumni_title ?? 'Jejak Langkah Kesuksesan' }}</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            {{-- LOOPING ALUMNI DARI DATABASE --}}
            @forelse ($alumni as $index => $item)
            <div class="bg-surface-container-lowest p-10 rounded-md shadow-sm border-b-4 border-tertiary">
                <div class="flex items-center gap-4 mb-6">
                    <img alt="Alumni" class="w-16 h-16 rounded-full object-cover border-4 border-surface-container"
                        data-alt="{{ $item->nama }}"
                        src="{{ $item->foto ? asset('storage/' . $item->foto) : 'https://lh3.googleusercontent.com/aida-public/AB6AXuA3kk9jqHFB1bwe8T3UOsjV_sL3xqb9csJjS7ZD042fBVAd2C1XKZenZBSonVAEJQXtXFX6FPYkhv92fLkf3eqw7AaNz8GNPmtR2-0doASR5iHvDVsWGACZ5nWxtWJYwrtdkY5KSU9Fep_xYRvUYHdY3VKWQYaeQK8KPqjTMdUEFfLQsYOxTZ43UAzhLiSN3UVZ-ggTeMHgzGk7766ySmdXXbBjNuP6slDcPj4zsZS8EwjyvcBA3qhVsN3P0r8IjwZ9XheX4N25zYYQ' }}" />
                    <div>
                        <h4 class="font-bold text-primary">{{ $item->nama }}</h4>
                        <p class="text-xs text-secondary">Alumni {{ $item->tahun_lulus }} |
                            {{ $item->profesi }}{{ $item->instansi ? ', ' . $item->instansi : '' }}</p>
                    </div>
                </div>
                <p class="text-on-surface-variant italic leading-relaxed">
                    "{{ $item->deskripsi ?: 'Bangga menjadi bagian dari keluarga besar SMAN Pintar Provinsi Riau.' }}"
                </p>
            </div>
            @empty
            <div class="md:col-span-3 bg-surface-container-lowest rounded-md p-10 text-center text-on-surface-variant">
                Belum ada data alumni aktif yang tersedia.
            </div>
            @endforelse
        </div>
    </div>
</section>
@endsection
