<?php

namespace App\Livewire;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class OrderShow extends Component
{
    public $orderId;

    public function mount($id)
    {
        $this->orderId = $id;
    }

    public function render()
    {
        // Eager load items untuk efisiensi query
        $order = Order::with('items')
            ->where('user_id', Auth::id())
            ->findOrFail($this->orderId);

        return view('livewire.order-show', [
            'order' => $order
        ]);
    }
}
