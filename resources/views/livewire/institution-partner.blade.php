<div class="min-h-screen bg-[#f8fafc] py-12 px-4">
    <div class="max-w-4xl mx-auto">

        <div class="mb-10 text-center">
            <h2 class="text-3xl font-black text-slate-900 uppercase tracking-tighter italic">Partnership Form</h2>
            <p class="text-slate-500 font-bold text-xs uppercase tracking-[0.3em] mt-2">Cenari Education Institution
                Partner
            </p>
        </div>

        <div class="bg-white rounded-[3rem] shadow-2xl shadow-slate-200/60 border border-slate-100 overflow-hidden">
            <div class="bg-slate-900 px-10 py-6 flex justify-between items-center">
                <span class="text-white text-[10px] font-black uppercase tracking-widest">Buat Penawaran Kemitraan</span>
                <div wire:loading wire:target="saveMitra" class="flex items-center gap-2">
                    <div class="w-2 h-2 bg-blue-500 rounded-full animate-pulse"></div>
                    <span class="text-white text-[9px] font-bold uppercase italic">Sedang Mengirim...</span>
                </div>
            </div>

            <form wire:submit.prevent="saveMitra" class="p-10 space-y-8">

                <div class="hidden -z-10">
                    <input type="text" wire:model="honeypot">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block ml-2">Nama
                            Lengkap</label>
                        <input type="text" wire:model="nama_lengkap"
                            class="w-full border-slate-200 rounded-2xl focus:ring-blue-600 focus:border-blue-600 font-bold text-slate-700 py-3">
                        @error('nama_lengkap')
                            <span class="text-red-500 text-[10px] font-bold ml-2 italic">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block ml-2">Nama
                            Instansi</label>
                        <input type="text" wire:model="nama_institusi"
                            class="w-full border-slate-200 rounded-2xl focus:ring-blue-600 font-bold text-slate-700 py-3">
                        @error('nama_institusi')
                            <span class="text-red-500 text-[10px] font-bold ml-2 italic">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block ml-2">No. HP
                            / WhatsApp</label>
                        <input type="text" wire:model="whatsapp" placeholder="62812..."
                            class="w-full border-slate-200 rounded-2xl focus:ring-blue-600 font-bold text-slate-700 py-3">
                        @error('whatsapp')
                            <span class="text-red-500 text-[10px] font-bold ml-2 italic">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block ml-2">Alamat
                            Email</label>
                        <input type="email" wire:model="email"
                            class="w-full border-slate-200 rounded-2xl focus:ring-blue-600 font-bold text-slate-700 py-3">
                        @error('email')
                            <span class="text-red-500 text-[10px] font-bold ml-2 italic">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block ml-2">Tujuan
                        Surat (Kepada Yth.)</label>
                    <input type="text" wire:model="tujuan_surat"
                        placeholder="Contoh: Kepala Sekolah SMA N 1 Banjarmasin"
                        class="w-full border-slate-200 rounded-2xl focus:ring-blue-600 font-bold text-slate-700 py-3">
                    @error('tujuan_surat')
                        <span class="text-red-500 text-[10px] font-bold ml-2 italic">{{ $message }}</span>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block ml-2">Detail
                        Penawaran / Kerjasama</label>
                    <textarea wire:model="penawaran" rows="5" placeholder="Tuliskan garis besar kerjasama yang ditawarkan..."
                        class="w-full border-slate-200 rounded-[2rem] focus:ring-blue-600 font-bold text-slate-700 p-6"></textarea>
                    @error('penawaran')
                        <span class="text-red-500 text-[10px] font-bold ml-2 italic">{{ $message }}</span>
                    @enderror
                </div>

                <div class="pt-6">
                    <button type="submit" wire:loading.attr="disabled" wire:target="saveMitra"
                        class="w-full bg-blue-600 disabled:opacity-50 disabled:cursor-not-allowed hover:bg-blue-700 text-white py-5 rounded-2xl font-black text-[11px] uppercase tracking-[0.3em] transition-all shadow-xl active:scale-[0.98]">

                        <span wire:loading.remove wire:target="saveMitra">Kirim Penawaran Sekarang</span>
                        <span wire:loading wire:target="saveMitra" class="flex items-center justify-center gap-2">
                            <svg class="animate-spin h-4 w-4 text-white" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                </path>
                            </svg>
                            Memproses...
                        </span>
                    </button>
                </div>
            </form>
        </div>

        <p class="mt-8 text-center text-[10px] font-bold text-slate-400 uppercase tracking-widest">
            &copy; 2026 Cenari - Sistem Kemitraan Terintegrasi
        </p>
    </div>
</div>
