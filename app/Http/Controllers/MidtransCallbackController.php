<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class MidtransCallbackController extends Controller
{
    // public function handle(Request $request)
    // {
    //     $serverKey = config('midtrans.server_key');
    //     $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

    //     if ($hashed !== $request->signature_key) return response()->json(['message' => 'Invalid signature'], 403);

    //     $order = Order::where('order_number', $request->order_id)->first();
    //     if (!$order) return response()->json(['message' => 'Order not found'], 404);

    //     $status = $request->transaction_status;

    //     if (in_array($status, ['capture', 'settlement'])) {
    //         $order->update(['status' => 'processing']);
    //     } elseif (in_array($status, ['deny', 'expire', 'cancel'])) {
    //         $order->update(['status' => 'cancelled']);
    //     }

    //     return response()->json(['message' => 'OK']);
    // }

    public function handle(Request $request)
    {
        $serverKey = config('midtrans.server_key');
        $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

        if ($hashed !== $request->signature_key) return response()->json(['message' => 'Invalid signature'], 403);

        // Eager load 'product' (polymorphic) dan jika itu Kit, load 'items' komponennya
        $order = Order::with(['items.product' => function ($morph) {
            $morph->morphWith([
                \App\Models\KitRobotic::class => ['items'], // Load komponen di dalam kit
            ]);
        }])->where('order_number', $request->order_id)->first();

        if (!$order) return response()->json(['message' => 'Order not found'], 404);

        $status = $request->transaction_status;

        if (in_array($status, ['capture', 'settlement'])) {
            if ($order->status !== 'processing') {

                foreach ($order->items as $orderItem) {
                    $product = $orderItem->product;

                    if ($product instanceof \App\Models\KitRobotic) {
                        // JIKA YANG DIBELI ADALAH KIT:
                        // Kurangi stok setiap item penyusun kit tersebut
                        foreach ($product->items as $componentItem) {
                            $decrementAmount = $orderItem->quantity * $componentItem->pivot->quantity;
                            $componentItem->decrement('stock', $decrementAmount);
                        }
                    } elseif ($product instanceof \App\Models\Item) {
                        // JIKA YANG DIBELI ADALAH ITEM SATUAN:
                        $product->decrement('stock', $orderItem->quantity);
                    }
                }

                $order->update(['status' => 'processing']);
            }
        } elseif (in_array($status, ['deny', 'expire', 'cancel'])) {
            $order->update(['status' => 'cancelled']);
        }

        return response()->json(['message' => 'OK']);
    }
}