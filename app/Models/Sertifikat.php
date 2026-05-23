<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sertifikat extends Model
{
    protected $connection = 'mysql_kedua';

    protected $table = 'sertifikats';
    protected $guarded = ['id'];
}
