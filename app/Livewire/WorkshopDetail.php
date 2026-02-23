<?php

// app/Livewire/WorkshopDetail.php
namespace App\Livewire;

use App\Models\Workshop;
use Livewire\Component;

class WorkshopDetail extends Component
{
    public Workshop $workshop;

    public function mount($slug)
    {
        $this->workshop = Workshop::where('slug', $slug)->firstOrFail();
    }

    public function render()
    {
        return view('livewire.workshop-detail');
    }
}