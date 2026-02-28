<?php

namespace App\Livewire;

use App\Models\KitRobotic;
use Livewire\Component;

class KitDetail extends Component
{
    public $kit;
    public $activeImage;

    public function mount($id)
    {
        $this->kit = KitRobotic::with(['items', 'moduls', 'images'])->findOrFail($id);
        $this->activeImage = $this->kit->images->first()->image ?? 'https://placehold.co/600x400';
    }

    public function render()
    {
        // Hitung total harga real-time
        $itemsCost = $this->kit->items->sum(fn($i) => $i->price * $i->pivot->quantity);
        $modulsCost = $this->kit->moduls->sum('price');
        $totalPrice = $itemsCost + $modulsCost - $this->kit->discount;

        return view('livewire.kit-detail', [
            'totalPrice' => $totalPrice,
            'itemsCost' => $itemsCost,
            'modulsCost' => $modulsCost
        ]);
    }
}