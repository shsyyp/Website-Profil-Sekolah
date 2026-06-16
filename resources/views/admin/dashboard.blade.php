@extends('layouts.admin')

@section('title', 'Dashboard - Admin SMAN Pintar')

@section('content')

<section class="mb-8">
    <h2 class="text-4xl font-extrabold text-primary tracking-tight font-headline">Dashboard</h2>
</section>

{{-- Statistik --}}
<section class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">
    <a href="{{ route('berita.index') }}"
        class="bg-surface-container-lowest p-6 rounded-xl shadow-[24px_24px_48px_rgba(25,27,34,0.03)] border-b-4 border-primary group hover:-translate-y-1 transition-transform duration-300">
        <div class="flex justify-between items-start mb-4">
            <div class="p-3 bg-primary/5 rounded-xl text-primary">
                <span class="material-symbols-outlined">newspaper</span>
            </div>
        </div>
        <h3 class="text-outline text-xs font-bold uppercase tracking-widest mb-1">Total Berita</h3>
        <p class="text-3xl font-extrabold text-on-surface">{{ $totalBerita ?? 0 }}</p>
    </a>

    <a href="{{ route('admin.about.index') }}"
        class="bg-surface-container-lowest p-6 rounded-xl shadow-[24px_24px_48px_rgba(25,27,34,0.03)] border-b-4 border-tertiary group hover:-translate-y-1 transition-transform duration-300">
        <div class="flex justify-between items-start mb-4">
            <div class="p-3 bg-tertiary/5 rounded-xl text-tertiary">
                <span class="material-symbols-outlined">domain</span>
            </div>
        </div>
        <h3 class="text-outline text-xs font-bold uppercase tracking-widest mb-1">Total Fasilitas</h3>
        <p class="text-3xl font-extrabold text-on-surface">{{ $totalFasilitas ?? 0 }}</p>
    </a>

    <a href="{{ route('admin.about.index') }}"
        class="bg-surface-container-lowest p-6 rounded-xl shadow-[24px_24px_48px_rgba(25,27,34,0.03)] border-b-4 border-primary-container group hover:-translate-y-1 transition-transform duration-300">
        <div class="flex justify-between items-start mb-4">
            <div class="p-3 bg-primary-container/5 rounded-xl text-primary-container">
                <span class="material-symbols-outlined">groups</span>
            </div>
        </div>
        <h3 class="text-outline text-xs font-bold uppercase tracking-widest mb-1">Total Ekstrakurikuler</h3>
        <p class="text-3xl font-extrabold text-on-surface">{{ $totalEkstrakurikuler ?? 0 }}</p>
    </a>

    <a href="{{ route('alumni.index') }}"
        class="bg-surface-container-lowest p-6 rounded-xl shadow-[24px_24px_48px_rgba(25,27,34,0.03)] border-b-4 border-on-secondary-container group hover:-translate-y-1 transition-transform duration-300">
        <div class="flex justify-between items-start mb-4">
            <div class="p-3 bg-on-secondary-container/5 rounded-xl text-on-secondary-container">
                <span class="material-symbols-outlined">school</span>
            </div>
        </div>
        <h3 class="text-outline text-xs font-bold uppercase tracking-widest mb-1">Total Alumni</h3>
        <p class="text-3xl font-extrabold text-on-surface">{{ $totalAlumni ?? 0 }}</p>
    </a>
</section>

{{-- Grafik --}}
@php
    $maxBeritaBulanan = max(1, collect($beritaPerBulan ?? [])->max('total') ?? 0);
    $maxAlumniAngkatan = max(1, collect($alumniPerAngkatan ?? [])->max('total') ?? 0);
@endphp
<section class="grid grid-cols-1 xl:grid-cols-2 gap-8 mt-8">
    <div class="bg-surface-container-lowest rounded-xl p-8 shadow-[24px_24px_48px_rgba(25,27,34,0.02)]">
        <div class="mb-8 flex items-center justify-between gap-4">
            <h2 class="text-2xl font-extrabold text-on-surface tracking-tight">Grafik Berita Per Bulan</h2>
            <span class="material-symbols-outlined text-primary">bar_chart</span>
        </div>

        @if(collect($beritaPerBulan ?? [])->isNotEmpty())
        <div class="flex h-64 items-end gap-4">
            @foreach($beritaPerBulan as $item)
            @php
                $height = max(8, ($item['total'] / $maxBeritaBulanan) * 100);
            @endphp
            <div class="flex min-w-0 flex-1 flex-col items-center gap-3">
                <div class="flex h-48 w-full items-end rounded-xl bg-surface-container-low px-2">
                    <div class="w-full rounded-t-xl bg-primary transition-all" style="height: {{ $height }}%"></div>
                </div>
                <div class="text-center">
                    <p class="text-sm font-extrabold text-on-surface">{{ $item['total'] }}</p>
                    <p class="text-[11px] font-bold text-outline">{{ $item['label'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <p class="rounded-xl bg-surface-container-low px-4 py-8 text-center text-slate-400 italic">Belum ada data berita.</p>
        @endif
    </div>

    <div class="bg-surface-container-lowest rounded-xl p-8 shadow-[24px_24px_48px_rgba(25,27,34,0.02)]">
        <div class="mb-8 flex items-center justify-between gap-4">
            <h2 class="text-2xl font-extrabold text-on-surface tracking-tight">Grafik Alumni Per Angkatan</h2>
            <span class="material-symbols-outlined text-tertiary">stacked_bar_chart</span>
        </div>
        <div class="space-y-4">
            @forelse($alumniPerAngkatan as $item)
            @php
                $width = max(8, ($item['total'] / $maxAlumniAngkatan) * 100);
            @endphp
            <div>
                <div class="mb-2 flex items-center justify-between gap-4">
                    <p class="text-sm font-bold text-on-surface">Angkatan {{ $item['label'] }}</p>
                    <p class="text-sm font-extrabold text-primary">{{ $item['total'] }}</p>
                </div>
                <div class="h-4 overflow-hidden rounded-full bg-surface-container-low">
                    <div class="h-full rounded-full bg-tertiary" style="width: {{ $width }}%"></div>
                </div>
            </div>
            @empty
            <p class="rounded-xl bg-surface-container-low px-4 py-8 text-center text-slate-400 italic">Belum ada data alumni.</p>
            @endforelse
        </div>
    </div>
</section>

<div class="grid grid-cols-1 xl:grid-cols-2 gap-8 mt-8">
    {{-- Berita --}}
    <section class="bg-surface-container-lowest rounded-xl p-8 shadow-[24px_24px_48px_rgba(25,27,34,0.02)] flex flex-col">
        <div class="flex flex-col gap-4 sm:flex-row sm:justify-between sm:items-center mb-8">
            <div>
                <h2 class="text-2xl font-extrabold text-on-surface tracking-tight">Berita Terbaru</h2>
            </div>
            <a href="{{ route('berita.create') }}"
                class="bg-primary hover:bg-primary-container text-on-primary px-5 py-2.5 rounded-xl text-sm font-bold flex items-center justify-center gap-2 transition-all active:scale-95 shadow-lg shadow-primary/20">
                <span class="material-symbols-outlined text-[20px]">add</span>
                Buat Berita
            </a>
        </div>

        <div class="space-y-4">
            @forelse($berita_terbaru as $item)
            <a href="{{ route('berita.edit', $item->id) }}"
                class="flex items-center gap-4 rounded-xl bg-surface-container-low p-4 hover:bg-surface-container transition-colors">
                <div class="h-14 w-14 flex-shrink-0 overflow-hidden rounded-xl bg-slate-200">
                    @if($item->gambar)
                    <img alt="{{ $item->judul }}" class="h-full w-full object-cover" src="{{ asset('storage/' . $item->gambar) }}">
                    @else
                    <div class="flex h-full w-full items-center justify-center text-[10px] font-bold text-slate-400">Tanpa Gambar</div>
                    @endif
                </div>
                <div class="min-w-0 flex-1">
                    <p class="truncate font-bold text-on-surface">{{ $item->judul }}</p>
                    <p class="text-xs font-semibold text-outline">{{ ucfirst($item->kategori ?? 'Berita') }} - {{ $item->tanggal?->format('d M Y') ?? $item->created_at?->format('d M Y') }}</p>
                </div>
                <span class="material-symbols-outlined text-outline">chevron_right</span>
            </a>
            @empty
            <p class="rounded-xl bg-surface-container-low px-4 py-8 text-center text-slate-400 italic">Belum ada berita yang ditambahkan.</p>
            @endforelse
        </div>
    </section>

    {{-- Alumni --}}
    <section class="bg-surface-container-lowest rounded-xl p-8 shadow-[24px_24px_48px_rgba(25,27,34,0.02)] flex flex-col">
        <div class="flex flex-col gap-4 sm:flex-row sm:justify-between sm:items-center mb-8">
            <div>
                <h2 class="text-2xl font-extrabold text-on-surface tracking-tight">Alumni Terbaru</h2>
            </div>
            <a href="{{ route('alumni.create') }}"
                class="bg-primary hover:bg-primary-container text-on-primary px-5 py-2.5 rounded-xl text-sm font-bold flex items-center justify-center gap-2 transition-all active:scale-95 shadow-lg shadow-primary/20">
                <span class="material-symbols-outlined text-[20px]">add</span>
                Tambah Alumni
            </a>
        </div>

        <div class="space-y-4">
            @forelse($alumni_terbaru as $item)
            <a href="{{ route('alumni.edit', $item->id) }}"
                class="flex items-center gap-4 rounded-xl bg-surface-container-low p-4 hover:bg-surface-container transition-colors">
                <div class="h-14 w-14 flex-shrink-0 overflow-hidden rounded-xl bg-surface-container">
                    <img class="h-full w-full object-cover"
                        src="{{ $item->foto ? asset('storage/' . $item->foto) : 'https://ui-avatars.com/api/?name=' . urlencode($item->nama) . '&background=e9eef8&color=0b3f8a&bold=true' }}"
                        alt="{{ $item->nama }}">
                </div>
                <div class="min-w-0 flex-1">
                    <p class="truncate font-bold text-on-surface">{{ $item->nama }}</p>
                    <p class="truncate text-xs font-semibold text-outline">{{ $item->lokasi }} - Angkatan {{ $item->tahun_lulus }}</p>
                </div>
                <span class="material-symbols-outlined text-outline">chevron_right</span>
            </a>
            @empty
            <p class="rounded-xl bg-surface-container-low px-4 py-8 text-center text-slate-400 italic">Belum ada data alumni.</p>
            @endforelse
        </div>
    </section>
</div>

{{-- Chatbot --}}
<section class="mt-8 bg-surface-container-lowest rounded-xl p-8 shadow-[24px_24px_48px_rgba(25,27,34,0.02)]">
    <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-2xl font-extrabold text-on-surface tracking-tight">Chatbot Terbaru</h2>
        </div>
        <a href="{{ route('chatbot.create') }}"
            class="bg-primary hover:bg-primary-container text-on-primary px-5 py-2.5 rounded-xl text-sm font-bold flex items-center justify-center gap-2 transition-all active:scale-95 shadow-lg shadow-primary/20">
            <span class="material-symbols-outlined text-[20px]">add</span>
            Tambah Pertanyaan
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
        @forelse($chatbot as $item)
        <a href="{{ route('chatbot.edit', $item->id) }}"
            class="rounded-xl bg-surface-container-low p-5 border-l-4 border-primary hover:bg-surface-container transition-colors">
            <p class="text-xs font-bold text-outline uppercase tracking-wider mb-2">Pertanyaan</p>
            <p class="font-bold text-on-surface line-clamp-2">{{ $item->pertanyaan }}</p>
            <p class="mt-4 text-sm text-on-surface-variant line-clamp-2">{{ $item->jawaban }}</p>
        </a>
        @empty
        <p class="lg:col-span-3 rounded-xl bg-surface-container-low px-4 py-8 text-center text-slate-400 italic">Belum ada data chatbot.</p>
        @endforelse
    </div>
</section>

@endsection
