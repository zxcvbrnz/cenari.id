<?php

namespace App\Livewire;

use App\Models\Item;
use App\Models\KitRobotic;
use Livewire\Component;

class Shop extends Component
{
    public $search = '';
    public $viewMode = 'kits';

    // Fitur Keranjang
    public function addToCart($id, $type)
    {
        $cart = session()->get('cart', []);
        $key = $type . '_' . $id;
        $product_name = '';

        if (isset($cart[$key])) {
            $cart[$key]['quantity']++;
            $product_name = $cart[$key]['name'];
        } else {
            if ($type === 'kit') {
                // Eager load items dan moduls untuk menghitung harga
                $product = KitRobotic::with(['images', 'items', 'moduls'])->find($id);

                if ($product) {
                    // Hitung total harga kit (Items + Moduls - Discount)
                    $itemsPrice = $product->items->sum(fn($i) => $i->price * $i->pivot->quantity);
                    $modulsPrice = $product->moduls->sum('price');
                    $calculatedPrice = $itemsPrice + $modulsPrice - $product->discount;

                    $product_price = $calculatedPrice;
                    $product_image = $product->images->first()->filename ?? null;
                }
            } else {
                $product = Item::with('images')->find($id);
                if ($product) {
                    $product_price = $product->price;
                    $product_image = $product->images->first()->filename ?? null;
                }
            }

            if ($product) {
                $product_name = $product->name;
                $cart[$key] = [
                    'id' => $id,
                    'name' => $product->name,
                    'price' => $product_price, // Harga yang sudah dihitung atau dari kolom price
                    'image' => $product_image,
                    'type' => $type,
                    'quantity' => 1
                ];
            }
        }

        session()->put('cart', $cart);
        $this->dispatch('cartUpdated');

        $this->dispatch('swal:modal', [
            'title' => 'Berhasil!',
            'icon' => 'success',
            'text' => $product_name . ' telah ditambahkan ke keranjang.'
        ]);
    }

    public function render()
    {
        $kits = KitRobotic::with(['items', 'moduls', 'images'])
            ->where('name', 'like', '%' . $this->search . '%')
            ->latest()
            ->get(); // Pagination dihapus

        $items = Item::with('images')
            ->where('name', 'like', '%' . $this->search . '%')
            ->latest()
            ->get(); // Pagination dihapus

        return view('livewire.shop', [
            'kits' => $kits,
            'items' => $items,
        ]);
    }
}
