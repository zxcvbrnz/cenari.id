<?php

namespace App\Livewire;

use App\Models\Item;
use App\Models\KitRobotic;
use App\Models\Order;
use App\Models\Souvenir;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Shop extends Component
{
    public $search = '';
    public $viewMode = 'all'; // Default diset ke 'all'

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
        $product_price = 0;
        $product_image = null;
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
        } elseif ($type === 'item') {
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
        } elseif ($type === 'souvenir') {
            $product = Souvenir::with('images')->find($id);

            if (!$product || $product->stock <= 0) {
                $this->dispatch('swal:modal', [
                    'title' => 'Kosong!',
                    'icon' => 'error',
                    'text' => 'Stok souvenir ini sudah habis.'
                ]);
                return;
            }

            $currentStock = $product->stock;
            $product_price = $product->price;
            $product_image = $product->images->first()->filename ?? null;
        }

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
            ->get()
            ->map(function ($kit) {
                $itemsPrice = $kit->items->sum(fn($i) => ($i->price ?? 0) * ($i->pivot->quantity ?? 1));
                $modulsPrice = $kit->moduls->sum('price');

                $kit->type = 'kit';
                $kit->computed_price = max(0, $itemsPrice + $modulsPrice - ($kit->discount ?? 0));
                $kit->computed_stock = $this->calculateKitStock($kit);
                return $kit;
            });

        $items = Item::with('images')
            ->where('name', 'like', '%' . $this->search . '%')
            ->get()
            ->map(function ($item) {
                $item->type = 'item';
                $item->computed_price = $item->price;
                $item->computed_stock = $item->stock ?? 0;
                return $item;
            });

        $souvenirs = Souvenir::with('images')
            ->where('name', 'like', '%' . $this->search . '%')
            ->get()
            ->map(function ($souvenir) {
                $souvenir->type = 'souvenir';
                $souvenir->computed_price = $souvenir->price;
                $souvenir->computed_stock = $souvenir->stock ?? 0;
                return $souvenir;
            });

        // Pengurutan stok habis ke paling bawah
        $sortStock = fn($collection) => $collection->sortBy(fn($product) => $product->computed_stock <= 0 ? 1 : 0);

        $allProducts = collect();
        if ($this->viewMode === 'all') {
            $allProducts = $sortStock($kits->concat($items)->concat($souvenirs));
        }

        $orderCount = Order::where('user_id', Auth::id())
            ->whereIn('status', ['pending', 'processing'])
            ->count();

        return view('livewire.shop', [
            'allProducts' => $allProducts,
            'kits'        => $sortStock($kits),
            'items'       => $sortStock($items),
            'souvenirs'   => $sortStock($souvenirs),
            'orderCount'  => $orderCount
        ]);
    }
}
