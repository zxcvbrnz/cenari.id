<section class="py-24 bg-[#F8FAFC]">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-heading font-black text-slate-900 mb-4 italic uppercase tracking-tighter">Live
                Portfolio Gallery</h2>
            <p class="text-slate-500 max-w-2xl mx-auto italic font-medium">
                Bukan sekadar teori. Lihat bagaimana siswa kami menggabungkan desain, kode, dan mesin menjadi satu karya
                utuh.
            </p>
        </div>

        <div class="flex flex-wrap justify-center gap-3 mb-12">
            <button wire:click="setFilter('all')"
                class="px-6 py-3 rounded-full text-[10px] font-black uppercase tracking-[0.2em] transition-all duration-300 border
                {{ $filter === 'all' ? 'bg-slate-900 text-white border-slate-900 shadow-xl' : 'bg-white text-slate-400 border-slate-100 hover:border-slate-300' }}">
                Semua Karya
            </button>

            @foreach ($categories as $category)
                <button wire:click="setFilter({{ $category->id }})"
                    class="px-6 py-3 rounded-full text-[10px] font-black uppercase tracking-[0.2em] transition-all duration-300 border
                    {{ (int) $filter === $category->id
                        ? 'bg-slate-900 text-white border-slate-900 shadow-xl'
                        : 'bg-white text-slate-400 border-slate-100 hover:border-slate-300' }}">
                    {{ $category->name }}
                </button>
            @endforeach
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8"
            wire:loading.class="opacity-50 transition-opacity">
            @foreach ($projects as $project)
                <div wire:key="portfolio-{{ $project->id }}"
                    class="group bg-white rounded-[2.5rem] overflow-hidden border border-slate-100 shadow-sm hover:shadow-2xl transition-all duration-500 flex flex-col h-full">

                    <div class="relative h-64 overflow-hidden">
                        {{-- Logika Gambar: Gunakan is_featured, jika tidak ada gunakan gambar pertama, jika kosong gunakan placeholder --}}
                        @php
                            $displayImage = $project->featuredImage
                                ? asset('storage/' . $project->featuredImage->filename)
                                : ($project->images->first()
                                    ? asset('storage/' . $project->images->first()->filename)
                                    : 'https://via.placeholder.com/600x400');
                        @endphp

                        <img src="{{ $displayImage }}"
                            class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">

                        <div class="absolute top-6 left-6 flex flex-wrap gap-2">
                            @foreach ($project->categories as $cat)
                                <span
                                    class="px-3 py-1.5 rounded-xl text-[8px] font-black uppercase tracking-widest backdrop-blur-md bg-white/80 text-slate-900 border border-white/20">
                                    {{ $cat->name }}
                                </span>
                            @endforeach
                        </div>
                    </div>

                    <div class="p-8 flex flex-col flex-grow">
                        <div class="mb-4">
                            <p class="text-[10px] font-black text-blue-600 uppercase tracking-[0.2em] mb-1">
                                {{ $project->author }}
                            </p>
                            <h3 class="text-xl font-bold text-slate-900 group-hover:text-blue-600 transition-colors">
                                {{ $project->title }}
                            </h3>
                        </div>

                        <p class="text-slate-500 text-sm leading-relaxed mb-6 flex-grow line-clamp-3">
                            {{ $project->description }}
                        </p>

                        <div class="flex flex-wrap gap-2 pt-6 border-t border-slate-50">
                            @if ($project->tech)
                                @foreach ($project->tech as $t)
                                    <span
                                        class="text-[9px] font-bold bg-slate-50 text-slate-400 px-2 py-1 rounded-md italic group-hover:bg-blue-50 group-hover:text-blue-400 transition-colors">
                                        #{{ trim($t) }}
                                    </span>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Empty State --}}
        @if ($projects->isEmpty())
            <div class="text-center py-20 bg-white rounded-[3rem] border-2 border-dashed border-slate-100">
                <div class="mb-4 flex justify-center text-slate-200">
                    <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"
                            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
                <p class="text-slate-400 italic font-medium">Belum ada karya untuk kategori ini.</p>
            </div>
        @endif
    </div>
</section>
