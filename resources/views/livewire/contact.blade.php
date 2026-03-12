<div class="bg-[#FDFDFD] min-h-screen py-20 px-6">
    <div class="max-w-6xl mx-auto">

        <div class="mb-16 text-center">
            <h2 class="text-[11px] font-black uppercase tracking-[0.4em] text-blue-600 mb-4 italic">Get In Touch</h2>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">

            <div class="lg:col-span-5 space-y-4">
                <a href="https://wa.me/{{ $info['wa_number'] }}?text={{ urlencode($info['wa_text']) }}" target="_blank"
                    class="block bg-green-50 p-8 rounded-[2.5rem] border border-green-100 group hover:bg-green-600 transition-all duration-500 shadow-xl shadow-green-200/20">
                    <div class="flex justify-between items-center">
                        <div>
                            <p
                                class="text-[9px] font-black uppercase tracking-widest text-green-600 group-hover:text-green-100 mb-2">
                                WhatsApp Official</p>
                            <h4
                                class="text-2xl font-black text-slate-900 group-hover:text-white tracking-tighter uppercase italic">
                                Chat Sekarang</h4>
                        </div>
                        <div
                            class="w-14 h-14 bg-white rounded-2xl flex items-center justify-center text-green-600 shadow-lg group-hover:scale-110 transition-transform">
                            <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L0 24l6.335-1.662c1.72.937 3.659 1.432 5.631 1.433h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                            </svg>
                        </div>
                    </div>
                </a>

                <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-xl shadow-slate-200/40">
                    <div class="space-y-6">
                        <div class="flex gap-4">
                            <div class="text-blue-600 pt-1"><svg class="w-5 h-5" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"
                                        stroke-width="2" />
                                </svg></div>
                            <div>
                                <p class="text-[9px] font-black uppercase tracking-widest text-slate-400 mb-1">Lokasi
                                    Kami</p>
                                <p class="text-sm font-bold text-slate-800 uppercase tracking-tighter leading-tight">
                                    {{ $info['address'] }}</p>
                            </div>
                        </div>
                        <div class="flex gap-4">
                            <div class="text-blue-600 pt-1"><svg class="w-5 h-5" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"
                                        stroke-width="2" />
                                </svg></div>
                            <div>
                                <p class="text-[9px] font-black uppercase tracking-widest text-slate-400 mb-1">Email &
                                    Telepon</p>
                                <p class="text-sm font-bold text-slate-800 tracking-tighter">
                                    {{ $info['email_official'] }}</p>
                                <p class="text-sm font-bold text-slate-800 tracking-tighter">{{ $info['phone'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-7">
                <div class="bg-white p-8 md:p-12 rounded-[3rem] border border-slate-100 shadow-2xl shadow-slate-200/40">
                    @if ($success)
                        <div class="text-center py-12 animate-in fade-in zoom-in duration-500">
                            <div
                                class="w-20 h-20 bg-blue-50 text-blue-600 rounded-full flex items-center justify-center mx-auto mb-6 shadow-inner">
                                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path d="M5 13l4 4L19 7" stroke-width="3" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                            </div>
                            <h3 class="text-2xl font-black text-slate-900 uppercase italic">Pesan Terkirim!</h3>
                            <p class="text-slate-400 mt-2 font-medium">Terima kasih, pesan Anda telah kami simpan.</p>
                            <button wire:click="$set('success', false)"
                                class="mt-8 text-[10px] font-black text-blue-600 uppercase tracking-widest border-b-2 border-blue-600 pb-1">Kirim
                                Lagi</button>
                        </div>
                    @else
                        <form wire:submit="sendMessage" class="space-y-5">
                            <div class="hidden" aria-hidden="true">
                                <input type="text" wire:model="honeypot" tabindex="-1">
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                <div class="space-y-2">
                                    <label
                                        class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">Nama</label>
                                    <input wire:model="name" type="text"
                                        class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-blue-500 text-sm font-bold"
                                        placeholder="Input Nama">
                                    @error('name')
                                        <p class="text-[9px] text-red-500 font-bold ml-1 uppercase italic tracking-widest">
                                            {{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="space-y-2">
                                    <label
                                        class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">Email</label>
                                    <input wire:model="email" type="email"
                                        class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-blue-500 text-sm font-bold"
                                        placeholder="email@anda.com">
                                    @error('email')
                                        <p class="text-[9px] text-red-500 font-bold ml-1 uppercase italic tracking-widest">
                                            {{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="space-y-2">
                                <label
                                    class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">Subjek
                                    Pertanyaan</label>
                                <select wire:model="subject"
                                    class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-blue-500 text-sm font-bold">
                                    <option value="">Pilih Kategori</option>
                                    <option value="Kursus">Informasi Kursus Robotik</option>
                                    <option value="Jasa IT">Jasa Website & IoT</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>
                                @error('subject')
                                    <p class="text-[9px] text-red-500 font-bold ml-1 uppercase italic tracking-widest">
                                        {{ $message }}</p>
                                @enderror
                            </div>

                            <div class="space-y-2">
                                <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">Isi
                                    Pesan</label>
                                <textarea wire:model="message" rows="4"
                                    class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-blue-500 text-sm font-bold"
                                    placeholder="Tuliskan pesan Anda di sini..."></textarea>
                                @error('message')
                                    <p class="text-[9px] text-red-500 font-bold ml-1 uppercase italic tracking-widest">
                                        {{ $message }}</p>
                                @enderror
                            </div>

                            <div class="pt-4">
                                <button type="submit" wire:loading.attr="disabled"
                                    class="w-full bg-slate-900 text-white py-5 rounded-2xl font-black uppercase tracking-[0.2em] text-[11px] hover:bg-blue-600 transition-all shadow-xl active:scale-[0.98] disabled:opacity-50">
                                    <span wire:loading.remove>Kirim Pesan Sekarang</span>
                                    <span wire:loading>Sedang Memproses...</span>
                                </button>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
