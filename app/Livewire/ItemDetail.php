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
        $this->activeImage = $this->item->images->first()->filename ?? 'https://placehold.co/400x400';
    }

    public function addToCart()
    {
        $cart = session()->get('cart', []);
        $key = 'item_' . $this->item->id;

        if (isset($cart[$key])) {
            $cart[$key]['quantity']++;
        } else {
            $cart[$key] = [
                'id' => $this->item->id,
                'name' => $this->item->name,
                'price' => $this->item->price,
                // Menggunakan image pertama untuk thumbnail keranjang
                'image' => $this->activeImage,
                'type' => 'item',
                'quantity' => 1
            ];
        }

        session()->put('cart', $cart);

        // Emit event agar komponen Cart melakukan refresh
        $this->dispatch('cartUpdated');

        // Notifikasi SweetAlert (opsional jika Anda menggunakan script swal)
        $this->dispatch('swal:modal', [
            'title' => 'Berhasil!',
            'icon' => 'success',
            'text' => $this->item->name . ' telah ditambahkan ke keranjang.'
        ]);
    }

    public function render()
    {
        return view('livewire.item-detail');
    }
}
