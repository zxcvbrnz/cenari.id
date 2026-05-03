<div class="p-8 min-h-screen font-sans text-slate-900">
    <div class="max-w-7xl mx-auto">

        <div class="flex justify-between items-center mb-10">
            <div class="flex bg-white p-1.5 rounded-2xl shadow-sm border border-slate-200">
                <button wire:click="setTab('kit')"
                    class="px-8 py-3 rounded-xl font-black text-[10px] uppercase tracking-widest transition-all {{ $activeTab == 'kit' ? 'bg-slate-900 text-white shadow-lg' : 'text-slate-400' }}">Paket
                    Kit</button>
                <button wire:click="setTab('item')"
                    class="px-8 py-3 rounded-xl font-black text-[10px] uppercase tracking-widest transition-all {{ $activeTab == 'item' ? 'bg-slate-900 text-white shadow-lg' : 'text-slate-400' }}">Komponen</button>
            </div>
            @if ($view == 'index')
                <button wire:click="{{ $activeTab == 'kit' ? 'openKitCreate' : 'openItemCreate' }}"
                    class="bg-blue-600 text-white px-8 py-4 rounded-2xl font-black text-[10px] uppercase tracking-widest hover:bg-blue-700 transition-all shadow-xl shadow-blue-100">+
                    Tambah Baru</button>
            @endif
        </div>

        @if ($view == 'index')
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @if ($activeTab == 'kit')
                    @foreach ($kits as $k)
                        <div class="bg-white p-5 rounded-[2rem] border border-slate-100 shadow-sm">
                            @if ($k->images->first())
                                <img src="{{ asset('storage/' . $k->images->first()->filename) }}"
                                    class="w-full h-40 object-cover rounded-2xl mb-4">
                            @else
                                <div
                                    class="w-full h-40 bg-slate-50 rounded-2xl mb-4 flex items-center justify-center text-[10px] font-bold text-slate-300 italic uppercase">
                                    No Image</div>
                            @endif
                            <h4 class="font-black uppercase text-xs mb-3 italic">{{ $k->name }}</h4>
                            <div
                                class="flex flex-col gap-1 mb-4 bg-slate-50 p-3 rounded-xl text-[9px] font-black italic">
                                <span class="text-blue-600">KIT: Rp
                                    {{ number_format($k->items->sum('price'), 0, ',', '.') }}</span>
                                <span class="text-orange-600">DISC: {{ $k->discount }}%</span>
                            </div>
                            <div class="flex gap-2">
                                <button wire:click="openKitEdit({{ $k->id }})"
                                    class="flex-1 bg-slate-900 text-white py-2.5 rounded-xl font-bold text-[9px] uppercase tracking-widest">Edit</button>
                                <button onclick="confirm('Hapus?') || event.stopImmediatePropagation()"
                                    wire:click="deleteKit({{ $k->id }})"
                                    class="px-3 bg-red-50 text-red-500 rounded-xl hover:bg-red-500 hover:text-white transition-all">🗑️</button>
                            </div>
                        </div>
                    @endforeach
                @else
                    @foreach ($all_items as $item)
                        <div class="bg-white p-4 rounded-[2rem] border border-slate-100 shadow-sm">
                            @if ($item->images->first())
                                <img src="{{ asset('storage/' . $item->images->first()->filename) }}"
                                    class="w-full h-32 object-cover rounded-2xl mb-3">
                            @else
                                <div
                                    class="w-full h-32 bg-slate-50 rounded-2xl mb-3 flex items-center justify-center text-[8px] font-bold text-slate-300 italic uppercase">
                                    No Image</div>
                            @endif
                            <h5 class="font-bold text-slate-700 text-[10px] truncate mb-1">{{ $item->name }}</h5>
                            <p class="text-[10px] font-black text-blue-500 mb-4 italic uppercase">Rp
                                {{ number_format($item->price, 0, ',', '.') }}</p>
                            <div class="flex gap-1">
                                <button wire:click="openItemEdit({{ $item->id }})"
                                    class="flex-1 bg-slate-100 text-slate-600 py-2 rounded-xl text-[8px] font-black uppercase hover:bg-slate-900 hover:text-white transition-all">Edit</button>
                                <button onclick="confirm('Hapus?') || event.stopImmediatePropagation()"
                                    wire:click="deleteItem({{ $item->id }})"
                                    class="px-2.5 bg-red-50 text-red-400 rounded-xl hover:bg-red-500 hover:text-white">×</button>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        @elseif($view == 'kit-form')
            <div class="max-w-4xl mx-auto">
                <div class="bg-white p-10 rounded-[3rem] shadow-2xl border border-slate-100">
                    <h2 class="text-xl font-black uppercase italic mb-8 tracking-tighter">
                        {{ $kit_id ? 'Edit Paket' : 'Paket Baru' }}</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="md:col-span-2">
                            <label class="text-[9px] font-black uppercase text-slate-400 ml-2">Nama Paket</label>
                            <input type="text" wire:model="k_name"
                                class="w-full border-slate-200 rounded-2xl p-4 font-bold focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="text-[9px] font-black uppercase text-slate-400 ml-2">Harga Pelatihan
                                (Rp)</label>
                            <input type="number" step="0.01" wire:model="k_pelatihan_price"
                                class="w-full border-slate-200 rounded-2xl p-4 font-bold text-green-600">
                        </div>
                        <div>
                            <label class="text-[9px] font-black uppercase text-slate-400 ml-2">Harga Private
                                (Rp)</label>
                            <input type="number" step="0.01" wire:model="k_private_price"
                                class="w-full border-slate-200 rounded-2xl p-4 font-bold text-orange-600">
                        </div>

                        <div>
                            <label class="text-[9px] font-black uppercase text-slate-400 ml-2">Diskon Hardware
                                (%)</label>
                            <input type="number" step="0.01" wire:model="k_discount"
                                class="w-full border-slate-200 rounded-2xl p-4 font-bold text-blue-600" placeholder="0">
                        </div>

                        <div class="md:col-span-2 bg-blue-50/50 p-6 rounded-[2rem] border border-blue-100">
                            <label class="text-[9px] font-black uppercase text-blue-600 block mb-4 italic">Modul
                                Pembelajaran</label>
                            <div class="flex items-start gap-4">
                                <label
                                    class="w-12 h-12 flex items-center justify-center bg-blue-600 text-white rounded-xl cursor-pointer relative overflow-hidden flex-shrink-0">
                                    <span class="text-xl font-bold">+</span>
                                    <input type="file" wire:model="modul_file" class="hidden">
                                    <div wire:loading wire:target="modul_file"
                                        class="absolute inset-0 bg-blue-600 flex items-center justify-center">
                                        <div
                                            class="w-4 h-4 border-2 border-white border-t-transparent animate-spin rounded-full">
                                        </div>
                                    </div>
                                </label>
                                <div class="flex flex-col gap-1 w-full">
                                    <input type="text" wire:model="modul_name" placeholder="Nama Modul..."
                                        class="text-[11px] font-black uppercase italic border-none bg-transparent p-0 focus:ring-0">
                                    @if ($modul_file)
                                        <span class="text-[9px] font-black text-green-500 italic uppercase">✓ Siap:
                                            {{ $modul_file->getClientOriginalName() }}</span>
                                    @elseif($existing_modul_file)
                                        <a href="{{ asset('storage/' . $existing_modul_file) }}" target="_blank"
                                            class="text-[9px] font-black text-blue-600 uppercase italic underline">{{ basename($existing_modul_file) }}</a>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="md:col-span-2">
                            <label class="text-[9px] font-black uppercase text-slate-400 ml-2 block mb-3 italic">Galeri
                                Foto Paket</label>
                            <div class="flex flex-wrap gap-3">
                                @if ($kit_id)
                                    @foreach (\App\Models\KitRobotic::find($kit_id)->images as $img)
                                        <div class="relative">
                                            <img src="{{ asset('storage/' . $img->filename) }}"
                                                class="w-20 h-20 object-cover rounded-2xl border-2 border-white shadow-md">
                                            <button wire:click="deleteImageKit({{ $img->id }})"
                                                class="absolute -top-2 -right-2 bg-red-500 text-white w-5 h-5 flex items-center justify-center rounded-full text-[10px]">×</button>
                                        </div>
                                    @endforeach
                                @endif
                                <label
                                    class="w-20 h-20 border-2 border-dashed border-slate-200 rounded-2xl flex items-center justify-center cursor-pointer relative transition-all hover:bg-slate-50">
                                    <span class="text-2xl text-slate-200">+</span>
                                    <input type="file" wire:model="new_images_kit" multiple class="hidden">
                                    <div wire:loading wire:target="new_images_kit"
                                        class="absolute inset-0 bg-white/80 flex items-center justify-center rounded-2xl">
                                        <div
                                            class="w-5 h-5 border-2 border-blue-500 border-t-transparent animate-spin rounded-full">
                                        </div>
                                    </div>
                                </label>
                                @foreach ($new_images_kit as $temp)
                                    <img src="{{ $temp->temporaryUrl() }}"
                                        class="w-20 h-20 object-cover rounded-2xl opacity-40">
                                @endforeach
                            </div>
                        </div>

                        <div class="md:col-span-2 border-t border-slate-100 pt-6">
                            <label class="text-[9px] font-black uppercase text-slate-400 ml-2 block mb-3 italic">Pilih
                                Komponen (Cari atau Pilih Rekomendasi)</label>
                            <div class="relative mb-4">
                                <input type="text" wire:model.live="searchItem"
                                    placeholder="Ketik untuk memfilter..."
                                    class="w-full border-slate-200 rounded-2xl p-4 font-bold text-xs bg-slate-50 focus:bg-white transition-all shadow-inner">
                                <div
                                    class="mt-2 flex flex-wrap gap-2 max-h-40 overflow-y-auto p-2 bg-slate-50 rounded-2xl border border-slate-100">
                                    @forelse($searchResults as $res)
                                        <button wire:click="addItem({{ $res->id }})"
                                            class="bg-white border border-slate-200 px-4 py-2 rounded-xl font-black text-[9px] uppercase italic hover:bg-blue-600 hover:text-white transition-all shadow-sm">
                                            + {{ $res->name }}
                                        </button>
                                    @empty
                                        <span class="text-[9px] font-bold text-slate-400 p-2">Semua komponen sudah
                                            terpilih atau tidak ditemukan.</span>
                                    @endforelse
                                </div>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                @foreach ($selectedItems as $idx => $si)
                                    <div
                                        class="flex justify-between items-center bg-slate-900 text-white p-4 rounded-2xl shadow-lg border-l-4 border-blue-500 animate-in slide-in-from-left gap-4">
                                        <div class="flex flex-col flex-1">
                                            <span
                                                class="text-[9px] font-black uppercase italic tracking-tighter truncate">{{ $si['name'] }}</span>
                                            <span class="text-[8px] text-slate-400">Harga Satuan: Rp
                                                {{ number_format($si['price'] ?? 0, 0, ',', '.') }}</span>
                                        </div>

                                        <div class="flex items-center gap-2 bg-slate-800 px-3 py-1 rounded-xl">
                                            <label class="text-[8px] font-bold text-slate-500 uppercase">Qty</label>
                                            <input type="number"
                                                wire:model.live="selectedItems.{{ $idx }}.quantity"
                                                min="1"
                                                class="w-12 bg-transparent border-none p-0 text-center text-[10px] font-black focus:ring-0">
                                        </div>

                                        <button wire:click="removeItem({{ $idx }})"
                                            class="text-red-400 font-black text-[9px] hover:scale-110 transition-transform">
                                            HAPUS
                                        </button>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="md:col-span-2 flex gap-4 mt-6">
                            <button wire:click="backToIndex"
                                class="flex-1 bg-slate-100 text-slate-400 py-5 rounded-[2rem] font-black text-[10px] uppercase">Batal</button>
                            <button wire:click="saveKit"
                                class="flex-[2] bg-blue-600 text-white py-5 rounded-[2rem] font-black text-[10px] uppercase shadow-xl relative overflow-hidden hover:bg-blue-700">
                                <span wire:loading.remove wire:target="saveKit">Simpan Paket Kit</span>
                                <div wire:loading wire:target="saveKit"
                                    class="w-4 h-4 border-2 border-white border-t-transparent animate-spin rounded-full mx-auto">
                                </div>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @elseif($view == 'item-form')
            <div class="max-w-2xl mx-auto">
                <div class="bg-white p-10 rounded-[3rem] shadow-2xl border border-slate-100">
                    <h2 class="text-xl font-black uppercase italic mb-8 tracking-tighter">Data Komponen</h2>
                    <div class="space-y-6">
                        <div>
                            <label class="text-[9px] font-black uppercase text-slate-400 ml-2">Nama Komponen</label>
                            <input type="text" wire:model="i_name"
                                class="w-full border-slate-200 rounded-2xl p-4 font-bold">
                        </div>
                        <div>
                            <label class="text-[9px] font-black uppercase text-slate-400 ml-2">Harga (Rp)</label>
                            <input type="number" step="0.01" wire:model="i_price"
                                class="w-full border-slate-200 rounded-2xl p-4 font-bold text-blue-600">
                        </div>
                        <div>
                            <label class="text-[9px] font-black uppercase text-slate-400 ml-2">Deskripsi</label>
                            <input type="text" wire:model="i_description"
                                class="w-full border-slate-200 rounded-2xl p-4 text-slate-600">
                        </div>
                        <div>
                            <label class="text-[9px] font-black uppercase text-slate-400 ml-2 block mb-3 italic">Foto
                                Komponen</label>
                            <div class="flex flex-wrap gap-3">
                                @if ($item_id)
                                    @foreach (\App\Models\Item::find($item_id)->images as $img)
                                        <div class="relative">
                                            <img src="{{ asset('storage/' . $img->filename) }}"
                                                class="w-20 h-20 object-cover rounded-2xl border-2 border-white shadow-md">
                                            <button wire:click="deleteImageItem({{ $img->id }})"
                                                class="absolute -top-2 -right-2 bg-red-500 text-white w-5 h-5 flex items-center justify-center rounded-full text-[10px]">×</button>
                                        </div>
                                    @endforeach
                                @endif
                                <label
                                    class="w-20 h-20 border-2 border-dashed border-slate-200 rounded-2xl flex items-center justify-center cursor-pointer relative transition-all overflow-hidden hover:bg-slate-50">
                                    <span class="text-2xl text-slate-200">+</span>
                                    <input type="file" wire:model="new_images_item" multiple class="hidden">
                                    <div wire:loading wire:target="new_images_item"
                                        class="absolute inset-0 bg-white/80 flex items-center justify-center">
                                        <div
                                            class="w-4 h-4 border-2 border-slate-900 border-t-transparent animate-spin rounded-full">
                                        </div>
                                    </div>
                                </label>
                                @foreach ($new_images_item as $tmp)
                                    <img src="{{ $tmp->temporaryUrl() }}"
                                        class="w-20 h-20 object-cover rounded-2xl opacity-40">
                                @endforeach
                            </div>
                        </div>
                        <div class="flex gap-4 pt-6">
                            <button wire:click="backToIndex"
                                class="flex-1 bg-slate-50 text-slate-400 py-5 rounded-[2rem] font-black text-[10px] uppercase">Kembali</button>
                            <button wire:click="saveItem"
                                class="flex-[2] bg-slate-900 text-white py-5 rounded-[2rem] font-black text-[10px] uppercase shadow-xl relative overflow-hidden">
                                <span wire:loading.remove wire:target="saveItem">Simpan Data</span>
                                <div wire:loading wire:target="saveItem"
                                    class="w-4 h-4 border-2 border-white border-t-transparent animate-spin rounded-full mx-auto">
                                </div>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
