<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AlumniController extends Controller
{
    public function index()
    {
        $alumni = Alumni::latest()->paginate(10);
        
        // Query distinktif buat visualisasi map persebaran nanti
        $lokasi_sebaran = Alumni::select('lokasi')->distinct()->get();
        
        return view('admin.alumni.index', compact('alumni', 'lokasi_sebaran'));
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