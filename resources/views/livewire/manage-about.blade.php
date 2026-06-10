<div class="bg-slate-100 min-h-screen py-10 antialiased font-sans text-slate-800">
    <div class="max-w-7xl mx-auto px-6 space-y-8">

        <div
            class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bg-white p-6 rounded-2xl border border-slate-200/60 shadow-sm">
            <div>
                <h1 class="text-xl font-black text-slate-900 tracking-tight">Content Management System</h1>
                <p class="text-xs text-slate-500 mt-0.5">Kelola data profil instansi, lini bisnis, dan indikator
                    pencapaian statistik.</p>
            </div>
            @if (session()->has('success'))
                <div
                    class="text-xs font-bold text-emerald-700 bg-emerald-50 border border-emerald-200 px-4 py-2 rounded-xl animate-fade-in">
                    ✓ {{ session('success') }}
                </div>
            @endif
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">

            <form wire:submit.prevent="saveAbout"
                class="lg:col-span-7 bg-white p-6 sm:p-8 rounded-3xl border border-slate-200/60 shadow-sm space-y-6">
                <div class="border-b border-slate-100 pb-3">
                    <h2 class="text-base font-extrabold text-slate-900 uppercase tracking-wider text-blue-600">Profil
                        Utama Perusahaan</h2>
                    <p class="text-[11px] text-slate-400 mt-0.5">Semua perubahan pada bagian ini akan memperbarui satu
                        baris data yang sama.</p>
                </div>

                <div class="space-y-1.5">
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wide">Teks Beranda
                        (Homepage)</label>
                    <textarea wire:model="homepage_text" rows="3"
                        class="w-full text-xs p-3 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all outline-none"
                        placeholder="Teks singkat yang muncul di halaman depan awal..."></textarea>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 border-t border-slate-50 pt-4">
                    <div class="space-y-1.5">
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wide">Deskripsi Bagian
                            1</label>
                        <textarea wire:model="text_1" rows="5"
                            class="w-full text-xs p-3 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all outline-none"
                            placeholder="Teks isi bagian penjelas visi..."></textarea>
                    </div>
                    <div class="space-y-2">
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wide">
                            Gambar Bagian 1
                        </label>

                        <div
                            class="border border-dashed border-slate-300 p-4 rounded-xl text-center bg-slate-50/50 relative">

                            <div wire:loading wire:target="new_image_1"
                                class="absolute inset-0 bg-white/80 rounded-xl flex flex-col items-center justify-center z-10 backdrop-blur-[1px]">
                                <div class="flex items-center gap-2">
                                    <svg class="animate-spin h-4 w-4 text-blue-600" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10"
                                            stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor"
                                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                        </path>
                                    </svg>
                                    <span class="text-[11px] font-bold text-blue-600">Mengunggah gambar...</span>
                                </div>
                            </div>

                            @if ($new_image_1 && !$errors->has('new_image_1'))
                                <div wire:loading.remove wire:target="new_image_1" class="mb-2">
                                    <div
                                        class="text-[10px] font-bold text-emerald-600 mb-1 flex items-center justify-center gap-1">
                                        <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full animate-pulse"></span>
                                        Preview Gambar Baru
                                    </div>
                                    <img src="{{ $new_image_1->temporaryUrl() }}"
                                        class="h-20 mx-auto object-cover rounded-lg shadow-xs border border-slate-200">
                                </div>
                            @endif

                            @if ($image_1 && !$new_image_1)
                                <div wire:loading.remove wire:target="new_image_1" class="mb-2">
                                    <div class="text-[10px] font-bold text-slate-400 mb-1">Gambar Saat Ini</div>
                                    <img src="{{ asset('storage/' . $image_1) }}"
                                        class="h-20 mx-auto object-cover rounded-lg shadow-xs border border-slate-100">
                                </div>
                            @endif

                            <div class="mt-1">
                                <input type="file" wire:model="new_image_1" id="new_image_1"
                                    class="text-[10px] text-slate-500 block w-full file:mr-4 file:py-1.5 file:px-4 file:rounded-xl file:border-0 file:text-[10px] file:font-bold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition-colors cursor-pointer">

                                @error('new_image_1')
                                    <span
                                        class="text-[10px] text-red-500 font-medium block mt-1.5">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 border-t border-slate-50 pt-4">
                    <div class="space-y-1.5">
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wide">Deskripsi Bagian
                            2</label>
                        <textarea wire:model="text_2" rows="5"
                            class="w-full text-xs p-3 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all outline-none"
                            placeholder="Teks isi komitmen/implementasi kerja..."></textarea>
                    </div>
                    <div class="space-y-2">
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wide">
                            Gambar Bagian 2
                        </label>

                        <div
                            class="border border-dashed border-slate-300 p-4 rounded-xl text-center bg-slate-50/50 relative">

                            <div wire:loading wire:target="new_image_2"
                                class="absolute inset-0 bg-white/80 rounded-xl flex flex-col items-center justify-center z-10 backdrop-blur-[1px]">
                                <div class="flex items-center gap-2">
                                    <svg class="animate-spin h-4 w-4 text-blue-600" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10"
                                            stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor"
                                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                        </path>
                                    </svg>
                                    <span class="text-[11px] font-bold text-blue-600">Mengunggah gambar...</span>
                                </div>
                            </div>

                            @if ($new_image_2 && !$errors->has('new_image_2'))
                                <div wire:loading.remove wire:target="new_image_2" class="mb-2">
                                    <div
                                        class="text-[10px] font-bold text-emerald-600 mb-1 flex items-center justify-center gap-1">
                                        <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full animate-pulse"></span>
                                        Preview Gambar Baru
                                    </div>
                                    <img src="{{ $new_image_2->temporaryUrl() }}"
                                        class="h-20 mx-auto object-cover rounded-lg shadow-xs border border-slate-200">
                                </div>
                            @endif

                            @if ($image_2 && !$new_image_2)
                                <div wire:loading.remove wire:target="new_image_2" class="mb-2">
                                    <div class="text-[10px] font-bold text-slate-400 mb-1">Gambar Saat Ini</div>
                                    <img src="{{ asset('storage/' . $image_2) }}"
                                        class="h-20 mx-auto object-cover rounded-lg shadow-xs border border-slate-100">
                                </div>
                            @endif

                            <div class="mt-1">
                                <input type="file" wire:model="new_image_2" id="new_image_2"
                                    class="text-[10px] text-slate-500 block w-full file:mr-4 file:py-1.5 file:px-4 file:rounded-xl file:border-0 file:text-[10px] file:font-bold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition-colors cursor-pointer">

                                @error('new_image_2')
                                    <span
                                        class="text-[10px] text-red-500 font-medium block mt-1.5">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 border-t border-slate-50 pt-4">
                    <div class="space-y-1.5">
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wide">ID Video YouTube
                            Profile</label>
                        <input type="text" wire:model="video_url"
                            class="w-full text-xs p-3 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none"
                            placeholder="Contoh: dQw4w9WgXcQ">
                    </div>
                    <div class="space-y-2">
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wide">
                            File Company Profile (PDF)
                        </label>

                        <div
                            class="border border-slate-200 p-4 rounded-xl bg-slate-50/50 flex flex-col gap-3 relative overflow-hidden">

                            <div wire:loading wire:target="new_pdf"
                                class="absolute inset-0 bg-white/80 rounded-xl flex items-center justify-center z-10 backdrop-blur-[1px]">
                                <div class="flex items-center gap-2">
                                    <svg class="animate-spin h-4 w-4 text-red-600" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10"
                                            stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor"
                                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                        </path>
                                    </svg>
                                    <span class="text-[11px] font-bold text-red-600">Mengunggah file PDF...</span>
                                </div>
                            </div>

                            <div class="flex flex-wrap gap-2 items-center">
                                @if ($new_pdf && !$errors->has('new_pdf'))
                                    <div wire:loading.remove wire:target="new_pdf"
                                        class="flex items-center gap-1.5 text-[10px] font-bold text-emerald-700 bg-emerald-50 border border-emerald-100 px-2.5 py-1 rounded-lg">
                                        <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full animate-pulse"></span>
                                        PDF Baru Siap Disimpan ✓
                                    </div>
                                @endif

                                @if ($pdf_url && !$new_pdf)
                                    <div wire:loading.remove wire:target="new_pdf"
                                        class="flex items-center gap-1 text-[10px] font-bold text-red-600 bg-red-50 border border-red-100 px-2.5 py-1 rounded-lg">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="2.5" stroke="currentColor" class="w-3 h-3">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5A3.375 3.375 0 0 0 10.125 2.25H8.25m2.25 13.5H12m-2.25 3H12m0 0h3.75M12 18.75V16.5m-3-12h2.25A3.375 3.375 0 0 1 14.625 7.875V9.42a5.13 5.13 0 0 1 1.258.91l2.583 2.583c.313.313.57.678.762 1.082a5.13 5.13 0 0 1 .327 1.83V18.75A3.375 3.375 0 0 1 16.125 22H7.875A3.375 3.375 0 0 1 4.5 18.75V7.875A3.375 3.375 0 0 1 7.875 4.5H10.5z" />
                                        </svg>
                                        File Terarsip Berhasil Dimuat
                                    </div>
                                @endif
                            </div>

                            <div class="w-full">
                                <input type="file" wire:model="new_pdf" id="new_pdf" accept="application/pdf"
                                    class="text-[10px] text-slate-500 block w-full file:mr-4 file:py-1.5 file:px-4 file:rounded-xl file:border-0 file:text-[10px] file:font-bold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition-colors cursor-pointer">

                                @error('new_pdf')
                                    <span
                                        class="text-[10px] text-red-500 font-medium block mt-2">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>
                    </div>
                </div>

                <div class="border-t border-slate-100 pt-4 flex justify-end">
                    <button type="submit"
                        class="text-xs font-bold text-white bg-blue-600 hover:bg-blue-700 px-6 py-3 rounded-xl transition-all shadow-md shadow-blue-500/10">
                        Simpan Perubahan Profile
                    </button>
                </div>
            </form>

            <div class="lg:col-span-5 space-y-8">

                <div class="bg-white p-6 rounded-3xl border border-slate-200/60 shadow-sm space-y-4">
                    <div class="border-b border-slate-100 pb-2">
                        <h2 class="text-xs font-black text-slate-900 uppercase tracking-wider text-emerald-600">Lini
                            Bisnis / Sektor</h2>
                    </div>

                    <form wire:submit.prevent="saveBusinessLine"
                        class="bg-slate-50 p-4 rounded-2xl border border-slate-100 space-y-3">
                        <input type="hidden" wire:model="business_id">
                        <div class="space-y-1">
                            <input type="text" wire:model="business_name"
                                class="w-full text-xs p-2.5 border border-slate-200 rounded-lg outline-none"
                                placeholder="Nama Lini Bisnis...">
                        </div>
                        <div class="space-y-1">
                            <textarea wire:model="business_description" rows="2"
                                class="w-full text-xs p-2.5 border border-slate-200 rounded-lg outline-none" placeholder="Deskripsi singkat..."></textarea>
                        </div>
                        <div class="space-y-1">
                            <input type="text" wire:model="business_link"
                                class="w-full text-xs p-2.5 border border-slate-200 rounded-lg outline-none"
                                placeholder="Link eksternal terkait lini bisnis (opsional)...">
                        </div>
                        <div class="flex justify-end gap-2 text-[11px]">
                            @if ($business_id)
                                <button type="button" wire:click="resetBusinessForm"
                                    class="bg-slate-200 px-3 py-1.5 rounded-lg font-bold">Batal</button>
                            @endif
                            <button type="submit"
                                class="bg-emerald-600 text-white px-4 py-1.5 rounded-lg font-bold shadow-sm">
                                {{ $business_id ? 'Update' : 'Tambah Baru' }}
                            </button>
                        </div>
                    </form>

                    <div class="space-y-2 max-h-[220px] overflow-y-auto pr-1">
                        @foreach ($businessLines as $bl)
                            <div
                                class="p-3 bg-white border border-slate-100 rounded-xl flex justify-between items-start gap-4 shadow-2xs">
                                <div>
                                    <h4 class="text-xs font-bold text-slate-900">{{ $bl->name }}</h4>
                                    <p class="text-[11px] text-slate-500 leading-normal mt-0.5">
                                        {{ Str::limit($bl->description, 65) }}</p>
                                    @if ($bl->link)
                                        <a href="{{ $bl->link }}" target="_blank"
                                            class="text-[10px] font-bold text-blue-600 mt-1 inline-block">Lihat
                                            Link</a>
                                    @endif
                                </div>
                                <div class="flex gap-1.5 flex-shrink-0">
                                    <button wire:click="editBusinessLine({{ $bl->id }})"
                                        class="text-[10px] text-blue-600 font-bold bg-blue-50 px-2 py-1 rounded-md">Edit</button>
                                    <button onclick="confirm('Hapus lini bisnis?') || event.stopImmediatePropagation()"
                                        wire:click="deleteBusinessLine({{ $bl->id }})"
                                        class="text-[10px] text-red-600 font-bold bg-red-50 px-2 py-1 rounded-md">Del</button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="bg-white p-6 rounded-3xl border border-slate-200/60 shadow-sm space-y-4">
                    <div class="border-b border-slate-100 pb-2">
                        <h2 class="text-xs font-black text-slate-900 uppercase tracking-wider text-amber-600">Data
                            Statistik & Capaian</h2>
                    </div>

                    <form wire:submit.prevent="saveStat"
                        class="bg-slate-50 p-4 rounded-2xl border border-slate-100 space-y-3">
                        <input type="hidden" wire:model="stat_id">
                        <div class="grid grid-cols-2 gap-2">
                            <input type="text" wire:model="stat_title"
                                class="w-full text-xs p-2.5 border border-slate-200 rounded-lg outline-none"
                                placeholder="Judul (Contoh: Total Lulusan)">
                            <input type="text" wire:model="stat_value"
                                class="w-full text-xs p-2.5 border border-slate-200 rounded-lg outline-none"
                                placeholder="Nilai (Contoh: 1.500+)">
                        </div>
                        <div class="space-y-1">
                            <input type="text" wire:model="stat_svg_path"
                                class="w-full text-xs p-2.5 border border-slate-200 rounded-lg font-mono outline-none"
                                placeholder="Isi Atribut d pada Path SVG Heroicons...">
                        </div>
                        <div class="flex justify-end gap-2 text-[11px]">
                            @if ($stat_id)
                                <button type="button" wire:click="resetStatForm"
                                    class="bg-slate-200 px-3 py-1.5 rounded-lg font-bold">Batal</button>
                            @endif
                            <button type="submit"
                                class="bg-amber-600 text-white px-4 py-1.5 rounded-lg font-bold shadow-sm">
                                {{ $stat_id ? 'Update' : 'Tambah Baru' }}
                            </button>
                        </div>
                    </form>

                    <div class="space-y-2 max-h-[220px] overflow-y-auto pr-1">
                        @foreach ($stats as $st)
                            <div
                                class="p-3 bg-white border border-slate-100 rounded-xl flex justify-between items-center gap-4 shadow-2xs">
                                <div class="flex items-center space-x-3">
                                    <div
                                        class="w-7 h-7 bg-slate-50 rounded-lg flex items-center justify-center flex-shrink-0 text-slate-500 border border-slate-100">
                                        <svg fill="none" viewBox="0 0 24 24" stroke-width="2"
                                            stroke="currentColor" class="w-4 h-4">
                                            <path d="{{ $st->svg_path }}"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="text-xs font-bold text-slate-900">{{ $st->title }}</h4>
                                        <span
                                            class="text-[10px] font-black text-blue-600 tracking-tight">{{ $st->value }}</span>
                                    </div>
                                </div>
                                <div class="flex gap-1.5 flex-shrink-0">
                                    <button wire:click="editStat({{ $st->id }})"
                                        class="text-[10px] text-blue-600 font-bold bg-blue-50 px-2 py-1 rounded-md">Edit</button>
                                    <button
                                        onclick="confirm('Hapus item statistik?') || event.stopImmediatePropagation()"
                                        wire:click="deleteStat({{ $st->id }})"
                                        class="text-[10px] text-red-600 font-bold bg-red-50 px-2 py-1 rounded-md">Del</button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>
