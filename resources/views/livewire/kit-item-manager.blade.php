<div class="p-6 max-w-7xl mx-auto">
    @if (session()->has('message'))
        <div class="mb-4 p-4 bg-emerald-100 text-emerald-800 rounded-xl font-medium border border-emerald-200">
            {{ session('message') }}
        </div>
    @endif

    {{-- Navigation Header --}}
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-slate-800">Manajemen Produk & Modul</h2>
        <div class="space-x-2">
            @if ($view !== 'list')
                <button wire:click="setView('list')"
                    class="px-4 py-2 bg-slate-200 hover:bg-slate-300 text-slate-700 rounded-xl font-semibold transition">
                    &larr; Kembali
                </button>
            @else
                <button wire:click="setView('kit-form')"
                    class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-semibold transition">
                    + Kit
                </button>
                <button wire:click="setView('item-form')"
                    class="px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl font-semibold transition">
                    + Item
                </button>
                <button wire:click="setView('souvenir-form')"
                    class="px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white rounded-xl font-semibold transition">
                    + Souvenir
                </button>
            @endif
        </div>
    </div>

    @if ($view === 'list')
        {{-- Search Input Global --}}
        <div class="mb-6 bg-white p-4 rounded-2xl border border-slate-200 shadow-sm flex items-center gap-3">
            <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
            <input type="text" wire:model.live.debounce.300ms="search"
                placeholder="Cari nama atau deskripsi kit, item, atau souvenir..."
                class="w-full border-none focus:outline-none focus:ring-0 text-slate-700 placeholder-slate-400">
            @if ($search)
                <button wire:click="$set('search', '')"
                    class="text-xs bg-slate-100 text-slate-500 px-3 py-1.5 rounded-lg font-medium hover:bg-slate-200">Reset</button>
            @endif
        </div>

        {{-- TABLE SOUVENIR --}}
        <div class="mb-10 bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
            <h3 class="text-lg font-bold mb-4 text-purple-700 flex items-center gap-2">
                <span>Daftar Souvenir</span>
            </h3>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b bg-slate-50 text-slate-600 text-sm">
                            <th class="p-3">Gambar</th>
                            <th class="p-3">Nama Souvenir</th>
                            <th class="p-3">Harga</th>
                            <th class="p-3">Stok</th>
                            <th class="p-3 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($souvenirs as $souvenir)
                            <tr class="hover:bg-slate-50">
                                <td class="p-3">
                                    <div class="flex space-x-1">
                                        @forelse($souvenir->images as $img)
                                            <img src="{{ asset('storage/' . $img->image_path) }}"
                                                class="w-10 h-10 object-cover rounded-lg border">
                                        @empty
                                            <span class="text-xs text-slate-400">No Image</span>
                                        @endforelse
                                    </div>
                                </td>
                                <td class="p-3 font-semibold text-slate-800">{{ $souvenir->name }}</td>
                                <td class="p-3 text-purple-600 font-bold">Rp
                                    {{ number_format($souvenir->price, 0, ',', '.') }}</td>
                                <td class="p-3 font-medium">{{ $souvenir->stock }}</td>
                                <td class="p-3 text-right space-x-2">
                                    <button wire:click="openSouvenirEdit({{ $souvenir->id }})"
                                        class="text-blue-600 hover:underline font-semibold">Edit</button>
                                    <button wire:click="deleteSouvenir({{ $souvenir->id }})"
                                        onclick="confirm('Hapus souvenir ini?') || event.stopImmediatePropagation()"
                                        class="text-red-600 hover:underline font-semibold">Hapus</button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="p-4 text-center text-slate-400">Data souvenir tidak ditemukan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-4">{{ $souvenirs->links() }}</div>
        </div>

        {{-- TABLE KIT ROBOTIC --}}
        <div class="mb-10 bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
            <h3 class="text-lg font-bold mb-4 text-blue-700 flex items-center gap-2">
                <span>Daftar Kit Robotic</span>
            </h3>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b bg-slate-50 text-slate-600 text-sm">
                            <th class="p-3">Gambar</th>
                            <th class="p-3">Nama Kit</th>
                            <th class="p-3">Pelatihan</th>
                            <th class="p-3">Private</th>
                            <th class="p-3">Modul</th>
                            <th class="p-3 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($kits as $kit)
                            <tr class="hover:bg-slate-50">
                                <td class="p-3">
                                    <div class="flex space-x-1">
                                        @forelse($kit->images as $img)
                                            <img src="{{ asset('storage/' . $img->image_path) }}"
                                                class="w-10 h-10 object-cover rounded-lg border">
                                        @empty
                                            <span class="text-xs text-slate-400">No Image</span>
                                        @endforelse
                                    </div>
                                </td>
                                <td class="p-3 font-semibold text-slate-800">{{ $kit->name }}</td>
                                <td class="p-3 text-green-600 font-bold">Rp
                                    {{ number_format($kit->pelatihan_price, 0, ',', '.') }}</td>
                                <td class="p-3 text-orange-600 font-bold">Rp
                                    {{ number_format($kit->private_price, 0, ',', '.') }}</td>
                                <td class="p-3 font-medium text-slate-600">
                                    {{ $kit->moduls ? $kit->moduls->name : '-' }}</td>
                                <td class="p-3 text-right space-x-2">
                                    <button wire:click="openKitEdit({{ $kit->id }})"
                                        class="text-blue-600 hover:underline font-semibold">Edit</button>
                                    <button wire:click="deleteKit({{ $kit->id }})"
                                        onclick="confirm('Hapus kit beserta modulnya?') || event.stopImmediatePropagation()"
                                        class="text-red-600 hover:underline font-semibold">Hapus</button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="p-4 text-center text-slate-400">Data kit tidak ditemukan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-4">{{ $kits->links() }}</div>
        </div>

        {{-- TABLE ITEM --}}
        <div class="mb-10 bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
            <h3 class="text-lg font-bold mb-4 text-emerald-700 flex items-center gap-2">
                <span>Daftar Item / Komponen</span>
            </h3>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b bg-slate-50 text-slate-600 text-sm">
                            <th class="p-3">Gambar</th>
                            <th class="p-3">Nama Item</th>
                            <th class="p-3">Harga</th>
                            <th class="p-3">Stok</th>
                            <th class="p-3 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($items as $item)
                            <tr class="hover:bg-slate-50">
                                <td class="p-3">
                                    <div class="flex space-x-1">
                                        @forelse($item->images as $img)
                                            <img src="{{ asset('storage/' . $img->image_path) }}"
                                                class="w-10 h-10 object-cover rounded-lg border">
                                        @empty
                                            <span class="text-xs text-slate-400">No Image</span>
                                        @endforelse
                                    </div>
                                </td>
                                <td class="p-3 font-semibold text-slate-800">{{ $item->name }}</td>
                                <td class="p-3 text-emerald-600 font-bold">Rp
                                    {{ number_format($item->price, 0, ',', '.') }}</td>
                                <td class="p-3 font-medium">{{ $item->stock }}</td>
                                <td class="p-3 text-right space-x-2">
                                    <button wire:click="openItemEdit({{ $item->id }})"
                                        class="text-blue-600 hover:underline font-semibold">Edit</button>
                                    <button wire:click="deleteItem({{ $item->id }})"
                                        onclick="confirm('Hapus item ini?') || event.stopImmediatePropagation()"
                                        class="text-red-600 hover:underline font-semibold">Hapus</button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="p-4 text-center text-slate-400">Data item tidak ditemukan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-4">{{ $items->links() }}</div>
        </div>
    @elseif ($view === 'souvenir-form')
        {{-- FORM SOUVENIR --}}
        <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm max-w-2xl mx-auto">
            <h3 class="text-xl font-bold mb-4 text-purple-700">
                {{ $souvenir_id ? 'Edit Souvenir' : 'Tambah Souvenir' }}</h3>
            <form wire:submit.prevent="saveSouvenir" class="space-y-4">
                <div>
                    <label class="block font-semibold mb-1 text-slate-700">Nama Souvenir</label>
                    <input type="text" wire:model="s_name" class="w-full border-slate-200 rounded-xl p-3 border">
                    @error('s_name')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block font-semibold mb-1 text-slate-700">Harga (Rp)</label>
                        <input type="number" step="1" wire:model="s_price"
                            class="w-full border-slate-200 rounded-xl p-3 border font-bold text-purple-600">
                        @error('s_price')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label class="block font-semibold mb-1 text-slate-700">Stok</label>
                        <input type="number" wire:model="s_stock"
                            class="w-full border-slate-200 rounded-xl p-3 border">
                        @error('s_stock')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div>
                    <label class="block font-semibold mb-1 text-slate-700">Deskripsi</label>
                    <textarea wire:model="s_description" rows="3" class="w-full border-slate-200 rounded-xl p-3 border"></textarea>
                </div>

                <div>
                    <label class="block font-semibold mb-1 text-slate-700">Upload Gambar</label>
                    <input type="file" wire:model="s_new_images" multiple class="w-full p-2 border rounded-xl">
                    @if ($souvenir_id)
                        @php $existingSouvenir = \App\Models\Souvenir::with('images')->find($souvenir_id); @endphp
                        @if ($existingSouvenir && $existingSouvenir->images->count() > 0)
                            <div class="flex space-x-2 mt-3">
                                @foreach ($existingSouvenir->images as $img)
                                    <div class="relative group">
                                        <img src="{{ asset('storage/' . $img->image_path) }}"
                                            class="w-16 h-16 object-cover rounded-lg border">
                                        <button type="button" wire:click="deleteSouvenirImage({{ $img->id }})"
                                            class="absolute -top-2 -right-2 bg-red-600 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs shadow">
                                            &times;
                                        </button>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    @endif
                </div>

                <div class="pt-4 flex justify-end space-x-2 border-t">
                    <button type="button" wire:click="setView('list')"
                        class="px-5 py-2.5 bg-slate-200 text-slate-700 rounded-xl font-semibold">Batal</button>
                    <button type="submit"
                        class="px-5 py-2.5 bg-purple-600 text-white rounded-xl font-semibold hover:bg-purple-700">Simpan
                        Souvenir</button>
                </div>
            </form>
        </div>
    @elseif ($view === 'item-form')
        {{-- FORM ITEM --}}
        <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm max-w-2xl mx-auto">
            <h3 class="text-xl font-bold mb-4 text-emerald-700">{{ $item_id ? 'Edit Item' : 'Tambah Item' }}</h3>
            <form wire:submit.prevent="saveItem" class="space-y-4">
                <div>
                    <label class="block font-semibold mb-1 text-slate-700">Nama Item / Komponen</label>
                    <input type="text" wire:model="i_name" class="w-full border-slate-200 rounded-xl p-3 border">
                    @error('i_name')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block font-semibold mb-1 text-slate-700">Harga (Rp)</label>
                        <input type="number" step="1" wire:model="i_price"
                            class="w-full border-slate-200 rounded-xl p-3 border font-bold text-emerald-600">
                        @error('i_price')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label class="block font-semibold mb-1 text-slate-700">Stok</label>
                        <input type="number" wire:model="i_stock"
                            class="w-full border-slate-200 rounded-xl p-3 border">
                        @error('i_stock')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div>
                    <label class="block font-semibold mb-1 text-slate-700">Deskripsi</label>
                    <textarea wire:model="i_description" rows="3" class="w-full border-slate-200 rounded-xl p-3 border"></textarea>
                </div>

                <div>
                    <label class="block font-semibold mb-1 text-slate-700">Upload Gambar</label>
                    <input type="file" wire:model="i_new_images" multiple class="w-full p-2 border rounded-xl">
                    @if ($item_id)
                        @php $existingItem = \App\Models\Item::with('images')->find($item_id); @endphp
                        @if ($existingItem && $existingItem->images->count() > 0)
                            <div class="flex space-x-2 mt-3">
                                @foreach ($existingItem->images as $img)
                                    <div class="relative group">
                                        <img src="{{ asset('storage/' . $img->image_path) }}"
                                            class="w-16 h-16 object-cover rounded-lg border">
                                        <button type="button" wire:click="deleteItemImage({{ $img->id }})"
                                            class="absolute -top-2 -right-2 bg-red-600 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs shadow">
                                            &times;
                                        </button>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    @endif
                </div>

                <div class="pt-4 flex justify-end space-x-2 border-t">
                    <button type="button" wire:click="setView('list')"
                        class="px-5 py-2.5 bg-slate-200 text-slate-700 rounded-xl font-semibold">Batal</button>
                    <button type="submit"
                        class="px-5 py-2.5 bg-emerald-600 text-white rounded-xl font-semibold hover:bg-emerald-700">Simpan
                        Item</button>
                </div>
            </form>
        </div>
    @elseif ($view === 'kit-form')
        {{-- FORM KIT --}}
        <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm max-w-4xl mx-auto">
            <h3 class="text-xl font-bold mb-4 text-blue-700">{{ $kit_id ? 'Edit Kit Robotic' : 'Tambah Kit Robotic' }}
            </h3>
            <form wire:submit.prevent="saveKit" class="space-y-6">

                {{-- Data Utama Kit --}}
                <div class="space-y-4">
                    <div>
                        <label class="block font-semibold mb-1 text-slate-700">Nama Kit Robotic</label>
                        <input type="text" wire:model="k_name"
                            class="w-full border-slate-200 rounded-xl p-3 border">
                        @error('k_name')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="grid grid-cols-3 gap-4">
                        <div>
                            <label class="block font-semibold mb-1 text-slate-700">Harga Pelatihan (Rp)</label>
                            <input type="number" step="1" wire:model="k_pelatihan_price"
                                class="w-full border-slate-200 rounded-xl p-3 border font-bold text-green-600">
                        </div>
                        <div>
                            <label class="block font-semibold mb-1 text-slate-700">Harga Private (Rp)</label>
                            <input type="number" step="1" wire:model="k_private_price"
                                class="w-full border-slate-200 rounded-xl p-3 border font-bold text-orange-600">
                        </div>
                        <div>
                            <label class="block font-semibold mb-1 text-slate-700">Diskon (%)</label>
                            <input type="number" wire:model="k_discount"
                                class="w-full border-slate-200 rounded-xl p-3 border">
                        </div>
                    </div>

                    <div>
                        <label class="block font-semibold mb-1 text-slate-700">Deskripsi Kit</label>
                        <textarea wire:model="k_description" rows="3" class="w-full border-slate-200 rounded-xl p-3 border"></textarea>
                    </div>
                </div>

                {{-- Pilih Item / Komponen Pendukung --}}
                <div class="border-t pt-4">
                    <h4 class="font-bold text-slate-800 mb-2">Pilih Item Komponen ke Kit</h4>
                    <div class="flex gap-2 mb-3">
                        <select id="itemSelect" class="w-full border-slate-200 rounded-xl p-3 border">
                            <option value="">-- Pilih Item --</option>
                            @foreach ($allItems as $optItem)
                                <option value="{{ $optItem->id }}">{{ $optItem->name }} (Rp
                                    {{ number_format($optItem->price, 0, ',', '.') }})</option>
                            @endforeach
                        </select>
                        <button type="button"
                            onclick="const val = document.getElementById('itemSelect').value; if(val) @this.addItemToKit(val);"
                            class="px-4 py-2 bg-slate-800 text-white rounded-xl font-semibold">
                            Tambah
                        </button>
                    </div>

                    @if (!empty($selectedItems))
                        <div class="bg-slate-50 p-3 rounded-xl space-y-2 border">
                            @foreach ($selectedItems as $index => $item)
                                <div class="flex items-center justify-between bg-white p-2.5 rounded-lg border">
                                    <span class="font-medium text-slate-700">{{ $item['name'] }}</span>
                                    <div class="flex items-center gap-3">
                                        <input type="number" min="1"
                                            wire:model="selectedItems.{{ $index }}.quantity"
                                            class="w-20 p-1 border rounded text-center">
                                        <button type="button" wire:click="removeItemFromKit({{ $index }})"
                                            class="text-red-500 font-bold hover:underline">Hapus</button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                {{-- Modul Pembelajaran --}}
                <div class="border-t pt-4 space-y-3">
                    <h4 class="font-bold text-slate-800">Modul Pembelajaran (Opsional)</h4>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold mb-1 text-slate-700">Nama Modul</label>
                            <input type="text" wire:model="modul_name"
                                class="w-full border-slate-200 rounded-xl p-3 border">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold mb-1 text-slate-700">Harga Modul (Rp)</label>
                            <input type="number" step="1" wire:model="modul_price"
                                class="w-full border-slate-200 rounded-xl p-3 border">
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold mb-1 text-slate-700">File Modul
                            (PDF/DOCX/ZIP)</label>
                        <input type="file" wire:model="modul_file" class="w-full p-2 border rounded-xl">
                        @if ($existing_modul_file)
                            <p class="text-xs text-slate-500 mt-1">File saat ini: <a
                                    href="{{ asset('storage/' . $existing_modul_file) }}" target="_blank"
                                    class="text-blue-600 underline">Lihat Modul</a></p>
                        @endif
                    </div>
                </div>

                {{-- Gambar Kit --}}
                <div class="border-t pt-4">
                    <label class="block font-semibold mb-1 text-slate-700">Upload Gambar Kit</label>
                    <input type="file" wire:model="k_new_images" multiple class="w-full p-2 border rounded-xl">
                    @if ($kit_id)
                        @php $existingKit = \App\Models\KitRobotic::with('images')->find($kit_id); @endphp
                        @if ($existingKit && $existingKit->images->count() > 0)
                            <div class="flex space-x-2 mt-3">
                                @foreach ($existingKit->images as $img)
                                    <div class="relative group">
                                        <img src="{{ asset('storage/' . $img->image_path) }}"
                                            class="w-16 h-16 object-cover rounded-lg border">
                                        <button type="button" wire:click="deleteKitImage({{ $img->id }})"
                                            class="absolute -top-2 -right-2 bg-red-600 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs shadow">
                                            &times;
                                        </button>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    @endif
                </div>

                <div class="pt-4 flex justify-end space-x-2 border-t">
                    <button type="button" wire:click="setView('list')"
                        class="px-5 py-2.5 bg-slate-200 text-slate-700 rounded-xl font-semibold">Batal</button>
                    <button type="submit"
                        class="px-5 py-2.5 bg-blue-600 text-white rounded-xl font-semibold hover:bg-blue-700">Simpan
                        Kit Robotic</button>
                </div>
            </form>
        </div>
    @endif
</div>
