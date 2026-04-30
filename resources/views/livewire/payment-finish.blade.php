<div class="min-h-[80vh] flex items-center justify-center px-6">
    <div class="max-w-md w-full text-center space-y-8">

        <!-- Ilustrasi Sukses -->
        <div class="relative mx-auto w-32 h-32">
            <!-- Ring Dekorasi -->
            <div class="absolute inset-0 bg-emerald-50 rounded-[2.5rem] rotate-12 animate-pulse"></div>
            <div class="absolute inset-0 bg-blue-50 rounded-[2.5rem] -rotate-12 animate-pulse"
                style="animation-delay: 0.5s"></div>

            <!-- Ikon Utama -->
            <div
                class="relative bg-white border border-slate-100 w-full h-full rounded-[2.5rem] shadow-xl shadow-slate-200/50 flex items-center justify-center">
                <svg class="w-12 h-12 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                </svg>
            </div>

            <!-- Partikel Melayang -->
            <div class="absolute -top-2 -right-2 w-4 h-4 bg-amber-400 rounded-full animate-bounce"></div>
            <div class="absolute -bottom-4 -left-2 w-6 h-6 bg-blue-600 rounded-2xl animate-bounce"
                style="animation-delay: 0.2s"></div>
        </div>

        <!-- Teks Konfirmasi -->
        <div class="space-y-3">
            <h1 class="text-3xl font-black text-slate-900 uppercase tracking-tighter italic">
                Pembayaran <span class="text-blue-600">Berhasil!</span>
            </h1>
            <p class="text-slate-400 text-xs font-bold uppercase tracking-widest leading-loose">
                Pesanan <span class="text-slate-900">#{{ $order->order_number }}</span> sedang kami siapkan.<br>
                Terima kasih telah mempercayai Cenari Store.
            </p>
        </div>

        <!-- Kartu Detail Ringkas -->
        <div class="bg-white border border-slate-100 rounded-[2rem] p-6 shadow-sm divide-y divide-slate-50">
            <div class="pb-4 flex justify-between items-center">
                <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Total Bayar</span>
                <span class="text-sm font-black text-slate-900 font-mono">Rp
                    {{ number_format($order->total_amount, 0, ',', '.') }}</span>
            </div>
            <div class="pt-4 flex justify-between items-center">
                <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Metode</span>
                <span class="text-[10px] font-black text-blue-600 uppercase">Midtrans Instant</span>
            </div>
        </div>

        <!-- Tombol Aksi -->
        <div class="flex flex-col gap-3">
            <a href="{{ route('order.index') }}" wire:navigate
                class="w-full bg-slate-900 text-white py-5 rounded-[2rem] text-[11px] font-black uppercase tracking-[0.2em] transition-all hover:bg-blue-600 shadow-lg shadow-slate-200 active:scale-95">
                Pantau Pesanan
            </a>

            <a href="/" wire:navigate
                class="w-full bg-transparent text-slate-400 py-3 rounded-[2rem] text-[10px] font-black uppercase tracking-widest hover:text-slate-900 transition-colors">
                Kembali ke Beranda
            </a>
        </div>
    </div>
</div>
