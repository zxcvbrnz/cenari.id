<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CoursePackageUser extends Model
{
    protected $table = 'course_package_user';

    protected $fillable = ['course_package_id', 'username', 'password', 'payment_status', 'user_id', 'learning_methode', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi ke CoursePackage
    public function coursePackage()
    {
        return $this->belongsTo(CoursePackage::class, 'course_package_id');
    }
}