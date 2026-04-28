<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pmb', function (Blueprint $table) {
            $table->string('hero_badge')->nullable()->after('id');
            $table->string('hero_title')->nullable()->after('hero_badge');
            $table->text('hero_description')->nullable()->after('hero_title');
            $table->string('hero_image')->nullable()->after('hero_description');
            $table->string('hero_card_title')->nullable()->after('hero_image');
            $table->string('hero_card_subtitle')->nullable()->after('hero_card_title');
            $table->string('primary_button_text')->nullable()->after('link_pendaftaran');
            $table->string('secondary_button_text')->nullable()->after('primary_button_text');
            $table->string('steps_label')->nullable()->after('secondary_button_text');
            $table->string('steps_title')->nullable()->after('steps_label');
            $table->string('timeline_title')->nullable()->after('steps_title');
            $table->text('timeline_description')->nullable()->after('timeline_title');
            $table->string('faq_title')->nullable()->after('timeline_description');
            $table->text('faq_description')->nullable()->after('faq_title');
            $table->string('testimonials_title')->nullable()->after('faq_description');
            $table->text('testimonials_description')->nullable()->after('testimonials_title');
            $table->json('testimonials')->nullable()->after('testimonials_description');
            $table->string('cta_title')->nullable()->after('testimonials');
            $table->text('cta_description')->nullable()->after('cta_title');
            $table->string('cta_primary_text')->nullable()->after('cta_description');
            $table->string('cta_secondary_text')->nullable()->after('cta_primary_text');
            $table->string('cta_secondary_link')->nullable()->after('cta_secondary_text');
        });
    }

    public function down(): void
    {
        Schema::table('pmb', function (Blueprint $table) {
            $table->dropColumn([
                'hero_badge',
                'hero_title',
                'hero_description',
                'hero_image',
                'hero_card_title',
                'hero_card_subtitle',
                'primary_button_text',
                'secondary_button_text',
                'steps_label',
                'steps_title',
                'timeline_title',
                'timeline_description',
                'faq_title',
                'faq_description',
                'testimonials_title',
                'testimonials_description',
                'testimonials',
                'cta_title',
                'cta_description',
                'cta_primary_text',
                'cta_secondary_text',
                'cta_secondary_link',
            ]);
        });
    }
};
