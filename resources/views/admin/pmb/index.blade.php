@extends('layouts.admin')

@section('title', 'PMB | Admin SMAN Pintar')

@section('content')
@php
$heroImage = $pmb?->hero_image
? asset('storage/' . $pmb->hero_image)
:
'https://lh3.googleusercontent.com/aida-public/AB6AXuCzki_EPBNVyg-ldrcUWYC_cc07-B11lum4k6V5O6cNZPyNyNQ1xfh6ZNwxUxGCyiC-x1bMl09IvHCNP3Sbxy4qk_DhR9ljXdMhUikF3im0IHd5_9EkaNk1xWQvCKbOD7QyYy935iH-3C66VCiGB-seTE8fgTJdxxyHnHlMpyYAfe28tlRZ7NpipXSBVWLasgsafK2C1uEWsdorypBCAYEioFJffpS6MgyrNBgnkQfyRFBqg751RMs5T8I0VCNKS_WespzJ_IalC9b4';

$alurItems = collect(old('alur', $pmb?->alur ?? [
    ['title' => 'Seleksi Administrasi & Nilai Rapor'],
    ['title' => 'Tes Kemampuan Akademik (TPA) & Wawancara Orang Tua'],
    ['title' => 'Psikotes, Tes Bahasa Inggris, Baca Tulis Al-Qur\'an, Tes Kesehatan, dan Tes Fisik'],
]))->values();
$requirementItems = collect(old('persyaratan_umum', $pmb?->persyaratan_umum ?? [['text' => 'Warga Negara Indonesia']]))->values();
$documentItems = collect(old('berkas', $pmb?->berkas ?? [['text' => 'Persetujuan orang tua']]))->values();
$scheduleItems = collect(old('jadwal', $pmb?->jadwal ?? [[
    'kegiatan' => 'Pendaftaran dan Seleksi Administrasi',
    'tanggal_mulai' => '',
    'tanggal_selesai' => '',
    'tanggal_legacy' => '',
]]))->values();
$faqItems = collect(old('faq', $pmb?->faq ?? [[
    'pertanyaan' => 'Kapan pendaftaran dibuka?',
    'jawaban' => 'Informasi pendaftaran akan diumumkan oleh panitia PMB.',
]]))->values();

if ($alurItems->isEmpty()) $alurItems = collect([['title' => '']]);
if ($requirementItems->isEmpty()) $requirementItems = collect([['text' => '']]);
if ($documentItems->isEmpty()) $documentItems = collect([['text' => '']]);
if ($scheduleItems->isEmpty()) $scheduleItems = collect([['kegiatan' => '', 'tanggal_mulai' => '', 'tanggal_selesai' => '', 'tanggal_legacy' => '']]);
if ($faqItems->isEmpty()) $faqItems = collect([['pertanyaan' => '', 'jawaban' => '']]);

$components = [
['id' => 'pmb-hero-section', 'icon' => 'rocket_launch', 'title' => 'Hero PMB', 'content' => 'Mengatur banner utama dan informasi PMB'],
['id' => 'pmb-steps-section', 'icon' => 'route', 'title' => 'Alur Pendaftaran', 'content' => 'Mengatur tahapan seleksi PMB yang ditampilkan pada website'],
['id' => 'pmb-requirements-section', 'icon' => 'fact_check', 'title' => 'Persyaratan & Berkas', 'content' => 'Mengatur persyaratan dan dokumen pendaftaran calon siswa'],
['id' => 'pmb-timeline-section', 'icon' => 'event_note', 'title' => 'Timeline Pendaftaran', 'content' => 'Mengatur jadwal pelaksanaan setiap tahapan PMB'],
['id' => 'pmb-faq-section', 'icon' => 'quiz', 'title' => 'FAQ PMB', 'content' => 'Mengatur daftar pertanyaan dan jawaban seputar PMB'],
['id' => 'pmb-cta-section', 'icon' => 'campaign', 'title' => 'CTA Pendaftaran', 'content' => 'Mengatur banner ajakan pendaftaran, tombol, dan tautan tindakan'],
];
@endphp

<style>
#pmb-editors {
    width: 100%;
}

#pmb-editors [data-pmb-panel] {
    background: transparent;
    border: 0;
    box-shadow: none;
    overflow: visible;
}

#pmb-editors [data-pmb-panel]>summary {
    align-items: flex-start;
    cursor: default;
    list-style: none;
    margin-bottom: 1.75rem;
    padding: 0;
}

#pmb-editors [data-pmb-panel]>summary::-webkit-details-marker {
    display: none;
}

#pmb-editors [data-pmb-panel]>summary>div:first-child>span {
    display: none;
}

#pmb-editors [data-pmb-panel]>summary h3 {
    color: rgb(0 66 141);
    font-size: clamp(2.25rem, 4vw, 3rem);
    font-weight: 800;
    letter-spacing: 0;
    line-height: 1.08;
}

#pmb-editors [data-pmb-panel]>summary button {
    border-radius: 0.9rem;
    background: rgb(241 245 249);
    color: rgb(51 65 85);
    font-size: 1rem;
    padding: 0.85rem 1.35rem;
}

#pmb-editors [data-pmb-panel]>div {
    background: #fff;
    border-top: 0;
    border-radius: 1.25rem;
    box-shadow: 0 10px 32px rgb(15 23 42 / 0.04);
    padding: clamp(1.5rem, 3vw, 2.5rem);
}

#pmb-editors label {
    color: rgb(113 83 0);
    font-size: 0.78rem;
    font-weight: 800;
    letter-spacing: 0;
    margin-bottom: 0.75rem;
    text-transform: uppercase;
}

#pmb-editors input:not([type="hidden"]):not([type="checkbox"]):not([type="radio"]),
#pmb-editors textarea,
#pmb-editors select {
    background: rgb(232 233 243);
    border: 0;
    border-radius: 0.9rem;
    color: rgb(15 23 42);
    font-size: 1rem;
    font-weight: 500;
    min-height: 3.5rem;
    padding: 0.9rem 1.15rem;
    width: 100%;
}

#pmb-editors textarea {
    line-height: 1.65;
    min-height: 9rem;
}

#pmb-editors input::placeholder,
#pmb-editors textarea::placeholder {
    color: rgb(100 116 139);
}

#pmb-editors input:focus,
#pmb-editors textarea:focus,
#pmb-editors select:focus {
    outline: 2px solid rgb(0 66 141 / 0.18);
    outline-offset: 2px;
    box-shadow: none;
}

#pmb-editors .btn-cancel {
    border-radius: 0.9rem;
    min-width: 7.5rem;
    padding: 0.9rem 1.5rem;
}
</style>

<div class="max-w-6xl mx-auto space-y-10">
    @if(session('success'))
    <div class="bg-emerald-50 text-emerald-600 p-4 rounded-xl font-bold flex items-center gap-2">
        <span class="material-symbols-outlined">check_circle</span>
        {{ session('success') }}
    </div>
    @endif

    @if($errors->any())
    <div class="rounded-xl border border-red-200 bg-red-50 p-4 text-red-700">
        <p class="font-bold">Form belum dapat disimpan. Periksa kembali data berikut:</p>
        <ul class="mt-2 list-disc space-y-1 pl-5 text-sm">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form method="POST" action="{{ route('admin.pmb.update') }}" enctype="multipart/form-data" class="space-y-10">
        @csrf
        <input type="hidden" name="active_panel" id="activePmbPanelInput" value="">

        <div id="pmb-overview" class="space-y-10">
            <section>
                <h2 class="text-4xl font-extrabold text-primary tracking-tight font-headline">PMB</h2>
            </section>

            <section
                class="bg-surface-container-lowest rounded-2xl overflow-hidden shadow-[0_8px_30px_rgb(0,0,0,0.04)]">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-surface-container-low/50">
                                <th class="px-8 py-5 text-[11px] font-bold text-slate-400 uppercase tracking-widest">No
                                </th>
                                <th class="px-6 py-5 text-[11px] font-bold text-slate-400 uppercase tracking-widest">
                                    Komponen</th>
                                <th class="px-6 py-5 text-[11px] font-bold text-slate-400 uppercase tracking-widest">
                                    Ringkasan</th>
                                <th
                                    class="px-8 py-5 text-[11px] font-bold text-slate-400 uppercase tracking-widest text-right">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-surface-container">
                            @foreach ($components as $component)
                            <tr class="group hover:bg-surface-container-low/30 transition-colors">
                                <td class="px-8 py-4">
                                    <span
                                        class="inline-flex h-8 w-8 items-center justify-center rounded-lg bg-blue-50 text-sm font-bold text-primary">
                                        {{ $loop->iteration }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <p class="font-bold text-blue-900 group-hover:text-primary transition-colors">
                                        {{ $component['title'] }}</p>
                                </td>
                                <td class="px-6 py-4">
                                    <p
                                        class="max-w-xl text-sm text-on-surface-variant font-medium leading-relaxed line-clamp-2">
                                        {{ $component['content'] }}</p>
                                </td>
                                <td class="px-8 py-4 text-right">
                                    <a href="#{{ $component['id'] }}" data-pmb-edit-target="{{ $component['id'] }}"
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

        <section id="pmb-editors" class="hidden space-y-5">
            <details id="pmb-hero-section" data-pmb-panel
                class="group bg-surface-container-lowest rounded-2xl shadow-sm border border-slate-100 overflow-hidden"
                open>
                <summary class="list-none p-6 flex items-center justify-between gap-4">
                    <div>
                        <span class="text-xs font-bold text-tertiary uppercase tracking-widest mb-1 block">Component
                            01</span>
                        <h3 class="text-2xl font-headline font-extrabold text-primary">Hero PMB</h3>
                    </div>
                    <button type="button" data-pmb-back
                        class="inline-flex items-center gap-2 rounded-xl bg-slate-100 px-4 py-2 text-sm font-bold text-slate-600 hover:bg-slate-200 transition-colors">
                        <span class="material-symbols-outlined text-[18px]">arrow_back</span>
                        Kembali
                    </button>
                </summary>
                <div class="border-t border-slate-100 p-6 lg:p-8 bg-surface-container-low/40">
                    <input name="hero_badge" type="hidden"
                        value="{{ old('hero_badge', trim(str_ireplace(['2025/2026', 'Penerimaan Siswa Baru', 'PPDB'], ['', 'Penerimaan Murid Baru', 'PMB'], $pmb?->hero_badge ?? 'Penerimaan Murid Baru'))) }}">
                    <input name="link_pendaftaran" type="hidden"
                        value="{{ old('link_pendaftaran', $pmb?->link_pendaftaran ?? '') }}">
                    <input name="primary_button_text" type="hidden"
                        value="{{ old('primary_button_text', $pmb?->primary_button_text ?? 'Informasi PMB') }}">
                    <input name="secondary_button_text" type="hidden"
                        value="{{ old('secondary_button_text', $pmb?->secondary_button_text ?? 'Panduan PMB') }}">
                    <input name="hero_card_title" type="hidden" value="">
                    <input name="hero_card_subtitle" type="hidden" value="">

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <div class="space-y-6">
                            <div>
                                <label class="block">Judul Hero</label>
                                <input name="hero_title"
                                    data-required
                                    value="{{ old('hero_title', $pmb?->hero_title ?? 'Mulai Masa Depan Gemilang di SMAN Pintar') }}"
                                    placeholder="Contoh: Mulai Masa Depan Gemilang di SMAN Pintar">
                            </div>
                            <div>
                                <label class="block">Deskripsi Hero</label>
                                <textarea name="hero_description" rows="4"
                                    data-required
                                    placeholder="Tulis kalimat pembuka PMB yang singkat dan jelas.">{{ old('hero_description', str_replace('2025/2026', '', $pmb?->hero_description ?? 'Pendaftaran Peserta Didik Baru telah dibuka. Bergabunglah dengan institusi pendidikan unggulan di Riau.')) }}</textarea>
                            </div>
                            <div>
                                <label class="block">Gambar Banner</label>
                                <input name="hero_image" type="file" accept="image/*">
                                <p class="mt-2 text-sm font-medium text-slate-500">Biarkan kosong jika gambar tidak
                                    ingin diganti.</p>
                            </div>
                        </div>

                        <div class="space-y-4">
                            <div class="overflow-hidden rounded-2xl bg-slate-100 shadow-sm">
                                <img class="h-80 w-full object-cover" src="{{ $heroImage }}"
                                    alt="Preview gambar hero PMB">
                            </div>
                        </div>
                    </div>
                </div>
            </details>

            <details id="pmb-steps-section" data-pmb-panel
                class="hidden group bg-surface-container-lowest rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
                <summary class="list-none p-6 flex items-center justify-between gap-4">
                    <div><span class="text-xs font-bold text-tertiary uppercase tracking-widest mb-1 block">Component
                            02</span>
                        <h3 class="text-2xl font-headline font-extrabold text-primary">Alur Pendaftaran</h3>
                    </div>
                    <button type="button" data-pmb-back
                        class="inline-flex items-center gap-2 rounded-xl bg-slate-100 px-4 py-2 text-sm font-bold text-slate-600 hover:bg-slate-200 transition-colors"><span
                            class="material-symbols-outlined text-[18px]">arrow_back</span>Kembali</button>
                </summary>
                <div class="border-t border-slate-100 p-6 lg:p-8 bg-surface-container-low/40 space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block">Label Kecil</label>
                            <input name="steps_label" data-required
                                value="{{ old('steps_label', $pmb?->steps_label ?? 'Langkah Mudah') }}"
                                placeholder="Contoh: Langkah Mudah">
                        </div>
                        <div>
                            <label class="block">Judul Bagian</label>
                            <input name="steps_title" data-required
                                value="{{ old('steps_title', $pmb?->steps_title ?? 'Alur Pendaftaran') }}"
                                placeholder="Contoh: Alur Pendaftaran">
                        </div>
                    </div>
                    <div data-dynamic-list data-list-name="alur" data-item-label="Tahap" class="space-y-4">
                        <div class="flex items-center justify-between gap-4">
                            <label class="block mb-0">Daftar Tahapan</label>
                            <button type="button" data-add-item class="inline-flex items-center gap-2 rounded-xl bg-primary px-4 py-2 text-sm font-bold text-white">
                                <span class="material-symbols-outlined text-[18px]">add</span> Tambah Tahap
                            </button>
                        </div>
                        <div data-list-items class="space-y-4">
                            @foreach($alurItems as $index => $item)
                            <article data-list-item class="rounded-2xl border border-slate-200 bg-white p-5 space-y-4">
                                <div class="flex items-center justify-between gap-3">
                                    <h4 data-item-title class="font-bold text-primary">Tahap {{ $index + 1 }}</h4>
                                    <div class="flex gap-2">
                                        <button type="button" data-move-up class="h-9 w-9 rounded-lg bg-slate-100 text-slate-600" aria-label="Naikkan tahap"><span class="material-symbols-outlined text-[18px]">arrow_upward</span></button>
                                        <button type="button" data-move-down class="h-9 w-9 rounded-lg bg-slate-100 text-slate-600" aria-label="Turunkan tahap"><span class="material-symbols-outlined text-[18px]">arrow_downward</span></button>
                                        <button type="button" data-remove-item class="h-9 w-9 rounded-lg bg-red-50 text-red-600" aria-label="Hapus tahap"><span class="material-symbols-outlined text-[18px]">delete</span></button>
                                    </div>
                                </div>
                                <div>
                                    <label class="block">Nama Tahap</label>
                                    <input data-field="title" data-required name="alur[{{ $index }}][title]" value="{{ data_get($item, 'title') }}" placeholder="Contoh: Seleksi Administrasi & Nilai Rapor">
                                </div>
                            </article>
                            @endforeach
                        </div>
                        <template data-item-template>
                            <article data-list-item class="rounded-2xl border border-slate-200 bg-white p-5 space-y-4">
                                <div class="flex items-center justify-between gap-3">
                                    <h4 data-item-title class="font-bold text-primary">Tahap</h4>
                                    <div class="flex gap-2">
                                        <button type="button" data-move-up class="h-9 w-9 rounded-lg bg-slate-100 text-slate-600" aria-label="Naikkan tahap"><span class="material-symbols-outlined text-[18px]">arrow_upward</span></button>
                                        <button type="button" data-move-down class="h-9 w-9 rounded-lg bg-slate-100 text-slate-600" aria-label="Turunkan tahap"><span class="material-symbols-outlined text-[18px]">arrow_downward</span></button>
                                        <button type="button" data-remove-item class="h-9 w-9 rounded-lg bg-red-50 text-red-600" aria-label="Hapus tahap"><span class="material-symbols-outlined text-[18px]">delete</span></button>
                                    </div>
                                </div>
                                <div><label class="block">Nama Tahap</label><input data-field="title" data-required placeholder="Contoh: Seleksi Administrasi & Nilai Rapor"></div>
                            </article>
                        </template>
                    </div>
                </div>
            </details>

            <details id="pmb-requirements-section" data-pmb-panel
                class="hidden group bg-surface-container-lowest rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
                <summary class="list-none p-6 flex items-center justify-between gap-4">
                    <div><span class="text-xs font-bold text-tertiary uppercase tracking-widest mb-1 block">Component
                            03</span>
                        <h3 class="text-2xl font-headline font-extrabold text-primary">Persyaratan & Berkas</h3>
                    </div>
                    <button type="button" data-pmb-back
                        class="inline-flex items-center gap-2 rounded-xl bg-slate-100 px-4 py-2 text-sm font-bold text-slate-600 hover:bg-slate-200 transition-colors"><span
                            class="material-symbols-outlined text-[18px]">arrow_back</span>Kembali</button>
                </summary>
                <div class="border-t border-slate-100 p-6 lg:p-8 bg-surface-container-low/40 grid grid-cols-1 xl:grid-cols-2 gap-8">
                    @foreach([
                        ['name' => 'persyaratan_umum', 'label' => 'Persyaratan Umum', 'button' => 'Tambah Persyaratan', 'items' => $requirementItems, 'placeholder' => 'Contoh: Warga Negara Indonesia'],
                        ['name' => 'berkas', 'label' => 'Berkas Administrasi', 'button' => 'Tambah Berkas', 'items' => $documentItems, 'placeholder' => 'Contoh: Persetujuan orang tua'],
                    ] as $list)
                    <div data-dynamic-list data-list-name="{{ $list['name'] }}" data-item-label="Poin" class="space-y-4">
                        <div class="flex items-center justify-between gap-3">
                            <label class="block mb-0">{{ $list['label'] }}</label>
                            <button type="button" data-add-item class="inline-flex items-center gap-2 rounded-xl bg-primary px-3 py-2 text-sm font-bold text-white">
                                <span class="material-symbols-outlined text-[18px]">add</span> {{ $list['button'] }}
                            </button>
                        </div>
                        <div data-list-items class="space-y-3">
                            @foreach($list['items'] as $index => $item)
                            <article data-list-item class="rounded-xl border border-slate-200 bg-white p-4">
                                <div class="flex items-end gap-3">
                                    <div class="min-w-0 flex-1">
                                        <label data-item-title class="block">Poin {{ $index + 1 }}</label>
                                        <input data-field="text" data-required name="{{ $list['name'] }}[{{ $index }}][text]" value="{{ data_get($item, 'text') }}" placeholder="{{ $list['placeholder'] }}">
                                    </div>
                                    <div class="flex gap-1 pb-2">
                                        <button type="button" data-move-up class="h-9 w-9 rounded-lg bg-slate-100 text-slate-600"><span class="material-symbols-outlined text-[18px]">arrow_upward</span></button>
                                        <button type="button" data-move-down class="h-9 w-9 rounded-lg bg-slate-100 text-slate-600"><span class="material-symbols-outlined text-[18px]">arrow_downward</span></button>
                                        <button type="button" data-remove-item class="h-9 w-9 rounded-lg bg-red-50 text-red-600"><span class="material-symbols-outlined text-[18px]">delete</span></button>
                                    </div>
                                </div>
                            </article>
                            @endforeach
                        </div>
                        <template data-item-template>
                            <article data-list-item class="rounded-xl border border-slate-200 bg-white p-4">
                                <div class="flex items-end gap-3">
                                    <div class="min-w-0 flex-1"><label data-item-title class="block">Poin</label><input data-field="text" data-required placeholder="{{ $list['placeholder'] }}"></div>
                                    <div class="flex gap-1 pb-2">
                                        <button type="button" data-move-up class="h-9 w-9 rounded-lg bg-slate-100 text-slate-600"><span class="material-symbols-outlined text-[18px]">arrow_upward</span></button>
                                        <button type="button" data-move-down class="h-9 w-9 rounded-lg bg-slate-100 text-slate-600"><span class="material-symbols-outlined text-[18px]">arrow_downward</span></button>
                                        <button type="button" data-remove-item class="h-9 w-9 rounded-lg bg-red-50 text-red-600"><span class="material-symbols-outlined text-[18px]">delete</span></button>
                                    </div>
                                </div>
                            </article>
                        </template>
                    </div>
                    @endforeach
                </div>
            </details>

            <details id="pmb-timeline-section" data-pmb-panel
                class="hidden group bg-surface-container-lowest rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
                <summary class="list-none p-6 flex items-center justify-between gap-4">
                    <div><span class="text-xs font-bold text-tertiary uppercase tracking-widest mb-1 block">Component
                            04</span>
                        <h3 class="text-2xl font-headline font-extrabold text-primary">Timeline Pendaftaran</h3>
                    </div>
                    <button type="button" data-pmb-back
                        class="inline-flex items-center gap-2 rounded-xl bg-slate-100 px-4 py-2 text-sm font-bold text-slate-600 hover:bg-slate-200 transition-colors"><span
                            class="material-symbols-outlined text-[18px]">arrow_back</span>Kembali</button>
                </summary>
                <div class="border-t border-slate-100 p-6 lg:p-8 bg-surface-container-low/40 space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block">Judul Bagian</label>
                            <input name="timeline_title" data-required
                                value="{{ old('timeline_title', $pmb?->timeline_title ?? 'Timeline Pendaftaran') }}"
                                placeholder="Contoh: Timeline Pendaftaran">
                        </div>
                    </div>
                    <div data-dynamic-list data-list-name="jadwal" data-item-label="Jadwal" class="space-y-4">
                        <div class="flex items-center justify-between gap-4">
                            <label class="block mb-0">Daftar Jadwal</label>
                            <button type="button" data-add-item class="inline-flex items-center gap-2 rounded-xl bg-primary px-4 py-2 text-sm font-bold text-white">
                                <span class="material-symbols-outlined text-[18px]">add</span> Tambah Jadwal
                            </button>
                        </div>
                        <div data-list-items class="space-y-4">
                            @foreach($scheduleItems as $index => $item)
                            @php($legacyDate = data_get($item, 'tanggal_legacy'))
                            <article data-list-item class="rounded-2xl border border-slate-200 bg-white p-5 space-y-4">
                                <div class="flex items-center justify-between gap-3">
                                    <h4 data-item-title class="font-bold text-primary">Jadwal {{ $index + 1 }}</h4>
                                    <div class="flex gap-2">
                                        <button type="button" data-move-up class="h-9 w-9 rounded-lg bg-slate-100 text-slate-600"><span class="material-symbols-outlined text-[18px]">arrow_upward</span></button>
                                        <button type="button" data-move-down class="h-9 w-9 rounded-lg bg-slate-100 text-slate-600"><span class="material-symbols-outlined text-[18px]">arrow_downward</span></button>
                                        <button type="button" data-remove-item class="h-9 w-9 rounded-lg bg-red-50 text-red-600"><span class="material-symbols-outlined text-[18px]">delete</span></button>
                                    </div>
                                </div>
                                <div>
                                    <label class="block">Nama Kegiatan</label>
                                    <input data-field="kegiatan" data-required name="jadwal[{{ $index }}][kegiatan]" value="{{ data_get($item, 'kegiatan') }}" placeholder="Contoh: Seleksi Administrasi">
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div><label class="block">Tanggal Mulai</label><input data-field="tanggal_mulai" {{ $legacyDate ? '' : 'data-required' }} name="jadwal[{{ $index }}][tanggal_mulai]" type="date" value="{{ data_get($item, 'tanggal_mulai') }}"></div>
                                    <div><label class="block">Tanggal Selesai <span class="normal-case text-slate-400">(opsional)</span></label><input data-field="tanggal_selesai" name="jadwal[{{ $index }}][tanggal_selesai]" type="date" value="{{ data_get($item, 'tanggal_selesai') }}"></div>
                                </div>
                                <input data-field="tanggal_legacy" type="hidden" name="jadwal[{{ $index }}][tanggal_legacy]" value="{{ $legacyDate }}">
                                @if($legacyDate)
                                <p class="rounded-lg bg-amber-50 px-3 py-2 text-sm text-amber-700">Tanggal lama: {{ $legacyDate }}. Isi Tanggal Mulai untuk mengganti format lama.</p>
                                @endif
                            </article>
                            @endforeach
                        </div>
                        <template data-item-template>
                            <article data-list-item class="rounded-2xl border border-slate-200 bg-white p-5 space-y-4">
                                <div class="flex items-center justify-between gap-3">
                                    <h4 data-item-title class="font-bold text-primary">Jadwal</h4>
                                    <div class="flex gap-2">
                                        <button type="button" data-move-up class="h-9 w-9 rounded-lg bg-slate-100 text-slate-600"><span class="material-symbols-outlined text-[18px]">arrow_upward</span></button>
                                        <button type="button" data-move-down class="h-9 w-9 rounded-lg bg-slate-100 text-slate-600"><span class="material-symbols-outlined text-[18px]">arrow_downward</span></button>
                                        <button type="button" data-remove-item class="h-9 w-9 rounded-lg bg-red-50 text-red-600"><span class="material-symbols-outlined text-[18px]">delete</span></button>
                                    </div>
                                </div>
                                <div><label class="block">Nama Kegiatan</label><input data-field="kegiatan" data-required placeholder="Contoh: Seleksi Administrasi"></div>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div><label class="block">Tanggal Mulai</label><input data-field="tanggal_mulai" data-required type="date"></div>
                                    <div><label class="block">Tanggal Selesai <span class="normal-case text-slate-400">(opsional)</span></label><input data-field="tanggal_selesai" type="date"></div>
                                </div>
                                <input data-field="tanggal_legacy" type="hidden" value="">
                            </article>
                        </template>
                    </div>
                </div>
            </details>

            <details id="pmb-faq-section" data-pmb-panel
                class="hidden group bg-surface-container-lowest rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
                <summary class="list-none p-6 flex items-center justify-between gap-4">
                    <div><span class="text-xs font-bold text-tertiary uppercase tracking-widest mb-1 block">Component
                            05</span>
                        <h3 class="text-2xl font-headline font-extrabold text-primary">FAQ PMB</h3>
                    </div>
                    <button type="button" data-pmb-back
                        class="inline-flex items-center gap-2 rounded-xl bg-slate-100 px-4 py-2 text-sm font-bold text-slate-600 hover:bg-slate-200 transition-colors"><span
                            class="material-symbols-outlined text-[18px]">arrow_back</span>Kembali</button>
                </summary>
                <div class="border-t border-slate-100 p-6 lg:p-8 bg-surface-container-low/40 space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block">Judul Bagian</label>
                            <input name="faq_title" data-required
                                value="{{ old('faq_title', $pmb?->faq_title ?? 'Pertanyaan Umum (FAQ)') }}"
                                placeholder="Contoh: Pertanyaan Umum (FAQ)">
                        </div>
                    </div>
                    <div data-dynamic-list data-list-name="faq" data-item-label="Pertanyaan" class="space-y-4">
                        <div class="flex items-center justify-between gap-4">
                            <label class="block mb-0">Daftar FAQ</label>
                            <button type="button" data-add-item class="inline-flex items-center gap-2 rounded-xl bg-primary px-4 py-2 text-sm font-bold text-white">
                                <span class="material-symbols-outlined text-[18px]">add</span> Tambah Pertanyaan
                            </button>
                        </div>
                        <div data-list-items class="space-y-4">
                            @foreach($faqItems as $index => $item)
                            <article data-list-item class="rounded-2xl border border-slate-200 bg-white p-5 space-y-4">
                                <div class="flex items-center justify-between gap-3">
                                    <h4 data-item-title class="font-bold text-primary">Pertanyaan {{ $index + 1 }}</h4>
                                    <div class="flex gap-2">
                                        <button type="button" data-move-up class="h-9 w-9 rounded-lg bg-slate-100 text-slate-600"><span class="material-symbols-outlined text-[18px]">arrow_upward</span></button>
                                        <button type="button" data-move-down class="h-9 w-9 rounded-lg bg-slate-100 text-slate-600"><span class="material-symbols-outlined text-[18px]">arrow_downward</span></button>
                                        <button type="button" data-remove-item class="h-9 w-9 rounded-lg bg-red-50 text-red-600"><span class="material-symbols-outlined text-[18px]">delete</span></button>
                                    </div>
                                </div>
                                <div><label class="block">Pertanyaan</label><input data-field="pertanyaan" data-required name="faq[{{ $index }}][pertanyaan]" value="{{ data_get($item, 'pertanyaan') }}" placeholder="Contoh: Kapan pendaftaran dibuka?"></div>
                                <div><label class="block">Jawaban</label><textarea data-field="jawaban" data-required name="faq[{{ $index }}][jawaban]" rows="4" placeholder="Tuliskan jawaban yang jelas.">{{ data_get($item, 'jawaban') }}</textarea></div>
                            </article>
                            @endforeach
                        </div>
                        <template data-item-template>
                            <article data-list-item class="rounded-2xl border border-slate-200 bg-white p-5 space-y-4">
                                <div class="flex items-center justify-between gap-3">
                                    <h4 data-item-title class="font-bold text-primary">Pertanyaan</h4>
                                    <div class="flex gap-2">
                                        <button type="button" data-move-up class="h-9 w-9 rounded-lg bg-slate-100 text-slate-600"><span class="material-symbols-outlined text-[18px]">arrow_upward</span></button>
                                        <button type="button" data-move-down class="h-9 w-9 rounded-lg bg-slate-100 text-slate-600"><span class="material-symbols-outlined text-[18px]">arrow_downward</span></button>
                                        <button type="button" data-remove-item class="h-9 w-9 rounded-lg bg-red-50 text-red-600"><span class="material-symbols-outlined text-[18px]">delete</span></button>
                                    </div>
                                </div>
                                <div><label class="block">Pertanyaan</label><input data-field="pertanyaan" data-required placeholder="Contoh: Kapan pendaftaran dibuka?"></div>
                                <div><label class="block">Jawaban</label><textarea data-field="jawaban" data-required rows="4" placeholder="Tuliskan jawaban yang jelas."></textarea></div>
                            </article>
                        </template>
                    </div>
                </div>
            </details>

            <details id="pmb-cta-section" data-pmb-panel
                class="hidden group bg-surface-container-lowest rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
                <summary class="list-none p-6 flex items-center justify-between gap-4">
                    <div><span class="text-xs font-bold text-tertiary uppercase tracking-widest mb-1 block">Component
                            06</span>
                        <h3 class="text-2xl font-headline font-extrabold text-primary">CTA Pendaftaran</h3>
                    </div>
                    <button type="button" data-pmb-back
                        class="inline-flex items-center gap-2 rounded-xl bg-slate-100 px-4 py-2 text-sm font-bold text-slate-600 hover:bg-slate-200 transition-colors"><span
                            class="material-symbols-outlined text-[18px]">arrow_back</span>Kembali</button>
                </summary>
                <div
                    class="border-t border-slate-100 p-6 lg:p-8 bg-surface-container-low/40 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label class="block">Judul CTA</label>
                        <input name="cta_title" data-required
                            value="{{ old('cta_title', $pmb?->cta_title ?? 'Informasi PMB SMAN Pintar Riau') }}"
                            placeholder="Contoh: Informasi PMB SMAN Pintar Riau">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block">Deskripsi CTA</label>
                        <textarea name="cta_description" data-required rows="4"
                            placeholder="Tulis informasi penutup PMB yang ringkas.">{{ old('cta_description', $pmb?->cta_description ?? 'Informasi pendaftaran dapat diperoleh melalui panitia PMB SMAN Pintar Riau.') }}</textarea>
                    </div>
                    <div>
                        <label class="block">Label Tombol</label>
                        <input name="cta_secondary_text" data-required
                            value="{{ old('cta_secondary_text', $pmb?->cta_secondary_text ?? 'Hubungi Panitia') }}"
                            placeholder="Contoh: Hubungi Panitia">
                    </div>
                    <div>
                        <label class="block">URL Tombol</label>
                        <input name="cta_secondary_link" data-required
                            value="{{ old('cta_secondary_link', $pmb?->cta_secondary_link ?? route('pmb')) }}"
                            placeholder="Contoh: https://wa.me/6281234567890">
                    </div>
                    <input name="cta_primary_text" type="hidden"
                        value="{{ old('cta_primary_text', $pmb?->cta_primary_text ?? 'Informasi PMB') }}">
                </div>
            </details>

            <div class="bg-surface-container-lowest rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] px-8 py-6">
                <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end sm:items-center">
                    <button type="button" data-pmb-back class="btn-cancel">Batal</button>
                    <button type="submit"
                        class="bg-primary text-white px-8 py-3 rounded-xl font-bold shadow-lg hover:scale-105 transition-all">Simpan</button>
                </div>
            </div>
        </section>
    </form>
</div>

<script>
const dynamicLists = Array.from(document.querySelectorAll('[data-dynamic-list]'));

function reindexDynamicList(list) {
    const baseName = list.dataset.listName;
    const itemLabel = list.dataset.itemLabel || 'Item';
    const items = Array.from(list.querySelectorAll('[data-list-items] > [data-list-item]'));

    items.forEach((item, index) => {
        const title = item.querySelector('[data-item-title]');
        if (title) title.textContent = `${itemLabel} ${index + 1}`;

        item.querySelectorAll('[data-field]').forEach((field) => {
            field.name = `${baseName}[${index}][${field.dataset.field}]`;
        });

        const up = item.querySelector('[data-move-up]');
        const down = item.querySelector('[data-move-down]');
        const remove = item.querySelector('[data-remove-item]');
        if (up) up.disabled = index === 0;
        if (down) down.disabled = index === items.length - 1;
        if (remove) remove.disabled = items.length === 1;
    });
}

dynamicLists.forEach((list) => {
    const itemsContainer = list.querySelector('[data-list-items]');
    const template = list.querySelector('[data-item-template]');

    list.querySelector('[data-add-item]')?.addEventListener('click', () => {
        const fragment = template.content.cloneNode(true);
        itemsContainer.appendChild(fragment);
        reindexDynamicList(list);
        updatePmbRequiredFields(document.querySelector('[data-pmb-panel]:not(.hidden)'));
        itemsContainer.lastElementChild?.querySelector('input, textarea')?.focus();
    });

    itemsContainer.addEventListener('click', (event) => {
        const item = event.target.closest('[data-list-item]');
        if (!item) return;

        if (event.target.closest('[data-remove-item]')) {
            if (itemsContainer.querySelectorAll('[data-list-item]').length > 1) item.remove();
        } else if (event.target.closest('[data-move-up]') && item.previousElementSibling) {
            itemsContainer.insertBefore(item, item.previousElementSibling);
        } else if (event.target.closest('[data-move-down]') && item.nextElementSibling) {
            itemsContainer.insertBefore(item.nextElementSibling, item);
        } else {
            return;
        }

        reindexDynamicList(list);
    });

    reindexDynamicList(list);
});

function updatePmbRequiredFields(activePanel = null) {
    document.querySelectorAll('#pmb-editors [data-required]').forEach((field) => {
        field.required = Boolean(activePanel?.contains(field));
    });
}

const pmbOverview = document.getElementById('pmb-overview');
const pmbEditors = document.getElementById('pmb-editors');
const pmbPanels = document.querySelectorAll('[data-pmb-panel]');
const activePmbPanelInput = document.getElementById('activePmbPanelInput');

function showPmbOverview() {
    updatePmbRequiredFields();
    pmbEditors.classList.add('hidden');
    pmbOverview.classList.remove('hidden');
    if (activePmbPanelInput) {
        activePmbPanelInput.value = '';
    }
    pmbPanels.forEach((panel) => panel.classList.add('hidden'));
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
}

function showPmbEditor(panelId) {
    const target = document.getElementById(panelId);

    if (!target) {
        return;
    }

    updatePmbRequiredFields(target);

    pmbOverview.classList.add('hidden');
    pmbEditors.classList.remove('hidden');
    if (activePmbPanelInput) {
        activePmbPanelInput.value = panelId;
    }
    pmbPanels.forEach((panel) => panel.classList.add('hidden'));
    target.classList.remove('hidden');
    target.open = true;
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
}

document.querySelectorAll('[data-pmb-edit-target]').forEach((link) => {
    link.addEventListener('click', (event) => {
        event.preventDefault();
        showPmbEditor(link.dataset.pmbEditTarget);
    });
});

document.querySelectorAll('[data-pmb-back]').forEach((button) => {
    button.addEventListener('click', (event) => {
        event.preventDefault();
        event.stopPropagation();
        showPmbOverview();
    });
});

@if(session('open_pmb_panel'))
showPmbEditor(@json(session('open_pmb_panel')));
@endif

@if($errors->any() && old('active_panel'))
showPmbEditor(@json(old('active_panel')));
@endif
</script>
@endsection
