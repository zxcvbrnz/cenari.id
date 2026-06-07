<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutUs extends Model
{
    protected $table = 'about_us';

    protected $fillable = [
        'homepage_text',
        'text_1',
        'text_2',
        'image_1',
        'image_2',
        'pdf_url',
        'video_url',
    ];
}
