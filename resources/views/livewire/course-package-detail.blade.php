<div class="min-h-screen bg-[#FBFDFF] py-12">
    <div class="max-w-7xl mx-auto px-6">

        {{-- <a href="{{ route('course.packages') }}" wire:navigate
            class="inline-flex items-center gap-2 text-slate-400 hover:text-[#3B82F6] transition-colors mb-8 group">
            <svg class="w-4 h-4 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path d="M15 19l-7-7 7-7" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            <span class="text-[10px] font-black uppercase tracking-[0.2em]">Kembali ke Paket</span>
        </a> --}}

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">

            <div class="lg:col-span-8">
                <div class="mb-10">
                    <div class="flex items-center gap-3 mb-4">
                        <span
                            class="px-3 py-1 bg-blue-50 text-[#3B82F6] text-[10px] font-black uppercase tracking-widest rounded-lg">Level
                            {{ $package->level }}</span>
                        <span class="text-slate-300">•</span>
                        <span
                            class="text-slate-500 text-[10px] font-bold uppercase tracking-widest">{{ $package->program->name ?? 'Program' }}</span>
                    </div>
                    <h1 class="text-4xl md:text-5xl font-black text-slate-900 tracking-tighter mb-6 leading-tight">
                        {{ $package->name }}
                    </h1>
                    <p class="text-slate-500 text-lg leading-relaxed max-w-2xl">
                        {{ $package->description }}
                    </p>
                </div>

                <div class="space-y-6">
                    <h2 class="text-xl font-black text-slate-900 uppercase tracking-tight flex items-center gap-3">
                        <span class="w-8 h-[2px] bg-[#3B82F6]"></span>
                        Kurikulum Pembelajaran
                    </h2>

                    <div class="grid gap-4">
                        @foreach ($package->moduls as $index => $module)
                            <div x-data="{ open: false }"
                                class="bg-white border border-slate-100 rounded-[1.5rem] overflow-hidden transition-all hover:shadow-md">
                                <button @click="open = !open"
                                    class="w-full px-8 py-6 flex items-center justify-between text-left">
                                    <div class="flex items-center gap-6">
                                        <span
                                            class="text-2xl font-black text-slate-100 italic">0{{ $index + 1 }}</span>
                                        <h3 class="font-bold text-slate-800 tracking-tight">{{ $module->title }}</h3>
                                    </div>
                                    <svg class="w-5 h-5 text-slate-400 transition-transform duration-300"
                                        :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path d="M19 9l-7 7-7-7" stroke-width="2" />
                                    </svg>
                                </button>

                                <div x-show="open" x-collapse x-cloak>
                                    <div class="px-8 pb-8 ml-14 grid grid-cols-1 md:grid-cols-2 gap-4">
                                        @foreach (['text_1', 'text_2', 'text_3', 'text_4'] as $field)
                                            @if ($module->$field)
                                                <div class="flex items-start gap-3">
                                                    <div class="mt-1.5 w-1.5 h-1.5 rounded-full bg-[#3B82F6] shrink-0">
                                                    </div>
                                                    <span
                                                        class="text-sm text-slate-500 font-medium">{{ $module->$field }}</span>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="lg:col-span-4">
                <div class="sticky top-28 space-y-6">
                    <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-2xl shadow-slate-200/50">
                        <p class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 mb-2">Total Investasi
                        </p>
                        <div class="mb-8">
                            <h3 class="text-4xl font-black text-slate-900 leading-none tracking-tighter">
                                Rp {{ number_format($package->price, 0, ',', '.') }}
                            </h3>
                        </div>

                        <div class="grid grid-cols-2 gap-4 mb-8">
                            <div class="p-4 bg-slate-50 rounded-2xl">
                                <p class="text-[9px] font-black uppercase text-slate-400 mb-1">Pertemuan</p>
                                <p class="text-sm font-bold text-slate-900">{{ $package->course_count }} Sesi</p>
                            </div>
                            <div class="p-4 bg-slate-50 rounded-2xl">
                                <p class="text-[9px] font-black uppercase text-slate-400 mb-1">Durasi /Pertemuan</p>
                                <p class="text-sm font-bold text-slate-900">{{ $package->course_during }} Jam</p>
                            </div>
                        </div>

                        @if ($package->tool)
                            <div class="mb-8 p-5 border border-dashed border-slate-200 rounded-2xl">
                                <p class="text-[9px] font-black uppercase text-slate-400 mb-3">Software / Tools</p>
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-8 h-8 bg-slate-900 rounded-lg flex items-center justify-center text-white">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="M11 4a2 2 0 114 0v1a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-1a2 2 0 100 4h1a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-1a2 2 0 10-4 0v1a1 1 0 01-1 1H7a1 1 0 01-1-1v-3a1 1 0 00-1-1H4a2 2 0 110-4h1a1 1 0 001-1V7a1 1 0 011-1h3a1 1 0 001-1V4z"
                                                stroke-width="2" />
                                        </svg>
                                    </div>
                                    <span
                                        class="text-sm font-black text-slate-800 uppercase tracking-tight">{{ $package->tool }}</span>
                                </div>
                            </div>
                        @endif

                        <button
                            class="w-full bg-[#3B82F6] text-white py-5 rounded-2xl font-black uppercase tracking-[0.2em] text-[11px] hover:bg-slate-900 transition-all shadow-lg shadow-blue-500/20 active:scale-95">
                            Daftar Kelas
                        </button>
                    </div>

                    <div class="p-6 bg-emerald-50 rounded-3xl border border-emerald-100 flex items-center gap-4">
                        <div
                            class="w-10 h-10 rounded-full bg-emerald-500 flex items-center justify-center text-white shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" stroke-width="2.5" />
                            </svg>
                        </div>
                        <p class="text-[11px] font-bold text-emerald-800 leading-relaxed uppercase tracking-tight">
                            Sertifikat Kelulusan & module pembelajaran
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
