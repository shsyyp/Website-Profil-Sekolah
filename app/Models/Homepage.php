<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Homepage extends Model
{
    protected $fillable = [
        'hero_label', 'hero_title', 'hero_subtitle', 'hero_image',
        'hero_button1_text', 'hero_button1_link', 'hero_button2_text', 'hero_button2_link',
        'success_title', 'success_desc', 'tradisi', 'fasilitas',
        'cta_title', 'cta_desc', 'cta_year', 'cta_button',
        'news_limit', 'featured_alumni_id'
    ];

    // Otomatis convert JSON ke Array bolak-balik
    protected $casts = [
        'tradisi' => 'array',
        'fasilitas' => 'array'
    ];
}