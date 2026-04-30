<?php

namespace App\Livewire;

use App\Models\Item;
use App\Models\KitRobotic;
use App\Models\Order;
use App\Models\UserAddress;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\Attributes\On;
use Midtrans\Snap;
use Midtrans\Config;

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
        $cart = session()->get('cart', []);
        $address = UserAddress::find($this->selectedAddressId);

        if (!$address || empty($cart)) return;

        DB::beginTransaction();
        try {
            // 1. Simpan Order
            $order = Order::create([
                'user_id' => Auth::id(),
                'order_number' => 'ORD-' . time() . rand(100, 999),
                'total_amount' => collect($cart)->sum(fn($i) => $i['price'] * $i['quantity']),
                'status' => 'pending',
                'recipient_name' => $address->recipient_name,
                'phone_number' => $address->phone_number,
                'full_address' => $address->full_address,
                'province' => $address->province,
                'city' => $address->city,
                'district' => $address->district,
                'village' => $address->village,
                'postal_code' => $address->postal_code,
            ]);

            // 2. Simpan Items
            foreach ($cart as $item) {
                $order->items()->create([
                    'product_id' => $item['id'],
                    'product_type' => $item['type'] == 'kit' ? KitRobotic::class : Item::class,
                    'name' => $item['name'],
                    'price' => $item['price'],
                    'quantity' => $item['quantity'],
                    'image' => $item['image']
                ]);
            }

            // 3. Midtrans Setup
            Config::$serverKey = config('midtrans.server_key');
            Config::$isProduction = config('midtrans.is_production');
            Config::$isSanitized = true;
            Config::$is3ds = true;

            $params = [
                'transaction_details' => [
                    'order_id' => $order->order_number,
                    'gross_amount' => (int) $order->total_amount,
                ],
                'customer_details' => [
                    'first_name' => Auth::user()->name,
                    'email' => Auth::user()->email,
                    'phone' => $address->phone_number,
                ],
            ];

            $snapToken = Snap::getSnapToken($params);
            $order->update(['snap_token' => $snapToken]);

            DB::commit();
            session()->forget('cart');

            return redirect()->route('order.show', $order->id);
        } catch (\Exception $e) {
            DB::rollBack();
            $this->dispatch('swal:modal', ['icon' => 'error', 'title' => 'Gagal!', 'text' => $e->getMessage()]);
        }
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
