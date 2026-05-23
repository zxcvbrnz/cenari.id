<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserKedua extends Model
{
    protected $connection = 'mysql_kedua';

    protected $table = 'user';
    protected $guarded = ['id'];
}
