@extends('layouts.main')

@section('title', 'Beranda - SMAN Pintar Provinsi Riau')

@section('content')
<section class="relative min-h-[921px] flex items-center px-6 overflow-hidden">
    <div class="absolute inset-0 z-0">
        <img alt="Campus" class="w-full h-full object-cover grayscale-[20%]"
            data-alt="Modern architectural school campus building with large windows and lush green landscaping during soft morning sunlight"
            src="https://lh3.googleusercontent.com/aida-public/AB6AXuDbEck_1x1stX4kchIbJmQMOkVAduOZd4f80kqVCezJu1ZPVyguVYNDL5J6jQ6RVzMqbhygErZsT4V8P-fxYVDwYzlMttzIfP62ovhKKLfCPlilDx86OV070AZP_8SMSMY7bygnj6RNhcWA1DwWMsiVxh09boINlQt8HhHEQtpRtqSzzb-UkIYCBhEIi9fQ8-WNqs63W2-8a9nb87slf6_D6CYIR18dJHvs0aToJMtqNm3_LQ3i81UWuadyHm6uGv29SFF2kEu0c3DG" />
        <div class="absolute inset-0 bg-gradient-to-r from-surface via-surface/80 to-transparent"></div>
    </div>
    <div class="relative z-10 max-w-7xl mx-auto w-full grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
        <div class="space-y-8">
            <div
                class="inline-block px-4 py-1.5 rounded-full bg-tertiary-fixed text-on-tertiary-fixed text-xs font-bold uppercase tracking-widest">
                Provinsi Riau
            </div>
            <h1 class="text-5xl md:text-7xl font-black font-headline text-primary tracking-tight leading-[1.1]">
                Mencetak Generasi <span class="text-tertiary">Unggul</span> dan Berprestasi
            </h1>
            <p class="text-lg text-secondary max-w-lg leading-relaxed">
                Sekolah Unggulan Berbasis Asrama di Riau yang mengintegrasikan kecerdasan akademik, karakter mulia, dan
                inovasi teknologi.
            </p>
            <div class="flex flex-wrap gap-4">
                <button
                    class="primary-gradient text-on-primary px-8 py-4 rounded-md font-bold text-lg hover:scale-105 active:scale-95 transition-all shadow-xl shadow-primary/20">
                    Daftar PMB
                </button>
                <button
                    class="px-8 py-4 rounded-md font-bold text-lg border-2 border-primary/20 text-primary hover:bg-primary/5 transition-all">
                    Lihat Profil
                </button>
            </div>
        </div>
        <div class="hidden md:block relative">
            <div class="absolute -top-10 -right-10 w-64 h-64 bg-tertiary/10 rounded-full blur-3xl"></div>
            <div
                class="relative bg-white/40 backdrop-blur-xl border border-white/40 p-8 rounded-md shadow-2xl overflow-hidden group">
                <img alt="Student"
                    class="rounded-md w-full h-[400px] object-cover transition-transform duration-700 group-hover:scale-110"
                    data-alt="High school students in neat blue uniforms discussing a project with a tablet in a modern sunlit library setting"
                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuDSEccOsqSQv6m5MulAy7Nai2PfFp8lKz-h91phjw5wssfC3smtyVexwy_Ow0nA1lCuM9flw1DdmR5TWSyZs56dIUnjLILXGeLbVgzUYMBdbr92lwAbffStPJtyPaFd3V3r2pKQ0EXFGyaTQyEyuNcJZSRXnoXq4-Gj4GBP7y2IVSJzdlYAUNiN98WWyFnuIsXNWm6MhtTjqoL15p0HF3SLiAny79rJ4rHIpXdFO6715mKQpwPbm-23nCXeX4Gazj3SDdeAZCs6jtf8" />
                <div
                    class="absolute bottom-12 left-12 right-12 bg-primary-container/90 backdrop-blur-lg p-6 rounded-md text-on-primary-container">
                    <p class="text-sm uppercase tracking-widest font-bold opacity-80 mb-2">Success Story</p>
                    <p class="text-xl font-bold leading-tight">Mencetak 500+ Alumni di Universitas Terbaik Dunia</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-24 bg-surface">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-16 items-start">
            <div class="lg:col-span-1">
                <p class="text-tertiary font-bold text-sm tracking-[0.2em] uppercase mb-4">About SMAN Pintar</p>
                <h2 class="text-4xl font-black font-headline text-primary mb-6 leading-tight">Tradisi Keunggulan, Masa
                    Depan Gemilang</h2>
                <p class="text-secondary leading-relaxed mb-8">
                    Didirikan sebagai pusat inkubasi talenta terbaik di Provinsi Riau, SMAN Pintar menerapkan sistem
                    asrama terintegrasi yang fokus pada pembentukan karakter dan penguasaan sains teknologi.
                </p>
                <div class="flex items-center gap-4 p-4 bg-surface-container rounded-md">
                    <div
                        class="w-12 h-12 rounded-full primary-gradient flex items-center justify-center text-on-primary">
                        <span class="material-symbols-outlined">verified</span>
                    </div>
                    <div>
                        <p class="font-bold text-primary">Akreditasi A</p>
                        <p class="text-xs text-secondary">Sertifikasi Nasional & Internasional</p>
                    </div>
                </div>
            </div>
            <div class="lg:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div
                    class="p-8 bg-surface-container-lowest rounded-md shadow-sm hover:shadow-xl hover:-translate-y-2 transition-all duration-300">
                    <span class="material-symbols-outlined text-tertiary text-4xl mb-4">school</span>
                    <h3 class="text-xl font-bold text-primary mb-3">Kurikulum Adaptif</h3>
                    <p class="text-on-surface-variant text-sm leading-relaxed">Kurikulum yang memadukan standar nasional
                        dengan program persiapan olimpiade dan masuk PTN unggulan.</p>
                </div>
                <div
                    class="p-8 bg-surface-container-lowest rounded-md shadow-sm hover:shadow-xl hover:-translate-y-2 transition-all duration-300">
                    <span class="material-symbols-outlined text-tertiary text-4xl mb-4">home</span>
                    <h3 class="text-xl font-bold text-primary mb-3">Sistem Boarding</h3>
                    <p class="text-on-surface-variant text-sm leading-relaxed">Lingkungan asrama yang aman dan kondusif
                        untuk mendukung pertumbuhan kemandirian dan spiritual siswa.</p>
                </div>
                <div
                    class="p-8 bg-surface-container-lowest rounded-md shadow-sm hover:shadow-xl hover:-translate-y-2 transition-all duration-300">
                    <div class="flex items-center justify-between mb-4">
                        <span class="material-symbols-outlined text-tertiary text-4xl">emoji_events</span>
                        <span
                            class="px-3 py-1 bg-tertiary-container/20 text-on-tertiary-container rounded-full text-[10px] font-bold uppercase">Prestasi</span>
                    </div>
                    <h3 class="text-xl font-bold text-primary mb-3">Pembinaan Intensif</h3>
                    <p class="text-on-surface-variant text-sm leading-relaxed">Program bimbingan khusus untuk lomba
                        akademik dan non-akademik di tingkat provinsi hingga internasional.</p>
                </div>
                <div
                    class="p-8 bg-surface-container-lowest rounded-md shadow-sm hover:shadow-xl hover:-translate-y-2 transition-all duration-300">
                    <span class="material-symbols-outlined text-tertiary text-4xl mb-4">groups</span>
                    <h3 class="text-xl font-bold text-primary mb-3">Alumni Network</h3>
                    <p class="text-on-surface-variant text-sm leading-relaxed">Jaringan alumni luas yang tersebar di
                        berbagai sektor profesional dan perguruan tinggi bergengsi.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-24 bg-surface-container-low">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center max-w-2xl mx-auto mb-16">
            <h2 class="text-4xl font-black font-headline text-primary mb-4">Fasilitas & Ekosistem</h2>
            <p class="text-secondary">Kami menyediakan infrastruktur kelas dunia untuk mendukung setiap langkah
                eksplorasi siswa.</p>
        </div>
        <div class="grid grid-cols-12 gap-6 h-auto md:h-[600px]">
            <div
                class="col-span-12 md:col-span-6 bg-surface-container-lowest rounded-md overflow-hidden relative group">
                <img alt="Library"
                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                    data-alt="Wide shot of a modern school library with minimalist wooden shelves and contemporary seating areas"
                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuD417E3dgIUxQGWqRCoqdXqxu8yR4a30EnLqcC9rIDImv3s0LE6a8tkHH60K9VKoEjmn4Am3tWOqh9jp8EZJdt9-saTV9Z7N1azsnBw36gtoMMIgPMZOtugkLboFU69n3QwrntuGihtM_Lizgvo84XzLNwIYK8fqB0q8bldWxcbtE_IKg7byygsjFzQg40FdYiCRV7eezm4Dlqbzc9Ks19xtlvvZ966NB8fe-4Hgt3En2C9rImVzmR180hnRhoO-bFo3Vl-ykkxSQp0" />
                <div
                    class="absolute inset-0 bg-gradient-to-t from-primary/90 via-primary/20 to-transparent p-10 flex flex-col justify-end">
                    <span class="material-symbols-outlined text-tertiary-fixed text-4xl mb-4"
                        data-weight="fill">local_library</span>
                    <h3 class="text-2xl font-bold text-white mb-2">Perpustakaan Digital</h3>
                    <p class="text-white/80 max-w-md">Akses ke ribuan jurnal internasional dan koleksi buku fisik
                        terlengkap di Riau.</p>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 grid grid-cols-2 grid-rows-2 gap-6">
                <div
                    class="bg-surface-container-lowest p-8 rounded-md shadow-sm flex flex-col justify-between border-t-4 border-tertiary">
                    <span class="material-symbols-outlined text-primary text-3xl">science</span>
                    <div>
                        <h4 class="font-bold text-primary text-lg mb-1">Lab Terpadu</h4>
                        <p class="text-xs text-secondary leading-relaxed">Fisika, Kimia, Biologi, dan Lab Komputer
                            terbaru.</p>
                    </div>
                </div>
                <div
                    class="bg-primary-container p-8 rounded-md shadow-sm flex flex-col justify-between text-on-primary-container">
                    <span class="material-symbols-outlined text-3xl">apartment</span>
                    <div>
                        <h4 class="font-bold text-lg mb-1">Asrama Modern</h4>
                        <p class="text-xs opacity-80 leading-relaxed">Kamar yang nyaman dengan pengawasan 24 jam.</p>
                    </div>
                </div>
                <div class="col-span-2 bg-surface-container-lowest p-8 rounded-md shadow-sm flex items-center gap-6">
                    <div class="w-20 h-20 rounded-md overflow-hidden flex-shrink-0">
                        <img alt="Sports" class="w-full h-full object-cover"
                            data-alt="Outdoor athletic track and sports field at a modern school campus"
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuBfpUQT7Bp-kRATE-a2hTWVD1CZNqGsxKdLz2LnbrR0DZju1OCziqPYz4b--UT5MeSSdMre87oIxJcXRAmEFpg8IYMlyCuugv_oi05yiTMNpCLkr-051IYwXmARPFsmzFwrFCziV8iOldqF6MHM3hejCgIQWTEg4IXFNxNWmwvjwQtpNATFtnvnbtob2WRTetjrZT9h22QyjGkl8yP22GL7GI9a2OrfgPk15GRyHzsKv24X2wTqqBPln8WX81gHYUGqCRIwI4fHFY1d" />
                    </div>
                    <div>
                        <h4 class="font-bold text-primary text-lg mb-1">Sport Center</h4>
                        <p class="text-sm text-secondary">Lapangan basket indoor, futsal, dan area atletik standar
                            nasional.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-24">
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex justify-between items-end mb-12">
            <div>
                <h2 class="text-4xl font-black font-headline text-primary leading-tight">Warta SMAN Pintar</h2>
                <p class="text-secondary mt-2">Update terbaru seputar kegiatan dan prestasi sekolah.</p>
            </div>
            <button class="flex items-center gap-2 text-primary font-bold hover:gap-4 transition-all">
                Semua Berita <span class="material-symbols-outlined">trending_flat</span>
            </button>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div
                class="group bg-surface-container-lowest rounded-md overflow-hidden shadow-sm hover:shadow-2xl transition-all border border-outline-variant/10">
                <div class="h-56 overflow-hidden">
                    <img alt="News"
                        class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                        data-alt="Students participating in a chemistry experiment in a professional laboratory setting"
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuAUSqq79Uw_F-kdwXiJyOEP54AMX5t94IDTF9iVSXlu5ZE84GXdTQL5-bp-VqtOqm-W51p5Se_xxjWGRbu9UJLxwk6d11z3HF2_py9UKO5L_0vt78jQXJz_lMAcS78Lkvjba-_lCrL5eZLY_lvjMZIaBjnDLZKrZdn3GmwNBWpfeQzR-gPu5mSkTuatXeW5SBJ4tAVFRAZCWIdnBjdFLEDMxuT1zg5wQG_AnkMtNVZFQclNLVPjCWvKoJk36vMmagZzbWSiDSAMjPnU" />
                </div>
                <div class="p-8">
                    <div class="flex gap-4 text-[10px] font-bold uppercase tracking-widest text-tertiary mb-4">
                        <span>Achievement</span>
                        <span class="text-outline">12 OKT 2024</span>
                    </div>
                    <h3
                        class="text-xl font-bold text-primary mb-3 leading-tight group-hover:text-primary-container transition-colors">
                        Juara Umum Olimpiade Sains Nasional Tingkat Provinsi</h3>
                    <p class="text-sm text-on-surface-variant line-clamp-2">Siswa SMAN Pintar kembali mendominasi
                        perolehan medali emas di ajang OSN-P tahun ini...</p>
                </div>
            </div>
            <div
                class="group bg-surface-container-lowest rounded-md overflow-hidden shadow-sm hover:shadow-2xl transition-all border border-outline-variant/10">
                <div class="h-56 overflow-hidden">
                    <img alt="News"
                        class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                        data-alt="Outdoor school graduation ceremony with white tents and students in robes"
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuA921XS1EXmt-rt8rWuoOpEmgepKZNV_06eWQ3RjeqJKmJEWfC_ZCTNrRZziyes2Ez04dKGH9coEx3IvjC9iXrF91VA89Pq8FJMuEQJ_QYtVi9mhQ37xjXAKxPRQSSkPJDtg2EJWSN9ICz_tRB2n5d1SkbcNHn6ylScw__-fV7SX2s_F2QvkLv5HH6u_MEtKgwrD12IPbYbSfkHnVD0gehJL5JM-h2hUMyeKCkeR_Eolz5NKNDuzk0fBT_0a28E15OFT4gsYevprhqh" />
                </div>
                <div class="p-8">
                    <div class="flex gap-4 text-[10px] font-bold uppercase tracking-widest text-tertiary mb-4">
                        <span>Admissions</span>
                        <span class="text-outline">05 OKT 2024</span>
                    </div>
                    <h3
                        class="text-xl font-bold text-primary mb-3 leading-tight group-hover:text-primary-container transition-colors">
                        Pembukaan Pendaftaran Siswa Baru Tahun Ajaran 2025/2026</h3>
                    <p class="text-sm text-on-surface-variant line-clamp-2">Persiapkan diri Anda untuk bergabung dengan
                        komunitas belajar terbaik di Riau melalui jalur PMB...</p>
                </div>
            </div>
            <div
                class="group bg-surface-container-lowest rounded-md overflow-hidden shadow-sm hover:shadow-2xl transition-all border border-outline-variant/10">
                <div class="h-56 overflow-hidden">
                    <img alt="News"
                        class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                        data-alt="Close-up of students coding on laptops in a modern tech-integrated classroom"
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuAamPer1RTwUb5JKNYwruLN38BuIhf2RioRmZ7THin5mX3h94GsHVcm3MwASpdVyJK_fMlYZWtbns2v9HvTpoO0quoiPwfHIVeWK7sfnCr7v4RlC9n3MFT_QNasBevgKxBwLxBr_qCo93zr_2FeLr7Hup70PNb4vtviwgJAS707qBmoD6ZbqGpKe5YUlyrSx7DzCUpLvaTOWnqmTvT6ZrrRlo7LDD-kLW6bbhOFTjNKgvTbR4j23ul2d9yw039uwvH7OFYaNHquhZkU" />
                </div>
                <div class="p-8">
                    <div class="flex gap-4 text-[10px] font-bold uppercase tracking-widest text-tertiary mb-4">
                        <span>Innovation</span>
                        <span class="text-outline">28 SEP 2024</span>
                    </div>
                    <h3
                        class="text-xl font-bold text-primary mb-3 leading-tight group-hover:text-primary-container transition-colors">
                        Implementasi Smart Classroom untuk Pembelajaran Masa Depan</h3>
                    <p class="text-sm text-on-surface-variant line-clamp-2">Penerapan teknologi IoT dan AI dalam sistem
                        pengajaran harian untuk meningkatkan interaktivitas...</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-24 px-6">
    <div class="max-w-7xl mx-auto primary-gradient rounded-md overflow-hidden shadow-2xl relative">
        <div class="absolute top-0 right-0 w-1/3 h-full opacity-10 pointer-events-none">
            <svg class="w-full h-full" preserveaspectratio="none" viewbox="0 0 100 100">
                <path d="M0 100 L100 0 L100 100 Z" fill="white"></path>
            </svg>
        </div>
        <div class="relative z-10 p-12 md:p-20 flex flex-col md:flex-row items-center justify-between gap-12">
            <div class="max-w-2xl text-center md:text-left">
                <h2 class="text-4xl md:text-5xl font-black font-headline text-white mb-6 leading-tight">Siap Menjadi
                    Bagian dari SMAN Pintar?</h2>
                <p class="text-on-primary-container text-lg mb-8 leading-relaxed">
                    Jangan lewatkan kesempatan untuk berkembang di lingkungan akademik yang prestisius. Pendaftaran
                    Mahasiswa Baru (PMB) telah dibuka secara online.
                </p>
                <div class="flex flex-wrap gap-4 justify-center md:justify-start">
                    <button
                        class="bg-tertiary-fixed text-on-tertiary-fixed px-10 py-4 rounded-md font-bold text-lg hover:bg-tertiary-fixed-dim transition-colors shadow-lg">
                        Daftar Sekarang
                    </button>
                    <button
                        class="border border-white/30 text-white px-10 py-4 rounded-md font-bold text-lg hover:bg-white/10 transition-colors">
                        Panduan Pendaftaran
                    </button>
                </div>
            </div>
            <div class="bg-white/10 backdrop-blur-md p-10 rounded-md border border-white/20 text-white text-center">
                <div class="text-5xl font-black mb-2">2025</div>
                <div class="text-sm font-bold uppercase tracking-widest opacity-80">Batch Admission</div>
                <div class="mt-6 pt-6 border-t border-white/20">
                    <p class="text-xs opacity-60">Pendaftaran Berakhir Dalam</p>
                    <div class="flex gap-4 mt-2 justify-center font-headline font-bold text-2xl">
                        <div>14<span class="block text-[10px] opacity-60">HARI</span></div>
                        <div>:</div>
                        <div>08<span class="block text-[10px] opacity-60">JAM</span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-24 bg-surface-container">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-16">
            <p class="text-tertiary font-bold text-sm tracking-[0.2em] uppercase mb-4">Our Alumni</p>
            <h2 class="text-4xl font-black font-headline text-primary">Jejak Langkah Kesuksesan</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <div class="bg-surface-container-lowest p-10 rounded-md shadow-sm border-b-4 border-tertiary">
                <div class="flex items-center gap-4 mb-6">
                    <img alt="Alumni" class="w-16 h-16 rounded-full object-cover border-4 border-surface-container"
                        data-alt="Headshot of a confident young man in business attire, smiling warmly against a soft corporate background"
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuA3kk9jqHFB1bwe8T3UOsjV_sL3xqb9csJjS7ZD042fBVAd2C1XKZenZBSonVAEJQXtXFX6FPYkhv92fLkf3eqw7AaNz8GNPmtR2-0doASR5iHvDVsWGACZ5nWxtWJYwrtdkY5KSU9Fep_xYRvUYHdY3VKWQYaeQK8KPqjTMdUEFfLQsYOxTZ43UAzhLiSN3UVZ-ggTeMHgzGk7766ySmdXXbBjNuP6slDcPj4zsZS8EwjyvcBA3qhVsN3P0r8IjwZ9XheX4N25zYYQ" />
                    <div>
                        <h4 class="font-bold text-primary">Andi Pratama</h4>
                        <p class="text-xs text-secondary">Alumni 2018 | Software Eng. at Google</p>
                    </div>
                </div>
                <p class="text-on-surface-variant italic leading-relaxed">"SMAN Pintar membentuk pola pikir disiplin dan
                    haus akan inovasi. Asrama bukan sekadar tempat tinggal, tapi kawah candradimuka karakter saya."</p>
            </div>
            <div class="bg-surface-container-lowest p-10 rounded-md shadow-sm border-b-4 border-primary">
                <div class="flex items-center gap-4 mb-6">
                    <img alt="Alumni" class="w-16 h-16 rounded-full object-cover border-4 border-surface-container"
                        data-alt="Professional headshot of a young woman in medical scrubs, looking professional and approachable"
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuDKhXHy5hryYU9MCHluozu-pOKNDjvHQJT-K4LU3ia3aaXMpygJDF9C1RygaR4Q8XTXay8Od4OwxiTvBXV83BLYssbskUffxncJBIqm9R4MeSbzRCf2Xa-Z3rR7UJP0QSV5azuChueqhM9trjZhSa3E5glt6LnDgXTOoKQdBIEdsUzCNkUFezQG87OowG4tzMaWssKhW3r-B9PYL_DGavqzEH0JUhahZBEVOonGuWqGfoT926GJ_KzKKOP0tGrdpCqYj_D7eRym7rUF" />
                    <div>
                        <h4 class="font-bold text-primary">Siti Aminah</h4>
                        <p class="text-xs text-secondary">Alumni 2016 | Resident Physician, UI</p>
                    </div>
                </div>
                <p class="text-on-surface-variant italic leading-relaxed">"Program pembinaan olimpiade di sini sangat
                    luar biasa. Guru-guru tidak hanya mengajar, tapi juga menjadi mentor hidup yang peduli."</p>
            </div>
            <div class="bg-surface-container-lowest p-10 rounded-md shadow-sm border-b-4 border-tertiary">
                <div class="flex items-center gap-4 mb-6">
                    <img alt="Alumni" class="w-16 h-16 rounded-full object-cover border-4 border-surface-container"
                        data-alt="Friendly young professional man in a casual smart shirt, standing in a bright office environment"
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuDrxGc1ESv5GG4x9fOzsSSCewiWDzPCi0RNtl2iTjTh7MmmOMSmgShBkF4TolZa1NACK30-IUJOFHSJlgrOaoLVlMlkPpeBptH50apT4q1tJdPs9mwaqhyyqMS5dUds_v5D_KARvID49kzTEQoBeZiM1dcaYsknZDvOoDaSAZu3lAIcK7TVbvW-1iesMBVedd53KCbfJowrROVLGpdH1RtSdf3NUZva3yz-UWvxDgcfCVYqOZdNpSAZ0oOVylCGruHx_LavQCL_rEWW" />
                    <div>
                        <h4 class="font-bold text-primary">Budi Santoso</h4>
                        <p class="text-xs text-secondary">Alumni 2020 | LPDP Scholar at Oxford</p>
                    </div>
                </div>
                <p class="text-on-surface-variant italic leading-relaxed">"Visi sekolah untuk mencetak pemimpin masa
                    depan benar-benar terasa dalam setiap kurikulumnya. Saya bangga menjadi bagian dari keluarga besar
                    ini."</p>
            </div>
        </div>
    </div>
</section>
@endsection