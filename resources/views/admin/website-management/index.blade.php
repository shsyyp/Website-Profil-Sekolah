@extends('layouts.admin')

@section('title', 'Website Management - SMAN Pintar')

@section('content')
@php
$defaultAlumniStats = $alumniSetting->stats ?: [
    ['icon' => 'groups', 'value' => ($stats['totalAlumni'] ?? 0) . '+', 'label' => 'Total Alumni'],
    ['icon' => 'school', 'value' => '95%', 'label' => 'Lolos PTN'],
    ['icon' => 'work', 'value' => '30%', 'label' => 'Fortune 500'],
    ['icon' => 'public', 'value' => '1+', 'label' => 'Lokasi Alumni'],
];
$pmbTestimonials = $pmb->testimonials ?: [
    ['name' => 'Aura Nadira', 'meta' => 'Alumni Jalur Prestasi 2022', 'quote' => 'Proses seleksi PMB SMAN Pintar sangat transparan dan kompetitif.'],
    ['name' => 'Dimas Pratama', 'meta' => 'Siswa Kelas XII - Jalur Tes', 'quote' => 'SMAN Pintar bukan sekadar sekolah, tapi rumah kedua.'],
    ['name' => 'Siti Aminah', 'meta' => 'Siswa Kelas XI - Jalur Tahfidz', 'quote' => 'Sangat senang ada jalur khusus Tahfidz.'],
];
@endphp

<div class="p-8 max-w-6xl mx-auto w-full space-y-8">
    @if(session('success'))
    <div class="bg-emerald-50 text-emerald-600 p-4 rounded-xl font-bold flex items-center gap-2 border border-emerald-100">
        <span class="material-symbols-outlined">check_circle</span>{{ session('success') }}
    </div>
    @endif

    @if($errors->any())
    <div class="bg-red-50 text-error p-4 rounded-xl font-bold border border-red-100">{{ $errors->first() }}</div>
    @endif

    <section class="flex justify-between items-end gap-6">
        <div>
            <span class="text-xs font-bold text-tertiary uppercase tracking-widest mb-1 block">Centralized CMS</span>
            <h2 class="text-4xl font-headline font-extrabold text-primary tracking-tight">Website Management</h2>
            <p class="text-on-surface-variant mt-2">Kelola teks, gambar, CTA, dan section website dari satu halaman.</p>
        </div>
        <a href="{{ url('/') }}" target="_blank" class="px-6 py-3 rounded-xl text-primary font-bold text-sm border border-primary/20 hover:bg-primary/5 transition-all flex items-center gap-2">
            <span class="material-symbols-outlined">open_in_new</span>Lihat Website
        </a>
    </section>

    @if($activeSection === 'beranda')
    <div>
        <form action="{{ route('admin.website.homepage.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf
            <x-cms-card title="Hero Beranda" icon="vertical_split">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <input name="site_name" class="cms-input" value="{{ old('site_name', $homepage->site_name ?? 'SMAN Pintar') }}" placeholder="Nama situs">
                    <input name="hero_label" class="cms-input" value="{{ old('hero_label', $homepage->hero_label ?? 'Provinsi Riau') }}" placeholder="Label kecil">
                    <textarea name="hero_title" class="cms-input md:col-span-2 font-bold" rows="2" placeholder="Judul hero">{{ old('hero_title', $homepage->hero_title ?? '') }}</textarea>
                    <textarea name="hero_subtitle" class="cms-input md:col-span-2" rows="3" placeholder="Deskripsi hero">{{ old('hero_subtitle', $homepage->hero_subtitle ?? '') }}</textarea>
                    <input name="hero_button1_text" class="cms-input" value="{{ old('hero_button1_text', $homepage->hero_button1_text ?? 'Daftar Sekarang') }}" placeholder="Teks tombol utama">
                    <input name="hero_button1_link" class="cms-input" value="{{ old('hero_button1_link', $homepage->hero_button1_link ?? '/pmb') }}" placeholder="Link tombol utama">
                    <input name="hero_image" type="file" accept="image/*" class="cms-input md:col-span-2">
                </div>
            </x-cms-card>

            <x-cms-card title="Tradisi Keunggulan" icon="stars">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                    <input name="about_label" class="cms-input" value="{{ old('about_label', $homepage->about_label ?? 'About SMAN Pintar') }}" placeholder="Label section">
                    <input name="about_title" class="cms-input font-bold" value="{{ old('about_title', $homepage->about_title ?? '') }}" placeholder="Judul section">
                    <textarea name="about_desc" class="cms-input md:col-span-2" rows="3" placeholder="Deskripsi section">{{ old('about_desc', $homepage->about_desc ?? '') }}</textarea>
                    <input name="accreditation_title" class="cms-input" value="{{ old('accreditation_title', $homepage->accreditation_title ?? 'Akreditasi A') }}" placeholder="Judul akreditasi">
                    <input name="accreditation_desc" class="cms-input" value="{{ old('accreditation_desc', $homepage->accreditation_desc ?? '') }}" placeholder="Deskripsi akreditasi">
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    @foreach($homepage->highlights as $index => $highlight)
                    <div class="bg-surface-container-low p-4 rounded-xl space-y-3">
                        <input type="hidden" name="highlights[{{ $index }}][id]" value="{{ $highlight->id }}">
                        <input name="highlights[{{ $index }}][icon]" class="cms-input" value="{{ $highlight->icon }}" placeholder="Icon">
                        <input name="highlights[{{ $index }}][title]" class="cms-input font-bold" value="{{ $highlight->title }}" placeholder="Judul">
                        <textarea name="highlights[{{ $index }}][description]" class="cms-input" rows="2" placeholder="Deskripsi">{{ $highlight->description }}</textarea>
                        <label class="text-xs font-bold text-error flex gap-2"><input type="checkbox" name="highlights[{{ $index }}][delete]" value="1"> Hapus</label>
                    </div>
                    @endforeach
                    @php $newHighlightIndex = $homepage->highlights->count(); @endphp
                    <div class="bg-surface-container-low p-4 rounded-xl space-y-3 border border-dashed border-outline-variant">
                        <p class="text-xs font-bold text-tertiary uppercase">Tambah Highlight</p>
                        <input name="highlights[{{ $newHighlightIndex }}][icon]" class="cms-input" placeholder="Icon">
                        <input name="highlights[{{ $newHighlightIndex }}][title]" class="cms-input font-bold" placeholder="Judul">
                        <textarea name="highlights[{{ $newHighlightIndex }}][description]" class="cms-input" rows="2" placeholder="Deskripsi"></textarea>
                    </div>
                </div>
            </x-cms-card>

            <x-cms-card title="Fasilitas & CTA Beranda" icon="campaign">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <input name="facilities_title" class="cms-input font-bold" value="{{ old('facilities_title', $homepage->facilities_title ?? '') }}" placeholder="Judul fasilitas">
                    <textarea name="facilities_subtitle" class="cms-input" rows="2" placeholder="Subjudul fasilitas">{{ old('facilities_subtitle', $homepage->facilities_subtitle ?? '') }}</textarea>
                    <input name="cta_title" class="cms-input font-bold" value="{{ old('cta_title', $homepage->cta_title ?? '') }}" placeholder="Judul CTA">
                    <textarea name="cta_desc" class="cms-input" rows="2" placeholder="Deskripsi CTA">{{ old('cta_desc', $homepage->cta_desc ?? '') }}</textarea>
                    <input name="cta_button" class="cms-input" value="{{ old('cta_button', $homepage->cta_button ?? 'Daftar Sekarang') }}" placeholder="Tombol CTA">
                    <input name="cta_secondary_link" class="cms-input" value="{{ old('cta_secondary_link', $homepage->cta_secondary_link ?? route('pmb')) }}" placeholder="Link CTA kedua">
                    <select name="news_limit" class="cms-input"><option value="3" @selected(($homepage->news_limit ?? 3) == 3)>3 Berita</option><option value="6" @selected(($homepage->news_limit ?? 3) == 6)>6 Berita</option><option value="9" @selected(($homepage->news_limit ?? 3) == 9)>9 Berita</option></select>
                    <label class="cms-input flex items-center gap-2"><input type="checkbox" name="show_news" value="1" @checked($homepage->show_news ?? true)> Tampilkan berita di Beranda</label>
                </div>
            </x-cms-card>
            <div class="flex justify-end"><button class="cms-save">Simpan</button></div>
        </form>
    </div>
    @endif

    @if($activeSection === 'tentang')
    <div>
        <form action="{{ route('admin.website.about.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf
            <x-cms-card title="Hero & Profil Tentang Kami" icon="info">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <input name="hero_title" class="cms-input font-bold" value="{{ old('hero_title', $about->hero_title ?? 'Tentang Kami') }}" placeholder="Judul hero">
                    <input name="hero_image" type="file" accept="image/*" class="cms-input">
                    <input name="profile_label" class="cms-input" value="{{ old('profile_label', $about->profile_label ?? '') }}" placeholder="Label profil">
                    <input name="profile_title" class="cms-input font-bold" value="{{ old('profile_title', $about->profile_title ?? '') }}" placeholder="Judul profil">
                    <textarea name="profile_paragraph_1" class="cms-input md:col-span-2" rows="3" placeholder="Paragraf 1">{{ old('profile_paragraph_1', $about->profile_paragraph_1 ?? '') }}</textarea>
                    <textarea name="profile_paragraph_2" class="cms-input md:col-span-2" rows="3" placeholder="Paragraf 2">{{ old('profile_paragraph_2', $about->profile_paragraph_2 ?? '') }}</textarea>
                    <input name="profile_button_1_text" class="cms-input" value="{{ old('profile_button_1_text', $about->profile_button_1_text ?? 'Selengkapnya') }}" placeholder="Tombol utama">
                    <input name="profile_button_1_link" class="cms-input" value="{{ old('profile_button_1_link', $about->profile_button_1_link ?? '#visi-misi') }}" placeholder="Link tombol">
                    <input name="dedication_number" class="cms-input" value="{{ old('dedication_number', $about->dedication_number ?? '15+') }}" placeholder="Angka dedikasi">
                    <input name="dedication_label" class="cms-input" value="{{ old('dedication_label', $about->dedication_label ?? 'Tahun Dedikasi') }}" placeholder="Label dedikasi">
                    <input name="profile_image" type="file" accept="image/*" class="cms-input md:col-span-2">
                </div>
            </x-cms-card>
            <x-cms-card title="Visi, Misi, Fasilitas, Ekstrakurikuler" icon="flag">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <input name="vision_mission_title" class="cms-input font-bold" value="{{ old('vision_mission_title', $about->vision_mission_title ?? 'Visi & Misi Kami') }}" placeholder="Judul visi misi">
                    <input name="facilities_title" class="cms-input font-bold" value="{{ old('facilities_title', $about->facilities_title ?? 'Fasilitas Unggulan') }}" placeholder="Judul fasilitas">
                    <textarea name="vision" class="cms-input md:col-span-2" rows="3" placeholder="Visi">{{ old('vision', $about->vision ?? '') }}</textarea>
                    @for($i = 0; $i < 4; $i++)
                    <textarea name="missions[{{ $i }}]" class="cms-input" rows="2" placeholder="Misi {{ $i + 1 }}">{{ old("missions.$i", data_get($about->missions, $i)) }}</textarea>
                    @endfor
                    <input name="extracurricular_title" class="cms-input font-bold" value="{{ old('extracurricular_title', $about->extracurricular_title ?? 'Ekstrakurikuler Pilihan') }}" placeholder="Judul ekstrakurikuler">
                    <textarea name="extracurricular_desc" class="cms-input" rows="2" placeholder="Deskripsi ekstrakurikuler">{{ old('extracurricular_desc', $about->extracurricular_desc ?? '') }}</textarea>
                </div>
            </x-cms-card>
            <div class="flex justify-end"><button class="cms-save">Simpan</button></div>
        </form>
    </div>
    @endif

    @if($activeSection === 'berita')
    <div>
        <form action="{{ route('admin.website.news.update') }}" method="POST" class="space-y-8">
            @csrf
            <x-cms-card title="Teks Halaman Berita" icon="newspaper">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <input name="hero_breadcrumb_label" class="cms-input" value="{{ old('hero_breadcrumb_label', $newsSetting->hero_breadcrumb_label ?? 'Berita') }}" placeholder="Breadcrumb">
                    <input name="hero_title" class="cms-input font-bold" value="{{ old('hero_title', str_replace('Warta', 'Berita', $newsSetting->hero_title ?? 'Berita SMAN Pintar')) }}" placeholder="Judul hero">
                    <textarea name="hero_description" class="cms-input md:col-span-2" rows="3" placeholder="Deskripsi hero">{{ old('hero_description', $newsSetting->hero_description ?? '') }}</textarea>
                    <input name="filter_all_label" class="cms-input" value="{{ old('filter_all_label', $newsSetting->filter_all_label ?? 'Semua') }}" placeholder="Label filter semua">
                    <input name="search_placeholder" class="cms-input" value="{{ old('search_placeholder', $newsSetting->search_placeholder ?? 'Ketik kata kunci...') }}" placeholder="Placeholder pencarian">
                    <input name="popular_title" class="cms-input font-bold" value="{{ old('popular_title', $newsSetting->popular_title ?? 'Berita Populer') }}" placeholder="Judul berita populer">
                    <input name="categories_title" class="cms-input font-bold" value="{{ old('categories_title', $newsSetting->categories_title ?? 'Kategori') }}" placeholder="Judul kategori">
                    <input name="newsletter_title" class="cms-input font-bold" value="{{ old('newsletter_title', str_replace('Warta', 'Berita', $newsSetting->newsletter_title ?? 'Berlangganan Berita')) }}" placeholder="Judul newsletter">
                    <input name="newsletter_button_text" class="cms-input" value="{{ old('newsletter_button_text', $newsSetting->newsletter_button_text ?? 'Daftar Sekarang') }}" placeholder="Tombol newsletter">
                    <textarea name="newsletter_description" class="cms-input md:col-span-2" rows="2" placeholder="Deskripsi newsletter">{{ old('newsletter_description', $newsSetting->newsletter_description ?? '') }}</textarea>
                    <input name="newsletter_placeholder" class="cms-input md:col-span-2" value="{{ old('newsletter_placeholder', $newsSetting->newsletter_placeholder ?? 'Email Anda') }}" placeholder="Placeholder email">
                </div>
            </x-cms-card>
            <x-cms-card title="Daftar Artikel" icon="article">
                <div class="flex justify-between items-center mb-4">
                    <p class="text-sm text-on-surface-variant">Artikel tetap dikelola melalui CRUD berita agar data rapi.</p>
                    <a href="{{ route('berita.create') }}" class="text-primary font-bold text-sm">Tambah Berita</a>
                </div>
                <div class="overflow-x-auto"><table class="w-full text-left text-sm"><tbody class="divide-y divide-surface-container">@forelse($berita as $item)<tr><td class="py-3 font-bold text-primary">{{ $item->judul }}</td><td>{{ $item->status }}</td><td class="text-right"><a href="{{ route('berita.edit', $item->id) }}" class="text-primary font-bold">Edit</a></td></tr>@empty<tr><td class="py-4 text-on-surface-variant">Belum ada berita.</td></tr>@endforelse</tbody></table></div>
            </x-cms-card>
            <div class="flex justify-end"><button class="cms-save">Simpan</button></div>
        </form>
    </div>
    @endif

    @if($activeSection === 'pmb')
    <div>
        <form action="{{ route('admin.website.pmb.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf
            <x-cms-card title="Hero & CTA PMB" icon="how_to_reg">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <input name="hero_badge" class="cms-input" value="{{ old('hero_badge', $pmb->hero_badge ?? 'Penerimaan Siswa Baru 2025/2026') }}" placeholder="Badge hero">
                    <input name="hero_title" class="cms-input font-bold" value="{{ old('hero_title', $pmb->hero_title ?? 'Mulai Masa Depan Gemilang di SMAN Pintar') }}" placeholder="Judul hero">
                    <textarea name="hero_description" class="cms-input md:col-span-2" rows="3" placeholder="Deskripsi hero">{{ old('hero_description', $pmb->hero_description ?? '') }}</textarea>
                    <input name="hero_image" type="file" accept="image/*" class="cms-input">
                    <input name="link_pendaftaran" class="cms-input" value="{{ old('link_pendaftaran', $pmb->link_pendaftaran ?? '') }}" placeholder="Link pendaftaran">
                    <input name="primary_button_text" class="cms-input" value="{{ old('primary_button_text', $pmb->primary_button_text ?? 'Daftar Sekarang') }}" placeholder="Tombol utama">
                    <input name="secondary_button_text" class="cms-input" value="{{ old('secondary_button_text', $pmb->secondary_button_text ?? 'Panduan PMB') }}" placeholder="Tombol kedua">
                    <input name="hero_card_title" class="cms-input" value="{{ old('hero_card_title', $pmb->hero_card_title ?? 'Akreditasi A') }}" placeholder="Judul kartu gambar">
                    <input name="hero_card_subtitle" class="cms-input" value="{{ old('hero_card_subtitle', $pmb->hero_card_subtitle ?? 'Standar Internasional') }}" placeholder="Subjudul kartu gambar">
                </div>
            </x-cms-card>
            <x-cms-card title="Informasi PMB" icon="list_alt">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <input name="steps_label" class="cms-input" value="{{ old('steps_label', $pmb->steps_label ?? 'Langkah Mudah') }}" placeholder="Label alur">
                    <input name="steps_title" class="cms-input font-bold" value="{{ old('steps_title', $pmb->steps_title ?? 'Alur Pendaftaran') }}" placeholder="Judul alur">
                    <textarea name="alur" class="cms-input" rows="5" placeholder="Alur, satu baris satu item">{{ old('alur', $pmb->alur ?? '') }}</textarea>
                    <textarea name="persyaratan_umum" class="cms-input" rows="5" placeholder="Persyaratan, satu baris satu item">{{ old('persyaratan_umum', $pmb->persyaratan_umum ?? '') }}</textarea>
                    <textarea name="berkas" class="cms-input" rows="5" placeholder="Berkas, satu baris satu item">{{ old('berkas', $pmb->berkas ?? '') }}</textarea>
                    <textarea name="jadwal" class="cms-input" rows="5" placeholder="Jadwal: Kegiatan | Tanggal | Keterangan">{{ old('jadwal', $pmb->jadwal ?? '') }}</textarea>
                    <textarea name="faq" class="cms-input md:col-span-2" rows="5" placeholder="FAQ: Pertanyaan | Jawaban">{{ old('faq', $pmb->faq ?? '') }}</textarea>
                    <input name="timeline_title" class="cms-input font-bold" value="{{ old('timeline_title', $pmb->timeline_title ?? 'Timeline Pendaftaran') }}" placeholder="Judul timeline">
                    <input name="faq_title" class="cms-input font-bold" value="{{ old('faq_title', $pmb->faq_title ?? 'Pertanyaan Umum (FAQ)') }}" placeholder="Judul FAQ">
                    <input name="testimonials_title" class="cms-input font-bold" value="{{ old('testimonials_title', $pmb->testimonials_title ?? 'Kisah Sukses PMB') }}" placeholder="Judul testimoni">
                    <input name="cta_title" class="cms-input font-bold" value="{{ old('cta_title', $pmb->cta_title ?? 'Wujudkan Impian Anda Bersama SMAN Pintar Riau') }}" placeholder="Judul CTA">
                    <textarea name="cta_description" class="cms-input md:col-span-2" rows="2" placeholder="Deskripsi CTA">{{ old('cta_description', $pmb->cta_description ?? '') }}</textarea>
                    <input name="cta_primary_text" class="cms-input" value="{{ old('cta_primary_text', $pmb->cta_primary_text ?? 'Daftar Sekarang') }}" placeholder="Tombol CTA utama">
                    <input name="cta_secondary_text" class="cms-input" value="{{ old('cta_secondary_text', $pmb->cta_secondary_text ?? 'Hubungi Panitia') }}" placeholder="Tombol CTA kedua">
                </div>
            </x-cms-card>
            <div class="flex justify-end"><button class="cms-save">Simpan</button></div>
        </form>
    </div>
    @endif

    @if($activeSection === 'alumni')
    <div>
        <form action="{{ route('admin.website.alumni.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf
            <x-cms-card title="Hero & Statistik Alumni" icon="school">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <input name="hero_breadcrumb_label" class="cms-input" value="{{ old('hero_breadcrumb_label', $alumniSetting->hero_breadcrumb_label ?? 'Alumni') }}" placeholder="Breadcrumb">
                    <input name="hero_title" class="cms-input font-bold" value="{{ old('hero_title', $alumniSetting->hero_title ?? 'Jejak Alumni Kami') }}" placeholder="Judul hero">
                    <textarea name="hero_description" class="cms-input md:col-span-2" rows="3" placeholder="Deskripsi hero">{{ old('hero_description', $alumniSetting->hero_description ?? '') }}</textarea>
                    <input name="hero_image" type="file" accept="image/*" class="cms-input md:col-span-2">
                    @foreach($defaultAlumniStats as $index => $stat)
                    <div class="bg-surface-container-low p-4 rounded-xl grid grid-cols-3 gap-2">
                        <input name="stats[{{ $index }}][icon]" class="cms-input" value="{{ $stat['icon'] ?? '' }}" placeholder="Icon">
                        <input name="stats[{{ $index }}][value]" class="cms-input font-bold" value="{{ $stat['value'] ?? '' }}" placeholder="Nilai">
                        <input name="stats[{{ $index }}][label]" class="cms-input" value="{{ $stat['label'] ?? '' }}" placeholder="Label">
                    </div>
                    @endforeach
                </div>
            </x-cms-card>
            <x-cms-card title="Map, Testimoni, CTA Alumni" icon="public">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <input name="map_label" class="cms-input" value="{{ old('map_label', $alumniSetting->map_label ?? 'Global Network') }}" placeholder="Label map">
                    <input name="map_title" class="cms-input font-bold" value="{{ old('map_title', $alumniSetting->map_title ?? 'Sebaran Alumni Global') }}" placeholder="Judul map">
                    <textarea name="map_description" class="cms-input md:col-span-2" rows="2" placeholder="Deskripsi map">{{ old('map_description', $alumniSetting->map_description ?? '') }}</textarea>
                    <input name="map_image" type="file" accept="image/*" class="cms-input md:col-span-2">
                    <input name="grid_title" class="cms-input font-bold" value="{{ old('grid_title', $alumniSetting->grid_title ?? 'Inspirasi Alumni') }}" placeholder="Judul grid alumni">
                    <input name="grid_button_text" class="cms-input" value="{{ old('grid_button_text', $alumniSetting->grid_button_text ?? 'Lihat Semua Direktori Alumni') }}" placeholder="Tombol grid">
                    <textarea name="grid_description" class="cms-input md:col-span-2" rows="2" placeholder="Deskripsi grid">{{ old('grid_description', $alumniSetting->grid_description ?? '') }}</textarea>
                    <textarea name="testimonial_quote" class="cms-input md:col-span-2" rows="3" placeholder="Quote testimoni">{{ old('testimonial_quote', $alumniSetting->testimonial_quote ?? '') }}</textarea>
                    <input name="testimonial_name" class="cms-input" value="{{ old('testimonial_name', $alumniSetting->testimonial_name ?? 'Fandi Ahmad') }}" placeholder="Nama testimoni">
                    <input name="testimonial_meta" class="cms-input" value="{{ old('testimonial_meta', $alumniSetting->testimonial_meta ?? '') }}" placeholder="Meta testimoni">
                    <input name="cta_title" class="cms-input font-bold" value="{{ old('cta_title', $alumniSetting->cta_title ?? 'Jadilah Bagian dari Alumni Hebat Kami') }}" placeholder="Judul CTA">
                    <input name="cta_primary_text" class="cms-input" value="{{ old('cta_primary_text', $alumniSetting->cta_primary_text ?? 'Daftar PMB') }}" placeholder="Tombol utama">
                    <textarea name="cta_description" class="cms-input md:col-span-2" rows="2" placeholder="Deskripsi CTA">{{ old('cta_description', $alumniSetting->cta_description ?? '') }}</textarea>
                    <input name="cta_primary_link" class="cms-input" value="{{ old('cta_primary_link', $alumniSetting->cta_primary_link ?? url('/pmb')) }}" placeholder="Link tombol utama">
                    <input name="cta_secondary_text" class="cms-input" value="{{ old('cta_secondary_text', $alumniSetting->cta_secondary_text ?? 'Gabung Alumni') }}" placeholder="Tombol kedua">
                    <input name="cta_secondary_link" class="cms-input md:col-span-2" value="{{ old('cta_secondary_link', $alumniSetting->cta_secondary_link ?? '#') }}" placeholder="Link tombol kedua">
                </div>
            </x-cms-card>
            <x-cms-card title="Data Alumni" icon="database">
                <div class="flex justify-between items-center mb-4">
                    <p class="text-sm text-on-surface-variant">Profil alumni tetap dikelola sebagai data master.</p>
                    <a href="{{ route('alumni.create') }}" class="text-primary font-bold text-sm">Tambah Alumni</a>
                </div>
                <div class="overflow-x-auto"><table class="w-full text-left text-sm"><tbody class="divide-y divide-surface-container">@forelse($alumni as $item)<tr><td class="py-3 font-bold text-primary">{{ $item->nama }}</td><td>{{ $item->profesi }}</td><td class="text-right"><a href="{{ route('alumni.edit', $item->id) }}" class="text-primary font-bold">Edit</a></td></tr>@empty<tr><td class="py-4 text-on-surface-variant">Belum ada alumni.</td></tr>@endforelse</tbody></table></div>
            </x-cms-card>
            <div class="flex justify-end"><button class="cms-save">Simpan</button></div>
        </form>
    </div>
    @endif
</div>

<style>
.cms-input { width: 100%; border: 0; border-radius: 0.75rem; background: #f6f6f6; padding: 0.75rem 1rem; }
.cms-save { border-radius: 0.75rem; background: linear-gradient(135deg, #285092, #3264b7); color: #fefefe; font-weight: 700; padding: 0.75rem 2.5rem; box-shadow: 0 16px 32px rgba(40,80,146,.15); }
</style>
@endsection
