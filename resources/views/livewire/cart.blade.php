<div class="fixed bottom-28 right-10 z-[110]">
    <div x-data="{ open: false }" class="relative">
        <button @click="open = !open"
            class="bg-slate-900 text-white px-6 py-4 rounded-[2rem] shadow-2xl hover:bg-blue-600 transition-all flex items-center gap-4 group">
            <div class="relative">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                </svg>
                @if (count($cart) > 0)
                    <span
                        class="absolute -top-2 -right-2 bg-blue-500 text-[9px] font-black w-5 h-5 flex items-center justify-center rounded-full border-2 border-slate-900 animate-bounce">
                        {{ count($cart) }}
                    </span>
                @endif
            </div>
            <span class="text-[11px] font-black uppercase tracking-widest hidden md:block">Keranjang</span>
        </button>

        <div x-show="open" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4 scale-95"
            x-transition:leave="transition ease-in duration-200" @click.away="open = false"
            class="absolute bottom-20 right-0 w-80 bg-white border border-slate-100 rounded-[2.5rem] shadow-[0_35px_60px_-15px_rgba(0,0,0,0.3)] p-6 overflow-hidden">

            <div class="flex items-center justify-between mb-6">
                <h3 class="text-xs font-black text-slate-900 uppercase tracking-widest">Pesanan Anda</h3>
                <button @click="open = false" class="text-slate-400 hover:text-slate-600">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <div class="max-h-[23vh] overflow-y-auto space-y-4 pr-2 custom-scrollbar">
                @forelse($cart as $key => $details)
                    <div
                        class="flex items-center gap-4 group/item bg-slate-50/50 p-2 rounded-2xl border border-transparent hover:border-slate-100 transition-all">
                        <div class="w-12 h-12 bg-white rounded-xl overflow-hidden shrink-0 border border-slate-100">
                            <img src="{{ asset('storage/' . $details['image']) ?? 'https://placehold.co/100x100' }}"
                                class="w-full h-full object-cover">
                        </div>

                        <div class="flex-1 min-w-0">
                            <p class="text-[10px] font-black text-slate-800 truncate uppercase tracking-tighter">
                                {{ $details['name'] }}
                            </p>
                            <p class="text-[10px] font-bold text-blue-600">
                                Rp {{ number_format($details['price'], 0, ',', '.') }}
                            </p>
                        </div>

                        <div class="flex flex-col items-end gap-1">
                            <div
                                class="flex items-center gap-1 bg-white p-1 rounded-lg border border-slate-100 shadow-sm">
                                <button
                                    wire:click="updateQuantity('{{ $key }}', {{ $details['quantity'] - 1 }})"
                                    class="w-4 h-4 flex items-center justify-center text-slate-400 hover:text-blue-600">-</button>

                                <input type="number" value="{{ $details['quantity'] }}"
                                    wire:change="updateQuantity('{{ $key }}', $event.target.value)"
                                    class="w-6 bg-transparent border-none p-0 text-center text-[9px] font-black text-slate-800 focus:ring-0 [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none">

                                <button
                                    wire:click="updateQuantity('{{ $key }}', {{ $details['quantity'] + 1 }})"
                                    class="w-4 h-4 flex items-center justify-center text-slate-400 hover:text-blue-600">+</button>
                            </div>

                            <button wire:click="removeFromCart('{{ $key }}')"
                                class="text-[8px] font-black text-rose-400 uppercase tracking-widest hover:text-rose-600">
                                Hapus
                            </button>
                        </div>
                    </div>
                @empty
                    <div class="py-10 text-center">
                        <div class="mb-3 flex justify-center text-slate-200">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                            </svg>
                        </div>
                        <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest italic">Keranjang
                            Kosong</p>
                    </div>
                @endforelse
            </div>

            @if (count($cart) > 0)
                <div class="mt-2 pt-2 border-t border-slate-100 space-y-4">
                    <!-- PEMILIHAN METODE -->
                    <div class="space-y-2">
                        <label class="text-[9px] font-black uppercase text-slate-400 tracking-widest px-1">Metode
                            Pengiriman:</label>
                        <div class="grid grid-cols-2 gap-2">
                            <button wire:click="$set('shipping_method', 'cod')"
                                class="py-2 px-3 rounded-xl text-[9px] font-black uppercase border transition-all {{ $shipping_method === 'cod' ? 'bg-slate-900 text-white border-slate-900' : 'bg-slate-50 text-slate-400 border-slate-100' }}">
                                COD
                            </button>
                            <button
                                @if ($isSendAvailable) wire:click="$set('shipping_method', 'send')" @endif
                                class="py-2 px-3 rounded-xl text-[9px] font-black uppercase border transition-all {{ $shipping_method === 'send' ? 'bg-slate-900 text-white border-slate-900' : 'bg-slate-50 text-slate-400 border-slate-100' }} {{ !$isSendAvailable ? 'opacity-50 cursor-not-allowed' : '' }}">
                                Send @if (!$isSendAvailable)
                                    (Off)
                                @endif
                            </button>
                        </div>
                    </div>

                    <!-- ALAMAT (Hanya muncul jika metode 'send') -->
                    @if ($shipping_method === 'send')
                        <div class="space-y-2">
                            <label class="text-[9px] font-black uppercase text-slate-400 tracking-widest px-1">Kirim
                                Ke:</label>

                            <div x-data="{ open: false }" class="relative">
                                <button @click="open = !open" type="button"
                                    class="w-full bg-slate-50 border border-slate-100 p-3 rounded-2xl flex items-center justify-between hover:bg-white hover:border-blue-300 transition-all group">

                                    <div class="flex items-center gap-3 text-left overflow-hidden">
                                        <div
                                            class="shrink-0 w-8 h-8 bg-white rounded-lg flex items-center justify-center text-blue-600 shadow-sm">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            </svg>
                                        </div>
                                        <div class="truncate">
                                            @php
                                                $selected = collect($addresses)->firstWhere('id', $selectedAddressId);
                                            @endphp

                                            <div class="flex items-center gap-2 mb-0.5">
                                                <p class="text-[10px] font-black text-slate-800 uppercase truncate">
                                                    {{ $selected ? $selected->recipient_name : 'Pilih Alamat' }}
                                                </p>
                                                @if ($selected)
                                                    <span
                                                        class="text-[9px] font-bold text-slate-400 italic">({{ $selected->phone_number }})</span>
                                                @endif
                                            </div>

                                            <p class="text-[9px] text-slate-500 truncate leading-tight">
                                                @if ($selected)
                                                    <span
                                                        class="font-bold text-slate-700">{{ $selected->full_address }}</span>
                                                    <span class="mx-1 text-slate-300">•</span>
                                                    {{ $selected->village }}, {{ $selected->district }},
                                                    {{ $selected->city }}
                                                @else
                                                    Klik untuk memilih lokasi pengiriman
                                                @endif
                                            </p>
                                        </div>
                                    </div>

                                    <svg class="w-3 h-3 text-slate-300 transition-transform"
                                        :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                            d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>

                                <div x-show="open" @click.away="open = false"
                                    x-transition:enter="transition ease-out duration-200"
                                    x-transition:enter-start="opacity-0 scale-95 translate-y-2"
                                    class="absolute z-[60] bottom-full mb-2 w-full bg-white border border-slate-100 rounded-3xl shadow-2xl overflow-hidden">

                                    <div class="max-h-48 overflow-y-auto p-2 space-y-1 custom-scrollbar">
                                        @forelse($addresses as $addr)
                                            <button type="button" @click="open = false"
                                                wire:click="$set('selectedAddressId', {{ $addr->id }})"
                                                class="w-full p-3 rounded-xl flex items-center gap-3 hover:bg-blue-50 transition-all text-left border {{ $selectedAddressId == $addr->id ? 'bg-blue-50 border-blue-200' : 'bg-white border-slate-100' }}">

                                                <div class="shrink-0">
                                                    <div
                                                        class="w-2 h-2 rounded-full {{ $selectedAddressId == $addr->id ? 'bg-blue-600' : 'bg-slate-200' }}">
                                                    </div>
                                                </div>

                                                <div class="min-w-0 flex-1">
                                                    <div class="flex items-center gap-2 mb-0.5">
                                                        <span
                                                            class="text-[10px] font-black text-slate-900 uppercase truncate">{{ $addr->recipient_name }}</span>
                                                        <span
                                                            class="text-[9px] font-bold text-slate-400 italic">({{ $addr->phone_number }})</span>
                                                    </div>

                                                    <div
                                                        class="text-[9px] text-slate-500 font-medium truncate leading-tight">
                                                        <span
                                                            class="font-bold text-slate-700">{{ $addr->full_address }}</span>
                                                        <span class="mx-1 text-slate-300">•</span>
                                                        {{ $addr->village }}, {{ $addr->district }},
                                                        {{ $addr->city }},
                                                        {{ $addr->province }}
                                                        @if ($addr->postal_code)
                                                            <span
                                                                class="ml-1 text-slate-400">[{{ $addr->postal_code }}]</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </button>
                                        @empty
                                            <p
                                                class="p-4 text-center text-[9px] text-slate-400 font-bold uppercase italic">
                                                Alamat belum ada</p>
                                        @endforelse
                                    </div>

                                    <div class="p-2 border-t border-slate-50 bg-slate-50/50">
                                        <a href="{{ route('profile.address') }}" wire:navigate
                                            class="flex items-center justify-center gap-2 w-full p-2.5 rounded-xl border-2 border-dashed border-slate-200 text-slate-400 hover:border-blue-400 hover:text-blue-600 hover:bg-white transition-all">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 4v16m8-8H4" />
                                            </svg>
                                            <span class="text-[9px] font-black uppercase tracking-widest">Tambah
                                                Alamat</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            @endif

            @if (count($cart) > 0)
                @php
                    $total = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);
                @endphp
                <div class="pt-6 border-t border-slate-50">
                    <div class="flex justify-between items-end mb-6">
                        <div>
                            <span class="text-[9px] font-black text-slate-300 uppercase tracking-[0.2em]">Total
                                Estimasi</span>
                            <p class="text-lg font-black text-slate-900 leading-none">Rp
                                {{ number_format($total, 0, ',', '.') }}</p>
                        </div>
                    </div>

                    @if ($shipping_method === 'send' && !$selectedAddressId)
                        <div class="mb-3 flex items-center gap-2 text-rose-500 animate-pulse">
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span class="text-[9px] font-black uppercase tracking-tighter">Silahkan pilih alamat
                                terlebih dahulu</span>
                        </div>
                    @endif

                    <button {{ $shipping_method === 'send' && !$selectedAddressId ? 'disabled' : '' }}
                        wire:click="processCheckout"
                        class="w-full py-5 rounded-[1.5rem] text-[11px] font-black uppercase tracking-[0.2em] transition-all shadow-xl active:scale-95
                            {{ $shipping_method === 'send' && !$selectedAddressId
                                ? 'bg-slate-200 text-slate-400 cursor-not-allowed shadow-none'
                                : 'bg-[#3B82F6] text-white hover:bg-slate-900 shadow-blue-500/20' }}">
                        Lanjutkan Checkout
                    </button>
                </div>
            @endif
        </div>
    </div>
</div>
