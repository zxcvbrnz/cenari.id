<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Curriculum;

class B2BSolution extends Component
{
    public $selectedLevel = 'SD';

    public function selectLevel($level)
    {
        $this->selectedLevel = $level;
    }

    public function render()
    {
        // Mencari data kurikulum berdasarkan level yang dipilih
        $curriculum = Curriculum::where('level', $this->selectedLevel)->first();

        return view('livewire.b2-b-solution', [
            'data' => $curriculum
        ]);
    }
}