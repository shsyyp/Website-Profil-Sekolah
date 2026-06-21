<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('about_pages', function (Blueprint $table) {
            $table->string('student_composition_title')->nullable()->after('staff_count');
            $table->string('staff_profile_title')->nullable()->after('student_composition_title');
        });
    }

    public function down(): void
    {
        Schema::table('about_pages', function (Blueprint $table) {
            $table->dropColumn(['student_composition_title', 'staff_profile_title']);
        });
    }
};
