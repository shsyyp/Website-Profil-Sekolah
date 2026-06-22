<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use App\Models\AlumniPageSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AlumniController extends Controller
{
    public function index()
    {
        $alumni = Alumni::latest()->paginate(10);
        $allAlumni = Alumni::latest()->get();
        
        // Query distinktif buat visualisasi map persebaran nanti
        $lokasi_sebaran = Alumni::select('lokasi')->distinct()->get();
        $settings = AlumniPageSetting::first() ?? new AlumniPageSetting();
        
        return view('admin.alumni.index', compact('alumni', 'allAlumni', 'lokasi_sebaran', 'settings'));
    }

    public function updatePageSetting(Request $request)
    {
        $data = $request->validate([
            'hero_breadcrumb_label' => 'nullable|string|max:255',
            'hero_title' => 'nullable|string|max:255',
            'hero_description' => 'nullable|string',
            'hero_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'stats' => 'nullable|array',
            'stats.*.icon' => 'nullable|string|max:255',
            'stats.*.value' => 'nullable|string|max:255',
            'stats.*.label' => 'nullable|string|max:255',
            'map_label' => 'nullable|string|max:255',
            'map_title' => 'nullable|string|max:255',
            'map_description' => 'nullable|string',
            'map_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'featured_badge' => 'nullable|string|max:255',
            'featured_button_text' => 'nullable|string|max:255',
            'grid_title' => 'nullable|string|max:255',
            'grid_description' => 'nullable|string',
            'grid_button_text' => 'nullable|string|max:255',
            'testimonial_quote' => 'nullable|string',
            'testimonial_name' => 'nullable|string|max:255',
            'testimonial_meta' => 'nullable|string|max:255',
            'testimonial_alumni_ids' => 'nullable|array',
            'testimonial_alumni_ids.*' => 'nullable|integer|exists:alumni,id',
            'cta_title' => 'nullable|string|max:255',
            'cta_description' => 'nullable|string',
            'cta_primary_text' => 'nullable|string|max:255',
            'cta_primary_link' => 'nullable|string|max:255',
            'cta_secondary_text' => 'nullable|string|max:255',
            'cta_secondary_link' => 'nullable|string|max:255',
            'active_panel' => 'nullable|string|max:255',
        ]);
        $activePanel = $data['active_panel'] ?? null;
        unset($data['active_panel']);
        $data['testimonial_alumni_ids'] = collect($request->input('testimonial_alumni_ids', []))
            ->map(fn ($id) => (int) $id)
            ->filter()
            ->unique()
            ->take(5)
            ->values()
            ->all();

        $settings = AlumniPageSetting::first();

        if ($request->hasFile('hero_image')) {
            if ($settings?->hero_image) {
                Storage::disk('public')->delete($settings->hero_image);
            }
            $data['hero_image'] = $request->file('hero_image')->store('alumni-page', 'public');
        }

        if ($request->hasFile('map_image')) {
            if ($settings?->map_image) {
                Storage::disk('public')->delete($settings->map_image);
            }
            $data['map_image'] = $request->file('map_image')->store('alumni-page', 'public');
        }

        if ($settings) {
            $settings->update($data);
        } else {
            AlumniPageSetting::create($data);
        }

        return back()
            ->with('success', 'Tampilan halaman alumni berhasil diupdate!')
            ->with('open_alumni_panel', $activePanel);
    }

    public function create()
    {
        $locationOptions = $this->locationOptions();

        return view('admin.alumni.create', compact('locationOptions'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama'        => 'required',
            'profesi'     => 'required',
            'instansi'    => 'nullable',
            'tahun_lulus' => 'required|numeric',
            'lokasi'      => 'required',
            'deskripsi'   => 'nullable|string',
            'foto'        => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('alumni', 'public');
        }

        Alumni::create($data);

        return redirect()
            ->route('alumni.index')
            ->with('success', 'Data alumni berhasil ditambahkan')
            ->with('open_alumni_management', true);
    }

    public function edit($id)
    {
        $alumnus = Alumni::findOrFail($id);
        $locationOptions = $this->locationOptions($alumnus->lokasi);

        return view('admin.alumni.edit', compact('alumnus', 'locationOptions'));
    }

    public function update(Request $request, $id)
    {
        $alumnus = Alumni::findOrFail($id);

        $data = $request->validate([
            'nama'        => 'required',
            'profesi'     => 'required',
            'instansi'    => 'nullable',
            'tahun_lulus' => 'required|numeric',
            'lokasi'      => 'required',
            'deskripsi'   => 'nullable|string',
            'foto'        => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            if ($alumnus->foto) {
                Storage::disk('public')->delete($alumnus->foto);
            }
            $data['foto'] = $request->file('foto')->store('alumni', 'public');
        }

        $alumnus->update($data);

        return redirect()
            ->route('alumni.index')
            ->with('success', 'Data alumni berhasil diupdate')
            ->with('open_alumni_management', true);
    }

    public function destroy($id)
    {
        $alumnus = Alumni::findOrFail($id);
        
        if ($alumnus->foto) {
            Storage::disk('public')->delete($alumnus->foto);
        }

        $this->syncTestimonialSelection($alumnus->id, false);
        
        $alumnus->delete();
        
        return back()
            ->with('success', 'Data alumni berhasil dihapus')
            ->with('open_alumni_management', true);
    }

    private function locationOptions(?string $currentLocation = null): array
    {
        $locations = [
            'Pekanbaru',
            'Jakarta',
            'Bandung',
            'Yogyakarta',
            'Surabaya',
            'Medan',
            'Padang',
            'Batam',
            'Malang',
            'Semarang',
            'Bogor',
            'Depok',
            'Tangerang',
            'Bekasi',
            'Makassar',
            'Palembang',
            'Denpasar',
            'Banda Aceh',
            'Jambi',
            'Bengkulu',
            'Bandar Lampung',
            'Pangkalpinang',
            'Tanjungpinang',
            'Serang',
            'Cirebon',
            'Solo',
            'Madiun',
            'Kediri',
            'Batu',
            'Pontianak',
            'Palangka Raya',
            'Banjarmasin',
            'Samarinda',
            'Balikpapan',
            'Tarakan',
            'Manado',
            'Palu',
            'Kendari',
            'Gorontalo',
            'Mamuju',
            'Ambon',
            'Ternate',
            'Mataram',
            'Kupang',
            'Jayapura',
            'Sorong',
        ];

        if ($currentLocation && ! in_array($currentLocation, $locations, true)) {
            array_unshift($locations, $currentLocation);
        }

        return array_values(array_unique($locations));
    }

    private function syncTestimonialSelection(int $alumniId, bool $showInTestimonial): void
    {
        $settings = AlumniPageSetting::firstOrCreate([]);
        $selectedIds = collect($settings->testimonial_alumni_ids ?? [])
            ->map(fn ($id) => (int) $id)
            ->filter()
            ->unique();

        $selectedIds = $showInTestimonial
            ? $selectedIds->push($alumniId)->unique()->take(5)
            : $selectedIds->reject(fn ($id) => $id === $alumniId);

        $settings->update([
            'testimonial_alumni_ids' => $selectedIds->values()->all(),
        ]);
    }
}
