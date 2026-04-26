<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('homepages', function (Blueprint $table) {
            $table->string('site_name')->nullable()->after('hero_image');
            $table->string('login_button_text')->nullable()->after('site_name');
            $table->string('about_label')->nullable()->after('success_desc');
            $table->string('about_title')->nullable()->after('about_label');
            $table->text('about_desc')->nullable()->after('about_title');
            $table->string('accreditation_title')->nullable()->after('about_desc');
            $table->string('accreditation_desc')->nullable()->after('accreditation_title');

            $table->string('facilities_title')->nullable()->after('fasilitas');
            $table->text('facilities_subtitle')->nullable()->after('facilities_title');
            $table->string('facility_main_image')->nullable()->after('facilities_subtitle');
            $table->string('facility_side_image')->nullable()->after('facility_main_image');

            $table->string('news_title')->nullable()->after('facility_side_image');
            $table->text('news_subtitle')->nullable()->after('news_title');
            $table->string('news_button_text')->nullable()->after('news_subtitle');

            $table->string('cta_secondary_button')->nullable()->after('cta_button');
            $table->string('cta_secondary_link')->nullable()->after('cta_secondary_button');
            $table->string('cta_badge')->nullable()->after('cta_secondary_link');
            $table->string('cta_deadline_label')->nullable()->after('cta_badge');
            $table->string('cta_countdown_days')->nullable()->after('cta_deadline_label');
            $table->string('cta_countdown_hours')->nullable()->after('cta_countdown_days');

            $table->string('alumni_label')->nullable()->after('featured_alumni_id');
            $table->string('alumni_title')->nullable()->after('alumni_label');

            $table->text('footer_desc')->nullable()->after('alumni_title');
            $table->string('footer_address')->nullable()->after('footer_desc');
            $table->string('footer_phone')->nullable()->after('footer_address');
            $table->text('newsletter_desc')->nullable()->after('footer_phone');
            $table->string('footer_copyright')->nullable()->after('newsletter_desc');
            $table->string('footer_note')->nullable()->after('footer_copyright');
        });
    }

    public function down(): void
    {
        Schema::table('homepages', function (Blueprint $table) {
            $table->dropColumn([
                'about_label',
                'site_name',
                'login_button_text',
                'about_title',
                'about_desc',
                'accreditation_title',
                'accreditation_desc',
                'facilities_title',
                'facilities_subtitle',
                'facility_main_image',
                'facility_side_image',
                'news_title',
                'news_subtitle',
                'news_button_text',
                'cta_secondary_button',
                'cta_secondary_link',
                'cta_badge',
                'cta_deadline_label',
                'cta_countdown_days',
                'cta_countdown_hours',
                'alumni_label',
                'alumni_title',
                'footer_desc',
                'footer_address',
                'footer_phone',
                'newsletter_desc',
                'footer_copyright',
                'footer_note',
            ]);
        });
    }
};
