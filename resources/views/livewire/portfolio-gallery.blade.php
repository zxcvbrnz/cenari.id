<section class="py-24 bg-[#F8FAFC]">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-heading font-black text-slate-900 mb-4">Live Portfolio Gallery</h2>
            <p class="text-slate-500 max-w-2xl mx-auto italic">
                Bukan sekadar teori. Lihat bagaimana siswa kami menggabungkan desain, kode, dan mesin menjadi satu karya
                utuh.
            </p>
        </div>

        <div class="flex flex-wrap justify-center gap-3 mb-12">
            @foreach ([
        'all' => 'Semua Karya',
        'software' => 'Software Only',
        'hardware' => 'Hardware Only',
        'hybrid' => 'Hybrid Project',
    ] as $key => $label)
                <button wire:click="setFilter('{{ $key }}')"
                    class="px-6 py-3 rounded-full text-xs font-black uppercase tracking-widest transition-all duration-300 border
                    {{ $filter === $key
                        ? 'bg-slate-900 text-white border-slate-900 shadow-xl'
                        : 'bg-white text-slate-400 border-slate-100 hover:border-slate-300' }}">
                    {{ $label }}
                </button>
            @endforeach
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($projects as $project)
                <div wire:key="{{ $project['title'] }}" x-data="{ hover: false }" @mouseenter="hover = true"
                    @mouseleave="hover = false"
                    class="group bg-white rounded-[2.5rem] overflow-hidden border border-slate-100 shadow-sm hover:shadow-2xl transition-all duration-500 flex flex-col h-full">
                    <div class="relative h-64 overflow-hidden">
                        <img src="{{ $project['image'] }}"
                            class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">

                        <div class="absolute top-6 left-6">
                            <span
                                class="px-4 py-2 rounded-xl text-[9px] font-black uppercase tracking-widest backdrop-blur-md 
                                {{ $project['category'] === 'hybrid' ? 'bg-blue-600/80 text-white' : 'bg-white/80 text-slate-900' }}">
                                {{ $project['category'] }}
                            </span>
                        </div>
                    </div>

                    <div class="p-8 flex flex-col flex-grow">
                        <div class="mb-4">
                            <p class="text-[10px] font-bold text-blue-600 uppercase tracking-widest mb-1">
                                {{ $project['author'] }}</p>
                            <h3 class="text-xl font-bold text-slate-900">{{ $project['title'] }}</h3>
                        </div>

                        <p class="text-slate-500 text-sm leading-relaxed mb-6 flex-grow">
                            {{ $project['desc'] }}
                        </p>

                        <div class="flex flex-wrap gap-2 pt-6 border-t border-slate-50">
                            @foreach ($project['tech'] as $t)
                                <span
                                    class="text-[9px] font-bold bg-slate-50 text-slate-400 px-2 py-1 rounded-md italic">#{{ $t }}</span>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        @if (count($projects) == 0)
            <div class="text-center py-20 bg-white rounded-[3rem] border-2 border-dashed border-slate-100">
                <p class="text-slate-400 italic">Belum ada karya untuk kategori ini.</p>
            </div>
        @endif
    </div>
</section>
