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

        $selectedAlumniIds = collect($homepage?->selected_alumni_ids ?? [])
            ->map(fn ($id) => (int) $id)
            ->filter()
            ->unique()
            ->take(3)
            ->values();

        if ($selectedAlumniIds->isEmpty() && $homepage?->featured_alumni_id) {
            $selectedAlumniIds = collect([(int) $homepage->featured_alumni_id]);
        }

        if ($selectedAlumniIds->isNotEmpty()) {
            $selectedAlumni = Alumni::where('status', 'aktif')
                ->whereIn('id', $selectedAlumniIds)
                ->get()
                ->sortBy(fn ($item) => $selectedAlumniIds->search($item->id))
                ->values();

            $alumni = $selectedAlumni
                ->merge(
                    Alumni::where('status', 'aktif')
                        ->whereNotIn('id', $selectedAlumniIds)
                        ->latest()
                        ->take(3 - $selectedAlumni->count())
                        ->get()
                )
                ->take(3)
                ->values();
        } else {
            $alumni = Alumni::where('status', 'aktif')
                ->latest()
                ->take(3)
                ->get();
        }

        return view('pages.home', compact('homepage', 'about', 'pmb', 'berita', 'alumni'));
    }
}
