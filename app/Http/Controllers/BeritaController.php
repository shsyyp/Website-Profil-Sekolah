<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\NewsPageSetting;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{
    // Menampilkan daftar berita
    public function index()
    {
        $berita = Berita::latest()->paginate(10);
        $totalBerita = Berita::count();
        $totalPublished = Berita::where('status', 'publish')->count();
        $totalDraft = Berita::where('status', 'draft')->count();
        $settings = NewsPageSetting::first() ?? new NewsPageSetting();

        return view('admin.berita.index', compact('berita', 'totalBerita', 'totalPublished', 'totalDraft', 'settings'));
    }

    public function updatePageSetting(Request $request)
    {
        $data = $request->validate([
            'hero_breadcrumb_label' => 'nullable|string|max:255',
            'hero_title' => 'nullable|string|max:255',
            'hero_description' => 'nullable|string',
            'filter_all_label' => 'nullable|string|max:255',
            'search_placeholder' => 'nullable|string|max:255',
            'popular_title' => 'nullable|string|max:255',
            'categories_title' => 'nullable|string|max:255',
            'newsletter_title' => 'nullable|string|max:255',
            'newsletter_description' => 'nullable|string',
            'newsletter_placeholder' => 'nullable|string|max:255',
            'newsletter_button_text' => 'nullable|string|max:255',
            'active_panel' => 'nullable|string|max:255',
        ]);
        $activePanel = $data['active_panel'] ?? null;
        unset($data['active_panel']);

        $settings = NewsPageSetting::first();

        if ($settings) {
            $settings->update($data);
        } else {
            NewsPageSetting::create($data);
        }

        return back()
            ->with('success', 'Tampilan halaman berita berhasil diupdate!')
            ->with('open_news_panel', $activePanel);
    }

    // Menampilkan form tambah berita
    public function create()
    {
        return view('admin.berita.create');
    }

    // Menyimpan berita baru ke database
    public function store(Request $request)
    {
        $data = $request->validate([
            'judul' => 'required',
            'kategori' => ['required', Rule::in(['Prestasi', 'Kegiatan', 'Pengumuman'])],
            'isi' => 'required',
            'tanggal' => 'required|date',
            'status' => 'required|in:draft,publish',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('berita', 'public');
        }

        Berita::create($data);

        return redirect()
            ->route('berita.index')
            ->with('success', 'Berita berhasil ditambahkan')
            ->with('open_news_management', true);
    }

    // Menampilkan form edit berita
    public function edit(Berita $beritum) // Laravel menggunakan 'beritum' sbg singular dari 'beritas'
    {
        return view('admin.berita.edit', ['berita' => $beritum]);
    }

    // Memperbarui berita di database
    public function update(Request $request, Berita $beritum)
    {
        $data = $request->validate([
            'judul' => 'required',
            'kategori' => ['required', Rule::in(array_unique([
                'Prestasi',
                'Kegiatan',
                'Pengumuman',
                $beritum->kategori,
            ]))],
            'isi' => 'required',
            'tanggal' => 'required|date',
            'status' => 'required|in:draft,publish',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($beritum->gambar) {
                Storage::disk('public')->delete($beritum->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('berita', 'public');
        }

        $beritum->update($data);

        return redirect()
            ->route('berita.index')
            ->with('success', 'Berita berhasil diupdate')
            ->with('open_news_management', true);
    }

    // Menghapus berita
    public function destroy(Berita $beritum)
    {
        if ($beritum->gambar) {
            Storage::disk('public')->delete($beritum->gambar);
        }
        
        $beritum->delete();

        return redirect()
            ->route('berita.index')
            ->with('success', 'Berita berhasil dihapus')
            ->with('open_news_management', true);
    }
}
