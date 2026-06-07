<footer class="bg-white pt-20 pb-10 border-t border-slate-100">
    <div class="max-w-7xl mx-auto px-8">
        <!-- Mengubah grid menjadi md:grid-cols-3 karena kolom newsletter dihapus -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12 mb-16">

            <!-- KOLOM 1: Logo & Deskripsi -->
            <div class="col-span-1">
                {{-- logo --}}
                <img src="{{ asset('logoCenari2020 PATEN.png') }}" alt="Cenari ID Logo" class="w-16 mb-4">
                <p class="text-slate-500 text-[11px] leading-relaxed mb-6 max-w-[240px]">
                    Menghubungkan imajinasi dan realitas melalui pendidikan teknologi terapan di Banjarmasin.
                </p>
                <div class="flex items-center gap-3">
                    <a href="https://www.instagram.com/cenari.academy/" target="_blank"
                        class="w-8 h-8 rounded-full border border-slate-100 flex items-center justify-center hover:bg-slate-50 transition-colors"
                        title="Instagram">
                        <span class="text-[10px] font-bold text-slate-400">IG</span>
                    </a>

                    <!-- TAMBAHAN: Hubungi Kami -->
                    {{-- <a href="https://wa.me/628xxxxxxxxxx" target="_blank"
                        class="h-8 px-3 rounded-full border border-slate-100 flex items-center justify-center hover:bg-slate-50 hover:border-slate-200 transition-colors gap-1.5"
                        title="Hubungi Kami lewat WhatsApp">
                        <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full animate-pulse"></span>
                        <span class="text-[9px] font-black uppercase tracking-wider text-slate-400 hover:text-slate-600">Hubungi Kami</span>
                    </a> --}}
                </div>
            </div>

            <!-- KOLOM 2: Program Dinamis -->
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

            <!-- KOLOM 3: Layanan (Perbaikan Route & Title Baru) -->
            <div>
                <h4 class="text-[#0F172A] text-[10px] font-black uppercase tracking-[0.2em] mb-6">Layanan</h4>
                <ul class="space-y-3 text-slate-500 text-[11px] font-semibold">
                    <li>
                        <a href="{{ route('course.packages') }}" wire:navigate
                            class="hover:text-[#3B82F6] transition-colors block">
                            Pilihan Kelas
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('b2b.solution') }}" wire:navigate
                            class="hover:text-[#3B82F6] transition-colors block">
                            Mitra Sekolah
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('b2b.institution') }}" wire:navigate
                            class="hover:text-[#3B82F6] transition-colors block">
                            Mitra Instansi
                        </a>
                    </li>

                    <!-- TAMBAHAN: Tutorial & Modul -->
                    <li>
                        <a href="#" wire:navigate
                            class="hover:text-[#3B82F6] text-slate-600 font-bold transition-colors block flex items-center gap-1">
                            Tutorial & Modul
                            <span
                                class="bg-blue-50 text-blue-600 text-[8px] px-1.5 py-0.5 rounded-md font-black uppercase tracking-wide scale-90">Baru</span>
                        </a>
                    </li>
                </ul>
            </div>

        </div>

        <!-- Bagian Copyright & Bottom Links -->
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
