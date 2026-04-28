<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class HomepageSetting extends Model
{
    protected $fillable = [
        'site_name',
        'login_button_text',
        'hero_label',
        'hero_title',
        'hero_subtitle',
        'hero_image',
        'hero_button1_text',
        'hero_button1_link',
        'hero_button2_text',
        'hero_button2_link',
        'success_title',
        'success_desc',
        'about_label',
        'about_title',
        'about_desc',
        'accreditation_title',
        'accreditation_desc',
        'facilities_title',
        'facilities_subtitle',
        'news_title',
        'news_subtitle',
        'news_button_text',
        'show_news',
        'news_limit',
        'featured_alumni_id',
        'alumni_label',
        'alumni_title',
        'cta_title',
        'cta_desc',
        'cta_year',
        'cta_button',
        'cta_secondary_button',
        'cta_secondary_link',
        'cta_badge',
        'cta_deadline_label',
        'cta_countdown_days',
        'cta_countdown_hours',
        'footer_desc',
        'footer_address',
        'footer_phone',
        'newsletter_desc',
        'footer_copyright',
        'footer_note',
    ];

    protected $casts = [
        'show_news' => 'boolean',
        'news_limit' => 'integer',
    ];

    public function highlights(): HasMany
    {
        return $this->hasMany(Highlight::class)->orderBy('sort_order');
    }

    public function facilities(): HasMany
    {
        return $this->hasMany(Facility::class)->orderBy('sort_order');
    }
}
