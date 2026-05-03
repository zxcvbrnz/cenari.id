<?php

namespace App\Livewire;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PaymentFinish extends Component
{
    public $order;
    public $isSuccess = false;

    public function mount()
    {
        $order_id = request()->query('order_id');
        $statusCode = request()->query('status_code');

        // Midtrans mengirim status_code 200 atau 201 untuk sukses/pending
        // Sedangkan 400, 407, 500 dll untuk error
        $this->isSuccess = in_array($statusCode, [200, 201]);

        if (!$order_id) {
            abort(404, 'Not Found');
        }

        if (!Auth::check()) {
            abort(403, 'Unauthorized');
        }

        // Mencari order
        $this->order = Order::where('user_id', Auth::id())
            ->where('id', $order_id) // Pastikan kolom ini sesuai (id atau order_number)
            ->firstOrFail();
    }

    public function render()
    {
        return view('livewire.payment-finish');
    }
}