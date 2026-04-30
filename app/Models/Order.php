<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'order_number',
        'total_amount',
        'snap_token',
        'status',
        'recipient_name',
        'phone_number',
        'full_address',
        'province',
        'city',
        'district',
        'village',
        'postal_code'
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
