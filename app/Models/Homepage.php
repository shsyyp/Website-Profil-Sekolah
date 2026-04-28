<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Homepage extends Model
{
    protected $fillable = [
        'hero_label', 'hero_title', 'hero_subtitle', 'hero_image', 'site_name', 'login_button_text',
        'hero_button1_text', 'hero_button1_link', 'hero_button2_text', 'hero_button2_link', 'hero_video_url',
        'success_title', 'success_desc', 'success_image',
        'about_label', 'about_title', 'about_desc', 'accreditation_title', 'accreditation_desc',
        'tradisi', 'fasilitas',
        'facilities_title', 'facilities_subtitle', 'facility_main_image', 'facility_side_image',
        'news_title', 'news_subtitle', 'news_button_text',
        'cta_title', 'cta_desc', 'cta_year', 'cta_button', 'cta_secondary_button', 'cta_secondary_link',
        'cta_badge', 'cta_deadline_label', 'cta_countdown_days', 'cta_countdown_hours',
        'news_limit', 'featured_alumni_id', 'alumni_label', 'alumni_title',
        'footer_desc', 'footer_address', 'footer_phone', 'newsletter_desc', 'footer_copyright', 'footer_note'
    ];

    // Otomatis convert JSON ke Array bolak-balik
    protected $casts = [
        'tradisi' => 'array',
        'fasilitas' => 'array'
    ];
}
