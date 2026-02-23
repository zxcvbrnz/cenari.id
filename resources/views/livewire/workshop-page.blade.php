<div class="min-h-screen bg-[#FBFDFF] py-20 px-6">
    <div class="max-w-7xl mx-auto">

        <div class="mb-16 text-center">
            <h1 class="text-4xl md:text-5xl font-black text-slate-900 mb-4 tracking-tighter">
                UPCOMING <span class="text-[#3B82F6]">EVENTS</span>
            </h1>
            <p class="text-slate-500 max-w-xl mx-auto text-sm leading-relaxed">
                Tingkatkan skill teknis Anda melalui workshop, seminar, dan bootcamp intensif bersama para ahli di
                bidangnya.
            </p>
        </div>

        <div class="flex flex-wrap justify-center gap-3 mb-12">
            @foreach (['all' => 'Semua', 'Workshop' => 'Workshop', 'Seminar' => 'Seminar', 'Bootcamp' => 'Bootcamp'] as $key => $label)
                <button wire:click="$set('filterType', '{{ $key }}')"
                    class="px-6 py-2.5 rounded-full text-[10px] font-black uppercase tracking-widest transition-all
                    {{ $filterType == $key ? 'bg-slate-900 text-white shadow-xl shadow-slate-200' : 'bg-white text-slate-400 border border-slate-100 hover:border-slate-300' }}">
                    {{ $label }}
                </button>
            @endforeach
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse ($workshops as $item)
                @php
                    $detailUrl = route('workshop.detail', ['slug' => $item->slug]);
                @endphp

                <div
                    class="group/card flex flex-col bg-white rounded-[2.5rem] border border-slate-100 overflow-hidden hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 transform-gpu">

                    <div class="relative h-64 overflow-hidden">
                        <img src="{{ $item->image }}" alt="{{ $item->title }}"
                            class="w-full h-full object-cover transition-transform duration-700 group-hover/card:scale-110">
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-transparent to-transparent opacity-60">
                        </div>

                        <div class="absolute top-6 left-6">
                            <span
                                class="px-4 py-1.5 rounded-full text-white text-[10px] font-black uppercase tracking-wider shadow-lg"
                                style="background-color: {{ $item->color }}">
                                {{ $item->type }}
                            </span>
                        </div>

                        <button @click="navigator.clipboard.writeText('{{ $detailUrl }}'); alert('Link copied!')"
                            class="absolute top-6 right-6 w-10 h-10 rounded-2xl bg-white/10 backdrop-blur-md border border-white/20 text-white flex items-center justify-center hover:bg-white hover:text-slate-900 transition-all z-20">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </button>
                    </div>

                    <div class="p-8 flex flex-col flex-grow">
                        <div class="flex items-center gap-3 mb-4 text-slate-400">
                            <div class="flex items-center gap-1.5 bg-slate-50 px-3 py-1 rounded-lg">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <span class="text-[10px] font-bold uppercase">{{ $item->date_string }}</span>
                            </div>
                            <span class="text-[10px] font-bold uppercase text-emerald-500">{{ $item->status }}</span>
                        </div>

                        <a href="{{ $detailUrl }}" wire:navigate
                            class="block group-hover/card:translate-x-1 transition-transform">
                            <h3
                                class="text-xl font-bold text-slate-900 group-hover/card:text-[#3B82F6] transition-colors leading-tight mb-4">
                                {{ $item->title }}
                            </h3>
                        </a>

                        <p class="text-slate-400 text-sm mb-8 line-clamp-2">Ikuti sesi interaktif ini secara
                            {{ $item->type == 'Seminar' ? 'Online' : 'Tatap Muka' }} mulai pukul
                            {{ $item->time_string }}.</p>

                        <div class="mt-auto pt-6 border-t border-slate-50 flex items-center justify-between">
                            <div>
                                <p class="text-[9px] font-black uppercase tracking-widest text-slate-300 mb-1">
                                    Registration Fee</p>
                                <p class="text-xl font-black text-slate-900">{{ $item->price }}</p>
                            </div>

                            <a href="{{ $detailUrl }}" wire:navigate
                                class="h-12 px-8 flex items-center justify-center rounded-2xl bg-slate-900 text-white text-[10px] font-bold uppercase tracking-widest hover:bg-[#3B82F6] hover:shadow-xl hover:shadow-blue-500/20 transition-all active:scale-95">
                                Detail
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-20 text-center">
                    <p class="text-slate-400 font-bold uppercase tracking-widest text-xs">Belum ada acara tersedia.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
