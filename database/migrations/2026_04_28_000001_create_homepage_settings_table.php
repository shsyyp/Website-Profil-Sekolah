<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('homepage_settings', function (Blueprint $table) {
            $table->id();
            $table->string('site_name')->nullable();
            $table->string('login_button_text')->nullable();
            $table->string('hero_label')->nullable();
            $table->text('hero_title')->nullable();
            $table->text('hero_subtitle')->nullable();
            $table->string('hero_image')->nullable();
            $table->string('hero_button1_text')->nullable();
            $table->string('hero_button1_link')->nullable();
            $table->string('hero_button2_text')->nullable();
            $table->string('hero_button2_link')->nullable();
            $table->string('success_title')->nullable();
            $table->text('success_desc')->nullable();
            $table->string('about_label')->nullable();
            $table->string('about_title')->nullable();
            $table->text('about_desc')->nullable();
            $table->string('accreditation_title')->nullable();
            $table->string('accreditation_desc')->nullable();
            $table->string('facilities_title')->nullable();
            $table->text('facilities_subtitle')->nullable();
            $table->string('news_title')->nullable();
            $table->text('news_subtitle')->nullable();
            $table->string('news_button_text')->nullable();
            $table->boolean('show_news')->default(true);
            $table->unsignedTinyInteger('news_limit')->default(3);
            $table->unsignedBigInteger('featured_alumni_id')->nullable();
            $table->string('alumni_label')->nullable();
            $table->string('alumni_title')->nullable();
            $table->string('cta_title')->nullable();
            $table->text('cta_desc')->nullable();
            $table->string('cta_year')->nullable();
            $table->string('cta_button')->nullable();
            $table->string('cta_secondary_button')->nullable();
            $table->string('cta_secondary_link')->nullable();
            $table->string('cta_badge')->nullable();
            $table->string('cta_deadline_label')->nullable();
            $table->string('cta_countdown_days')->nullable();
            $table->string('cta_countdown_hours')->nullable();
            $table->text('footer_desc')->nullable();
            $table->string('footer_address')->nullable();
            $table->string('footer_phone')->nullable();
            $table->text('newsletter_desc')->nullable();
            $table->string('footer_copyright')->nullable();
            $table->string('footer_note')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('homepage_settings');
    }
};
