@extends('layouts.admin')

@section('title', 'Manajemen Berita | Admin SMAN Pintar')

@section('content')

{{-- Alert Success --}}
@if(session('success'))
<div class="bg-emerald-50 text-emerald-600 p-4 rounded-xl mb-6 font-bold flex items-center gap-2">
    <span class="material-symbols-outlined">check_circle</span>
    {{ session('success') }}
</div>
@endif

{{-- Header Section --}}
<section class="flex justify-between items-end mb-10">
    <div class="space-y-1">
        <span class="text-[11px] font-bold tracking-[0.2em] text-tertiary uppercase">Portal Editorial</span>
        <h2 class="text-4xl font-extrabold text-primary tracking-tight font-headline">Manajemen Berita</h2>
        <p class="text-on-surface-variant text-lg">Kelola semua berita sekolah</p>
    </div>
    <a href="{{ route('berita.create') }}"
        class="bg-gradient-to-br from-primary to-primary-container text-on-primary px-8 py-4 rounded-xl font-bold flex items-center gap-2 shadow-lg shadow-primary/20 hover:scale-[1.02] active:scale-95 transition-all duration-200">
        <span class="material-symbols-outlined">add_circle</span>
        + Tambah Berita
    </a>
</section>

{{-- Table Container --}}
<div class="bg-surface-container-lowest rounded-2xl overflow-hidden shadow-[0_8px_30px_rgb(0,0,0,0.04)] mb-8">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-surface-container-low/50">
                    <th class="px-8 py-5 text-[11px] font-bold text-slate-400 uppercase tracking-widest">Preview</th>
                    <th class="px-6 py-5 text-[11px] font-bold text-slate-400 uppercase tracking-widest">Judul Berita
                    </th>
                    <th class="px-6 py-5 text-[11px] font-bold text-slate-400 uppercase tracking-widest">Kategori</th>
                    <th class="px-6 py-5 text-[11px] font-bold text-slate-400 uppercase tracking-widest">Tanggal</th>
                    <th class="px-6 py-5 text-[11px] font-bold text-slate-400 uppercase tracking-widest">Status</th>
                    <th class="px-8 py-5 text-[11px] font-bold text-slate-400 uppercase tracking-widest text-right">Aksi
                    </th>
                </tr>
            </thead>
            <tbody class="divide-y divide-surface-container">

                {{-- Loop Data Berita --}}
                @forelse ($berita as $item)
                <tr class="group hover:bg-surface-container-low/30 transition-colors">
                    <td class="px-8 py-4">
                        @if($item->gambar)
                        <img src="{{ asset('storage/' . $item->gambar) }}"
                            class="w-20 h-14 object-cover rounded-lg shadow-sm" alt="Thumbnail">
                        @else
                        <div
                            class="w-20 h-14 bg-slate-200 rounded-lg flex items-center justify-center text-slate-400 text-xs">
                            No Image</div>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <p
                            class="font-bold text-blue-900 group-hover:text-primary transition-colors max-w-xs leading-snug">
                            {{ $item->judul }}
                        </p>
                    </td>
                    <td class="px-6 py-4">
                        <span
                            class="bg-primary-fixed text-on-primary-fixed-variant px-3 py-1 rounded-full text-xs font-bold">{{ $item->kategori }}</span>
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
                                {{-- Ubah type menjadi button, dan panggil fungsi openDeleteModal() --}}
                                <button type="button" onclick="openDeleteModal('delete-form-{{ $item->id }}')"
                                    class="w-full h-full w-9 h-9 flex items-center justify-center rounded-xl bg-slate-100 text-slate-500 hover:bg-error/10 hover:text-error transition-all">
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

{{-- Widget Summary Bawah --}}
<div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-12">
    <div
        class="bg-surface-container-lowest p-6 rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] flex items-center gap-5">
        <div class="w-14 h-14 rounded-2xl bg-blue-50 text-primary flex items-center justify-center">
            <span class="material-symbols-outlined text-3xl"
                style="font-variation-settings: 'FILL' 1;">description</span>
        </div>
        <div>
            <h4 class="text-[11px] font-bold text-slate-400 uppercase tracking-widest mb-1">Total Artikel</h4>
            <p class="text-3xl font-extrabold text-blue-900 font-headline">{{ $totalBerita }}</p>
        </div>
    </div>
    <div
        class="bg-surface-container-lowest p-6 rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] flex items-center gap-5">
        <div class="w-14 h-14 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center">
            <span class="material-symbols-outlined text-3xl"
                style="font-variation-settings: 'FILL' 1;">check_circle</span>
        </div>
        <div>
            <h4 class="text-[11px] font-bold text-slate-400 uppercase tracking-widest mb-1">Diterbitkan</h4>
            <p class="text-3xl font-extrabold text-blue-900 font-headline">{{ $totalPublished }}</p>
        </div>
    </div>
    <div
        class="bg-surface-container-lowest p-6 rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] flex items-center gap-5 border-l-4 border-tertiary-container">
        <div class="w-14 h-14 rounded-2xl bg-amber-50 text-tertiary flex items-center justify-center">
            <span class="material-symbols-outlined text-3xl" style="font-variation-settings: 'FILL' 1;">pending</span>
        </div>
        <div>
            <h4 class="text-[11px] font-bold text-slate-400 uppercase tracking-widest mb-1">Draft Pending</h4>
            <p class="text-3xl font-extrabold text-blue-900 font-headline">{{ $totalDraft }}</p>
        </div>
    </div>
</div>

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
                    class="mt-3 inline-flex w-full justify-center rounded-xl bg-white px-6 py-2.5 text-sm font-bold text-slate-700 shadow-sm ring-1 ring-inset ring-slate-300 hover:bg-slate-50 sm:mt-0 sm:w-auto transition-colors">
                    Batal
                </button>
            </div>

        </div>
    </div>
</div>

{{-- Script Logika Modal --}}
<script>
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