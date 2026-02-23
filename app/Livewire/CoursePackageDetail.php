<?php

namespace App\Livewire;

use App\Models\CoursePackage;
use Livewire\Component;

class CoursePackageDetail extends Component
{
    public CoursePackage $package;

    public function mount($slug, $course_slug)
    {
        $this->package = CoursePackage::where('slug', $course_slug)->firstOrFail();
    }

    public function render()
    {
        return view('livewire.course-package-detail');
    }
}