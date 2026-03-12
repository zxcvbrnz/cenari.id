<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'slug', 'excerpt', 'body', 'is_published'];

    public function images()
    {
        return $this->hasMany(PostImage::class);
    }

    // Shortcut untuk mengambil gambar utama
    public function featuredImage()
    {
        return $this->hasOne(PostImage::class)->where('is_featured', true);
    }
}