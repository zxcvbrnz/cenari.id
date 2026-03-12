<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CoursePackageUser extends Model
{
    protected $fillable = ['course_package_id', 'user_id', 'learning_methode', 'status'];
}