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
</style>
@endpush

{{-- Map Persebaran --}}
<section class="pb-24 pt-24 max-w-7xl mx-auto px-8">
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-8 mb-12 py-12">
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
<section class="py-24 overflow-hidden bg-primary relative">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-0 left-0 w-full h-full"
            style="background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 40px 40px;">
        </div>
    </div>
    <div class="max-w-7xl mx-auto px-6 relative z-10">
        <div class="flex flex-col items-center text-center">
            <div class="w-full" data-alumni-testimonials>
                @forelse($testimonialAlumni as $alumnus)
                    @php
                        $meta = collect([
                            trim(collect([$alumnus->profesi, $alumnus->instansi])->filter()->join(', ')),
                            $alumnus->tahun_lulus ? 'Class of ' . $alumnus->tahun_lulus : null,
                        ])->filter()->join(' | ');
                    @endphp
                    <article class="{{ $loop->first ? '' : 'hidden' }}" data-alumni-testimonial>
                        <img
                            class="mx-auto mb-8 h-20 w-20 rounded-full border-4 border-white/20 object-cover shadow-2xl"
                            src="{{ $alumnus->foto ? asset('storage/' . $alumnus->foto) : 'https://ui-avatars.com/api/?name=' . urlencode($alumnus->nama) . '&background=e9eef8&color=0b3f8a&bold=true' }}"
                            alt="{{ $alumnus->nama }}">
                        <div class="mx-auto max-w-4xl">
                            <p class="text-2xl md:text-3xl font-medium text-white leading-relaxed mb-12">
                                "{{ $alumnus->deskripsi ?: 'Bangga menjadi bagian dari keluarga besar SMAN Pintar Provinsi Riau.' }}"
                            </p>
                            <div class="flex flex-col items-center">
                                <h5 class="text-white font-bold text-lg">{{ $alumnus->nama }}</h5>
                                <p class="text-on-primary-container text-sm">{{ $meta }}</p>
                            </div>
                        </div>
                    </article>
                @empty
                    <article data-alumni-testimonial>
                        <img
                            class="mx-auto mb-8 h-20 w-20 rounded-full border-4 border-white/20 object-cover shadow-2xl"
                            src="https://ui-avatars.com/api/?name=Alumni+SMAN+Pintar&background=e9eef8&color=0b3f8a&bold=true"
                            alt="Alumni SMAN Pintar">
                        <div class="mx-auto max-w-4xl">
                            <p class="text-2xl md:text-3xl font-medium text-white leading-relaxed mb-12">
                                "{{ $settings->testimonial_quote ?? 'Bangga menjadi bagian dari keluarga besar SMAN Pintar Provinsi Riau.' }}"
                            </p>
                            <div class="flex flex-col items-center">
                                <h5 class="text-white font-bold text-lg">{{ $settings->testimonial_name ?? 'Alumni SMAN Pintar' }}</h5>
                                <p class="text-on-primary-container text-sm">{{ $settings->testimonial_meta ?? 'Komunitas Alumni' }}</p>
                            </div>
                        </div>
                    </article>
                @endforelse
            </div>
            <div class="flex gap-4 mt-12">
                <button type="button" data-alumni-testimonial-prev
                    class="w-12 h-12 rounded-full border border-white/20 flex items-center justify-center text-white hover:bg-white/10 transition-colors">
                    <span class="material-symbols-outlined">chevron_left</span>
                </button>
                <button type="button" data-alumni-testimonial-next
                    class="w-12 h-12 rounded-full border border-white/20 flex items-center justify-center text-white hover:bg-white/10 transition-colors">
                    <span class="material-symbols-outlined">chevron_right</span>
                </button>
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const slides = Array.from(document.querySelectorAll('[data-alumni-testimonial]'));
        const previousButton = document.querySelector('[data-alumni-testimonial-prev]');
        const nextButton = document.querySelector('[data-alumni-testimonial-next]');
        let activeIndex = 0;

        if (!slides.length) {
            return;
        }

        const showSlide = (index) => {
            activeIndex = (index + slides.length) % slides.length;
            slides.forEach((slide, slideIndex) => {
                slide.classList.toggle('hidden', slideIndex !== activeIndex);
            });
        };

        previousButton?.addEventListener('click', () => showSlide(activeIndex - 1));
        nextButton?.addEventListener('click', () => showSlide(activeIndex + 1));
    });
</script>
@endpush

{{-- CTA Section --}}
<section class="py-24 max-w-7xl mx-auto px-6">
    <div
        class="relative bg-surface-container-high rounded-[2rem] p-12 md:p-20 overflow-hidden flex flex-col items-center text-center">
        <div class="absolute top-0 right-0 -mr-20 -mt-20 w-80 h-80 bg-tertiary/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-80 h-80 bg-primary/10 rounded-full blur-3xl"></div>

        <h2 class="text-4xl md:text-5xl font-extrabold text-primary tracking-tight mb-6">{{ $settings->cta_title ?? 'Jadilah Bagian dari Alumni Hebat Kami' }}</h2>
        <p class="text-lg text-on-surface-variant max-w-2xl mb-12">{{ $settings->cta_description ?? 'Lanjutkan legacy keunggulan ini. Apakah Anda calon siswa yang ambisius atau alumni yang ingin kembali berkontribusi?' }}</p>

        <div class="flex flex-col sm:flex-row gap-6 relative z-10">
            <a href="{{ $settings->cta_secondary_link ?? '#' }}"
                class="bg-primary text-on-primary px-10 py-4 rounded-xl font-bold text-lg hover:scale-105 transition-all shadow-lg flex items-center gap-3">
                {{ $settings->cta_secondary_text ?? 'Gabung Alumni' }}
                <span class="material-symbols-outlined">person_add</span>
            </a>
        </div>
    </div>
</section>

@endsection
