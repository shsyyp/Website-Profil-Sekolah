<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Wajib import modelnya
use App\Models\Berita;
use App\Models\Alumni;
use App\Models\PMB;
use App\Models\Homepage;

class HomeController extends Controller
{
    public function index()
    {
        // 1. Ambil data dari database
        $homepage = Homepage::first();
        $pmb      = PMB::first();
        $berita   = Berita::where('status', 'publish')->latest()->take(3)->get();
        $alumni   = Alumni::where('status', 'aktif')->latest()->take(3)->get();

        // 2. WAJIB: Lempar semua variabel ke Blade menggunakan compact()
        return view('pages.home', compact('homepage', 'pmb', 'berita', 'alumni'));
    }
}