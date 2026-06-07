<?php

namespace App\Livewire;

use Livewire\Component;

class TutorialKursus extends Component
{
    // State untuk mengontrol tab aktif ('instruktur' atau 'peserta')
    public $tab = 'instruktur';

    // Menyimpan ID video YouTube tutorial (Ganti dengan ID asli video Anda)
    public $youtubeVideoId = 'dQw4w9WgXcQ';

    public function setTab($role)
    {
        if (in_array($role, ['instruktur', 'peserta'])) {
            $this->tab = $role;
        }
    }

    public function render()
    {
        return view('livewire.tutorial-kursus');
    }
}
