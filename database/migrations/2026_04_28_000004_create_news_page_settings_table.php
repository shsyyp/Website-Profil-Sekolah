<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('news_page_settings', function (Blueprint $table) {
            $table->id();
            $table->string('hero_breadcrumb_label')->nullable();
            $table->string('hero_title')->nullable();
            $table->text('hero_description')->nullable();
            $table->string('filter_all_label')->nullable();
            $table->string('search_placeholder')->nullable();
            $table->string('popular_title')->nullable();
            $table->string('categories_title')->nullable();
            $table->string('newsletter_title')->nullable();
            $table->text('newsletter_description')->nullable();
            $table->string('newsletter_placeholder')->nullable();
            $table->string('newsletter_button_text')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('news_page_settings');
    }
};
