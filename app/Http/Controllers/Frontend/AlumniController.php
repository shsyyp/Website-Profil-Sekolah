<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Alumni;
use App\Models\AlumniPageSetting;

class AlumniController extends Controller
{
    public function index()
    {
        $daftar_alumni = Alumni::latest()->get();

        $lokasi = Alumni::selectRaw('lokasi, COUNT(*) as total')
            ->groupBy('lokasi')
            ->orderByDesc('total')
            ->get()
            ->values()
            ->map(function ($item, $index) {
                $positions = [
                    ['top' => '65%', 'left' => '75%'],
                    ['top' => '35%', 'left' => '45%'],
                    ['top' => '42%', 'left' => '85%'],
                    ['top' => '55%', 'left' => '60%'],
                    ['top' => '48%', 'left' => '70%'],
                    ['top' => '38%', 'left' => '30%'],
                ];

                $position = $positions[$index % count($positions)];

                return (object) [
                    'kota' => strtoupper($item->lokasi),
                    'total' => $item->total,
                    'top' => $position['top'],
                    'left' => $position['left'],
                    'color' => $index === 0 ? 'bg-tertiary' : 'bg-primary',
                    'ping' => $index === 0,
                ];
            });

        $settings = AlumniPageSetting::first() ?? new AlumniPageSetting();
        $testimonialIds = collect($settings->testimonial_alumni_ids ?? [])
            ->map(fn ($id) => (int) $id)
            ->filter()
            ->values();
        $testimonialAlumni = $testimonialIds->isNotEmpty()
            ? $daftar_alumni
                ->whereIn('id', $testimonialIds)
                ->sortBy(fn ($item) => $testimonialIds->search($item->id))
                ->values()
            : collect();
        $featuredAlumni = $testimonialAlumni->first() ?? $daftar_alumni->first();
        $totalAlumni = $daftar_alumni->count();
        $totalLokasi = $lokasi->count();
        $angkatanOptions = $daftar_alumni
            ->pluck('tahun_lulus')
            ->filter()
            ->unique()
            ->sortDesc()
            ->values();

        return view('pages.alumni', compact(
            'lokasi',
            'daftar_alumni',
            'testimonialAlumni',
            'featuredAlumni',
            'totalAlumni',
            'totalLokasi',
            'angkatanOptions',
            'settings'
        ));
    }
}
