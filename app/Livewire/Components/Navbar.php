<?php

namespace App\Livewire\Components;

use App\Livewire\Actions\Logout;
use App\Models\Instansi;
use Livewire\Component;

class Navbar extends Component
{
    public function render()
    {
        $instansi = Instansi::with('programs')->get();
        return view('livewire.components.navbar', [
            'instansi' => $instansi,
        ]);
    }
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}