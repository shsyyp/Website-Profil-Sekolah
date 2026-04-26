<nav class="fixed top-0 w-full z-50 glass-nav shadow-sm shadow-primary/5">
    <div class="max-w-7xl mx-auto flex items-center justify-between px-6 py-4">
        <div class="flex items-center gap-2">
            <span class="text-xl font-black text-primary tracking-tighter font-headline">SMAN Pintar</span>
        </div>

        <div class="hidden md:flex items-center gap-8">
            {{-- Menu Beranda --}}
            <a href="{{ url('/') }}"
                class="{{ request()->is('/') ? 'text-primary border-b-2 border-tertiary-fixed pb-1' : 'text-slate-600 hover:text-primary transition-colors hover:scale-105 duration-200' }} font-headline font-bold tracking-tight">
                Beranda
            </a>

            {{-- Menu Tentang Kami --}}
            <a href="{{ url('/tentang') }}"
                class="{{ request()->is('tentang') ? 'text-primary border-b-2 border-tertiary-fixed pb-1' : 'text-slate-600 hover:text-primary transition-colors hover:scale-105 duration-200' }} font-headline font-bold tracking-tight">
                Tentang Kami
            </a>

            {{-- Menu Berita --}}
            <a href="{{ url('/berita') }}"
                class="{{ request()->is('berita') ? 'text-primary border-b-2 border-tertiary-fixed pb-1' : 'text-slate-600 hover:text-primary transition-colors hover:scale-105 duration-200' }} font-headline font-bold tracking-tight">
                Berita
            </a>

            {{-- Menu PMB (Baru Ditambahkan) --}}
            <a href="{{ url('/pmb') }}"
                class="{{ request()->is('pmb') ? 'text-primary border-b-2 border-tertiary-fixed pb-1' : 'text-slate-600 hover:text-primary transition-colors hover:scale-105 duration-200' }} font-headline font-bold tracking-tight">
                PMB
            </a>

            {{-- Menu Alumni --}}
            <a href="{{ url('/alumni') }}"
                class="{{ request()->is('alumni') ? 'text-primary border-b-2 border-tertiary-fixed pb-1' : 'text-slate-600 hover:text-primary transition-colors hover:scale-105 duration-200' }} font-headline font-bold tracking-tight">
                Alumni
            </a>
        </div>

        <div class="flex items-center gap-4">
            <button class="material-symbols-outlined text-primary p-2">search</button>
            <a href="{{ route('login') }}"
                class="primary-gradient text-on-primary px-6 py-2.5 rounded-md font-bold text-sm tracking-wide hover:scale-105 active:opacity-80 active:scale-95 transition-all shadow-lg shadow-primary/20">
                Login Admin
            </a>
        </div>
    </div>
</nav>