<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Souvenir extends Model
{
    protected $fillable = ['name', 'price', 'description', 'stock'];

    public function images()
    {
        return $this->hasMany(SouvenirImage::class);
    }
}
