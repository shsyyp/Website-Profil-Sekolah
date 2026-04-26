@extends('layouts.main')

@section('title', 'Warta SMAN Pintar - Portal Berita Sekolah')

@section('content')

<div class="pt-24 pb-20">

    {{-- Header Section & Breadcrumb --}}
    <header class="max-w-7xl mx-auto px-8 py-12">
        <div class="flex flex-col gap-2">
            <nav class="flex items-center gap-2 text-sm font-medium text-outline">
                <a class="hover:text-primary transition-colors" href="{{ url('/') }}">Beranda</a>
                <span class="material-symbols-outlined text-[16px]">chevron_right</span>
                <span class="text-primary font-semibold">Berita</span>
            </nav>
            <h1 class="text-5xl font-extrabold font-headline tracking-tight text-primary mt-4">Warta SMAN Pintar</h1>
            <p class="text-on-surface-variant max-w-2xl mt-2 leading-relaxed">
                Menyajikan informasi terbaru seputar prestasi, kegiatan kesiswaan, dan pengumuman resmi dari lingkungan
                sekolah.
            </p>
        </div>
    </header>

    {{-- Search & Filter Bar --}}
    <section class="max-w-7xl mx-auto px-8 mb-12">
        <div
            class="bg-surface-container-lowest p-4 rounded-xl shadow-[0_8px_30px_rgb(0,0,0,0.02)] flex flex-col md:flex-row justify-between items-center gap-6">
            <div class="flex items-center gap-2 overflow-x-auto w-full md:w-auto pb-2 md:pb-0 no-scrollbar">
                <button
                    class="px-6 py-2 rounded-full bg-primary text-on-primary font-semibold text-sm whitespace-nowrap">Semua</button>
                <button
                    class="px-6 py-2 rounded-full bg-surface-container-high text-on-surface-variant hover:bg-primary-container hover:text-on-primary font-medium text-sm transition-all whitespace-nowrap">Prestasi</button>
                <button
                    class="px-6 py-2 rounded-full bg-surface-container-high text-on-surface-variant hover:bg-primary-container hover:text-on-primary font-medium text-sm transition-all whitespace-nowrap">Kegiatan</button>
                <button
                    class="px-6 py-2 rounded-full bg-surface-container-high text-on-surface-variant hover:bg-primary-container hover:text-on-primary font-medium text-sm transition-all whitespace-nowrap">Pengumuman</button>
            </div>
            <div class="relative w-full md:w-80">
                <span
                    class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-outline">search</span>
                <input
                    class="w-full pl-12 pr-4 py-3 bg-surface-container-low border-none rounded-lg focus:ring-2 focus:ring-primary-container transition-all"
                    placeholder="Ketik kata kunci..." type="text" />
            </div>
        </div>
    </section>

    {{-- Main Grid Layout (Berita & Sidebar) --}}
    <div class="max-w-7xl mx-auto px-8 grid grid-cols-1 lg:grid-cols-12 gap-12">

        {{-- Kiri: News Grid --}}
        <div class="lg:col-span-8 space-y-12">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                {{-- DYNAMIC LOOP: Data dikirim dari routes/web.php --}}
                @foreach ($daftar_berita as $item)
                <article
                    class="group bg-surface-container-lowest rounded-xl overflow-hidden hover:shadow-[0_20px_50px_rgba(0,53,127,0.1)] transition-all duration-500 flex flex-col h-full">
                    <div class="relative overflow-hidden aspect-[16/10]">
                        <img class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                            src="{{ $item->gambar }}" alt="{{ $item->judul }}" />
                        <span
                            class="absolute top-4 left-4 {{ $item->warna_badge }} px-3 py-1 rounded-md text-xs font-bold tracking-wider uppercase">{{ $item->kategori }}</span>
                    </div>
                    <div class="p-6 flex flex-col flex-grow">
                        <div class="flex items-center gap-2 text-outline text-xs font-medium mb-3">
                            <span class="material-symbols-outlined text-[14px]">calendar_today</span>
                            {{ $item->tanggal }}
                        </div>
                        <h3
                            class="text-xl font-bold font-headline text-on-surface group-hover:text-primary transition-colors leading-tight mb-3">
                            {{ $item->judul }}</h3>
                        <p class="text-on-surface-variant text-sm leading-relaxed line-clamp-3 mb-6">
                            {{ $item->deskripsi }}</p>
                        <a href="#"
                            class="mt-auto inline-flex items-center gap-2 text-primary font-bold text-sm group/link">
                            Selengkapnya
                            <span
                                class="material-symbols-outlined transition-transform group-hover/link:translate-x-1">arrow_forward</span>
                        </a>
                    </div>
                </article>
                @endforeach

            </div>

            {{-- Pagination --}}
            <div class="flex items-center justify-center gap-2 pt-8">
                <button
                    class="w-10 h-10 flex items-center justify-center rounded-lg bg-surface-container text-outline hover:bg-primary hover:text-white transition-all">
                    <span class="material-symbols-outlined">chevron_left</span>
                </button>
                <button
                    class="w-10 h-10 flex items-center justify-center rounded-lg bg-primary text-on-primary font-bold">1</button>
                <button
                    class="w-10 h-10 flex items-center justify-center rounded-lg bg-surface-container text-on-surface-variant hover:bg-primary-container hover:text-white transition-all font-semibold">2</button>
                <button
                    class="w-10 h-10 flex items-center justify-center rounded-lg bg-surface-container text-on-surface-variant hover:bg-primary-container hover:text-white transition-all font-semibold">3</button>
                <span class="px-2 text-outline">...</span>
                <button
                    class="px-4 h-10 flex items-center justify-center rounded-lg bg-surface-container text-on-surface-variant hover:bg-primary-container hover:text-white transition-all font-semibold">Next</button>
            </div>
        </div>

        {{-- Kanan: Sidebar --}}
        <aside class="lg:col-span-4 space-y-10">

            {{-- Popular News --}}
            <section class="bg-surface-container-low rounded-xl p-8">
                <h2 class="text-xl font-bold font-headline text-primary mb-6 flex items-center gap-2">
                    <span class="material-symbols-outlined text-tertiary">trending_up</span>
                    Berita Populer
                </h2>
                <div class="space-y-6">
                    <a class="group flex gap-4" href="#">
                        <div class="w-20 h-20 flex-shrink-0 rounded-lg overflow-hidden">
                            <img class="w-full h-full object-cover group-hover:scale-110 transition-transform"
                                src="https://lh3.googleusercontent.com/aida-public/AB6AXuDqcs6FfnhfHAcoi1padYUKRX6lcOW9m_lm-AcXEqAjaPxxQj5qZhsPdNkYiB2GzVVwW1IWZZ4Wx9BE0IVRtymsYWLQH6N6vi2YLMIZ10RrsB5Oz3gqt8jQC1O3mv1fgBU-eZ2XmfDtevEcdX0t2vMjgpQwgECvs7Ba5Pepjp4BNhSXUFEtePQWAeC8nKjzg-dRQBw_SIE1lJjz_Ey7gLuE9PbwvDEMxfaqsDb3S5TilZ77lLYmIFPWYk2pImIo3oju_Usv90S1xHMq" />
                        </div>
                        <div class="flex flex-col justify-center">
                            <h4
                                class="text-sm font-bold leading-snug group-hover:text-primary transition-colors line-clamp-2">
                                Tips Efektif Belajar Mandiri di Era Digital</h4>
                            <span class="text-[11px] text-outline mt-1 font-medium">12 Oktober 2023</span>
                        </div>
                    </a>
                    <a class="group flex gap-4" href="#">
                        <div class="w-20 h-20 flex-shrink-0 rounded-lg overflow-hidden">
                            <img class="w-full h-full object-cover group-hover:scale-110 transition-transform"
                                src="https://lh3.googleusercontent.com/aida-public/AB6AXuDzvCdtK7DZawU7damIWbfnb8ZRpzP3xEg89nw8uM2Z_5wtPoMKDlGtDII2zr6KNpZXBkj0CYw-FZSRJN5cXsrw71pPDTyHF6-eGf5xFy9Ntx_AGJP1B1e7XEZ1C1sZwKBgq7efKar6DaezBcoYLkeXF9OzzK-wEJKEJxOwIwfH_w3Dn0rPcvlHlcAcK9nV8GK2uIM9Z7YxF0YSOoGnNEkzXp0LgyD3LmiShheNE9dZWS_an6ItaEwTMj2EvmtqVAzSJIkXzXJoZkA5" />
                        </div>
                        <div class="flex flex-col justify-center">
                            <h4
                                class="text-sm font-bold leading-snug group-hover:text-primary transition-colors line-clamp-2">
                                Fasilitas Perpustakaan Digital Baru Kini Tersedia</h4>
                            <span class="text-[11px] text-outline mt-1 font-medium">10 Oktober 2023</span>
                        </div>
                    </a>
                    <a class="group flex gap-4" href="#">
                        <div class="w-20 h-20 flex-shrink-0 rounded-lg overflow-hidden">
                            <img class="w-full h-full object-cover group-hover:scale-110 transition-transform"
                                src="https://lh3.googleusercontent.com/aida-public/AB6AXuC5bkWKOEj26bito-1Kxsa2WwEbZ8hgfn2O80DCInXrlLrB2J9zV8IDqNgVbzIfTxjHleWRIJsxmuXEKw9CPzFHkqTugTxg2KXq8dfXccn26eXHpBDPaxOsG9Afn7_ASYFr81Y_PM2MQ3IQMotygIAQfa6ZLGcbw2NKmwERYwtj7daT9HMMArasV6YKclhXOuc9YbB-4UkJxkwlRCJYqI36LHZET_uDGupSzJyG5akOjDJMb2F_mjuRnhW_LhxgiZa446GMH6y4i7JG" />
                        </div>
                        <div class="flex flex-col justify-center">
                            <h4
                                class="text-sm font-bold leading-snug group-hover:text-primary transition-colors line-clamp-2">
                                Kunjungan Industri Siswa Jurusan IPA ke Pabrik Farmasi</h4>
                            <span class="text-[11px] text-outline mt-1 font-medium">08 Oktober 2023</span>
                        </div>
                    </a>
                </div>
            </section>

            {{-- Categories --}}
            <section class="bg-surface-container-lowest border border-outline-variant/10 rounded-xl p-8">
                <h2 class="text-xl font-bold font-headline text-primary mb-6">Kategori</h2>
                <div class="flex flex-wrap gap-2">
                    <a class="px-4 py-2 bg-surface-container rounded-lg text-sm font-semibold text-on-surface-variant hover:bg-primary-fixed hover:text-on-primary-fixed transition-all flex items-center gap-2"
                        href="#">
                        Prestasi <span class="text-[10px] bg-white px-1.5 py-0.5 rounded-full text-primary">12</span>
                    </a>
                    <a class="px-4 py-2 bg-surface-container rounded-lg text-sm font-semibold text-on-surface-variant hover:bg-primary-fixed hover:text-on-primary-fixed transition-all flex items-center gap-2"
                        href="#">
                        Kegiatan <span class="text-[10px] bg-white px-1.5 py-0.5 rounded-full text-primary">24</span>
                    </a>
                    <a class="px-4 py-2 bg-surface-container rounded-lg text-sm font-semibold text-on-surface-variant hover:bg-primary-fixed hover:text-on-primary-fixed transition-all flex items-center gap-2"
                        href="#">
                        Pengumuman <span class="text-[10px] bg-white px-1.5 py-0.5 rounded-full text-primary">8</span>
                    </a>
                    <a class="px-4 py-2 bg-surface-container rounded-lg text-sm font-semibold text-on-surface-variant hover:bg-primary-fixed hover:text-on-primary-fixed transition-all flex items-center gap-2"
                        href="#">
                        Opini Siswa <span class="text-[10px] bg-white px-1.5 py-0.5 rounded-full text-primary">15</span>
                    </a>
                </div>
            </section>

            {{-- Newsletter / CTA --}}
            <section class="bg-primary p-8 rounded-xl text-white relative overflow-hidden">
                <div class="relative z-10">
                    <h2 class="text-2xl font-bold font-headline mb-4">Berlangganan Warta</h2>
                    <p class="text-blue-100 text-sm mb-6">Dapatkan update berita terbaru SMAN Pintar langsung ke email
                        Anda setiap minggu.</p>
                    <form class="space-y-3">
                        <input
                            class="w-full px-4 py-3 rounded-lg bg-white/10 border-white/20 focus:ring-2 focus:ring-tertiary placeholder:text-blue-200 text-white border-none"
                            placeholder="Email Anda" type="email" />
                        <button type="button"
                            class="w-full bg-tertiary-fixed text-on-tertiary-fixed font-bold py-3 rounded-lg hover:scale-105 active:scale-95 transition-transform">Daftar
                            Sekarang</button>
                    </form>
                </div>
                <span
                    class="material-symbols-outlined absolute -bottom-6 -right-6 text-white/10 text-[120px] rotate-12">mail</span>
            </section>

        </aside>
    </div>
</div>

@endsection