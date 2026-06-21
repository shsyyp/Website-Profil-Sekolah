<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AboutPage;
use App\Models\Homepage;
use App\Models\Alumni;

class HomepageController extends Controller
{
    public function index()
    {
        $homepage = Homepage::first() ?? new Homepage();
        $about = AboutPage::first() ?? new AboutPage();
        $alumni = Alumni::latest()->get();

        return view('admin.homepage.index', compact('homepage', 'about', 'alumni'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'selected_alumni_ids' => ['nullable', 'array', 'max:3'],
            'selected_alumni_ids.*' => ['nullable', 'integer', 'distinct', 'exists:alumni,id'],
            'cta_title' => ['nullable', 'string', 'max:255'],
            'cta_desc' => ['nullable', 'string'],
            'cta_secondary_button' => ['nullable', 'string', 'max:255'],
            'cta_secondary_link' => ['nullable', 'string', 'max:2048'],
            'cta_closed_message' => ['nullable', 'string', 'max:255'],
        ], [
            'selected_alumni_ids.*.distinct' => 'Alumni yang sama tidak boleh dipilih lebih dari satu kali.',
            'selected_alumni_ids.*.exists' => 'Data alumni yang dipilih tidak ditemukan.',
        ]);

        $data = $request->except(['_token', 'active_panel', 'facility_selection']);
        $availableFacilityIds = collect(AboutPage::first()?->facilities ?? [])
            ->pluck('id')
            ->filter()
            ->map(fn ($id) => (string) $id);
        $selectedFacilityIds = collect($request->input('facility_selection', []))
            ->map(fn ($id) => (string) $id)
            ->unique();
        $data['fasilitas'] = $availableFacilityIds
            ->filter(fn ($id) => $selectedFacilityIds->contains($id))
            ->take(4)
            ->values()
            ->all();
        $data['selected_alumni_ids'] = collect($request->input('selected_alumni_ids', []))
            ->filter(fn ($id) => $id !== null && $id !== '')
            ->map(fn ($id) => (int) $id)
            ->unique()
            ->take(3)
            ->values()
            ->all();
        $data['featured_alumni_id'] = $data['selected_alumni_ids'][0] ?? null;
        $data['cta_deadline_at'] = $request->filled('cta_deadline_at')
            ? $request->input('cta_deadline_at')
            : null;
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

        return back()
            ->with('success', 'Beranda berhasil diupdate!')
            ->with('open_homepage_panel', $request->input('active_panel'));
    }
}
