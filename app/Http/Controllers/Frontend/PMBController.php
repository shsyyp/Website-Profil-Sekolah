<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\PMB;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class PMBController extends Controller
{
    public function index()
    {
        $pmb = PMB::latest()->first();

        $alur = $this->parseList($pmb?->alur);
        $persyaratan = $this->parseList($pmb?->persyaratan_umum);
        $berkas = $this->parseList($pmb?->berkas);
        $jadwal = $this->parseSchedule($pmb?->jadwal);
        $faq = $this->parseFaq($pmb?->faq);

        return view('pages.pmb', compact('pmb', 'alur', 'persyaratan', 'berkas', 'jadwal', 'faq'));
    }

    private function parseList(mixed $value): Collection
    {
        $decoded = is_array($value) ? $value : $this->decodeJson($value);

        if (is_array($decoded)) {
            return collect($decoded)
                ->map(fn ($item) => is_array($item) ? ($item['judul'] ?? $item['title'] ?? $item['text'] ?? reset($item)) : $item)
                ->filter()
                ->values();
        }

        return collect(preg_split('/\r\n|\r|\n/', (string) $value))
            ->map(fn ($line) => trim(preg_replace('/^\s*[-*\d.)]+\s*/', '', $line)))
            ->filter()
            ->values();
    }

    private function parseSchedule(mixed $value): Collection
    {
        $decoded = is_array($value) ? $value : $this->decodeJson($value);

        if (is_array($decoded)) {
            return collect($decoded)->map(function ($item) {
                $start = $item['tanggal_mulai'] ?? $item['start_date'] ?? null;
                $end = $item['tanggal_selesai'] ?? $item['end_date'] ?? null;
                $dateLabel = $item['tanggal_legacy'] ?? $item['tanggal'] ?? $item['date'] ?? '';

                if ($start) {
                    $startLabel = Carbon::parse($start)->locale('id')->translatedFormat('d F Y');
                    $endLabel = $end ? Carbon::parse($end)->locale('id')->translatedFormat('d F Y') : null;
                    $dateLabel = $endLabel && $end !== $start ? $startLabel . ' – ' . $endLabel : $startLabel;
                }

                return (object) [
                    'kegiatan' => $item['kegiatan'] ?? $item['nama'] ?? $item['title'] ?? '',
                    'tanggal' => $dateLabel,
                    'keterangan' => $item['keterangan'] ?? $item['description'] ?? '',
                    'is_highlight' => (bool) ($item['is_highlight'] ?? $item['highlight'] ?? false),
                ];
            })->filter(fn ($item) => $item->kegiatan || $item->tanggal || $item->keterangan)->values();
        }

        return $this->parseList($value)->map(function ($line) {
            $parts = array_map('trim', explode('|', $line));

            return (object) [
                'kegiatan' => $parts[0] ?? '',
                'tanggal' => $parts[1] ?? '',
                'keterangan' => $parts[2] ?? '',
                'is_highlight' => in_array(strtolower($parts[3] ?? ''), ['1', 'true', 'highlight', 'yes'], true),
            ];
        });
    }

    private function parseFaq(mixed $value): Collection
    {
        $decoded = is_array($value) ? $value : $this->decodeJson($value);

        if (is_array($decoded)) {
            return collect($decoded)->map(fn ($item) => (object) [
                'pertanyaan' => $item['pertanyaan'] ?? $item['question'] ?? $item['q'] ?? '',
                'jawaban' => $item['jawaban'] ?? $item['answer'] ?? $item['a'] ?? '',
            ])->filter(fn ($item) => $item->pertanyaan || $item->jawaban)->values();
        }

        return $this->parseList($value)->map(function ($line) {
            $parts = array_map('trim', explode('|', $line, 2));

            return (object) [
                'pertanyaan' => $parts[0] ?? '',
                'jawaban' => $parts[1] ?? '',
            ];
        });
    }

    private function decodeJson(mixed $value): mixed
    {
        if (! is_string($value) || ! $value) {
            return null;
        }

        $decoded = json_decode($value, true);

        return json_last_error() === JSON_ERROR_NONE ? $decoded : null;
    }
}
