<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = ['name', 'price', 'description'];

    public function images()
    {
        return $this->hasMany(ItemImage::class);
    }

    public function kitRobotics()
    {
        return $this->belongsToMany(KitRobotic::class, 'item_kit_robotic')
            ->using(ItemKitRobotic::class)
            ->withTimestamps();
    }
}
