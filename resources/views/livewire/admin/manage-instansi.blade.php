<div class="max-w-6xl mx-auto p-6" x-data="{ tab: @entangle('activeTab') }">

    @if ($view === 'list')
        <div
            class="flex justify-between items-center bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100 mb-8">
            <h1 class="text-3xl font-black italic uppercase tracking-tighter">Kelola <span
                    class="text-blue-600">Instansi</span></h1>
            <button wire:click="createNew" wire:loading.attr="disabled"
                class="bg-slate-900 text-white px-8 py-4 rounded-2xl font-black uppercase text-[10px] tracking-widest flex items-center gap-2">
                <span wire:loading.remove wire:target="createNew">+ Instansi Baru</span>
                <span wire:loading wire:target="createNew" class="animate-pulse">Memproses...</span>
            </button>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach ($instansis as $ins)
                <div class="bg-white p-6 rounded-[2.5rem] border border-slate-100 shadow-sm group">
                    <div class="w-12 h-12 rounded-xl mb-4" style="background-color: {{ $ins->colour }}"></div>
                    <h3 class="font-black italic uppercase text-lg">{{ $ins->name }}</h3>
                    <div class="mt-6 flex gap-2">
                        <button wire:click="editInstansi({{ $ins->id }})"
                            class="flex-1 bg-slate-900 text-white py-3 rounded-xl font-black uppercase text-[9px] tracking-widest hover:bg-blue-600 transition-colors">
                            Kelola
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    @if ($view === 'edit')
        <div class="space-y-6">
            <div
                class="flex items-center justify-between bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm">
                <div class="flex items-center gap-4">
                    <button wire:click="goBack"
                        class="p-3 bg-slate-50 rounded-xl text-slate-400 font-bold text-xs hover:bg-slate-100">←
                        Kembali</button>
                    <nav class="flex bg-slate-100 p-1.5 rounded-xl">
                        <button @click="tab = 'info'"
                            :class="tab === 'info' ? 'bg-white shadow text-slate-900' : 'text-slate-400'"
                            class="px-6 py-2 rounded-lg text-[10px] font-black uppercase tracking-widest transition-all">Identitas</button>
                        @if ($selectedInstansiId)
                            <button @click="tab = 'gallery'"
                                :class="tab === 'gallery' ? 'bg-white shadow text-slate-900' : 'text-slate-400'"
                                class="px-6 py-2 rounded-lg text-[10px] font-black uppercase tracking-widest transition-all">Galeri</button>
                            <button @click="tab = 'testimony'"
                                :class="tab === 'testimony' ? 'bg-white shadow text-slate-900' : 'text-slate-400'"
                                class="px-6 py-2 rounded-lg text-[10px] font-black uppercase tracking-widest transition-all">Ulasan</button>
                        @endif
                    </nav>
                </div>

                @if ($selectedInstansiId)
                    <button type="button"
                        x-on:click="
                            Swal.fire({
                                title: 'Hapus Instansi?',
                                text: 'Seluruh data galeri dan ulasan {{ $name }} akan ikut terhapus!',
                                icon: 'error',
                                showCancelButton: true,
                                confirmButtonColor: '#EF4444',
                                confirmButtonText: 'YA, HAPUS SEMUA',
                                customClass: { popup: 'rounded-[2.5rem]' }
                            }).then((result) => { if (result.isConfirmed) { $wire.deleteInstansi() } })
                        "
                        class="bg-red-50 text-red-500 px-5 py-3 rounded-xl font-black uppercase text-[9px] tracking-widest hover:bg-red-500 hover:text-white transition-all">
                        Hapus Instansi
                    </button>
                @endif
            </div>

            <div x-show="tab === 'info'"
                class="bg-white p-10 rounded-[3rem] shadow-sm border border-slate-100 animate-fade-in">
                <form wire:submit.prevent="saveInstansi" class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-4">
                        <div>
                            <label
                                class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2 block">Nama
                                Instansi</label>
                            <input type="text" wire:model="name"
                                class="w-full bg-slate-50 border-none rounded-xl p-4 font-bold focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label
                                class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2 block">Warna
                                Tema</label>
                            <div class="flex items-center gap-4 bg-slate-50 p-2 rounded-2xl border border-slate-100">
                                <input type="color" wire:model="colour"
                                    class="w-14 h-14 bg-transparent border-none cursor-pointer rounded-lg">
                                <span
                                    class="text-[10px] font-black uppercase text-slate-400 font-mono">{{ $colour }}</span>
                            </div>
                        </div>
                        <div class="space-y-3">
                            <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 block">Gambar
                                Instansi</label>
                            <div class="flex items-center gap-6 p-4 bg-slate-50 rounded-2xl border border-slate-100">
                                <div
                                    class="w-24 h-24 rounded-2xl overflow-hidden border-4 border-white shadow-lg bg-slate-100 flex items-center justify-center shrink-0">
                                    @if ($image)
                                        <img src="{{ $image->temporaryUrl() }}" class="w-full h-full object-cover">
                                    @elseif ($oldImage)
                                        <img src="{{ asset('storage/' . $oldImage) }}"
                                            class="w-full h-full object-cover">
                                    @else
                                        <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    @endif
                                </div>
                                <div class="flex-1">
                                    <input type="file" wire:model="image" id="logo_input" class="hidden">
                                    <label for="logo_input"
                                        class="inline-block bg-slate-900 text-white px-5 py-2.5 rounded-xl font-black uppercase text-[9px] tracking-widest cursor-pointer hover:bg-blue-600">Ganti
                                        Gambar</label>
                                    <div wire:loading wire:target="image"
                                        class="mt-2 text-[9px] font-black text-blue-600 animate-bounce uppercase">
                                        Mengunggah...</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2 block">Profil
                            / Deskripsi</label>
                        <textarea wire:model="profile" rows="6"
                            class="w-full bg-slate-50 border-none rounded-2xl p-4 italic font-medium focus:ring-2 focus:ring-blue-500"></textarea>
                    </div>
                    <button type="submit" wire:loading.attr="disabled"
                        class="md:col-span-2 bg-blue-600 text-white py-4 rounded-xl font-black uppercase text-xs tracking-widest shadow-lg shadow-blue-200 disabled:opacity-50">
                        <span wire:loading.remove wire:target="saveInstansi">Simpan Identitas</span>
                        <span wire:loading wire:target="saveInstansi">Menyimpan...</span>
                    </button>
                </form>
            </div>

            @if ($selectedInstansiId)
                <div x-show="tab === 'gallery'" class="space-y-8 animate-fade-in">
                    <div
                        class="bg-slate-900 p-8 rounded-[2.5rem] flex flex-col md:flex-row gap-4 items-end text-white shadow-xl">
                        <div class="flex-1 w-full">
                            <label
                                class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2 block">Pilih
                                Foto</label>
                            <input type="file" wire:model="galleryImage" class="text-xs">
                        </div>
                        <div class="flex-1 w-full">
                            <label
                                class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2 block">Keterangan</label>
                            <input type="text" wire:model="caption"
                                class="w-full bg-slate-800 border-none rounded-xl p-3 text-xs focus:ring-1 focus:ring-blue-500">
                        </div>
                        <button wire:click="addGallery" wire:loading.attr="disabled"
                            class="bg-white text-slate-900 px-8 py-3 rounded-xl font-black uppercase text-[10px] w-full md:w-auto disabled:opacity-50">
                            <span wire:loading.remove wire:target="addGallery, galleryImage">Unggah Foto</span>
                            <span wire:loading wire:target="addGallery, galleryImage">Proses...</span>
                        </button>
                    </div>

                    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                        @foreach ($currentInstansi->galleries as $gal)
                            <div
                                class="relative aspect-square group rounded-[2rem] overflow-hidden bg-slate-100 border border-slate-100">
                                <img src="{{ asset('storage/' . $gal->image) }}" class="w-full h-full object-cover">
                                <button type="button" wire:loading.attr="disabled"
                                    x-on:click="
                                        Swal.fire({
                                            title: 'Hapus foto?',
                                            icon: 'warning',
                                            showCancelButton: true,
                                            confirmButtonColor: '#EF4444',
                                            confirmButtonText: 'HAPUS',
                                            customClass: { popup: 'rounded-[2rem]' }
                                        }).then((result) => { if (result.isConfirmed) { $wire.deleteGallery({{ $gal->id }}) } })
                                    "
                                    class="absolute inset-0 bg-red-600/90 text-white font-black uppercase text-[10px] opacity-0 group-hover:opacity-100 transition-all flex items-center justify-center">
                                    <span wire:loading.remove wire:target="deleteGallery({{ $gal->id }})">Hapus
                                        Foto</span>
                                    <span wire:loading wire:target="deleteGallery({{ $gal->id }})"
                                        class="animate-spin text-lg">↻</span>
                                </button>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div x-show="tab === 'testimony'" class="grid grid-cols-1 lg:grid-cols-3 gap-8 animate-fade-in">
                    <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 h-fit space-y-4 shadow-sm">
                        <h4 class="font-black italic uppercase text-xs text-blue-600">Tambah Ulasan</h4>
                        <input type="text" wire:model="testiName" placeholder="Nama Siswa"
                            class="w-full bg-slate-50 border-none rounded-xl p-3 text-xs font-bold focus:ring-1 focus:ring-blue-500">
                        <input type="text" wire:model="testiRole" placeholder="Peran/Angkatan"
                            class="w-full bg-slate-50 border-none rounded-xl p-3 text-xs font-bold focus:ring-1 focus:ring-blue-500">
                        <textarea wire:model="testiContent" placeholder="Isi ulasan..."
                            class="w-full bg-slate-50 border-none rounded-xl p-3 text-xs italic focus:ring-1 focus:ring-blue-500"></textarea>

                        <div class="flex items-center justify-center gap-2 bg-slate-50 p-3 rounded-xl">
                            @for ($i = 1; $i <= 5; $i++)
                                <button type="button" wire:click="$set('testiRating', {{ $i }})"
                                    class="hover:scale-125 transition-transform">
                                    <svg class="w-6 h-6 {{ $testiRating >= $i ? 'text-yellow-400' : 'text-slate-200' }} fill-current"
                                        viewBox="0 0 20 20">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                </button>
                            @endfor
                        </div>

                        <button wire:click="addTestimoni" wire:loading.attr="disabled"
                            class="w-full bg-slate-900 text-white py-3 rounded-xl font-black uppercase text-[10px] tracking-widest shadow-lg disabled:opacity-50">
                            <span wire:loading.remove wire:target="addTestimoni">Simpan Ulasan</span>
                            <span wire:loading wire:target="addTestimoni">Menyimpan...</span>
                        </button>
                    </div>

                    <div class="lg:col-span-2 space-y-4">
                        @foreach ($currentInstansi->testimonis as $t)
                            <div
                                class="bg-white p-6 rounded-[2.5rem] border border-slate-100 flex justify-between items-center group hover:border-red-100 transition-all hover:shadow-md">
                                <div>
                                    <div class="flex gap-0.5 mb-1">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <svg class="w-3 h-3 {{ $t->rating >= $i ? 'text-yellow-400' : 'text-slate-200' }} fill-current"
                                                viewBox="0 0 20 20">
                                                <path
                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                        @endfor
                                    </div>
                                    <p class="font-black uppercase text-[10px] text-slate-900">{{ $t->name }}
                                        <span class="text-blue-500 italic ml-2">/ {{ $t->role }}</span>
                                    </p>
                                    <p class="text-sm text-slate-500 mt-2 font-medium italic">"{{ $t->content }}"
                                    </p>
                                </div>

                                <button type="button" wire:loading.attr="disabled"
                                    x-on:click="
                                        Swal.fire({
                                            title: 'Hapus Ulasan?',
                                            text: 'Ulasan {{ $t->name }} akan dihapus.',
                                            icon: 'warning',
                                            showCancelButton: true,
                                            confirmButtonColor: '#EF4444',
                                            confirmButtonText: 'YA, HAPUS',
                                            customClass: { popup: 'rounded-[2.5rem]' }
                                        }).then((result) => { if (result.isConfirmed) { $wire.deleteTesti({{ $t->id }}) } })
                                    "
                                    class="bg-red-50 text-red-500 px-4 py-2 rounded-xl font-black uppercase text-[8px] tracking-widest transition-all hover:bg-red-500 hover:text-white">
                                    <span wire:loading.remove
                                        wire:target="deleteTesti({{ $t->id }})">Hapus</span>
                                    <span wire:loading wire:target="deleteTesti({{ $t->id }})"
                                        class="animate-pulse italic">...</span>
                                </button>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    @endif
</div>
