<div class="min-h-screen bg-white pb-20">
    <div class="relative h-[450px] w-full overflow-hidden">
        <img src="{{ $workshop->image }}" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-[2px]"></div>

        <div class="absolute inset-0 flex items-center max-w-7xl mx-auto px-6">
            <div class="max-w-3xl">
                <span
                    class="px-4 py-1.5 rounded-full text-white text-[10px] font-black uppercase tracking-widest mb-6 inline-block"
                    style="background-color: {{ $workshop->color }}">
                    {{ $workshop->type }}
                </span>
                <h1 class="text-4xl md:text-5xl font-black text-white leading-tight tracking-tighter">
                    {{ $workshop->title }}
                </h1>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-6 -mt-20 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            <div class="lg:col-span-2">
                <div class="bg-white p-10 rounded-[2.5rem] border border-slate-100 shadow-sm">
                    <h2 class="text-xl font-black text-slate-900 mb-6 uppercase tracking-tight italic">Deskripsi Event
                    </h2>
                    <div class="text-slate-500 leading-relaxed space-y-4">
                        <p>Event <strong>{{ $workshop->title }}</strong> ini akan dilaksanakan pada tanggal
                            <strong>{{ $workshop->date_string }}</strong>.</p>
                        <p>Segera daftarkan diri Anda untuk mendapatkan materi eksklusif dan sertifikat resmi dari
                            CENARIID.</p>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-1">
                <div class="sticky top-24 bg-white p-8 rounded-[2.5rem] border border-slate-200 shadow-xl">
                    <p class="text-[10px] font-black uppercase text-slate-400 mb-1">Investasi</p>
                    <h3 class="text-3xl font-black text-slate-900 mb-6">{{ $workshop->price }}</h3>

                    <div class="space-y-4 mb-8">
                        <div class="flex justify-between text-[11px] font-bold uppercase tracking-widest border-b pb-3">
                            <span class="text-slate-400">Waktu</span>
                            <span class="text-slate-900">{{ $workshop->time_string }}</span>
                        </div>
                        <div class="flex justify-between text-[11px] font-bold uppercase tracking-widest border-b pb-3">
                            <span class="text-slate-400">Status</span>
                            <span class="text-emerald-500">{{ $workshop->status }}</span>
                        </div>
                    </div>

                    <button
                        class="w-full bg-[#3B82F6] text-white py-4 rounded-2xl font-black uppercase text-[10px] tracking-widest hover:bg-slate-900 transition-all">
                        Daftar Sekarang
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
