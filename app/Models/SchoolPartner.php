<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchoolPartner extends Model
{
    protected $fillable = [
        'nama_lengkap',
        'nama_sekolah',
        'whatsapp',
        'email',
        'tujuan_surat',
        'penawaran',
    ];
}
