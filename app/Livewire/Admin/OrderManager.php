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

        $this->dispatch('swal:modal', [
            'title' => 'Status Diperbarui',
            'icon'  => 'success',
            'text'  => 'Pesanan #' . $order->order_number . ' sekarang berstatus ' . strtoupper($newStatus) . '.'
        ]);
    }

    public function deleteOrder($orderId)
    {
        $order = Order::findOrFail($orderId);
        $orderNumber = $order->order_number;
        $order->delete();
        $this->dispatch('swal:modal', [
            'title' => 'Pesanan Dihapus',
            'icon'  => 'warning',
            'text'  => 'Data pesanan #' . $orderNumber . ' telah dihapus dari sistem.'
        ]);
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