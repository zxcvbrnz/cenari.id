<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LearningList extends Component
{
    public function render()
    {
        // Mengambil semua paket kursus milik user melalui relasi pivot
        $myCourses = Auth::user()->coursePackages;

        return view('livewire.learning-list', [
            'myCourses' => $myCourses
        ]);
    }
}