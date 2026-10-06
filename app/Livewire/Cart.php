<?php

namespace App\Livewire;

use App\Models\Item;
use App\Models\KitRobotic;
use App\Models\Order;
use App\Models\Souvenir;
use App\Models\UserAddress;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\Attributes\On;
use Midtrans\Snap;
use Midtrans\Config;
use Silvanix\Wablas\Message;

class Cart extends Component
{
    public $selectedAddressId;
    public $shipping_method = 'cod'; // Default ke COD
    public $isSendAvailable = false; // Variable boolean untuk menonaktifkan fitur 'send'

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

        // Mengecek apakah user sudah login, jika tidak maka alihkan ke halaman login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Ambil alamat hanya jika metode pengiriman adalah 'send'
        $address = null;
        if ($this->shipping_method === 'send') {
            $address = UserAddress::find($this->selectedAddressId);
            if (!$address) {
                $this->dispatch('swal:modal', [
                    'icon' => 'error',
                    'title' => 'Gagal!',
                    'text' => 'Silahkan pilih alamat terlebih dahulu.'
                ]);
                return;
            }
        }

        if (empty($cart)) return;

        DB::beginTransaction();
        try {
            // 1. Simpan Order
            $orderData = [
                'user_id' => Auth::id(),
                'order_number' => 'ORD-' . time() . rand(100, 999),
                'total_amount' => collect($cart)->sum(fn($i) => $i['price'] * $i['quantity']),
                'status' => 'pending',
                'shipping_method' => $this->shipping_method,
                // Kolom alamat akan NULL jika COD
                'recipient_name' => $address ? $address->recipient_name : Auth::user()->name,
                'phone_number' => $address ? $address->phone_number : Auth::user()->whatsapp,
                'full_address' => $address ? $address->full_address : null,
                'province' => $address ? $address->province : null,
                'city' => $address ? $address->city : null,
                'district' => $address ? $address->district : null,
                'village' => $address ? $address->village : null,
                'postal_code' => $address ? $address->postal_code : null,
            ];

            $order = Order::create($orderData);

            // 2. Simpan Order Items & Kurangi Stok
            foreach ($cart as $item) {
                $productType = match ($item['type']) {
                    'kit' => KitRobotic::class,
                    'souvenir' => Souvenir::class,
                    default => Item::class,
                };

                // A. Simpan detail item ke database order
                $order->items()->create([
                    'product_id' => $item['id'],
                    'product_type' => $productType,
                    'name' => $item['name'],
                    'price' => $item['price'],
                    'quantity' => $item['quantity'],
                    'image' => $item['image']
                ]);

                // B. Logika Pengurangan Stok berdasarkan Tipe Produk
                if ($item['type'] === 'kit') {
                    $kit = KitRobotic::with('items')->find($item['id']);

                    if (!$kit) {
                        throw new \Exception("Data Kit Robotic tidak ditemukan.");
                    }

                    // 1) Kurangi stok Kit itu sendiri (jika ada kolom stock di tabel kit_robotics)
                    if (isset($kit->stock)) {
                        if ($kit->stock < $item['quantity']) {
                            throw new \Exception("Stok Kit '{$kit->name}' tidak mencukupi (Tersisa: {$kit->stock}).");
                        }
                        $kit->decrement('stock', $item['quantity']);
                    }

                    // 2) Kurangi stok tiap Item penyusun di dalam Kit tersebut
                    foreach ($kit->items as $componentItem) {
                        // Jumlah komponen per 1 unit kit (mengambil dari table pivot 'quantity')
                        $qtyPerKit = $componentItem->pivot->quantity ?? 1;
                        $totalDeduction = $qtyPerKit * $item['quantity'];

                        if ($componentItem->stock < $totalDeduction) {
                            throw new \Exception("Stok komponen '{$componentItem->name}' tidak mencukupi untuk Kit '{$kit->name}'.");
                        }

                        $componentItem->decrement('stock', $totalDeduction);
                    }
                } elseif ($item['type'] === 'souvenir') {
                    $souvenir = Souvenir::find($item['id']);

                    if (!$souvenir) {
                        throw new \Exception("Data Souvenir tidak ditemukan.");
                    }

                    if ($souvenir->stock < $item['quantity']) {
                        throw new \Exception("Stok Souvenir '{$souvenir->name}' tidak mencukupi (Tersisa: {$souvenir->stock}).");
                    }

                    $souvenir->decrement('stock', $item['quantity']);
                } else { // Tipe 'item' / produk tunggal
                    $singleItem = Item::find($item['id']);

                    if (!$singleItem) {
                        throw new \Exception("Data Item tidak ditemukan.");
                    }

                    if ($singleItem->stock < $item['quantity']) {
                        throw new \Exception("Stok Item '{$singleItem->name}' tidak mencukupi (Tersisa: {$singleItem->stock}).");
                    }

                    $singleItem->decrement('stock', $item['quantity']);
                }
            }

            // 3. Midtrans Setup (jika bukan COD)
            if ($this->shipping_method !== 'cod') {
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
                        'phone' => $orderData['phone_number'],
                    ],
                ];

                $snapToken = Snap::getSnapToken($params);
                $order->update(['snap_token' => $snapToken]);
            }

            // Commit transaksi jika semua sukses tanpa exception
            DB::commit();
            session()->forget('cart');

            $this->dispatch('swal:modal-redirect', [
                'title' => 'Berhasil!',
                'icon' => 'success',
                'text' => 'Pesanan berhasil dibuat.',
                'redirectUrl' => route('order.show', $order->id)
            ]);

            // 4. Pengiriman Notifikasi WhatsApp via Wablas
            $send = new Message();

            $queue = [
                [
                    'phone' => $orderData['phone_number'],
                    'message' => "Halo *" . $orderData['recipient_name'] . "*\n" .
                        "Terima kasih telah melakukan pemesanan di Cenari ID\n" .
                        "```\n" .
                        "Order Number : " . $order->order_number . "\n" .
                        "Total Amount : Rp " . number_format($order->total_amount, 0, ',', '.') . "\n" .
                        "Status       : " . ucfirst($order->status) . "\n" .
                        "```\n" .
                        "Silakan cek informasi lengkap di website kami:\n" .
                        "www.cenari.id",
                ],
                [
                    'phone' => '089691884833', // Nomor admin 1
                    'message' => "Halo *Admin*\n" .
                        "Terdapat pesanan baru dari web Cenari ID\n" .
                        "```\n" .
                        "Order Number : " . $order->order_number . "\n" .
                        "Nama         : " . Auth::user()->name . "\n" .
                        "Total Amount : Rp " . number_format($order->total_amount, 0, ',', '.') . "\n" .
                        "Status       : " . ucfirst($order->status) . "\n" .
                        "```\n" .
                        "www.cenari.id",
                ],
                [
                    'phone' => '085103326061', // Nomor admin 2
                    'message' => "Halo *Admin*\n" .
                        "Terdapat pesanan baru dari web Cenari ID\n" .
                        "```\n" .
                        "Order Number : " . $order->order_number . "\n" .
                        "Nama         : " . Auth::user()->name . "\n" .
                        "Total Amount : Rp " . number_format($order->total_amount, 0, ',', '.') . "\n" .
                        "Status       : " . ucfirst($order->status) . "\n" .
                        "```\n" .
                        "www.cenari.id",
                ],
            ];

            foreach ($queue as $index => $msgItem) {
                $send->multiple_text([$msgItem]);

                // Beri jeda acak 10-20 detik antar pengiriman pesan
                if ($index < count($queue) - 1) {
                    sleep(rand(10, 20));
                }
            }
        } catch (\Exception $e) {
            DB::rollBack();
            $this->dispatch('swal:modal', [
                'icon' => 'error',
                'title' => 'Gagal!',
                'text' => $e->getMessage()
            ]);
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
