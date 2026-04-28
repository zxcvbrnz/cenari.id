<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\On;

class Cart extends Component
{

    public $selectedAddressId;

    #[On('cartUpdated')]
    public function refreshCart()
    {
        // Komponen akan otomatis render ulang saat event ini diterima
    }

    public function updateQuantity($key, $newQty)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$key])) {
            // Pastikan qty adalah angka dan minimal 1
            $qty = max(1, (int)$newQty);
            $cart[$key]['quantity'] = $qty;

            session()->put('cart', $cart);
        }
    }

    public function removeFromCart($key)
    {
        $cart = session()->get('cart', []);
        unset($cart[$key]);
        session()->put('cart', $cart);

        // Dispatch kembali untuk memastikan UI lain yang bergantung pada cart ikut update
        $this->dispatch('cartUpdated');
    }

    public function processCheckout()
    {
        if (!$this->selectedAddressId) {
            $this->dispatch('swal:modal', [
                'title' => 'Gagal!',
                'icon' => 'error',
                'text' => 'Pilih alamat pengiriman terlebih dahulu.'
            ]);
            return;
        }

        // Lanjutkan proses checkout jika alamat ada
        return redirect()->route('checkout.index', ['address' => $this->selectedAddressId]);
    }

    public function render()
    {
        $addresses = Auth::user()->addresses ?? [];
        return view('livewire.cart', [
            'cart' => session()->get('cart', []),
            'addresses' => $addresses
        ]);
    }
}
