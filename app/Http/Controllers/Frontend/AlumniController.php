<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Alumni;

class AlumniController extends Controller
{
    public function index()
    {
        $daftar_alumni = Alumni::where('status', 'aktif')
            ->latest()
            ->get();

        $lokasi = Alumni::where('status', 'aktif')
            ->selectRaw('lokasi, COUNT(*) as total')
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

        $featuredAlumni = $daftar_alumni->first();
        $totalAlumni = $daftar_alumni->count();
        $totalLokasi = $lokasi->count();

        return view('pages.alumni', compact(
            'lokasi',
            'daftar_alumni',
            'featuredAlumni',
            'totalAlumni',
            'totalLokasi'
        ));
    }
}
