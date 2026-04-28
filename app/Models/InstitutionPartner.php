<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InstitutionPartner extends Model
{
    protected $fillable = [
        'nama_lengkap',
        'nama_institusi',
        'whatsapp',
        'email',
        'tujuan_surat',
        'penawaran',
    ];
}
