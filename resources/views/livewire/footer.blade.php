<footer class="bg-white pt-20 pb-10 border-t border-slate-100">
    <div class="max-w-7xl mx-auto px-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-16">
            <div class="col-span-1">
                {{-- logo --}}
                <img src="{{ asset('logoCenari2020 PATEN.png') }}" alt="Cenari ID Logo" class="w-16 mb-4">
                <p class="text-slate-500 text-[11px] leading-relaxed mb-6 max-w-[240px]">
                    Menghubungkan imajinasi dan realitas melalui pendidikan teknologi terapan di Banjarmasin.
                </p>
                <div class="flex gap-3">
                    <a href="https://www.instagram.com/cenari.academy/" target="_blank"
                        class="w-8 h-8 rounded-full border border-slate-100 flex items-center justify-center hover:bg-slate-50 transition-colors">
                        <span class="text-[10px] font-bold text-slate-400">IG</span>
                    </a>
                </div>
            </div>

            <!-- KOLOM PROGRAM (PERBAIKAN DI SINI) -->
            <div>
                <h4 class="text-[#0F172A] text-[10px] font-black uppercase tracking-[0.2em] mb-6">Program</h4>
                <div class="space-y-4">
                    @foreach ($instansi as $inst)
                        <div class="space-y-2">
                            <!-- Nama Instansi (Header Sub-Menu) -->
                            <div class="text-[9px] font-black text-slate-400 uppercase tracking-wider">
                                {{ $inst->name }}
                            </div>

                            <!-- Daftar Program dari Instansi Terkait -->
                            <ul class="space-y-2.5 text-slate-500 text-[11px] font-semibold">
                                @foreach ($inst->programs as $program)
                                    <li>
                                        <a href="{{ route('program.detail', $program->slug) }}" wire:navigate
                                            class="hover:text-[#3B82F6] transition-colors block">
                                            {{ $program->navigation }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                </div>
            </div>

            <div>
                <h4 class="text-[#0F172A] text-[10px] font-black uppercase tracking-[0.2em] mb-6">Lembaga</h4>
                <ul class="space-y-3 text-slate-500 text-[11px] font-semibold">
                    <li><a href="https://cenari.sch.id/profil" class="hover:text-[#3B82F6] transition-colors">Tentang
                            Kami</a></li>
                    <li><a href="{{ route('b2b.solution') }}" class="hover:text-[#3B82F6] transition-colors">Mitra
                            Sekolah</a></li>
                    <li><a href="{{ route('contact.us') }}" class="hover:text-[#3B82F6] transition-colors">Kontak
                            Kami</a></li>
                </ul>
            </div>

            <div>
                <h4 class="text-[#0F172A] text-[10px] font-black uppercase tracking-[0.2em] mb-6">Newsletter</h4>
                <div class="flex flex-col gap-3">
                    <input type="email" placeholder="Email Anda"
                        class="bg-slate-50 border border-slate-100 rounded-xl py-2.5 px-4 text-[11px] focus:outline-none focus:border-[#3B82F6] transition-all">
                    <button
                        class="bg-slate-100 text-slate-600 py-2.5 rounded-xl text-[9px] font-bold uppercase tracking-widest hover:bg-[#3B82F6] hover:text-white transition-all">Berlangganan</button>
                </div>
            </div>
        </div>

        <div class="pt-8 border-t border-slate-50 flex flex-col md:flex-row justify-between items-center gap-4">
            <p class="text-[9px] text-slate-400 font-bold uppercase tracking-[0.15em]">
                &copy; 2026 CENARI ID.
            </p>
            <div class="flex gap-6 text-[9px] text-slate-400 font-bold uppercase tracking-[0.15em]">
                <a href="#" class="hover:text-slate-900 transition-colors">Privasi</a>
                <a href="#" class="hover:text-slate-900 transition-colors">Ketentuan</a>
            </div>
        </div>
    </div>
</footer>
