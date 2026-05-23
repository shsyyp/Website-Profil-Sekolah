<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('homepages', function (Blueprint $table) {
            if (! Schema::hasColumn('homepages', 'footer_email')) {
                $table->string('footer_email')->nullable()->after('footer_address');
            }

            if (! Schema::hasColumn('homepages', 'footer_operational_hours')) {
                $table->text('footer_operational_hours')->nullable()->after('footer_phone');
            }

            if (! Schema::hasColumn('homepages', 'footer_whatsapp_url')) {
                $table->string('footer_whatsapp_url')->nullable()->after('footer_operational_hours');
            }

            if (! Schema::hasColumn('homepages', 'footer_instagram_url')) {
                $table->string('footer_instagram_url')->nullable()->after('footer_whatsapp_url');
            }

            if (! Schema::hasColumn('homepages', 'footer_facebook_url')) {
                $table->string('footer_facebook_url')->nullable()->after('footer_instagram_url');
            }

            if (! Schema::hasColumn('homepages', 'footer_youtube_url')) {
                $table->string('footer_youtube_url')->nullable()->after('footer_facebook_url');
            }
        });
    }

    public function down(): void
    {
        Schema::table('homepages', function (Blueprint $table) {
            $columns = [
                'footer_email',
                'footer_operational_hours',
                'footer_whatsapp_url',
                'footer_instagram_url',
                'footer_facebook_url',
                'footer_youtube_url',
            ];

            foreach ($columns as $column) {
                if (Schema::hasColumn('homepages', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
