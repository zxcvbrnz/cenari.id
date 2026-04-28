<div class="max-w-4xl mx-auto p-6 space-y-8">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-black text-slate-900 uppercase tracking-tighter">Buku Alamat</h1>
            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Kelola lokasi pengiriman pesanan Anda
            </p>
        </div>
        <button wire:click="$set('showForm', true)"
            class="bg-blue-600 hover:bg-slate-900 text-white px-6 py-3 rounded-2xl text-[11px] font-black uppercase tracking-widest transition-all shadow-lg shadow-blue-200 active:scale-95">
            Tambah Alamat
        </button>
    </div>

    @if ($showForm)
        <div
            class="bg-white border border-slate-100 rounded-[2.5rem] shadow-xl p-8 transition-all animate-in slide-in-from-top duration-500">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-xs font-black text-slate-900 uppercase tracking-widest">
                    {{ $isEditing ? 'Edit Alamat' : 'Alamat Baru' }}
                </h2>
                <button wire:click="resetFields" class="text-slate-400 hover:text-rose-500 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <form wire:submit.prevent="saveAddress" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-1">
                    <label class="text-[10px] font-black text-slate-400 uppercase ml-2">Nama Penerima</label>
                    <input wire:model="recipient_name" type="text"
                        class="w-full bg-slate-50 border-none rounded-2xl p-4 text-xs font-bold focus:ring-2 focus:ring-blue-500 transition-all"
                        placeholder="Contoh: Budi Santoso">
                    @error('recipient_name')
                        <span class="text-[10px] text-rose-500 font-bold ml-2 uppercase italic">{{ $message }}</span>
                    @enderror
                </div>

                <div class="space-y-1">
                    <label class="text-[10px] font-black text-slate-400 uppercase ml-2">Nomor WhatsApp</label>
                    <input wire:model="phone_number" type="text"
                        class="w-full bg-slate-50 border-none rounded-2xl p-4 text-xs font-bold focus:ring-2 focus:ring-blue-500 transition-all"
                        placeholder="0812xxxx">
                    @error('phone_number')
                        <span class="text-[10px] text-rose-500 font-bold ml-2 uppercase italic">{{ $message }}</span>
                    @enderror
                </div>

                <div class="md:col-span-2 space-y-1">
                    <label class="text-[10px] font-black text-slate-400 uppercase ml-2">Alamat Lengkap</label>
                    <textarea wire:model="full_address" rows="3"
                        class="w-full bg-slate-50 border-none rounded-2xl p-4 text-xs font-bold focus:ring-2 focus:ring-blue-500 transition-all"
                        placeholder="Nama jalan, nomor rumah, gedung, dll"></textarea>
                    @error('full_address')
                        <span class="text-[10px] text-rose-500 font-bold ml-2 uppercase italic">{{ $message }}</span>
                    @enderror
                </div>

                <div class="space-y-1">
                    <label class="text-[10px] font-black text-slate-400 uppercase ml-2">Provinsi</label>
                    <select wire:model.live="province_id"
                        class="w-full bg-slate-50 border-none rounded-2xl p-4 text-xs font-bold focus:ring-2 focus:ring-blue-500 outline-none transition-all">
                        <option value="">Pilih Provinsi</option>
                        @foreach ($provinces as $prov)
                            <option value="{{ $prov['id'] }}">{{ $prov['text'] }}</option>
                        @endforeach
                    </select>
                    @error('province')
                        <span class="text-[10px] text-rose-500 font-bold ml-2 uppercase italic">Provinsi wajib
                            dipilih</span>
                    @enderror
                </div>

                <div class="space-y-1">
                    <label class="text-[10px] font-black text-slate-400 uppercase ml-2">Kota/Kabupaten</label>
                    <select wire:model.live="city_id" {{ count($cities) == 0 ? 'disabled' : '' }}
                        class="w-full bg-slate-50 border-none rounded-2xl p-4 text-xs font-bold focus:ring-2 focus:ring-blue-500 outline-none transition-all disabled:opacity-30 disabled:cursor-not-allowed">
                        <option value="">Pilih Kota</option>
                        @foreach ($cities as $item)
                            <option value="{{ $item['id'] }}">{{ $item['text'] }}</option>
                        @endforeach
                    </select>
                    @error('city')
                        <span class="text-[10px] text-rose-500 font-bold ml-2 uppercase italic">Wajib dipilih</span>
                    @enderror
                </div>

                <div class="space-y-1">
                    <label class="text-[10px] font-black text-slate-400 uppercase ml-2">Kecamatan</label>
                    <select wire:model.live="district_id" {{ count($districts) == 0 ? 'disabled' : '' }}
                        class="w-full bg-slate-50 border-none rounded-2xl p-4 text-xs font-bold focus:ring-2 focus:ring-blue-500 outline-none transition-all disabled:opacity-30 disabled:cursor-not-allowed">
                        <option value="">Pilih Kecamatan</option>
                        @foreach ($districts as $item)
                            <option value="{{ $item['id'] }}">{{ $item['text'] }}</option>
                        @endforeach
                    </select>
                    @error('district')
                        <span class="text-[10px] text-rose-500 font-bold ml-2 uppercase italic">Wajib dipilih</span>
                    @enderror
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-1">
                        <label class="text-[10px] font-black text-slate-400 uppercase ml-2">Kelurahan</label>
                        <select wire:model.live="village_id" {{ count($villages) == 0 ? 'disabled' : '' }}
                            class="w-full bg-slate-50 border-none rounded-2xl p-4 text-xs font-bold focus:ring-2 focus:ring-blue-500 outline-none transition-all disabled:opacity-30 disabled:cursor-not-allowed">
                            <option value="">Pilih Kelurahan</option>
                            @foreach ($villages as $item)
                                <option value="{{ $item['id'] }}">{{ $item['text'] }}</option>
                            @endforeach
                        </select>
                        @error('village')
                            <span class="text-[10px] text-rose-500 font-bold ml-2 uppercase italic">Wajib dipilih</span>
                        @enderror
                    </div>
                    <div class="space-y-1">
                        <label class="text-[10px] font-black text-slate-400 uppercase ml-2">Kode Pos</label>
                        <input wire:model="postal_code" type="text"
                            class="w-full bg-slate-50 border-none rounded-2xl p-4 text-xs font-bold focus:ring-2 focus:ring-blue-500 transition-all">
                        @error('postal_code')
                            <span
                                class="text-[10px] text-rose-500 font-bold ml-2 uppercase italic">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="md:col-span-2 pt-4">
                    <button type="submit"
                        class="w-full bg-slate-900 text-white py-4 rounded-2xl text-[11px] font-black uppercase tracking-[0.2em] hover:bg-blue-600 transition-all shadow-xl active:scale-95">
                        {{ $isEditing ? 'Simpan Perubahan' : 'Simpan Alamat Sekarang' }}
                    </button>
                </div>
            </form>
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @forelse($addresses as $addr)
            <div
                class="group bg-white border border-slate-100 p-6 rounded-[2rem] hover:shadow-2xl hover:border-blue-100 transition-all duration-500 relative overflow-hidden">
                <div class="relative z-10 flex flex-col h-full">
                    <div class="flex justify-between items-start mb-4">
                        <div
                            class="w-10 h-10 bg-slate-50 rounded-xl flex items-center justify-center text-blue-600 group-hover:bg-blue-600 group-hover:text-white transition-all duration-500">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            </svg>
                        </div>
                        <div class="flex gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                            <button wire:click="edit({{ $addr->id }})"
                                class="p-2 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-600 hover:text-white transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                </svg>
                            </button>
                            <button onclick="confirm('Hapus alamat ini?') || event.stopImmediatePropagation()"
                                wire:click="delete({{ $addr->id }})"
                                class="p-2 bg-rose-50 text-rose-600 rounded-lg hover:bg-rose-600 hover:text-white transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <p class="text-xs font-black text-slate-900 uppercase mb-1">{{ $addr->recipient_name }}</p>
                    <p class="text-[11px] font-bold text-slate-400 mb-4">{{ $addr->phone_number }}</p>

                    <div class="mt-auto pt-4 border-t border-slate-50">
                        <p class="text-[10px] font-medium text-slate-500 leading-relaxed">
                            {{ $addr->full_address }}<br>
                            {{ $addr->village }}, {{ $addr->district }}, {{ $addr->city }}<br>
                            {{ $addr->province }} - {{ $addr->postal_code }}
                        </p>
                    </div>
                </div>
            </div>
        @empty
            <div
                class="md:col-span-2 py-20 text-center bg-slate-50 rounded-[3rem] border-2 border-dashed border-slate-200">
                <p class="text-xs font-black text-slate-400 uppercase tracking-[0.3em]">Belum ada alamat tersimpan</p>
            </div>
        @endforelse
    </div>
</div>
