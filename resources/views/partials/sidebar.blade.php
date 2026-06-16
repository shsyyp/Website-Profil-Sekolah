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

            <a class="flex items-center gap-3 px-4 py-3 {{ Route::is('admin.homepage.*') ? 'bg-gradient-to-br from-[#285092] to-[#3264b7] text-white' : 'text-[#565656] hover:bg-[#f6f6f6]' }} rounded-lg transition-transform hover:translate-x-1 duration-300"
                href="{{ route('admin.homepage.index') }}">
                <span class="material-symbols-outlined">home_work</span>
                <span class="font-medium text-sm">Beranda</span>
            </a>

            <a class="flex items-center gap-3 px-4 py-3 {{ Route::is('admin.about.*') ? 'bg-gradient-to-br from-[#285092] to-[#3264b7] text-white' : 'text-[#565656] hover:bg-[#f6f6f6]' }} rounded-lg transition-transform hover:translate-x-1 duration-300"
                href="{{ route('admin.about.index') }}">
                <span class="material-symbols-outlined">info</span>
                <span class="font-medium text-sm">Tentang Kami</span>
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
