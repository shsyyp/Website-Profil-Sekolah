@extends('layouts.admin')

@section('title', 'Manajemen PMB | Admin SMAN Pintar')

@section('content')
@php
    $components = [
        ['id' => 'pmb-hero-section', 'icon' => 'rocket_launch', 'title' => 'Hero Halaman', 'meta' => trim(str_replace('2025/2026', '', $pmb?->hero_badge ?? 'Penerimaan Siswa Baru')), 'content' => $pmb?->hero_title ?? 'Mulai Masa Depan Gemilang di SMAN Pintar'],
        ['id' => 'pmb-steps-section', 'icon' => 'route', 'title' => 'Alur Pendaftaran', 'meta' => $pmb?->steps_label ?? 'Langkah Mudah', 'content' => $pmb?->steps_title ?? 'Alur Pendaftaran'],
        ['id' => 'pmb-requirements-section', 'icon' => 'fact_check', 'title' => 'Persyaratan & Berkas', 'meta' => '2 daftar informasi', 'content' => 'Persyaratan Umum, Berkas Administrasi'],
        ['id' => 'pmb-timeline-section', 'icon' => 'event_note', 'title' => 'Timeline Pendaftaran', 'meta' => 'Jadwal kegiatan PMB', 'content' => $pmb?->timeline_title ?? 'Timeline Pendaftaran'],
        ['id' => 'pmb-faq-section', 'icon' => 'quiz', 'title' => 'FAQ PMB', 'meta' => 'Pertanyaan umum', 'content' => $pmb?->faq_title ?? 'Pertanyaan Umum (FAQ)'],
        ['id' => 'pmb-cta-section', 'icon' => 'campaign', 'title' => 'CTA Akhir', 'meta' => $pmb?->cta_primary_text ?? 'Informasi PMB', 'content' => $pmb?->cta_title ?? 'Informasi PMB SMAN Pintar Riau'],
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

    #pmb-editors [data-pmb-panel] > summary {
        align-items: flex-start;
        cursor: default;
        list-style: none;
        margin-bottom: 1.75rem;
        padding: 0;
    }

    #pmb-editors [data-pmb-panel] > summary::-webkit-details-marker {
        display: none;
    }

    #pmb-editors [data-pmb-panel] > summary > div:first-child > span {
        display: none;
    }

    #pmb-editors [data-pmb-panel] > summary h3 {
        color: rgb(0 66 141);
        font-size: clamp(2.25rem, 4vw, 3rem);
        font-weight: 800;
        letter-spacing: 0;
        line-height: 1.08;
    }

    #pmb-editors [data-pmb-panel] > summary button {
        border-radius: 0.9rem;
        background: rgb(241 245 249);
        color: rgb(51 65 85);
        font-size: 1rem;
        padding: 0.85rem 1.35rem;
    }

    #pmb-editors [data-pmb-panel] > div {
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

    <form method="POST" action="{{ route('admin.pmb.update') }}" enctype="multipart/form-data" class="space-y-10">
        @csrf
        <input type="hidden" name="active_panel" id="activePmbPanelInput" value="">

        <div id="pmb-overview" class="space-y-10">
            <section>
                <h2 class="text-4xl font-extrabold text-primary tracking-tight font-headline">PMB</h2>
            </section>

            <section class="bg-surface-container-lowest rounded-2xl overflow-hidden shadow-[0_8px_30px_rgb(0,0,0,0.04)]">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-surface-container-low/50">
                                <th class="px-8 py-5 text-[11px] font-bold text-slate-400 uppercase tracking-widest">No</th>
                                <th class="px-6 py-5 text-[11px] font-bold text-slate-400 uppercase tracking-widest">Komponen</th>
                                <th class="px-6 py-5 text-[11px] font-bold text-slate-400 uppercase tracking-widest">Deskripsi</th>
                                <th class="px-8 py-5 text-[11px] font-bold text-slate-400 uppercase tracking-widest text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-surface-container">
                            @foreach ($components as $component)
                            <tr class="group hover:bg-surface-container-low/30 transition-colors">
                                <td class="px-8 py-4">
                                    <span class="inline-flex h-8 w-8 items-center justify-center rounded-lg bg-blue-50 text-sm font-bold text-primary">
                                        {{ $loop->iteration }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <p class="font-bold text-blue-900 group-hover:text-primary transition-colors">{{ $component['title'] }}</p>
                                </td>
                                <td class="px-6 py-4">
                                    <p class="max-w-xl text-sm text-on-surface-variant font-medium leading-relaxed line-clamp-2">{{ $component['content'] }}</p>
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
            <details id="pmb-hero-section" data-pmb-panel class="group bg-surface-container-lowest rounded-2xl shadow-sm border border-slate-100 overflow-hidden" open>
                <summary class="list-none p-6 flex items-center justify-between gap-4">
                    <div>
                        <span class="text-xs font-bold text-tertiary uppercase tracking-widest mb-1 block">Component 01</span>
                        <h3 class="text-2xl font-headline font-extrabold text-primary">Hero Halaman</h3>
                    </div>
                    <button type="button" data-pmb-back class="inline-flex items-center gap-2 rounded-xl bg-slate-100 px-4 py-2 text-sm font-bold text-slate-600 hover:bg-slate-200 transition-colors">
                        <span class="material-symbols-outlined text-[18px]">arrow_back</span>
                        Kembali
                    </button>
                </summary>
                <div class="border-t border-slate-100 p-6 lg:p-8 bg-surface-container-low/40 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <input name="hero_badge" type="hidden" value="{{ old('hero_badge', trim(str_replace('2025/2026', '', $pmb?->hero_badge ?? 'Penerimaan Siswa Baru'))) }}">
                    <div class="md:col-span-2">
                        <label class="block">Judul Utama</label>
                        <input name="hero_title" value="{{ old('hero_title', $pmb?->hero_title ?? 'Mulai Masa Depan Gemilang di SMAN Pintar') }}" placeholder="Contoh: Mulai Masa Depan Gemilang di SMAN Pintar">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block">Deskripsi Singkat</label>
                        <textarea name="hero_description" rows="4" placeholder="Tulis kalimat pembuka PMB yang singkat dan jelas.">{{ old('hero_description', str_replace('2025/2026', '', $pmb?->hero_description ?? 'Pendaftaran Peserta Didik Baru telah dibuka. Bergabunglah dengan institusi pendidikan unggulan di Riau.')) }}</textarea>
                    </div>
                    <input name="link_pendaftaran" type="hidden" value="{{ old('link_pendaftaran', $pmb?->link_pendaftaran ?? '') }}">
                    <input name="primary_button_text" type="hidden" value="{{ old('primary_button_text', $pmb?->primary_button_text ?? 'Informasi PMB') }}">
                    <input name="secondary_button_text" type="hidden" value="{{ old('secondary_button_text', $pmb?->secondary_button_text ?? 'Panduan PMB') }}">
                    <input name="hero_card_title" type="hidden" value="">
                    <input name="hero_card_subtitle" type="hidden" value="">
                    <div class="md:col-span-2">
                        <label class="block">Gambar Hero</label>
                        <input name="hero_image" type="file" accept="image/*">
                        <p class="mt-2 text-sm font-medium text-slate-500">Biarkan kosong jika gambar tidak ingin diganti.</p>
                    </div>
                </div>
            </details>

            <details id="pmb-steps-section" data-pmb-panel class="hidden group bg-surface-container-lowest rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
                <summary class="list-none p-6 flex items-center justify-between gap-4">
                    <div><span class="text-xs font-bold text-tertiary uppercase tracking-widest mb-1 block">Component 02</span><h3 class="text-2xl font-headline font-extrabold text-primary">Alur Pendaftaran</h3></div>
                    <button type="button" data-pmb-back class="inline-flex items-center gap-2 rounded-xl bg-slate-100 px-4 py-2 text-sm font-bold text-slate-600 hover:bg-slate-200 transition-colors"><span class="material-symbols-outlined text-[18px]">arrow_back</span>Kembali</button>
                </summary>
                <div class="border-t border-slate-100 p-6 lg:p-8 bg-surface-container-low/40 space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block">Label Kecil</label>
                            <input name="steps_label" value="{{ old('steps_label', $pmb?->steps_label ?? 'Langkah Mudah') }}" placeholder="Contoh: Langkah Mudah">
                        </div>
                        <div>
                            <label class="block">Judul Bagian</label>
                            <input name="steps_title" value="{{ old('steps_title', $pmb?->steps_title ?? 'Alur Pendaftaran') }}" placeholder="Contoh: Alur Pendaftaran">
                        </div>
                    </div>
                    <div>
                        <label class="block">Daftar Alur</label>
                        <textarea name="alur" rows="8" placeholder="Tulis satu tahap per baris. Contoh:&#10;Seleksi Administrasi & Nilai Rapor&#10;Tes Kemampuan Akademik (TPA) & Wawancara Orang Tua&#10;Psikotes, Tes Bahasa Inggris, Baca Tulis Al-Qur'an, Tes Kesehatan, dan Tes Fisik">{{ old('alur', $pmb?->alur ?? '') }}</textarea>
                    </div>
                </div>
            </details>

            <details id="pmb-requirements-section" data-pmb-panel class="hidden group bg-surface-container-lowest rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
                <summary class="list-none p-6 flex items-center justify-between gap-4">
                    <div><span class="text-xs font-bold text-tertiary uppercase tracking-widest mb-1 block">Component 03</span><h3 class="text-2xl font-headline font-extrabold text-primary">Persyaratan & Berkas</h3></div>
                    <button type="button" data-pmb-back class="inline-flex items-center gap-2 rounded-xl bg-slate-100 px-4 py-2 text-sm font-bold text-slate-600 hover:bg-slate-200 transition-colors"><span class="material-symbols-outlined text-[18px]">arrow_back</span>Kembali</button>
                </summary>
                <div class="border-t border-slate-100 p-6 lg:p-8 bg-surface-container-low/40 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block">Persyaratan Umum</label>
                        <textarea name="persyaratan_umum" rows="10" placeholder="Tulis satu persyaratan per baris.">{{ old('persyaratan_umum', $pmb?->persyaratan_umum ?? '') }}</textarea>
                    </div>
                    <div>
                        <label class="block">Berkas Administrasi</label>
                        <textarea name="berkas" rows="10" placeholder="Tulis satu berkas per baris.">{{ old('berkas', $pmb?->berkas ?? '') }}</textarea>
                    </div>
                </div>
            </details>

            <details id="pmb-timeline-section" data-pmb-panel class="hidden group bg-surface-container-lowest rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
                <summary class="list-none p-6 flex items-center justify-between gap-4">
                    <div><span class="text-xs font-bold text-tertiary uppercase tracking-widest mb-1 block">Component 04</span><h3 class="text-2xl font-headline font-extrabold text-primary">Timeline Pendaftaran</h3></div>
                    <button type="button" data-pmb-back class="inline-flex items-center gap-2 rounded-xl bg-slate-100 px-4 py-2 text-sm font-bold text-slate-600 hover:bg-slate-200 transition-colors"><span class="material-symbols-outlined text-[18px]">arrow_back</span>Kembali</button>
                </summary>
                <div class="border-t border-slate-100 p-6 lg:p-8 bg-surface-container-low/40 space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block">Judul Bagian</label>
                            <input name="timeline_title" value="{{ old('timeline_title', $pmb?->timeline_title ?? 'Timeline Pendaftaran') }}" placeholder="Contoh: Timeline Pendaftaran">
                        </div>
                        <div>
                            <label class="block">Deskripsi Singkat</label>
                            <input name="timeline_description" value="{{ old('timeline_description', $pmb?->timeline_description ?? 'Pantau tanggal penting agar tidak terlewatkan.') }}" placeholder="Contoh: Pantau tanggal penting agar tidak terlewatkan.">
                        </div>
                    </div>
                    <div>
                        <label class="block">Daftar Jadwal</label>
                        <textarea name="jadwal" rows="8" placeholder="Tulis format: Kegiatan | Tanggal&#10;Contoh: Pendaftaran Berkas | 1-10 Juni 2026">{{ old('jadwal', $pmb?->jadwal ?? '') }}</textarea>
                    </div>
                </div>
            </details>

            <details id="pmb-faq-section" data-pmb-panel class="hidden group bg-surface-container-lowest rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
                <summary class="list-none p-6 flex items-center justify-between gap-4">
                    <div><span class="text-xs font-bold text-tertiary uppercase tracking-widest mb-1 block">Component 05</span><h3 class="text-2xl font-headline font-extrabold text-primary">FAQ PMB</h3></div>
                    <button type="button" data-pmb-back class="inline-flex items-center gap-2 rounded-xl bg-slate-100 px-4 py-2 text-sm font-bold text-slate-600 hover:bg-slate-200 transition-colors"><span class="material-symbols-outlined text-[18px]">arrow_back</span>Kembali</button>
                </summary>
                <div class="border-t border-slate-100 p-6 lg:p-8 bg-surface-container-low/40 space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block">Judul Bagian</label>
                            <input name="faq_title" value="{{ old('faq_title', $pmb?->faq_title ?? 'Pertanyaan Umum (FAQ)') }}" placeholder="Contoh: Pertanyaan Umum (FAQ)">
                        </div>
                        <div>
                            <label class="block">Deskripsi Singkat</label>
                            <input name="faq_description" value="{{ old('faq_description', $pmb?->faq_description ?? 'Temukan jawaban cepat atas pertanyaan Anda.') }}" placeholder="Contoh: Temukan jawaban cepat atas pertanyaan Anda.">
                        </div>
                    </div>
                    <div>
                        <label class="block">Daftar Pertanyaan</label>
                        <textarea name="faq" rows="8" placeholder="Tulis format: Pertanyaan | Jawaban&#10;Contoh: Kapan pendaftaran dibuka? | Informasi pendaftaran akan diumumkan oleh panitia PMB.">{{ old('faq', $pmb?->faq ?? '') }}</textarea>
                    </div>
                </div>
            </details>

            <details id="pmb-cta-section" data-pmb-panel class="hidden group bg-surface-container-lowest rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
                <summary class="list-none p-6 flex items-center justify-between gap-4">
                    <div><span class="text-xs font-bold text-tertiary uppercase tracking-widest mb-1 block">Component 06</span><h3 class="text-2xl font-headline font-extrabold text-primary">CTA Akhir</h3></div>
                    <button type="button" data-pmb-back class="inline-flex items-center gap-2 rounded-xl bg-slate-100 px-4 py-2 text-sm font-bold text-slate-600 hover:bg-slate-200 transition-colors"><span class="material-symbols-outlined text-[18px]">arrow_back</span>Kembali</button>
                </summary>
                <div class="border-t border-slate-100 p-6 lg:p-8 bg-surface-container-low/40 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label class="block">Judul Ajakan</label>
                        <input name="cta_title" value="{{ old('cta_title', $pmb?->cta_title ?? 'Informasi PMB SMAN Pintar Riau') }}" placeholder="Contoh: Informasi PMB SMAN Pintar Riau">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block">Deskripsi Ajakan</label>
                        <textarea name="cta_description" rows="4" placeholder="Tulis informasi penutup PMB yang ringkas.">{{ old('cta_description', $pmb?->cta_description ?? 'Informasi pendaftaran dapat diperoleh melalui panitia PMB SMAN Pintar Riau.') }}</textarea>
                    </div>
                    <div>
                        <label class="block">Teks Tombol</label>
                        <input name="cta_secondary_text" value="{{ old('cta_secondary_text', $pmb?->cta_secondary_text ?? 'Hubungi Panitia') }}" placeholder="Contoh: Hubungi Panitia">
                    </div>
                    <div>
                        <label class="block">Link Tombol</label>
                        <input name="cta_secondary_link" value="{{ old('cta_secondary_link', $pmb?->cta_secondary_link ?? route('pmb')) }}" placeholder="Contoh: https://wa.me/6281234567890">
                    </div>
                    <input name="cta_primary_text" type="hidden" value="{{ old('cta_primary_text', $pmb?->cta_primary_text ?? 'Informasi PMB') }}">
                </div>
            </details>

            <div class="bg-surface-container-lowest rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] px-8 py-6">
                <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end sm:items-center">
                    <button type="button" data-pmb-back class="btn-cancel">Batal</button>
                    <button type="submit" class="bg-primary text-white px-8 py-3 rounded-xl font-bold shadow-lg hover:scale-105 transition-all">Simpan</button>
                </div>
            </div>
        </section>
    </form>
</div>

<script>
const pmbOverview = document.getElementById('pmb-overview');
const pmbEditors = document.getElementById('pmb-editors');
const pmbPanels = document.querySelectorAll('[data-pmb-panel]');
const activePmbPanelInput = document.getElementById('activePmbPanelInput');

function showPmbOverview() {
    pmbEditors.classList.add('hidden');
    pmbOverview.classList.remove('hidden');
    if (activePmbPanelInput) {
        activePmbPanelInput.value = '';
    }
    pmbPanels.forEach((panel) => panel.classList.add('hidden'));
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

function showPmbEditor(panelId) {
    const target = document.getElementById(panelId);

    if (!target) {
        return;
    }

    pmbOverview.classList.add('hidden');
    pmbEditors.classList.remove('hidden');
    if (activePmbPanelInput) {
        activePmbPanelInput.value = panelId;
    }
    pmbPanels.forEach((panel) => panel.classList.add('hidden'));
    target.classList.remove('hidden');
    target.open = true;
    window.scrollTo({ top: 0, behavior: 'smooth' });
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
</script>
@endsection
