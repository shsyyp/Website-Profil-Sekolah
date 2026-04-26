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
                                type="text" value="{{ $homepage->success_title ?? 'Outstanding Achievements' }}" />
                        </div>
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
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">
                @for ($i = 0; $i < 4; $i++) <div
                    class="bg-surface-container-lowest p-6 rounded-2xl shadow-sm border border-slate-50 space-y-4">
                    <input name="tradisi[{{$i}}][title]"
                        class="w-full border-none p-0 focus:ring-0 font-bold text-primary bg-transparent text-lg"
                        type="text"
                        value="{{ $homepage->tradisi[$i]['title'] ?? ($i == 0 ? 'Kurikulum' : ($i == 1 ? 'Boarding' : ($i == 2 ? 'Pembinaan' : 'Alumni'))) }}" />
                    <textarea name="tradisi[{{$i}}][desc]"
                        class="w-full border-none p-0 focus:ring-0 text-xs text-on-surface-variant bg-transparent resize-none"
                        rows="4">{{ $homepage->tradisi[$i]['desc'] ?? 'Deskripsi konten keunggulan di sini...' }}</textarea>
            </div>
            @endfor
        </div>
        </div>
    </section>

    {{-- Section 3: Extra Settings --}}
    <section class="space-y-8">
        <div class="border-t border-slate-100 pt-12">
            <h3 class="text-3xl font-headline font-extrabold text-primary">Pengaturan Tambahan</h3>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

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
                    <textarea name="cta_desc"
                        class="bg-surface-container-low border-none rounded-xl px-4 py-3 col-span-1 md:col-span-2"
                        placeholder="Deskripsi Singkat"
                        rows="3">{{ $homepage->cta_desc ?? 'Daftarkan diri Anda hari ini...' }}</textarea>
                </div>
            </div>
        </div>
    </section>

</form>
@endsection