<div class="min-h-screen bg-[#F8FAFC] py-20 px-6">
    <div class="max-w-7xl mx-auto">
        <div class="mb-20 text-center">
            <h1 class="text-4xl md:text-5xl font-black text-slate-900 mb-4 tracking-tight uppercase italic">
                Our <span class="text-blue-600">Learning Path</span>
            </h1>
            <p class="text-slate-500 max-w-2xl mx-auto">Pilih program spesialisasi Anda dan mulai perjalanan belajar dari
                tingkat dasar hingga profesional.</p>
        </div>

        @foreach ($programs as $program)
            <div class="mb-24 last:mb-0">
                <div
                    class="flex flex-col md:flex-row md:items-end justify-between mb-10 gap-6 border-b border-slate-200 pb-8">
                    <div class="flex items-start gap-6">
                        <div class="w-16 h-16 rounded-2xl flex items-center justify-center bg-white shadow-sm border border-slate-100 shrink-0"
                            style="color: {{ $program->accent_color }}">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="{{ $program->icon }}" />
                            </svg>
                        </div>
                        <div>
                            <div class="flex items-center gap-3 mb-2">
                                @foreach ($program->category ?? [] as $cat)
                                    <span
                                        class="text-[10px] font-black uppercase tracking-widest text-blue-600 bg-blue-50 px-3 py-1 rounded-full">
                                        {{ $cat }}
                                    </span>
                                @endforeach
                            </div>
                            <h2 class="text-3xl font-bold text-slate-900">{{ $program->title }}</h2>
                        </div>
                    </div>

                    <div class="flex gap-2">
                        @foreach ($program->badges ?? [] as $badge)
                            <span
                                class="text-[10px] font-bold text-slate-400 border border-slate-200 px-3 py-1 rounded-lg">
                                {{ $badge }}
                            </span>
                        @endforeach
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($program->coursePackages as $package)
                        <div
                            class="group relative bg-white rounded-[2.5rem] border border-slate-100 p-8 shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 flex flex-col transform-gpu">

                            <div class="mb-6">
                                <span
                                    class="text-[10px] font-black uppercase tracking-widest {{ $package->level > 2 ? 'text-purple-600 bg-purple-50' : 'text-emerald-600 bg-emerald-50' }} px-4 py-1.5 rounded-full">
                                    Level {{ $package->level }}
                                </span>
                            </div>

                            <h3
                                class="text-2xl font-bold text-slate-900 mb-4 group-hover:text-blue-600 transition-colors">
                                {{ $package->name }}
                            </h3>

                            <p class="text-slate-400 text-sm leading-relaxed mb-8 line-clamp-3">
                                {{ $package->description }}
                            </p>

                            <div class="grid grid-cols-2 gap-4 mb-8 pt-6 border-t border-slate-50">
                                <div class="flex items-center gap-2 text-slate-500">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <span class="text-xs font-bold">{{ $package->course_count }} Sesi</span>
                                </div>
                                <div class="flex items-center gap-2 text-slate-500">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <span class="text-xs font-bold">{{ $package->course_during }} Menit</span>
                                </div>
                                <div class="flex items-center gap-2 text-slate-500 col-span-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M11 4a2 2 0 114 0v1a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-1a2 2 0 100 4h1a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-1a2 2 0 10-4 0v1a1 1 0 01-1 1H7a1 1 0 01-1-1v-3a1 1 0 011-1h1a2 2 0 100-4H7a1 1 0 01-1-1V7a1 1 0 011-1h3a1 1 0 001-1V4z"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <span class="text-xs font-bold">{{ $package->tool }}</span>
                                </div>
                            </div>

                            <div class="mt-auto flex items-center justify-between">
                                <div>
                                    <p class="text-[10px] font-black text-slate-300 uppercase tracking-widest mb-1">
                                        Investasi</p>
                                    <p class="text-2xl font-black text-slate-900">Rp
                                        {{ number_format($package->price, 0, ',', '.') }}</p>
                                </div>
                                <a href="#"
                                    class="w-12 h-12 rounded-2xl bg-slate-900 text-white flex items-center justify-center hover:bg-blue-600 transition-all shadow-lg shadow-slate-200 transform active:scale-90">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path d="M14 5l7 7m0 0l-7 7m7-7H3" stroke-width="2.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
</div>
