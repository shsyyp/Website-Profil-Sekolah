<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('homepages', function (Blueprint $table) {
            $table->json('selected_alumni_ids')->nullable()->after('featured_alumni_id');
        });
    }

    public function down(): void
    {
        Schema::table('homepages', function (Blueprint $table) {
            $table->dropColumn('selected_alumni_ids');
        });
    }
};
