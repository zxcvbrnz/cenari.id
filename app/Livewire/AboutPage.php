<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\AboutUs as AboutUsModel;
use App\Models\BusinessLine;

class AboutPage extends Component
{
    public $about;
    public $businessLines;

    public function mount()
    {
        // Mengambil data tunggal pertama dari About Us
        // homepage_text diabaikan di level view karena tidak dipanggil
        $this->about = AboutUsModel::first();

        // Mengambil seluruh data lini bisnis
        $this->businessLines = BusinessLine::all();
    }

    public function render()
    {
        return view('livewire.about-page');
    }
}
