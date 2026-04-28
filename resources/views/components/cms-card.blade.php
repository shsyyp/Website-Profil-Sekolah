@props(['title', 'icon' => 'settings'])

<section class="bg-surface-container-lowest rounded-xl p-8 shadow-[0_24px_40px_-15px_rgba(25,27,34,0.04)]">
    <div class="flex items-center gap-3 mb-8">
        <div class="w-10 h-10 rounded-xl bg-primary/10 flex items-center justify-center text-primary">
            <span class="material-symbols-outlined">{{ $icon }}</span>
        </div>
        <h3 class="text-xl font-bold tracking-tight">{{ $title }}</h3>
    </div>
    {{ $slot }}
</section>
