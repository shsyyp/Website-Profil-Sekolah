@extends('layouts.admin')

@section('title', 'Manajemen PMB | Admin SMAN Pintar')

@section('content')
@php
    $defaultTestimonials = [
        ['name' => 'Aura Nadira', 'meta' => 'Alumni Jalur Prestasi 2022', 'quote' => 'Proses seleksi PMB SMAN Pintar sangat transparan dan kompetitif. Saya merasa tertantang sejak ujian tahap pertama.', 'image' => '', 'featured' => false],
        ['name' => 'Dimas Pratama', 'meta' => 'Siswa Kelas XII - Jalur Tes', 'quote' => 'SMAN Pintar bukan sekadar sekolah, tapi rumah kedua. Ujian seleksinya memang berat, tapi sebanding dengan kualitas fasilitas.', 'image' => '', 'featured' => true],
        ['name' => 'Siti Aminah', 'meta' => 'Siswa Kelas XI - Jalur Tahfidz', 'quote' => 'Sangat senang ada jalur khusus Tahfidz. Proses verifikasinya sangat teliti.', 'image' => '', 'featured' => false],
    ];
    $testimonials = old('testimonials', $pmb->testimonials ?? $defaultTestimonials);
    $testimonials = count($testimonials) ? $testimonials : $defaultTestimonials;

    $components = [
        ['id' => 'pmb-hero-section', 'icon' => 'rocket_launch', 'title' => 'Hero & Link PMB', 'meta' => $pmb->hero_badge ?? 'Penerimaan Siswa Baru 2025/2026', 'content' => $pmb->hero_title ?? 'Mulai Masa Depan Gemilang di SMAN Pintar'],
        ['id' => 'pmb-steps-section', 'icon' => 'route', 'title' => 'Alur Pendaftaran', 'meta' => $pmb->steps_label ?? 'Langkah Mudah', 'content' => $pmb->steps_title ?? 'Alur Pendaftaran'],
        ['id' => 'pmb-requirements-section', 'icon' => 'fact_check', 'title' => 'Persyaratan & Berkas', 'meta' => '2 daftar informasi', 'content' => 'Persyaratan Umum, Berkas Administrasi'],
        ['id' => 'pmb-timeline-section', 'icon' => 'event_note', 'title' => 'Timeline Pendaftaran', 'meta' => 'Jadwal kegiatan PMB', 'content' => $pmb->timeline_title ?? 'Timeline Pendaftaran'],
        ['id' => 'pmb-faq-section', 'icon' => 'quiz', 'title' => 'FAQ PMB', 'meta' => 'Pertanyaan umum', 'content' => $pmb->faq_title ?? 'Pertanyaan Umum (FAQ)'],
        ['id' => 'pmb-testimonials-section', 'icon' => 'reviews', 'title' => 'Kisah Sukses PMB', 'meta' => count($testimonials) . ' testimoni', 'content' => $pmb->testimonials_title ?? 'Kisah Sukses PMB'],
        ['id' => 'pmb-cta-section', 'icon' => 'campaign', 'title' => 'CTA Akhir', 'meta' => $pmb->cta_primary_text ?? 'Daftar Sekarang', 'content' => $pmb->cta_title ?? 'Wujudkan Impian Anda Bersama SMAN Pintar Riau'],
    ];
@endphp

<div class="max-w-6xl mx-auto space-y-10">
    @if(session('success'))
    <div class="bg-emerald-50 text-emerald-600 p-4 rounded-xl font-bold flex items-center gap-2">
        <span class="material-symbols-outlined">check_circle</span>
        {{ session('success') }}
    </div>
    @endif

    <form method="POST" action="{{ route('admin.pmb.update') }}" enctype="multipart/form-data" class="space-y-10">
        @csrf

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
                                <th class="px-6 py-5 text-[11px] font-bold text-slate-400 uppercase tracking-widest">Status</th>
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
                                <td class="px-6 py-4">
                                    <span class="flex items-center gap-1.5 text-xs font-bold text-emerald-600 bg-emerald-50 px-3 py-1 rounded-full w-fit">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Aktif
                                    </span>
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

        <section id="pmb-editors" class="hidden max-w-4xl space-y-4">
            <details id="pmb-hero-section" data-pmb-panel class="group bg-surface-container-lowest rounded-2xl shadow-sm border border-slate-100 overflow-hidden" open>
                <summary class="list-none p-6 flex items-center justify-between gap-4">
                    <div>
                        <span class="text-xs font-bold text-tertiary uppercase tracking-widest mb-1 block">Component 01</span>
                        <h3 class="text-2xl font-headline font-extrabold text-primary">Hero & Link PMB</h3>
                    </div>
                    <button type="button" data-pmb-back class="inline-flex items-center gap-2 rounded-xl bg-slate-100 px-4 py-2 text-sm font-bold text-slate-600 hover:bg-slate-200 transition-colors">
                        <span class="material-symbols-outlined text-[18px]">arrow_back</span>
                        Kembali
                    </button>
                </summary>
                <div class="border-t border-slate-100 p-6 lg:p-8 bg-surface-container-low/40 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <input name="hero_badge" class="bg-white border-none rounded-xl px-4 py-3 font-medium" value="{{ old('hero_badge', $pmb->hero_badge ?? 'Penerimaan Siswa Baru 2025/2026') }}" placeholder="Badge hero">
                    <input name="hero_title" class="bg-white border-none rounded-xl px-4 py-3 font-bold" value="{{ old('hero_title', $pmb->hero_title ?? 'Mulai Masa Depan Gemilang di SMAN Pintar') }}" placeholder="Judul hero">
                    <textarea name="hero_description" class="bg-white border-none rounded-xl px-4 py-3 md:col-span-2" rows="3" placeholder="Deskripsi hero">{{ old('hero_description', $pmb->hero_description ?? 'Pendaftaran Peserta Didik Baru Tahun Ajaran 2025/2026 Telah Dibuka. Bergabunglah dengan institusi pendidikan unggulan di Riau.') }}</textarea>
                    <input name="link_pendaftaran" class="bg-white border-none rounded-xl px-4 py-3" value="{{ old('link_pendaftaran', $pmb->link_pendaftaran ?? '') }}" placeholder="https://ppdb.smanpintar.sch.id">
                    <input name="primary_button_text" class="bg-white border-none rounded-xl px-4 py-3" value="{{ old('primary_button_text', $pmb->primary_button_text ?? 'Daftar Sekarang') }}" placeholder="Tombol utama">
                    <input name="secondary_button_text" class="bg-white border-none rounded-xl px-4 py-3" value="{{ old('secondary_button_text', $pmb->secondary_button_text ?? 'Panduan PMB') }}" placeholder="Tombol kedua">
                    <input name="hero_card_title" class="bg-white border-none rounded-xl px-4 py-3" value="{{ old('hero_card_title', $pmb->hero_card_title ?? 'Akreditasi A') }}" placeholder="Judul kartu gambar">
                    <input name="hero_card_subtitle" class="bg-white border-none rounded-xl px-4 py-3" value="{{ old('hero_card_subtitle', $pmb->hero_card_subtitle ?? 'Standar Internasional') }}" placeholder="Subjudul kartu gambar">
                    <div class="md:col-span-2">
                        <label class="block text-sm font-bold text-slate-700 mb-2">Gambar Hero</label>
                        <input name="hero_image" type="file" accept="image/*" class="w-full bg-white border-none rounded-xl px-4 py-3">
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
                        <input name="steps_label" class="bg-white border-none rounded-xl px-4 py-3" value="{{ old('steps_label', $pmb->steps_label ?? 'Langkah Mudah') }}" placeholder="Label alur">
                        <input name="steps_title" class="bg-white border-none rounded-xl px-4 py-3 font-bold" value="{{ old('steps_title', $pmb->steps_title ?? 'Alur Pendaftaran') }}" placeholder="Judul alur">
                    </div>
                    <textarea name="alur" rows="8" class="w-full bg-white border-none rounded-xl p-5 focus:ring-2 focus:ring-primary text-on-surface font-medium" placeholder="Satu baris satu tahap, atau JSON">{{ old('alur', $pmb->alur ?? '') }}</textarea>
                </div>
            </details>

            <details id="pmb-requirements-section" data-pmb-panel class="hidden group bg-surface-container-lowest rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
                <summary class="list-none p-6 flex items-center justify-between gap-4">
                    <div><span class="text-xs font-bold text-tertiary uppercase tracking-widest mb-1 block">Component 03</span><h3 class="text-2xl font-headline font-extrabold text-primary">Persyaratan & Berkas</h3></div>
                    <button type="button" data-pmb-back class="inline-flex items-center gap-2 rounded-xl bg-slate-100 px-4 py-2 text-sm font-bold text-slate-600 hover:bg-slate-200 transition-colors"><span class="material-symbols-outlined text-[18px]">arrow_back</span>Kembali</button>
                </summary>
                <div class="border-t border-slate-100 p-6 lg:p-8 bg-surface-container-low/40 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Persyaratan Umum</label>
                        <textarea name="persyaratan_umum" rows="8" class="w-full bg-white border-none rounded-xl p-5 focus:ring-2 focus:ring-primary text-on-surface font-medium">{{ old('persyaratan_umum', $pmb->persyaratan_umum ?? '') }}</textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Berkas Administrasi</label>
                        <textarea name="berkas" rows="8" class="w-full bg-white border-none rounded-xl p-5 focus:ring-2 focus:ring-primary text-on-surface font-medium">{{ old('berkas', $pmb->berkas ?? '') }}</textarea>
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
                        <input name="timeline_title" class="bg-white border-none rounded-xl px-4 py-3 font-bold" value="{{ old('timeline_title', $pmb->timeline_title ?? 'Timeline Pendaftaran') }}" placeholder="Judul timeline">
                        <input name="timeline_description" class="bg-white border-none rounded-xl px-4 py-3" value="{{ old('timeline_description', $pmb->timeline_description ?? 'Pantau tanggal penting agar tidak terlewatkan.') }}" placeholder="Deskripsi timeline">
                    </div>
                    <textarea name="jadwal" rows="8" class="w-full bg-white border-none rounded-xl p-5 focus:ring-2 focus:ring-primary text-on-surface font-medium" placeholder="Kegiatan | Tanggal | Keterangan">{{ old('jadwal', $pmb->jadwal ?? '') }}</textarea>
                </div>
            </details>

            <details id="pmb-faq-section" data-pmb-panel class="hidden group bg-surface-container-lowest rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
                <summary class="list-none p-6 flex items-center justify-between gap-4">
                    <div><span class="text-xs font-bold text-tertiary uppercase tracking-widest mb-1 block">Component 05</span><h3 class="text-2xl font-headline font-extrabold text-primary">FAQ PMB</h3></div>
                    <button type="button" data-pmb-back class="inline-flex items-center gap-2 rounded-xl bg-slate-100 px-4 py-2 text-sm font-bold text-slate-600 hover:bg-slate-200 transition-colors"><span class="material-symbols-outlined text-[18px]">arrow_back</span>Kembali</button>
                </summary>
                <div class="border-t border-slate-100 p-6 lg:p-8 bg-surface-container-low/40 space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <input name="faq_title" class="bg-white border-none rounded-xl px-4 py-3 font-bold" value="{{ old('faq_title', $pmb->faq_title ?? 'Pertanyaan Umum (FAQ)') }}" placeholder="Judul FAQ">
                        <input name="faq_description" class="bg-white border-none rounded-xl px-4 py-3" value="{{ old('faq_description', $pmb->faq_description ?? 'Temukan jawaban cepat atas pertanyaan Anda.') }}" placeholder="Deskripsi FAQ">
                    </div>
                    <textarea name="faq" rows="8" class="w-full bg-white border-none rounded-xl p-5 focus:ring-2 focus:ring-primary text-on-surface font-medium" placeholder="Pertanyaan | Jawaban">{{ old('faq', $pmb->faq ?? '') }}</textarea>
                </div>
            </details>

            <details id="pmb-testimonials-section" data-pmb-panel class="hidden group bg-surface-container-lowest rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
                <summary class="list-none p-6 flex items-center justify-between gap-4">
                    <div><span class="text-xs font-bold text-tertiary uppercase tracking-widest mb-1 block">Component 06</span><h3 class="text-2xl font-headline font-extrabold text-primary">Kisah Sukses PMB</h3></div>
                    <button type="button" data-pmb-back class="inline-flex items-center gap-2 rounded-xl bg-slate-100 px-4 py-2 text-sm font-bold text-slate-600 hover:bg-slate-200 transition-colors"><span class="material-symbols-outlined text-[18px]">arrow_back</span>Kembali</button>
                </summary>
                <div class="border-t border-slate-100 p-6 lg:p-8 bg-surface-container-low/40 space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <input name="testimonials_title" class="bg-white border-none rounded-xl px-4 py-3 font-bold" value="{{ old('testimonials_title', $pmb->testimonials_title ?? 'Kisah Sukses PMB') }}" placeholder="Judul testimoni">
                        <input name="testimonials_description" class="bg-white border-none rounded-xl px-4 py-3" value="{{ old('testimonials_description', $pmb->testimonials_description ?? 'Inspirasi dari mereka yang telah bergabung dengan kami.') }}" placeholder="Deskripsi testimoni">
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        @for ($i = 0; $i < 3; $i++)
                        <div class="bg-white p-5 rounded-xl space-y-3">
                            <label class="block text-sm font-bold text-slate-700">Testimoni {{ $i + 1 }}</label>
                            <input name="testimonials[{{ $i }}][name]" class="w-full bg-surface-container-low border-none rounded-xl px-4 py-3" value="{{ data_get($testimonials, $i.'.name') }}" placeholder="Nama">
                            <input name="testimonials[{{ $i }}][meta]" class="w-full bg-surface-container-low border-none rounded-xl px-4 py-3" value="{{ data_get($testimonials, $i.'.meta') }}" placeholder="Keterangan">
                            <input name="testimonials[{{ $i }}][image]" class="w-full bg-surface-container-low border-none rounded-xl px-4 py-3" value="{{ data_get($testimonials, $i.'.image') }}" placeholder="URL gambar">
                            <textarea name="testimonials[{{ $i }}][quote]" rows="4" class="w-full bg-surface-container-low border-none rounded-xl px-4 py-3" placeholder="Isi testimoni">{{ data_get($testimonials, $i.'.quote') }}</textarea>
                            <label class="flex items-center gap-2 text-sm font-bold text-slate-600">
                                <input name="testimonials[{{ $i }}][featured]" value="1" type="checkbox" class="rounded" {{ data_get($testimonials, $i.'.featured') ? 'checked' : '' }}>
                                Highlight
                            </label>
                        </div>
                        @endfor
                    </div>
                </div>
            </details>

            <details id="pmb-cta-section" data-pmb-panel class="hidden group bg-surface-container-lowest rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
                <summary class="list-none p-6 flex items-center justify-between gap-4">
                    <div><span class="text-xs font-bold text-tertiary uppercase tracking-widest mb-1 block">Component 07</span><h3 class="text-2xl font-headline font-extrabold text-primary">CTA Akhir</h3></div>
                    <button type="button" data-pmb-back class="inline-flex items-center gap-2 rounded-xl bg-slate-100 px-4 py-2 text-sm font-bold text-slate-600 hover:bg-slate-200 transition-colors"><span class="material-symbols-outlined text-[18px]">arrow_back</span>Kembali</button>
                </summary>
                <div class="border-t border-slate-100 p-6 lg:p-8 bg-surface-container-low/40 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <input name="cta_title" class="bg-white border-none rounded-xl px-4 py-3 font-bold" value="{{ old('cta_title', $pmb->cta_title ?? 'Wujudkan Impian Anda Bersama SMAN Pintar Riau') }}" placeholder="Judul CTA">
                    <input name="cta_primary_text" class="bg-white border-none rounded-xl px-4 py-3" value="{{ old('cta_primary_text', $pmb->cta_primary_text ?? 'Daftar Sekarang') }}" placeholder="Tombol utama">
                    <textarea name="cta_description" class="bg-white border-none rounded-xl px-4 py-3 md:col-span-2" rows="3" placeholder="Deskripsi CTA">{{ old('cta_description', $pmb->cta_description ?? 'Jangan lewatkan kesempatan untuk bergabung dengan komunitas pelajar terbaik. Pendaftaran akan ditutup dalam beberapa hari ke depan.') }}</textarea>
                    <input name="cta_secondary_text" class="bg-white border-none rounded-xl px-4 py-3" value="{{ old('cta_secondary_text', $pmb->cta_secondary_text ?? 'Hubungi Panitia') }}" placeholder="Tombol kedua">
                    <input name="cta_secondary_link" class="bg-white border-none rounded-xl px-4 py-3" value="{{ old('cta_secondary_link', $pmb->cta_secondary_link ?? route('pmb')) }}" placeholder="Link tombol kedua">
                </div>
            </details>

            <div class="bg-surface-container-lowest rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] px-8 py-6">
                <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end sm:items-center">
                    <button type="button" data-pmb-back class="px-6 py-3 rounded-xl font-bold text-slate-500 hover:bg-slate-100 transition-colors">Batal</button>
                    <button type="submit" class="bg-primary text-on-primary px-8 py-3 rounded-xl font-bold shadow-lg hover:scale-105 transition-all">Simpan PMB</button>
                </div>
            </div>
        </section>
    </form>
</div>

<script>
const pmbOverview = document.getElementById('pmb-overview');
const pmbEditors = document.getElementById('pmb-editors');
const pmbPanels = document.querySelectorAll('[data-pmb-panel]');

function showPmbOverview() {
    pmbEditors.classList.add('hidden');
    pmbOverview.classList.remove('hidden');
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
</script>
@endsection
