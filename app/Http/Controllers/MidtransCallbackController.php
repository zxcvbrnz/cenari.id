<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class MidtransCallbackController extends Controller
{
    public function handle(Request $request)
    {
        $serverKey = config('midtrans.server_key');
        $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

        if ($hashed !== $request->signature_key) return response()->json(['message' => 'Invalid signature'], 403);

        $order = Order::where('order_number', $request->order_id)->first();
        if (!$order) return response()->json(['message' => 'Order not found'], 404);

        $status = $request->transaction_status;

        if (in_array($status, ['capture', 'settlement'])) {
            $order->update(['status' => 'processing']);
        } elseif (in_array($status, ['deny', 'expire', 'cancel'])) {
            $order->update(['status' => 'cancelled']);
        }

        return response()->json(['message' => 'OK']);
    }
}
