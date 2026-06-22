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
        $rulesByPanel = [
            'pmb-hero-section' => [
                'hero_badge' => ['nullable', 'string', 'max:255'],
                'hero_title' => ['required', 'string', 'max:255'],
                'hero_description' => ['required', 'string'],
                'hero_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
                'hero_card_title' => ['nullable', 'string', 'max:255'],
                'hero_card_subtitle' => ['nullable', 'string', 'max:255'],
                'link_pendaftaran' => ['nullable', 'url'],
                'primary_button_text' => ['nullable', 'string', 'max:255'],
                'secondary_button_text' => ['nullable', 'string', 'max:255'],
            ],
            'pmb-steps-section' => [
                'steps_label' => ['required', 'string', 'max:255'],
                'steps_title' => ['required', 'string', 'max:255'],
                'alur' => ['required', 'array', 'min:1'],
                'alur.*.title' => ['required', 'string', 'max:500'],
            ],
            'pmb-requirements-section' => [
                'persyaratan_umum' => ['required', 'array', 'min:1'],
                'persyaratan_umum.*.text' => ['required', 'string', 'max:500'],
                'berkas' => ['required', 'array', 'min:1'],
                'berkas.*.text' => ['required', 'string', 'max:500'],
            ],
            'pmb-timeline-section' => [
                'timeline_title' => ['required', 'string', 'max:255'],
                'jadwal' => ['required', 'array', 'min:1'],
                'jadwal.*.kegiatan' => ['required', 'string', 'max:255'],
                'jadwal.*.tanggal_mulai' => ['nullable', 'required_without:jadwal.*.tanggal_legacy', 'date'],
                'jadwal.*.tanggal_selesai' => ['nullable', 'date', 'after_or_equal:jadwal.*.tanggal_mulai'],
                'jadwal.*.tanggal_legacy' => ['nullable', 'string', 'max:255'],
            ],
            'pmb-faq-section' => [
                'faq_title' => ['required', 'string', 'max:255'],
                'faq' => ['required', 'array', 'min:1'],
                'faq.*.pertanyaan' => ['required', 'string', 'max:500'],
                'faq.*.jawaban' => ['required', 'string'],
            ],
            'pmb-cta-section' => [
                'cta_title' => ['required', 'string', 'max:255'],
                'cta_description' => ['required', 'string'],
                'cta_primary_text' => ['nullable', 'string', 'max:255'],
                'cta_secondary_text' => ['required', 'string', 'max:255'],
                'cta_secondary_link' => ['required', 'string', 'max:2048'],
            ],
        ];

        $activePanel = $request->input('active_panel');
        $data = $request->validate(array_merge(
            ['active_panel' => ['required', 'string', 'in:' . implode(',', array_keys($rulesByPanel))]],
            $rulesByPanel[$activePanel] ?? []
        ), [
            'required' => 'Kolom :attribute wajib diisi.',
            'link_pendaftaran.url' => 'Format link harus berupa URL valid (contoh: https://...).',
            'jadwal.*.tanggal_mulai.required_without' => 'Tanggal mulai wajib diisi.',
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

        foreach (['alur', 'persyaratan_umum', 'berkas', 'jadwal', 'faq'] as $listField) {
            if (array_key_exists($listField, $data)) {
                $data[$listField] = collect($data[$listField])->values()->all();
            }
        }

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
