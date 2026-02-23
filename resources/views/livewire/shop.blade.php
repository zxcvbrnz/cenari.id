<div class="min-h-screen bg-[#FDFDFD] py-12 px-6">
    <div class="max-w-7xl mx-auto">

        <div class="flex flex-col md:flex-row justify-between items-center mb-12 gap-6">
            <div>
                <h1 class="text-4xl font-black text-slate-900 tracking-tighter italic">CENARI<span
                        class="text-blue-600">STORE</span></h1>
                <p class="text-slate-400 text-sm">Temukan komponen dan kit robotik terbaik.</p>
            </div>

            <div class="flex flex-col md:flex-row gap-4 w-full md:w-auto">
                <input wire:model.live="search" type="text" placeholder="Cari produk..."
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
                        class="bg-white rounded-[2.5rem] border border-slate-100 p-4 hover:shadow-2xl hover:-translate-y-2 transition-all duration-500">
                        <div class="relative h-56 rounded-[2rem] overflow-hidden mb-6 shadow-inner bg-slate-50">
                            <img src="{{ $kit->images->first()->image ?? 'https://placehold.co/600x400' }}"
                                class="w-full h-full object-cover">
                            <div
                                class="absolute top-4 left-4 bg-red-500 text-white text-[10px] font-black px-3 py-1 rounded-lg">
                                SAVE Rp {{ number_format($kit->discount, 0, ',', '.') }}</div>
                        </div>

                        <div class="px-4">
                            <h3 class="text-xl font-bold text-slate-900 mb-2">{{ $kit->name }}</h3>
                            <div class="space-y-1 mb-6">
                                <div class="flex justify-between text-[11px] font-medium text-slate-400 italic">
                                    <span>Components Cost</span>
                                    <span>Rp {{ number_format($itemsPrice, 0, ',', '.') }}</span>
                                </div>
                                <div class="flex justify-between text-[11px] font-medium text-slate-400 italic">
                                    <span>Moduls & E-Book</span>
                                    <span>+ Rp {{ number_format($modulsPrice, 0, ',', '.') }}</span>
                                </div>
                            </div>

                            <div class="flex items-center justify-between pt-4 border-t border-slate-50">
                                <div>
                                    <p class="text-[9px] font-black text-slate-300 uppercase">Package Price</p>
                                    <p class="text-xl font-black text-blue-600">Rp
                                        {{ number_format($totalPrice, 0, ',', '.') }}</p>
                                </div>
                                <button
                                    class="bg-slate-900 text-white px-6 py-3 rounded-2xl text-[10px] font-black uppercase hover:bg-blue-600 transition-all">Buy
                                    Kit</button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mt-8">{{ $kits->links() }}</div>
        @else
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-6">
                @foreach ($items as $item)
                    <div
                        class="bg-white p-4 rounded-[2rem] border border-slate-100 hover:shadow-xl transition-all group">
                        <div class="aspect-square rounded-2xl bg-slate-50 mb-4 overflow-hidden">
                            <img src="{{ $item->images->first()->image ?? 'https://placehold.co/400x400' }}"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform">
                        </div>
                        <h4 class="text-xs font-bold text-slate-800 truncate">{{ $item->name }}</h4>
                        <p class="text-blue-600 font-black text-sm mb-3">Rp
                            {{ number_format($item->price, 0, ',', '.') }}</p>
                        <button
                            class="w-full py-2 rounded-xl bg-slate-900 text-white text-[9px] font-black uppercase opacity-0 group-hover:opacity-100 transition-opacity">Add</button>
                    </div>
                @endforeach
            </div>
            <div class="mt-8">{{ $items->links() }}</div>
        @endif

    </div>
</div>
