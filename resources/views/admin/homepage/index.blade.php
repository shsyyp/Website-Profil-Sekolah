@extends('layouts.admin')

@section('title', 'CMS Beranda - SMAN Pintar')

@section('content')
<form action="{{ url('admin/homepage') }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-12">
    @csrf

    @if(session('success'))
    <div
        class="bg-emerald-50 text-emerald-600 p-4 rounded-xl font-bold flex items-center gap-2 mb-6 shadow-sm border border-emerald-100">
        <span class="material-symbols-outlined">check_circle</span>
        {{ session('success') }}
    </div>
    @endif

    {{-- Section 1: Hero --}}
    <section class="space-y-6">
        <div class="flex justify-between items-end">
            <div>
                <span class="text-xs font-bold text-tertiary uppercase tracking-widest mb-1 block">Component 01</span>
                <h3 class="text-3xl font-headline font-extrabold text-primary">Hero Section</h3>
            </div>
            <button type="submit"
                class="bg-gradient-to-br from-[#00357f] to-[#004aad] text-white px-6 py-2.5 rounded-xl font-bold text-sm shadow-lg hover:scale-[1.02] active:scale-95 transition-all">
                Save Changes
            </button>
        </div>

        <div class="grid grid-cols-12 gap-8">
            <div class="col-span-12 lg:col-span-7 space-y-6">
                <div class="bg-surface-container-lowest p-8 rounded-2xl shadow-sm space-y-6">
                    <div class="grid grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-xs font-bold text-slate-500 uppercase tracking-tighter">Site Name</label>
                            <input name="site_name"
                                class="w-full bg-surface-container-low border-none focus:ring-2 focus:ring-primary rounded-xl px-4 py-3 font-medium text-on-surface"
                                type="text" value="{{ $homepage->site_name ?? 'SMAN Pintar' }}" />
                        </div>
                        <div class="space-y-2">
                            <label class="text-xs font-bold text-slate-500 uppercase tracking-tighter">Login Button</label>
                            <input name="login_button_text"
                                class="w-full bg-surface-container-low border-none focus:ring-2 focus:ring-primary rounded-xl px-4 py-3 font-medium text-on-surface"
                                type="text" value="{{ $homepage->login_button_text ?? 'Login Admin' }}" />
                        </div>
                        <div class="space-y-2">
                            <label class="text-xs font-bold text-slate-500 uppercase tracking-tighter">Small
                                Label</label>
                            <input name="hero_label"
                                class="w-full bg-surface-container-low border-none focus:ring-2 focus:ring-primary rounded-xl px-4 py-3 font-medium text-on-surface"
                                type="text" value="{{ $homepage->hero_label ?? 'Provinsi Riau' }}" />
                        </div>
                        <div class="space-y-2">
                            <label class="text-xs font-bold text-slate-500 uppercase tracking-tighter">Success Story
                                Title</label>
                            <input name="success_title"
                                class="w-full bg-surface-container-low border-none focus:ring-2 focus:ring-primary rounded-xl px-4 py-3 font-medium text-on-surface"
                                type="text" value="{{ $homepage->success_title ?? 'Mencetak 500+ Alumni di Universitas Terbaik Dunia' }}" />
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-slate-500 uppercase tracking-tighter">Success Story
                            Description</label>
                        <textarea name="success_desc"
                            class="w-full bg-surface-container-low border-none focus:ring-2 focus:ring-primary rounded-xl px-4 py-3 text-on-surface-variant leading-relaxed"
                            rows="2">{{ $homepage->success_desc ?? 'Cerita sukses siswa dan alumni SMAN Pintar Provinsi Riau.' }}</textarea>
                    </div>
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-slate-500 uppercase tracking-tighter">Main Title</label>
                        <textarea name="hero_title"
                            class="w-full bg-surface-container-low border-none focus:ring-2 focus:ring-primary rounded-xl px-4 py-3 font-bold text-xl text-primary leading-tight"
                            rows="2">{{ $homepage->hero_title ?? 'Membentuk Generasi Unggul Berkarakter & Berdaya Saing Global' }}</textarea>
                    </div>
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-slate-500 uppercase tracking-tighter">Subtitle</label>
                        <textarea name="hero_subtitle"
                            class="w-full bg-surface-container-low border-none focus:ring-2 focus:ring-primary rounded-xl px-4 py-3 text-on-surface-variant leading-relaxed"
                            rows="3">{{ $homepage->hero_subtitle ?? 'Pusat pendidikan menengah terbaik di Provinsi Riau.' }}</textarea>
                    </div>
                    <div class="grid grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-xs font-bold text-slate-500 uppercase tracking-tighter">Button 1 Text &
                                Link</label>
                            <div class="flex gap-2">
                                <input name="hero_button1_text"
                                    class="flex-1 bg-surface-container-low border-none focus:ring-2 focus:ring-primary rounded-xl px-4 py-2 text-sm"
                                    type="text" value="{{ $homepage->hero_button1_text ?? 'Mulai Daftar' }}" />
                                <input name="hero_button1_link"
                                    class="w-24 bg-surface-container-low border-none focus:ring-2 focus:ring-primary rounded-xl px-4 py-2 text-sm text-slate-400"
                                    type="text" value="{{ $homepage->hero_button1_link ?? '/pmb' }}" />
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label class="text-xs font-bold text-slate-500 uppercase tracking-tighter">Button 2 Text &
                                Link</label>
                            <div class="flex gap-2">
                                <input name="hero_button2_text"
                                    class="flex-1 bg-surface-container-low border-none focus:ring-2 focus:ring-primary rounded-xl px-4 py-2 text-sm"
                                    type="text" value="{{ $homepage->hero_button2_text ?? 'Tentang Kami' }}" />
                                <input name="hero_button2_link"
                                    class="w-24 bg-surface-container-low border-none focus:ring-2 focus:ring-primary rounded-xl px-4 py-2 text-sm text-slate-400"
                                    type="text" value="{{ $homepage->hero_button2_link ?? '/about' }}" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-span-12 lg:col-span-5 space-y-6">
                <div
                    class="relative group h-[420px] rounded-2xl overflow-hidden bg-slate-200 border-4 border-white shadow-xl">
                    <img class="w-full h-full object-cover"
                        src="{{ $homepage->hero_image ? asset('storage/'.$homepage->hero_image) : 'https://lh3.googleusercontent.com/aida-public/AB6AXuC4oiXy_ZGxrC-CdAJ_E1oRCE9oH6xoDMFgA-gaGDsLdbdftaQu5ODBiA7VwHQqugcJTXn_gxDgRyUe32juEQUjJPcwkPS9BPJIR0QMkdkIKJsZF91VYCpXF6WNRsk8D9ltN1F72XysomzR1L9iMFgDbeM-TbX0ZdkyM1HLqAactkXBPLXmQbUFjls5C6vqTiPBZZOwaI01eAb-ia3atja9sU_GLD59jb9IpUPCYKt_Bj7gCQRD738g192USO2vfjfDg6bc4FdlOGia' }}" />
                    <div class="absolute inset-0 bg-primary/20 group-hover:bg-primary/10 transition-all"></div>
                    <div
                        class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                        <label
                            class="bg-white/90 cursor-pointer px-6 py-3 rounded-full shadow-2xl font-bold text-primary flex items-center gap-2 hover:bg-white active:scale-95 transition-all">
                            <span class="material-symbols-outlined">image</span>
                            Replace Hero Image
                            <input name="hero_image" type="file" class="hidden" />
                        </label>
                    </div>
                </div>
                <div class="bg-tertiary-container/10 p-4 rounded-xl border-l-4 border-tertiary">
                    <p class="text-xs text-on-tertiary-container leading-relaxed">
                        <strong>Tips:</strong> Gunakan gambar landscape kualitas tinggi agar tampilan Hero maksimal.
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- Section 2: Tradisi --}}
    <section class="space-y-8">
        <div class="border-t border-slate-100 pt-12">
            <h3 class="text-3xl font-headline font-extrabold text-primary">Tradisi Keunggulan</h3>
        </div>
        <div class="bg-surface-container-low p-8 rounded-3xl space-y-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <input name="about_label" class="bg-surface-container-lowest border-none rounded-xl px-4 py-3 font-bold"
                    placeholder="Label section" value="{{ $homepage->about_label ?? 'About SMAN Pintar' }}">
                <input name="about_title" class="bg-surface-container-lowest border-none rounded-xl px-4 py-3 font-bold"
                    placeholder="Judul section" value="{{ $homepage->about_title ?? 'Tradisi Keunggulan, Masa Depan Gemilang' }}">
                <textarea name="about_desc"
                    class="md:col-span-2 bg-surface-container-lowest border-none rounded-xl px-4 py-3"
                    rows="3" placeholder="Deskripsi tentang sekolah">{{ $homepage->about_desc ?? 'Didirikan sebagai pusat inkubasi talenta terbaik di Provinsi Riau, SMAN Pintar menerapkan sistem asrama terintegrasi yang fokus pada pembentukan karakter dan penguasaan sains teknologi.' }}</textarea>
                <input name="accreditation_title"
                    class="bg-surface-container-lowest border-none rounded-xl px-4 py-3 font-bold"
                    placeholder="Judul akreditasi" value="{{ $homepage->accreditation_title ?? 'Akreditasi A' }}">
                <input name="accreditation_desc"
                    class="bg-surface-container-lowest border-none rounded-xl px-4 py-3"
                    placeholder="Deskripsi akreditasi" value="{{ $homepage->accreditation_desc ?? 'Sertifikasi Nasional & Internasional' }}">
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">
                @for ($i = 0; $i < 4; $i++) <div
                    class="bg-surface-container-lowest p-6 rounded-2xl shadow-sm border border-slate-50 space-y-4">
                    <input name="tradisi[{{$i}}][title]"
                        class="w-full border-none p-0 focus:ring-0 font-bold text-primary bg-transparent text-lg"
                        type="text"
                        value="{{ data_get($homepage->tradisi, $i.'.title') ?? ($i == 0 ? 'Kurikulum' : ($i == 1 ? 'Boarding' : ($i == 2 ? 'Pembinaan' : 'Alumni'))) }}" />
                    <textarea name="tradisi[{{$i}}][desc]"
                        class="w-full border-none p-0 focus:ring-0 text-xs text-on-surface-variant bg-transparent resize-none"
                        rows="4">{{ data_get($homepage->tradisi, $i.'.desc') ?? 'Deskripsi konten keunggulan di sini...' }}</textarea>
            </div>
            @endfor
        </div>
        </div>
    </section>

    {{-- Section 3: Extra Settings --}}
    <section class="space-y-8">
        <div class="border-t border-slate-100 pt-12">
            <h3 class="text-3xl font-headline font-extrabold text-primary">Fasilitas & Ekosistem</h3>
        </div>
        <div class="bg-surface-container-low p-8 rounded-3xl space-y-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <input name="facilities_title"
                    class="bg-surface-container-lowest border-none rounded-xl px-4 py-3 font-bold"
                    placeholder="Judul fasilitas" value="{{ $homepage->facilities_title ?? 'Fasilitas & Ekosistem' }}">
                <textarea name="facilities_subtitle"
                    class="bg-surface-container-lowest border-none rounded-xl px-4 py-3 md:row-span-2"
                    rows="3" placeholder="Subjudul fasilitas">{{ $homepage->facilities_subtitle ?? 'Kami menyediakan infrastruktur terbaik untuk mendukung setiap langkah eksplorasi siswa.' }}</textarea>
                <div class="space-y-2">
                    <label class="text-xs font-bold text-slate-500 uppercase tracking-tighter">Gambar Fasilitas Utama</label>
                    <input name="facility_main_image" type="file"
                        class="w-full bg-surface-container-lowest border-none rounded-xl px-4 py-3">
                </div>
                <div class="space-y-2">
                    <label class="text-xs font-bold text-slate-500 uppercase tracking-tighter">Gambar Fasilitas Kecil</label>
                    <input name="facility_side_image" type="file"
                        class="w-full bg-surface-container-lowest border-none rounded-xl px-4 py-3">
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">
                @php
                $defaultFasilitas = [
                ['icon' => 'local_library', 'title' => 'Perpustakaan Digital', 'desc' => 'Akses ke ribuan jurnal internasional dan koleksi buku fisik terlengkap di Riau.'],
                ['icon' => 'science', 'title' => 'Lab Terpadu', 'desc' => 'Fisika, Kimia, Biologi, dan Lab Komputer terbaru.'],
                ['icon' => 'apartment', 'title' => 'Asrama Modern', 'desc' => 'Kamar yang nyaman dengan pengawasan 24 jam.'],
                ['icon' => 'sports_basketball', 'title' => 'Sport Center', 'desc' => 'Lapangan basket indoor, futsal, dan area atletik standar nasional.'],
                ];
                @endphp

                @for ($i = 0; $i < 4; $i++)
                <div class="bg-surface-container-lowest p-6 rounded-2xl shadow-sm border border-slate-50 space-y-4">
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-slate-500 uppercase tracking-tighter">Icon</label>
                        <input name="fasilitas[{{$i}}][icon]"
                            class="w-full border-none focus:ring-2 focus:ring-primary rounded-xl px-4 py-2 bg-surface-container-low text-sm"
                            type="text"
                            value="{{ data_get($homepage->fasilitas, $i.'.icon') ?? $defaultFasilitas[$i]['icon'] }}" />
                    </div>
                    <input name="fasilitas[{{$i}}][title]"
                        class="w-full border-none p-0 focus:ring-0 font-bold text-primary bg-transparent text-lg"
                        type="text"
                        value="{{ data_get($homepage->fasilitas, $i.'.title') ?? $defaultFasilitas[$i]['title'] }}" />
                    <textarea name="fasilitas[{{$i}}][desc]"
                        class="w-full border-none p-0 focus:ring-0 text-xs text-on-surface-variant bg-transparent resize-none"
                        rows="4">{{ data_get($homepage->fasilitas, $i.'.desc') ?? $defaultFasilitas[$i]['desc'] }}</textarea>
                </div>
                @endfor
            </div>
        </div>
    </section>

    {{-- Section 4: Extra Settings --}}
    <section class="space-y-8">
        <div class="border-t border-slate-100 pt-12">
            <h3 class="text-3xl font-headline font-extrabold text-primary">Pengaturan Tambahan</h3>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

            <div class="md:col-span-2 bg-surface-container-lowest p-8 rounded-2xl shadow-sm space-y-6">
                <h4 class="text-xl font-bold text-on-surface">Warta & Alumni Section</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <input name="news_title" class="bg-surface-container-low border-none rounded-xl px-4 py-3 font-bold"
                        placeholder="Judul berita" value="{{ $homepage->news_title ?? 'Warta SMAN Pintar' }}">
                    <input name="news_button_text" class="bg-surface-container-low border-none rounded-xl px-4 py-3"
                        placeholder="Teks tombol berita" value="{{ $homepage->news_button_text ?? 'Semua Berita' }}">
                    <textarea name="news_subtitle"
                        class="bg-surface-container-low border-none rounded-xl px-4 py-3 md:col-span-2"
                        rows="2" placeholder="Subjudul berita">{{ $homepage->news_subtitle ?? 'Update terbaru seputar kegiatan dan prestasi sekolah.' }}</textarea>
                    <input name="alumni_label" class="bg-surface-container-low border-none rounded-xl px-4 py-3"
                        placeholder="Label alumni" value="{{ $homepage->alumni_label ?? 'Our Alumni' }}">
                    <input name="alumni_title" class="bg-surface-container-low border-none rounded-xl px-4 py-3 font-bold"
                        placeholder="Judul alumni" value="{{ $homepage->alumni_title ?? 'Jejak Langkah Kesuksesan' }}">
                </div>
            </div>

            <div class="bg-surface-container-lowest p-8 rounded-2xl shadow-sm space-y-6">
                <h4 class="text-xl font-bold text-on-surface">Limit Berita</h4>
                <select name="news_limit"
                    class="w-full bg-surface-container-low border-none rounded-xl px-4 py-3 font-medium">
                    <option value="3" {{ ($homepage->news_limit ?? 3) == 3 ? 'selected' : '' }}>3 Items (Rekomendasi)
                    </option>
                    <option value="4" {{ ($homepage->news_limit ?? 3) == 4 ? 'selected' : '' }}>4 Items</option>
                    <option value="6" {{ ($homepage->news_limit ?? 3) == 6 ? 'selected' : '' }}>6 Items</option>
                </select>
            </div>

            <div class="bg-surface-container-lowest p-8 rounded-2xl shadow-sm space-y-6">
                <h4 class="text-xl font-bold text-on-surface">Featured Alumni</h4>
                <select name="featured_alumni_id"
                    class="w-full bg-surface-container-low border-none rounded-xl px-4 py-3 font-medium">
                    <option value="">Pilih Alumni untuk Highlight</option>
                    @foreach ($alumni as $item)
                    <option value="{{ $item->id }}"
                        {{ ($homepage->featured_alumni_id ?? '') == $item->id ? 'selected' : '' }}>
                        {{ $item->nama }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="md:col-span-2 bg-surface-container-lowest p-8 rounded-2xl shadow-sm space-y-6">
                <h4 class="text-xl font-bold text-on-surface">CTA PMB Section</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <input name="cta_title" class="bg-surface-container-low border-none rounded-xl px-4 py-3 font-bold"
                        placeholder="Judul CTA" value="{{ $homepage->cta_title ?? 'Jadilah Bagian dari SMAN Pintar' }}">
                    <input name="cta_year" class="bg-surface-container-low border-none rounded-xl px-4 py-3"
                        placeholder="Tahun" value="{{ $homepage->cta_year ?? '2025' }}">
                    <input name="cta_button" class="bg-surface-container-low border-none rounded-xl px-4 py-3"
                        placeholder="Teks Tombol" value="{{ $homepage->cta_button ?? 'Daftar Sekarang' }}">
                    <input name="cta_secondary_button" class="bg-surface-container-low border-none rounded-xl px-4 py-3"
                        placeholder="Teks Tombol Kedua" value="{{ $homepage->cta_secondary_button ?? 'Panduan Pendaftaran' }}">
                    <input name="cta_secondary_link" class="bg-surface-container-low border-none rounded-xl px-4 py-3"
                        placeholder="Link Tombol Kedua" value="{{ $homepage->cta_secondary_link ?? route('pmb') }}">
                    <input name="cta_badge" class="bg-surface-container-low border-none rounded-xl px-4 py-3"
                        placeholder="Label tahun" value="{{ $homepage->cta_badge ?? 'Batch Admission' }}">
                    <input name="cta_deadline_label" class="bg-surface-container-low border-none rounded-xl px-4 py-3"
                        placeholder="Label countdown" value="{{ $homepage->cta_deadline_label ?? 'Pendaftaran Berakhir Dalam' }}">
                    <input name="cta_countdown_days" class="bg-surface-container-low border-none rounded-xl px-4 py-3"
                        placeholder="Hari" value="{{ $homepage->cta_countdown_days ?? '14' }}">
                    <input name="cta_countdown_hours" class="bg-surface-container-low border-none rounded-xl px-4 py-3"
                        placeholder="Jam" value="{{ $homepage->cta_countdown_hours ?? '08' }}">
                    <textarea name="cta_desc"
                        class="bg-surface-container-low border-none rounded-xl px-4 py-3 col-span-1 md:col-span-2"
                        placeholder="Deskripsi Singkat"
                        rows="3">{{ $homepage->cta_desc ?? 'Daftarkan diri Anda hari ini...' }}</textarea>
                </div>
            </div>

            <div class="md:col-span-2 bg-surface-container-lowest p-8 rounded-2xl shadow-sm space-y-6">
                <h4 class="text-xl font-bold text-on-surface">Footer Website</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <textarea name="footer_desc" class="bg-surface-container-low border-none rounded-xl px-4 py-3 md:col-span-2"
                        rows="2" placeholder="Deskripsi footer">{{ $homepage->footer_desc ?? 'Mewujudkan pendidikan menengah berkualitas dunia di bumi Lancang Kuning, Provinsi Riau.' }}</textarea>
                    <input name="footer_address" class="bg-surface-container-low border-none rounded-xl px-4 py-3"
                        placeholder="Alamat" value="{{ $homepage->footer_address ?? 'Jl. Pendidikan No. 01, Pekanbaru, Provinsi Riau' }}">
                    <input name="footer_phone" class="bg-surface-container-low border-none rounded-xl px-4 py-3"
                        placeholder="Telepon" value="{{ $homepage->footer_phone ?? '(0761) 1234567' }}">
                    <textarea name="newsletter_desc" class="bg-surface-container-low border-none rounded-xl px-4 py-3 md:col-span-2"
                        rows="2" placeholder="Deskripsi newsletter">{{ $homepage->newsletter_desc ?? 'Dapatkan info pendaftaran dan prestasi terbaru langsung di email Anda.' }}</textarea>
                    <input name="footer_copyright" class="bg-surface-container-low border-none rounded-xl px-4 py-3"
                        placeholder="Copyright" value="{{ $homepage->footer_copyright ?? 'SMAN Pintar. Excellence in Education.' }}">
                    <input name="footer_note" class="bg-surface-container-low border-none rounded-xl px-4 py-3"
                        placeholder="Catatan footer" value="{{ $homepage->footer_note ?? 'Made with Passion in Riau' }}">
                </div>
            </div>
        </div>
    </section>

</form>
@endsection
