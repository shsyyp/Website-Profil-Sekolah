<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasColumn('homepages', 'cta_is_active')) {
            Schema::table('homepages', function (Blueprint $table) {
                $table->boolean('cta_is_active')->default(true)->after('cta_deadline_at');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('homepages', 'cta_is_active')) {
            Schema::table('homepages', function (Blueprint $table) {
                $table->dropColumn('cta_is_active');
            });
        }
    }
};
