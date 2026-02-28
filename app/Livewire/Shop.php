<?php

namespace App\Livewire;

use App\Models\Item;
use App\Models\KitRobotic;
use Livewire\Component;
use Livewire\WithPagination;

class Shop extends Component
{
    use WithPagination;

    public $search = '';
    public $viewMode = 'kits';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $kits = KitRobotic::with(['items', 'moduls', 'images'])
            ->where('name', 'like', '%' . $this->search . '%')
            ->latest()
            ->paginate(6);

        $items = Item::with('images')
            ->where('name', 'like', '%' . $this->search . '%')
            ->latest()
            ->paginate(12);

        return view('livewire.shop', [
            'kits' => $kits,
            'items' => $items
        ]);
    }
}