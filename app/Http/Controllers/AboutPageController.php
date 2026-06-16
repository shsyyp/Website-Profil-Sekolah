<?php

namespace App\Http\Controllers;

use App\Models\AboutPage;
use Illuminate\Http\Request;

class AboutPageController extends Controller
{
    private function defaultFacilities(): array
    {
        return [
            ['icon' => 'biotech', 'title' => 'Lab Riset & Sains', 'desc' => 'Dilengkapi peralatan standar olimpiade internasional.'],
            ['icon' => 'auto_stories', 'title' => 'Perpustakaan Digital', 'desc' => 'Akses ke ribuan jurnal dan e-book global 24/7.'],
            ['icon' => 'sports_basketball', 'title' => 'Sport Center', 'desc' => 'Gedung olahraga indoor untuk basket, futsal, dan badminton.'],
            ['icon' => 'theater_comedy', 'title' => 'Teater Seni', 'desc' => 'Ruang pertunjukan dengan sistem tata suara mutakhir.'],
            ['icon' => 'apartment', 'title' => 'Asrama Siswa', 'desc' => 'Hunian nyaman dengan pembinaan karakter dan pengawasan terarah.'],
            ['icon' => 'restaurant', 'title' => 'Kantin Sehat', 'desc' => 'Area makan bersih dengan pilihan menu harian yang mendukung aktivitas siswa.'],
            ['icon' => 'computer', 'title' => 'Lab Komputer', 'desc' => 'Perangkat pembelajaran digital untuk coding, desain, dan riset teknologi.'],
            ['icon' => 'local_hospital', 'title' => 'UKS', 'desc' => 'Layanan kesehatan sekolah untuk kebutuhan pertolongan pertama siswa.'],
        ];
    }

    private function defaultExtracurriculars(): array
    {
        return [
            ['icon' => 'robot_2', 'title' => 'Robotic Club', 'desc' => 'Mengembangkan kecerdasan buatan dan perakitan mekanik robotik tingkat lanjut.'],
            ['icon' => 'public', 'title' => 'English Debate', 'desc' => 'Mengasah kemampuan argumentasi dan diplomasi internasional dalam bahasa Inggris.'],
            ['icon' => 'palette', 'title' => 'Visual Arts', 'desc' => 'Eksplorasi seni lukis, desain grafis, dan multimedia kreatif.'],
            ['icon' => 'campaign', 'title' => 'Journalism', 'desc' => 'Pelatihan penulisan berita, fotografi jurnalistik, dan penyiaran radio sekolah.'],
        ];
    }

    private function aboutPage(): AboutPage
    {
        return AboutPage::firstOrCreate([]);
    }

    private function facilityItems(AboutPage $about): array
    {
        $facilities = collect($about->facilities ?? [])
            ->filter(fn ($facility) => ($facility['title'] ?? null) || ($facility['desc'] ?? null) || ($facility['image'] ?? null))
            ->values()
            ->all();

        return $facilities ?: $this->defaultFacilities();
    }

    private function extracurricularItems(AboutPage $about): array
    {
        $extracurriculars = collect($about->extracurriculars ?? [])
            ->filter(fn ($item) => ($item['title'] ?? null) || ($item['desc'] ?? null) || ($item['icon'] ?? null))
            ->values()
            ->all();

        return $extracurriculars ?: $this->defaultExtracurriculars();
    }

    public function index()
    {
        $about = AboutPage::first() ?? new AboutPage();

        return view('admin.about.index', compact('about'));
    }

    public function update(Request $request)
    {
        $data = $request->except(['_token', 'facility_images', 'missions_text', 'active_panel']);
        $about = AboutPage::first();
        $data['missions'] = collect(preg_split('/\r\n|\r|\n/', (string) $request->input('missions_text', '')))
            ->map(fn ($mission) => trim(preg_replace('/^\s*\d+[\.\)]\s*/', '', $mission)))
            ->filter(fn ($mission) => filled($mission))
            ->values()
            ->all();

        if ($request->hasFile('hero_image')) {
            $data['hero_image'] = $request->file('hero_image')->store('about', 'public');
        }

        if ($request->hasFile('profile_image')) {
            $data['profile_image'] = $request->file('profile_image')->store('about', 'public');
        }

        if ($request->has('facilities') || $request->hasFile('facility_images')) {
            $facilities = $request->input('facilities', []);
            foreach ($request->file('facility_images', []) as $index => $image) {
                $facilities[$index]['image'] = $image->store('about', 'public');
            }
            $data['facilities'] = collect($facilities)
                ->filter(fn ($facility) => ($facility['title'] ?? null) || ($facility['desc'] ?? null) || ($facility['icon'] ?? null) || ($facility['image'] ?? null))
                ->values()
                ->all();
        }

        if ($about) {
            $about->update($data);
        } else {
            AboutPage::create($data);
        }

        return back()
            ->with('success', 'Halaman Tentang Kami berhasil diupdate!')
            ->with('open_about_panel', $request->input('active_panel'));
    }

    public function createFacility()
    {
        return view('admin.about.facility-create');
    }

    public function storeFacility(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'desc' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'max:2048'],
        ]);

        $about = $this->aboutPage();
        $facilities = $this->facilityItems($about);

        $facility = [
            'icon' => 'domain',
            'title' => $data['title'],
            'desc' => $data['desc'] ?? '',
            'image' => null,
        ];

        if ($request->hasFile('image')) {
            $facility['image'] = $request->file('image')->store('about', 'public');
        }

        $facilities[] = $facility;
        $about->update(['facilities' => $facilities]);

        return redirect()
            ->route('admin.about.index')
            ->with('success', 'Fasilitas berhasil ditambahkan!')
            ->with('open_facility_management', true);
    }

    public function editFacility(int $index)
    {
        $about = $this->aboutPage();
        $facilities = $this->facilityItems($about);
        abort_unless(isset($facilities[$index]), 404);

        return view('admin.about.facility-edit', [
            'facility' => $facilities[$index],
            'index' => $index,
        ]);
    }

    public function updateFacility(Request $request, int $index)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'desc' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'max:2048'],
        ]);

        $about = $this->aboutPage();
        $facilities = $this->facilityItems($about);
        abort_unless(isset($facilities[$index]), 404);

        $facilities[$index]['icon'] = $facilities[$index]['icon'] ?? 'domain';
        $facilities[$index]['title'] = $data['title'];
        $facilities[$index]['desc'] = $data['desc'] ?? '';

        if ($request->hasFile('image')) {
            $facilities[$index]['image'] = $request->file('image')->store('about', 'public');
        }

        $about->update(['facilities' => array_values($facilities)]);

        return redirect()
            ->route('admin.about.index')
            ->with('success', 'Fasilitas berhasil diupdate!')
            ->with('open_facility_management', true);
    }

    public function destroyFacility(int $index)
    {
        $about = $this->aboutPage();
        $facilities = $this->facilityItems($about);
        abort_unless(isset($facilities[$index]), 404);

        unset($facilities[$index]);
        $about->update(['facilities' => array_values($facilities)]);

        return redirect()
            ->route('admin.about.index')
            ->with('success', 'Fasilitas berhasil dihapus!')
            ->with('open_facility_management', true);
    }

    public function createExtracurricular()
    {
        return view('admin.about.extracurricular-create');
    }

    public function storeExtracurricular(Request $request)
    {
        $data = $request->validate([
            'icon' => ['nullable', 'string', 'max:100'],
            'title' => ['required', 'string', 'max:255'],
            'desc' => ['nullable', 'string'],
        ]);

        $about = $this->aboutPage();
        $extracurriculars = $this->extracurricularItems($about);

        $extracurriculars[] = [
            'icon' => $data['icon'] ?: 'groups',
            'title' => $data['title'],
            'desc' => $data['desc'] ?? '',
        ];

        $about->update(['extracurriculars' => $extracurriculars]);

        return redirect()
            ->route('admin.about.index')
            ->with('success', 'Ekstrakurikuler berhasil ditambahkan!')
            ->with('open_extracurricular_management', true);
    }

    public function editExtracurricular(int $index)
    {
        $about = $this->aboutPage();
        $extracurriculars = $this->extracurricularItems($about);
        abort_unless(isset($extracurriculars[$index]), 404);

        return view('admin.about.extracurricular-edit', [
            'extracurricular' => $extracurriculars[$index],
            'index' => $index,
        ]);
    }

    public function updateExtracurricular(Request $request, int $index)
    {
        $data = $request->validate([
            'icon' => ['nullable', 'string', 'max:100'],
            'title' => ['required', 'string', 'max:255'],
            'desc' => ['nullable', 'string'],
        ]);

        $about = $this->aboutPage();
        $extracurriculars = $this->extracurricularItems($about);
        abort_unless(isset($extracurriculars[$index]), 404);

        $extracurriculars[$index] = [
            'icon' => $data['icon'] ?: 'groups',
            'title' => $data['title'],
            'desc' => $data['desc'] ?? '',
        ];

        $about->update(['extracurriculars' => array_values($extracurriculars)]);

        return redirect()
            ->route('admin.about.index')
            ->with('success', 'Ekstrakurikuler berhasil diupdate!')
            ->with('open_extracurricular_management', true);
    }

    public function destroyExtracurricular(int $index)
    {
        $about = $this->aboutPage();
        $extracurriculars = $this->extracurricularItems($about);
        abort_unless(isset($extracurriculars[$index]), 404);

        unset($extracurriculars[$index]);
        $about->update(['extracurriculars' => array_values($extracurriculars)]);

        return redirect()
            ->route('admin.about.index')
            ->with('success', 'Ekstrakurikuler berhasil dihapus!')
            ->with('open_extracurricular_management', true);
    }
}
