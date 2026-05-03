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
        
        // Query distinktif buat visualisasi map persebaran nanti
        $lokasi_sebaran = Alumni::select('lokasi')->distinct()->get();
        $settings = AlumniPageSetting::first() ?? new AlumniPageSetting();
        
        return view('admin.alumni.index', compact('alumni', 'lokasi_sebaran', 'settings'));
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
            'cta_title' => 'nullable|string|max:255',
            'cta_description' => 'nullable|string',
            'cta_primary_text' => 'nullable|string|max:255',
            'cta_primary_link' => 'nullable|string|max:255',
            'cta_secondary_text' => 'nullable|string|max:255',
            'cta_secondary_link' => 'nullable|string|max:255',
        ]);

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

        return back()->with('success', 'Tampilan halaman alumni berhasil diupdate!');
    }

    public function create()
    {
        return view('admin.alumni.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama'        => 'required',
            'profesi'     => 'required',
            'instansi'    => 'nullable',
            'tahun_lulus' => 'required|numeric',
            'lokasi'      => 'required',
            'status'      => 'required|in:aktif,nonaktif',
            'foto'        => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('alumni', 'public');
        }

        Alumni::create($data);

        return redirect()->route('alumni.index')->with('success', 'Data alumni berhasil ditambahkan');
    }

    public function edit($id)
    {
        $alumnus = Alumni::findOrFail($id);
        return view('admin.alumni.edit', compact('alumnus'));
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
            'status'      => 'required|in:aktif,nonaktif',
            'foto'        => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        if ($request->hasFile('foto')) {
            if ($alumnus->foto) {
                Storage::disk('public')->delete($alumnus->foto);
            }
            $data['foto'] = $request->file('foto')->store('alumni', 'public');
        }

        $alumnus->update($data);

        return redirect()->route('alumni.index')->with('success', 'Data alumni berhasil diupdate');
    }

    public function destroy($id)
    {
        $alumnus = Alumni::findOrFail($id);
        
        if ($alumnus->foto) {
            Storage::disk('public')->delete($alumnus->foto);
        }
        
        $alumnus->delete();
        
        return back()->with('success', 'Data alumni berhasil dihapus');
    }
}
