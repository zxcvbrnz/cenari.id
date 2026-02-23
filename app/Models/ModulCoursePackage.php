<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ModulCoursePackage extends Model
{
    protected $fillable = [
        'course_package_id',
        'title',
        'text_1',
        'text_2',
        'text_3',
        'text_4'
    ];

    public function coursePackage(): BelongsTo
    {
        return $this->belongsTo(CoursePackage::class);
    }
}
