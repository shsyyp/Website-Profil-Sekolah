<?php

namespace App\Http\Controllers;

use App\Models\AboutPage;
use Illuminate\Http\Request;

class AboutPageController extends Controller
{
    public function index()
    {
        $about = AboutPage::first() ?? new AboutPage();

        return view('admin.about.index', compact('about'));
    }

    public function update(Request $request)
    {
        $data = $request->except(['_token', 'facility_images']);
        $about = AboutPage::first();

        if ($request->hasFile('hero_image')) {
            $data['hero_image'] = $request->file('hero_image')->store('about', 'public');
        }

        if ($request->hasFile('profile_image')) {
            $data['profile_image'] = $request->file('profile_image')->store('about', 'public');
        }

        $facilities = $request->input('facilities', []);
        foreach ($request->file('facility_images', []) as $index => $image) {
            $facilities[$index]['image'] = $image->store('about', 'public');
        }
        $data['facilities'] = collect($facilities)
            ->filter(fn ($facility) => ($facility['title'] ?? null) || ($facility['desc'] ?? null) || ($facility['icon'] ?? null) || ($facility['image'] ?? null))
            ->values()
            ->all();

        if ($about) {
            $about->update($data);
        } else {
            AboutPage::create($data);
        }

        return back()->with('success', 'Halaman Tentang Kami berhasil diupdate!');
    }
}
