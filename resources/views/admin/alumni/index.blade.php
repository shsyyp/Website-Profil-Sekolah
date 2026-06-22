@extends('layouts.admin')

@section('title', 'Alumni | Admin SMAN Pintar')

@section('content')
@php
$testimonialAlumniIds = collect(old('testimonial_alumni_ids', $settings->testimonial_alumni_ids ?? []))
->map(fn ($id) => (int) $id)
->filter()
->take(5)
->values();
$pageComponents = [
['id' => 'alumni-map-section', 'icon' => 'public', 'title' => 'Sebaran Alumni', 'content' => 'Mengatur judul dan
deskripsi peta persebaran alumni'],
['id' => 'alumni-testimonial-section', 'icon' => 'format_quote', 'title' => 'Testimoni Alumni', 'content' => 'Mengatur
alumni yang ditampilkan pada bagian testimoni'],
['id' => 'alumni-cta-section', 'icon' => 'campaign', 'title' => 'CTA Alumni', 'content' => 'Mengatur banner ajakan
bergabung dan tombol aksi alumni'],
['id' => 'alumni-management-section', 'icon' => 'manage_accounts', 'title' => 'Kelola Alumni', 'content' => 'Mengelola
data alumni yang ditampilkan pada website', 'type' => 'management'],
];
@endphp

<style>
#alumni-page-editors {
    width: 100%;
}

#alumni-page-editors [data-alumni-page-panel] {
    background: transparent;
    border: 0;
    box-shadow: none;
    overflow: visible;
}

#alumni-page-editors [data-alumni-page-panel]>summary {
    align-items: flex-start;
    cursor: default;
    list-style: none;
    margin-bottom: 1.75rem;
    padding: 0;
}

#alumni-page-editors [data-alumni-page-panel]>summary::-webkit-details-marker {
    display: none;
}

#alumni-page-editors [data-alumni-page-panel]>summary>div:first-child>span {
    display: none;
}

#alumni-page-editors [data-alumni-page-panel]>summary h3 {
    color: rgb(0 66 141);
    font-size: clamp(2.25rem, 4vw, 3rem);
    font-weight: 800;
    letter-spacing: 0;
    line-height: 1.08;
}

#alumni-page-editors [data-alumni-page-panel]>summary button {
    border-radius: 0.9rem;
    background: rgb(241 245 249);
    color: rgb(51 65 85);
    font-size: 1rem;
    padding: 0.85rem 1.35rem;
}

#alumni-page-editors [data-alumni-page-panel]>div {
    background: #fff;
    border-top: 0;
    border-radius: 1.25rem;
    box-shadow: 0 10px 32px rgb(15 23 42 / 0.04);
    padding: clamp(1.5rem, 3vw, 2.5rem);
}

#alumni-page-editors label {
    color: rgb(113 83 0);
    display: block;
    font-size: 0.78rem;
    font-weight: 800;
    letter-spacing: 0;
    margin-bottom: 0.75rem;
    text-transform: uppercase;
}

#alumni-page-editors input:not([type="hidden"]),
#alumni-page-editors textarea,
#alumni-page-editors select {
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

#alumni-page-editors textarea {
    line-height: 1.65;
    min-height: 9rem;
}

#alumni-page-editors input:focus,
#alumni-page-editors textarea:focus {
    outline: 2px solid rgb(0 66 141 / 0.18);
    outline-offset: 2px;
    box-shadow: none;
}
</style>

{{-- Load CSS Leaflet --}}
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

@if(session('success'))
<div class="bg-emerald-50 text-emerald-600 p-4 rounded-xl mb-6 font-bold flex items-center gap-2">
    <span class="material-symbols-outlined">check_circle</span>
    {{ session('success') }}
</div>
@endif

{{-- Pengaturan Tampilan Halaman Alumni --}}
<form action="{{ route('admin.alumni.page-setting.update') }}" method="POST" enctype="multipart/form-data"
    class="mb-12 space-y-8">
    @csrf
    <input type="hidden" name="active_panel" id="activeAlumniPanelInput" value="">

    <div id="alumni-page-overview" class="space-y-8">
        <section>
            <h2 class="text-4xl font-extrabold text-primary tracking-tight font-headline">Alumni</h2>
        </section>

        <section class="bg-surface-container-lowest rounded-2xl overflow-hidden shadow-[0_8px_30px_rgb(0,0,0,0.04)]">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-surface-container-low/50">
                            <th class="px-8 py-5 text-[11px] font-bold text-slate-400 uppercase tracking-widest">No</th>
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
                        @foreach ($pageComponents as $component)
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
                                @if(($component['type'] ?? 'editor') === 'management')
                                <a href="#{{ $component['id'] }}" data-alumni-management-target="{{ $component['id'] }}"
                                    class="inline-flex w-9 h-9 items-center justify-center rounded-xl bg-slate-100 text-slate-500 hover:bg-amber-100 hover:text-amber-600 transition-all">
                                    <span class="material-symbols-outlined text-[20px]">edit</span>
                                </a>
                                @else
                                <a href="#{{ $component['id'] }}" data-alumni-page-edit-target="{{ $component['id'] }}"
                                    class="inline-flex w-9 h-9 items-center justify-center rounded-xl bg-slate-100 text-slate-500 hover:bg-amber-100 hover:text-amber-600 transition-all">
                                    <span class="material-symbols-outlined text-[20px]">edit</span>
                                </a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>
    </div>

    <section id="alumni-page-editors" class="hidden space-y-5">
        <details id="alumni-map-section" data-alumni-page-panel
            class="group bg-surface-container-lowest rounded-2xl shadow-sm border border-slate-100 overflow-hidden"
            open>
            <summary class="list-none p-6 flex items-center justify-between gap-4">
                <div><span class="text-xs font-bold text-tertiary uppercase tracking-widest mb-1 block">Component
                        01</span>
                    <h3 class="text-2xl font-headline font-extrabold text-primary">Sebaran Alumni</h3>
                </div>
                <button type="button" data-alumni-page-back
                    class="inline-flex items-center gap-2 rounded-xl bg-slate-100 px-4 py-2 text-sm font-bold text-slate-600 hover:bg-slate-200 transition-colors"><span
                        class="material-symbols-outlined text-[18px]">arrow_back</span>Kembali</button>
            </summary>
            <div
                class="border-t border-slate-100 p-6 lg:p-8 bg-surface-container-low/40 grid grid-cols-1 md:grid-cols-2 gap-6">
                <input name="map_label" type="hidden"
                    value="{{ old('map_label', $settings->map_label ?? 'Sebaran Alumni') }}">
                <div class="md:col-span-2">
                    <label>Judul Bagian</label>
                    <input name="map_title"
                        value="{{ old('map_title', $settings->map_title ?? 'Sebaran Alumni Global') }}"
                        placeholder="Contoh: Sebaran Alumni Global">
                </div>
                <div class="md:col-span-2">
                    <label>Deskripsi Singkat</label>
                    <textarea name="map_description" rows="4"
                        placeholder="Tuliskan keterangan singkat tentang sebaran alumni.">{{ old('map_description', $settings->map_description ?? 'Menampilkan persebaran alumni SMAN Pintar yang sedang menempuh pendidikan maupun berkarier di berbagai daerah di Indonesia.') }}</textarea>
                </div>
            </div>
        </details>

        <details id="alumni-testimonial-section" data-alumni-page-panel
            class="hidden group bg-surface-container-lowest rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            <summary class="list-none p-6 flex items-center justify-between gap-4">
                <div><span class="text-xs font-bold text-tertiary uppercase tracking-widest mb-1 block">Component
                        02</span>
                    <h3 class="text-2xl font-headline font-extrabold text-primary">Testimoni Alumni</h3>
                </div>
                <button type="button" data-alumni-page-back
                    class="inline-flex items-center gap-2 rounded-xl bg-slate-100 px-4 py-2 text-sm font-bold text-slate-600 hover:bg-slate-200 transition-colors"><span
                        class="material-symbols-outlined text-[18px]">arrow_back</span>Kembali</button>
            </summary>
            <div class="border-t border-slate-100 p-6 lg:p-8 bg-surface-container-low/40 space-y-6">
                <div>
                    <h4 class="text-xl font-extrabold text-primary font-headline mb-6">Pilihan Alumni</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                        @for($slot = 0; $slot < 5; $slot++) <div>
                            <label>Testimoni Alumni {{ $slot + 1 }}</label>
                            <select name="testimonial_alumni_ids[]">
                                <option value="">Tidak ditampilkan</option>
                                @foreach($allAlumni as $item)
                                <option value="{{ $item->id }}" @selected($testimonialAlumniIds->get($slot) ===
                                    $item->id)>
                                    {{ $item->nama }} - {{ $item->tahun_lulus }}
                                </option>
                                @endforeach
                            </select>
                    </div>
                    @endfor
                </div>
            </div>
            </div>
        </details>

        <details id="alumni-cta-section" data-alumni-page-panel
            class="hidden group bg-surface-container-lowest rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            <summary class="list-none p-6 flex items-center justify-between gap-4">
                <div><span class="text-xs font-bold text-tertiary uppercase tracking-widest mb-1 block">Component
                        03</span>
                    <h3 class="text-2xl font-headline font-extrabold text-primary">CTA Alumni</h3>
                </div>
                <button type="button" data-alumni-page-back
                    class="inline-flex items-center gap-2 rounded-xl bg-slate-100 px-4 py-2 text-sm font-bold text-slate-600 hover:bg-slate-200 transition-colors"><span
                        class="material-symbols-outlined text-[18px]">arrow_back</span>Kembali</button>
            </summary>
            <div
                class="border-t border-slate-100 p-6 lg:p-8 bg-surface-container-low/40 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="md:col-span-2">
                    <label>Judul Banner</label>
                    <input name="cta_title"
                        value="{{ old('cta_title', $settings->cta_title ?? 'Jadilah Bagian dari Alumni Hebat Kami') }}"
                        placeholder="Contoh: Jadilah Bagian dari Alumni Hebat Kami">
                </div>
                <div class="md:col-span-2">
                    <label>Deskripsi Banner</label>
                    <textarea name="cta_description" rows="4"
                        placeholder="Tuliskan ajakan singkat untuk calon siswa atau alumni.">{{ old('cta_description', $settings->cta_description ?? 'Lanjutkan legacy keunggulan ini. Apakah Anda calon siswa yang ambisius atau alumni yang ingin kembali berkontribusi?') }}</textarea>
                </div>
                <div>
                    <label>Teks Tombol</label>
                    <input name="cta_secondary_text"
                        value="{{ old('cta_secondary_text', $settings->cta_secondary_text ?? 'Gabung Alumni') }}"
                        placeholder="Contoh: Gabung Alumni">
                </div>
                <div>
                    <label>Tautan Tombol</label>
                    <input name="cta_secondary_link"
                        value="{{ old('cta_secondary_link', $settings->cta_secondary_link ?? '#') }}"
                        placeholder="Contoh: https://wa.me/6281234567890">
                </div>
                <input name="grid_button_text" type="hidden"
                    value="{{ old('grid_button_text', $settings->grid_button_text ?? 'Lihat Semua Direktori Alumni') }}">
                <input name="cta_primary_text" type="hidden" value="">
                <input name="cta_primary_link" type="hidden" value="">
            </div>
        </details>

        <div class="bg-surface-container-lowest rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] px-8 py-6">
            <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end sm:items-center">
                <button type="button" data-alumni-page-back class="btn-cancel">Batal</button>
                <button type="submit"
                    class="bg-primary text-white px-8 py-3 rounded-xl font-bold shadow-lg hover:scale-105 transition-all">Simpan</button>
            </div>
        </div>
    </section>
</form>

<section id="alumni-management-section" class="hidden space-y-8">
    <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
        <h2 class="text-4xl font-extrabold text-primary tracking-tight font-headline">Kelola Alumni</h2>
        <div class="flex flex-col-reverse gap-3 sm:flex-row sm:items-center">
            <button type="button" data-alumni-management-back
                class="inline-flex items-center justify-center gap-2 rounded-xl bg-slate-100 px-6 py-3 font-bold text-slate-600 hover:bg-slate-200 transition-colors">
                <span class="material-symbols-outlined text-[18px]">arrow_back</span>
                Kembali
            </button>
            <a href="{{ route('alumni.create') }}"
                class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-gradient-to-r from-primary to-primary-container text-white rounded-xl font-bold shadow-xl shadow-primary/10 hover:scale-[1.02] active:scale-95 transition-all">
                <span class="material-symbols-outlined">add</span>
                Tambah Alumni
            </a>
        </div>
    </div>

    <div class="bg-surface-container-lowest rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] overflow-hidden">
        <div class="p-8 border-b border-surface-container-high/30">
            <h3 class="font-headline text-2xl font-extrabold text-primary">Peta Persebaran Alumni</h3>
        </div>
        <div class="relative bg-[#f6f6f6] p-8 flex flex-col gap-5">
            <div>
                <p class="text-xs text-outline mb-2">Lokasi terdaftar saat ini:</p>
                <div class="flex flex-wrap gap-2">
                    @foreach($lokasi_sebaran as $lok)
                    <span
                        class="px-3 py-1 bg-white border border-outline-variant/30 rounded-full text-xs font-bold text-primary">{{ $lok->lokasi }}</span>
                    @endforeach
                </div>
            </div>

            {{-- Container Map Leaflet --}}
            <div id="mapAlumni" class="w-full h-[420px] rounded-xl border border-outline-variant/30"
                style="z-index: 10;"></div>
        </div>
    </div>

    <div class="bg-surface-container-lowest rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr
                        class="bg-surface-container-low/50 text-on-surface-variant text-[11px] uppercase tracking-wider font-bold">
                        <th class="px-8 py-5">No</th>
                        <th class="px-6 py-5">Alumni</th>
                        <th class="px-6 py-5">Profesi / Instansi</th>
                        <th class="px-6 py-5">Tahun Lulus</th>
                        <th class="px-6 py-5">Lokasi Saat Ini</th>
                        <th class="px-8 py-5 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-surface-container-high/50 text-sm">
                    @forelse ($alumni as $item)
                    <tr class="hover:bg-surface-container-low/30 transition-colors">
                        <td class="px-8 py-5">
                            <span
                                class="inline-flex h-8 w-8 items-center justify-center rounded-lg bg-blue-50 text-sm font-bold text-primary">
                                {{ $loop->iteration + ($alumni->currentPage() - 1) * $alumni->perPage() }}
                            </span>
                        </td>
                        <td class="px-6 py-5">
                            <span class="font-bold text-primary">{{ $item->nama }}</span>
                        </td>
                        <td class="px-6 py-5">{{ $item->profesi }} <br> <span
                                class="text-xs text-outline">{{ $item->instansi }}</span></td>
                        <td class="px-6 py-5">
                            <span
                                class="px-3 py-1 bg-secondary-container text-on-secondary-container rounded-full text-[10px] font-bold">LULUS
                                {{ $item->tahun_lulus }}</span>
                        </td>
                        <td class="px-6 py-5">
                            <div class="flex items-center gap-2">
                                <span class="material-symbols-outlined text-tertiary text-lg">location_on</span>
                                {{ $item->lokasi }}
                            </div>
                        </td>
                        <td class="px-8 py-5">
                            <div class="flex justify-end gap-2">
                                <a href="{{ route('alumni.edit', $item->id) }}"
                                    class="inline-flex h-11 w-11 items-center justify-center rounded-xl bg-slate-100 text-slate-500 hover:bg-amber-100 hover:text-amber-600 transition-all">
                                    <span class="material-symbols-outlined text-[18px]">edit</span>
                                </a>
                                <form action="{{ route('alumni.destroy', $item->id) }}" method="POST"
                                    onsubmit="return confirm('Hapus data alumni ini?');">
                                    @csrf @method('DELETE')
                                    <button type="submit"
                                        class="inline-flex h-11 w-11 items-center justify-center rounded-xl bg-red-50 text-error hover:bg-red-100 transition-all">
                                        <span class="material-symbols-outlined text-[18px]">delete</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-8 text-center text-slate-400">Belum ada data alumni.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-6 bg-surface-container-low/50">
            {{ $alumni->links() }}
        </div>
    </div>
</section>

{{-- Load JS Leaflet & Init Map --}}
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
const alumniPageOverview = document.getElementById('alumni-page-overview');
const alumniPageEditors = document.getElementById('alumni-page-editors');
const alumniManagementSection = document.getElementById('alumni-management-section');
const alumniPagePanels = document.querySelectorAll('[data-alumni-page-panel]');
const activeAlumniPanelInput = document.getElementById('activeAlumniPanelInput');
let alumniMap = null;

function showAlumniPageOverview() {
    alumniPageEditors.classList.add('hidden');
    alumniManagementSection.classList.add('hidden');
    alumniPageOverview.classList.remove('hidden');
    alumniPagePanels.forEach((panel) => panel.classList.add('hidden'));
    if (activeAlumniPanelInput) {
        activeAlumniPanelInput.value = '';
    }
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
}

function showAlumniPageEditor(panelId) {
    const target = document.getElementById(panelId);

    if (!target) {
        return;
    }

    alumniPageOverview.classList.add('hidden');
    alumniManagementSection.classList.add('hidden');
    alumniPageEditors.classList.remove('hidden');
    alumniPagePanels.forEach((panel) => panel.classList.add('hidden'));
    target.classList.remove('hidden');
    target.open = true;
    if (activeAlumniPanelInput) {
        activeAlumniPanelInput.value = panelId;
    }
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
}

function showAlumniManagement() {
    alumniPageOverview.classList.add('hidden');
    alumniPageEditors.classList.add('hidden');
    alumniPagePanels.forEach((panel) => panel.classList.add('hidden'));
    alumniManagementSection.classList.remove('hidden');
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });

    setTimeout(() => {
        if (alumniMap) {
            alumniMap.invalidateSize();
        }
    }, 250);
}

document.querySelectorAll('[data-alumni-page-edit-target]').forEach((link) => {
    link.addEventListener('click', (event) => {
        event.preventDefault();
        showAlumniPageEditor(link.dataset.alumniPageEditTarget);
    });
});

document.querySelectorAll('[data-alumni-management-target]').forEach((link) => {
    link.addEventListener('click', (event) => {
        event.preventDefault();
        showAlumniManagement();
    });
});

document.querySelectorAll('[data-alumni-page-back]').forEach((button) => {
    button.addEventListener('click', (event) => {
        event.preventDefault();
        event.stopPropagation();
        showAlumniPageOverview();
    });
});

document.querySelectorAll('[data-alumni-management-back]').forEach((button) => {
    button.addEventListener('click', (event) => {
        event.preventDefault();
        showAlumniPageOverview();
    });
});

@if(session('open_alumni_management') || request('panel') === 'alumni-management-section')
showAlumniManagement();
@endif

@if(session('open_alumni_panel'))
showAlumniPageEditor(@json(session('open_alumni_panel')));
@endif

document.addEventListener("DOMContentLoaded", function() {
    // Set view awal ke tengah Indonesia
    alumniMap = L.map('mapAlumni').setView([-0.789275, 113.921327], 4);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(alumniMap);

    // Ambil data lokasi dari controller
    const lokasiData = JSON.parse('{!! json_encode($lokasi_sebaran) !!}');

    // Hit API Nominatim buat dapet koordinat dari nama kota
    lokasiData.forEach(function(item) {
        fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${item.lokasi}`)
            .then(res => res.json())
            .then(data => {
                if (data.length > 0) {
                    L.marker([data[0].lat, data[0].lon])
                        .addTo(alumniMap)
                        .bindPopup(`<b>${item.lokasi}</b>`);
                }
            }).catch(err => console.log("Gagal load lokasi: ", err));
    });
});
</script>
@endsection