<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PMB extends Model
{
    use HasFactory;

    protected $table = 'pmb'; // WAJIB didefinisikan

    protected $fillable = [
        'hero_badge',
        'hero_title',
        'hero_description',
        'hero_image',
        'hero_card_title',
        'hero_card_subtitle',
        'alur',
        'persyaratan_umum',
        'berkas',
        'jadwal',
        'faq',
        'link_pendaftaran',
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
    ];

    protected $casts = [
        'testimonials' => 'array',
    ];
}
