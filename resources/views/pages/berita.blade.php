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
                <a href="{{ route('berita', request()->only('q')) }}"
                    class="px-6 py-2 rounded-full {{ empty($kategoriAktif) ? 'bg-primary text-on-primary font-semibold' : 'bg-surface-container-high text-on-surface-variant hover:bg-primary-container hover:text-on-primary font-medium' }} text-sm transition-all whitespace-nowrap">Semua</a>
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
                    placeholder="Ketik kata kunci..." type="text" />
            </form>
        </div>
    </section>

    {{-- Main Grid Layout (Berita & Sidebar) --}}
    <div class="max-w-7xl mx-auto px-8 grid grid-cols-1 lg:grid-cols-12 gap-12">

        {{-- Kiri: News Grid --}}
        <div class="lg:col-span-8 space-y-12">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                @forelse ($daftar_berita as $item)
                <article
                    class="group bg-surface-container-lowest rounded-xl overflow-hidden hover:shadow-[0_20px_50px_rgba(0,53,127,0.1)] transition-all duration-500 flex flex-col h-full">
                    <div class="relative overflow-hidden aspect-[16/10]">
                        <img class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                            src="{{ $item->gambar ? asset('storage/' . $item->gambar) : 'https://lh3.googleusercontent.com/aida-public/AB6AXuAUSqq79Uw_F-kdwXiJyOEP54AMX5t94IDTF9iVSXlu5ZE84GXdTQL5-bp-VqtOqm-W51p5Se_xxjWGRbu9UJLxwk6d11z3HF2_py9UKO5L_0vt78jQXJz_lMAcS78Lkvjba-_lCrL5eZLY_lvjMZIaBjnDLZKrZdn3GmwNBWpfeQzR-gPu5mSkTuatXeW5SBJ4tAVFRAZCWIdnBjdFLEDMxuT1zg5wQG_AnkMtNVZFQclNLVPjCWvKoJk36vMmagZzbWSiDSAMjPnU' }}" alt="{{ $item->judul }}" />
                        <span
                            class="absolute top-4 left-4 bg-primary-container text-on-primary px-3 py-1 rounded-md text-xs font-bold tracking-wider uppercase">{{ $item->kategori }}</span>
                    </div>
                    <div class="p-6 flex flex-col flex-grow">
                        <div class="flex items-center gap-2 text-outline text-xs font-medium mb-3">
                            <span class="material-symbols-outlined text-[14px]">calendar_today</span>
                            {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}
                        </div>
                        <h3
                            class="text-xl font-bold font-headline text-on-surface group-hover:text-primary transition-colors leading-tight mb-3">
                            {{ $item->judul }}</h3>
                        <p class="text-on-surface-variant text-sm leading-relaxed line-clamp-3 mb-6">
                            {{ \Illuminate\Support\Str::limit(strip_tags($item->isi), 140) }}</p>
                        <a href="#"
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

        {{-- Kanan: Sidebar --}}
        <aside class="lg:col-span-4 space-y-10">

            {{-- Popular News --}}
            <section class="bg-surface-container-low rounded-xl p-8">
                <h2 class="text-xl font-bold font-headline text-primary mb-6 flex items-center gap-2">
                    <span class="material-symbols-outlined text-tertiary">trending_up</span>
                    Berita Populer
                </h2>
                <div class="space-y-6">
                    @forelse ($beritaPopuler as $item)
                    <a class="group flex gap-4" href="#">
                        <div class="w-20 h-20 flex-shrink-0 rounded-lg overflow-hidden">
                            <img class="w-full h-full object-cover group-hover:scale-110 transition-transform"
                                src="{{ $item->gambar ? asset('storage/' . $item->gambar) : 'https://lh3.googleusercontent.com/aida-public/AB6AXuDqcs6FfnhfHAcoi1padYUKRX6lcOW9m_lm-AcXEqAjaPxxQj5qZhsPdNkYiB2GzVVwW1IWZZ4Wx9BE0IVRtymsYWLQH6N6vi2YLMIZ10RrsB5Oz3gqt8jQC1O3mv1fgBU-eZ2XmfDtevEcdX0t2vMjgpQwgECvs7Ba5Pepjp4BNhSXUFEtePQWAeC8nKjzg-dRQBw_SIE1lJjz_Ey7gLuE9PbwvDEMxfaqsDb3S5TilZ77lLYmIFPWYk2pImIo3oju_Usv90S1xHMq' }}" />
                        </div>
                        <div class="flex flex-col justify-center">
                            <h4
                                class="text-sm font-bold leading-snug group-hover:text-primary transition-colors line-clamp-2">
                                {{ $item->judul }}</h4>
                            <span class="text-[11px] text-outline mt-1 font-medium">{{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}</span>
                        </div>
                    </a>
                    @empty
                    <p class="text-sm text-on-surface-variant">Belum ada berita populer.</p>
                    @endforelse
                </div>
            </section>

            {{-- Categories --}}
            <section class="bg-surface-container-lowest border border-outline-variant/10 rounded-xl p-8">
                <h2 class="text-xl font-bold font-headline text-primary mb-6">Kategori</h2>
                <div class="flex flex-wrap gap-2">
                    @forelse ($kategoriBerita as $kategori)
                    <a class="px-4 py-2 bg-surface-container rounded-lg text-sm font-semibold text-on-surface-variant hover:bg-primary-fixed hover:text-on-primary-fixed transition-all flex items-center gap-2"
                        href="{{ route('berita', ['kategori' => $kategori->kategori]) }}">
                        {{ $kategori->kategori }} <span class="text-[10px] bg-white px-1.5 py-0.5 rounded-full text-primary">{{ $kategori->total }}</span>
                    </a>
                    @empty
                    <p class="text-sm text-on-surface-variant">Belum ada kategori.</p>
                    @endforelse
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
