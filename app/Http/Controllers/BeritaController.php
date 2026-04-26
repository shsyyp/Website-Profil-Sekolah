<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
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

        return view('admin.berita.index', compact('berita', 'totalBerita', 'totalPublished', 'totalDraft'));
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
            'kategori' => 'required',
            'isi' => 'required',
            'tanggal' => 'required|date',
            'status' => 'required|in:draft,publish',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('berita', 'public');
        }

        Berita::create($data);

        return redirect()->route('berita.index')->with('success', 'Berita berhasil ditambahkan');
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
            'kategori' => 'required',
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

        return redirect()->route('berita.index')->with('success', 'Berita berhasil diupdate');
    }

    // Menghapus berita
    public function destroy(Berita $beritum)
    {
        if ($beritum->gambar) {
            Storage::disk('public')->delete($beritum->gambar);
        }
        
        $beritum->delete();

        return back()->with('success', 'Berita berhasil dihapus');
    }
}