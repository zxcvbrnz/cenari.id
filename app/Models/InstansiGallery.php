<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class InstansiGallery extends Model
{
    protected $fillable = ['instansi_id', 'image', 'caption'];

    public function instansi(): BelongsTo
    {
        return $this->belongsTo(Instansi::class);
    }
}