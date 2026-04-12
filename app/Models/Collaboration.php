<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Collaboration extends Model
{
    protected $fillable = ['name', 'image', 'is_active', 'sort_order'];

    // Helper untuk URL gambar
    public function getImageUrlAttribute()
    {
        return asset('storage/' . $this->image);
    }
}
