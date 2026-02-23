<?php

namespace App\Livewire;

use App\Models\Workshop;
use Livewire\Component;

class WorkshopPage extends Component
{
    public $filterType = 'all';

    public function render()
    {
        $workshops = Workshop::query()
            ->when($this->filterType !== 'all', function ($query) {
                $query->where('type', $this->filterType);
            })
            ->latest()
            ->get();

        return view('livewire.workshop-page', [
            'workshops' => $workshops
        ]);
    }
}