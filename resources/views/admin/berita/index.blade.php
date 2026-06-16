@extends('layouts.admin')

@section('title', 'Manajemen Berita | Admin SMAN Pintar')

@section('content')
@php
    $newsPageComponents = [
        [
            'id' => 'news-hero-section',
            'icon' => 'newspaper',
            'title' => 'Hero Halaman',
            'content' => str_replace('Warta', 'Berita', $settings->hero_title ?? 'Berita SMAN Pintar'),
            'meta' => $settings->hero_breadcrumb_label ?? 'Berita',
        ],
        [
            'id' => 'news-management-section',
            'icon' => 'edit_note',
            'title' => 'Manajemen Berita',
            'content' => 'Kelola semua berita sekolah',
            'meta' => $totalBerita . ' artikel',
            'type' => 'scroll',
        ],
    ];
@endphp

{{-- Alert Success --}}
@if(session('success'))
<div class="bg-emerald-50 text-emerald-600 p-4 rounded-xl mb-6 font-bold flex items-center gap-2">
    <span class="material-symbols-outlined">check_circle</span>
    {{ session('success') }}
</div>
@endif

{{-- Pengaturan Tampilan Halaman Berita --}}
<form action="{{ route('admin.berita.page-setting.update') }}" method="POST" class="mb-12 space-y-8">
    @csrf
    <input type="hidden" name="active_panel" id="activeNewsPanelInput" value="">

    <div id="news-page-overview" class="space-y-8">
        <section>
            <h2 class="text-4xl font-extrabold text-primary tracking-tight font-headline">Berita</h2>
        </section>

        <section class="bg-surface-container-lowest rounded-2xl overflow-hidden shadow-[0_8px_30px_rgb(0,0,0,0.04)]">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-surface-container-low/50">
                            <th class="px-8 py-5 text-[11px] font-bold text-slate-400 uppercase tracking-widest">No</th>
                            <th class="px-6 py-5 text-[11px] font-bold text-slate-400 uppercase tracking-widest">Komponen</th>
                            <th class="px-6 py-5 text-[11px] font-bold text-slate-400 uppercase tracking-widest">Ringkasan</th>
                            <th class="px-8 py-5 text-[11px] font-bold text-slate-400 uppercase tracking-widest text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-surface-container">
                        @foreach ($newsPageComponents as $component)
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
                                @if(($component['type'] ?? 'editor') === 'scroll')
                                <a href="#{{ $component['id'] }}" data-news-scroll-target="{{ $component['id'] }}"
                                    class="inline-flex w-9 h-9 items-center justify-center rounded-xl bg-slate-100 text-slate-500 hover:bg-amber-100 hover:text-amber-600 transition-all">
                                    <span class="material-symbols-outlined text-[20px]">edit</span>
                                </a>
                                @else
                                <a href="#{{ $component['id'] }}" data-news-edit-target="{{ $component['id'] }}"
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

    <section id="news-page-editors" class="hidden max-w-4xl space-y-4">
        <details id="news-hero-section" data-news-panel class="group bg-surface-container-lowest rounded-2xl shadow-sm border border-slate-100 overflow-hidden" open>
            <summary class="list-none p-6 flex items-center justify-between gap-4">
                <div>
                    <span class="text-xs font-bold text-tertiary uppercase tracking-widest mb-1 block">Component 01</span>
                    <h3 class="text-2xl font-headline font-extrabold text-primary">Hero Halaman</h3>
                </div>
                <button type="button" data-news-back class="inline-flex items-center gap-2 rounded-xl bg-slate-100 px-4 py-2 text-sm font-bold text-slate-600 hover:bg-slate-200 transition-colors">
                    <span class="material-symbols-outlined text-[18px]">arrow_back</span>
                    Kembali
                </button>
            </summary>
            <div class="border-t border-slate-100 p-6 lg:p-8 bg-surface-container-low/40">
                <div class="grid grid-cols-1 gap-6">
                    <div class="space-y-2">
                        <label class="text-sm font-bold text-slate-700">Judul</label>
                        <input name="hero_title" type="text"
                            class="w-full bg-surface-container-lowest border-none focus:ring-2 focus:ring-primary rounded-xl px-4 py-3 font-medium text-on-surface"
                            value="{{ str_replace('Warta', 'Berita', $settings->hero_title ?? 'Berita SMAN Pintar') }}">
                    </div>
                    <div class="space-y-2">
                        <label class="text-sm font-bold text-slate-700">Deskripsi</label>
                        <textarea name="hero_description" rows="4"
                            class="w-full bg-surface-container-lowest border-none focus:ring-2 focus:ring-primary rounded-xl px-4 py-3 text-on-surface-variant leading-relaxed">{{ $settings->hero_description ?? 'Menyajikan informasi terbaru seputar prestasi, kegiatan kesiswaan, dan pengumuman resmi dari lingkungan sekolah.' }}</textarea>
                    </div>
                </div>
            </div>
        </details>

        <div class="bg-surface-container-lowest rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] px-8 py-6">
            <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end sm:items-center">
                <button type="button" data-news-back class="btn-cancel">
                    Batal
                </button>
                <button type="submit" class="bg-primary text-white px-8 py-3 rounded-xl font-bold shadow-lg hover:scale-105 transition-all">
                    Simpan
                </button>
            </div>
        </div>
    </section>
</form>

<section id="news-management-section" class="hidden space-y-6">
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <h2 class="text-4xl font-extrabold text-primary tracking-tight font-headline">Manajemen Berita</h2>
        <div class="flex flex-col-reverse gap-3 sm:flex-row sm:items-center">
            <button type="button" data-news-management-back
                class="inline-flex items-center justify-center gap-2 rounded-xl bg-slate-100 px-6 py-3.5 font-bold text-slate-600 hover:bg-slate-200 transition-colors">
                <span class="material-symbols-outlined text-[18px]">arrow_back</span>
                Kembali
            </button>
            <a href="{{ route('berita.create') }}"
                class="inline-flex items-center justify-center gap-2 bg-gradient-to-r from-primary to-primary-container text-white px-6 py-3.5 rounded-xl font-bold shadow-lg shadow-primary/20 hover:scale-105 transition-all">
                <span class="material-symbols-outlined">add</span>
                Tambah Berita
            </a>
        </div>
    </div>

    {{-- Table Container --}}
    <div class="bg-surface-container-lowest rounded-2xl overflow-hidden shadow-[0_8px_30px_rgb(0,0,0,0.04)] mb-8">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-surface-container-low/50">
                        <th class="px-8 py-5 text-[11px] font-bold text-slate-400 uppercase tracking-widest">No</th>
                        <th class="px-6 py-5 text-[11px] font-bold text-slate-400 uppercase tracking-widest">Judul Berita</th>
                        <th class="px-6 py-5 text-[11px] font-bold text-slate-400 uppercase tracking-widest">Kategori</th>
                        <th class="px-6 py-5 text-[11px] font-bold text-slate-400 uppercase tracking-widest">Tanggal</th>
                        <th class="px-6 py-5 text-[11px] font-bold text-slate-400 uppercase tracking-widest">Status</th>
                        <th class="px-8 py-5 text-[11px] font-bold text-slate-400 uppercase tracking-widest text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-surface-container">

                    {{-- Loop Data Berita --}}
                    @forelse ($berita as $item)
                    <tr class="group hover:bg-surface-container-low/30 transition-colors">
                        <td class="px-8 py-4">
                            <span class="inline-flex h-8 w-8 items-center justify-center rounded-lg bg-blue-50 text-sm font-bold text-primary">
                                {{ $berita->firstItem() + $loop->index }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <p class="font-bold text-blue-900 group-hover:text-primary transition-colors max-w-xs leading-snug">
                                {{ $item->judul }}
                            </p>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-sm font-bold text-on-surface">{{ $item->kategori }}</span>
                        </td>
                        <td class="px-6 py-4 text-sm text-on-surface-variant font-medium">
                            {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}
                        </td>
                        <td class="px-6 py-4">
                            @if($item->status == 'publish')
                            <span
                                class="flex items-center gap-1.5 text-xs font-bold text-emerald-600 bg-emerald-50 px-3 py-1 rounded-full w-fit">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Published
                            </span>
                            @else
                            <span
                                class="flex items-center gap-1.5 text-xs font-bold text-amber-600 bg-amber-50 px-3 py-1 rounded-full w-fit">
                                <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span> Draft
                            </span>
                            @endif
                        </td>
                        <td class="px-8 py-4 text-right">
                            <div class="flex justify-end gap-2">
                                <a href="{{ route('berita.edit', $item->id) }}"
                                    class="w-9 h-9 flex items-center justify-center rounded-xl bg-slate-100 text-slate-500 hover:bg-amber-100 hover:text-amber-600 transition-all">
                                    <span class="material-symbols-outlined text-[20px]">edit</span>
                                </a>
                                <form id="delete-form-{{ $item->id }}" action="{{ route('berita.destroy', $item->id) }}"
                                    method="POST">
                                    @csrf @method('DELETE')
                                    <button type="button" onclick="openDeleteModal('delete-form-{{ $item->id }}')"
                                        class="w-9 h-9 flex items-center justify-center rounded-xl bg-slate-100 text-slate-500 hover:bg-error/10 hover:text-error transition-all">
                                        <span class="material-symbols-outlined text-[20px]">delete</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-8 py-8 text-center text-slate-400">Belum ada data berita.</td>
                    </tr>
                    @endforelse

                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="px-8 py-6 bg-surface-container-low/30 border-t border-surface-container">
            {{ $berita->links() }}
        </div>
    </div>
</section>

{{-- ========================================== --}}
{{-- MODAL KONFIRMASI HAPUS (CUSTOM POP-UP)     --}}
{{-- ========================================== --}}
<div id="deleteModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog"
    aria-modal="true">
    <div class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm transition-opacity" onclick="closeDeleteModal()"></div>

    <div class="flex min-h-screen items-center justify-center p-4 text-center sm:p-0 pointer-events-none">
        <div
            class="relative transform overflow-hidden rounded-2xl bg-surface-container-lowest text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-lg border border-outline-variant/20 pointer-events-auto">

            <div class="px-6 pb-6 pt-8 sm:p-8 sm:pb-6">
                <div class="sm:flex sm:items-start">
                    <div
                        class="mx-auto flex h-14 w-14 flex-shrink-0 items-center justify-center rounded-full bg-error/10 sm:mx-0 sm:h-12 sm:w-12">
                        <span class="material-symbols-outlined text-error text-2xl"
                            style="font-variation-settings: 'FILL' 1;">warning</span>
                    </div>
                    <div class="mt-4 text-center sm:ml-5 sm:mt-0 sm:text-left">
                        <h3 class="text-xl font-extrabold leading-6 text-on-surface font-headline" id="modal-title">
                            Hapus Berita
                        </h3>
                        <div class="mt-3">
                            <p class="text-sm text-on-surface-variant leading-relaxed">
                                Apakah Anda yakin ingin menghapus berita ini? Data dan gambar yang terlampir akan
                                dihapus secara permanen dan tidak dapat dikembalikan.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- PERBAIKAN: Bagian ini harus berada DI DALAM div pembungkus modal --}}
            <div
                class="bg-surface-container-low px-6 py-4 sm:flex sm:flex-row-reverse sm:px-8 border-t border-outline-variant/10">
                <button type="button" id="confirmDeleteBtn"
                    class="inline-flex w-full justify-center rounded-xl bg-error px-6 py-2.5 text-sm font-bold text-white shadow-sm hover:bg-red-700 sm:ml-3 sm:w-auto transition-colors">
                    Yakin, Hapus
                </button>
                <button type="button" onclick="closeDeleteModal()"
                    class="btn-cancel mt-3 w-full sm:mt-0 sm:w-auto">
                    Batal
                </button>
            </div>

        </div>
    </div>
</div>

{{-- Script Logika Modal --}}
<script>
const newsPageOverview = document.getElementById('news-page-overview');
const newsPageEditors = document.getElementById('news-page-editors');
const newsManagementSection = document.getElementById('news-management-section');
const newsPagePanels = document.querySelectorAll('[data-news-panel]');
const activeNewsPanelInput = document.getElementById('activeNewsPanelInput');

function showNewsPageOverview() {
    newsPageEditors.classList.add('hidden');
    newsManagementSection.classList.add('hidden');
    newsPageOverview.classList.remove('hidden');
    newsPagePanels.forEach((panel) => panel.classList.add('hidden'));
    if (activeNewsPanelInput) {
        activeNewsPanelInput.value = '';
    }
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

function showNewsPageEditor(panelId) {
    const target = document.getElementById(panelId);

    if (!target) {
        return;
    }

    newsPageOverview.classList.add('hidden');
    newsManagementSection.classList.add('hidden');
    newsPageEditors.classList.remove('hidden');
    newsPagePanels.forEach((panel) => panel.classList.add('hidden'));
    target.classList.remove('hidden');
    target.open = true;
    if (activeNewsPanelInput) {
        activeNewsPanelInput.value = panelId;
    }
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

document.querySelectorAll('[data-news-edit-target]').forEach((link) => {
    link.addEventListener('click', (event) => {
        event.preventDefault();
        showNewsPageEditor(link.dataset.newsEditTarget);
    });
});

function showNewsManagement() {
    newsPageOverview.classList.add('hidden');
    newsPageEditors.classList.add('hidden');
    newsPagePanels.forEach((panel) => panel.classList.add('hidden'));
    newsManagementSection.classList.remove('hidden');
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

document.querySelectorAll('[data-news-scroll-target]').forEach((link) => {
    link.addEventListener('click', (event) => {
        event.preventDefault();
        showNewsManagement();
    });
});

document.querySelectorAll('[data-news-back]').forEach((button) => {
    button.addEventListener('click', (event) => {
        event.preventDefault();
        event.stopPropagation();
        showNewsPageOverview();
    });
});

document.querySelectorAll('[data-news-management-back]').forEach((button) => {
    button.addEventListener('click', (event) => {
        event.preventDefault();
        showNewsPageOverview();
    });
});

@if(session('open_news_management'))
showNewsManagement();
@endif

@if(session('open_news_panel'))
showNewsPageEditor(@json(session('open_news_panel')));
@endif

@if(request('panel') === 'news-management-section')
showNewsManagement();
@endif

let formToSubmit = null;
const deleteModal = document.getElementById('deleteModal');

// Fungsi untuk membuka modal
function openDeleteModal(formId) {
    formToSubmit = document.getElementById(formId);
    deleteModal.classList.remove('hidden');
}

// Fungsi untuk menutup modal
function closeDeleteModal() {
    formToSubmit = null;
    deleteModal.classList.add('hidden');
}

// Jika tombol "Yakin, Hapus" diklik
document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
    if (formToSubmit) {
        // Submit form Laravel yang dipilih
        formToSubmit.submit();
    }
});
</script>

@endsection
