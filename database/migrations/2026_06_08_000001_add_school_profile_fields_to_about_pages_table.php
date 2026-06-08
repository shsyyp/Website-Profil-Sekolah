<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('about_pages', function (Blueprint $table) {
            $table->unsignedInteger('male_student_count')->nullable()->after('profile_image');
            $table->unsignedInteger('female_student_count')->nullable()->after('male_student_count');
            $table->unsignedInteger('class_count')->nullable()->after('female_student_count');
            $table->unsignedInteger('educator_count')->nullable()->after('class_count');
            $table->unsignedInteger('staff_count')->nullable()->after('educator_count');
        });
    }

    public function down(): void
    {
        Schema::table('about_pages', function (Blueprint $table) {
            $table->dropColumn([
                'male_student_count',
                'female_student_count',
                'class_count',
                'educator_count',
                'staff_count',
            ]);
        });
    }
};
