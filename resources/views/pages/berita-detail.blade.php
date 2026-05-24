@extends('layouts.main')

@section('title', $berita->judul . ' - SMAN Pintar')

@section('content')
@php
    $coverImage = $berita->gambar
        ? asset('storage/' . $berita->gambar)
        : 'https://lh3.googleusercontent.com/aida-public/AB6AXuAUSqq79Uw_F-kdwXiJyOEP54AMX5t94IDTF9iVSXlu5ZE84GXdTQL5-bp-VqtOqm-W51p5Se_xxjWGRbu9UJLxwk6d11z3HF2_py9UKO5L_0vt78jQXJz_lMAcS78Lkvjba-_lCrL5eZLY_lvjMZIaBjnDLZKrZdn3GmwNBWpfeQzR-gPu5mSkTuatXeW5SBJ4tAVFRAZCWIdnBjdFLEDMxuT1zg5wQG_AnkMtNVZFQclNLVPjCWvKoJk36vMmagZzbWSiDSAMjPnU';
@endphp

<article class="pt-10 pb-20">
    <header class="max-w-6xl mx-auto px-8 pt-10 pb-12">
        <nav class="flex flex-wrap items-center gap-2 text-sm font-medium text-outline">
            <a class="hover:text-primary transition-colors" href="{{ route('home') }}">Beranda</a>
            <span class="material-symbols-outlined text-[16px]">chevron_right</span>
            <a class="hover:text-primary transition-colors" href="{{ route('berita') }}">Berita</a>
            <span class="material-symbols-outlined text-[16px]">chevron_right</span>
            <span class="text-primary font-semibold">{{ \Illuminate\Support\Str::limit($berita->judul, 40) }}</span>
        </nav>

        <div class="mt-8">
            <div class="flex flex-wrap items-center gap-3 text-xs font-bold uppercase tracking-widest text-tertiary">
                <span>{{ $berita->kategori }}</span>
                <span class="text-outline">{{ \Carbon\Carbon::parse($berita->tanggal)->translatedFormat('d F Y') }}</span>
            </div>
            <h1 class="mt-4 text-4xl md:text-6xl font-black font-headline text-primary leading-tight">
                {{ $berita->judul }}
            </h1>
        </div>
    </header>

    <div class="max-w-6xl mx-auto px-8">
        <div class="overflow-hidden rounded-xl bg-surface-container shadow-sm">
            <img class="h-[260px] md:h-[520px] w-full object-cover" src="{{ $coverImage }}" alt="{{ $berita->judul }}">
        </div>
    </div>

    <div class="max-w-6xl mx-auto px-8 mt-12">
        <div class="bg-surface-container-lowest rounded-xl p-8 md:p-12 shadow-sm">
            <div class="space-y-6 text-on-surface-variant leading-8 text-base md:text-lg">
                {!! nl2br(e($berita->isi)) !!}
            </div>
        </div>
    </div>
</article>

@if($beritaTerkait->isNotEmpty())
<section class="pb-24">
    <div class="max-w-6xl mx-auto px-8">
        <div class="flex items-end justify-between gap-6 mb-8">
            <div>
                <p class="text-tertiary font-bold text-sm tracking-[0.2em] uppercase mb-3">Berita Lainnya</p>
                <h2 class="text-3xl font-black font-headline text-primary">Baca Juga</h2>
            </div>
            <a href="{{ route('berita') }}" class="hidden md:inline-flex items-center gap-2 text-primary font-bold">
                Semua Berita
                <span class="material-symbols-outlined">arrow_forward</span>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($beritaTerkait as $item)
            <a href="{{ route('berita.detail', $item) }}"
                class="group bg-surface-container-lowest rounded-xl overflow-hidden shadow-sm hover:shadow-xl transition-all">
                <div class="h-44 overflow-hidden">
                    <img class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-110"
                        src="{{ $item->gambar ? asset('storage/' . $item->gambar) : $coverImage }}" alt="{{ $item->judul }}">
                </div>
                <div class="p-6">
                    <div class="mb-3 flex gap-3 text-[10px] font-bold uppercase tracking-widest text-tertiary">
                        <span>{{ $item->kategori }}</span>
                        <span class="text-outline">{{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d M Y') }}</span>
                    </div>
                    <h3 class="font-bold text-primary leading-tight group-hover:text-primary-container transition-colors">
                        {{ $item->judul }}
                    </h3>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif
@endsection
