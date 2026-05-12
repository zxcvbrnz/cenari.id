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
        $currentStatus = $order->status;

        // 1. Jika sudah Cancelled atau Completed, kunci status (tidak bisa diubah lagi)
        if (in_array($currentStatus, ['cancelled', 'completed'])) {
            $this->dispatch('swal:modal', [
                'title' => 'Aksi Ditolak',
                'icon'  => 'error',
                'text'  => 'Pesanan yang sudah ' . strtoupper($currentStatus) . ' tidak dapat diubah lagi.'
            ]);
            return;
        }

        // 2. Logika transisi status
        $canUpdate = false;

        if ($currentStatus === 'pending') {
            // Pending hanya bisa ke Processing atau Cancelled
            if (in_array($newStatus, ['processing', 'cancelled'])) {
                $canUpdate = true;
            }
        } elseif ($currentStatus === 'processing') {
            // Processing hanya bisa ke Completed
            if ($newStatus === 'completed') {
                $canUpdate = true;
            }
        }

        // 3. Eksekusi jika memenuhi syarat
        if ($canUpdate) {
            $order->update(['status' => $newStatus]);

            $this->dispatch('swal:modal', [
                'title' => 'Status Diperbarui',
                'icon'  => 'success',
                'text'  => 'Pesanan #' . $order->order_number . ' berhasil diupdate ke ' . strtoupper($newStatus) . '.'
            ]);
        } else {
            $this->dispatch('swal:modal', [
                'title' => 'Urutan Salah',
                'icon'  => 'info',
                'text'  => 'Status ' . strtoupper($currentStatus) . ' tidak bisa langsung ke ' . strtoupper($newStatus) . '.'
            ]);
        }
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