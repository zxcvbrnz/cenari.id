<?php

namespace App\Livewire;

use Livewire\Component;

class Footer extends Component
{
    public function render()
    {
        $instansi = \App\Models\Instansi::get();
        return view('livewire.footer', [
            'instansi' => $instansi,
        ]);
    }
}