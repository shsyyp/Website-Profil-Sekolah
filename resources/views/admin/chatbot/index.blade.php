@extends('layouts.admin')

@section('title', 'Manajemen Chatbot | SMAN Pintar Admin')

@section('content')
<div class="max-w-7xl mx-auto space-y-8">

    @if(session('success'))
    <div class="bg-emerald-50 text-emerald-600 p-4 rounded-xl font-bold flex items-center gap-2">
        <span class="material-symbols-outlined">check_circle</span>
        {{ session('success') }}
    </div>
    @endif

    {{-- Hero Header Section --}}
    <section class="relative bg-surface-container-lowest p-8 rounded-xl overflow-hidden">
        <div
            class="absolute top-0 right-0 w-1/3 h-full bg-gradient-to-l from-primary/5 to-transparent flex items-center justify-center">
            <span class="material-symbols-outlined text-primary/10 text-9xl rotate-12" data-icon="forum">forum</span>
        </div>
        <div class="relative z-10">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
                <div class="space-y-2">
                    <span class="text-tertiary font-bold tracking-[0.2em] text-[10px] uppercase">Management
                        Portal</span>
                    <h1 class="text-4xl font-extrabold text-on-surface tracking-tight">Manajemen Chatbot</h1>
                    <p class="text-on-surface-variant max-w-xl">Kelola pertanyaan dan jawaban chatbot website secara
                        real-time.</p>
                </div>
                <a href="{{ route('chatbot.create') }}"
                    class="flex items-center gap-2 bg-gradient-to-r from-primary to-primary-container text-white px-6 py-3.5 rounded-xl font-bold shadow-lg shadow-primary/20 hover:scale-105 transition-all">
                    <span class="material-symbols-outlined" data-icon="add">add</span> Tambah Pertanyaan
                </a>
            </div>
        </div>
    </section>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        {{-- FAQ Content List --}}
        <div class="lg:col-span-8 space-y-4">
            @forelse($chatbots as $item)
            <div
                class="group bg-surface-container-lowest rounded-xl p-6 transition-all border-l-4 border-primary shadow-sm hover:shadow-md">
                <div class="flex items-start justify-between gap-4">
                    <div class="space-y-3">
                        <div class="flex items-center gap-3">
                            <span
                                class="px-2.5 py-1 rounded bg-primary-fixed text-on-primary-fixed-variant text-[10px] font-bold uppercase tracking-wider">{{ $item->kategori }}</span>
                            <span class="text-xs text-slate-400 font-medium">Diupdate:
                                {{ $item->updated_at->diffForHumans() }}</span>
                        </div>
                        <h3 class="text-lg font-bold text-on-surface group-hover:text-primary transition-colors">
                            {{ $item->pertanyaan }}</h3>
                        <p class="text-on-surface-variant text-sm leading-relaxed">{{ $item->jawaban }}</p>
                    </div>
                    <div class="flex flex-col gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                        <a href="{{ route('chatbot.edit', $item->id) }}"
                            class="p-2 bg-surface-container hover:bg-tertiary/10 text-tertiary rounded-lg transition-colors">
                            <span class="material-symbols-outlined text-lg" data-icon="edit">edit</span>
                        </a>
                        <form action="{{ route('chatbot.destroy', $item->id) }}" method="POST"
                            onsubmit="return confirm('Hapus data ini?');">
                            @csrf @method('DELETE')
                            <button
                                class="p-2 bg-surface-container hover:bg-error/10 text-error rounded-lg transition-colors">
                                <span class="material-symbols-outlined text-lg" data-icon="delete">delete</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @empty
            <div class="text-center p-8 text-slate-400 bg-surface-container-lowest rounded-xl">Belum ada data Chatbot.
            </div>
            @endforelse

            {{-- Pagination --}}
            <div class="pt-6">
                {{ $chatbots->links() }}
            </div>
        </div>

        {{-- Right Sidebar: Statistics --}}
        <div class="lg:col-span-4 space-y-6">
            <div class="bg-surface-container-lowest rounded-xl p-6 space-y-6">
                <h4 class="font-bold text-on-surface border-b border-slate-100 pb-4">Statistik Chatbot</h4>
                <div class="space-y-4">
                    <div class="flex justify-between items-end">
                        <div>
                            <p class="text-[10px] uppercase font-bold text-slate-400 tracking-wider">Total Pertanyaan
                            </p>
                            <p class="text-3xl font-extrabold text-on-surface">{{ $chatbots->total() }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection