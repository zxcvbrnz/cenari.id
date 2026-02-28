<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class KitRobotic extends Model
{
    protected $fillable = [
        'name',
        'discount',
        'description',
        'pelatihan_price',
        'private_price',
        'course_package_id',
    ];

    public function moduls(): HasOne
    {
        return $this->hasOne(KitRoboticModul::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(KitRoboticImage::class);
    }

    public function items()
    {
        return $this->belongsToMany(Item::class, 'item_kit_robotic')
            ->using(ItemKitRobotic::class)
            ->withPivot('quantity')
            ->withTimestamps(); // agar created_at terisi otomatis
    }

    public function coursePackage(): BelongsTo
    {
        return $this->belongsTo(CoursePackage::class);
    }
}