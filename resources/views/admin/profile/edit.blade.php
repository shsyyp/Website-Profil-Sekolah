@extends('layouts.admin')

@section('title', 'Profil Administrator - SMAN Pintar')

@section('content')
@php
    $avatarUrl = $user->avatar
        ? asset('storage/' . $user->avatar)
        : 'https://ui-avatars.com/api/?name=' . urlencode($user->name ?? 'Administrator') . '&background=e9eef8&color=0b3f8a&bold=true';
    $usernameValue = $user->username ?: \Illuminate\Support\Str::before((string) $user->email, '@');
@endphp

<section class="w-full space-y-8">
    <div class="flex items-center justify-between gap-4">
        <h2 class="text-4xl font-extrabold text-primary tracking-tight font-headline">Profil Administrator</h2>
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
        class="rounded-3xl border border-outline-variant/10 bg-surface-container-lowest p-8 lg:p-10 shadow-[0_32px_64px_-16px_rgba(25,27,34,0.08)]">
        @csrf

        <div class="grid grid-cols-1 gap-10 xl:grid-cols-[280px_minmax(0,1fr)]">
            <aside class="rounded-2xl bg-surface-container-low p-8">
                <div class="flex flex-col items-center text-center">
                    <img src="{{ $avatarUrl }}" alt="{{ $user->name }}"
                        class="h-32 w-32 rounded-2xl object-cover ring-4 ring-surface">
                    <label
                        class="mt-5 inline-flex cursor-pointer items-center gap-2 rounded-xl bg-surface-container-lowest px-4 py-2 text-sm font-bold text-primary shadow-sm transition-colors hover:bg-surface-container">
                        <span class="material-symbols-outlined text-[18px]">photo_camera</span>
                        Ubah Foto Profil
                        <input type="file" name="avatar" accept=".jpg,.jpeg,.png,image/jpeg,image/png" class="sr-only">
                    </label>
                    <p class="mt-3 whitespace-nowrap text-xs font-medium text-slate-500">Format JPG, JPEG, PNG • Maksimal 2 MB</p>
                    @error('avatar') <p class="mt-2 text-xs font-bold text-error">{{ $message }}</p> @enderror
                </div>
            </aside>

            <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
                <div class="space-y-2">
                    <label class="px-1 text-sm font-semibold uppercase tracking-wider text-on-surface-variant">
                        Nama Lengkap
                    </label>
                    <input name="name" value="{{ old('name', $user->name) }}"
                        class="block w-full rounded-xl border-0 bg-surface-container-low px-4 py-4 font-medium text-on-surface placeholder-outline transition-all focus:ring-2 focus:ring-primary/20"
                        placeholder="Administrator" required>
                    @error('name') <p class="text-xs font-bold text-error">{{ $message }}</p> @enderror
                </div>

                <div class="space-y-2">
                    <label class="px-1 text-sm font-semibold uppercase tracking-wider text-on-surface-variant">
                        Nama Pengguna
                    </label>
                    <input value="{{ $usernameValue }}" readonly aria-readonly="true" tabindex="-1"
                        class="block w-full cursor-not-allowed rounded-xl border-0 bg-slate-100 px-4 py-4 font-medium text-slate-500 outline-none focus:outline-none focus:ring-0">
                    <p class="text-xs font-medium text-slate-500">Nama pengguna tidak dapat diubah.</p>
                </div>

                <div class="space-y-2 lg:col-span-2">
                    <label class="px-1 text-sm font-semibold uppercase tracking-wider text-on-surface-variant">
                        Alamat Email
                    </label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}"
                        class="block w-full rounded-xl border-0 bg-surface-container-low px-4 py-4 font-medium text-on-surface placeholder-outline transition-all focus:ring-2 focus:ring-primary/20"
                        placeholder="admin@smanpintar.sch.id" required>
                    @error('email') <p class="text-xs font-bold text-error">{{ $message }}</p> @enderror
                </div>

                <div class="space-y-2">
                    <label class="px-1 text-sm font-semibold uppercase tracking-wider text-on-surface-variant">
                        Kata Sandi Baru
                    </label>
                    <div class="relative">
                        <input id="profilePassword" type="password" name="password"
                            class="block w-full rounded-xl border-0 bg-surface-container-low py-4 pl-4 pr-12 font-medium text-on-surface placeholder-outline transition-all focus:ring-2 focus:ring-primary/20"
                            placeholder="Biarkan kosong jika tidak diubah" minlength="8">
                        <button type="button" data-toggle-profile-password
                            class="absolute right-4 top-1/2 -translate-y-1/2 text-outline transition-colors hover:text-on-surface">
                            <span class="material-symbols-outlined">visibility</span>
                        </button>
                    </div>
                    <p class="text-xs font-medium text-slate-500">Minimal 8 karakter.</p>
                    @error('password') <p class="text-xs font-bold text-error">{{ $message }}</p> @enderror
                </div>

                <div class="space-y-2">
                    <label class="px-1 text-sm font-semibold uppercase tracking-wider text-on-surface-variant">
                        Konfirmasi Kata Sandi
                    </label>
                    <input id="profilePasswordConfirmation" type="password" name="password_confirmation"
                        class="block w-full rounded-xl border-0 bg-surface-container-low px-4 py-4 font-medium text-on-surface placeholder-outline transition-all focus:ring-2 focus:ring-primary/20"
                        placeholder="Ulangi kata sandi baru">
                    @error('password_confirmation') <p class="text-xs font-bold text-error">{{ $message }}</p> @enderror
                </div>

                <div class="lg:col-span-2 flex justify-end border-t border-surface-container pt-6">
                    <button type="submit"
                        class="inline-flex items-center justify-center gap-2 rounded-xl bg-primary px-10 py-4 font-headline font-bold text-white shadow-lg shadow-primary/20 transition-all hover:bg-primary-container active:scale-[0.98]">
                        Simpan Perubahan
                        <span class="material-symbols-outlined text-xl">arrow_forward</span>
                    </button>
                </div>
            </div>
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

const profilePassword = document.getElementById('profilePassword');
const profilePasswordConfirmation = document.getElementById('profilePasswordConfirmation');

function updatePasswordConfirmationRequirement() {
    profilePasswordConfirmation.required = profilePassword.value.length > 0;
}

profilePassword?.addEventListener('input', updatePasswordConfirmationRequirement);
updatePasswordConfirmationRequirement();
</script>
@endsection
