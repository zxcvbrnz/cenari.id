<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = ['order_id', 'product_id', 'product_type', 'name', 'price', 'quantity', 'image'];

    // Relasi otomatis ke KitRobotic atau Item
    public function product()
    {
        return $this->morphTo();
    }
}
