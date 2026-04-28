<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Homepage;
use App\Models\Alumni;

class HomepageController extends Controller
{
    public function index()
    {
        $homepage = Homepage::first() ?? new Homepage();
        $alumni = Alumni::where('status', 'aktif')->get();

        return view('admin.homepage.index', compact('homepage', 'alumni'));
    }

    public function update(Request $request)
    {
        $data = $request->except(['_token']);
        $homepage = Homepage::first();

        if ($request->hasFile('hero_image')) {
            $data['hero_image'] = $request->file('hero_image')->store('homepage', 'public');
        }

        if ($request->hasFile('success_image')) {
            $data['success_image'] = $request->file('success_image')->store('homepage', 'public');
        }

        if ($request->hasFile('facility_main_image')) {
            $data['facility_main_image'] = $request->file('facility_main_image')->store('homepage', 'public');
        }

        if ($request->hasFile('facility_side_image')) {
            $data['facility_side_image'] = $request->file('facility_side_image')->store('homepage', 'public');
        }

        if ($homepage) {
            $homepage->update($data);
        } else {
            Homepage::create($data);
        }

        return back()->with('success', 'Beranda berhasil diupdate!');
    }
}
