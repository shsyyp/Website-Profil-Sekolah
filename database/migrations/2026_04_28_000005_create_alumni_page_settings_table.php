<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('alumni_page_settings', function (Blueprint $table) {
            $table->id();
            $table->string('hero_breadcrumb_label')->nullable();
            $table->string('hero_title')->nullable();
            $table->text('hero_description')->nullable();
            $table->string('hero_image')->nullable();
            $table->json('stats')->nullable();
            $table->string('map_label')->nullable();
            $table->string('map_title')->nullable();
            $table->text('map_description')->nullable();
            $table->string('map_image')->nullable();
            $table->string('featured_badge')->nullable();
            $table->string('featured_button_text')->nullable();
            $table->string('grid_title')->nullable();
            $table->text('grid_description')->nullable();
            $table->string('grid_button_text')->nullable();
            $table->text('testimonial_quote')->nullable();
            $table->string('testimonial_name')->nullable();
            $table->string('testimonial_meta')->nullable();
            $table->string('cta_title')->nullable();
            $table->text('cta_description')->nullable();
            $table->string('cta_primary_text')->nullable();
            $table->string('cta_primary_link')->nullable();
            $table->string('cta_secondary_text')->nullable();
            $table->string('cta_secondary_link')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('alumni_page_settings');
    }
};
