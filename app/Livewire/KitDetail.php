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
        $this->activeImage = $this->kit->images->first()->filename ?? 'https://placehold.co/600x400';
    }

    public function addToCart()
    {
        $cart = session()->get('cart', []);

        // Gunakan prefix 'kit_' agar tidak bentrok dengan item satuan
        $key = 'kit_' . $this->kit->id;

        // Hitung harga total paket saat ini (termasuk diskon)
        $itemsCost = $this->kit->items->sum(fn($i) => $i->price * $i->pivot->quantity);
        $modulsCost = $this->kit->moduls->sum('price');
        $totalPrice = $itemsCost + $modulsCost - $this->kit->discount;

        if (isset($cart[$key])) {
            $cart[$key]['quantity']++;
        } else {
            $cart[$key] = [
                'id' => $this->kit->id,
                'name' => $this->kit->name,
                'price' => $totalPrice,
                'image' => $this->activeImage,
                'type' => 'kit',
                'quantity' => 1
            ];
        }

        session()->put('cart', $cart);

        // Kirim event untuk notifikasi atau update komponen lain
        $this->dispatch('cartUpdated');

        // Optional: Berikan feedback simpel (bisa pakai sweetalert seperti sebelumnya)
        $this->dispatch('swal:modal', [
            'title' => 'Berhasil!',
            'icon' => 'success',
            'text' => $this->kit->name . ' telah ditambahkan ke keranjang.'
        ]);
    }

    public function render()
    {
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
