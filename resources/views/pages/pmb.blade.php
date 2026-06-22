@extends('layouts.main')

@section('title', 'PMB - SMAN Pintar Provinsi Riau')

@section('content')
@php
$heroImage = $pmb?->hero_image
? asset('storage/' . $pmb->hero_image)
:
'https://lh3.googleusercontent.com/aida-public/AB6AXuCzki_EPBNVyg-ldrcUWYC_cc07-B11lum4k6V5O6cNZPyNyNQ1xfh6ZNwxUxGCyiC-x1bMl09IvHCNP3Sbxy4qk_DhR9ljXdMhUikF3im0IHd5_9EkaNk1xWQvCKbOD7QyYy935iH-3C66VCiGB-seTE8fgTJdxxyHnHlMpyYAfe28tlRZ7NpipXSBVWLasgsafK2C1uEWsdorypBCAYEioFJffpS6MgyrNBgnkQfyRFBqg751RMs5T8I0VCNKS_WespzJ_IalC9b4';
@endphp

{{-- Hero Section --}}
<section class="relative overflow-hidden min-h-[921px] flex items-center bg-surface pt-20">
    <div class="max-w-7xl mx-auto px-8 grid md:grid-cols-2 gap-12 items-center">
        <div class="relative z-10">
            <span
                class="inline-block px-4 py-1.5 rounded-full bg-tertiary-fixed text-on-tertiary-fixed font-semibold text-xs tracking-widest uppercase mb-6">{{ trim(str_ireplace(['2025/2026', 'Penerimaan Siswa Baru', 'PPDB'], ['', 'Penerimaan Murid Baru', 'PMB'], $pmb?->hero_badge ?? 'Penerimaan Murid Baru')) }}</span>
            <h1
                class="font-headline text-5xl md:text-7xl font-extrabold text-primary leading-tight tracking-tighter mb-6">
                {{ $pmb?->hero_title ?? 'Mulai Masa Depan Gemilang di SMAN Pintar' }}
            </h1>
            <p class="text-xl text-on-surface-variant leading-relaxed mb-10 max-w-lg">
                {{ str_replace('2025/2026', '', $pmb?->hero_description ?? 'Pendaftaran Peserta Didik Baru telah dibuka. Bergabunglah dengan institusi pendidikan unggulan di Riau.') }}
            </p>
            <div class="flex flex-col sm:flex-row gap-4">
                <a href="#persyaratan"
                    class="border-2 border-primary/20 text-primary px-8 py-4 rounded-lg font-bold text-lg hover:bg-primary/5 transition-all">
                    {{ $pmb?->secondary_button_text ?? 'Panduan PMB' }}
                </a>
            </div>
        </div>
        <div class="relative group">
            <div
                class="absolute -top-10 -right-10 w-64 h-64 bg-tertiary/10 rounded-full blur-3xl group-hover:bg-tertiary/20 transition-all duration-700">
            </div>
            <div
                class="absolute -bottom-10 -left-10 w-72 h-72 bg-primary/10 rounded-full blur-3xl group-hover:bg-primary/20 transition-all duration-700">
            </div>
            <div
                class="relative rounded-2xl overflow-hidden shadow-2xl transform rotate-2 hover:rotate-0 transition-transform duration-500">
                <img alt="SMAN Pintar Campus" class="w-full aspect-[4/5] object-cover" src="{{ $heroImage }}" />
            </div>
        </div>
    </div>
</section>

{{-- Alur Pendaftaran --}}
<section class="py-24 bg-surface-container-low">
    <div class="max-w-7xl mx-auto px-8">
        <div class="text-center mb-20">
            <p class="text-tertiary font-bold tracking-[0.2em] text-sm uppercase mb-3">
                {{ $pmb?->steps_label ?? 'Langkah Mudah' }}</p>
            <h2 class="font-headline text-4xl md:text-5xl font-extrabold text-primary">
                {{ $pmb?->steps_title ?? 'Alur Pendaftaran' }}</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @forelse ($alur as $index => $item)
            <div
                class="bg-surface-container-lowest p-8 rounded-2xl shadow-sm border border-outline-variant/10 border-t-4 {{ $index === 0 ? 'border-t-primary' : ($index === 1 ? 'border-t-tertiary' : 'border-t-secondary') }} relative group hover:-translate-y-1 hover:shadow-xl transition-all duration-500">
                <span
                    class="mb-5 inline-flex h-2 w-14 rounded-full {{ $index === 0 ? 'bg-primary' : ($index === 1 ? 'bg-tertiary' : 'bg-secondary') }}"></span>
                <p class="mb-2 text-xs font-bold uppercase tracking-[0.18em] text-on-surface-variant">Tahap {{ $index + 1 }}</p>
                <h3 class="font-bold text-xl leading-snug">{{ $item }}</h3>
                @if(! $loop->last)
                <div
                    class="hidden md:flex absolute -right-10 top-1/2 h-12 w-12 -translate-y-1/2 items-center justify-center rounded-full bg-surface-container-low text-primary shadow-sm border border-outline-variant/20 z-10">
                    <span class="material-symbols-outlined text-2xl">arrow_forward</span>
                </div>
                @endif
            </div>
            @empty
            <div
                class="bg-surface-container-lowest p-8 rounded-2xl shadow-sm border border-outline-variant/10 border-t-4 border-t-primary relative group hover:-translate-y-1 hover:shadow-xl transition-all duration-500">
                <span class="mb-5 inline-flex h-2 w-14 rounded-full bg-primary"></span>
                <h3 class="font-bold text-xl leading-snug">Pengisian Data</h3>
                <div
                    class="hidden md:flex absolute -right-10 top-1/2 h-12 w-12 -translate-y-1/2 items-center justify-center rounded-full bg-surface-container-low text-primary shadow-sm border border-outline-variant/20 z-10">
                    <span class="material-symbols-outlined text-2xl">arrow_forward</span>
                </div>
            </div>
            <div
                class="bg-surface-container-lowest p-8 rounded-2xl shadow-sm border border-outline-variant/10 border-t-4 border-t-tertiary relative group hover:-translate-y-1 hover:shadow-xl transition-all duration-500">
                <span class="mb-5 inline-flex h-2 w-14 rounded-full bg-tertiary"></span>
                <h3 class="font-bold text-xl leading-snug">Verifikasi Berkas</h3>
                <div
                    class="hidden md:flex absolute -right-10 top-1/2 h-12 w-12 -translate-y-1/2 items-center justify-center rounded-full bg-surface-container-low text-primary shadow-sm border border-outline-variant/20 z-10">
                    <span class="material-symbols-outlined text-2xl">arrow_forward</span>
                </div>
            </div>
            <div
                class="bg-surface-container-lowest p-8 rounded-2xl shadow-sm border border-outline-variant/10 border-t-4 border-t-secondary group hover:-translate-y-1 hover:shadow-xl transition-all duration-500">
                <span class="mb-5 inline-flex h-2 w-14 rounded-full bg-secondary"></span>
                <h3 class="font-bold text-xl leading-snug">Ujian Seleksi</h3>
            </div>
            @endforelse
        </div>
    </div>
</section>

{{-- Persyaratan --}}
<section id="persyaratan" class="py-24">
    <div class="max-w-7xl mx-auto px-8">
        <div class="grid md:grid-cols-2 gap-8">
            <div class="bg-surface-container p-10 rounded-3xl shadow-sm border border-outline-variant/10">
                <h3 class="font-headline text-3xl font-extrabold text-primary mb-8">Persyaratan Umum</h3>
                <ul class="list-disc space-y-6 pl-6 marker:text-primary">
                    @forelse ($persyaratan as $item)
                    <li class="pl-2 text-on-surface-variant leading-relaxed">
                        {{ $item }}
                    </li>
                    @empty
                    <li class="pl-2 text-on-surface-variant leading-relaxed">
                        Informasi persyaratan akan diperbarui melalui CMS PMB.
                    </li>
                    @endforelse
                </ul>
            </div>
            <div class="bg-surface-container p-10 rounded-3xl shadow-sm border border-outline-variant/10">
                <h3 class="font-headline text-3xl font-extrabold text-primary mb-8">Berkas Administrasi</h3>
                <ul class="list-disc space-y-6 pl-6 marker:text-primary">
                    @forelse ($berkas as $item)
                    <li class="pl-2 text-on-surface-variant font-medium leading-relaxed">
                        {{ $item }}
                    </li>
                    @empty
                    <li class="pl-2 text-on-surface-variant font-medium leading-relaxed">
                        Informasi berkas administrasi akan diperbarui melalui CMS PMB.
                    </li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</section>

{{-- Jadwal (Timeline) --}}
<section class="py-24 bg-surface-container-lowest">
    <div class="max-w-7xl mx-auto px-8">
        <div class="text-center mb-16">
            <h2 class="font-headline text-4xl font-extrabold text-primary mb-4">
                {{ $pmb?->timeline_title ?? 'Timeline Pendaftaran' }}</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-separate border-spacing-y-4">
                <thead>
                    <tr class="text-primary/60 font-bold uppercase text-xs tracking-[0.2em]">
                        <th class="px-8 py-4">Kegiatan</th>
                        <th class="px-8 py-4">Tanggal Pelaksanaan</th>
                    </tr>
                </thead>
                <tbody class="space-y-4">
                    {{-- DYNAMIC LOOP: Jadwal dari Controller --}}
                    @forelse ($jadwal as $item)
                    <tr
                        class="{{ isset($item->is_highlight) && $item->is_highlight ? 'bg-tertiary-fixed text-on-tertiary-fixed font-bold shadow-lg shadow-tertiary/10' : 'bg-surface-container-low hover:bg-surface-container transition-colors rounded-xl' }}">
                        <td
                            class="px-8 py-6 {{ !isset($item->is_highlight) ? 'font-bold text-primary' : '' }} rounded-l-xl">
                            {{ $item->kegiatan }}</td>
                        <td class="px-8 py-6 rounded-r-xl">{{ $item->tanggal }}</td>
                    </tr>
                    @empty
                    <tr class="bg-surface-container-low">
                        <td colspan="2" class="px-8 py-6 rounded-xl text-center text-on-surface-variant">Timeline PMB
                            akan diperbarui melalui CMS.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</section>

{{-- FAQ --}}
<section class="py-24 bg-surface">
    <div class="max-w-4xl mx-auto px-8">
        <div class="text-center mb-16">
            <h2 class="font-headline text-4xl font-extrabold text-primary mb-4">
                {{ $pmb?->faq_title ?? 'Pertanyaan Umum (FAQ)' }}</h2>
        </div>
        <div class="space-y-4">
            @forelse ($faq as $item)
            <div class="bg-surface-container-low rounded-2xl overflow-hidden group" data-faq-item>
                <button type="button"
                    class="w-full px-8 py-6 text-left flex justify-between items-center hover:bg-surface-container transition-all"
                    data-faq-toggle aria-expanded="false">
                    <span class="font-bold text-lg text-primary">{{ $item->pertanyaan }}</span>
                    <span class="material-symbols-outlined transition-transform" data-faq-icon>expand_more</span>
                </button>
                <div class="hidden px-8 pb-6 text-on-surface-variant leading-relaxed" data-faq-answer>
                    {{ $item->jawaban }}
                </div>
            </div>
            @empty
            <div class="bg-surface-container-low rounded-2xl overflow-hidden group">
                <div class="px-8 py-6 text-on-surface-variant leading-relaxed">
                    FAQ PMB akan diperbarui melalui CMS.
                </div>
            </div>
            @endforelse
        </div>
    </div>
</section>

<script>
document.querySelectorAll('[data-faq-toggle]').forEach((button) => {
    button.addEventListener('click', () => {
        const item = button.closest('[data-faq-item]');
        const answer = item?.querySelector('[data-faq-answer]');
        const icon = item?.querySelector('[data-faq-icon]');
        const isOpen = button.getAttribute('aria-expanded') === 'true';

        button.setAttribute('aria-expanded', String(!isOpen));
        answer?.classList.toggle('hidden', isOpen);
        icon?.classList.toggle('rotate-180', !isOpen);
    });
});
</script>

{{-- CTA Akhir --}}
<section class="py-24">
    <div class="max-w-7xl mx-auto px-8">
        <div
            class="bg-gradient-to-br from-primary via-primary-container to-blue-900 rounded-[3rem] p-12 md:p-24 text-center text-white relative overflow-hidden shadow-2xl">
            <div class="absolute top-0 left-0 w-full h-full opacity-10">
                <svg class="w-full h-full" viewbox="0 0 100 100">
                    <pattern height="10" id="grid" patternunits="userSpaceOnUse" width="10">
                        <path d="M 10 0 L 0 0 0 10" fill="none" stroke="white" stroke-width="0.5"></path>
                    </pattern>
                    <rect fill="url(#grid)" height="100" width="100"></rect>
                </svg>
            </div>
            <div class="relative z-10">
                <h2 class="font-headline text-4xl md:text-6xl font-extrabold mb-8 tracking-tighter">
                    {{ $pmb?->cta_title ?? 'Wujudkan Impian Anda Bersama SMAN Pintar Riau' }}
                </h2>
                <p class="text-xl text-primary-fixed mb-12 max-w-2xl mx-auto opacity-90 leading-relaxed">
                    {{ $pmb?->cta_description ?? 'Jangan lewatkan kesempatan untuk bergabung dengan komunitas pelajar terbaik. Pendaftaran akan ditutup dalam beberapa hari ke depan.' }}
                </p>
                <div class="flex flex-col sm:flex-row justify-center gap-6">
                    <a href="{{ $pmb?->cta_secondary_link ?: route('pmb') }}" target="_blank"
                        class="bg-white/10 backdrop-blur-md border border-white/20 text-white px-10 py-5 rounded-xl font-bold text-xl hover:bg-white/20 transition-all">
                        {{ $pmb?->cta_secondary_text ?? 'Hubungi Panitia' }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
