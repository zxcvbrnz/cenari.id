<div class="bg-white">
    <section class="bg-[#0F172A] py-24">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <span class="text-blue-500 font-black tracking-[0.3em] uppercase text-xs">For Corporate & Industry</span>
            <h1 class="text-4xl md:text-6xl font-heading font-black text-white mt-6 mb-8">
                Akselerasi Industri <br> <span class="text-slate-400">Melalui Automasi & IoT Terapan.</span>
            </h1>
            <p class="text-slate-400 max-w-2xl mx-auto text-sm md:text-base leading-relaxed">
                Membangun infrastruktur digital yang tangguh dengan integrasi hardware dan software kustom untuk
                efisiensi bisnis Anda.
            </p>
        </div>
    </section>

    <section class="py-24 max-w-7xl mx-auto px-6">
        <div class="grid md:grid-cols-2 gap-16 items-center">
            <div class="relative">
                <div class="relative rounded-[3rem] overflow-hidden shadow-2xl">
                    <img src="https://images.pexels.com/photos/256381/pexels-photo-256381.jpeg?auto=compress&cs=tinysrgb&w=800"
                        class="w-full h-[500px] object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/90 to-transparent flex items-end p-12">
                        <div class="space-y-2">
                            <p class="text-blue-400 font-black text-xs uppercase tracking-widest">Case Study</p>
                            <p class="text-white font-medium text-lg italic">
                                "Implementasi Smart Warehouse: Monitoring stok real-time melalui dashboard terpusat."
                            </p>
                        </div>
                    </div>
                </div>
                <div
                    class="absolute -bottom-6 -right-6 bg-blue-600 p-6 rounded-3xl shadow-xl text-white hidden md:block">
                    <p class="text-2xl font-black italic uppercase">99.9%</p>
                    <p class="text-[9px] font-bold uppercase tracking-widest opacity-80">Uptime Reliability</p>
                </div>
            </div>

            <div class="space-y-8">
                <div>
                    <h2 class="text-3xl font-bold text-slate-900 mb-6 italic uppercase tracking-tighter">Infrastruktur
                        Cerdas & Adaptif.</h2>
                    <p class="text-slate-500 leading-relaxed">
                        Kami membantu instansi mengadopsi teknologi tepat guna. Mulai dari audit kebutuhan sistem hingga
                        implementasi solusi IoT yang mampu memangkas biaya operasional secara signifikan.
                    </p>
                </div>

                <ul class="space-y-4">
                    @foreach (['Custom Dashboard Monitoring (Real-time)', 'Automasi Jalur Produksi & Logistik', 'Integrasi Data Multi-platform', 'Maintenance & Technical Support 24/7'] as $feature)
                        <li class="flex items-center gap-3 font-bold text-slate-700 group transition-all">
                            <div
                                class="bg-blue-50 p-1.5 rounded-lg group-hover:bg-blue-600 group-hover:text-white transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            {{ $feature }}
                        </li>
                    @endforeach
                </ul>

                <div class="pt-4">
                    <button
                        class="bg-slate-900 text-white px-8 py-4 rounded-2xl font-black uppercase text-[10px] tracking-widest hover:bg-blue-600 transition-all shadow-lg active:scale-95">
                        Konsultasi Kebutuhan Instansi →
                    </button>
                </div>
            </div>
        </div>
    </section>

    <section class="py-24 bg-slate-50 border-t border-slate-100">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16 space-y-2">
                <h2 class="text-3xl font-bold text-slate-900 italic uppercase">Service Ecosystem</h2>
                <p class="text-slate-500 uppercase text-[10px] font-black tracking-[0.3em]">Cakupan Layanan Pengembangan
                    Teknologi</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach ([['title' => 'Software House', 'desc' => 'Pengembangan web app, mobile app, dan sistem manajemen kustom.', 'icon' => 'M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z'], ['title' => 'IoT Integration', 'desc' => 'Sensor network, smart gate, hingga kontrol perangkat jarak jauh.', 'icon' => 'M13 10V3L4 14h7v7l9-11h-7z'], ['title' => 'Digital Branding', 'desc' => 'Strategi kehadiran digital instansi untuk jangkauan publik yang luas.', 'icon' => 'M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z']] as $item)
                    <div
                        class="bg-white p-10 rounded-[2.5rem] border border-slate-100 hover:shadow-xl transition-all group">
                        <div
                            class="bg-slate-50 w-14 h-14 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-blue-600 transition-colors">
                            <svg class="w-6 h-6 text-slate-800 group-hover:text-white" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="{{ $item['icon'] }}" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-black italic uppercase text-slate-800 mb-4">{{ $item['title'] }}</h3>
                        <p class="text-slate-500 text-sm leading-relaxed">{{ $item['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="py-24">
        <div class="max-w-4xl mx-auto px-6 text-center">
            <div class="bg-slate-900 rounded-[3.5rem] p-12 md:p-20 relative overflow-hidden shadow-2xl">
                <div class="absolute top-0 right-0 w-64 h-64 bg-blue-600/10 rounded-full -mr-32 -mt-32 blur-3xl"></div>
                <div class="absolute bottom-0 left-0 w-64 h-64 bg-blue-500/10 rounded-full -ml-32 -mb-32 blur-3xl">
                </div>

                <div class="relative z-10">
                    <h2
                        class="text-3xl md:text-5xl font-black text-white italic uppercase tracking-tighter mb-8 leading-tight">
                        Siap Membangun <br> <span class="text-blue-500">Masa Depan Digital?</span>
                    </h2>
                    <div class="flex flex-col md:flex-row justify-center gap-4">
                        <button
                            class="bg-white/10 text-white backdrop-blur-md px-10 py-5 rounded-2xl font-black uppercase text-[10px] tracking-[0.2em] hover:bg-white/20 transition-all border border-white/20">
                            Proposal Kerjasama
                        </button>
                    </div>
                    <p class="text-slate-500 text-[10px] font-bold uppercase tracking-widest mt-8">Cenari & Tebar Kode
                        Teknologi</p>
                </div>
            </div>
        </div>
    </section>
</div>
