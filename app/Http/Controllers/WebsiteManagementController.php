<?php

namespace App\Http\Controllers;

use App\Models\AboutPage;
use App\Models\Alumni;
use App\Models\AlumniPageSetting;
use App\Models\Berita;
use App\Models\HomepageSetting;
use App\Models\NewsPageSetting;
use App\Models\PMB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WebsiteManagementController extends Controller
{
    public function index()
    {
        return redirect()->route('admin.website.section', 'beranda');
    }

    public function section(string $section)
    {
        $homepage = HomepageSetting::with(['highlights', 'facilities'])->first() ?? HomepageSetting::create();
        $about = AboutPage::first() ?? new AboutPage();
        $pmb = PMB::first() ?? new PMB();
        $newsSetting = NewsPageSetting::first() ?? NewsPageSetting::create();
        $alumniSetting = AlumniPageSetting::first() ?? AlumniPageSetting::create();
        $alumniOptions = Alumni::latest()->get();
        $berita = Berita::latest('tanggal')->latest('created_at')->take(8)->get();
        $alumni = Alumni::latest()->take(8)->get();

        $stats = [
            'totalBerita' => Berita::count(),
            'totalPublished' => Berita::where('status', 'publish')->count(),
            'totalDraft' => Berita::where('status', 'draft')->count(),
            'totalAlumni' => Alumni::count(),
            'alumniAktif' => Alumni::count(),
        ];

        abort_unless(in_array($section, ['beranda', 'tentang', 'berita', 'pmb', 'alumni'], true), 404);
        $activeSection = $section;

        return view('admin.website-management.index', compact(
            'homepage',
            'about',
            'pmb',
            'newsSetting',
            'alumniSetting',
            'alumniOptions',
            'berita',
            'alumni',
            'stats',
            'activeSection'
        ));
    }

    public function updateHomepage(Request $request)
    {
        return app(HomepageController::class)->update($request);
    }

    public function updateAbout(Request $request)
    {
        return app(AboutPageController::class)->update($request);
    }

    public function updatePmb(Request $request)
    {
        return app(PMBController::class)->update($request);
    }

    public function updateNews(Request $request)
    {
        $data = $request->validate([
            'hero_breadcrumb_label' => ['nullable', 'string', 'max:255'],
            'hero_title' => ['nullable', 'string', 'max:255'],
            'hero_description' => ['nullable', 'string'],
            'filter_all_label' => ['nullable', 'string', 'max:255'],
            'search_placeholder' => ['nullable', 'string', 'max:255'],
            'popular_title' => ['nullable', 'string', 'max:255'],
            'categories_title' => ['nullable', 'string', 'max:255'],
            'newsletter_title' => ['nullable', 'string', 'max:255'],
            'newsletter_description' => ['nullable', 'string'],
            'newsletter_placeholder' => ['nullable', 'string', 'max:255'],
            'newsletter_button_text' => ['nullable', 'string', 'max:255'],
        ]);

        $setting = NewsPageSetting::first() ?? new NewsPageSetting();
        $setting->fill($data)->save();

        return back()->with('success', 'Pengaturan halaman Berita berhasil diperbarui!');
    }

    public function updateAlumni(Request $request)
    {
        $data = $request->validate([
            'hero_breadcrumb_label' => ['nullable', 'string', 'max:255'],
            'hero_title' => ['nullable', 'string', 'max:255'],
            'hero_description' => ['nullable', 'string'],
            'hero_image' => ['nullable', 'image', 'max:2048'],
            'stats' => ['nullable', 'array'],
            'stats.*.icon' => ['nullable', 'string', 'max:255'],
            'stats.*.value' => ['nullable', 'string', 'max:255'],
            'stats.*.label' => ['nullable', 'string', 'max:255'],
            'map_label' => ['nullable', 'string', 'max:255'],
            'map_title' => ['nullable', 'string', 'max:255'],
            'map_description' => ['nullable', 'string'],
            'map_image' => ['nullable', 'image', 'max:2048'],
            'featured_badge' => ['nullable', 'string', 'max:255'],
            'featured_button_text' => ['nullable', 'string', 'max:255'],
            'grid_title' => ['nullable', 'string', 'max:255'],
            'grid_description' => ['nullable', 'string'],
            'grid_button_text' => ['nullable', 'string', 'max:255'],
            'testimonial_quote' => ['nullable', 'string'],
            'testimonial_name' => ['nullable', 'string', 'max:255'],
            'testimonial_meta' => ['nullable', 'string', 'max:255'],
            'testimonial_alumni_ids' => ['nullable', 'array'],
            'testimonial_alumni_ids.*' => ['nullable', 'integer', 'exists:alumni,id'],
            'cta_title' => ['nullable', 'string', 'max:255'],
            'cta_description' => ['nullable', 'string'],
            'cta_primary_text' => ['nullable', 'string', 'max:255'],
            'cta_primary_link' => ['nullable', 'string', 'max:255'],
            'cta_secondary_text' => ['nullable', 'string', 'max:255'],
            'cta_secondary_link' => ['nullable', 'string', 'max:255'],
        ]);
        $data['testimonial_alumni_ids'] = collect($request->input('testimonial_alumni_ids', []))
            ->map(fn ($id) => (int) $id)
            ->filter()
            ->unique()
            ->take(5)
            ->values()
            ->all();

        $setting = AlumniPageSetting::first() ?? new AlumniPageSetting();

        foreach (['hero_image', 'map_image'] as $imageField) {
            if ($request->hasFile($imageField)) {
                if ($setting->{$imageField}) {
                    Storage::disk('public')->delete($setting->{$imageField});
                }

                $data[$imageField] = $request->file($imageField)->store('alumni-page', 'public');
            }
        }

        $setting->fill($data)->save();

        return back()->with('success', 'Pengaturan halaman Alumni berhasil diperbarui!');
    }
}
