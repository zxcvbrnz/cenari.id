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
        'price',
        'kit_robotic_id',
    ];

    public function program(): BelongsTo
    {
        return $this->belongsTo(Program::class);
    }

    public function moduls(): HasMany
    {
        return $this->hasMany(ModulCoursePackage::class);
    }

    public function kitRobotic(): BelongsTo
    {
        return $this->belongsTo(KitRobotic::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class)
            ->withPivot('learning_methode', 'status')
            ->withTimestamps();
    }
}