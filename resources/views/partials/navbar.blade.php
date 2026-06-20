@php
    $navItems = [
        ['label' => 'Beranda', 'url' => url('/'), 'active' => request()->is('/')],
        ['label' => 'Tentang Kami', 'url' => url('/tentang'), 'active' => request()->is('tentang')],
        ['label' => 'Berita', 'url' => url('/berita'), 'active' => request()->is('berita')],
        ['label' => 'PMB', 'url' => url('/pmb'), 'active' => request()->is('pmb')],
        ['label' => 'Alumni', 'url' => url('/alumni'), 'active' => request()->is('alumni')],
    ];
@endphp

<nav class="fixed top-0 w-full z-50 glass-nav shadow-sm shadow-primary/5" data-mobile-nav>
    <div class="max-w-7xl mx-auto flex items-center justify-between px-4 py-4 sm:px-6">
        <div class="flex min-w-0 items-center gap-2">
            <span class="truncate text-xl font-black text-primary tracking-tighter font-headline">{{ $homepage?->site_name ?? 'SMAN Pintar' }}</span>
        </div>

        <div class="hidden md:flex items-center gap-8">
            @foreach ($navItems as $item)
                <a href="{{ $item['url'] }}"
                    class="{{ $item['active'] ? 'text-primary border-b-2 border-tertiary-fixed pb-1' : 'text-slate-600 hover:text-primary transition-colors hover:scale-105 duration-200' }} font-headline font-bold tracking-tight">
                    {{ $item['label'] }}
                </a>
            @endforeach
        </div>

        <div class="flex items-center gap-3 sm:gap-4">
            <button class="material-symbols-outlined text-primary p-2 max-[360px]:hidden" type="button" aria-label="Cari">search</button>
            <a href="{{ route('login') }}"
                class="primary-gradient whitespace-nowrap text-on-primary px-4 sm:px-6 py-2.5 rounded-md font-bold text-sm tracking-wide hover:scale-105 active:opacity-80 active:scale-95 transition-all shadow-lg shadow-primary/20">
                {{ $homepage?->login_button_text ?? 'Login Admin' }}
            </a>
            <button
                class="md:hidden inline-flex h-10 w-10 items-center justify-center rounded-md border border-primary/15 text-primary transition-colors hover:bg-primary/5"
                type="button"
                aria-label="Buka menu navigasi"
                aria-expanded="false"
                aria-controls="mobile-nav-panel"
                data-mobile-nav-toggle>
                <span class="material-symbols-outlined" data-mobile-nav-icon>menu</span>
            </button>
        </div>
    </div>

    <div
        id="mobile-nav-panel"
        class="md:hidden hidden border-t border-primary/10 bg-white/95 px-6 pb-5 pt-2 shadow-lg shadow-primary/10"
        data-mobile-nav-panel>
        <div class="flex flex-col gap-1">
            @foreach ($navItems as $item)
                <a href="{{ $item['url'] }}"
                    class="{{ $item['active'] ? 'bg-primary text-on-primary' : 'text-slate-700 hover:bg-primary/5 hover:text-primary' }} rounded-md px-4 py-3 font-headline font-bold tracking-tight transition-colors">
                    {{ $item['label'] }}
                </a>
            @endforeach
        </div>
    </div>
</nav>

@once
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const nav = document.querySelector('[data-mobile-nav]');
                if (!nav) return;

                const toggle = nav.querySelector('[data-mobile-nav-toggle]');
                const panel = nav.querySelector('[data-mobile-nav-panel]');
                const icon = nav.querySelector('[data-mobile-nav-icon]');
                if (!toggle || !panel || !icon) return;

                const setOpen = (isOpen) => {
                    panel.classList.toggle('hidden', !isOpen);
                    toggle.setAttribute('aria-expanded', String(isOpen));
                    toggle.setAttribute('aria-label', isOpen ? 'Tutup menu navigasi' : 'Buka menu navigasi');
                    icon.textContent = isOpen ? 'close' : 'menu';
                };

                toggle.addEventListener('click', () => {
                    setOpen(toggle.getAttribute('aria-expanded') !== 'true');
                });

                document.addEventListener('click', (event) => {
                    if (!nav.contains(event.target)) {
                        setOpen(false);
                    }
                });

                document.addEventListener('keydown', (event) => {
                    if (event.key === 'Escape') {
                        setOpen(false);
                    }
                });
            });
        </script>
    @endpush
@endonce
