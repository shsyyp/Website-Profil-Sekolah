<aside
    class="fixed left-0 top-0 h-full z-40 h-screen w-64 bg-white dark:bg-slate-950 shadow-[24px_0_40px_rgba(23,47,85,0.04)] font-['Plus_Jakarta_Sans'] font-medium text-sm tracking-tight border-r-0">
    <div class="flex flex-col h-full">
        <div class="p-8">
            <span class="text-xl font-bold tracking-tighter text-primary dark:text-blue-100">SMAN Pintar</span>
        </div>
        <nav class="flex-1 px-4 space-y-1">
            <a href="{{ url('admin/dashboard') }}"
                class="flex items-center gap-3 px-4 py-3 transition-all {{ request()->is('admin/dashboard') ? 'text-primary font-bold border-r-4 border-primary bg-[#ecf3fe]' : 'text-[#565656] hover:text-primary hover:bg-[#f6f6f6]' }}">
                <span class="material-symbols-outlined" data-icon="dashboard">dashboard</span>
                <span>Dashboard</span>
            </a>

            <p class="px-4 pt-5 pb-2 text-[10px] uppercase tracking-widest text-slate-400 font-bold">
                Konten Website
            </p>

            <a href="{{ route('admin.homepage.index') }}"
                class="flex items-center gap-3 px-4 py-3 transition-all {{ Route::is('admin.homepage.*') ? 'text-primary font-bold border-r-4 border-primary bg-[#ecf3fe]' : 'text-[#565656] hover:text-primary hover:bg-[#f6f6f6]' }}">
                <span class="material-symbols-outlined" data-icon="home_work">home_work</span>
                <span>Beranda</span>
            </a>

            <a href="{{ route('admin.about.index') }}"
                class="flex items-center gap-3 px-4 py-3 transition-all {{ Route::is('admin.about.*') ? 'text-primary font-bold border-r-4 border-primary bg-[#ecf3fe]' : 'text-[#565656] hover:text-primary hover:bg-[#f6f6f6]' }}">
                <span class="material-symbols-outlined" data-icon="info">info</span>
                <span>Tentang Kami</span>
            </a>

            <a href="{{ url('admin/berita') }}"
                class="flex items-center gap-3 px-4 py-3 transition-all {{ request()->is('admin/berita*') ? 'text-primary font-bold border-r-4 border-primary bg-[#ecf3fe]' : 'text-[#565656] hover:text-primary hover:bg-[#f6f6f6]' }}">
                <span class="material-symbols-outlined" data-icon="newspaper">newspaper</span>
                <span>Berita</span>
            </a>
            <a href="{{ url('admin/pmb') }}"
                class="flex items-center gap-3 px-4 py-3 transition-all {{ request()->is('admin/pmb*') ? 'text-primary font-bold border-r-4 border-primary bg-[#ecf3fe]' : 'text-[#565656] hover:text-primary hover:bg-[#f6f6f6]' }}">
                <span class="material-symbols-outlined" data-icon="how_to_reg">how_to_reg</span>
                <span>PMB</span>
            </a>
            <a href="{{ url('admin/alumni') }}"
                class="flex items-center gap-3 px-4 py-3 transition-all {{ request()->is('admin/alumni*') ? 'text-primary font-bold border-r-4 border-primary bg-[#ecf3fe]' : 'text-[#565656] hover:text-primary hover:bg-[#f6f6f6]' }}">
                <span class="material-symbols-outlined" data-icon="school">school</span>
                <span>Alumni</span>
            </a>
            <a href="{{ url('admin/chatbot') }}"
                class="flex items-center gap-3 px-4 py-3 transition-all {{ request()->is('admin/chatbot*') ? 'text-primary font-bold border-r-4 border-primary bg-[#ecf3fe]' : 'text-[#565656] hover:text-primary hover:bg-[#f6f6f6]' }}">
                <span class="material-symbols-outlined" data-icon="smart_toy">smart_toy</span>
                <span>Chatbot</span>
            </a>

            <hr class="my-4 border-slate-100">

            <a href="{{ url('/') }}"
                class="flex items-center gap-3 px-4 py-3 text-[#565656] hover:text-primary hover:bg-[#f6f6f6] transition-all">
                <span class="material-symbols-outlined" data-icon="home">home</span>
                <span>Lihat Website</span>
            </a>
        </nav>
    </div>
</aside>
