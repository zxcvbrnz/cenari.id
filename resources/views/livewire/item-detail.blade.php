<div class="min-h-screen bg-[#FDFDFD] py-12 px-6">
    <div class="max-w-5xl mx-auto">
        <a href="/shop" wire:navigate
            class="inline-flex items-center gap-2 text-slate-400 hover:text-blue-600 transition-colors mb-10 group">
            <svg class="w-5 h-5 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path d="M15 19l-7-7 7-7" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            <span class="text-xs font-black uppercase tracking-widest">Kembali</span>
        </a>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-16 items-start">
            <div class="space-y-6">
                <div class="aspect-square rounded-[2.5rem] overflow-hidden bg-white border border-slate-100 shadow-sm">
                    <img src="{{ $activeImage }}" class="w-full h-full object-cover">
                </div>
                <div class="flex gap-4 overflow-x-auto pb-2">
                    @foreach ($item->images as $img)
                        <button wire:click="$set('activeImage', '{{ $img->image }}')"
                            class="w-20 h-20 rounded-xl overflow-hidden border-2 shrink-0 {{ $activeImage == $img->image ? 'border-blue-600' : 'border-transparent' }}">
                            <img src="{{ $img->image }}" class="w-full h-full object-cover">
                        </button>
                    @endforeach
                </div>
            </div>

            <div class="pt-4">
                <h1 class="text-3xl font-black text-slate-900 tracking-tight mb-2">{{ $item->name }}</h1>
                <p class="text-2xl font-black text-blue-600 mb-8">Rp {{ number_format($item->price, 0, ',', '.') }}</p>

                <div class="prose prose-slate prose-sm mb-10">
                    <h4 class="text-xs font-black uppercase text-slate-400 tracking-widest mb-4">Deskripsi Produk</h4>
                    <p class="text-slate-500 leading-relaxed">
                        {{ $item->description ?? 'Tidak ada deskripsi untuk produk ini.' }}</p>
                </div>

                <div class="p-6 bg-slate-50 rounded-3xl border border-slate-100 flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center shadow-sm">
                            <svg class="w-6 h-6 text-slate-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"
                                    stroke-width="1.5" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-[10px] font-black uppercase text-slate-400">Status Stok</p>
                            <p class="text-sm font-bold text-emerald-500">Tersedia / Ready</p>
                        </div>
                    </div>
                    <button
                        class="bg-blue-600 text-white px-8 py-4 rounded-2xl font-black uppercase text-[10px] tracking-widest hover:bg-slate-900 transition-all">
                        Tambah ke Keranjang
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
