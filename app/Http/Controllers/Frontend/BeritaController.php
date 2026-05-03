<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\NewsPageSetting;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    public function index(Request $request)
    {
        $kategoriAktif = $request->query('kategori');
        $keyword = $request->query('q');

        $daftar_berita = Berita::where('status', 'publish')
            ->when($kategoriAktif, fn ($query) => $query->where('kategori', $kategoriAktif))
            ->when($keyword, fn ($query) => $query->where(function ($query) use ($keyword) {
                $query->where('judul', 'like', "%{$keyword}%")
                    ->orWhere('isi', 'like', "%{$keyword}%");
            }))
            ->latest('tanggal')
            ->paginate(6)
            ->withQueryString();

        $beritaPopuler = Berita::where('status', 'publish')
            ->latest('tanggal')
            ->take(3)
            ->get();

        $kategoriBerita = Berita::where('status', 'publish')
            ->selectRaw('kategori, COUNT(*) as total')
            ->groupBy('kategori')
            ->orderBy('kategori')
            ->get();

        $settings = NewsPageSetting::first() ?? new NewsPageSetting();

        return view('pages.berita', compact(
            'daftar_berita',
            'beritaPopuler',
            'kategoriBerita',
            'kategoriAktif',
            'keyword',
            'settings'
        ));
    }
}
