<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Instansi extends Model
{
    protected $fillable = ['name', 'profile', 'colour'];

    public function programs()
    {
        return $this->hasMany(Program::class);
    }
}
