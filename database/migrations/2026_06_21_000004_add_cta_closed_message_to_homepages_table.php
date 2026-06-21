<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('homepages', function (Blueprint $table) {
            $table->string('cta_closed_message')->nullable()->after('cta_deadline_at');
        });
    }

    public function down(): void
    {
        Schema::table('homepages', function (Blueprint $table) {
            $table->dropColumn('cta_closed_message');
        });
    }
};
