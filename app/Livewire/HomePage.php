<?php

namespace App\Livewire;

use App\Models\Program;
use App\Models\Workshop;
use Livewire\Component;

class HomePage extends Component
{

    public $programs;

    public $seminars;
    public $selected = [];
    public $simulatorResult = null;

    public function mount()
    {
        $this->programs = Program::all();
        $this->seminars = Workshop::all();
    }

    public function toggleChoice($choice)
    {
        // Jika sudah ada di array, hapus (toggle off)
        if (in_array($choice, $this->selected)) {
            $this->selected = array_diff($this->selected, [$choice]);
        }
        // Jika belum ada dan masih kurang dari 2, tambahkan
        elseif (count($this->selected) < 2) {
            $this->selected[] = $choice;
        }

        // Hitung hasil jika sudah memilih tepat 2
        $this->calculate();
    }

    private function calculate()
    {
        if (count($this->selected) < 2) {
            $this->simulatorResult = null;
            return;
        }

        // Logika Kombinasi: A (Visual), B (Logika), C (Mekanik)
        if (in_array('A', $this->selected) && in_array('B', $this->selected)) {
            $this->simulatorResult = "Web Programming";
        } elseif (in_array('A', $this->selected) && in_array('C', $this->selected)) {
            $this->simulatorResult = "Arsitektur + Smart Home";
        } elseif (in_array('B', $this->selected) && in_array('C', $this->selected)) {
            $this->simulatorResult = "Robotik & IoT";
        }
    }

    public function render()
    {
        return view('livewire.home-page');
    }
}