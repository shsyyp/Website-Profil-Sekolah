@extends('layouts.main')

@section('title', 'PMB 2025/2026 - SMAN Pintar Provinsi Riau')

@section('content')

{{-- Hero Section --}}
<section class="relative overflow-hidden min-h-[921px] flex items-center bg-surface pt-20">
    <div class="max-w-7xl mx-auto px-8 grid md:grid-cols-2 gap-12 items-center">
        <div class="relative z-10">
            <span
                class="inline-block px-4 py-1.5 rounded-full bg-tertiary-fixed text-on-tertiary-fixed font-semibold text-xs tracking-widest uppercase mb-6">Penerimaan
                Siswa Baru 2025/2026</span>
            <h1
                class="font-headline text-5xl md:text-7xl font-extrabold text-primary leading-tight tracking-tighter mb-6">
                Mulai Masa Depan Gemilang di SMAN Pintar
            </h1>
            <p class="text-xl text-on-surface-variant leading-relaxed mb-10 max-w-lg">
                Pendaftaran Peserta Didik Baru Tahun Ajaran 2025/2026 Telah Dibuka. Bergabunglah dengan institusi
                pendidikan unggulan di Riau.
            </p>
            <div class="flex flex-col sm:flex-row gap-4">
                <div class="flex gap-4">
                    <a href="{{ $pmb?->link_pendaftaran ?: '#' }}" target="_blank"
                        class="bg-gradient-to-br from-tertiary to-tertiary-container text-on-tertiary px-8 py-4 rounded-lg font-bold text-lg shadow-xl shadow-tertiary/20 hover:scale-105 active:scale-95 transition-all">
                        Daftar Sekarang
                    </a>
                </div>
                <a href="#persyaratan"
                    class="border-2 border-primary/20 text-primary px-8 py-4 rounded-lg font-bold text-lg hover:bg-primary/5 transition-all">
                    Panduan PMB
                </a>
            </div>
        </div>
        <div class="relative group">
            <div
                class="absolute -top-10 -right-10 w-64 h-64 bg-tertiary/10 rounded-full blur-3xl group-hover:bg-tertiary/20 transition-all duration-700">
            </div>
            <div
                class="absolute -bottom-10 -left-10 w-72 h-72 bg-primary/10 rounded-full blur-3xl group-hover:bg-primary/20 transition-all duration-700">
            </div>
            <div
                class="relative rounded-2xl overflow-hidden shadow-2xl transform rotate-2 hover:rotate-0 transition-transform duration-500">
                <img alt="SMAN Pintar Campus" class="w-full aspect-[4/5] object-cover"
                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuCzki_EPBNVyg-ldrcUWYC_cc07-B11lum4k6V5O6cNZPyNyNQ1xfh6ZNwxUxGCyiC-x1bMl09IvHCNP3Sbxy4qk_DhR9ljXdMhUikF3im0IHd5_9EkaNk1xWQvCKbOD7QyYy935iH-3C66VCiGB-seTE8fgTJdxxyHnHlMpyYAfe28tlRZ7NpipXSBVWLasgsafK2C1uEWsdorypBCAYEioFJffpS6MgyrNBgnkQfyRFBqg751RMs5T8I0VCNKS_WespzJ_IalC9b4" />
                <div class="absolute inset-0 bg-gradient-to-t from-primary/60 to-transparent"></div>
                <div class="absolute bottom-8 left-8 text-white">
                    <p class="font-bold text-2xl">Akreditasi A</p>
                    <p class="text-white/80">Standar Internasional</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Alur Pendaftaran --}}
<section class="py-24 bg-surface-container-low">
    <div class="max-w-7xl mx-auto px-8">
        <div class="text-center mb-20">
            <p class="text-tertiary font-bold tracking-[0.2em] text-sm uppercase mb-3">Langkah Mudah</p>
            <h2 class="font-headline text-4xl md:text-5xl font-extrabold text-primary">Alur Pendaftaran</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-5 gap-8">
            @forelse ($alur as $index => $item)
            <div
                class="bg-surface-container-lowest p-8 rounded-2xl shadow-sm border border-outline-variant/10 {{ ! $loop->last ? 'relative' : '' }} group hover:shadow-xl transition-all duration-500">
                <div
                    class="w-12 h-12 rounded-lg {{ $loop->last ? 'bg-tertiary/10 group-hover:bg-tertiary group-hover:text-on-tertiary' : 'bg-primary/10 group-hover:bg-primary group-hover:text-white' }} flex items-center justify-center mb-6 transition-colors duration-300">
                    <span class="material-symbols-outlined">{{ ['person_add', 'edit_note', 'description', 'psychology', 'campaign'][$index % 5] }}</span>
                </div>
                <h3 class="font-bold text-lg mb-2">{{ $index + 1 }}. {{ $item }}</h3>
                <p class="text-on-surface-variant text-sm leading-relaxed">Ikuti tahapan sesuai informasi resmi panitia PMB.</p>
                @if(! $loop->last)
                <div class="hidden md:block absolute -right-4 top-1/2 -translate-y-1/2 z-10">
                    <span class="material-symbols-outlined text-outline-variant">chevron_right</span>
                </div>
                @endif
            </div>
            @empty
            <div
                class="bg-surface-container-lowest p-8 rounded-2xl shadow-sm border border-outline-variant/10 relative group hover:shadow-xl transition-all duration-500">
                <div
                    class="w-12 h-12 rounded-lg bg-primary/10 flex items-center justify-center mb-6 group-hover:bg-primary group-hover:text-white transition-colors duration-300">
                    <span class="material-symbols-outlined">edit_note</span>
                </div>
                <h3 class="font-bold text-lg mb-2">2. Pengisian Data</h3>
                <p class="text-on-surface-variant text-sm leading-relaxed">Lengkapi formulir profil dan data akademik
                    siswa.</p>
                <div class="hidden md:block absolute -right-4 top-1/2 -translate-y-1/2 z-10">
                    <span class="material-symbols-outlined text-outline-variant">chevron_right</span>
                </div>
            </div>
            <div
                class="bg-surface-container-lowest p-8 rounded-2xl shadow-sm border border-outline-variant/10 relative group hover:shadow-xl transition-all duration-500">
                <div
                    class="w-12 h-12 rounded-lg bg-primary/10 flex items-center justify-center mb-6 group-hover:bg-primary group-hover:text-white transition-colors duration-300">
                    <span class="material-symbols-outlined">description</span>
                </div>
                <h3 class="font-bold text-lg mb-2">3. Verifikasi Berkas</h3>
                <p class="text-on-surface-variant text-sm leading-relaxed">Unggah dokumen pendukung untuk diverifikasi
                    panitia.</p>
                <div class="hidden md:block absolute -right-4 top-1/2 -translate-y-1/2 z-10">
                    <span class="material-symbols-outlined text-outline-variant">chevron_right</span>
                </div>
            </div>
            <div
                class="bg-surface-container-lowest p-8 rounded-2xl shadow-sm border border-outline-variant/10 relative group hover:shadow-xl transition-all duration-500">
                <div
                    class="w-12 h-12 rounded-lg bg-primary/10 flex items-center justify-center mb-6 group-hover:bg-primary group-hover:text-white transition-colors duration-300">
                    <span class="material-symbols-outlined">psychology</span>
                </div>
                <h3 class="font-bold text-lg mb-2">4. Ujian Seleksi</h3>
                <p class="text-on-surface-variant text-sm leading-relaxed">Mengikuti tes akademik, psikotes, dan
                    wawancara.</p>
                <div class="hidden md:block absolute -right-4 top-1/2 -translate-y-1/2 z-10">
                    <span class="material-symbols-outlined text-outline-variant">chevron_right</span>
                </div>
            </div>
            <div
                class="bg-surface-container-lowest p-8 rounded-2xl shadow-sm border border-outline-variant/10 group hover:shadow-xl transition-all duration-500">
                <div
                    class="w-12 h-12 rounded-lg bg-tertiary/10 flex items-center justify-center mb-6 group-hover:bg-tertiary group-hover:text-on-tertiary transition-colors duration-300">
                    <span class="material-symbols-outlined">campaign</span>
                </div>
                <h3 class="font-bold text-lg mb-2">5. Pengumuman</h3>
                <p class="text-on-surface-variant text-sm leading-relaxed">Hasil seleksi diumumkan melalui akun
                    masing-masing.</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

{{-- Persyaratan --}}
<section id="persyaratan" class="py-24">
    <div class="max-w-7xl mx-auto px-8">
        <div class="grid md:grid-cols-2 gap-12">
            <div class="bg-surface-container p-10 rounded-3xl relative overflow-hidden">
                <div class="absolute top-0 right-0 p-8 opacity-10">
                    <span class="material-symbols-outlined text-8xl">verified_user</span>
                </div>
                <h3 class="font-headline text-3xl font-extrabold text-primary mb-8 flex items-center gap-3">
                    <span class="material-symbols-outlined">rule</span>
                    Persyaratan Umum
                </h3>
                <ul class="space-y-6">
                    @forelse ($persyaratan as $item)
                    <li class="flex gap-4">
                        <span class="material-symbols-outlined text-primary shrink-0">check_circle</span>
                        <p class="text-on-surface-variant">{{ $item }}</p>
                    </li>
                    @empty
                    <li class="flex gap-4">
                        <span class="material-symbols-outlined text-primary shrink-0">check_circle</span>
                        <p class="text-on-surface-variant">Informasi persyaratan akan diperbarui melalui CMS PMB.</p>
                    </li>
                    @endforelse
                </ul>
            </div>
            <div class="bg-surface-container-highest p-10 rounded-3xl relative overflow-hidden">
                <div class="absolute top-0 right-0 p-8 opacity-10">
                    <span class="material-symbols-outlined text-8xl">folder_shared</span>
                </div>
                <h3 class="font-headline text-3xl font-extrabold text-primary mb-8 flex items-center gap-3">
                    <span class="material-symbols-outlined">attachment</span>
                    Berkas Administrasi
                </h3>
                <ul class="space-y-6">
                    @forelse ($berkas as $item)
                    <li class="flex gap-4">
                        <span class="material-symbols-outlined text-primary shrink-0">task</span>
                        <p class="text-on-surface-variant font-medium">{{ $item }}</p>
                    </li>
                    @empty
                    <li class="flex gap-4">
                        <span class="material-symbols-outlined text-primary shrink-0">task</span>
                        <p class="text-on-surface-variant font-medium">Informasi berkas administrasi akan diperbarui melalui CMS PMB.</p>
                    </li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</section>

{{-- Jadwal (Timeline) --}}
<section class="py-24 bg-surface-container-lowest">
    <div class="max-w-7xl mx-auto px-8">
        <div class="text-center mb-16">
            <h2 class="font-headline text-4xl font-extrabold text-primary mb-4">Timeline Pendaftaran</h2>
            <p class="text-on-surface-variant">Pantau tanggal penting agar tidak terlewatkan.</p>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-separate border-spacing-y-4">
                <thead>
                    <tr class="text-primary/60 font-bold uppercase text-xs tracking-[0.2em]">
                        <th class="px-8 py-4">Kegiatan Seleksi</th>
                        <th class="px-8 py-4">Tanggal Pelaksanaan</th>
                        <th class="px-8 py-4">Keterangan</th>
                    </tr>
                </thead>
                <tbody class="space-y-4">
                    {{-- DYNAMIC LOOP: Jadwal dari Controller --}}
                    @forelse ($jadwal as $item)
                    <tr
                        class="{{ isset($item->is_highlight) && $item->is_highlight ? 'bg-tertiary-fixed text-on-tertiary-fixed font-bold shadow-lg shadow-tertiary/10' : 'bg-surface-container-low hover:bg-surface-container transition-colors rounded-xl' }}">
                        <td
                            class="px-8 py-6 {{ !isset($item->is_highlight) ? 'font-bold text-primary' : '' }} rounded-l-xl">
                            {{ $item->kegiatan }}</td>
                        <td class="px-8 py-6">{{ $item->tanggal }}</td>
                        <td class="px-8 py-6 rounded-r-xl">{{ $item->keterangan }}</td>
                    </tr>
                    @empty
                    <tr class="bg-surface-container-low">
                        <td colspan="3" class="px-8 py-6 rounded-xl text-center text-on-surface-variant">Timeline PMB akan diperbarui melalui CMS.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</section>

{{-- FAQ --}}
<section class="py-24 bg-surface">
    <div class="max-w-4xl mx-auto px-8">
        <div class="text-center mb-16">
            <h2 class="font-headline text-4xl font-extrabold text-primary mb-4">Pertanyaan Umum (FAQ)</h2>
            <p class="text-on-surface-variant">Temukan jawaban cepat atas pertanyaan Anda.</p>
        </div>
        <div class="space-y-4">
            @forelse ($faq as $item)
            <div class="bg-surface-container-low rounded-2xl overflow-hidden group">
                <button
                    class="w-full px-8 py-6 text-left flex justify-between items-center hover:bg-surface-container transition-all">
                    <span class="font-bold text-lg text-primary">{{ $item->pertanyaan }}</span>
                    <span
                        class="material-symbols-outlined group-hover:rotate-180 transition-transform">expand_more</span>
                </button>
                <div class="px-8 pb-6 text-on-surface-variant leading-relaxed">
                    {{ $item->jawaban }}
                </div>
            </div>
            @empty
            <div class="bg-surface-container-low rounded-2xl overflow-hidden group">
                <div class="px-8 py-6 text-on-surface-variant leading-relaxed">
                    FAQ PMB akan diperbarui melalui CMS.
                </div>
            </div>
            @endforelse
        </div>
    </div>
</section>

{{-- Testimoni --}}
<section class="py-24 bg-surface-container-low relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-8 relative z-10">
        <div class="text-center mb-20">
            <h2 class="font-headline text-4xl font-extrabold text-primary mb-4">Kisah Sukses PMB</h2>
            <p class="text-on-surface-variant">Inspirasi dari mereka yang telah bergabung dengan kami.</p>
        </div>
        <div class="grid md:grid-cols-3 gap-8">
            <div class="bg-surface-container-lowest p-8 rounded-3xl shadow-sm border border-outline-variant/5">
                <div class="flex items-center gap-4 mb-6">
                    <img alt="Siswa" class="w-14 h-14 rounded-full object-cover border-2 border-primary/10"
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuDiHBTXbfO2gUpd6GzX5m6WsnAVu12gaSdYSxOl1xrJEpq8MX27XCM7jpmWRQVxioqR1CRkNvh0icyBLdba0wBzy3pSpJPAVx-EY5xkX219ZXlBteQg9P76UEDhscxoW2wwI6z4LhC9CohRLwtehbqTSpAE92buaJAljDTfbFLeDgXH7KTw9BvbYUtc9f6ioVOrwm3Co0lBjAQe2HMADLkgQIwvpaXQyd7nVv18-0BK-lR0MjCALSEVGwJXaJIK0JdS2KSNUWQBzn_e" />
                    <div>
                        <h4 class="font-bold text-primary">Aura Nadira</h4>
                        <p class="text-xs text-on-surface-variant">Alumni Jalur Prestasi 2022</p>
                    </div>
                </div>
                <p class="text-on-surface-variant italic leading-relaxed">
                    "Proses seleksi PMB SMAN Pintar sangat transparan dan kompetitif. Saya merasa tertantang sejak ujian
                    tahap pertama. Di sini saya menemukan lingkungan yang sangat suportif untuk berkembang."
                </p>
                <div class="mt-6 flex text-tertiary">
                    <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                    <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                    <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                    <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                    <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                </div>
            </div>
            <div class="bg-primary p-8 rounded-3xl shadow-xl shadow-primary/20 text-white">
                <div class="flex items-center gap-4 mb-6">
                    <img alt="Siswa" class="w-14 h-14 rounded-full object-cover border-2 border-white/20"
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuB9uIQlb20HnSd5R7nyTlPOKfaTxdJ85o0nSkJlVFdWHueJy27UO2ZkjDTIXGlc1W7ezi8C5rOq5SSjnynZ7eAPq_wk0-jF-rsKHZl2eIPW1lEpO40C8Ea59ZedSQq2s0nF6tdbUKC-1CnWIGzPvHVOYVGQrUGi3h65dNOkLFAesfF_sBlNGiksX_JBeDTVtYjITtjewWjcduEfUYB_Gz3iytBLNTGMwlvUQI80QdN7GAcG5ykJQF-MXxTzfs9stYCNHfLrZNYqCO8o" />
                    <div>
                        <h4 class="font-bold">Dimas Pratama</h4>
                        <p class="text-xs text-primary-fixed">Siswa Kelas XII - Jalur Tes</p>
                    </div>
                </div>
                <p class="text-primary-fixed italic leading-relaxed">
                    "SMAN Pintar bukan sekadar sekolah, tapi rumah kedua. Ujian seleksinya memang berat, tapi sebanding
                    dengan kualitas fasilitas dan bimbingan guru yang luar biasa profesional."
                </p>
                <div class="mt-6 flex text-tertiary-fixed">
                    <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                    <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                    <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                    <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                    <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                </div>
            </div>
            <div class="bg-surface-container-lowest p-8 rounded-3xl shadow-sm border border-outline-variant/5">
                <div class="flex items-center gap-4 mb-6">
                    <img alt="Siswa" class="w-14 h-14 rounded-full object-cover border-2 border-primary/10"
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuC-_ZlbU_Lf4ExB6Efl0Y5g_CKB4i_zXBDNEW2T6eNzeCt9h4GrauFiWkcosBpSWHMESzIPWRWvda-QPIFM8asvw_Y34eMTFQOIau8Ol8J8n_X46eN_dTVmqePZB1AhVUiX3S4ugi0N_UY9iuJO330-H9zvYjMUWA0MeQQABNGZLWwI6P5AnX-4lNoU0X_JHC3CYUM-7EVvlnc71dXd4eK5UMfuIgJplZ3tiQr0QV9ojy5avVQwVXSBjWyplx3hPPfwMmvj6lwIdPj4" />
                    <div>
                        <h4 class="font-bold text-primary">Siti Aminah</h4>
                        <p class="text-xs text-on-surface-variant">Siswa Kelas XI - Jalur Tahfidz</p>
                    </div>
                </div>
                <p class="text-on-surface-variant italic leading-relaxed">
                    "Sangat senang ada jalur khusus Tahfidz. Proses verifikasinya sangat teliti. SMAN Pintar memberikan
                    apresiasi tinggi bagi penghafal Al-Qur'an melalui sistem seleksi ini."
                </p>
                <div class="mt-6 flex text-tertiary">
                    <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                    <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                    <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                    <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                    <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- CTA Akhir --}}
<section class="py-24">
    <div class="max-w-7xl mx-auto px-8">
        <div
            class="bg-gradient-to-br from-primary via-primary-container to-blue-900 rounded-[3rem] p-12 md:p-24 text-center text-white relative overflow-hidden shadow-2xl">
            <div class="absolute top-0 left-0 w-full h-full opacity-10">
                <svg class="w-full h-full" viewbox="0 0 100 100">
                    <pattern height="10" id="grid" patternunits="userSpaceOnUse" width="10">
                        <path d="M 10 0 L 0 0 0 10" fill="none" stroke="white" stroke-width="0.5"></path>
                    </pattern>
                    <rect fill="url(#grid)" height="100" width="100"></rect>
                </svg>
            </div>
            <div class="relative z-10">
                <h2 class="font-headline text-4xl md:text-6xl font-extrabold mb-8 tracking-tighter">
                    Wujudkan Impian Anda Bersama <br class="hidden md:block" /> SMAN Pintar Riau
                </h2>
                <p class="text-xl text-primary-fixed mb-12 max-w-2xl mx-auto opacity-90 leading-relaxed">
                    Jangan lewatkan kesempatan untuk bergabung dengan komunitas pelajar terbaik. Pendaftaran akan
                    ditutup dalam beberapa hari ke depan.
                </p>
                <div class="flex flex-col sm:flex-row justify-center gap-6">
                    <a href="{{ $pmb?->link_pendaftaran ?: '#' }}" target="_blank"
                            class="bg-tertiary text-on-tertiary px-10 py-5 rounded-xl font-bold text-xl hover:scale-105 active:scale-95 transition-all shadow-2xl shadow-tertiary/20">
                            Daftar Sekarang
                    </a>
                    <a href="{{ route('pmb') }}"
                        class="bg-white/10 backdrop-blur-md border border-white/20 text-white px-10 py-5 rounded-xl font-bold text-xl hover:bg-white/20 transition-all">
                        Hubungi Panitia
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
