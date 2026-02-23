<?php

namespace App\Livewire;

use App\Models\Program;
use Livewire\Component;

class CourseList extends Component
{
    public function render()
    {
        $programs = Program::get();

        return view('livewire.course-list', compact('programs'));
    }
}