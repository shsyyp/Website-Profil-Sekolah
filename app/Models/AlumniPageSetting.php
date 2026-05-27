<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AlumniPageSetting extends Model
{
    protected $fillable = [
        'hero_breadcrumb_label',
        'hero_title',
        'hero_description',
        'hero_image',
        'stats',
        'map_label',
        'map_title',
        'map_description',
        'map_image',
        'featured_badge',
        'featured_button_text',
        'grid_title',
        'grid_description',
        'grid_button_text',
        'testimonial_quote',
        'testimonial_name',
        'testimonial_meta',
        'testimonial_alumni_ids',
        'cta_title',
        'cta_description',
        'cta_primary_text',
        'cta_primary_link',
        'cta_secondary_text',
        'cta_secondary_link',
    ];

    protected $casts = [
        'stats' => 'array',
        'testimonial_alumni_ids' => 'array',
    ];
}
