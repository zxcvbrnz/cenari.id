<?php

namespace App\Livewire;

use App\Models\Souvenir;
use Livewire\Component;

class SouvenirDetail extends Component
{
    public $souvenir;
    public $activeImage;

    public function mount($id)
    {
        $this->souvenir = Souvenir::findOrFail($id);
        $this->activeImage = $this->souvenir->images->first()->filename ?? 'https://placehold.co/400x400';
    }

    public function addToCart()
    {
        $cart = session()->get('cart', []);
        $key = 'souvenir_' . $this->souvenir->id;

        if (isset($cart[$key])) {
            $cart[$key]['quantity']++;
        } else {
            $cart[$key] = [
                'id' => $this->souvenir->id,
                'name' => $this->souvenir->name,
                'price' => $this->souvenir->price,
                // Menggunakan image pertama untuk thumbnail keranjang
                'image' => $this->activeImage,
                'type' => 'souvenir',
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
            'text' => $this->souvenir->name . ' telah ditambahkan ke keranjang.'
        ]);
    }

    public function render()
    {
        return view('livewire.souvenir-detail');
    }
}
