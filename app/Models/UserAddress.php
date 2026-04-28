<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    protected $fillable = [
        'user_id',
        'full_address',
        'phone_number',
        'recipient_name',
        'postal_code',
        'province',
        'city',
        'district',
        'village'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
