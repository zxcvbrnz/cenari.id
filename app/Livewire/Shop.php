<?php

namespace App\Livewire;

use App\Models\Item;
use App\Models\KitRobotic;
use Livewire\Component;

class Shop extends Component
{
    public $search = '';
    public $viewMode = 'kits';

    /**
     * Menghitung ketersediaan stok untuk sebuah Kit
     */
    private function calculateKitStock($kit)
    {
        if ($kit->items->isEmpty()) return 0;

        return $kit->items->min(function ($item) {
            $requiredPerKit = $item->pivot->quantity ?: 1;
            return (int) floor($item->stock / $requiredPerKit);
        });
    }

    public function addToCart($id, $type)
    {
        $cart = session()->get('cart', []);
        $key = $type . '_' . $id;
        $product_name = '';
        $currentStock = 0;

        if ($type === 'kit') {
            $product = KitRobotic::with(['images', 'items', 'moduls'])->find($id);

            if (!$product) return;

            $currentStock = $this->calculateKitStock($product);

            if ($currentStock <= 0) {
                $this->dispatch('swal:modal', [
                    'title' => 'Stok Habis!',
                    'icon' => 'error',
                    'text' => 'Salah satu komponen untuk kit ini tidak tersedia.'
                ]);
                return;
            }

            $itemsPrice = $product->items->sum(fn($i) => $i->price * $i->pivot->quantity);
            $modulsPrice = $product->moduls->sum('price');
            $product_price = $itemsPrice + $modulsPrice - $product->discount;
            $product_image = $product->images->first()->filename ?? null;
        } else {
            $product = Item::with('images')->find($id);

            if (!$product || $product->stock <= 0) {
                $this->dispatch('swal:modal', [
                    'title' => 'Kosong!',
                    'icon' => 'error',
                    'text' => 'Stok item ini sudah habis.'
                ]);
                return;
            }

            $currentStock = $product->stock;
            $product_price = $product->price;
            $product_image = $product->images->first()->filename ?? null;
        }

        // Cek apakah jumlah di keranjang melebihi stok yang ada
        $qtyInCart = isset($cart[$key]) ? $cart[$key]['quantity'] : 0;
        if ($qtyInCart + 1 > $currentStock) {
            $this->dispatch('swal:modal', [
                'title' => 'Batas Stok!',
                'icon' => 'warning',
                'text' => 'Tidak bisa menambah lebih banyak, stok terbatas.'
            ]);
            return;
        }

        if (isset($cart[$key])) {
            $cart[$key]['quantity']++;
        } else {
            $cart[$key] = [
                'id' => $id,
                'name' => $product->name,
                'price' => $product_price,
                'image' => $product_image,
                'type' => $type,
                'quantity' => 1
            ];
        }

        session()->put('cart', $cart);
        $this->dispatch('cartUpdated');

        $this->dispatch('swal:modal', [
            'title' => 'Berhasil!',
            'icon' => 'success',
            'text' => $product->name . ' masuk ke keranjang.'
        ]);
    }

    public function render()
    {
        $kits = KitRobotic::with(['items', 'moduls', 'images'])
            ->where('name', 'like', '%' . $this->search . '%')
            ->latest()
            ->get();

        $items = Item::with('images')
            ->where('name', 'like', '%' . $this->search . '%')
            ->orderByRaw('stock = 0 asc')
            ->latest()
            ->get();

        return view('livewire.shop', [
            'kits' => $kits,
            'items' => $items,
        ]);
    }
}