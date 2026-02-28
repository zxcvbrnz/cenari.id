<?php

namespace App\Livewire;

use App\Models\Item;
use Livewire\Component;

class ItemDetail extends Component
{
    public $item;
    public $activeImage;

    public function mount($id)
    {
        $this->item = Item::with('images')->findOrFail($id);
        $this->activeImage = $this->item->images->first()->image ?? 'https://placehold.co/400x400';
    }

    public function render()
    {
        return view('livewire.item-detail');
    }
}