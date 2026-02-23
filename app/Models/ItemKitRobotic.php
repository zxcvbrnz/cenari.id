<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ItemKitRobotic extends Pivot
{
    // Nama tabel harus didefinisikan jika menggunakan nama kustom
    protected $table = 'item_kit_robotic';

    // Jika Anda ingin model ini menangani timestamps secara otomatis
    public $incrementing = true;

    protected $fillable = [
        'kit_robotic_id',
        'item_id',
        'quantity',
        // tambahkan kolom lain jika ada di migration pivot
    ];
}
