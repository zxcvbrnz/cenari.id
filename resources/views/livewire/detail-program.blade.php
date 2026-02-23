<div class="bg-white min-h-screen">
    <section class="relative h-[70vh] flex items-center bg-[#0F172A] overflow-hidden">
        <div class="absolute inset-0">
            <img src="{{ $program->hero_image }}" class="w-full h-full object-cover opacity-30 scale-105">
            <div class="absolute inset-0 bg-gradient-to-r from-[#0F172A] via-[#0F172A]/80 to-transparent"></div>
        </div>

        <div class="max-w-7xl mx-auto px-6 relative z-10 w-full">
            <div class="flex items-center gap-3 mb-6">
                <span class="w-12 h-[2px]" style="background-color: {{ $program->accent_color }}"></span>
                <span class="text-xs font-black uppercase tracking-[0.4em] text-white/60">
                    {{ is_array($program->category) ? implode(' + ', $program->category) : $program->category }}
                </span>
            </div>
            <h1 class="text-5xl md:text-7xl font-heading font-black text-white mb-8 leading-tight max-w-4xl">
                {{ $program->title }}
            </h1>
            <div class="flex flex-wrap gap-4">
                @foreach ($program->badges as $badge)
                    <span
                        class="px-6 py-2 rounded-full border border-white/20 bg-white/5 text-white text-[10px] font-bold uppercase tracking-widest backdrop-blur-md">
                        {{ $badge }}
                    </span>
                @endforeach
            </div>
        </div>
    </section>

    <section class="py-24 max-w-7xl mx-auto px-6">
        <div class="grid lg:grid-cols-12 gap-20">

            <div class="lg:col-span-7">
                <h2 class="font-heading text-3xl font-bold mb-12 flex items-center gap-4 italic">
                    Curriculum Path
                    <span class="h-[1px] flex-grow bg-slate-100"></span>
                </h2>

                <div class="space-y-6" x-data="{ activeAccordion: 1 }">
                    @foreach ($program->coursePackages as $index => $package)
                        <div class="group p-8 rounded-[2rem] border transition-all duration-500 bg-white"
                            :class="activeAccordion === {{ $package->level }} ? 'border-slate-900 shadow-xl' :
                                'border-slate-100'">

                            <div class="flex gap-8 cursor-pointer"
                                @click="activeAccordion = (activeAccordion === {{ $package->level }} ? null : {{ $package->level }})">
                                <span class="text-5xl font-black transition-colors duration-500"
                                    :class="activeAccordion === {{ $package->level }} ? 'text-slate-900' :
                                        'text-slate-100 group-hover:text-slate-300'">
                                    0{{ $package->level }}
                                </span>

                                <div class="flex-grow">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <h4 class="text-xl font-bold text-slate-900 mb-2">{{ $package->name }}</h4>
                                            <p class="text-slate-500 mb-4">{{ $package->description }}</p>
                                        </div>
                                        <svg class="w-6 h-6 text-slate-300 transition-transform duration-300"
                                            :class="activeAccordion === {{ $package->level }} ? 'rotate-180 text-slate-900' :
                                                ''"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </div>

                                    <div class="flex flex-wrap gap-3">
                                        <span
                                            class="px-3 py-1 bg-slate-50 text-slate-400 text-[10px] font-bold uppercase rounded-lg border border-slate-100">
                                            Tools: {{ $package->tool }}
                                        </span>
                                        <span
                                            class="px-3 py-1 bg-blue-50 text-[#3B82F6] text-[10px] font-bold uppercase rounded-lg">
                                            {{ $package->course_count }} Sesi
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div x-show="activeAccordion === {{ $package->level }}" x-collapse x-cloak>
                                <div class="mt-8 pt-8 border-t border-slate-50">
                                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-6">
                                        <div>
                                            <p
                                                class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-1">
                                                Priece</p>
                                            <p class="text-lg font-bold text-slate-900">Rp
                                                {{ number_format($package->price, 0, ',', '.') }}</p>
                                        </div>
                                        <div>
                                            <p
                                                class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-1">
                                                Durasi /Pertemuan</p>
                                            <p class="text-lg font-bold text-slate-900">{{ $package->course_during }}
                                                Jam
                                            </p>
                                        </div>
                                        <div>
                                            <p
                                                class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-1">
                                                Total Pertemuan</p>
                                            <p class="text-lg font-bold text-slate-900">{{ $package->course_count }}x
                                            </p>
                                        </div>
                                        {{-- <div>
                                            <p
                                                class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-1">
                                                Kesulitan</p>
                                            <p class="text-lg font-bold text-slate-900">Level {{ $package->level }}</p>
                                        </div> --}}
                                    </div>

                                    <div class="mt-8 flex justify-end">
                                        <a href="{{ route('program.course.detail', ['slug' => $program->slug, 'course_slug' => $package->slug]) }}"
                                            class="px-8 py-3 bg-slate-900 text-white text-[11px] font-bold uppercase tracking-widest rounded-xl hover:bg-[#3B82F6] transition-colors flex items-center gap-2">
                                            Lihat Detail
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path d="M13 7l5 5m0 0l-5 5m5-5H6" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="lg:col-span-5">
                <div class="sticky top-12">
                    @if ($missingLink)
                        <div class="relative p-10 rounded-[3rem] bg-[#0F172A] text-white overflow-hidden shadow-2xl">
                            <div class="absolute top-0 right-0 w-40 h-40 blur-[80px] opacity-30"
                                style="background-color: {{ $program->accent_color }}"></div>

                            <div class="relative z-10">
                                <div class="mb-10 inline-flex items-center gap-2">
                                    <div class="w-2 h-2 rounded-full animate-ping"
                                        style="background-color: {{ $program->accent_color }}"></div>
                                    <span class="text-[10px] font-black uppercase tracking-widest text-white/50">
                                        The Missing Link
                                    </span>
                                </div>

                                <p class="text-2xl font-medium leading-relaxed mb-12 italic">
                                    "{{ $missingLink->text }}"
                                </p>

                                <a href="{{ url('programs/' . $missingLink->url) }}"
                                    class="group flex items-center justify-between p-6 bg-white rounded-2xl text-[#0F172A] font-bold transition-all hover:scale-[1.02] active:scale-95">
                                    <span class="uppercase tracking-widest text-xs">{{ $missingLink->cta }}</span>
                                    <svg class="w-5 h-5 group-hover:translate-x-2 transition-transform" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path d="M17 8l4 4m0 0l-4 4m4-4H3" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </section>
</div>
