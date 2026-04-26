<?php

namespace App\Http\Controllers;

use App\Models\PMB;
use Illuminate\Http\Request;

class PMBController extends Controller
{
    // Menampilkan form CMS PMB
    public function index()
    {
        // Mengambil baris pertama, atau kosong jika belum ada
        $pmb = PMB::first(); 
        return view('admin.pmb.index', compact('pmb'));
    }

    // Menyimpan / Memperbarui data PMB
    public function update(Request $request)
    {
        $data = $request->validate([
            'alur'             => 'required',
            'persyaratan_umum' => 'required',
            'berkas'           => 'required',
            'jadwal'           => 'required',
            'faq'              => 'required',
            'link_pendaftaran' => 'nullable|url'
        ], [
            'link_pendaftaran.url' => 'Format link harus berupa URL valid (contoh: https://...)',
            'required' => 'Kolom ini wajib diisi.'
        ]);

        $pmb = PMB::first();

        if ($pmb) {
            $pmb->update($data); // Update jika data sudah ada
        } else {
            PMB::create($data); // Create jika database masih kosong
        }

        return back()->with('success', 'Data informasi PMB berhasil diperbarui!');
    }
}