<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peserta extends Model
{
    protected $connection = 'mysql_kedua';

    protected $table = 'pesertas';

    protected $guarded = ['id'];
}
