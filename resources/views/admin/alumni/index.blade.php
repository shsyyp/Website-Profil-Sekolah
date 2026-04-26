@extends('layouts.admin')

@section('title', 'Manajemen Alumni | Admin SMAN Pintar')

@section('content')

{{-- Load CSS Leaflet --}}
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

@if(session('success'))
<div class="bg-emerald-50 text-emerald-600 p-4 rounded-xl mb-6 font-bold flex items-center gap-2">
    <span class="material-symbols-outlined">check_circle</span>
    {{ session('success') }}
</div>
@endif

{{-- Page Header --}}
<div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-8">
    <div>
        <span class="text-[10px] uppercase tracking-widest text-tertiary font-bold mb-1 block">Data Master</span>
        <h2 class="text-3xl font-extrabold text-on-surface tracking-tight">Manajemen Alumni</h2>
        <p class="text-outline text-sm">Kelola data lulusan SMAN Pintar seluruh angkatan.</p>
    </div>
    <a href="{{ route('alumni.create') }}"
        class="flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-primary to-primary-container text-on-primary rounded-xl font-bold shadow-xl shadow-primary/10 hover:scale-[1.02] active:scale-95 transition-all">
        <span class="material-symbols-outlined">add</span>
        Tambah Alumni
    </a>
</div>

{{-- Visual Analytics Grid --}}
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
    {{-- Map Section --}}
    <div class="lg:col-span-2 bg-surface-container-lowest rounded-xl shadow-sm overflow-hidden flex flex-col">
        <div class="p-6 flex justify-between items-center border-b border-surface-container-high/30">
            <h3 class="font-bold flex items-center gap-2">
                <span class="material-symbols-outlined text-tertiary">public</span>
                Persebaran Alumni
            </h3>
        </div>
        <div class="flex-1 relative bg-[#f0f4f9] p-6 flex flex-col gap-4">
            <div>
                <p class="text-xs text-outline mb-2">Lokasi terdaftar saat ini:</p>
                <div class="flex flex-wrap gap-2">
                    @foreach($lokasi_sebaran as $lok)
                    <span
                        class="px-3 py-1 bg-white border border-outline-variant/30 rounded-full text-xs font-bold text-primary">{{ $lok->lokasi }}</span>
                    @endforeach
                </div>
            </div>

            {{-- Container Map Leaflet --}}
            <div id="mapAlumni" class="w-full h-[350px] rounded-xl border border-outline-variant/30"
                style="z-index: 10;"></div>
        </div>
    </div>

    {{-- Chart Section --}}
    <div class="bg-surface-container-lowest rounded-xl shadow-sm p-6 flex flex-col space-y-6">
        <h3 class="font-bold flex items-center gap-2">
            <span class="material-symbols-outlined text-tertiary">analytics</span>
            Statistik
        </h3>
        <div class="flex-1 flex flex-col justify-center gap-4">
            <div class="p-4 bg-surface-container-low rounded-xl text-center">
                <p class="text-3xl font-extrabold text-primary">{{ $alumni->total() }}</p>
                <p class="text-xs font-bold text-outline uppercase tracking-widest mt-1">Total Terdata</p>
            </div>
        </div>
    </div>
</div>

{{-- Table Alumni --}}
<div class="bg-surface-container-lowest rounded-xl shadow-sm overflow-hidden">
    <div class="p-6 border-b border-surface-container-high/30 flex justify-between items-center">
        <h3 class="font-bold">Database Alumni Terbaru</h3>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr
                    class="bg-surface-container-low text-on-surface-variant text-[11px] uppercase tracking-wider font-bold">
                    <th class="px-6 py-4">Foto</th>
                    <th class="px-6 py-4">Nama Lengkap</th>
                    <th class="px-6 py-4">Profesi / Instansi</th>
                    <th class="px-6 py-4">Angkatan</th>
                    <th class="px-6 py-4">Lokasi Saat Ini</th>
                    <th class="px-6 py-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-surface-container-high/50 text-sm">
                @forelse ($alumni as $item)
                <tr class="hover:bg-surface-container-low/30 transition-colors">
                    <td class="px-6 py-4">
                        @if($item->foto)
                        <img class="w-10 h-10 rounded-full object-cover ring-2 ring-surface"
                            src="{{ asset('storage/' . $item->foto) }}" />
                        @else
                        <div
                            class="w-10 h-10 rounded-full bg-slate-200 flex items-center justify-center text-[10px] font-bold text-slate-400 ring-2 ring-surface">
                            No Pic</div>
                        @endif
                    </td>
                    <td class="px-6 py-4 font-bold text-on-surface">{{ $item->nama }}</td>
                    <td class="px-6 py-4">{{ $item->profesi }} <br> <span
                            class="text-xs text-outline">{{ $item->instansi }}</span></td>
                    <td class="px-6 py-4">
                        <span
                            class="px-3 py-1 bg-secondary-container text-on-secondary-container rounded-full text-[10px] font-bold">LULUS
                            {{ $item->tahun_lulus }}</span>
                    </td>
                    <td class="px-6 py-4 flex items-center gap-2">
                        <span class="material-symbols-outlined text-tertiary text-lg">location_on</span>
                        {{ $item->lokasi }}
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex justify-center gap-2">
                            <a href="{{ route('alumni.edit', $item->id) }}"
                                class="p-2 bg-surface-container-high text-secondary rounded-lg hover:scale-110 transition-transform">
                                <span class="material-symbols-outlined text-[18px]">edit</span>
                            </a>
                            <form action="{{ route('alumni.destroy', $item->id) }}" method="POST"
                                onsubmit="return confirm('Hapus data alumni ini?');">
                                @csrf @method('DELETE')
                                <button type="submit"
                                    class="p-2 bg-surface-container-high text-error rounded-lg hover:scale-110 transition-transform">
                                    <span class="material-symbols-outlined text-[18px]">delete</span>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-8 text-center text-slate-400">Belum ada data alumni.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="p-6 bg-surface-container-low/50">
        {{ $alumni->links() }}
    </div>
</div>

{{-- Load JS Leaflet & Init Map --}}
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    // Set view awal ke tengah Indonesia
    var map = L.map('mapAlumni').setView([-0.789275, 113.921327], 4);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    // Ambil data lokasi dari controller
    const lokasiData = JSON.parse('{!! json_encode($lokasi_sebaran) !!}');

    // Hit API Nominatim buat dapet koordinat dari nama kota
    lokasiData.forEach(function(item) {
        fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${item.lokasi}`)
            .then(res => res.json())
            .then(data => {
                if (data.length > 0) {
                    L.marker([data[0].lat, data[0].lon])
                        .addTo(map)
                        .bindPopup(`<b>${item.lokasi}</b>`);
                }
            }).catch(err => console.log("Gagal load lokasi: ", err));
    });
});
</script>
@endsection