<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('pmb')
            ->whereNotNull('hero_badge')
            ->select(['id', 'hero_badge'])
            ->orderBy('id')
            ->chunkById(100, function ($rows) {
                foreach ($rows as $row) {
                    $updatedBadge = str_ireplace(
                        ['Penerimaan Siswa Baru', 'PPDB'],
                        ['Penerimaan Murid Baru', 'PMB'],
                        $row->hero_badge
                    );

                    if ($updatedBadge !== $row->hero_badge) {
                        DB::table('pmb')->where('id', $row->id)->update([
                            'hero_badge' => $updatedBadge,
                        ]);
                    }
                }
            });
    }

    public function down(): void
    {
        // Perubahan istilah konten tidak dikembalikan agar data terbaru tetap dipertahankan.
    }
};
