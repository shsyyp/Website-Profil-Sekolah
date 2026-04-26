<?php

namespace App\Http\Controllers;

// Wajib panggil semua model yang datanya mau ditampilin
use App\Models\Berita;
use App\Models\Alumni;
use App\Models\PMB;
use App\Models\Homepage; 

class HomeController extends Controller
{
    public function index()
    {
        // 1. Ambil data CMS Homepage (baris pertama)
        $homepage = Homepage::first(); 
        
        // 2. Ambil data PMB
        $pmb = PMB::first();

        // 3. Ambil 3 Berita terbaru yang statusnya 'publish'
        $berita = Berita::where('status', 'publish')->latest()->take(3)->get();

        // 4. Ambil 3 Alumni terbaru yang statusnya 'aktif'
        $alumni = Alumni::where('status', 'aktif')->latest()->take(3)->get();

        // 5. Lempar semua variabel di atas ke file blade 'pages/home.blade.php'
        return view('pages.home', compact('homepage', 'pmb', 'berita', 'alumni'));
    }
}