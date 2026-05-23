@extends('layouts.main')

@section('title', 'Warta SMAN Pintar - Portal Berita Sekolah')

@section('content')
@php
    $heroBreadcrumbLabel = $settings->hero_breadcrumb_label ?? 'Berita';
    $heroTitle = $settings->hero_title ?? 'Warta SMAN Pintar';
    $heroDescription = $settings->hero_description ?? 'Menyajikan informasi terbaru seputar prestasi, kegiatan kesiswaan, dan pengumuman resmi dari lingkungan sekolah.';
    $filterAllLabel = $settings->filter_all_label ?? 'Semua';
    $searchPlaceholder = $settings->search_placeholder ?? 'Ketik kata kunci...';
@endphp

<div class="pt-24 pb-20">

    {{-- Header Section & Breadcrumb --}}
    <header class="max-w-7xl mx-auto px-8 py-12">
        <div class="flex flex-col gap-2">
            <nav class="flex items-center gap-2 text-sm font-medium text-outline">
                <a class="hover:text-primary transition-colors" href="{{ url('/') }}">Beranda</a>
                <span class="material-symbols-outlined text-[16px]">chevron_right</span>
                <span class="text-primary font-semibold">{{ $heroBreadcrumbLabel }}</span>
            </nav>
            <h1 class="text-5xl font-extrabold font-headline tracking-tight text-primary mt-4">{{ $heroTitle }}</h1>
            <p class="text-on-surface-variant max-w-2xl mt-2 leading-relaxed">
                {{ $heroDescription }}
            </p>
        </div>
    </header>

    {{-- Search & Filter Bar --}}
    <section class="max-w-7xl mx-auto px-8 mb-12">
        <div
            class="bg-surface-container-lowest p-4 rounded-xl shadow-[0_8px_30px_rgb(0,0,0,0.02)] flex flex-col md:flex-row justify-between items-center gap-6">
            <div class="flex items-center gap-2 overflow-x-auto w-full md:w-auto pb-2 md:pb-0 no-scrollbar">
                <a href="{{ route('berita', request()->only('q')) }}"
                    class="px-6 py-2 rounded-full {{ empty($kategoriAktif) ? 'bg-primary text-on-primary font-semibold' : 'bg-surface-container-high text-on-surface-variant hover:bg-primary-container hover:text-on-primary font-medium' }} text-sm transition-all whitespace-nowrap">{{ $filterAllLabel }}</a>
                @foreach ($kategoriBerita as $kategori)
                <a href="{{ route('berita', array_filter(['kategori' => $kategori->kategori, 'q' => $keyword])) }}"
                    class="px-6 py-2 rounded-full {{ $kategoriAktif === $kategori->kategori ? 'bg-primary text-on-primary font-semibold' : 'bg-surface-container-high text-on-surface-variant hover:bg-primary-container hover:text-on-primary font-medium' }} text-sm transition-all whitespace-nowrap">{{ $kategori->kategori }}</a>
                @endforeach
            </div>
            <form method="GET" action="{{ route('berita') }}" class="relative w-full md:w-80">
                @if($kategoriAktif)
                <input type="hidden" name="kategori" value="{{ $kategoriAktif }}" />
                @endif
                <span
                    class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-outline">search</span>
                <input name="q" value="{{ $keyword }}"
                    class="w-full pl-12 pr-4 py-3 bg-surface-container-low border-none rounded-lg focus:ring-2 focus:ring-primary-container transition-all"
                    placeholder="{{ $searchPlaceholder }}" type="text" />
            </form>
        </div>
    </section>

    {{-- News Grid --}}
    <div class="max-w-7xl mx-auto px-8">
        <div class="space-y-12">
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">

                @forelse ($daftar_berita as $item)
                <article
                    class="group bg-surface-container-lowest rounded-xl overflow-hidden hover:shadow-[0_20px_50px_rgba(0,53,127,0.1)] transition-all duration-500 flex flex-col h-full">
                    <a href="{{ route('berita.detail', $item) }}" class="relative overflow-hidden aspect-[16/10] block">
                        <img class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                            src="{{ $item->gambar ? asset('storage/' . $item->gambar) : 'https://lh3.googleusercontent.com/aida-public/AB6AXuAUSqq79Uw_F-kdwXiJyOEP54AMX5t94IDTF9iVSXlu5ZE84GXdTQL5-bp-VqtOqm-W51p5Se_xxjWGRbu9UJLxwk6d11z3HF2_py9UKO5L_0vt78jQXJz_lMAcS78Lkvjba-_lCrL5eZLY_lvjMZIaBjnDLZKrZdn3GmwNBWpfeQzR-gPu5mSkTuatXeW5SBJ4tAVFRAZCWIdnBjdFLEDMxuT1zg5wQG_AnkMtNVZFQclNLVPjCWvKoJk36vMmagZzbWSiDSAMjPnU' }}" alt="{{ $item->judul }}" />
                        <span
                            class="absolute top-4 left-4 bg-primary-container text-on-primary px-3 py-1 rounded-md text-xs font-bold tracking-wider uppercase">{{ $item->kategori }}</span>
                    </a>
                    <div class="p-6 flex flex-col flex-grow">
                        <div class="flex items-center gap-2 text-outline text-xs font-medium mb-3">
                            <span class="material-symbols-outlined text-[14px]">calendar_today</span>
                            {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}
                        </div>
                        <a href="{{ route('berita.detail', $item) }}"
                            class="text-xl font-bold font-headline text-on-surface group-hover:text-primary transition-colors leading-tight mb-3">
                            {{ $item->judul }}</a>
                        <p class="text-on-surface-variant text-sm leading-relaxed line-clamp-3 mb-6">
                            {{ \Illuminate\Support\Str::limit(strip_tags($item->isi), 140) }}</p>
                        <a href="{{ route('berita.detail', $item) }}"
                            class="mt-auto inline-flex items-center gap-2 text-primary font-bold text-sm group/link">
                            Selengkapnya
                            <span
                                class="material-symbols-outlined transition-transform group-hover/link:translate-x-1">arrow_forward</span>
                        </a>
                    </div>
                </article>
                @empty
                <div class="md:col-span-2 bg-surface-container-lowest rounded-xl p-10 text-center text-on-surface-variant">
                    Belum ada berita publish yang tersedia.
                </div>
                @endforelse

            </div>

            {{-- Pagination --}}
            <div class="pt-8">
                {{ $daftar_berita->links() }}
            </div>
        </div>

    </div>
</div>

@endsection
