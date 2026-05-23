<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $connection = 'mysql_kedua';

    protected $table = 'pembayarans';
    protected $guarded = ['id'];
}
