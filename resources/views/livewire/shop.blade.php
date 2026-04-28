<div class="min-h-screen bg-[#FDFDFD] py-12 px-6 relative">
    <div class="max-w-7xl mx-auto">

        <div class="flex flex-col md:flex-row justify-between items-center mb-12 gap-6">
            <div>
                <h1 class="text-4xl font-black text-slate-900 tracking-tighter italic">CENARI<span
                        class="text-blue-600">STORE</span></h1>
                <p class="text-slate-400 text-sm">Temukan komponen dan kit robotik terbaik.</p>
            </div>

            <div class="flex flex-col md:flex-row gap-4 w-full md:w-auto">
                <input wire:model.live.debounce.300ms="search" type="text" placeholder="Cari produk..."
                    class="px-6 py-3 rounded-2xl border-none bg-slate-100 focus:ring-2 focus:ring-blue-500 w-full md:w-64 text-sm font-medium">

                <div class="bg-slate-100 p-1 rounded-2xl flex">
                    <button wire:click="$set('viewMode', 'kits')"
                        class="px-6 py-2 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all {{ $viewMode == 'kits' ? 'bg-white shadow-sm text-blue-600' : 'text-slate-400' }}">Kits</button>
                    <button wire:click="$set('viewMode', 'items')"
                        class="px-6 py-2 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all {{ $viewMode == 'items' ? 'bg-white shadow-sm text-blue-600' : 'text-slate-400' }}">Items</button>
                </div>
            </div>
        </div>

        @if ($viewMode == 'kits')
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($kits as $kit)
                    @php
                        $itemsPrice = $kit->items->sum(fn($i) => $i->price * $i->pivot->quantity);
                        $modulsPrice = $kit->moduls->sum('price');
                        $totalPrice = $itemsPrice + $modulsPrice - $kit->discount;
                    @endphp

                    <div
                        class="group bg-white rounded-[2.5rem] border border-slate-100 p-4 hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 relative overflow-hidden">
                        <a href="{{ route('kit.detail', $kit->id) }}" wire:navigate class="block">
                            <div class="relative h-56 rounded-[2rem] overflow-hidden mb-6 shadow-inner bg-slate-50">
                                <img src="{{ asset('storage/' . $kit->images->first()->filename) ?? 'https://placehold.co/600x400' }}"
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">

                                @if ($kit->discount > 0)
                                    <div
                                        class="absolute top-4 left-4 bg-red-500 text-white text-[10px] font-black px-3 py-1 rounded-lg">
                                        SAVE Rp {{ number_format($kit->discount, 0, ',', '.') }}
                                    </div>
                                @endif
                            </div>

                            <div class="px-4">
                                <h3
                                    class="text-xl font-bold text-slate-900 mb-2 group-hover:text-blue-600 transition-colors">
                                    {{ $kit->name }}</h3>
                                <div class="flex justify-between text-[11px] font-medium text-slate-400 italic mb-4">
                                    <span>Base Cost</span>
                                    <span>Rp {{ number_format($itemsPrice + $modulsPrice, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        </a>

                        <div class="relative px-4 pb-4 pt-4 border-t border-slate-50 h-[75px] flex items-center">
                            <div
                                class="flex justify-between items-center w-full transition-all duration-300 group-hover:opacity-0 group-hover:translate-y-2">
                                <div>
                                    <p class="text-[9px] font-black text-slate-300 uppercase leading-none">Special
                                        Bundle</p>
                                    <p class="text-xl font-black text-blue-600">Rp
                                        {{ number_format($totalPrice, 0, ',', '.') }}</p>
                                </div>
                            </div>

                            <button wire:click="addToCart({{ $kit->id }}, 'kit')"
                                class="absolute inset-x-0 bottom-0 top-0 bg-blue-600 text-white font-black text-[10px] uppercase tracking-[0.2em] opacity-0 translate-y-4 group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-300 flex items-center justify-center gap-2 hover:bg-slate-900 rounded-b-[2rem]">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 4v16m8-8H4" stroke-width="3" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                                Tambah ke Keranjang
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-6">
                @foreach ($items as $item)
                    <div
                        class="bg-white p-4 rounded-[2rem] border border-slate-100 hover:shadow-xl hover:-translate-y-1 transition-all group relative overflow-hidden">
                        <a href="{{ route('item.detail', $item->id) }}" wire:navigate class="block">
                            <div class="aspect-square rounded-2xl bg-slate-50 mb-4 overflow-hidden relative">
                                <img src="{{ asset('storage/' . $item->images->first()->filename) ?? 'https://placehold.co/400x400' }}"
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                            </div>
                            <h4
                                class="text-xs font-bold text-slate-800 truncate group-hover:text-blue-600 transition-colors">
                                {{ $item->name }}</h4>
                        </a>

                        <div class="relative mt-2 h-[35px] flex items-center">
                            <p
                                class="text-blue-600 font-black text-sm transition-all duration-300 group-hover:opacity-0 group-hover:-translate-y-2">
                                Rp {{ number_format($item->price, 0, ',', '.') }}
                            </p>

                            <button wire:click="addToCart({{ $item->id }}, 'item')"
                                class="absolute inset-0 bg-slate-900 text-white text-[9px] font-black uppercase tracking-widest opacity-0 translate-y-4 group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-300 rounded-xl flex items-center justify-center gap-1 hover:bg-blue-600">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 4v16m8-8H4" stroke-width="3" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                                ke Keranjang
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <livewire:cart />
</div>
