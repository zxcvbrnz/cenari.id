<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Order;
use Livewire\WithPagination;

class OrderManager extends Component
{
    use WithPagination;

    public $search = '';
    public $statusFilter = '';

    protected $updatesQueryString = ['search', 'statusFilter'];

    public function updateStatus($orderId, $newStatus)
    {
        $order = Order::findOrFail($orderId);
        $order->update(['status' => $newStatus]);

        session()->flash('success', "Status pesanan #{$order->order_number} diperbarui menjadi {$newStatus}.");
    }

    public function deleteOrder($orderId)
    {
        Order::findOrFail($orderId)->delete();
        session()->flash('success', 'Data pesanan berhasil dihapus.');
    }

    public function render()
    {
        $orders = Order::with(['user', 'items'])
            ->where('order_number', 'like', '%' . $this->search . '%')
            ->when($statusFilter = $this->statusFilter, function ($query) use ($statusFilter) {
                return $query->where('status', $statusFilter);
            })
            ->latest()
            ->paginate(10);

        return view('livewire.admin.order-manager', [
            'orders' => $orders
        ]);
    }
}