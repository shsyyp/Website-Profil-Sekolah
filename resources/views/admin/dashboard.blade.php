@extends('layouts.admin')

@section('title', 'Dashboard - Admin SMAN Pintar')

@section('content')

{{-- Statistik --}}
<section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

    <div
        class="bg-surface-container-lowest p-6 rounded-xl shadow-[24px_24px_48px_rgba(25,27,34,0.03)] border-b-4 border-primary group hover:-translate-y-1 transition-transform duration-300">
        <div class="flex justify-between items-start mb-4">
            <div class="p-3 bg-primary/5 rounded-xl text-primary">
                <span class="material-symbols-outlined" data-icon="newspaper">newspaper</span>
            </div>
            <span
                class="text-[10px] font-bold text-tertiary bg-tertiary-fixed/30 px-2 py-1 rounded-full uppercase">Update</span>
        </div>
        <h3 class="text-outline text-xs font-bold uppercase tracking-widest mb-1">Total Berita</h3>
        <p class="text-3xl font-extrabold text-on-surface">{{ $totalBerita ?? 0 }}</p>
    </div>

    <div
        class="bg-surface-container-lowest p-6 rounded-xl shadow-[24px_24px_48px_rgba(25,27,34,0.03)] border-b-4 border-tertiary group hover:-translate-y-1 transition-transform duration-300">
        <div class="flex justify-between items-start mb-4">
            <div class="p-3 bg-tertiary/5 rounded-xl text-tertiary">
                <span class="material-symbols-outlined" data-icon="school">school</span>
            </div>
            <span
                class="text-[10px] font-bold text-primary bg-primary-fixed/30 px-2 py-1 rounded-full uppercase">Verified</span>
        </div>
        <h3 class="text-outline text-xs font-bold uppercase tracking-widest mb-1">Total Alumni</h3>
        <p class="text-3xl font-extrabold text-on-surface">{{ $totalAlumni ?? 0 }}</p>
    </div>

    {{-- KONTEN PMB: Sudah Diubah Jadi Dinamis --}}
    <div
        class="bg-surface-container-lowest p-6 rounded-xl shadow-[24px_24px_48px_rgba(25,27,34,0.03)] border-b-4 border-primary-container group hover:-translate-y-1 transition-transform duration-300">
        <div class="flex justify-between items-start mb-4">
            <div class="p-3 bg-primary-container/5 rounded-xl text-primary-container">
                <span class="material-symbols-outlined" data-icon="how_to_reg">how_to_reg</span>
            </div>
            {{-- Badge warna otomatis berdasarkan status --}}
            <span
                class="text-[10px] font-bold text-white {{ (isset($statusPMB) && $statusPMB == 'Aktif') ? 'bg-emerald-500' : 'bg-error/80' }} px-2 py-1 rounded-full uppercase">
                {{ (isset($statusPMB) && $statusPMB == 'Aktif') ? 'LIVE' : 'DRAFT' }}
            </span>
        </div>
        <h3 class="text-outline text-xs font-bold uppercase tracking-widest mb-1">Konten PMB</h3>
        <p class="text-3xl font-extrabold text-on-surface">{{ $statusPMB ?? 'Kosong' }}</p>
    </div>

    <div
        class="bg-surface-container-lowest p-6 rounded-xl shadow-[24px_24px_48px_rgba(25,27,34,0.03)] border-b-4 border-on-secondary-container group hover:-translate-y-1 transition-transform duration-300">
        <div class="flex justify-between items-start mb-4">
            <div class="p-3 bg-on-secondary-container/5 rounded-xl text-on-secondary-container">
                <span class="material-symbols-outlined" data-icon="smart_toy">smart_toy</span>
            </div>
            <span
                class="text-[10px] font-bold text-on-secondary bg-secondary-container px-2 py-1 rounded-full uppercase">AI
                Bot</span>
        </div>
        <h3 class="text-outline text-xs font-bold uppercase tracking-widest mb-1">FAQ Chatbot</h3>
        <p class="text-3xl font-extrabold text-on-surface">{{ $totalChatbot ?? 0 }}</p>
    </div>
</section>

{{-- Main Interactive Bento Grid (Berita Kiri & FAQ Kanan) --}}
<div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mt-8">

    {{-- KIRI: Table Berita --}}
    <section
        class="bg-surface-container-lowest rounded-xl p-8 shadow-[24px_24px_48px_rgba(25,27,34,0.02)] flex flex-col">
        <div class="flex justify-between items-center mb-8">
            <div>
                <span class="text-xs font-bold text-tertiary uppercase tracking-widest">Editorial Control</span>
                <h2 class="text-2xl font-extrabold text-on-surface tracking-tight">Berita Terbaru</h2>
            </div>
            <a href="{{ url('admin/berita/create') }}"
                class="bg-primary hover:bg-primary-container text-on-primary px-5 py-2.5 rounded-xl text-sm font-bold flex items-center gap-2 transition-all active:scale-95 shadow-lg shadow-primary/20">
                <span class="material-symbols-outlined text-[20px]" data-icon="add">add</span>
                Buat Berita
            </a>
        </div>
        <div class="overflow-x-auto flex-1">
            <table class="w-full text-left border-separate border-spacing-y-3">
                <thead>
                    <tr class="text-outline text-[11px] uppercase tracking-widest font-bold">
                        <th class="px-4 pb-2">Judul Berita</th>
                        <th class="px-4 pb-2 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-sm">
                    @forelse($berita_terbaru as $item)
                    <tr class="bg-surface-container-low hover:bg-surface-container-high transition-colors group">
                        <td class="px-4 py-4 rounded-l-xl">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 rounded-lg bg-slate-200 overflow-hidden flex-shrink-0">
                                    @if($item->gambar)
                                    <img alt="Thumbnail" class="w-full h-full object-cover"
                                        src="{{ asset('storage/' . $item->gambar) }}" />
                                    @else
                                    <div
                                        class="w-full h-full flex items-center justify-center text-[10px] text-slate-400 font-bold">
                                        No Img</div>
                                    @endif
                                </div>
                                <span
                                    class="font-bold text-on-surface line-clamp-1 max-w-[200px]">{{ $item->judul }}</span>
                            </div>
                        </td>
                        <td class="px-4 py-4 rounded-r-xl text-right">
                            <div class="flex justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                <a href="{{ route('berita.edit', $item->id) }}"
                                    class="p-2 text-secondary hover:bg-white rounded-lg transition-colors" title="Edit">
                                    <span class="material-symbols-outlined text-[18px]">edit</span>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="2" class="px-4 py-8 text-center text-slate-400 italic">Belum ada berita yang
                            ditambahkan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>

    {{-- KANAN: Chatbot FAQ --}}
    <section
        class="bg-surface-container-lowest rounded-xl p-8 shadow-[24px_24px_48px_rgba(25,27,34,0.02)] flex flex-col">
        <div class="flex justify-between items-center mb-8">
            <div>
                <span class="text-[10px] font-bold text-primary uppercase tracking-[0.2em] mb-1 block">Intelligent
                    Response</span>
                <h2 class="text-2xl font-extrabold text-on-surface tracking-tight">FAQ Manager</h2>
            </div>
            <div class="flex gap-2">
                <a href="{{ url('admin/chatbot/create') }}"
                    class="bg-on-secondary-container text-white px-4 py-2 rounded-lg text-sm font-bold transition-all active:scale-95 shadow-lg shadow-on-secondary-container/10">Add
                    Knowledge</a>
            </div>
        </div>
        <div class="flex-1">
            <div class="grid grid-cols-1 gap-4">
                @if(isset($chatbot) && count($chatbot) > 0)
                @foreach ($chatbot as $item)
                <div
                    class="bg-surface-container-low p-6 rounded-xl shadow-sm border-l-4 border-primary hover:shadow-md transition-all">
                    <div class="flex gap-4">
                        <div class="text-primary mt-1">
                            <span class="material-symbols-outlined">question_answer</span>
                        </div>
                        <div class="flex-1">
                            <p class="text-xs font-bold text-outline uppercase tracking-wider mb-2">Question</p>
                            <p class="font-bold text-on-surface text-lg mb-4">{{ $item->pertanyaan }}</p>
                            <div class="h-[1px] bg-slate-100 mb-4"></div>
                            <p class="text-xs font-bold text-outline uppercase tracking-wider mb-2">Answer</p>
                            <p class="text-on-surface-variant text-sm leading-relaxed">{{ $item->jawaban }}</p>
                        </div>
                        <div class="flex flex-col gap-2">
                            <a href="{{ url('admin/chatbot/'.$item->id.'/edit') }}"
                                class="p-2 text-outline hover:text-primary transition-colors"><span
                                    class="material-symbols-outlined text-[20px]">edit</span></a>
                            <form action="{{ url('admin/chatbot/'.$item->id) }}" method="POST">
                                @csrf @method('DELETE')
                                <button type="submit" class="p-2 text-outline hover:text-error transition-colors"><span
                                        class="material-symbols-outlined text-[20px]">delete</span></button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
                @else
                <p class="text-center text-outline py-8">Belum ada data FAQ Chatbot.</p>
                @endif
            </div>
        </div>
    </section>

</div>

@endsection