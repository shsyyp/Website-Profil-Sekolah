@extends('layouts.auth')

@section('content')
<main class="flex min-h-dvh">
    {{-- Kiri: Branding Section --}}
    <section
        class="hidden lg:flex lg:w-1/2 relative overflow-hidden bg-gradient-to-br from-primary to-primary-container p-10 xl:p-14 flex-col justify-between">
        <div class="absolute inset-0 bg-pattern opacity-30"></div>
        <div class="absolute -top-24 -left-24 w-96 h-96 bg-tertiary-fixed/10 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-24 -right-24 w-96 h-96 bg-primary-fixed/20 rounded-full blur-3xl"></div>

        <div class="relative z-10">
            <div class="flex items-center gap-3 mb-8">
                <div
                    class="w-12 h-12 bg-surface-container-lowest rounded-xl flex items-center justify-center shadow-lg">
                    <span class="material-symbols-outlined text-primary text-3xl"
                        style="font-variation-settings: 'FILL' 1;">school</span>
                </div>
                <span class="font-headline font-extrabold text-2xl tracking-tighter text-white">SMAN Pintar</span>
            </div>
            <div class="max-w-md">
                <h1 class="font-headline text-4xl xl:text-5xl font-bold text-white leading-tight mb-5 tracking-tight">
                    Admin Panel<br />SMAN Pintar
                </h1>
                <p class="text-primary-fixed text-lg xl:text-xl leading-relaxed opacity-90">
                    Kelola website sekolah dengan mudah dan efisien melalui sistem manajemen akademik terpadu.
                </p>
            </div>
        </div>

        <div class="relative z-10 flex justify-center items-center">
            <div class="w-full max-w-md xl:max-w-lg aspect-square relative">
                <div
                    class="absolute inset-0 bg-white/10 backdrop-blur-md rounded-3xl border border-white/10 shadow-2xl overflow-hidden transform rotate-3">
                </div>
                <div
                    class="absolute inset-4 bg-white/10 backdrop-blur-xl rounded-2xl border border-white/20 shadow-2xl transform -rotate-2 overflow-hidden">
                    <img class="h-full w-full object-cover" src="{{ asset('images/login-hero.png') }}"
                        alt="Siswa SMAN Pintar">
                </div>
            </div>
        </div>
        <div class="relative z-10 text-white/50 text-xs tracking-widest uppercase font-medium">
            &copy; {{ date('Y') }} SMAN Pintar Riau
        </div>
    </section>

    {{-- Kanan: Login Form Section --}}
    <section
        class="w-full lg:w-1/2 bg-surface-container-lowest flex items-center justify-center px-6 py-10 md:px-10 md:py-12 relative z-10">
        <div class="w-full max-w-[420px]">

            <div class="lg:hidden flex flex-col items-center mb-8">
                <span class="material-symbols-outlined text-primary text-5xl mb-2"
                    style="font-variation-settings: 'FILL' 1;">school</span>
                <h2 class="font-headline font-bold text-2xl text-primary">SMAN Pintar Riau</h2>
            </div>

            <div
                class="bg-surface-container-lowest rounded-3xl p-6 md:p-8 shadow-[0_32px_64px_-16px_rgba(25,27,34,0.06)] border border-outline-variant/10">
                <div class="mb-8">
                    <h3 class="font-headline text-3xl font-bold text-on-surface mb-2">Selamat Datang</h3>
                    <p class="text-on-surface-variant font-body">Silakan login untuk mengakses dashboard admin.</p>
                </div>

                {{-- Alert Error Handling --}}
                @if(session('error') || $errors->any())
                <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6 rounded-r-lg">
                    <div class="flex">
                        <span class="material-symbols-outlined text-red-500 mr-2">error</span>
                        <p class="text-sm text-red-700">
                            {{ session('error') ?? $errors->first() }}
                        </p>
                    </div>
                </div>
                @endif

                {{-- Form Login Laravel --}}
                <form action="{{ route('login.post') }}" method="POST" class="space-y-5">
                    @csrf

                    <div class="space-y-2">
                        <label class="text-sm font-semibold text-on-surface-variant uppercase tracking-wider px-1"
                            for="email">Email / Username</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <span
                                    class="material-symbols-outlined text-outline group-focus-within:text-primary transition-colors">mail</span>
                            </div>
                            <input type="text" id="email" name="email" value="{{ old('email') }}" required autofocus
                                class="block w-full pl-12 pr-4 py-3.5 bg-surface-container-low border-none rounded-xl text-on-surface placeholder-outline focus:ring-2 focus:ring-primary/20 transition-all font-medium"
                                placeholder="Email atau username" />
                        </div>
                    </div>

                    <div class="space-y-2">
                        <div class="flex justify-between items-center px-1">
                            <label class="text-sm font-semibold text-on-surface-variant uppercase tracking-wider"
                                for="password">Password</label>
                        </div>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <span
                                    class="material-symbols-outlined text-outline group-focus-within:text-primary transition-colors">lock</span>
                            </div>
                            <input type="password" id="password" name="password" required
                                class="block w-full pl-12 pr-12 py-3.5 bg-surface-container-low border-none rounded-xl text-on-surface placeholder-outline focus:ring-2 focus:ring-primary/20 transition-all font-medium"
                                placeholder="Password" />

                            <div class="absolute inset-y-0 right-0 pr-4 flex items-center cursor-pointer text-outline hover:text-on-surface transition-colors"
                                onclick="togglePassword()">
                                <span id="eyeIcon" class="material-symbols-outlined">visibility</span>
                            </div>
                        </div>
                    </div>

                    <button type="submit"
                        class="w-full bg-gradient-to-r from-primary to-primary-container text-white font-headline font-bold py-3.5 rounded-xl shadow-lg shadow-primary/20 hover:scale-[1.02] active:scale-[0.98] transition-all flex items-center justify-center gap-2">
                        Login ke Dashboard
                        <span class="material-symbols-outlined text-xl">arrow_forward</span>
                    </button>
                </form>
            </div>

        </div>

        <div class="absolute top-0 right-0 -z-10 pointer-events-none opacity-20">
            <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-primary/5 rounded-full blur-[100px]"></div>
        </div>
    </section>
</main>
@endsection

@push('scripts')
<script>
// Fitur Toggle Password Visibility
function togglePassword() {
    const passwordInput = document.getElementById('password');
    const eyeIcon = document.getElementById('eyeIcon');

    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        eyeIcon.textContent = 'visibility_off'; // Ganti icon
    } else {
        passwordInput.type = 'password';
        eyeIcon.textContent = 'visibility'; // Kembalikan icon
    }
}
</script>
@endpush
