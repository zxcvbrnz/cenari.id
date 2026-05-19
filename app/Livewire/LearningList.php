<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LearningList extends Component
{
    public function render()
    {
        // Mengambil semua paket kursus milik user melalui relasi pivot dengan yang terbaru paling atas
        $myCourses = Auth::user()->coursePackages()->latest()->get();

        return view('livewire.learning-list', [
            'myCourses' => $myCourses
        ]);
    }
}