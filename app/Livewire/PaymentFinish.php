<?php

namespace App\Livewire;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PaymentFinish extends Component
{
    public $order;

    public function mount($order_id)
    {
        // Mencari order berdasarkan ID atau Order Number
        $this->order = Order::where('user_id', Auth::id())
            ->where('id', $order_id)
            ->firstOrFail();
    }

    public function render()
    {
        return view('livewire.payment-finish');
    }
}