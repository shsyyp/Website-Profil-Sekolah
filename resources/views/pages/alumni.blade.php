@extends('layouts.main')

@section('title', 'Jejak Alumni - SMAN Pintar Provinsi Riau')

@section('content')
@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<style>
    #alumniPublicMap,
    #alumniPublicMap .leaflet-pane,
    #alumniPublicMap .leaflet-control-container {
        z-index: 0;
    }

    #alumniPublicMap .leaflet-top,
    #alumniPublicMap .leaflet-bottom {
        z-index: 10;
    }

    .alumni-testimonial-scrollbar {
        scrollbar-width: none;
    }

    .alumni-testimonial-scrollbar::-webkit-scrollbar {
        display: none;
    }
</style>
@endpush

{{-- Map Persebaran --}}
<section class="pb-24 pt-10 max-w-7xl mx-auto px-8">
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-6 pt-8">
        <div class="max-w-2xl">
            <h1 class="text-5xl font-extrabold font-headline tracking-tight text-primary">{{ $settings->map_title ?? 'Sebaran Alumni Global' }}</h1>
            <p class="text-on-surface-variant max-w-2xl mt-4 leading-relaxed">{{ $settings->map_description ?? 'Dari Riau untuk Dunia. Lihat bagaimana komunitas alumni kami berkembang di berbagai pusat ekonomi dan pendidikan global.' }}</p>
        </div>
        <div class="flex flex-wrap gap-4">
            <select data-alumni-year-filter
                class="min-w-36 bg-surface-container-high border-none rounded-xl py-2.5 pl-4 pr-10 text-sm font-medium focus:ring-2 focus:ring-primary">
                <option value="all">Semua Angkatan</option>
                @foreach($angkatanOptions as $year)
                    <option value="{{ $year }}">{{ $year }}</option>
                @endforeach
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

        const yearFilter = document.querySelector('[data-alumni-year-filter]');
        const alumniLocations = @json($daftar_alumni->values()->map(fn ($item) => [
            'name' => $item->lokasi,
            'year' => (string) $item->tahun_lulus,
        ]));

        const map = L.map(mapElement, {
            scrollWheelZoom: false,
        }).setView([-0.789275, 113.921327], 5);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors',
        }).addTo(map);

        const markerLayer = L.layerGroup().addTo(map);
        const coordinateCache = {};

        const groupLocations = (selectedYear) => {
            const grouped = {};

            alumniLocations
                .filter((item) => selectedYear === 'all' || item.year === selectedYear)
                .forEach((item) => {
                    if (!item.name) {
                        return;
                    }

                    const key = item.name.trim();
                    grouped[key] = grouped[key] || { name: key, total: 0 };
                    grouped[key].total += 1;
                });

            return Object.values(grouped);
        };

        const resolveLocation = (location) => {
            const cacheKey = location.name.toLowerCase();

            if (coordinateCache[cacheKey]) {
                return Promise.resolve(coordinateCache[cacheKey]);
            }

            return fetch(`https://nominatim.openstreetmap.org/search?format=json&limit=1&q=${encodeURIComponent(location.name + ', Indonesia')}`)
                .then((response) => response.json())
                .then((results) => {
                    if (!results.length) {
                        return null;
                    }

                    coordinateCache[cacheKey] = [Number(results[0].lat), Number(results[0].lon)];

                    return coordinateCache[cacheKey];
                })
                .catch(() => null);
        };

        const renderMarkers = (selectedYear = 'all') => {
            const locations = groupLocations(selectedYear);
            const bounds = [];

            markerLayer.clearLayers();

            if (!locations.length) {
                map.setView([-0.789275, 113.921327], 5);
                return;
            }

            Promise.all(locations.map((location) => resolveLocation(location).then((latLng) => ({ location, latLng }))))
                .then((items) => {
                    items.forEach(({ location, latLng }) => {
                        if (!latLng) {
                            return;
                        }

                        bounds.push(latLng);
                        L.marker(latLng)
                            .addTo(markerLayer)
                            .bindPopup(`<strong>${location.name}</strong><br>${location.total} alumni`);
                    });

                    if (bounds.length > 1) {
                        map.fitBounds(bounds, { padding: [48, 48], maxZoom: 7 });
                    } else if (bounds.length === 1) {
                        map.setView(bounds[0], 8);
                    }
                });
        };

        yearFilter?.addEventListener('change', (event) => {
            renderMarkers(event.target.value);
        });

        renderMarkers(yearFilter?.value || 'all');
    });
</script>
@endpush

{{-- Testimoni --}}
<section class="py-24 bg-surface-container">
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-14">
            <div>
                <p class="text-tertiary font-bold text-sm tracking-[0.2em] uppercase mb-4">Alumni</p>
                <h2 class="text-3xl md:text-4xl font-black font-headline text-primary">Jejak Langkah Kesuksesan</h2>
            </div>
            <div class="flex items-center gap-3">
                <button type="button" data-alumni-testimonial-prev
                    class="w-11 h-11 rounded-xl bg-surface-container-lowest text-primary flex items-center justify-center hover:bg-primary hover:text-on-primary transition-colors shadow-sm"
                    aria-label="Testimoni sebelumnya">
                    <span class="material-symbols-outlined">chevron_left</span>
                </button>
                <button type="button" data-alumni-testimonial-next
                    class="w-11 h-11 rounded-xl bg-surface-container-lowest text-primary flex items-center justify-center hover:bg-primary hover:text-on-primary transition-colors shadow-sm"
                    aria-label="Testimoni berikutnya">
                    <span class="material-symbols-outlined">chevron_right</span>
                </button>
            </div>
        </div>

        <div data-alumni-testimonial-slider
            class="alumni-testimonial-scrollbar flex gap-8 overflow-x-auto scroll-smooth snap-x snap-mandatory pb-4">
            @forelse($testimonialAlumni as $alumnus)
                <article class="min-w-[calc(100%_-_1rem)] sm:min-w-[420px] lg:min-w-[calc(33.333%_-_1.333rem)] snap-start bg-surface-container-lowest p-8 md:p-10 rounded-xl shadow-sm border-b-4 border-tertiary flex flex-col">
                    <div class="flex items-center gap-4 mb-7">
                        <img
                            class="h-16 w-16 shrink-0 rounded-full border-4 border-surface-container object-cover"
                            src="{{ $alumnus->foto ? asset('storage/' . $alumnus->foto) : 'https://ui-avatars.com/api/?name=' . urlencode($alumnus->nama) . '&background=e9eef8&color=0b3f8a&bold=true' }}"
                            alt="{{ $alumnus->nama }}">
                        <div>
                            <h3 class="font-bold text-lg text-primary">{{ $alumnus->nama }}</h3>
                            <p class="text-sm text-on-surface-variant">
                                Alumni {{ $alumnus->tahun_lulus }}{{ $alumnus->profesi ? ' | ' . $alumnus->profesi : '' }}{{ $alumnus->instansi ? ', ' . $alumnus->instansi : '' }}
                            </p>
                        </div>
                    </div>
                    <p class="text-on-surface-variant italic text-lg leading-relaxed">
                        "{{ $alumnus->deskripsi ?: 'Bangga menjadi bagian dari keluarga besar SMAN Pintar Provinsi Riau.' }}"
                    </p>
                </article>
            @empty
                <article class="min-w-full snap-start bg-surface-container-lowest p-10 rounded-xl shadow-sm border-b-4 border-tertiary">
                    <div class="flex items-center gap-4 mb-7">
                        <img class="h-16 w-16 rounded-full border-4 border-surface-container object-cover"
                            src="https://ui-avatars.com/api/?name=Alumni+SMAN+Pintar&background=e9eef8&color=0b3f8a&bold=true"
                            alt="Alumni SMAN Pintar">
                        <div>
                            <h3 class="font-bold text-lg text-primary">{{ $settings->testimonial_name ?? 'Alumni SMAN Pintar' }}</h3>
                            <p class="text-sm text-on-surface-variant">{{ $settings->testimonial_meta ?? 'Komunitas Alumni' }}</p>
                        </div>
                    </div>
                    <p class="text-on-surface-variant italic text-lg leading-relaxed">
                        "{{ $settings->testimonial_quote ?? 'Bangga menjadi bagian dari keluarga besar SMAN Pintar Provinsi Riau.' }}"
                    </p>
                </article>
            @endforelse
        </div>
    </div>
</section>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const slider = document.querySelector('[data-alumni-testimonial-slider]');
        const previousButton = document.querySelector('[data-alumni-testimonial-prev]');
        const nextButton = document.querySelector('[data-alumni-testimonial-next]');

        if (!slider) {
            return;
        }

        const scrollTestimonials = (direction) => {
            const card = slider.querySelector('.snap-start');
            const gap = 32;
            const distance = card ? card.getBoundingClientRect().width + gap : slider.clientWidth;
            slider.scrollBy({ left: direction * distance, behavior: 'smooth' });
        };

        previousButton?.addEventListener('click', () => scrollTestimonials(-1));
        nextButton?.addEventListener('click', () => scrollTestimonials(1));
    });
</script>
@endpush

{{-- CTA Section --}}
<section class="py-24">
    <div class="max-w-7xl mx-auto px-8">
        <div
            class="bg-gradient-to-br from-primary via-primary-container to-blue-900 rounded-[3rem] p-12 md:p-24 text-center text-white relative overflow-hidden shadow-2xl">
            <div class="absolute top-0 left-0 w-full h-full opacity-10">
                <svg class="w-full h-full" viewBox="0 0 100 100" aria-hidden="true">
                    <pattern height="10" id="alumni-grid" patternUnits="userSpaceOnUse" width="10">
                        <path d="M 10 0 L 0 0 0 10" fill="none" stroke="white" stroke-width="0.5"></path>
                    </pattern>
                    <rect fill="url(#alumni-grid)" height="100" width="100"></rect>
                </svg>
            </div>
            <div class="relative z-10">
                <h2 class="font-headline text-4xl md:text-6xl font-extrabold mb-8 tracking-tighter">
                    {{ $settings->cta_title ?? 'Jadilah Bagian dari Alumni Hebat Kami' }}
                </h2>
                <p class="text-xl text-primary-fixed mb-12 max-w-2xl mx-auto opacity-90 leading-relaxed">
                    {{ $settings->cta_description ?? 'Lanjutkan legacy keunggulan ini. Apakah Anda calon siswa yang ambisius atau alumni yang ingin kembali berkontribusi?' }}
                </p>
                <div class="flex flex-col sm:flex-row justify-center gap-6">
                    <a href="{{ $settings->cta_secondary_link ?? '#' }}"
                        class="bg-white/10 backdrop-blur-md border border-white/20 text-white px-10 py-5 rounded-xl font-bold text-xl hover:bg-white/20 transition-all">
                        {{ $settings->cta_secondary_text ?? 'Gabung Alumni' }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
