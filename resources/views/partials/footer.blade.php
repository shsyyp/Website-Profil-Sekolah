<footer class="w-full rounded-t-3xl mt-20 bg-slate-100 border-t border-slate-200">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10 px-12 py-16 max-w-7xl mx-auto">
        <div class="space-y-6">
            <span class="text-lg font-bold text-primary block">{{ $homepage?->site_name ?? 'SMAN Pintar' }}</span>
            <p class="text-slate-500 text-sm leading-relaxed">
                {{ $homepage?->footer_desc ?? 'Mewujudkan pendidikan menengah berkualitas melalui pembinaan karakter, penguatan ilmu, dan lingkungan belajar yang inspiratif.' }}
            </p>
            <div class="flex flex-wrap gap-3">
                <a class="inline-flex h-9 w-9 items-center justify-center rounded-full bg-white text-primary shadow-sm transition-colors hover:bg-primary hover:text-white"
                    href="{{ $homepage?->footer_whatsapp_url ?: '#' }}" aria-label="WhatsApp">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.149-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.67-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.71.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.999-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.886 9.884"/>
                    </svg>
                </a>
                <a class="inline-flex h-9 w-9 items-center justify-center rounded-full bg-white text-primary shadow-sm transition-colors hover:bg-primary hover:text-white"
                    href="{{ $homepage?->footer_instagram_url ?: '#' }}" aria-label="Instagram">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                        <path d="M7.8 2h8.4C19.4 2 22 4.6 22 7.8v8.4a5.8 5.8 0 0 1-5.8 5.8H7.8C4.6 22 2 19.4 2 16.2V7.8A5.8 5.8 0 0 1 7.8 2m-.2 2A3.6 3.6 0 0 0 4 7.6v8.8C4 18.39 5.61 20 7.6 20h8.8a3.6 3.6 0 0 0 3.6-3.6V7.6C20 5.61 18.39 4 16.4 4H7.6m9.65 1.5a1.25 1.25 0 0 1 1.25 1.25A1.25 1.25 0 0 1 17.25 8 1.25 1.25 0 0 1 16 6.75a1.25 1.25 0 0 1 1.25-1.25M12 7a5 5 0 0 1 5 5 5 5 0 0 1-5 5 5 5 0 0 1-5-5 5 5 0 0 1 5-5m0 2a3 3 0 0 0-3 3 3 3 0 0 0 3 3 3 3 0 0 0 3-3 3 3 0 0 0-3-3Z"/>
                    </svg>
                </a>
                <a class="inline-flex h-9 w-9 items-center justify-center rounded-full bg-white text-primary shadow-sm transition-colors hover:bg-primary hover:text-white"
                    href="{{ $homepage?->footer_facebook_url ?: '#' }}" aria-label="Facebook">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                        <path d="M22 12.06C22 6.5 17.52 2 12 2S2 6.5 2 12.06c0 5.02 3.66 9.18 8.44 9.94v-7.03H7.9v-2.91h2.54V9.84c0-2.52 1.49-3.91 3.77-3.91 1.09 0 2.23.2 2.23.2v2.47h-1.26c-1.24 0-1.63.78-1.63 1.57v1.89h2.78l-.44 2.91h-2.34V22C18.34 21.24 22 17.08 22 12.06Z"/>
                    </svg>
                </a>
                <a class="inline-flex h-9 w-9 items-center justify-center rounded-full bg-white text-primary shadow-sm transition-colors hover:bg-primary hover:text-white"
                    href="{{ $homepage?->footer_youtube_url ?: '#' }}" aria-label="YouTube">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                        <path d="M23.5 6.2a3 3 0 0 0-2.1-2.1C19.5 3.6 12 3.6 12 3.6s-7.5 0-9.4.5A3 3 0 0 0 .5 6.2 31.4 31.4 0 0 0 0 12a31.4 31.4 0 0 0 .5 5.8 3 3 0 0 0 2.1 2.1c1.9.5 9.4.5 9.4.5s7.5 0 9.4-.5a3 3 0 0 0 2.1-2.1A31.4 31.4 0 0 0 24 12a31.4 31.4 0 0 0-.5-5.8ZM9.6 15.6V8.4L15.8 12l-6.2 3.6Z"/>
                    </svg>
                </a>
            </div>
        </div>

        <div class="space-y-4">
            <h4 class="font-bold text-primary mb-4">Tautan</h4>
            <ul class="space-y-2 text-sm">
                <li><a class="text-slate-500 hover:text-tertiary transition-colors" href="{{ route('home') }}">Beranda</a></li>
                <li><a class="text-slate-500 hover:text-tertiary transition-colors" href="{{ route('tentang') }}">Tentang Kami</a></li>
                <li><a class="text-slate-500 hover:text-tertiary transition-colors" href="{{ route('berita') }}">Berita</a></li>
                <li><a class="text-slate-500 hover:text-tertiary transition-colors" href="{{ route('pmb') }}">PMB</a></li>
                <li><a class="text-slate-500 hover:text-tertiary transition-colors" href="{{ route('alumni') }}">Alumni</a></li>
            </ul>
        </div>

        <div class="space-y-4">
            <h4 class="font-bold text-primary mb-4">Kontak</h4>
            <ul class="space-y-3 text-sm text-slate-500">
                <li class="flex items-start gap-3">
                    <span class="material-symbols-outlined text-sm text-tertiary">location_on</span>
                    <span>{{ $homepage?->footer_address ?? 'Jl. Pendidikan No. 01, Pekanbaru, Provinsi Riau' }}</span>
                </li>
                <li class="flex items-center gap-3">
                    <span class="material-symbols-outlined text-sm text-tertiary">mail</span>
                    <span>{{ $homepage?->footer_email ?? 'info@smanpintar.sch.id' }}</span>
                </li>
                <li class="flex items-center gap-3">
                    <span class="material-symbols-outlined text-sm text-tertiary">call</span>
                    <span>{{ $homepage?->footer_phone ?? '(0761) 1234567' }}</span>
                </li>
            </ul>
        </div>

        <div class="space-y-4">
            <h4 class="font-bold text-primary mb-4">Jam Operasional</h4>
            <p class="whitespace-pre-line text-sm leading-relaxed text-slate-500">{{ $homepage?->footer_operational_hours ?? 'Senin - Jumat: 07.30 - 16.00' }}</p>
        </div>
    </div>

    <div
        class="max-w-7xl mx-auto px-12 py-8 border-t border-slate-200/50 flex flex-col md:flex-row justify-between items-center gap-4 text-slate-400 text-xs">
        <p>&copy; {{ date('Y') }} {{ $homepage?->footer_copyright ?? 'SMAN Pintar Provinsi Riau.' }}</p>
        <div class="flex gap-6">
            <span>{{ $homepage?->footer_note ?? 'Karakter Kuat, Ilmu Berdaya.' }}</span>
        </div>
    </div>
</footer>
