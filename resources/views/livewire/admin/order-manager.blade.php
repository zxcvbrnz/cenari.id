<div class="max-w-7xl mx-auto px-6 py-12">
    <!-- Header & Filter -->
    <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-6">
        <div>
            <h2 class="text-2xl font-black text-slate-900 uppercase tracking-tight">Manajemen Pesanan</h2>
            <p class="text-slate-500 text-xs font-bold uppercase tracking-widest mt-1">Pantau Transaksi & Pengiriman</p>
        </div>

        <div class="flex flex-wrap gap-3">
            <input type="text" wire:model.live="search" placeholder="Cari No. Pesanan..."
                class="bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs font-bold focus:ring-2 focus:ring-blue-500 outline-none w-64">

            <select wire:model.live="statusFilter"
                class="bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs font-bold outline-none">
                <option value="">Semua Status</option>
                <option value="pending">Pending</option>
                <option value="processing">Processing</option>
                <option value="completed">Completed</option>
                <option value="cancelled">Cancelled</option>
            </select>
        </div>
    </div>

    @if (session()->has('success'))
        <div
            class="mb-6 p-4 bg-emerald-50 text-emerald-600 rounded-2xl text-xs font-bold uppercase tracking-wider flex items-center gap-3">
            <div class="w-2 h-2 bg-emerald-400 rounded-full animate-pulse"></div>
            {{ session('success') }}
        </div>
    @endif

    <div class="space-y-6">
        @forelse ($orders as $order)
            <div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm overflow-hidden">
                <!-- Order Header -->
                <div
                    class="p-6 border-b border-slate-50 flex flex-wrap items-center justify-between gap-4 bg-slate-50/30">
                    <div class="flex items-center gap-4">
                        <div
                            class="w-12 h-12 rounded-2xl bg-white border border-slate-100 flex items-center justify-center">
                            <svg class="w-6 h-6 text-slate-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-sm font-black text-slate-900 uppercase">#{{ $order->order_number }}</h4>
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-tighter">
                                {{ $order->created_at->format('d M Y, H:i') }} • {{ $order->user->name ?? 'Guest' }}</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-3">
                        <!-- Status Badge -->
                        <span
                            class="px-3 py-1 rounded-full text-[9px] font-black uppercase tracking-widest
                            {{ $order->status == 'completed' ? 'bg-emerald-100 text-emerald-600' : '' }}
                            {{ $order->status == 'pending' ? 'bg-amber-100 text-amber-600' : '' }}
                            {{ $order->status == 'processing' ? 'bg-blue-100 text-blue-600' : '' }}
                            {{ $order->status == 'cancelled' ? 'bg-red-100 text-red-600' : '' }}">
                            {{ $order->status }}
                        </span>

                        <!-- Delete Action -->
                        <button
                            onclick="confirm('Hapus permanen data pesanan ini?') || event.stopImmediatePropagation()"
                            wire:click="deleteOrder({{ $order->id }})"
                            class="w-8 h-8 rounded-lg bg-red-50 text-red-400 hover:bg-red-500 hover:text-white transition-all flex items-center justify-center">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3">
                    <!-- Item List -->
                    <div class="p-6 lg:col-span-2 border-r border-slate-50">
                        <p class="text-[10px] font-black uppercase text-slate-400 tracking-widest mb-4">Daftar Barang
                        </p>
                        <div class="space-y-4">
                            @foreach ($order->items as $item)
                                <div class="flex items-center gap-4">
                                    <img src="{{ $item->image ? asset('storage/' . $item->image) : 'https://ui-avatars.com/api/?name=' . urlencode($item->name) }}"
                                        class="w-12 h-12 rounded-xl object-cover border border-slate-100">
                                    <div class="flex-1">
                                        <h5 class="text-xs font-bold text-slate-800">{{ $item->name }}</h5>
                                        <p class="text-[10px] text-slate-400 font-bold uppercase">
                                            {{ $item->quantity }}x • Rp {{ number_format($item->price, 0, ',', '.') }}
                                        </p>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-xs font-black text-slate-900 text-blue-500">Rp
                                            {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-6 pt-6 border-t border-slate-50 flex justify-between items-center">
                            <p class="text-[10px] font-black uppercase text-slate-400">Total Pembayaran</p>
                            <p class="text-lg font-black text-slate-900">Rp
                                {{ number_format($order->total_amount, 0, ',', '.') }}</p>
                        </div>
                    </div>

                    <!-- Shipping & Actions -->
                    <div class="p-6 bg-slate-50/10">
                        <p class="text-[10px] font-black uppercase text-slate-400 tracking-widest mb-4">Informasi
                            Pengiriman</p>
                        <div class="space-y-3 mb-6">
                            <div>
                                <p class="text-xs font-black text-slate-900 uppercase">{{ $order->recipient_name }}</p>
                                <p class="text-[10px] font-bold text-blue-500">{{ $order->phone_number }}</p>
                            </div>
                            <p class="text-[11px] text-slate-600 leading-relaxed italic">
                                {{ $order->full_address }}, {{ $order->village }}, {{ $order->district }},
                                {{ $order->city }}, {{ $order->province }} ({{ $order->postal_code }})
                            </p>
                        </div>

                        <!-- Update Status Buttons -->
                        <p class="text-[10px] font-black uppercase text-slate-400 tracking-widest mb-3">Update Status
                        </p>
                        <div class="grid grid-cols-2 gap-2">
                            <button wire:click="updateStatus({{ $order->id }}, 'processing')"
                                class="px-3 py-2 rounded-xl bg-blue-50 text-blue-600 text-[9px] font-black uppercase hover:bg-blue-600 hover:text-white transition-all">Proses</button>
                            <button wire:click="updateStatus({{ $order->id }}, 'completed')"
                                class="px-3 py-2 rounded-xl bg-emerald-50 text-emerald-600 text-[9px] font-black uppercase hover:bg-emerald-600 hover:text-white transition-all">Selesai</button>
                            <button wire:click="updateStatus({{ $order->id }}, 'cancelled')"
                                class="col-span-2 px-3 py-2 rounded-xl bg-slate-100 text-slate-400 text-[9px] font-black uppercase hover:bg-red-500 hover:text-white transition-all">Batalkan
                                Pesanan</button>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="py-20 text-center bg-white rounded-[2rem] border border-dashed border-slate-200">
                <p class="text-[10px] font-black uppercase text-slate-300 tracking-widest italic">Tidak ada pesanan
                    ditemukan</p>
            </div>
        @endforelse
    </div>

    <div class="mt-8">
        {{ $orders->links() }}
    </div>
</div>
