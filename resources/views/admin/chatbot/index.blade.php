@extends('layouts.admin')

@section('title', 'Chatbot | SMAN Pintar Admin')

@section('content')
<div class="max-w-7xl mx-auto space-y-8">

    @if(session('success'))
    <div class="bg-emerald-50 text-emerald-600 p-4 rounded-xl font-bold flex items-center gap-2">
        <span class="material-symbols-outlined">check_circle</span>
        {{ session('success') }}
    </div>
    @endif

    <section class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
        <h1 class="text-4xl font-extrabold text-primary tracking-tight font-headline">Chatbot</h1>
        <a href="{{ route('chatbot.create') }}"
            class="inline-flex items-center justify-center gap-2 bg-gradient-to-r from-primary to-primary-container text-white px-6 py-3.5 rounded-xl font-bold shadow-lg shadow-primary/20 hover:scale-105 transition-all">
            <span class="material-symbols-outlined" data-icon="add">add</span> Tambah Pertanyaan
        </a>
    </section>

    <section class="bg-surface-container-lowest rounded-2xl overflow-hidden shadow-[0_8px_30px_rgb(0,0,0,0.04)]">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-surface-container-low/50">
                        <th class="px-8 py-5 text-[11px] font-bold text-slate-400 uppercase tracking-widest">No</th>
                        <th class="px-6 py-5 text-[11px] font-bold text-slate-400 uppercase tracking-widest">Pertanyaan</th>
                        <th class="px-6 py-5 text-[11px] font-bold text-slate-400 uppercase tracking-widest">Ringkasan Jawaban</th>
                        <th class="px-8 py-5 text-[11px] font-bold text-slate-400 uppercase tracking-widest text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-surface-container">
                    @forelse($chatbots as $item)
                    <tr class="group hover:bg-surface-container-low/30 transition-colors">
                        <td class="px-8 py-4">
                            <span class="inline-flex h-8 w-8 items-center justify-center rounded-lg bg-blue-50 text-sm font-bold text-primary">
                                {{ $chatbots->firstItem() + $loop->index }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <p class="font-bold text-blue-900 group-hover:text-primary transition-colors">{{ $item->pertanyaan }}</p>
                        </td>
                        <td class="px-6 py-4">
                            <p class="max-w-xl text-sm text-on-surface-variant font-medium leading-relaxed line-clamp-2">
                                {{ \Illuminate\Support\Str::limit(strip_tags($item->jawaban), 140) }}
                            </p>
                        </td>
                        <td class="px-8 py-4 text-right">
                            <div class="flex justify-end gap-2">
                                <a href="{{ route('chatbot.edit', $item->id) }}"
                                    class="w-9 h-9 flex items-center justify-center rounded-xl bg-slate-100 text-slate-500 hover:bg-amber-100 hover:text-amber-600 transition-all">
                                    <span class="material-symbols-outlined text-[20px]" data-icon="edit">edit</span>
                                </a>
                                <form action="{{ route('chatbot.destroy', $item->id) }}" method="POST"
                                    onsubmit="return confirm('Hapus data ini?');">
                                    @csrf @method('DELETE')
                                    <button
                                        class="w-9 h-9 flex items-center justify-center rounded-xl bg-slate-100 text-slate-500 hover:bg-error/10 hover:text-error transition-all">
                                        <span class="material-symbols-outlined text-[20px]" data-icon="delete">delete</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-8 py-8 text-center text-slate-400">Belum ada data Chatbot.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="px-8 py-6 bg-surface-container-low/30 border-t border-surface-container">
            {{ $chatbots->links() }}
        </div>
    </section>
</div>
@endsection
