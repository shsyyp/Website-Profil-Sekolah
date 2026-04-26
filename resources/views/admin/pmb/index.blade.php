@extends('layouts.admin')

@section('title', 'Manajemen PMB | Admin SMAN Pintar')

@section('content')

<div class="max-w-6xl mx-auto space-y-10">

    {{-- Alert Success --}}
    @if(session('success'))
    <div class="bg-emerald-50 text-emerald-600 p-4 rounded-xl font-bold flex items-center gap-2">
        <span class="material-symbols-outlined">check_circle</span>
        {{ session('success') }}
    </div>
    @endif

    {{-- Form Start --}}
    <form method="POST" action="{{ route('admin.pmb.update') }}">
        @csrf

        <section class="flex justify-between items-end gap-6 border-b border-outline-variant/15 pb-8 mb-8">
            <div class="space-y-2">
                <span class="text-tertiary text-xs font-extrabold tracking-[0.2em] uppercase">Panel Administrasi</span>
                <h2 class="text-4xl font-display font-extrabold text-primary leading-tight tracking-tight">Manajemen PMB
                </h2>
                <p class="text-on-surface-variant max-w-xl text-lg font-medium opacity-80">Kelola informasi penerimaan
                    siswa baru. Halaman ini hanya untuk mengelola informasi konten, bukan pendaftaran.</p>
            </div>
            <div class="flex gap-4">
                <a href="{{ route('dashboard') }}"
                    class="px-6 py-3 font-semibold text-secondary hover:bg-surface-container transition-all rounded-xl border border-outline-variant/30 flex items-center gap-2">
                    <span class="material-symbols-outlined text-xl">close</span> Batal
                </a>
                <button type="submit"
                    class="px-8 py-3 bg-gradient-to-br from-primary to-primary-container text-white font-bold rounded-xl shadow-lg shadow-primary/10 hover:scale-[1.02] transition-all flex items-center gap-2">
                    <span class="material-symbols-outlined text-xl"
                        style="font-variation-settings: 'FILL' 1;">save</span>
                    Simpan Perubahan
                </button>
            </div>
        </section>

        <div class="grid grid-cols-12 gap-8">

            {{-- Alur Pendaftaran --}}
            <section class="col-span-12 lg:col-span-8 bg-surface-container-lowest p-8 rounded-xl shadow-sm">
                <h3 class="text-xl font-bold flex items-center gap-3 mb-2">
                    <span class="w-2 h-8 bg-primary rounded-full"></span> Alur Pendaftaran
                </h3>
                <p class="text-sm text-outline mb-4">Masukkan data alur pendaftaran (mendukung format teks HTML/JSON).
                </p>

                <textarea name="alur" rows="8"
                    class="w-full bg-surface-container-low border-none rounded-xl p-5 focus:ring-2 focus:ring-primary text-on-surface font-medium"
                    placeholder="Contoh: 1. Pendaftaran Online... 2. Verifikasi Berkas...">{{ old('alur', $pmb->alur ?? '') }}</textarea>

                @error('alur')
                <div class="text-error text-xs font-bold mt-2">{{ $message }}</div>
                @enderror
            </section>

            {{-- Link Pendaftaran (Right Column) --}}
            <aside class="col-span-12 lg:col-span-4 space-y-8">
                <div class="bg-primary/5 p-8 rounded-xl border border-primary/10">
                    <h3 class="text-lg font-bold mb-4 flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary">link</span> Link Pendaftaran Eksternal
                    </h3>
                    <div class="space-y-4">
                        <input name="link_pendaftaran" type="url"
                            value="{{ old('link_pendaftaran', $pmb->link_pendaftaran ?? '') }}"
                            class="w-full bg-white border-none rounded-xl py-4 px-5 text-sm font-medium focus:ring-2 focus:ring-primary shadow-inner placeholder:text-outline-variant"
                            placeholder="https://ppdb.smanpintar.sch.id" />

                        @error('link_pendaftaran')
                        <div class="text-error text-xs font-bold">{{ $message }}</div>
                        @enderror

                        <a href="{{ old('link_pendaftaran', $pmb->link_pendaftaran ?? '#') }}" target="_blank"
                            class="w-full py-3 bg-white border border-primary/20 text-primary font-bold rounded-xl hover:bg-primary hover:text-white transition-all flex items-center justify-center gap-2">
                            <span class="material-symbols-outlined text-xl">open_in_new</span> Test Halaman Pendaftaran
                        </a>
                    </div>
                </div>
            </aside>

            {{-- Persyaratan --}}
            <section class="col-span-12 grid grid-cols-1 md:grid-cols-2 gap-8">
                {{-- Persyaratan Umum --}}
                <div class="bg-surface-container-lowest p-8 rounded-xl shadow-sm">
                    <h3 class="text-lg font-bold text-primary mb-2">Persyaratan Umum</h3>
                    <p class="text-xs text-outline mb-4">Daftar persyaratan calon siswa baru.</p>

                    <textarea name="persyaratan_umum" rows="6"
                        class="w-full bg-surface-container-low border-none rounded-xl p-5 focus:ring-2 focus:ring-primary text-on-surface font-medium">{{ old('persyaratan_umum', $pmb->persyaratan_umum ?? '') }}</textarea>

                    @error('persyaratan_umum')
                    <div class="text-error text-xs font-bold mt-2">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Berkas Administrasi --}}
                <div class="bg-surface-container-lowest p-8 rounded-xl shadow-sm">
                    <h3 class="text-lg font-bold text-primary mb-2">Berkas Administrasi</h3>
                    <p class="text-xs text-outline mb-4">Daftar berkas yang wajib diunggah/dibawa.</p>

                    <textarea name="berkas" rows="6"
                        class="w-full bg-surface-container-low border-none rounded-xl p-5 focus:ring-2 focus:ring-primary text-on-surface font-medium">{{ old('berkas', $pmb->berkas ?? '') }}</textarea>

                    @error('berkas')
                    <div class="text-error text-xs font-bold mt-2">{{ $message }}</div>
                    @enderror
                </div>
            </section>

            {{-- Jadwal --}}
            <section class="col-span-12 bg-white rounded-xl shadow-sm overflow-hidden p-8">
                <h3 class="text-xl font-bold mb-2">Jadwal Kegiatan PMB</h3>
                <p class="text-sm text-outline mb-4">Format jadwal lengkap pendaftaran hingga seleksi.</p>

                <textarea name="jadwal" rows="6"
                    class="w-full bg-surface-container-low border-none rounded-xl p-5 focus:ring-2 focus:ring-primary text-on-surface font-medium">{{ old('jadwal', $pmb->jadwal ?? '') }}</textarea>

                @error('jadwal')
                <div class="text-error text-xs font-bold mt-2">{{ $message }}</div>
                @enderror
            </section>

            {{-- FAQ --}}
            <section class="col-span-12 bg-surface-container-lowest p-8 rounded-xl shadow-sm">
                <h3 class="text-xl font-bold mb-2">Frequently Asked Questions (FAQ) PMB</h3>
                <p class="text-sm text-outline mb-4">Pertanyaan yang sering diajukan terkait PMB.</p>

                <textarea name="faq" rows="6"
                    class="w-full bg-surface-container-low border-none rounded-xl p-5 focus:ring-2 focus:ring-primary text-on-surface font-medium">{{ old('faq', $pmb->faq ?? '') }}</textarea>

                @error('faq')
                <div class="text-error text-xs font-bold mt-2">{{ $message }}</div>
                @enderror
            </section>
        </div>

        <footer
            class="mt-12 flex justify-end gap-4 p-8 bg-surface-container-lowest rounded-xl border border-outline-variant/10 shadow-xl shadow-blue-900/5">
            <button type="reset"
                class="px-8 py-4 text-slate-500 font-bold hover:bg-surface-container transition-all rounded-xl">
                Reset Form
            </button>
            <button type="submit"
                class="px-12 py-4 bg-gradient-to-br from-primary to-primary-container text-white font-black rounded-xl shadow-lg shadow-primary/20 hover:scale-[1.03] active:scale-95 transition-all flex items-center gap-3">
                <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">cloud_upload</span>
                Publikasikan Perubahan
            </button>
        </footer>
    </form>
</div>

@endsection