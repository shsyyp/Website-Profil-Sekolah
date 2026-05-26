@extends('layouts.main')

@section('title', 'Jejak Alumni - SMAN Pintar Provinsi Riau')

@section('content')
@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
@endpush

{{-- Map Persebaran --}}
<section class="pb-24 pt-16 max-w-7xl mx-auto px-6">
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-8 mb-12">
        <div class="max-w-xl">
            <h2 class="text-4xl font-extrabold text-primary tracking-tight">{{ $settings->map_title ?? 'Sebaran Alumni Global' }}</h2>
            <p class="mt-4 text-on-surface-variant">{{ $settings->map_description ?? 'Dari Riau untuk Dunia. Lihat bagaimana komunitas alumni kami berkembang di berbagai pusat ekonomi dan pendidikan global.' }}</p>
        </div>
        <div class="flex flex-wrap gap-4">
            <select
                class="min-w-36 bg-surface-container-high border-none rounded-xl py-2.5 pl-4 pr-10 text-sm font-medium focus:ring-2 focus:ring-primary">
                <option>Angkatan</option>
                <option>2023</option>
                <option>2022</option>
            </select>
            <select
                class="min-w-40 bg-surface-container-high border-none rounded-xl py-2.5 pl-4 pr-10 text-sm font-medium focus:ring-2 focus:ring-primary">
                <option>Bidang Studi</option>
                <option>Teknologi</option>
                <option>Kesehatan</option>
            </select>
        </div>
    </div>
    <div class="bg-surface-container-low rounded-3xl p-4 md:p-6 overflow-hidden shadow-sm">
        <div id="alumniPublicMap" class="h-[360px] md:h-[520px] w-full rounded-2xl overflow-hidden border border-outline-variant/20"></div>
    </div>
</section>

@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const mapElement = document.getElementById('alumniPublicMap');

        if (!mapElement || typeof L === 'undefined') {
            return;
        }

        const locations = @json($lokasi->values()->map(fn ($item) => [
            'name' => $item->kota,
            'total' => $item->total,
        ]));

        const map = L.map(mapElement, {
            scrollWheelZoom: false,
        }).setView([-0.789275, 113.921327], 5);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors',
        }).addTo(map);

        const bounds = [];

        locations.forEach((location) => {
            fetch(`https://nominatim.openstreetmap.org/search?format=json&limit=1&q=${encodeURIComponent(location.name + ', Indonesia')}`)
                .then((response) => response.json())
                .then((results) => {
                    if (!results.length) {
                        return;
                    }

                    const latLng = [Number(results[0].lat), Number(results[0].lon)];
                    bounds.push(latLng);

                    L.marker(latLng)
                        .addTo(map)
                        .bindPopup(`<strong>${location.name}</strong><br>${location.total} alumni`);

                    if (bounds.length > 1) {
                        map.fitBounds(bounds, { padding: [48, 48], maxZoom: 7 });
                    } else {
                        map.setView(latLng, 8);
                    }
                })
                .catch(() => {});
        });
    });
</script>
@endpush

{{-- Testimoni --}}
<section class="py-24 overflow-hidden bg-primary relative">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-0 left-0 w-full h-full"
            style="background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 40px 40px;">
        </div>
    </div>
    <div class="max-w-7xl mx-auto px-6 relative z-10">
        <div class="flex flex-col items-center text-center">
            <img
                class="mb-8 h-20 w-20 rounded-full border-4 border-white/20 object-cover shadow-2xl"
                src="{{ $featuredAlumni?->foto ? asset('storage/' . $featuredAlumni->foto) : 'https://lh3.googleusercontent.com/aida-public/AB6AXuA3kk9jqHFB1bwe8T3UOsjV_sL3xqb9csJjS7ZD042fBVAd2C1XKZenZBSonVAEJQXtXFX6FPYkhv92fLkf3eqw7AaNz8GNPmtR2-0doASR5iHvDVsWGACZ5nWxtWJYwrtdkY5KSU9Fep_xYRvUYHdY3VKWQYaeQK8KPqjTMdUEFfLQsYOxTZ43UAzhLiSN3UVZ-ggTeMHgzGk7766ySmdXXbBjNuP6slDcPj4zsZS8EwjyvcBA3qhVsN3P0r8IjwZ9XheX4N25zYYQ' }}"
                alt="{{ $settings->testimonial_name ?? $featuredAlumni?->nama ?? 'Alumni SMAN Pintar' }}">
            <div class="max-w-4xl">
                <p class="text-2xl md:text-3xl font-medium text-white leading-relaxed mb-12">
                    "{{ $settings->testimonial_quote ?? 'Berada di SMAN Pintar membuka mata saya bahwa keterbatasan geografis bukan penghalang untuk bersaing secara global. Kurikulum dan dukungan pengajarnya benar-benar mempersiapkan mentalitas juara.' }}"
                </p>
                <div class="flex flex-col items-center">
                    <h5 class="text-white font-bold text-lg">{{ $settings->testimonial_name ?? 'Fandi Ahmad' }}</h5>
                    <p class="text-on-primary-container text-sm">{{ $settings->testimonial_meta ?? 'PhD Candidate, University of Oxford | Class of 2016' }}</p>
                </div>
            </div>
            <div class="flex gap-4 mt-12">
                <button
                    class="w-12 h-12 rounded-full border border-white/20 flex items-center justify-center text-white hover:bg-white/10 transition-colors">
                    <span class="material-symbols-outlined">chevron_left</span>
                </button>
                <button
                    class="w-12 h-12 rounded-full border border-white/20 flex items-center justify-center text-white hover:bg-white/10 transition-colors">
                    <span class="material-symbols-outlined">chevron_right</span>
                </button>
            </div>
        </div>
    </div>
</section>

{{-- CTA Section --}}
<section class="py-24 max-w-7xl mx-auto px-6">
    <div
        class="relative bg-surface-container-high rounded-[2rem] p-12 md:p-20 overflow-hidden flex flex-col items-center text-center">
        <div class="absolute top-0 right-0 -mr-20 -mt-20 w-80 h-80 bg-tertiary/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-80 h-80 bg-primary/10 rounded-full blur-3xl"></div>

        <h2 class="text-4xl md:text-5xl font-extrabold text-primary tracking-tight mb-6">{{ $settings->cta_title ?? 'Jadilah Bagian dari Alumni Hebat Kami' }}</h2>
        <p class="text-lg text-on-surface-variant max-w-2xl mb-12">{{ $settings->cta_description ?? 'Lanjutkan legacy keunggulan ini. Apakah Anda calon siswa yang ambisius atau alumni yang ingin kembali berkontribusi?' }}</p>

        <div class="flex flex-col sm:flex-row gap-6 relative z-10">
            <a href="{{ $settings->cta_primary_link ?? url('/pmb') }}"
                class="bg-tertiary text-on-tertiary px-10 py-4 rounded-xl font-bold text-lg hover:scale-105 transition-all shadow-lg flex items-center gap-3">
                {{ $settings->cta_primary_text ?? 'Daftar PMB' }}
                <span class="material-symbols-outlined">rocket_launch</span>
            </a>
            <a href="{{ $settings->cta_secondary_link ?? '#' }}"
                class="bg-primary text-on-primary px-10 py-4 rounded-xl font-bold text-lg hover:scale-105 transition-all shadow-lg flex items-center gap-3">
                {{ $settings->cta_secondary_text ?? 'Gabung Alumni' }}
                <span class="material-symbols-outlined">person_add</span>
            </a>
        </div>
    </div>
</section>

@endsection
