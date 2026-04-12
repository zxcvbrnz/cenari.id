<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Instansi extends Model
{
    protected $fillable = ['name', 'image', 'profile', 'colour'];

    public function programs()
    {
        return $this->hasMany(Program::class);
    }

    public function galleries(): HasMany
    {
        return $this->hasMany(InstansiGallery::class, 'instansi_id');
    }

    /**
     * Relasi ke Testimoni (Satu instansi punya banyak testimoni)
     */
    public function testimonis(): HasMany
    {
        return $this->hasMany(InstansiTestimoni::class, 'instansi_id');
    }
}