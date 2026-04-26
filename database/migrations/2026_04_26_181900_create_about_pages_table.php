<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('about_pages', function (Blueprint $table) {
            $table->id();
            $table->string('hero_title')->nullable();
            $table->string('hero_image')->nullable();
            $table->json('highlights')->nullable();
            $table->string('profile_label')->nullable();
            $table->string('profile_title')->nullable();
            $table->text('profile_paragraph_1')->nullable();
            $table->text('profile_paragraph_2')->nullable();
            $table->string('profile_button_1_text')->nullable();
            $table->string('profile_button_1_link')->nullable();
            $table->string('profile_button_2_text')->nullable();
            $table->string('profile_button_2_link')->nullable();
            $table->string('profile_image')->nullable();
            $table->string('dedication_number')->nullable();
            $table->string('dedication_label')->nullable();
            $table->string('vision_mission_title')->nullable();
            $table->text('vision')->nullable();
            $table->json('missions')->nullable();
            $table->string('facilities_label')->nullable();
            $table->string('facilities_title')->nullable();
            $table->string('facilities_button_text')->nullable();
            $table->string('facilities_button_link')->nullable();
            $table->json('facilities')->nullable();
            $table->string('extracurricular_label')->nullable();
            $table->string('extracurricular_title')->nullable();
            $table->text('extracurricular_desc')->nullable();
            $table->json('extracurricular_tags')->nullable();
            $table->json('extracurriculars')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('about_pages');
    }
};
