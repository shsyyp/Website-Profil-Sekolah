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
        $rules = [
            'hero_title' => ['required', 'string', 'max:255'],
            'hero_subtitle' => ['required', 'string'],
            'hero_image' => ['nullable', 'image', 'max:4096'],
            'success_title' => ['required', 'string', 'max:255'],
            'success_desc' => ['required', 'string'],
            'success_image' => ['nullable', 'image', 'max:4096'],
            'about_title' => ['required', 'string', 'max:255'],
            'about_desc' => ['required', 'string'],
            'accreditation_title' => ['required', 'string', 'max:255'],
            'accreditation_desc' => ['required', 'string', 'max:255'],
            'tradisi' => ['required', 'array', 'size:4'],
            'tradisi.*.title' => ['required', 'string', 'max:255'],
            'tradisi.*.desc' => ['required', 'string'],
            'facilities_title' => ['required', 'string', 'max:255'],
            'facilities_subtitle' => ['required', 'string'],
            'news_title' => ['required', 'string', 'max:255'],
            'news_subtitle' => ['required', 'string'],
            'news_limit' => ['required', 'integer', 'in:3,4,6'],
            'alumni_label' => ['required', 'string', 'max:255'],
            'alumni_title' => ['required', 'string', 'max:255'],
            'selected_alumni_ids' => ['nullable', 'array', 'max:3'],
            'selected_alumni_ids.*' => ['nullable', 'integer', 'distinct', 'exists:alumni,id'],
            'cta_title' => ['required', 'string', 'max:255'],
            'cta_desc' => ['required', 'string'],
            'cta_secondary_button' => ['required', 'string', 'max:255'],
            'cta_secondary_link' => ['required', 'string', 'max:2048'],
            'cta_year' => ['required', 'string', 'max:20'],
            'cta_deadline_at' => ['required', 'date'],
            'cta_closed_message' => ['required', 'string', 'max:255'],
            'site_name' => ['required', 'string', 'max:255'],
            'footer_desc' => ['required', 'string'],
            'footer_whatsapp_url' => ['nullable', 'url:http,https', 'max:2048'],
            'footer_instagram_url' => ['nullable', 'url:http,https', 'max:2048'],
            'footer_facebook_url' => ['nullable', 'url:http,https', 'max:2048'],
            'footer_youtube_url' => ['nullable', 'url:http,https', 'max:2048'],
            'footer_address' => ['required', 'string', 'max:500'],
            'footer_email' => ['required', 'email', 'max:255'],
            'footer_phone' => ['required', 'string', 'max:50'],
            'footer_operational_hours' => ['required', 'string'],
            'footer_copyright' => ['required', 'string', 'max:255'],
            'footer_note' => ['required', 'string', 'max:255'],
        ];
        $fieldsByPanel = [
            'hero-section' => ['hero_title', 'hero_subtitle', 'hero_image', 'success_title', 'success_desc', 'success_image'],
            'tradisi-section' => ['about_title', 'about_desc', 'accreditation_title', 'accreditation_desc', 'tradisi', 'tradisi.*.title', 'tradisi.*.desc'],
            'fasilitas-section' => ['facilities_title', 'facilities_subtitle'],
            'berita-section' => ['news_title', 'news_subtitle', 'news_limit'],
            'alumni-section' => ['alumni_label', 'alumni_title', 'selected_alumni_ids', 'selected_alumni_ids.*'],
            'cta-section' => ['cta_title', 'cta_desc', 'cta_secondary_button', 'cta_secondary_link', 'cta_year', 'cta_deadline_at', 'cta_closed_message'],
            'footer-section' => ['site_name', 'footer_desc', 'footer_whatsapp_url', 'footer_instagram_url', 'footer_facebook_url', 'footer_youtube_url', 'footer_address', 'footer_email', 'footer_phone', 'footer_operational_hours', 'footer_copyright', 'footer_note'],
        ];
        $rules = array_intersect_key($rules, array_flip($fieldsByPanel[$request->input('active_panel')] ?? []));

        $request->validate($rules, [
            'required' => 'Kolom :attribute wajib diisi.',
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
