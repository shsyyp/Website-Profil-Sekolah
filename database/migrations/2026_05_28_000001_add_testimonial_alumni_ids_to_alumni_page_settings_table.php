<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('alumni_page_settings', function (Blueprint $table) {
            if (! Schema::hasColumn('alumni_page_settings', 'testimonial_alumni_ids')) {
                $table->json('testimonial_alumni_ids')->nullable()->after('testimonial_meta');
            }
        });
    }

    public function down(): void
    {
        Schema::table('alumni_page_settings', function (Blueprint $table) {
            if (Schema::hasColumn('alumni_page_settings', 'testimonial_alumni_ids')) {
                $table->dropColumn('testimonial_alumni_ids');
            }
        });
    }
};
