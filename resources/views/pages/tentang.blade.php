@extends('layouts.main')

@section('title', 'Tentang Kami - SMAN Pintar Provinsi Riau')

@section('content')
{{-- Hero Section & Breadcrumb --}}
<section class="relative h-64 flex items-center overflow-hidden bg-primary-container">
    <div class="absolute inset-0 opacity-20">
        <img alt="School background" class="w-full h-full object-cover"
            data-alt="abstract blurred view of a modern school library with soft lighting and bookshelves in the background"
            src="https://lh3.googleusercontent.com/aida-public/AB6AXuCnyXL0n2V3ExwtRVjX6KOHtBjTOnVIX58cuwpTdsZ10cb_nCteZuARseMIS6crt1FFD6gNKlnBSigsoGo0P74haJ1Jyw94LOUG4oD5wQ79xQsCwHhuZ_bIF7y4n85MRdei8AZO8g-PC6vcDuMy5pwC_Kh6ZtrTRWEPXY6npGoVCdpwai3TpB4H79IomqONsqfd1asST1pPbdHvVm2Gp65yxax3CTGeOntbO7zMGDevw0loDMm0UX5LVbukJzyxTd_NawUdj_UgYnsu" />
    </div>
    <div class="relative z-10 max-w-7xl mx-auto px-8 w-full">
        <nav class="flex mb-4 text-on-primary-container/80 text-sm font-medium">
            <a href="{{ url('/') }}"
                class="hover:text-on-primary-container cursor-pointer transition-colors">Beranda</a>
            <span class="mx-2 material-symbols-outlined text-sm leading-none">chevron_right</span>
            <span class="text-on-primary-container">Tentang Kami</span>
        </nav>
        <h1 class="text-4xl md:text-5xl font-extrabold text-on-primary-container font-headline tracking-tight">Tentang
            Kami</h1>
    </div>
</section>

{{-- Highlights (Status, Metode, Layanan) --}}
<section class="py-12 -mt-12 relative z-20 max-w-7xl mx-auto px-8">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div
            class="bg-surface-container-lowest p-8 rounded-xl shadow-[0_24px_40px_rgba(25,27,34,0.04)] flex items-center gap-6 group hover:translate-y-[-4px] transition-all">
            <div class="w-16 h-16 rounded-lg bg-tertiary-container/20 flex items-center justify-center text-tertiary">
                <span class="material-symbols-outlined text-3xl fill-icon">verified</span>
            </div>
            <div>
                <p class="text-tertiary text-xs font-bold uppercase tracking-widest mb-1">Status</p>
                <h3 class="text-xl font-bold font-headline">Akreditasi A</h3>
            </div>
        </div>

        <div
            class="bg-surface-container-lowest p-8 rounded-xl shadow-[0_24px_40px_rgba(25,27,34,0.04)] flex items-center gap-6 group hover:translate-y-[-4px] transition-all">
            <div class="w-16 h-16 rounded-lg bg-primary-container/10 flex items-center justify-center text-primary">
                <span class="material-symbols-outlined text-3xl">memory</span>
            </div>
            <div>
                <p class="text-primary text-xs font-bold uppercase tracking-widest mb-1">Metode</p>
                <h3 class="text-xl font-bold font-headline">Berbasis Teknologi</h3>
            </div>
        </div>

        <div
            class="bg-surface-container-lowest p-8 rounded-xl shadow-[0_24px_40px_rgba(25,27,34,0.04)] flex items-center gap-6 group hover:translate-y-[-4px] transition-all">
            <div class="w-16 h-16 rounded-lg bg-secondary-container/30 flex items-center justify-center text-secondary">
                <span class="material-symbols-outlined text-3xl">home_work</span>
            </div>
            <div>
                <p class="text-secondary text-xs font-bold uppercase tracking-widest mb-1">Layanan</p>
                <h3 class="text-xl font-bold font-headline">Asrama Eksklusif</h3>
            </div>
        </div>
    </div>
</section>

{{-- Profil Sekolah --}}
<section class="py-20 max-w-7xl mx-auto px-8 grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
    <div class="order-2 lg:order-1">
        <span class="text-tertiary font-bold text-sm tracking-[0.2em] uppercase mb-4 block">Ekselerasi Pendidikan</span>
        <h2 class="text-4xl md:text-5xl font-extrabold font-headline leading-tight mb-8">Dedikasi Mencetak Generasi
            Unggul Riau</h2>
        <div class="space-y-6 text-on-surface-variant leading-relaxed text-lg">
            <p>SMAN Pintar Provinsi Riau berdiri sebagai mercusuar pendidikan berkualitas yang memadukan kurikulum
                nasional dengan inovasi teknologi terkini. Kami percaya bahwa setiap siswa memiliki potensi yang tidak
                terbatas jika didukung oleh lingkungan yang tepat.</p>
            <p>Berlokasi di lingkungan yang asri namun modern, sekolah kami bukan sekadar tempat belajar, melainkan
                laboratorium masa depan bagi putra-putri terbaik daerah untuk bertumbuh menjadi pemimpin yang cerdas
                secara intelektual dan berintegritas secara moral.</p>
        </div>
        <div class="mt-10 flex gap-4">
            <button
                class="bg-primary text-on-primary px-8 py-4 rounded-xl font-bold font-headline hover:shadow-lg transition-shadow">Selengkapnya</button>
            <button
                class="border-2 border-outline-variant text-primary px-8 py-4 rounded-xl font-bold font-headline hover:bg-surface-container transition-colors">Lihat
                Video Profil</button>
        </div>
    </div>
    <div class="order-1 lg:order-2 relative">
        <div class="aspect-square rounded-2xl overflow-hidden shadow-2xl">
            <img alt="School building architecture" class="w-full h-full object-cover"
                data-alt="Modern architectural view of a university or high school campus"
                src="https://lh3.googleusercontent.com/aida-public/AB6AXuBrZysYUdrrL-V6NkqRMcowI2PjJ3jJSnWaNfnkHkl-Cx_NlmDk7BWkZhqAzzuuqAWmuPDc3PFbbjm11r7Adqf3FEw_tC6POJL4IzaJKA1rh3cJBuPq3bCTGxQMldXLtlBmbWI7fNmV9YTpfHBXkJvuXFCJ85hF4zpr0pNx7LNg7GYKf0E6kv2oMcBp26bf8SSu8Er4npt_Fho9tE00K6tCPXKGkntv1FjLo9t1o6e2qcTa7n6HkbNo0FuojG1nRk1I7zj0QFoN02Lw" />
        </div>
        <div class="absolute -bottom-6 -left-6 bg-tertiary text-on-tertiary p-8 rounded-xl shadow-xl hidden md:block">
            <p class="text-4xl font-black font-headline">15+</p>
            <p class="text-sm font-medium opacity-90 uppercase tracking-tighter">Tahun Dedikasi</p>
        </div>
    </div>
</section>

{{-- Visi & Misi --}}
<section class="py-24 bg-surface-container-low">
    <div class="max-w-7xl mx-auto px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-extrabold font-headline mb-4">Visi & Misi Kami</h2>
            <div class="w-24 h-1.5 bg-tertiary mx-auto rounded-full"></div>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <div
                class="bg-surface-container-lowest p-10 rounded-2xl shadow-[0_24px_40px_rgba(25,27,34,0.04)] border-l-8 border-primary">
                <div class="flex items-center gap-4 mb-6">
                    <span class="material-symbols-outlined text-4xl text-primary">visibility</span>
                    <h3 class="text-2xl font-extrabold font-headline uppercase tracking-tight">Visi</h3>
                </div>
                <p class="text-xl font-medium leading-relaxed italic text-primary/80">"Menjadi institusi pendidikan
                    model yang unggul dalam prestasi akademik, berwawasan teknologi global, serta berakar kuat pada
                    nilai-nilai karakter bangsa."</p>
            </div>
            <div
                class="bg-surface-container-lowest p-10 rounded-2xl shadow-[0_24px_40px_rgba(25,27,34,0.04)] border-l-8 border-tertiary">
                <div class="flex items-center gap-4 mb-6">
                    <span class="material-symbols-outlined text-4xl text-tertiary">flag</span>
                    <h3 class="text-2xl font-extrabold font-headline uppercase tracking-tight">Misi</h3>
                </div>
                <ul class="space-y-4">
                    <li class="flex items-start gap-4">
                        <span class="material-symbols-outlined text-tertiary shrink-0 mt-1">check_circle</span>
                        <p class="text-on-surface-variant font-medium">Menyelenggarakan pembelajaran berbasis ICT yang
                            inovatif dan interaktif.</p>
                    </li>
                    <li class="flex items-start gap-4">
                        <span class="material-symbols-outlined text-tertiary shrink-0 mt-1">check_circle</span>
                        <p class="text-on-surface-variant font-medium">Mengembangkan potensi minat dan bakat siswa
                            melalui program pembinaan intensif.</p>
                    </li>
                    <li class="flex items-start gap-4">
                        <span class="material-symbols-outlined text-tertiary shrink-0 mt-1">check_circle</span>
                        <p class="text-on-surface-variant font-medium">Membangun ekosistem sekolah yang religius, jujur,
                            dan berdisiplin tinggi.</p>
                    </li>
                    <li class="flex items-start gap-4">
                        <span class="material-symbols-outlined text-tertiary shrink-0 mt-1">check_circle</span>
                        <p class="text-on-surface-variant font-medium">Mewujudkan kolaborasi strategis dengan institusi
                            pendidikan internasional.</p>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

{{-- Fasilitas --}}
<section class="py-24 max-w-7xl mx-auto px-8">
    <div class="flex flex-col md:flex-row md:items-end justify-between mb-16 gap-6">
        <div>
            <span class="text-primary font-bold text-sm tracking-[0.2em] uppercase mb-4 block">Infrastruktur
                Modern</span>
            <h2 class="text-3xl md:text-4xl font-extrabold font-headline">Fasilitas Unggulan</h2>
        </div>
        <button class="text-primary font-bold flex items-center gap-2 group hover:gap-4 transition-all">
            Lihat Semua Fasilitas <span class="material-symbols-outlined">arrow_forward</span>
        </button>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
        <div class="group cursor-pointer">
            <div class="relative h-64 rounded-xl overflow-hidden mb-4 shadow-md">
                <img alt="Laboratorium Science"
                    class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuAKvhx9m3BO3VGIlQ-Z9A8lNb3RRRMUFGkFJk4jYkdX1ScYp9XOVkpCvR7b6uc8dLAY-Rjolvrc0r-mZ731MdXazRSAh8GBUNLJYsWldyvnuEPXpfIgk2FDJELNglVmcVp1h4uImcx9_k43mqrkFclYpsADl7TDwn-Liw8vGAi-_9UJzZ2TRgxYfiGlW0Wu2mkaeVai9ez2Eb0R5AiRtDtYltD_xIZjYICj1sd1viNNrai4theGWcUpsl7pV1EeErbC6e8PYDBGNlC8" />
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                <div class="absolute bottom-4 left-4 text-white">
                    <span class="material-symbols-outlined text-3xl">biotech</span>
                </div>
            </div>
            <h4 class="text-lg font-bold font-headline group-hover:text-primary transition-colors">Lab Riset & Sains
            </h4>
            <p class="text-sm text-on-surface-variant">Dilengkapi peralatan standar olimpiade internasional.</p>
        </div>
        <div class="group cursor-pointer">
            <div class="relative h-64 rounded-xl overflow-hidden mb-4 shadow-md">
                <img alt="Digital Library"
                    class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuCBnDSZhDHoTUMPzDc8y_N7GtbRP15yn4aWR7suk8dr24hgMGarPYoe5qO42athlDPdB6iw-oxrNqAHMJV-yEKcAgAFVIxSGZPhoj2ikI90lvjJiow4ylvxKN4wHiM1N2K4JUt5ucLdW1iFr-hhbdqEnFvE6ZLWou80HXjULYo24l2I1dxzI8NhtCLHwdpX6_l2kAalQpDcJWfJDUKfdBMC-c5UynbdKNas2BNvFGFnnauFCRUP9EWQbp2rifhub8lmxmcVvQ46p6kc" />
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                <div class="absolute bottom-4 left-4 text-white">
                    <span class="material-symbols-outlined text-3xl">auto_stories</span>
                </div>
            </div>
            <h4 class="text-lg font-bold font-headline group-hover:text-primary transition-colors">Perpustakaan Digital
            </h4>
            <p class="text-sm text-on-surface-variant">Akses ke ribuan jurnal dan e-book global 24/7.</p>
        </div>
        <div class="group cursor-pointer">
            <div class="relative h-64 rounded-xl overflow-hidden mb-4 shadow-md">
                <img alt="Indoor Sports"
                    class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuDfLykeBHg41Q0_Qyy3eGYtFtUv98HhcL0FUA00xUEvBElOJboHZtbsbr9l-RUgstBml92mO736qUVR8ETJId9bD7FYHj5BZA8ANlMal-1zm5VIAEfOlFlV-hOi8A3AMZQ6dXUIqhjZTpowcSeKvRvFvMzeZtAdSL88oa6WMy_jq4Liv_njRPPc81TgDoKZuwd6Ho8W_u41Ts9CqqmTDYHqwXdp6rjQQdx9LZDpopmXv8CCCQXjb6Ks-xEuWm8Rs1a4ahQ6mUoYWakc" />
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                <div class="absolute bottom-4 left-4 text-white">
                    <span class="material-symbols-outlined text-3xl">sports_basketball</span>
                </div>
            </div>
            <h4 class="text-lg font-bold font-headline group-hover:text-primary transition-colors">Sport Center</h4>
            <p class="text-sm text-on-surface-variant">Gedung olahraga indoor untuk basket, futsal, dan badminton.</p>
        </div>
        <div class="group cursor-pointer">
            <div class="relative h-64 rounded-xl overflow-hidden mb-4 shadow-md">
                <img alt="Auditorium"
                    class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuAEZCrDWutJV_jSkfohmrSodNxQTzTaa8XBbytISjCG135BplLearA3wHbuUVRvYg1CkZ4ybt-1KSMsYd1UTaAf40UapAWgcKdRk-wpzYX3aILzW6clEQgf4CbxMiBy1PD3LZ-EHyH27OS02rgemNFMKxGIaCyDCc7EoBtPwCgrlel1g4Qmp0PQ3yJGpzf-A7DMPp5gX90jQgbhsWc_3Ijj7SEEn9TBR_a4Pw4yfSoVWy_MClML9lGPzAGBW9BGAgj5EyPN9Lwj9JHI" />
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                <div class="absolute bottom-4 left-4 text-white">
                    <span class="material-symbols-outlined text-3xl">theater_comedy</span>
                </div>
            </div>
            <h4 class="text-lg font-bold font-headline group-hover:text-primary transition-colors">Teater Seni</h4>
            <p class="text-sm text-on-surface-variant">Ruang pertunjukan dengan sistem tata suara mutakhir.</p>
        </div>
    </div>
</section>

{{-- Ekstrakurikuler --}}
<section class="py-24 bg-primary text-on-primary">
    <div class="max-w-7xl mx-auto px-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-16 items-start">
            <div>
                <span class="text-tertiary-fixed font-bold text-sm tracking-[0.2em] uppercase mb-4 block">Pengembangan
                    Diri</span>
                <h2 class="text-4xl font-extrabold font-headline leading-tight mb-6">Ekstrakurikuler Pilihan</h2>
                <p class="text-on-primary/70 mb-10 text-lg">Kami menyediakan wadah bagi siswa untuk mengeksplorasi minat
                    di luar jam akademik dengan mentor yang kompeten.</p>
                <div class="flex flex-wrap gap-3">
                    <span class="bg-white/10 px-4 py-2 rounded-full text-sm font-medium">#Creativity</span>
                    <span class="bg-white/10 px-4 py-2 rounded-full text-sm font-medium">#Leadership</span>
                    <span class="bg-white/10 px-4 py-2 rounded-full text-sm font-medium">#Innovation</span>
                </div>
            </div>
            <div class="lg:col-span-2 grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div
                    class="bg-white/5 backdrop-blur-md p-6 rounded-xl border border-white/10 hover:bg-white/10 transition-colors">
                    <div
                        class="w-12 h-12 rounded-lg bg-tertiary-fixed text-on-tertiary-fixed flex items-center justify-center mb-4">
                        <span class="material-symbols-outlined text-2xl">robot_2</span>
                    </div>
                    <h4 class="text-xl font-bold font-headline mb-2">Robotic Club</h4>
                    <p class="text-sm text-on-primary/60">Mengembangkan kecerdasan buatan dan perakitan mekanik robotik
                        tingkat lanjut.</p>
                </div>
                <div
                    class="bg-white/5 backdrop-blur-md p-6 rounded-xl border border-white/10 hover:bg-white/10 transition-colors">
                    <div
                        class="w-12 h-12 rounded-lg bg-secondary-fixed text-on-secondary-fixed flex items-center justify-center mb-4">
                        <span class="material-symbols-outlined text-2xl">public</span>
                    </div>
                    <h4 class="text-xl font-bold font-headline mb-2">English Debate</h4>
                    <p class="text-sm text-on-primary/60">Mengasah kemampuan argumentasi dan diplomasi internasional
                        dalam bahasa Inggris.</p>
                </div>
                <div
                    class="bg-white/5 backdrop-blur-md p-6 rounded-xl border border-white/10 hover:bg-white/10 transition-colors">
                    <div
                        class="w-12 h-12 rounded-lg bg-primary-fixed text-on-primary-fixed flex items-center justify-center mb-4">
                        <span class="material-symbols-outlined text-2xl">palette</span>
                    </div>
                    <h4 class="text-xl font-bold font-headline mb-2">Visual Arts</h4>
                    <p class="text-sm text-on-primary/60">Eksplorasi seni lukis, desain grafis, dan multimedia kreatif.
                    </p>
                </div>
                <div
                    class="bg-white/5 backdrop-blur-md p-6 rounded-xl border border-white/10 hover:bg-white/10 transition-colors">
                    <div
                        class="w-12 h-12 rounded-lg bg-surface-container-highest text-on-surface flex items-center justify-center mb-4">
                        <span class="material-symbols-outlined text-2xl">campaign</span>
                    </div>
                    <h4 class="text-xl font-bold font-headline mb-2">Journalism</h4>
                    <p class="text-sm text-on-primary/60">Pelatihan penulisan berita, fotografi jurnalistik, dan
                        penyiaran radio sekolah.</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection