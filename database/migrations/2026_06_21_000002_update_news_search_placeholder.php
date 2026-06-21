<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('news_page_settings')->update([
            'search_placeholder' => 'Cari berita...',
        ]);
    }

    public function down(): void
    {
        // Perubahan teks antarmuka tidak dikembalikan.
    }
};
