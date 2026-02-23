<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MissingLink extends Model
{
    protected $fillable = ['text', 'cta', 'url'];
}
