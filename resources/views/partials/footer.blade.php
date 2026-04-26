<footer class="w-full rounded-t-3xl mt-20 bg-slate-100 border-t border-slate-200">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-8 px-12 py-16 max-w-7xl mx-auto">
        <div class="space-y-6">
            <span class="text-lg font-bold text-primary block">SMAN Pintar</span>
            <p class="text-slate-500 text-sm leading-relaxed">
                Mewujudkan pendidikan menengah berkualitas dunia di bumi Lancang Kuning, Provinsi Riau.
            </p>
            <div class="flex gap-4">
                <span
                    class="material-symbols-outlined text-primary cursor-pointer hover:scale-110 transition-transform">social_leaderboard</span>
                <span
                    class="material-symbols-outlined text-primary cursor-pointer hover:scale-110 transition-transform">alternate_email</span>
                <span
                    class="material-symbols-outlined text-primary cursor-pointer hover:scale-110 transition-transform">podcasts</span>
            </div>
        </div>
        <div class="space-y-4">
            <h4 class="font-bold text-primary mb-4">Navigasi</h4>
            <ul class="space-y-2 text-sm">
                <li><a class="text-slate-500 hover:text-tertiary transition-colors" href="#">Privacy Policy</a></li>
                <li><a class="text-slate-500 hover:text-tertiary transition-colors" href="#">Terms of Service</a></li>
                <li><a class="text-slate-500 hover:text-tertiary transition-colors" href="#">Contact Us</a></li>
                <li><a class="font-semibold text-primary" href="#">Alumni Portal</a></li>
            </ul>
        </div>
        <div class="space-y-4">
            <h4 class="font-bold text-primary mb-4">Kontak</h4>
            <ul class="space-y-3 text-sm text-slate-500">
                <li class="flex items-start gap-3">
                    <span class="material-symbols-outlined text-sm text-tertiary">location_on</span>
                    <span>Jl. Pendidikan No. 01, Pekanbaru, Provinsi Riau</span>
                </li>
                <li class="flex items-center gap-3">
                    <span class="material-symbols-outlined text-sm text-tertiary">call</span>
                    <span>(0761) 1234567</span>
                </li>
            </ul>
        </div>
        <div class="space-y-4">
            <h4 class="font-bold text-primary mb-4">Newsletter</h4>
            <p class="text-xs text-slate-500 mb-4">Dapatkan info pendaftaran dan prestasi terbaru langsung di email
                Anda.</p>
            <div class="relative">
                <input
                    class="w-full bg-white border-none rounded-md px-4 py-3 text-sm shadow-sm focus:ring-2 focus:ring-primary"
                    placeholder="Email Anda" type="email" />
                <button
                    class="absolute right-2 top-2 p-1.5 primary-gradient rounded text-white hover:scale-105 transition-transform">
                    <span class="material-symbols-outlined text-base">send</span>
                </button>
            </div>
        </div>
    </div>
    <div
        class="max-w-7xl mx-auto px-12 py-8 border-t border-slate-200/50 flex flex-col md:flex-row justify-between items-center gap-4 text-slate-400 text-xs">
        <p>© {{ date('Y') }} SMAN Pintar. Excellence in Education.</p>
        <div class="flex gap-6">
            <span>Made with Passion in Riau</span>
        </div>
    </div>
</footer>