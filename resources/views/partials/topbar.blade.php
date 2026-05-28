<header
    class="sticky top-0 right-0 z-30 h-16 w-full flex justify-between items-center px-8 bg-white/80 backdrop-blur-xl border-b border-slate-100/50 font-['Plus_Jakarta_Sans'] text-base">
    @php
        $adminAvatar = Auth::user()?->avatar
            ? asset('storage/' . Auth::user()->avatar)
            : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name ?? 'Administrator') . '&background=e9eef8&color=0b3f8a&bold=true';
    @endphp
    <div></div>
    <div class="flex items-center gap-6">
        <div class="relative group">
            <button type="button" class="flex items-center gap-3 rounded-xl px-2 py-1 transition-colors hover:bg-surface-container-low">
                <div class="text-right">
                    {{-- Mengambil nama user yang sedang login --}}
                    <p class="text-sm font-bold text-on-surface">{{ Auth::user()->name ?? 'Admin Utama' }}</p>
                </div>
                <img alt="Admin Profile" class="w-10 h-10 rounded-xl object-cover ring-2 ring-primary-container"
                    src="{{ $adminAvatar }}" />
            </button>

            <div class="invisible absolute right-0 top-full z-50 mt-3 w-48 translate-y-2 rounded-xl border border-slate-100 bg-white p-2 opacity-0 shadow-xl shadow-slate-900/10 transition-all group-focus-within:visible group-focus-within:translate-y-0 group-focus-within:opacity-100 group-hover:visible group-hover:translate-y-0 group-hover:opacity-100">
                <a href="{{ route('admin.profile.edit') }}"
                    class="flex items-center gap-3 rounded-lg px-4 py-3 text-sm font-bold text-on-surface transition-colors hover:bg-surface-container-low">
                    <span class="material-symbols-outlined text-[20px] text-outline">person</span>
                    Profil
                </a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="flex w-full items-center gap-3 rounded-lg px-4 py-3 text-left text-sm font-bold text-error transition-colors hover:bg-red-50">
                        <span class="material-symbols-outlined text-[20px]">logout</span>
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</header>
