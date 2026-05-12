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

    /**
     * Validasi stok sebelum memunculkan popup Midtrans
     */
    public function checkStockBeforePayment()
    {
        // Ambil data order beserta item dan detail produknya
        // Pastikan model OrderItem memiliki relasi 'product' ke model Product
        $order = Order::with('items.product')
            ->where('user_id', Auth::id())
            ->findOrFail($this->orderId);

        foreach ($order->items as $item) {
            $product = $item->product;

            // Jika produk tidak ditemukan atau stok lebih kecil dari jumlah yang dipesan
            if (!$product || $product->stock < $item->quantity) {
                $this->dispatch('swal:modal', [
                    'title' => 'Stok Tidak Cukup',
                    'icon'  => 'error',
                    'text'  => 'Maaf, stok untuk "' . $item->name . '" sudah habis atau tidak mencukupi.'
                ]);
                return;
            }
        }

        // Jika semua stok aman, kirim event ke frontend untuk buka Snap Midtrans
        $this->dispatch('open-midtrans', [
            'snap_token' => $order->snap_token
        ]);
    }

    public function render()
    {
        // Eager load items untuk tampilan detail
        $order = Order::with('items')
            ->where('user_id', Auth::id())
            ->findOrFail($this->orderId);

        return view('livewire.order-show', [
            'order' => $order
        ]);
    }
}