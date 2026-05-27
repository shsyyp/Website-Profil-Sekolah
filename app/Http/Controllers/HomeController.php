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
        $homepage = Homepage::first(); 
        $pmb = PMB::first();
        $newsLimit = max(1, min(6, (int) ($homepage?->news_limit ?? 3)));

        $berita = Berita::where('status', 'publish')
            ->latest()
            ->take($newsLimit)
            ->get();

        $alumniQuery = Alumni::query();

        if ($homepage?->featured_alumni_id) {
            $alumniQuery->orderByRaw('id = ? DESC', [$homepage->featured_alumni_id]);
        } else {
            $alumniQuery->latest();
        }

        $alumni = $alumniQuery->take(3)->get();

        return view('pages.home', compact('homepage', 'pmb', 'berita', 'alumni'));
    }
}
