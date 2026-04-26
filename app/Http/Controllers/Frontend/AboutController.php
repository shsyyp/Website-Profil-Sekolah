<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AboutPage;

class AboutController extends Controller
{
    public function index()
    {
        $about = AboutPage::first();

        return view('pages.tentang', compact('about'));
    }
}
