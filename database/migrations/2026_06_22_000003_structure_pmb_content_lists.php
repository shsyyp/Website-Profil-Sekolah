<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $decode = function ($value): ?array {
            if (! is_string($value) || trim($value) === '') {
                return null;
            }

            $decoded = json_decode($value, true);

            return json_last_error() === JSON_ERROR_NONE && is_array($decoded) ? $decoded : null;
        };

        $lines = function ($value): array {
            return collect(preg_split('/\r\n|\r|\n/', (string) $value))
                ->map(fn ($line) => trim(preg_replace('/^\s*[-*\d.)]+\s*/', '', $line)))
                ->filter()
                ->values()
                ->all();
        };

        DB::table('pmb')->orderBy('id')->get()->each(function ($row) use ($decode, $lines) {
            $alurSource = $decode($row->alur) ?? $lines($row->alur);
            $requirementSource = $decode($row->persyaratan_umum) ?? $lines($row->persyaratan_umum);
            $documentSource = $decode($row->berkas) ?? $lines($row->berkas);
            $scheduleSource = $decode($row->jadwal) ?? $lines($row->jadwal);
            $faqSource = $decode($row->faq) ?? $lines($row->faq);

            $alur = collect($alurSource)->map(function ($item) {
                return ['title' => trim((string) (is_array($item)
                    ? ($item['title'] ?? $item['judul'] ?? $item['text'] ?? '')
                    : $item))];
            })->filter(fn ($item) => $item['title'] !== '')->values()->all();

            $toTextItems = function ($source): array {
                return collect($source)->map(function ($item) {
                    return ['text' => trim((string) (is_array($item)
                        ? ($item['text'] ?? $item['title'] ?? $item['judul'] ?? '')
                        : $item))];
                })->filter(fn ($item) => $item['text'] !== '')->values()->all();
            };

            $jadwal = collect($scheduleSource)->map(function ($item) {
                if (! is_array($item)) {
                    $parts = array_map('trim', explode('|', (string) $item, 2));

                    return [
                        'kegiatan' => $parts[0] ?? '',
                        'tanggal_mulai' => '',
                        'tanggal_selesai' => '',
                        'tanggal_legacy' => $parts[1] ?? '',
                    ];
                }

                return [
                    'kegiatan' => trim((string) ($item['kegiatan'] ?? $item['nama'] ?? $item['title'] ?? '')),
                    'tanggal_mulai' => (string) ($item['tanggal_mulai'] ?? $item['start_date'] ?? ''),
                    'tanggal_selesai' => (string) ($item['tanggal_selesai'] ?? $item['end_date'] ?? ''),
                    'tanggal_legacy' => (string) ($item['tanggal_legacy'] ?? $item['tanggal'] ?? $item['date'] ?? ''),
                ];
            })->filter(fn ($item) => $item['kegiatan'] !== '' || $item['tanggal_mulai'] !== '' || $item['tanggal_legacy'] !== '')->values()->all();

            $faq = collect($faqSource)->map(function ($item) {
                if (! is_array($item)) {
                    $parts = array_map('trim', explode('|', (string) $item, 2));

                    return ['pertanyaan' => $parts[0] ?? '', 'jawaban' => $parts[1] ?? ''];
                }

                return [
                    'pertanyaan' => trim((string) ($item['pertanyaan'] ?? $item['question'] ?? $item['q'] ?? '')),
                    'jawaban' => trim((string) ($item['jawaban'] ?? $item['answer'] ?? $item['a'] ?? '')),
                ];
            })->filter(fn ($item) => $item['pertanyaan'] !== '' || $item['jawaban'] !== '')->values()->all();

            DB::table('pmb')->where('id', $row->id)->update([
                'alur' => json_encode($alur, JSON_UNESCAPED_UNICODE),
                'persyaratan_umum' => json_encode($toTextItems($requirementSource), JSON_UNESCAPED_UNICODE),
                'berkas' => json_encode($toTextItems($documentSource), JSON_UNESCAPED_UNICODE),
                'jadwal' => json_encode($jadwal, JSON_UNESCAPED_UNICODE),
                'faq' => json_encode($faq, JSON_UNESCAPED_UNICODE),
            ]);
        });
    }

    public function down(): void
    {
        // Struktur JSON dipertahankan agar data yang telah dikelola admin tidak hilang.
    }
};
