<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class CoursePackage extends Model
{
    protected $fillable = [
        'program_id',
        'slug',
        'name',
        'level',
        'description',
        'tool',
        'course_count',
        'course_during',
        'price'
    ];

    public function program(): BelongsTo
    {
        return $this->belongsTo(Program::class);
    }

    public function moduls(): HasOne
    {
        return $this->hasOne(ModulCoursePackage::class);
    }

    public function kitRobotics(): HasOne
    {
        return $this->hasOne(KitRobotic::class);
    }
}