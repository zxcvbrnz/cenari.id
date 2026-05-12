<div class="max-w-5xl mx-auto p-6 space-y-8">
    <!-- Header Section -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-black text-slate-900 uppercase tracking-tighter">Pesanan Saya</h1>
            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest leading-loose">Pantau status pengiriman
                dan riwayat belanja Anda</p>
        </div>

        <!-- Tab Filter Status -->
        <div class="flex bg-slate-100 p-1.5 rounded-2xl overflow-x-auto no-scrollbar">
            @foreach (['all', 'pending', 'processing', 'completed', 'cancelled'] as $st)
                <button wire:click="setStatus('{{ $st }}')"
                    class="px-5 py-2 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all whitespace-nowrap
                    {{ $status === $st ? 'bg-white text-blue-600 shadow-sm' : 'text-slate-400 hover:text-slate-600' }}">
                    {{ $st }}
                </button>
            @endforeach
        </div>
    </div>

    <!-- Order List -->
    <div class="grid grid-cols-1 gap-6">
        @forelse($orders as $order)
            <div
                class="group bg-white border border-slate-100 rounded-[2.5rem] p-6 hover:shadow-2xl hover:shadow-slate-200/50 transition-all duration-500">
                <div class="flex flex-col md:flex-row gap-6">

                    <!-- Kiri: Info Order & Preview Item -->
                    <div class="flex-1 space-y-4">
                        <div class="flex items-center gap-3">
                            <span
                                class="text-[10px] font-black bg-blue-50 text-blue-600 px-3 py-1.5 rounded-xl uppercase tracking-wider">
                                #{{ $order->order_number }}
                            </span>
                            <!-- Label Metode Pengiriman -->
                            <span
                                class="text-[9px] font-black px-2 py-1 rounded-lg uppercase tracking-tighter {{ $order->shipping_method === 'cod' ? 'bg-orange-100 text-orange-600' : 'bg-slate-100 text-slate-600' }}">
                                {{ $order->shipping_method ?? 'Send' }}
                            </span>
                            <span class="text-[9px] font-bold text-slate-400 uppercase">
                                {{ $order->created_at->translatedFormat('d F Y • H:i') }}
                            </span>
                        </div>

                        <!-- Item Preview -->
                        <div class="flex items-center gap-4">
                            <div class="relative">
                                @if ($order->items->first()->image)
                                    <img src="{{ asset('storage/' . $order->items->first()->image) }}"
                                        class="w-16 h-16 rounded-[1.5rem] object-cover bg-slate-50 border border-slate-100">
                                @else
                                    <div
                                        class="w-16 h-16 rounded-[1.5rem] bg-slate-100 flex items-center justify-center">
                                        <svg class="w-6 h-6 text-slate-300" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                        </svg>
                                    </div>
                                @endif
                                @if ($order->items->count() > 1)
                                    <div
                                        class="absolute -bottom-1 -right-1 bg-slate-900 text-white text-[8px] font-black w-6 h-6 flex items-center justify-center rounded-full border-2 border-white">
                                        +{{ $order->items->count() - 1 }}
                                    </div>
                                @endif
                            </div>

                            <div class="min-w-0">
                                <h3 class="text-xs font-black text-slate-800 uppercase truncate">
                                    {{ $order->items->first()->name }}
                                </h3>

                                <div class="text-[10px] text-slate-500 font-medium leading-relaxed mt-1">
                                    @if ($order->shipping_method === 'cod')
                                        <p class="italic text-orange-600 font-bold uppercase tracking-tighter">
                                            Ambil di Toko (Cash on Delivery)
                                        </p>
                                    @else
                                        <p class="truncate">
                                            Dikirim ke: <span
                                                class="font-bold text-slate-700">{{ $order->recipient_name }}</span><br>
                                            {{ $order->city }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Kanan: Status & Total -->
                    <div
                        class="flex md:flex-col justify-between md:justify-center items-center md:items-end md:text-right gap-4 md:border-l border-slate-50 md:pl-8">
                        <div class="space-y-1">
                            <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Total Belanja</p>
                            <p class="text-sm font-black text-slate-900">
                                Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                            </p>
                        </div>

                        @php
                            $colors = [
                                'pending' => 'bg-amber-50 text-amber-600 border-amber-100',
                                'processing' => 'bg-blue-50 text-blue-600 border-blue-100',
                                'completed' => 'bg-emerald-50 text-emerald-600 border-emerald-100',
                                'cancelled' => 'bg-rose-50 text-rose-600 border-rose-100',
                            ];
                            $colorClass = $colors[$order->status] ?? 'bg-slate-50 text-slate-600 border-slate-100';
                        @endphp

                        <div class="flex items-center gap-3">
                            <span
                                class="text-[9px] font-black uppercase tracking-[0.2em] px-4 py-2 rounded-xl border {{ $colorClass }}">
                                {{ $order->status }}
                            </span>
                            <a href="{{ route('order.show', $order->id) }}"
                                class="w-9 h-9 flex items-center justify-center rounded-xl bg-slate-900 text-white hover:bg-blue-600 transition-all active:scale-90 shadow-lg shadow-slate-200">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        @empty
            <div class="py-24 text-center bg-slate-50 rounded-[3rem] border-2 border-dashed border-slate-200">
                <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-sm">
                    <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                </div>
                <p class="text-xs font-black text-slate-400 uppercase tracking-[0.3em]">Belum ada pesanan
                    {{ $status !== 'all' ? $status : '' }}</p>
                <a href="/shop"
                    class="inline-block mt-6 text-[10px] font-black text-blue-600 uppercase tracking-widest hover:underline">Mulai
                    Belanja Sekarang →</a>
            </div>
        @endforelse
    </div>
</div>
