<?php

namespace App\Livewire;

use Livewire\Component;

class B2BSolution extends Component
{
    public $selectedLevel = 'SD';

    public $curriculums = [
        'SD' => [
            'sem1' => 'Logika Coding Dasar (Lab Komputer)',
            'sem2' => 'Pengenalan Sensor Dasar (Lab Robotik)',
            'outcome' => 'Siswa mampu membuat animasi interaktif yang menggerakkan lampu LED nyata.'
        ],
        'SMP' => [
            'sem1' => 'Desain 3D & Prototyping (Lab Komputer)',
            'sem2' => 'Mikrokontroler ESP32 (Lab Robotik)',
            'outcome' => 'Siswa mampu mendesain casing sensor di komputer dan mencetaknya dengan 3D Printer.'
        ],
        'SMA' => [
            'sem1' => 'Web Dashboard IoT (Lab Komputer)',
            'sem2' => 'Sistem Otomasi Industri (Lab Robotik)',
            'outcome' => 'Siswa mampu membangun sistem kontrol rumah pintar berbasis web.'
        ],
    ];

    public function selectLevel($level)
    {
        $this->selectedLevel = $level;
    }
    public function render()
    {
        return view('livewire.b2-b-solution');
    }
}
