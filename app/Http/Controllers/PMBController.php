<?php

namespace App\Http\Controllers;

use App\Models\PMB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            'hero_badge' => 'nullable|string|max:255',
            'hero_title' => 'nullable|string|max:255',
            'hero_description' => 'nullable|string',
            'hero_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'hero_card_title' => 'nullable|string|max:255',
            'hero_card_subtitle' => 'nullable|string|max:255',
            'alur' => 'nullable|string',
            'persyaratan_umum' => 'nullable|string',
            'berkas' => 'nullable|string',
            'jadwal' => 'nullable|string',
            'faq' => 'nullable|string',
            'link_pendaftaran' => 'nullable|url',
            'primary_button_text' => 'nullable|string|max:255',
            'secondary_button_text' => 'nullable|string|max:255',
            'steps_label' => 'nullable|string|max:255',
            'steps_title' => 'nullable|string|max:255',
            'timeline_title' => 'nullable|string|max:255',
            'timeline_description' => 'nullable|string',
            'faq_title' => 'nullable|string|max:255',
            'faq_description' => 'nullable|string',
            'testimonials_title' => 'nullable|string|max:255',
            'testimonials_description' => 'nullable|string',
            'testimonials' => 'nullable|array',
            'testimonials.*.name' => 'nullable|string|max:255',
            'testimonials.*.meta' => 'nullable|string|max:255',
            'testimonials.*.quote' => 'nullable|string',
            'testimonials.*.image' => 'nullable|string|max:2048',
            'testimonials.*.featured' => 'nullable',
            'cta_title' => 'nullable|string|max:255',
            'cta_description' => 'nullable|string',
            'cta_primary_text' => 'nullable|string|max:255',
            'cta_secondary_text' => 'nullable|string|max:255',
            'cta_secondary_link' => 'nullable|string|max:255',
            'active_panel' => 'nullable|string|max:255',
        ], [
            'link_pendaftaran.url' => 'Format link harus berupa URL valid (contoh: https://...)',
        ]);
        $activePanel = $data['active_panel'] ?? null;
        unset($data['active_panel']);

        $pmb = PMB::first();

        if ($request->hasFile('hero_image')) {
            if ($pmb?->hero_image) {
                Storage::disk('public')->delete($pmb->hero_image);
            }

            $data['hero_image'] = $request->file('hero_image')->store('pmb', 'public');
        }

        $data['testimonials'] = collect($data['testimonials'] ?? [])
            ->map(function ($item) {
                $item['featured'] = isset($item['featured']);

                return $item;
            })
            ->filter(fn ($item) => ($item['name'] ?? null) || ($item['meta'] ?? null) || ($item['quote'] ?? null))
            ->values()
            ->all();

        if ($pmb) {
            $pmb->update($data); // Update jika data sudah ada
        } else {
            PMB::create($data); // Create jika database masih kosong
        }

        return back()
            ->with('success', 'Data informasi PMB berhasil diperbarui!')
            ->with('open_pmb_panel', $activePanel);
    }
}