<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsPageSetting extends Model
{
    protected $fillable = [
        'hero_breadcrumb_label',
        'hero_title',
        'hero_description',
        'filter_all_label',
        'search_placeholder',
        'popular_title',
        'categories_title',
        'newsletter_title',
        'newsletter_description',
        'newsletter_placeholder',
        'newsletter_button_text',
    ];
}
