@extends('layouts.main')

@section('title', 'Jejak Alumni - SMAN Pintar Provinsi Riau')

@section('content')

{{-- Hero Section --}}
<section class="relative w-full py-24 overflow-hidden pt-32">
    <div class="absolute inset-0 z-0">
        <img class="w-full h-full object-cover opacity-10 grayscale"
            src="https://lh3.googleusercontent.com/aida-public/AB6AXuDMwvvOLKRtfIxH2Qq18Ps6U-a_YTVILX0ftk_QVoGZ7553gSYV8unNCe1vWI3QO9BzaMyZO10VEAUVIdMoOFhCMXgO8690yxRCJWm7jTfP2i0QpBL0su9IiqdSPMoaSR4-OjpKUuqasNqW88U36bzj9FXDXjxEsbR9xQaTzuumZyLxEdPH9-lNqmM4U4m4RKCe2EIYqZLQXiy3eK3zHthbi0aHxiGpO9CKEjsSlr-JfJjXThobtMrfawkaYNcxq_3ELaRtZ4RVk_I9"
            alt="Alumni Background" />
        <div class="absolute inset-0 bg-gradient-to-br from-primary/10 via-background to-background"></div>
    </div>
    <div class="relative z-10 max-w-7xl mx-auto px-6">
        <nav class="flex items-center gap-2 text-sm font-medium mb-6 text-tertiary">
            <a href="{{ url('/') }}" class="hover:text-primary transition-colors">Beranda</a>
            <span class="material-symbols-outlined text-xs">chevron_right</span>
            <span class="text-on-surface-variant">Alumni</span>
        </nav>
        <div class="max-w-3xl">
            <h1 class="font-headline text-5xl md:text-7xl font-extrabold tracking-tighter text-primary mb-6">Jejak
                Alumni Kami</h1>
            <p class="text-lg text-on-surface-variant leading-relaxed">
                Membangun masa depan melalui warisan keunggulan. Alumni SMAN Pintar Riau tersebar di seluruh penjuru
                dunia, membawa semangat inovasi dan integritas dari tanah Lancang Kuning ke panggung global.
            </p>
        </div>
    </div>
</section>

{{-- Statistik --}}
<section class="max-w-7xl mx-auto px-6 -mt-16 relative z-20">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div
            class="bg-surface-container-lowest p-8 rounded-xl shadow-[0_24px_40px_rgba(25,27,34,0.04)] hover:scale-[1.02] transition-transform">
            <span class="material-symbols-outlined text-tertiary text-4xl mb-4">groups</span>
            <h3 class="text-3xl font-extrabold text-primary mb-1">{{ $totalAlumni }}+</h3>
            <p class="text-on-surface-variant font-medium text-sm uppercase tracking-wider">Total Alumni</p>
        </div>
        <div
            class="bg-surface-container-lowest p-8 rounded-xl shadow-[0_24px_40px_rgba(25,27,34,0.04)] hover:scale-[1.02] transition-transform">
            <span class="material-symbols-outlined text-tertiary text-4xl mb-4">school</span>
            <h3 class="text-3xl font-extrabold text-primary mb-1">95%</h3>
            <p class="text-on-surface-variant font-medium text-sm uppercase tracking-wider">Lolos PTN</p>
        </div>
        <div
            class="bg-surface-container-lowest p-8 rounded-xl shadow-[0_24px_40px_rgba(25,27,34,0.04)] hover:scale-[1.02] transition-transform">
            <span class="material-symbols-outlined text-tertiary text-4xl mb-4">work</span>
            <h3 class="text-3xl font-extrabold text-primary mb-1">30%</h3>
            <p class="text-on-surface-variant font-medium text-sm uppercase tracking-wider">Fortune 500</p>
        </div>
        <div
            class="bg-surface-container-lowest p-8 rounded-xl shadow-[0_24px_40px_rgba(25,27,34,0.04)] hover:scale-[1.02] transition-transform">
            <span class="material-symbols-outlined text-tertiary text-4xl mb-4">public</span>
            <h3 class="text-3xl font-extrabold text-primary mb-1">{{ $totalLokasi }}+</h3>
            <p class="text-on-surface-variant font-medium text-sm uppercase tracking-wider">Lokasi Alumni</p>
        </div>
    </div>
</section>

{{-- Map Persebaran --}}
<section class="py-24 max-w-7xl mx-auto px-6">
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-8 mb-12">
        <div class="max-w-xl">
            <span class="text-tertiary font-bold tracking-[0.2em] text-xs uppercase block mb-3">Global Network</span>
            <h2 class="text-4xl font-extrabold text-primary tracking-tight">Sebaran Alumni Global</h2>
            <p class="mt-4 text-on-surface-variant">Dari Riau untuk Dunia. Lihat bagaimana komunitas alumni kami
                berkembang di berbagai pusat ekonomi dan pendidikan global.</p>
        </div>
        <div class="flex gap-4">
            <select
                class="bg-surface-container-high border-none rounded-xl px-4 py-2.5 text-sm font-medium focus:ring-2 focus:ring-primary">
                <option>Angkatan</option>
                <option>2023</option>
                <option>2022</option>
            </select>
            <select
                class="bg-surface-container-high border-none rounded-xl px-4 py-2.5 text-sm font-medium focus:ring-2 focus:ring-primary">
                <option>Bidang Studi</option>
                <option>Teknologi</option>
                <option>Kesehatan</option>
            </select>
        </div>
    </div>
    <div class="relative bg-surface-container-low rounded-3xl p-8 aspect-[16/9] overflow-hidden group">
        <img class="w-full h-full object-cover rounded-2xl opacity-40"
            src="https://lh3.googleusercontent.com/aida-public/AB6AXuCQi24Ka19CQa7GxJbyNCSoqQbzg0RWJH1COvHl4YnPFV156JvxnxdPOwEX-LC4v9zTXzWfTEJDpK-smbaDV-3cMoGM_1gPXIDDZ_Cjf_ekRcVqyIV-s5_9qqGrEJxHdyqcVQ9Uj_1XGPTN3XqtTbnX_Qg3EQOCvEVJy32qAybo7jyO_tvqwaYPlSS8FEzKOplbqZq0KRdePAZgGnEOMH3H0PFwwandzHr6iwfFMSxDQLGVinWVEWqIcSqAIVmQFJVHTfwPo3EEKECg"
            alt="World Map" />
        <div class="absolute inset-0 flex items-center justify-center">

            {{-- DYNAMIC LOOP: Titik Persebaran Map --}}
            @foreach ($lokasi as $loc)
            <div class="absolute flex flex-col items-center" @style(['top: ' . $loc->top, ' left: ' . $loc->left])>
                @if(isset($loc->ping) && $loc->ping)
                <div class="w-4 h-4 {{ $loc->color }} rounded-full animate-ping absolute"></div>
                <div class="w-4 h-4 {{ $loc->color }} rounded-full relative shadow-lg"></div>
                @else
                <div class="w-3 h-3 {{ $loc->color }} rounded-full relative"></div>
                @endif
                <span
                    class="mt-2 text-[10px] font-bold bg-white px-2 py-0.5 rounded shadow text-primary">{{ $loc->kota }}</span>
            </div>
            @endforeach

        </div>
    </div>
</section>

{{-- Featured Alumni --}}
<section class="py-24 bg-surface-container-low">
    <div class="max-w-7xl mx-auto px-6">
        <div
            class="bg-surface-container-lowest rounded-3xl overflow-hidden shadow-[0_32px_64px_rgba(25,27,34,0.06)] flex flex-col lg:flex-row">
            <div class="lg:w-1/2 h-[500px] relative">
                <img class="w-full h-full object-cover"
                    src="{{ $featuredAlumni?->foto ? asset('storage/' . $featuredAlumni->foto) : 'https://lh3.googleusercontent.com/aida-public/AB6AXuA5b9EKh9EPOhCkOHOD9OhGHtMgEYqREHpizcz4yCCG-bZdDvNF9f7UrIJ1wHBEhzBLiLp5YzkV-TEHddVtGY_d_x0XJ99stYk4ko2d5loipZ8A0_opvHMrJ9H5NcHyo_kGvDoyGqCoMIRljXVe7u9CitFKpB3AAFe0qYMBsRGYOl2iqn1dtoRR_w4HqsywZMt9H9umODxX5V5K2g66_Z-xqoFRL6lU-wUoCYdePmIfmfqGWb__uFu67oUKxb3WZjNHoBPC1rnidCm9' }}"
                    alt="{{ $featuredAlumni?->nama ?? 'Alumni SMAN Pintar' }}" />
                <div class="absolute top-8 left-8">
                    <span
                        class="bg-tertiary-container text-on-tertiary-container px-6 py-2 rounded-full font-bold text-xs uppercase tracking-widest backdrop-blur-md">Featured
                        Alumna</span>
                </div>
            </div>
            <div class="lg:w-1/2 p-12 lg:p-16 flex flex-col justify-center">
                <h3 class="text-4xl font-extrabold text-primary mb-4">{{ $featuredAlumni?->nama ?? 'Alumni SMAN Pintar' }}</h3>
                <p class="text-tertiary font-bold mb-8 text-lg">{{ $featuredAlumni?->profesi ?? 'Profil alumni akan diperbarui' }}{{ $featuredAlumni?->instansi ? ', ' . $featuredAlumni->instansi : '' }} | Class of {{ $featuredAlumni?->tahun_lulus ?? '-' }}</p>
                <blockquote class="text-xl italic text-on-surface-variant mb-8 leading-relaxed">
                    "{{ $featuredAlumni?->deskripsi ?: 'SMAN Pintar menjadi ruang tumbuh untuk membangun karakter, disiplin, dan keberanian bermimpi lebih besar.' }}"
                </blockquote>
                <div class="flex gap-4 items-center">
                    <button
                        class="bg-primary text-on-primary px-8 py-4 rounded-xl font-bold flex items-center gap-2 hover:translate-x-2 transition-transform shadow-lg">
                        Baca Kisah Selengkapnya
                        <span class="material-symbols-outlined">arrow_forward</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Alumni Grid --}}
<section class="py-24 max-w-7xl mx-auto px-6">
    <div class="text-center mb-16">
        <h2 class="text-4xl font-extrabold text-primary mb-4">Inspirasi Alumni</h2>
        <p class="text-on-surface-variant max-w-2xl mx-auto">Mengenal lebih dekat para alumni berprestasi yang kini
            berkarya di berbagai sektor industri strategis.</p>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

        {{-- DYNAMIC LOOP: Data Alumni --}}
        @forelse ($daftar_alumni as $item)
        <div
            class="group bg-surface-container-lowest rounded-2xl p-6 shadow-sm hover:shadow-[0_20px_40px_rgba(25,27,34,0.08)] transition-all duration-300">
            <div class="relative mb-6">
                <img class="w-24 h-24 rounded-2xl object-cover mb-4" src="{{ $item->foto ? asset('storage/' . $item->foto) : 'https://lh3.googleusercontent.com/aida-public/AB6AXuA3kk9jqHFB1bwe8T3UOsjV_sL3xqb9csJjS7ZD042fBVAd2C1XKZenZBSonVAEJQXtXFX6FPYkhv92fLkf3eqw7AaNz8GNPmtR2-0doASR5iHvDVsWGACZ5nWxtWJYwrtdkY5KSU9Fep_xYRvUYHdY3VKWQYaeQK8KPqjTMdUEFfLQsYOxTZ43UAzhLiSN3UVZ-ggTeMHgzGk7766ySmdXXbBjNuP6slDcPj4zsZS8EwjyvcBA3qhVsN3P0r8IjwZ9XheX4N25zYYQ' }}"
                    alt="{{ $item->nama }}" />
                @if($loop->first)
                <span
                    class="absolute top-0 right-0 bg-blue-100 text-blue-700 text-[10px] font-bold px-2 py-1 rounded-full uppercase">Featured</span>
                @endif
            </div>
            <h4 class="text-xl font-bold text-primary group-hover:text-tertiary transition-colors">{{ $item->nama }}
            </h4>
            <p class="text-on-surface-variant text-sm mt-1 mb-6">{{ $item->profesi }}{{ $item->instansi ? ', ' . $item->instansi : '' }}</p>
            <div class="flex items-center gap-2">
                <span
                    class="text-xs font-semibold bg-surface-container px-3 py-1 rounded-full text-on-surface-variant">Class of {{ $item->tahun_lulus }}</span>
                @if($item->lokasi)
                <span
                    class="text-xs font-semibold bg-surface-container px-3 py-1 rounded-full text-on-surface-variant">{{ $item->lokasi }}</span>
                @endif
            </div>
        </div>
        @empty
        <div class="lg:col-span-3 bg-surface-container-lowest rounded-2xl p-10 text-center text-on-surface-variant">
            Belum ada data alumni aktif yang tersedia.
        </div>
        @endforelse

    </div>
    <div class="mt-16 text-center">
        <button class="text-primary font-bold flex items-center gap-2 mx-auto hover:gap-4 transition-all">
            Lihat Semua Direktori Alumni
            <span class="material-symbols-outlined">east</span>
        </button>
    </div>
</section>

{{-- Testimoni --}}
<section class="py-24 overflow-hidden bg-primary relative">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-0 left-0 w-full h-full"
            style="background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 40px 40px;">
        </div>
    </div>
    <div class="max-w-7xl mx-auto px-6 relative z-10">
        <div class="flex flex-col items-center text-center">
            <span class="material-symbols-outlined text-tertiary-fixed text-6xl mb-8">format_quote</span>
            <div class="max-w-4xl">
                <p class="text-2xl md:text-3xl font-medium text-white leading-relaxed mb-12">
                    "Berada di SMAN Pintar membuka mata saya bahwa keterbatasan geografis bukan penghalang untuk
                    bersaing secara global. Kurikulum dan dukungan pengajarnya benar-benar mempersiapkan mentalitas
                    juara."
                </p>
                <div class="flex flex-col items-center">
                    <h5 class="text-white font-bold text-lg">Fandi Ahmad</h5>
                    <p class="text-on-primary-container text-sm">PhD Candidate, University of Oxford | Class of 2016</p>
                </div>
            </div>
            <div class="flex gap-4 mt-12">
                <button
                    class="w-12 h-12 rounded-full border border-white/20 flex items-center justify-center text-white hover:bg-white/10 transition-colors">
                    <span class="material-symbols-outlined">chevron_left</span>
                </button>
                <button
                    class="w-12 h-12 rounded-full border border-white/20 flex items-center justify-center text-white hover:bg-white/10 transition-colors">
                    <span class="material-symbols-outlined">chevron_right</span>
                </button>
            </div>
        </div>
    </div>
</section>

{{-- CTA Section --}}
<section class="py-24 max-w-7xl mx-auto px-6">
    <div
        class="relative bg-surface-container-high rounded-[2rem] p-12 md:p-20 overflow-hidden flex flex-col items-center text-center">
        <div class="absolute top-0 right-0 -mr-20 -mt-20 w-80 h-80 bg-tertiary/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-80 h-80 bg-primary/10 rounded-full blur-3xl"></div>

        <h2 class="text-4xl md:text-5xl font-extrabold text-primary tracking-tight mb-6">Jadilah Bagian dari Alumni
            Hebat Kami</h2>
        <p class="text-lg text-on-surface-variant max-w-2xl mb-12">Lanjutkan legacy keunggulan ini. Apakah Anda calon
            siswa yang ambisius atau alumni yang ingin kembali berkontribusi?</p>

        <div class="flex flex-col sm:flex-row gap-6 relative z-10">
            <a href="{{ url('/pmb') }}"
                class="bg-tertiary text-on-tertiary px-10 py-4 rounded-xl font-bold text-lg hover:scale-105 transition-all shadow-lg flex items-center gap-3">
                Daftar PMB
                <span class="material-symbols-outlined">rocket_launch</span>
            </a>
            <button
                class="bg-primary text-on-primary px-10 py-4 rounded-xl font-bold text-lg hover:scale-105 transition-all shadow-lg flex items-center gap-3">
                Gabung Alumni
                <span class="material-symbols-outlined">person_add</span>
            </button>
        </div>
    </div>
</section>

@endsection
