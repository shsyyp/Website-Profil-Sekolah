<header
    class="sticky top-0 right-0 z-30 h-16 w-full flex justify-between items-center px-8 bg-white/80 backdrop-blur-xl border-b border-slate-100/50 font-['Plus_Jakarta_Sans'] text-base">
    <div
        class="flex items-center bg-surface-container-high px-4 py-2 rounded-full w-96 group focus-within:ring-2 ring-primary/20 transition-all">
        <span class="material-symbols-outlined text-outline" data-icon="search">search</span>
        <input type="text" class="bg-transparent border-none focus:ring-0 text-sm w-full placeholder-outline-variant"
            placeholder="Cari data atau laporan..." />
    </div>
    <div class="flex items-center gap-6">
        <div class="flex items-center gap-3">
            <button
                class="relative p-2 text-on-surface-variant hover:bg-slate-100 rounded-lg transition-colors active:scale-95">
                <span class="material-symbols-outlined" data-icon="notifications">notifications</span>
                <span class="absolute top-2 right-2 w-2 h-2 bg-error rounded-full border-2 border-white"></span>
            </button>
            <button class="p-2 text-on-surface-variant hover:bg-slate-100 rounded-lg transition-colors active:scale-95">
                <span class="material-symbols-outlined" data-icon="settings">settings</span>
            </button>
        </div>
        <div class="h-8 w-[1px] bg-outline-variant/30"></div>
        <div class="flex items-center gap-3 cursor-pointer group">
            <div class="text-right">
                {{-- Mengambil nama user yang sedang login --}}
                <p class="text-sm font-bold text-on-surface">{{ Auth::user()->name ?? 'Admin Utama' }}</p>
                <p class="text-[10px] text-outline uppercase font-semibold">Superuser</p>
            </div>
            <img alt="Admin Profile" class="w-10 h-10 rounded-xl object-cover ring-2 ring-primary-container"
                src="https://lh3.googleusercontent.com/aida-public/AB6AXuDpIsn2SWkTAn7VGo-z2tA7CbfEyurvjKMz1SEhoDFFd5ZGOQFrR32kmnBpx204C5o2ajSE5HLPuPK7RuxCo2KwO85URPmGQ_vk6neqw0TNBjoAorLx3U8KY9nRDtAQ_j1_9SDMab4g4ZhA5n68aVEr5x7jHdCFKfoDAGeMtq0CKxjzYq2Uwtl2jCASI5W5RJyO-8xFJ8rnuIU6WzzyHqt0ntS7rM3u3sYUQH0ljqj6LvQxuk2GZGPEZNMw_p58EH0RsMrg6FxgXOIw" />
        </div>
    </div>
</header>