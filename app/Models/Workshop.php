<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Workshop extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'date_string',
        'time_string',
        'type',
        'image',
        'status',
        'price',
        'color'
    ];

    // Otomatis membuat slug saat title diisi (Opsional)
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($workshop) {
            $workshop->slug = Str::slug($workshop->title) . '-' . Str::random(5);
        });
    }
}