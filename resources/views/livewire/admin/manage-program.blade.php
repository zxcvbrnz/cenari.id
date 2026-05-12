<div class="max-w-7xl mx-auto p-4 md:p-6 space-y-6 pb-24">
    <div
        class="flex flex-col sm:flex-row justify-between items-start sm:items-center bg-white p-6 md:p-8 rounded-[2rem] border border-slate-100 shadow-sm gap-4">
        <div>
            <h1 class="text-2xl md:text-3xl font-black italic uppercase tracking-tighter">Kelola <span
                    class="text-blue-600">Program</span></h1>
            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1">Tebar Kode Teknologi • Admin
            </p>
        </div>
        @if ($view !== 'program-list')
            <button wire:click="$set('view', 'program-list')"
                class="w-full sm:w-auto bg-slate-100 px-6 py-3 rounded-xl font-black uppercase text-[10px] tracking-widest hover:bg-slate-200 transition-all">←
                Kembali</button>
        @else
            <button wire:click="showProgramForm()"
                class="w-full sm:w-auto bg-slate-900 text-white px-8 py-4 rounded-2xl font-black uppercase text-[10px] tracking-widest shadow-lg hover:bg-blue-600 transition-all">+
                Program Baru</button>
        @endif
    </div>

    @if ($view === 'program-form')
        <div
            class="bg-white p-6 md:p-12 rounded-[2rem] md:rounded-[3rem] border border-slate-100 max-w-7xl mx-auto shadow-sm animate-fade-in">
            <div class="mb-10 text-center sm:text-left">
                <h2 class="text-xl md:text-2xl font-black uppercase italic text-slate-800">
                    {{ $selectedProgramId ? 'Update' : 'Buat' }} <span class="text-blue-600">Program</span>
                </h2>
                <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">Lengkapi detail informasi
                    program pendidikan</p>
            </div>

            <form wire:submit.prevent="saveProgram" class="space-y-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-12">
                    <div class="space-y-5">
                        <div class="space-y-2">
                            <label class="text-[10px] font-black uppercase text-slate-500 ml-1 tracking-widest">Pilih
                                Instansi</label>
                            <select wire:model="instansi_id"
                                class="w-full bg-slate-50 border-none rounded-2xl p-4 font-bold text-xs tracking-tight focus:ring-2 focus:ring-blue-500 transition-all">
                                <option value="">Pilih...</option>
                                @foreach ($instansis as $ins)
                                    <option value="{{ $ins->id }}">{{ $ins->name }}</option>
                                @endforeach
                            </select>
                            @error('instansi_id')
                                <span class="text-[9px] text-red-500 font-bold ml-1 italic">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-500 ml-1 tracking-widest">Nama
                                Program (Title)</label>
                            <input type="text" wire:model="title" placeholder="Contoh: Sekolah Robot"
                                class="w-full bg-slate-50 border-none rounded-2xl p-4 font-bold text-xs focus:ring-2 focus:ring-blue-500">
                            @error('title')
                                <span class="text-[9px] text-red-500 font-bold ml-1 italic">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <label class="text-[10px] font-black uppercase text-slate-500 ml-1 tracking-widest">Label
                                Navigasi</label>
                            <input type="text" wire:model="navigation" placeholder="Contoh: Kurikulum Robotik"
                                class="w-full bg-slate-50 border-none rounded-2xl p-4 font-bold text-xs italic focus:ring-2 focus:ring-blue-500">
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-4">
                            <div class="space-y-2">
                                <label
                                    class="text-[10px] font-black uppercase text-slate-500 ml-1 tracking-widest">Kategori
                                    Program</label>
                                <div class="flex gap-2">
                                    <input type="text" wire:model.defer="newCategoryItem"
                                        wire:keydown.enter.prevent="addCategory" placeholder="IoT, Web..."
                                        class="flex-1 bg-slate-50 border-none rounded-xl p-4 text-xs font-bold focus:ring-2 focus:ring-blue-500">
                                    <button type="button" wire:click="addCategory"
                                        class="bg-slate-900 text-white px-5 rounded-xl font-black shadow-lg hover:bg-blue-600 transition-all">+</button>
                                </div>
                                <div class="flex flex-wrap gap-2 mt-3">
                                    @foreach ($category as $index => $item)
                                        <span
                                            class="bg-blue-50 text-blue-700 px-3 py-2 rounded-lg text-[10px] font-black flex items-center gap-2 border border-blue-100 animate-fade-in">
                                            {{ $item }}
                                            <button type="button" wire:click="removeCategory({{ $index }})"
                                                class="text-red-400 hover:text-red-600 font-bold text-sm">×</button>
                                        </span>
                                    @endforeach
                                </div>
                            </div>

                            <div class="space-y-2">
                                <label
                                    class="text-[10px] font-black uppercase text-slate-500 ml-1 tracking-widest">Badges
                                    / Label</label>
                                <div class="flex gap-2">
                                    <input type="text" wire:model.defer="newBadgeItem"
                                        wire:keydown.enter.prevent="addBadge" placeholder="Populer, Baru..."
                                        class="flex-1 bg-slate-50 border-none rounded-xl p-4 text-xs font-bold focus:ring-2 focus:ring-amber-500">
                                    <button type="button" wire:click="addBadge"
                                        class="bg-amber-500 text-white px-5 rounded-xl font-black shadow-lg hover:bg-slate-900 transition-all">+</button>
                                </div>
                                <div class="flex flex-wrap gap-2 mt-3">
                                    @foreach ($badges as $index => $item)
                                        <span
                                            class="bg-amber-50 text-amber-700 px-3 py-2 rounded-lg text-[10px] font-black flex items-center gap-2 border border-amber-100 animate-fade-in">
                                            {{ $item }}
                                            <button type="button" wire:click="removeBadge({{ $index }})"
                                                class="text-red-400 hover:text-red-600 font-bold text-sm">×</button>
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label class="text-[10px] font-black uppercase text-slate-500 ml-1 tracking-widest">Warna
                                Identitas (Accent)</label>
                            <div class="flex items-center gap-4 bg-slate-50 p-2 rounded-2xl border border-slate-100">
                                <input type="color" wire:model="accent_color"
                                    class="w-14 h-14 bg-transparent border-none cursor-pointer rounded-lg">
                                <span
                                    class="text-[10px] font-black uppercase text-slate-400 font-mono">{{ $accent_color }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-5 text-center">
                        <label
                            class="text-[10px] font-black uppercase text-slate-500 tracking-widest block text-left ml-1">
                            Hero Image (Banner)
                        </label>

                        <div class="relative group">
                            <div
                                class="w-full aspect-video rounded-[2rem] bg-slate-50 border-4 border-dashed border-slate-200 overflow-hidden relative flex items-center justify-center transition-all group-hover:border-blue-400">

                                {{-- MODIFIKASI DISINI: Menggunakan Transform Translate untuk Center Mutlak --}}
                                <div wire:loading wire:target="hero_image"
                                    class="absolute inset-0 z-50 bg-white/90 backdrop-blur-sm">
                                    <div
                                        class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 flex flex-col items-center w-full">
                                        <svg class="animate-spin h-10 w-10 text-blue-600 mb-3"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10"
                                                stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor"
                                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                            </path>
                                        </svg>
                                        <span
                                            class="text-[10px] font-black uppercase tracking-[0.2em] text-blue-600">Uploading...</span>
                                    </div>
                                </div>

                                @if ($hero_image)
                                    <img src="{{ $hero_image->temporaryUrl() }}" class="w-full h-full object-cover">
                                @elseif($old_hero_image)
                                    <img src="{{ asset('storage/' . $old_hero_image) }}"
                                        class="w-full h-full object-cover opacity-60">
                                @else
                                    {{-- Placeholder saat kosong --}}
                                    <div class="text-slate-300 flex flex-col items-center" wire:loading.remove
                                        wire:target="hero_image">
                                        <svg class="w-12 h-12 mb-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <span class="text-[9px] font-black uppercase tracking-widest">Klik Untuk
                                            Upload</span>
                                    </div>
                                @endif
                            </div>

                            <input type="file" wire:model="hero_image"
                                class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-[60]"
                                accept="image/*">
                        </div>

                        <p class="text-[8px] font-bold text-slate-300 uppercase tracking-tighter">* Format: JPG, PNG,
                            WEBP (Maks. 2MB)</p>
                    </div>
                </div>

                <div class="pt-6">
                    <button type="submit"
                        class="w-full bg-blue-600 text-white py-5 rounded-[1.5rem] font-black uppercase text-xs tracking-[0.2em] shadow-2xl shadow-blue-200 hover:bg-blue-700 active:scale-95 transition-all">
                        {{ $selectedProgramId ? 'Update Data Program' : 'Terbitkan Program Baru' }}
                    </button>
                </div>
            </form>
        </div>
    @endif

    @if ($view === 'program-list')
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6">
            @foreach ($programs as $p)
                <div
                    class="bg-white p-2 rounded-[2rem] border border-slate-100 shadow-sm hover:border-blue-200 transition-all">
                    <div class="aspect-video rounded-[1.5rem] overflow-hidden relative">
                        <img src="{{ asset('storage/' . $p->hero_image) }}" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 flex items-end p-4">
                            <span
                                class="bg-white/20 backdrop-blur-md text-white text-[7px] font-bold px-2 py-1 rounded-full">{{ $p->instansi->name }}</span>
                        </div>
                    </div>
                    <div class="p-4 md:p-6">
                        <h3 class="font-black italic text-base md:text-lg text-slate-800 mb-4 leading-tight">
                            {{ $p->title }}</h3>
                        <div class="flex flex-wrap gap-2">
                            <button wire:click.prevent="showPackageDetail({{ $p->id }})"
                                class="flex-1 min-w-[100px] bg-slate-900 text-white py-3 rounded-xl font-black uppercase text-[9px] tracking-widest active:scale-95">Kelola</button>
                            <div class="flex gap-2">
                                <button wire:click="showProgramForm({{ $p->id }})"
                                    class="bg-slate-50 text-slate-400 p-3 rounded-xl hover:text-blue-600 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"
                                            stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </button>

                                <button type="button"
                                    @click="Swal.fire({ 
                                        title: 'Hapus Program?', 
                                        text: 'Program \'{{ $p->title }}\' dan semua paket di dalamnya akan dihapus permanen!', 
                                        icon: 'warning', 
                                        showCancelButton: true,
                                        confirmButtonColor: '#ef4444',
                                        confirmButtonText: 'Ya, Hapus!',
                                        cancelButtonText: 'Batal'
                                    }).then((r) => { if (r.isConfirmed) $wire.deleteProgram({{ $p->id }}) })"
                                    class="bg-red-50 text-red-400 p-3 rounded-xl hover:bg-red-500 hover:text-white transition-all">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
                                            stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    @if ($view === 'package-detail')
        <div class="flex flex-col lg:grid lg:grid-cols-3 gap-6 animate-fade-in">
            <div
                class="order-2 lg:order-1 bg-white p-6 md:p-8 rounded-[2rem] border border-slate-100 shadow-sm h-fit space-y-6">
                <h4 class="font-black uppercase italic text-[10px] text-blue-600 tracking-widest">Input Paket Kursus
                </h4>
                <div class="space-y-4">
                    <div class="space-y-1">
                        <label class="text-[9px] font-black uppercase text-slate-400 ml-1 tracking-widest">Nama
                            Paket</label>
                        <input type="text" wire:model="pkg_name" placeholder="e.g Level 1"
                            class="w-full bg-slate-50 border-none rounded-xl p-4 text-[11px] font-bold">
                    </div>
                    <div class="grid grid-cols-2 gap-3">
                        <div class="space-y-1">
                            <label
                                class="text-[9px] font-black uppercase text-slate-400 ml-1 tracking-widest">Level</label>
                            <input type="number" wire:model="pkg_level"
                                class="w-full bg-slate-50 border-none rounded-xl p-4 text-[11px] font-bold">
                        </div>
                        <div class="space-y-1">
                            <label
                                class="text-[9px] font-black uppercase text-slate-400 ml-1 tracking-widest">Harga</label>
                            <input type="number" wire:model="pkg_price"
                                class="w-full bg-slate-50 border-none rounded-xl p-4 text-[11px] font-bold">
                        </div>
                    </div>
                    <div class="space-y-1">
                        <label class="text-[9px] font-black uppercase text-slate-400 ml-1 tracking-widest">Alat /
                            Software</label>
                        <input type="text" wire:model="pkg_tool" placeholder="e.g Arduino IDE"
                            class="w-full bg-slate-50 border-none rounded-xl p-4 text-[11px] font-bold">
                    </div>
                    <div class="grid grid-cols-2 gap-3">
                        <div class="space-y-1">
                            <label class="text-[9px] font-black uppercase text-slate-400 ml-1 tracking-widest">Jml
                                Pertemuan</label>
                            <input type="number" wire:model="pkg_count"
                                class="w-full bg-slate-50 border-none rounded-xl p-4 text-[11px] font-bold">
                        </div>
                        <div class="space-y-1">
                            <label class="text-[9px] font-black uppercase text-slate-400 ml-1 tracking-widest">Jam
                                /Pertemuan</label>
                            <input type="number" wire:model="pkg_during"
                                class="w-full bg-slate-50 border-none rounded-xl p-4 text-[11px] font-bold">
                        </div>
                    </div>
                    <div class="space-y-1">
                        <label class="text-[9px] font-black uppercase text-slate-400 ml-1 tracking-widest">Deskripsi
                            Singkat</label>
                        <textarea wire:model="pkg_description"
                            class="w-full bg-slate-50 border-none rounded-xl p-4 text-[11px] font-medium italic h-24"
                            placeholder="Apa yang dipelajari?"></textarea>
                    </div>
                    <div class="space-y-1">
                        <label
                            class="text-[9px] font-black uppercase text-slate-400 ml-1 tracking-widest">{{ 'Kit Robotik (Optional)' }}</label>
                        <select wire:model="pkg_kit_robotic_id"
                            class="w-full bg-slate-50 border-none rounded-xl p-4 text-[11px] font-bold"
                            placeholder="Apa yang dipelajari?">
                            <option value="">Tidak Pakai Kit Robotik</option>
                            @foreach ($kit_robotics as $kit)
                                <option value="{{ $kit->id }}">{{ $kit->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <button wire:click="savePackage"
                    class="w-full bg-slate-900 text-white py-4 rounded-xl font-black uppercase text-[9px] tracking-widest shadow-xl hover:bg-blue-600 transition-all">
                    {{ $pkg_id ? 'Update Paket' : 'Tambah Paket Baru' }}
                </button>
                @if ($pkg_id)
                    <button
                        wire:click="$reset(['pkg_id','pkg_name','pkg_level','pkg_price','pkg_description','pkg_tool','pkg_count','pkg_during'])"
                        class="w-full text-slate-300 font-black text-[8px] uppercase tracking-widest">Batalkan
                        Edit</button>
                @endif
            </div>

            <div class="order-1 lg:order-2 lg:col-span-2 space-y-4">
                @foreach ($currentProgram->coursePackages->sortBy('level') as $package)
                    <div x-data="{ open: false }"
                        class="bg-white rounded-[1.5rem] md:rounded-[2rem] border border-slate-100 overflow-hidden shadow-sm">
                        <div
                            class="p-4 md:p-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                            <div class="flex items-center gap-4">
                                <div
                                    class="w-12 h-12 shrink-0 rounded-xl bg-slate-900 text-white flex flex-col items-center justify-center font-black italic shadow-inner">
                                    <span class="text-[7px] opacity-50 not-italic uppercase">Lv</span>
                                    <span class="text-base leading-none">{{ $package->level }}</span>
                                </div>
                                <div>
                                    <h4 class="font-black text-xs md:text-sm italic text-slate-800 leading-tight">
                                        {{ $package->name }}</h4>
                                    <p class="text-[9px] font-bold text-blue-600 tracking-tighter">Rp
                                        {{ number_format($package->price, 0, ',', '.') }} •
                                        {{ $package->course_count }} Pertemuan</p>
                                </div>
                            </div>
                            <div class="flex gap-2 w-full sm:w-auto">
                                <button @click="open = !open"
                                    class="flex-1 sm:flex-none bg-slate-900 text-white px-4 py-3 rounded-xl text-[9px] font-black uppercase tracking-widest hover:bg-blue-600 transition-all">Materi
                                    ({{ $package->moduls->count() }})
                                </button>
                                <button wire:click="editPackage({{ $package->id }})"
                                    class="bg-slate-50 text-slate-400 p-3 rounded-xl hover:text-blue-600 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"
                                            stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </button>

                                <button type="button"
                                    @click="Swal.fire({ 
                                        title: 'Hapus Paket?', 
                                        text: 'Hapus paket \'{{ $package->name }}\'? Semua modul di dalamnya akan ikut terhapus.', 
                                        icon: 'warning', 
                                        showCancelButton: true,
                                        confirmButtonColor: '#ef4444',
                                        confirmButtonText: 'Ya, Hapus'
                                    }).then((r) => { if(r.isConfirmed) $wire.deletePackage({{ $package->id }}) })"
                                    class="bg-red-50 text-red-400 p-3 rounded-xl hover:bg-red-500 hover:text-white transition-all">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
                                            stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <div x-show="open" x-collapse
                            class="bg-slate-50 p-4 md:p-8 border-t border-slate-100 space-y-4">
                            @foreach ($package->moduls as $modul)
                                <div
                                    class="bg-white p-4 md:p-6 rounded-2xl border border-slate-200 space-y-4 shadow-sm">
                                    <div class="flex gap-2 items-center">
                                        <div class="flex-1 space-y-1">
                                            <label class="text-[8px] font-black uppercase text-slate-300 ml-1">Judul
                                                Modul</label>
                                            <input type="text" value="{{ $modul->title }}"
                                                wire:blur="updateModul({{ $modul->id }}, 'title', $event.target.value)"
                                                class="w-full bg-slate-50 border-none rounded-lg p-3 text-[10px] font-black italic text-slate-700">
                                        </div>

                                        <button type="button"
                                            @click="Swal.fire({ 
                                                title: 'Hapus Modul?', 
                                                text: 'Hapus materi \'{{ $modul->title }}\'?', 
                                                icon: 'question', 
                                                showCancelButton: true,
                                                confirmButtonColor: '#ef4444'
                                            }).then((r) => { if(r.isConfirmed) $wire.deleteModul({{ $modul->id }}) })"
                                            class="text-red-200 hover:text-red-500 p-2 mt-4">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
                                                    stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                        </button>
                                    </div>
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                        @for ($i = 1; $i <= 4; $i++)
                                            <div class="space-y-1">
                                                <label
                                                    class="text-[7px] font-black uppercase text-slate-300 ml-1 tracking-tighter">Poin
                                                    {{ $i }}</label>
                                                <input type="text" value="{{ $modul->{'text_' . $i} }}"
                                                    wire:blur="updateModul({{ $modul->id }}, 'text_{{ $i }}', $event.target.value)"
                                                    class="w-full bg-slate-50 border-none rounded-lg p-2.5 text-[9px] font-medium"
                                                    placeholder="...">
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                            @endforeach
                            <button wire:click="addModul({{ $package->id }})"
                                class="w-full py-4 border-2 border-dashed border-slate-300 rounded-2xl text-[9px] font-black uppercase text-slate-400 hover:bg-white hover:text-blue-600 hover:border-blue-200 transition-all">+
                                Tambah Modul Materi</button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>
