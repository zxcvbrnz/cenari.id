<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Program extends Model
{
    protected $fillable = ['slug', 'title', 'category', 'hero_image', 'accent_color', 'icon', 'badges'];

    // Casting JSON ke Array otomatis
    protected $casts = [
        'category' => 'array',
        'badges' => 'array',
    ];

    public function coursePackages(): HasMany
    {
        return $this->hasMany(CoursePackage::class);
    }
}
