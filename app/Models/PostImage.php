<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostImage extends Model
{
    protected $fillable = ['post_id', 'filename', 'is_featured'];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}