<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutPage extends Model
{
    protected $fillable = [
        'hero_title',
        'hero_image',
        'highlights',
        'profile_label',
        'profile_title',
        'profile_paragraph_1',
        'profile_paragraph_2',
        'profile_button_1_text',
        'profile_button_1_link',
        'profile_button_2_text',
        'profile_button_2_link',
        'profile_image',
        'male_student_count',
        'female_student_count',
        'class_count',
        'educator_count',
        'staff_count',
        'staff_profile_description',
        'dedication_number',
        'dedication_label',
        'vision_mission_title',
        'vision',
        'missions',
        'facilities_label',
        'facilities_title',
        'facilities_button_text',
        'facilities_button_link',
        'facilities',
        'extracurricular_label',
        'extracurricular_title',
        'extracurricular_desc',
        'extracurricular_tags',
        'extracurriculars',
    ];

    protected $casts = [
        'male_student_count' => 'integer',
        'female_student_count' => 'integer',
        'class_count' => 'integer',
        'educator_count' => 'integer',
        'staff_count' => 'integer',
        'highlights' => 'array',
        'missions' => 'array',
        'facilities' => 'array',
        'extracurricular_tags' => 'array',
        'extracurriculars' => 'array',
    ];
}
