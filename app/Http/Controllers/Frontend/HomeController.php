<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Wajib import modelnya
use App\Models\Berita;
use App\Models\Alumni;
use App\Models\AboutPage;
use App\Models\PMB;
use App\Models\Homepage;

class HomeController extends Controller
{
    public function index()
    {
        $homepage = Homepage::first();
        $about    = AboutPage::first();
        $pmb      = PMB::first();
        $newsLimit = max(1, min(6, (int) ($homepage?->news_limit ?? 3)));

        $berita = Berita::where('status', 'publish')
            ->latest()
            ->take($newsLimit)
            ->get();

        $alumniQuery = Alumni::where('status', 'aktif');

        if ($homepage?->featured_alumni_id) {
            $alumniQuery->orderByRaw('id = ? DESC', [$homepage->featured_alumni_id]);
        } else {
            $alumniQuery->latest();
        }

        $alumni = $alumniQuery->take(3)->get();

        return view('pages.home', compact('homepage', 'about', 'pmb', 'berita', 'alumni'));
    }
}
