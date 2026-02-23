<?php

namespace App\Livewire;

use App\Models\MissingLink;
use App\Models\Program;
use Livewire\Component;

class DetailProgram extends Component
{
    public $slug;
    public $program;
    public $missingLink;

    public function mount($slug)
    {
        $this->slug = $slug;
        // Mengambil data dari Database berdasarkan slug
        $this->program = Program::with(['coursePackages.moduls'])
            ->where('slug', $slug)
            ->first();

        if (!$this->program) {
            abort(404);
        }

        $this->missingLink = MissingLink::inRandomOrder()->first();
    }

    public function render()
    {
        return view('livewire.detail-program');
    }
}
