<?php

namespace App\Livewire;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class OrderIndex extends Component
{
    use WithPagination;

    public $status = 'all'; // Filter status: all, pending, processing, completed, cancelled

    public function setStatus($newStatus)
    {
        $this->status = $newStatus;
        $this->resetPage(); // Reset ke halaman 1 setiap ganti filter
    }

    public function render()
    {
        $query = Order::with('items') // Eager load detail item
            ->where('user_id', Auth::id())
            ->latest();

        if ($this->status !== 'all') {
            $query->where('status', $this->status);
        }

        return view('livewire.order-index', [
            'orders' => $query->paginate(6)
        ]);
    }
}
