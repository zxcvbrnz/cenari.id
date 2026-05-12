<div class="max-w-4xl mx-auto p-6 space-y-8">
    <!-- Header: Tombol Kembali & Judul -->
    <div class="flex items-center justify-between">
        <div class="flex items-center gap-4">
            <a href="{{ route('order.index') }}" wire:navigate
                class="w-10 h-10 flex items-center justify-center rounded-2xl bg-white border border-slate-100 text-slate-400 hover:text-slate-900 transition-all shadow-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <div>
                <div class="flex items-center gap-2">
                    <h1 class="text-xl font-black text-slate-900 uppercase tracking-tighter">Detail Pesanan</h1>
                    <!-- Badge Metode Pengiriman -->
                    <span
                        class="text-[8px] font-black px-2 py-0.5 rounded-md uppercase {{ $order->shipping_method === 'cod' ? 'bg-orange-100 text-orange-600' : 'bg-slate-100 text-slate-600' }}">
                        {{ $order->shipping_method ?? 'Send' }}
                    </span>
                </div>
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">ID:
                    #{{ $order->order_number }}</p>
            </div>
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
        <span
            class="text-[10px] font-black uppercase tracking-[0.2em] px-5 py-2.5 rounded-2xl border {{ $colorClass }}">
            {{ $order->status }}
        </span>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

        <!-- KOLOM KIRI: Daftar Produk (Span 2) -->
        <div class="md:col-span-2 space-y-6">
            <div class="bg-white border border-slate-100 rounded-[2.5rem] p-8 shadow-sm">
                <h2 class="text-[11px] font-black text-slate-900 uppercase tracking-widest mb-6">Produk yang Dibeli</h2>

                <div class="space-y-6">
                    @foreach ($order->items as $item)
                        <div class="flex items-center gap-5 group">
                            <div class="relative">
                                @if ($item->image)
                                    <img src="{{ asset('storage/' . $item->image) }}"
                                        class="w-20 h-20 rounded-[2rem] object-cover bg-slate-50 border border-slate-50 shadow-sm group-hover:scale-105 transition-transform">
                                @else
                                    <div
                                        class="w-20 h-20 rounded-[2rem] bg-slate-50 flex items-center justify-center border border-slate-50">
                                        <svg class="w-8 h-8 text-slate-200" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                        </svg>
                                    </div>
                                @endif
                            </div>

                            <div class="flex-1 min-w-0">
                                <h4 class="text-xs font-black text-slate-800 uppercase tracking-tight truncate">
                                    {{ $item->name }}</h4>
                                <p class="text-[10px] text-slate-400 font-bold mt-1">
                                    {{ $item->quantity }} x <span class="text-slate-600">Rp
                                        {{ number_format($item->price, 0, ',', '.') }}</span>
                                </p>
                            </div>

                            <div class="text-right">
                                <p class="text-xs font-black text-slate-900">
                                    Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Ringkasan Harga -->
                <div class="mt-10 pt-8 border-t border-slate-50 space-y-3">
                    <div class="flex justify-between items-center text-[11px] font-bold text-slate-400 uppercase">
                        <span>Subtotal</span>
                        <span class="text-slate-600 italic">Rp
                            {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between items-center text-[11px] font-bold text-slate-400 uppercase">
                        <span>Biaya Pengiriman</span>
                        <span class="text-slate-600 italic">Rp 0</span>
                    </div>
                    <div class="flex justify-between items-center pt-3 mt-3 border-t border-dashed border-slate-100">
                        <span class="text-[11px] font-black text-slate-900 uppercase">Total Bayar</span>
                        <span class="text-lg font-black text-blue-600 uppercase tracking-tighter">
                            Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- KOLOM KANAN: Alamat & Waktu -->
        <div class="space-y-6">
            <!-- Info Pengiriman (COD atau Alamat) -->
            <div
                class="{{ $order->shipping_method === 'cod' ? 'bg-orange-600' : 'bg-slate-900' }} text-white rounded-[2.5rem] p-8 shadow-xl shadow-slate-200">
                <div class="w-10 h-10 bg-white/10 rounded-xl flex items-center justify-center mb-6">
                    @if ($order->shipping_method === 'cod')
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5" />
                        </svg>
                    @else
                        <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        </svg>
                    @endif
                </div>

                <h3
                    class="text-[10px] font-black uppercase tracking-[0.2em] {{ $order->shipping_method === 'cod' ? 'text-orange-200' : 'text-blue-400' }} mb-4">
                    {{ $order->shipping_method === 'cod' ? 'Instruksi Pengambilan' : 'Alamat Pengiriman' }}
                </h3>

                <div class="space-y-4">
                    @if ($order->shipping_method === 'cod')
                        <div class="space-y-2">
                            <p class="text-xs font-black uppercase tracking-tight">Ambil di Toko</p>
                            <p class="text-[10px] leading-relaxed text-white/80 font-medium">
                                Pesanan Anda dipilih menggunakan metode COD/Ambil di Toko. Silahkan datang ke lokasi
                                kami setelah status pesanan berubah menjadi <span
                                    class="font-bold text-white">"Processing"</span> atau <span
                                    class="font-bold text-white">"Ready"</span>.
                            </p>
                        </div>
                    @else
                        <div>
                            <p class="text-xs font-black uppercase">{{ $order->recipient_name }}</p>
                            <p class="text-[10px] font-bold text-white/50">{{ $order->phone_number }}</p>
                        </div>

                        <p class="text-[11px] leading-relaxed text-white/70 font-medium italic">
                            {{ $order->full_address }}<br>
                            {{ $order->village }}, {{ $order->district }}<br>
                            {{ $order->city }}, {{ $order->province }}<br>
                            {{ $order->postal_code }}
                        </p>
                    @endif
                </div>
            </div>

            <!-- Info Waktu -->
            <div class="bg-white border border-slate-100 rounded-[2.5rem] p-8">
                <h3 class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-6">Log Transaksi</h3>

                <div class="space-y-6">
                    <div class="flex gap-4">
                        <div class="w-1.5 h-1.5 rounded-full bg-blue-600 mt-1.5 ring-4 ring-blue-50"></div>
                        <div>
                            <p class="text-[10px] font-black text-slate-800 uppercase">Pesanan Dibuat</p>
                            <p class="text-[9px] font-bold text-slate-400">
                                {{ $order->created_at->translatedFormat('d M Y, H:i') }}</p>
                        </div>
                    </div>

                    @if ($order->status == 'completed')
                        <div class="flex gap-4">
                            <div class="w-1.5 h-1.5 rounded-full bg-emerald-500 mt-1.5 ring-4 ring-emerald-50"></div>
                            <div>
                                <p class="text-[10px] font-black text-slate-800 uppercase">Pesanan Selesai</p>
                                <p class="text-[9px] font-bold text-slate-400">
                                    {{ $order->updated_at->translatedFormat('d M Y, H:i') }}</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Tombol Aksi Pembayaran -->
            @if ($order->status == 'pending' && $order->shipping_method !== 'cod')
                <button wire:click="$dispatch('open-midtrans', [{ snap_token: '{{ $order->snap_token }}' }])"
                    class="w-full bg-blue-600 hover:bg-slate-900 text-white py-5 rounded-[2rem] text-[11px] font-black uppercase tracking-[0.2em] transition-all shadow-lg shadow-blue-200 active:scale-95">
                    Bayar Sekarang
                </button>
            @endif
        </div>

    </div>
</div>

<script type="text/javascript" src="https://app.midtrans.com/snap/snap.js"
    data-client-key="{{ config('midtrans.client_key') }}"></script>

<script type="text/javascript">
    window.addEventListener('open-midtrans', event => {
        const snapToken = event.detail[0].snap_token;

        window.snap.pay(snapToken, {
            onSuccess: function(result) {
                window.location.href = "{{ route('order.index') }}";
            },
            onPending: function(result) {
                location.reload();
            },
            onError: function(result) {
                Swal.fire({
                    title: 'Gagal!',
                    text: 'Terjadi kesalahan pada pembayaran.',
                    icon: 'error'
                });
            }
        });
    });
</script>
