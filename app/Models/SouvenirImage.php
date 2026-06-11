<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SouvenirImage extends Model
{
    protected $fillable = ['souvenir_id', 'filename', 'is_featured'];

    public function souvenir()
    {
        return $this->belongsTo(Souvenir::class);
    }
}