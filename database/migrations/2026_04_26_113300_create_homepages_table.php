<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('homepages', function (Blueprint $table) {
            $table->id();
            
            // HERO
            $table->string('hero_label')->nullable();
            $table->string('hero_title')->nullable();
            $table->text('hero_subtitle')->nullable();
            $table->string('hero_image')->nullable();
            $table->string('hero_button1_text')->nullable();
            $table->string('hero_button1_link')->nullable();
            $table->string('hero_button2_text')->nullable();
            $table->string('hero_button2_link')->nullable();

            // SUCCESS CARD
            $table->string('success_title')->nullable();
            $table->text('success_desc')->nullable();

            // TRADISI & FASILITAS (JSON)
            $table->json('tradisi')->nullable();
            $table->json('fasilitas')->nullable();

            // CTA PMB
            $table->string('cta_title')->nullable();
            $table->text('cta_desc')->nullable();
            $table->string('cta_year')->nullable();
            $table->string('cta_button')->nullable();

            // SETTINGS
            $table->integer('news_limit')->default(3);
            $table->unsignedBigInteger('featured_alumni_id')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('homepages');
    }
};