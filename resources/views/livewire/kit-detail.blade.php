<div class="min-h-screen bg-[#FDFDFD] py-12 px-6">
    <div class="max-w-7xl mx-auto">
        <a href="/shop" wire:navigate
            class="inline-flex items-center gap-2 text-slate-400 hover:text-blue-600 transition-colors mb-10 group">
            <svg class="w-5 h-5 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path d="M15 19l-7-7 7-7" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            <span class="text-xs font-black uppercase tracking-widest">Kembali ke Store</span>
        </a>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-16">
            <div class="lg:col-span-7">
                <div class="sticky top-10 space-y-6">
                    <div
                        class="aspect-video rounded-[3rem] overflow-hidden bg-slate-50 border border-slate-100 shadow-inner">
                        <img src="{{ $activeImage }}" class="w-full h-full object-cover transition-all duration-500">
                    </div>
                    <div class="grid grid-cols-4 gap-4">
                        @foreach ($kit->images as $img)
                            <button wire:click="$set('activeImage', '{{ $img->image }}')"
                                class="aspect-square rounded-2xl overflow-hidden border-2 transition-all {{ $activeImage == $img->image ? 'border-blue-600' : 'border-transparent' }}">
                                <img src="{{ $img->image }}" class="w-full h-full object-cover">
                            </button>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="lg:col-span-5">
                <div class="mb-8">
                    <span
                        class="px-4 py-1.5 bg-blue-50 text-blue-600 text-[10px] font-black uppercase tracking-widest rounded-full">Robotik
                        Kit Bundle</span>
                    <h1 class="text-4xl font-black text-slate-900 mt-4 tracking-tighter">{{ $kit->name }}</h1>
                    <p class="text-slate-500 mt-6 leading-relaxed">{{ $kit->description }}</p>
                </div>

                <div class="bg-white border border-slate-100 rounded-[2.5rem] p-8 shadow-sm mb-8">
                    <div class="space-y-4 mb-8">
                        <div class="flex justify-between text-sm">
                            <span class="text-slate-400">Harga Komponen ({{ $kit->items->count() }} jenis)</span>
                            <span class="font-bold text-slate-700">Rp
                                {{ number_format($itemsCost, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-slate-400">Modul & E-Book</span>
                            <span class="font-bold text-slate-700">Rp
                                {{ number_format($modulsCost, 0, ',', '.') }}</span>
                        </div>
                        @if ($kit->discount > 0)
                            <div class="flex justify-between text-sm text-red-500 font-bold">
                                <span>Potongan Bundle</span>
                                <span>- Rp {{ number_format($kit->discount, 0, ',', '.') }}</span>
                            </div>
                        @endif
                        <div class="pt-4 border-t border-slate-50 flex justify-between items-end">
                            <span class="text-xs font-black uppercase text-slate-400">Harga Paket</span>
                            <span class="text-3xl font-black text-blue-600">Rp
                                {{ number_format($totalPrice, 0, ',', '.') }}</span>
                        </div>
                    </div>
                    <button
                        class="w-full bg-slate-900 text-white py-5 rounded-2xl font-black uppercase tracking-widest text-xs hover:bg-blue-600 transition-all shadow-xl shadow-slate-200">
                        Beli Kit Sekarang
                    </button>
                </div>

                <div class="space-y-4">
                    <h3 class="text-sm font-black uppercase tracking-widest text-slate-900">Isi Dalam Paket:</h3>
                    <div class="grid grid-cols-1 gap-3">
                        @foreach ($kit->items as $item)
                            <div
                                class="flex items-center justify-between p-4 bg-slate-50 rounded-2xl border border-slate-100/50">
                                <div class="flex items-center gap-4">
                                    <span
                                        class="w-8 h-8 flex items-center justify-center bg-white rounded-lg text-xs font-black text-blue-600 shadow-sm">{{ $item->pivot->quantity }}x</span>
                                    <span class="text-sm font-bold text-slate-700">{{ $item->name }}</span>
                                </div>
                                <span class="text-xs text-slate-400 italic">Included</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
