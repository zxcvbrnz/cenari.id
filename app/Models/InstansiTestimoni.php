<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InstansiTestimoni extends Model
{
    protected $fillable = ['instansi_id', 'name', 'role', 'content', 'rating'];

    public function instansi(): BelongsTo
    {
        return $this->belongsTo(Instansi::class);
    }
}