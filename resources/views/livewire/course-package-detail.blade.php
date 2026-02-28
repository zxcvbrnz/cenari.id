<div class="min-h-screen bg-[#FBFDFF] py-12">
    <div class="max-w-7xl mx-auto px-6">

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
                        Materi Pembelajaran
                    </h2>

                    @if ($package->moduls)
                        <div
                            class="bg-white border border-slate-100 rounded-[2rem] p-8 md:p-10 shadow-sm relative overflow-hidden">
                            <span
                                class="absolute -top-4 -right-4 text-8xl font-black text-slate-50 italic opacity-50 select-none">01</span>

                            <div class="relative">
                                <h3 class="text-2xl font-black text-slate-800 tracking-tight mb-6">
                                    {{ $package->moduls->title }}
                                </h3>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-y-4 gap-x-8">
                                    @foreach (['text_1', 'text_2', 'text_3', 'text_4'] as $field)
                                        @if ($package->moduls->$field)
                                            <div
                                                class="flex items-start gap-4 p-4 rounded-2xl bg-slate-50 border border-slate-100/50 transition-colors hover:bg-white hover:border-blue-100">
                                                <div
                                                    class="mt-1 w-5 h-5 rounded-full bg-blue-500 flex items-center justify-center shrink-0 shadow-lg shadow-blue-200">
                                                    <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path d="M5 13l4 4L19 7" stroke-width="3" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                    </svg>
                                                </div>
                                                <span class="text-sm text-slate-600 font-bold leading-relaxed">
                                                    {{ $package->moduls->$field }}
                                                </span>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="p-8 border-2 border-dashed border-slate-100 rounded-[2rem] text-center">
                            <p class="text-slate-400 text-sm font-medium italic">Detail materi belum tersedia untuk
                                paket ini.</p>
                        </div>
                    @endif
                </div>
            </div>

            @if ($package->kitRobotics)
                <div class="mt-16 space-y-8">
                    <h2 class="text-xl font-black text-slate-900 uppercase tracking-tight flex items-center gap-3">
                        <span class="w-8 h-[2px] bg-emerald-500"></span>
                        Starter Kit Robotik
                    </h2>

                    <div
                        class="bg-white border border-slate-100 rounded-[2.5rem] p-8 md:p-10 shadow-sm relative overflow-hidden group">
                        <div
                            class="absolute top-0 right-0 w-64 h-64 bg-slate-50 rounded-full -mr-32 -mt-32 transition-transform group-hover:scale-110">
                        </div>

                        <div class="relative grid grid-cols-1 md:grid-cols-12 gap-10 items-center">
                            <div class="md:col-span-4 lg:col-span-3">
                                <div
                                    class="aspect-square bg-slate-900 rounded-[2rem] flex items-center justify-center shadow-2xl relative overflow-hidden">
                                    <svg class="w-20 h-20 text-white/20 absolute -bottom-5 -right-5 rotate-12"
                                        fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                                    </svg>
                                    <div class="text-center p-6">
                                        <svg class="w-16 h-16 text-[#3B82F6] mx-auto mb-4" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z" />
                                        </svg>
                                        <span
                                            class="text-[10px] font-black text-white/40 uppercase tracking-[0.3em]">Hardware
                                            Kit</span>
                                    </div>
                                </div>
                            </div>

                            <div class="md:col-span-8 lg:col-span-9">
                                <div class="flex flex-wrap items-center gap-3 mb-4">
                                    <h3 class="text-2xl font-black text-slate-900 tracking-tight">
                                        {{ $package->kitRobotics->name }}</h3>
                                    @if ($package->kitRobotics->discount > 0)
                                        <span
                                            class="px-3 py-1 bg-rose-50 text-rose-500 text-[10px] font-black rounded-lg">Hemat
                                            {{ $package->kitRobotics->discount }}%</span>
                                    @endif
                                </div>

                                <p class="text-slate-500 text-sm leading-relaxed mb-8 max-w-xl italic">
                                    "{{ $package->kitRobotics->description ?? 'Kit hardware lengkap yang dirancang khusus untuk menunjang modul praktik langsung di kelas ini.' }}"
                                </p>

                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    @if ($package->kitRobotics->pelatihan_price)
                                        <div
                                            class="bg-slate-50 p-5 rounded-2xl border border-slate-100 transition-colors hover:border-[#3B82F6]/30">
                                            <p class="text-[9px] font-black uppercase text-slate-400 mb-1">Upgrade
                                                Pelatihan</p>
                                            <p class="text-lg font-black text-slate-900">+ Rp
                                                {{ number_format($package->kitRobotics->pelatihan_price, 0, ',', '.') }}
                                            </p>
                                        </div>
                                    @endif

                                    @if ($package->kitRobotics->private_price)
                                        <div
                                            class="bg-slate-50 p-5 rounded-2xl border border-slate-100 transition-colors hover:border-[#3B82F6]/30">
                                            <p class="text-[9px] font-black uppercase text-slate-400 mb-1">Opsi Private
                                            </p>
                                            <p class="text-lg font-black text-slate-900">+ Rp
                                                {{ number_format($package->kitRobotics->private_price, 0, ',', '.') }}
                                            </p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

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
