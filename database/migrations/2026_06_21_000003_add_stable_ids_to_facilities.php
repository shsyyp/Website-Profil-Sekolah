<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        $facilityIdsByIndex = [];

        DB::table('about_pages')->orderBy('id')->get()->each(function ($about) use (&$facilityIdsByIndex) {
            $facilities = json_decode($about->facilities ?? '[]', true) ?: [];

            foreach ($facilities as $index => &$facility) {
                $facility['id'] = $facility['id'] ?? (string) Str::uuid();
                $facilityIdsByIndex[$index] ??= $facility['id'];
            }
            unset($facility);

            DB::table('about_pages')->where('id', $about->id)->update([
                'facilities' => json_encode($facilities, JSON_UNESCAPED_UNICODE),
            ]);
        });

        DB::table('homepages')->orderBy('id')->get()->each(function ($homepage) use ($facilityIdsByIndex) {
            $selected = json_decode($homepage->fasilitas ?? '[]', true) ?: [];
            $selectedIds = collect($selected)
                ->map(function ($value) use ($facilityIdsByIndex) {
                    if (is_numeric($value)) {
                        return $facilityIdsByIndex[(int) $value] ?? null;
                    }

                    return (string) $value;
                })
                ->filter()
                ->unique()
                ->take(4)
                ->values()
                ->all();

            DB::table('homepages')->where('id', $homepage->id)->update([
                'fasilitas' => json_encode($selectedIds),
            ]);
        });
    }

    public function down(): void
    {
        // ID fasilitas dipertahankan agar pilihan beranda tidak kehilangan referensi.
    }
};
