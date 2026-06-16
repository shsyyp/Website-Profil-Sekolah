<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;
use App\Models\Alumni;
use App\Models\AboutPage;
use App\Models\Chatbot;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBerita = Berita::count();
        $totalPublishedBerita = Berita::where('status', 'publish')->count();
        $berita_terbaru = Berita::latest('tanggal')->latest('created_at')->take(5)->get();
        $bulanLabels = [
            1 => 'Jan',
            2 => 'Feb',
            3 => 'Mar',
            4 => 'Apr',
            5 => 'Mei',
            6 => 'Jun',
            7 => 'Jul',
            8 => 'Agu',
            9 => 'Sep',
            10 => 'Okt',
            11 => 'Nov',
            12 => 'Des',
        ];
        $beritaPerBulan = collect(range(5, 0))
            ->map(function ($monthsAgo) use ($bulanLabels) {
                $month = now()->subMonths($monthsAgo);
                $count = Berita::whereYear('tanggal', $month->year)
                    ->whereMonth('tanggal', $month->month)
                    ->count();

                return [
                    'label' => $bulanLabels[$month->month] . ' ' . $month->format('y'),
                    'total' => $count,
                ];
            });

        $about = AboutPage::first() ?? new AboutPage();
        $totalFasilitas = collect($about->facilities ?? [])
            ->filter(fn ($facility) => ($facility['title'] ?? null) || ($facility['desc'] ?? null) || ($facility['image'] ?? null))
            ->count();
        $totalEkstrakurikuler = collect($about->extracurriculars ?? [])
            ->filter(fn ($item) => ($item['title'] ?? null) || ($item['desc'] ?? null) || ($item['icon'] ?? null))
            ->count();

        $totalAlumni = Alumni::count();
        $alumni_terbaru = Alumni::latest()->take(3)->get();
        $alumniPerAngkatan = Alumni::selectRaw('tahun_lulus, COUNT(*) as total')
            ->groupBy('tahun_lulus')
            ->orderBy('tahun_lulus')
            ->get()
            ->map(fn ($item) => [
                'label' => (string) $item->tahun_lulus,
                'total' => (int) $item->total,
            ]);

        $totalChatbot = Chatbot::count();
        $chatbotData = Chatbot::latest()->take(3)->get();

        return view('admin.dashboard', [
            'totalBerita'    => $totalBerita,
            'totalPublishedBerita' => $totalPublishedBerita,
            'totalFasilitas' => $totalFasilitas,
            'totalEkstrakurikuler' => $totalEkstrakurikuler,
            'beritaPerBulan' => $beritaPerBulan,
            'alumniPerAngkatan' => $alumniPerAngkatan,
            'berita_terbaru' => $berita_terbaru,
            'totalAlumni'    => $totalAlumni,
            'alumni_terbaru' => $alumni_terbaru,
            'totalChatbot'   => $totalChatbot,
            'chatbot'        => $chatbotData
        ]);
    }
}
