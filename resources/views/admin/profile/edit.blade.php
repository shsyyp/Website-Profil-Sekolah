@extends('layouts.admin')

@section('title', 'Profil Admin - SMAN Pintar')

@section('content')
@php
    $avatarUrl = $user->avatar
        ? asset('storage/' . $user->avatar)
        : 'https://ui-avatars.com/api/?name=' . urlencode($user->name ?? 'Administrator') . '&background=e9eef8&color=0b3f8a&bold=true';
@endphp

<section class="mx-auto w-full max-w-xl">
    <div class="mb-8 flex items-center justify-between gap-4">
        <h2 class="text-4xl font-extrabold text-primary tracking-tight font-headline">Profil Admin</h2>
        <a href="{{ route('dashboard') }}"
            class="inline-flex items-center gap-2 rounded-xl bg-slate-100 px-5 py-3 text-sm font-bold text-slate-600 hover:bg-slate-200 transition-colors">
            <span class="material-symbols-outlined text-[18px]">arrow_back</span>
            Kembali
        </a>
    </div>

    @if(session('success'))
    <div class="mb-6 rounded-xl border border-emerald-100 bg-emerald-50 p-4 font-bold text-emerald-600 shadow-sm">
        {{ session('success') }}
    </div>
    @endif

    @if($errors->any())
    <div class="mb-6 rounded-xl border border-red-100 bg-red-50 p-4 font-bold text-error shadow-sm">
        Periksa kembali data profil yang diisi.
    </div>
    @endif

    <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data"
        class="rounded-3xl border border-outline-variant/10 bg-surface-container-lowest p-8 shadow-[0_32px_64px_-16px_rgba(25,27,34,0.08)]">
        @csrf

        <div class="mb-8 flex flex-col items-center text-center">
            <img src="{{ $avatarUrl }}" alt="{{ $user->name }}"
                class="h-24 w-24 rounded-2xl object-cover ring-4 ring-surface">
            <label
                class="mt-4 inline-flex cursor-pointer items-center gap-2 rounded-xl bg-surface-container-low px-4 py-2 text-sm font-bold text-primary transition-colors hover:bg-surface-container">
                <span class="material-symbols-outlined text-[18px]">photo_camera</span>
                Ganti Foto
                <input type="file" name="avatar" accept="image/*" class="sr-only">
            </label>
            @error('avatar') <p class="mt-2 text-xs font-bold text-error">{{ $message }}</p> @enderror
        </div>

        <div class="space-y-6">
            <div class="space-y-2">
                <label class="px-1 text-sm font-semibold uppercase tracking-wider text-on-surface-variant">
                    Nama Admin
                </label>
                <div class="relative">
                    <span class="material-symbols-outlined pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 text-outline">person</span>
                    <input name="name" value="{{ old('name', $user->name) }}"
                        class="block w-full rounded-xl border-0 bg-surface-container-low py-4 pl-12 pr-4 font-medium text-on-surface placeholder-outline transition-all focus:ring-2 focus:ring-primary/20"
                        placeholder="Administrator">
                </div>
                @error('name') <p class="text-xs font-bold text-error">{{ $message }}</p> @enderror
            </div>

            <div class="space-y-2">
                <label class="px-1 text-sm font-semibold uppercase tracking-wider text-on-surface-variant">
                    Email Login
                </label>
                <div class="relative">
                    <span class="material-symbols-outlined pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 text-outline">mail</span>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}"
                        class="block w-full rounded-xl border-0 bg-surface-container-low py-4 pl-12 pr-4 font-medium text-on-surface placeholder-outline transition-all focus:ring-2 focus:ring-primary/20"
                        placeholder="admin@smanpintar.sch.id">
                </div>
                @error('email') <p class="text-xs font-bold text-error">{{ $message }}</p> @enderror
            </div>

            <div class="space-y-2">
                <label class="px-1 text-sm font-semibold uppercase tracking-wider text-on-surface-variant">
                    Password Baru
                </label>
                <div class="relative">
                    <span class="material-symbols-outlined pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 text-outline">lock</span>
                    <input id="profilePassword" type="password" name="password"
                        class="block w-full rounded-xl border-0 bg-surface-container-low py-4 pl-12 pr-12 font-medium text-on-surface placeholder-outline transition-all focus:ring-2 focus:ring-primary/20"
                        placeholder="Kosongkan jika tidak diganti">
                    <button type="button" data-toggle-profile-password
                        class="absolute right-4 top-1/2 -translate-y-1/2 text-outline transition-colors hover:text-on-surface">
                        <span class="material-symbols-outlined">visibility</span>
                    </button>
                </div>
                @error('password') <p class="text-xs font-bold text-error">{{ $message }}</p> @enderror
            </div>

            <div class="space-y-2">
                <label class="px-1 text-sm font-semibold uppercase tracking-wider text-on-surface-variant">
                    Konfirmasi Password
                </label>
                <div class="relative">
                    <span class="material-symbols-outlined pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 text-outline">lock_reset</span>
                    <input id="profilePasswordConfirmation" type="password" name="password_confirmation"
                        class="block w-full rounded-xl border-0 bg-surface-container-low py-4 pl-12 pr-12 font-medium text-on-surface placeholder-outline transition-all focus:ring-2 focus:ring-primary/20"
                        placeholder="Ulangi password baru">
                </div>
            </div>

            <button type="submit"
                class="flex w-full items-center justify-center gap-2 rounded-xl bg-primary py-4 font-headline font-bold text-white shadow-lg shadow-primary/20 transition-all hover:bg-primary-container active:scale-[0.98]">
                Simpan Profil
                <span class="material-symbols-outlined text-xl">arrow_forward</span>
            </button>
        </div>
    </form>
</section>

<script>
document.querySelector('[data-toggle-profile-password]')?.addEventListener('click', function () {
    const password = document.getElementById('profilePassword');
    const confirmation = document.getElementById('profilePasswordConfirmation');
    const icon = this.querySelector('.material-symbols-outlined');
    const isHidden = password.type === 'password';

    password.type = isHidden ? 'text' : 'password';
    confirmation.type = isHidden ? 'text' : 'password';
    icon.textContent = isHidden ? 'visibility_off' : 'visibility';
});
</script>
@endsection
