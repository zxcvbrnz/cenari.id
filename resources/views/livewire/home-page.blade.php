<div>
    <div class="h-[85vh] w-full bg-[#080C15] relative overflow-hidden flex flex-col">

        <section class="relative h-full w-full bg-[#0F172A] overflow-hidden group/hero font-inter"
            style="--split: 50%; --gap: 150px;">

            <div class="absolute inset-y-0 right-0 z-10 transition-all duration-700 ease-in-out group/right"
                style="width: 100%; clip-path: polygon(calc(var(--split) + (var(--gap) / 2)) 0, 100% 0, 100% 100%, calc(var(--split) - (var(--gap) / 2)) 100%);"
                onmouseover="this.closest('section').style.setProperty('--split', '35%')"
                onmouseleave="this.closest('section').style.setProperty('--split', '50%')">

                <div
                    class="absolute inset-0 bg-[#0F172A]/50 z-20 transition-opacity duration-500 group-hover/right:opacity-10">
                </div>

                <div class="absolute inset-0 bg-cover bg-center grayscale transition-all duration-1000 group-hover/right:grayscale-0 group-hover/right:scale-110 opacity-70 group-hover/right:opacity-100"
                    style="background-image: url('https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?q=80&w=2070');">
                </div>

                <div
                    class="relative z-30 flex h-full flex-col justify-center pr-20 text-right text-white pointer-events-none transition-transform duration-700 group-hover/right:-translate-x-12">
                    <p class="text-[#84CC16] text-[10px] font-black tracking-[0.4em] uppercase mb-2">Hardware</p>
                    <h2 class="font-heading text-4xl md:text-5xl font-black tracking-tighter opacity-80">
                        PHYSICAL<br />RESPONSE</h2>
                </div>
            </div>

            <div class="absolute inset-y-0 left-0 z-20 transition-all duration-700 ease-in-out group/left"
                style="width: 100%; clip-path: polygon(0 0, calc(var(--split) + (var(--gap) / 2)) 0, calc(var(--split) - (var(--gap) / 2)) 100%, 0% 100%);"
                onmouseover="this.closest('section').style.setProperty('--split', '65%')"
                onmouseleave="this.closest('section').style.setProperty('--split', '50%')">

                <div
                    class="absolute inset-0 bg-[#0F172A]/40 z-20 transition-opacity duration-500 group-hover/left:opacity-10">
                </div>

                <div class="absolute inset-0 bg-cover bg-center grayscale transition-all duration-1000 group-hover/left:grayscale-0 group-hover/left:scale-110 opacity-80 group-hover/left:opacity-100"
                    style="background-image: url('https://images.unsplash.com/photo-1555066931-4365d14bab8c?q=80&w=2070');">
                </div>

                <div
                    class="relative z-30 flex h-full flex-col justify-center pl-20 text-white pointer-events-none transition-transform duration-700 group-hover/left:translate-x-12">
                    <p class="text-[#3B82F6] text-[10px] font-black tracking-[0.4em] uppercase mb-2">Software</p>
                    <h2 class="font-heading text-4xl md:text-5xl font-black tracking-tighter opacity-80">THE
                        LIVING<br />CODE</h2>
                </div>
            </div>

            <div class="absolute inset-y-0 z-40 pointer-events-none transition-all duration-700 ease-in-out"
                style="left: var(--split); transform: translateX(-50%); width: var(--gap);">
                <svg class="h-full w-full overflow-visible" preserveAspectRatio="none" viewBox="0 0 100 100">
                    <line x1="100" y1="0" x2="0" y2="100" stroke="#84CC16"
                        stroke-width="0.5" class="drop-shadow-[0_0_15px_#84CC16]" />
                </svg>
                <div
                    class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 h-4 w-4 rounded-full bg-white shadow-[0_0_25px_#84CC16] border-[4px] border-[#84CC16]">
                </div>
            </div>

            <div class="absolute inset-x-0 bottom-12 z-50 flex justify-center px-6">
                <div
                    class="bg-[#0F172A]/70 backdrop-blur-2xl border border-white/10 p-5 md:p-7 rounded-[2rem] shadow-2xl max-w-fit w-full text-center transition-all duration-500 hover:bg-[#0F172A]/90 hover:border-white/20">

                    <h1
                        class="text-center font-heading text-[10px] md:text-xl font-bold text-white mb-2 uppercase tracking-widest whitespace-nowrap">
                        Kuasai Keahlianmu. <span class="text-[#84CC16]">Kendalikan Masa Depan.</span>
                    </h1>

                    <p
                        class="text-slate-400 text-[9px] md:text-[11px] mb-4 max-w-md mx-auto opacity-80 leading-relaxed font-light px-4">
                        Pusat Edukasi <span class="text-white/80">Desain, Bisnis dan Administrasi, Robotik, Coding dan
                            AI</span> pertama di Banjarmasin sejak 2018.
                    </p>

                    <div class="flex gap-3 justify-center">
                        <a href="{{ route('course.packages') }}" wire:navigate
                            class="bg-[#3B82F6] text-white px-6 py-2 rounded-full font-bold text-[8px] uppercase tracking-[0.2em] transition-all hover:scale-105 hover:bg-blue-600 active:scale-95 shadow-lg shadow-blue-500/20 whitespace-nowrap">
                            Cari Kelas
                        </a>
                        <a href="{{ route('b2b.solution') }}" wire:navigate
                            class="bg-white/5 text-white border border-white/10 px-6 py-2 rounded-full font-bold text-[8px] uppercase tracking-[0.2em] transition-all hover:bg-white/10 active:scale-95 whitespace-nowrap">
                            Solusi Sekolah
                        </a>
                        <a href="{{ route('b2b.institution') }}" wire:navigate
                            class="bg-white/5 text-white border border-white/10 px-6 py-2 rounded-full font-bold text-[8px] uppercase tracking-[0.2em] transition-all hover:bg-white/10 active:scale-95 whitespace-nowrap">
                            Solusi Instansi
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <section class="max-w-7xl mx-auto px-6 py-24 bg-[#F8FAFC]">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach ($programs as $item)
                <a href="{{ route('program.detail', ['slug' => $item->slug]) }}" {{-- Menggunakan transform-gpu untuk memaksa rendering lewat GPU --}}
                    class="group relative bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm hover:shadow-xl transition-all duration-500 flex flex-col h-full overflow-hidden cursor-pointer active:scale-[0.98] transform-gpu will-change-transform">

                    <div
                        class="absolute inset-0 z-0 opacity-0 group-hover:opacity-10 transition-opacity duration-500 pointer-events-none overflow-hidden">
                        <img src="{{ asset('storage/' . $item->hero_image) }}" alt="{{ $item->title }}"
                            {{-- Scale diperkecil agar tidak terlalu berat saat ditarik --}}
                            class="w-full h-full object-cover transition-transform duration-700 ease-out group-hover:scale-110 transform-gpu"
                            loading="lazy">
                    </div>

                    <div class="absolute -right-10 -top-10 w-32 h-32 rounded-full blur-[30px] opacity-0 group-hover:opacity-20 transition-opacity duration-500 pointer-events-none transform-gpu"
                        style="background-color: {{ $item->accent_color }}"></div>

                    <div class="relative z-10 flex justify-between items-start mb-10">
                        <div class="flex items-center">
                            <div
                                class="w-14 h-14 rounded-2xl flex items-center justify-center bg-slate-50 group-hover:bg-white shadow-sm transition-colors duration-300 border border-slate-50 group-hover:border-transparent">
                                <svg class="w-7 h-7 transition-transform duration-300 group-hover:scale-110 transform-gpu"
                                    style="color: {{ $item->accent_color }}" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                        d="{{ $item->icon }}" />
                                </svg>
                            </div>
                            {{-- Transisi lebar garis dibuat lebih smooth --}}
                            <div
                                class="w-6 h-[1px] bg-slate-100 group-hover:w-10 transition-all duration-500 ease-in-out">
                            </div>
                        </div>

                        <div
                            class="translate-x-4 opacity-0 group-hover:translate-x-0 group-hover:opacity-100 transition-all duration-300 ease-out transform-gpu">
                            <div
                                class="w-10 h-10 rounded-full flex items-center justify-center bg-[#0F172A] text-white shadow-md">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                        d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="relative z-10 mb-8">
                        <h3
                            class="font-heading text-xl font-bold text-[#0F172A] mb-2 group-hover:text-[#3B82F6] transition-colors duration-300">
                            {{ $item->title }}
                        </h3>
                        <div class="flex flex-col gap-1.5">
                            @php
                                // Memastikan categories selalu berupa array agar bisa di-loop
                                $categories = is_array($item->category) ? $item->category : [$item->category];
                            @endphp

                            @foreach ($categories as $cat)
                                <div class="flex items-center gap-2">
                                    <span class="w-2 h-2 rounded-full"
                                        style="background-color: {{ $item->accent_color }}"></span>
                                    <p class="text-[8px] font-black tracking-[0.15em] uppercase text-slate-400">
                                        {{ $cat }}
                                    </p>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="relative z-10 mt-auto">
                        <p class="text-[9px] font-bold text-slate-300 uppercase tracking-widest mb-3">Core Programs</p>
                        <div class="flex flex-wrap gap-2">
                            @foreach ($item->badges as $badge)
                                <span
                                    class="capitalize text-[8px] font-bold bg-slate-50 text-slate-500 group-hover:bg-slate-900 group-hover:text-white px-3 py-1.5 rounded-xl border border-slate-100 group-hover:border-slate-900 transition-all duration-300">
                                    {{ $badge }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </section>

    @isset($featuredQuote)
        <section class="relative py-24 px-6 md:py-32 overflow-hidden bg-gray-900">
            <div class="absolute inset-0">
                <img src="https://images.pexels.com/photos/3861972/pexels-photo-3861972.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2"
                    alt="Inspiring background" class="w-full h-full object-cover opacity-20 scale-105 select-none">
                <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/70 to-transparent"></div>
            </div>

            <div class="max-w-4xl mx-auto relative z-10 text-center">
                <svg class="w-12 h-12 md:w-16 md:h-16 text-blue-600/50 mx-auto mb-8" fill="currentColor"
                    viewBox="0 0 24 24">
                    <path
                        d="M14.017 21L14.017 18C14.017 16.8954 14.9124 16 16.017 16H19.017C19.5693 16 20.017 15.5523 20.017 15V9C20.017 8.44772 19.5693 8 19.017 8H15.017C14.4647 8 14.017 8.44772 14.017 9V11C14.017 11.5523 13.5693 12 13.017 12H12.017V5H22.017V15C22.017 18.3137 19.3307 21 16.017 21H14.017ZM3.01697 21L3.01697 18C3.01697 16.8954 3.9124 16 5.01697 16H8.01697C8.56925 16 9.01697 15.5523 9.01697 15V9C9.01697 8.44772 8.56925 8 8.01697 8H4.01697C3.46468 8 3.01697 8.44772 3.01697 9V11C3.01697 11.5523 2.56925 12 2.01697 12H1.01697V5H11.017V15C11.017 18.3137 8.33068 21 5.01697 21H3.01697Z" />
                </svg>

                <blockquote
                    class="text-3xl md:text-5xl font-black leading-tight text-white mb-10 italic uppercase tracking-tighter">
                    "{{ $featuredQuote->content }}"
                </blockquote>

                <div class="inline-flex items-center gap-3">
                    <div class="h-px w-8 bg-blue-600"></div>
                    <p class="text-sm md:text-lg font-bold text-gray-300 uppercase tracking-widest">
                        {{ $featuredQuote->author }}
                        @if ($featuredQuote->source)
                            <span class="text-gray-500 font-medium normal-case italic ml-1">—
                                {{ $featuredQuote->source }}</span>
                        @endif
                    </p>
                    <div class="h-px w-8 bg-blue-600"></div>
                </div>
            </div>
        </section>
    @endisset

    <section class="max-w-7xl mx-auto px-6 py-24" x-data="{
        copied: false,
        copyToClipboard(url) {
            navigator.clipboard.writeText(url);
            this.copied = true;
            setTimeout(() => this.copied = false, 2000);
        },
        scrollLeft() {
            this.$refs.slider.scrollBy({ left: -400, behavior: 'smooth' });
        },
        scrollRight() {
            this.$refs.slider.scrollBy({ left: 400, behavior: 'smooth' });
        }
    }">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-6">
            <div class="max-w-2xl">
                <h2 class="font-heading text-4xl md:text-3xl font-black text-slate-900 mb-4 leading-tight">
                    Tingkatkan Keahlian Anda dengan <span class="text-[#3B82F6]">Workshop Eksklusif</span> Kami
                </h2>
            </div>

            <div class="hidden md:flex gap-4">
                <button @click="scrollLeft()"
                    class="w-12 h-12 rounded-full border border-slate-200 flex items-center justify-center hover:bg-slate-900 hover:text-white transition-all duration-300 shadow-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>
                <button @click="scrollRight()"
                    class="w-12 h-12 rounded-full border border-slate-200 flex items-center justify-center hover:bg-slate-900 hover:text-white transition-all duration-300 shadow-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>
        </div>

        <div class="relative">
            <div x-ref="slider"
                class="flex overflow-x-auto pb-8 gap-6 snap-x snap-mandatory scroll-smooth hide-scrollbar"
                style="scrollbar-width: none; -ms-overflow-style: none;">

                @forelse ($seminars as $item)
                    @php
                        $detailUrl = route('workshop.detail', ['slug' => $item->slug]);
                    @endphp

                    <div
                        class="flex-shrink-0 w-[85vw] md:w-[calc(50%-1.5rem)] lg:w-[calc(33.333%-1rem)] snap-start group/card">
                        <div
                            class="flex flex-col h-full bg-white rounded-[2rem] border border-slate-100 overflow-hidden hover:shadow-xl transition-all duration-300">

                            <div class="relative h-56 overflow-hidden">
                                <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}"
                                    class="w-full h-full object-cover transition-transform duration-500 group-hover/card:scale-105"
                                    loading="lazy">
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-900/60 to-transparent"></div>

                                <button @click="copyToClipboard('{{ $detailUrl }}')"
                                    class="absolute top-4 right-4 w-9 h-9 rounded-full bg-slate-900/20 backdrop-blur-sm border border-white/20 text-white flex items-center justify-center hover:bg-white hover:text-slate-900 transition-colors z-20">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </button>

                                <div class="absolute top-4 left-4">
                                    <span
                                        class="px-3 py-1 rounded-full text-white text-[9px] font-black uppercase tracking-wider"
                                        style="background-color: {{ $item->color ?? '#3B82F6' }}">
                                        {{ $item->type }}
                                    </span>
                                </div>

                                <div class="absolute bottom-4 left-4">
                                    <p class="text-[10px] font-bold text-white/90 flex items-center gap-1.5">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                                        {{ $item->status }}
                                    </p>
                                </div>
                            </div>

                            <div class="p-6 flex flex-col flex-grow">
                                <div class="mb-3 flex items-center gap-3">
                                    <div class="flex items-center gap-1 text-slate-400">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <span
                                            class="text-[10px] font-bold uppercase tracking-tight">{{ $item->date_string }}</span>
                                    </div>
                                </div>

                                <a href="{{ $detailUrl }}" wire:navigate class="block mb-4">
                                    <h3
                                        class="text-lg font-bold text-slate-900 group-hover/card:text-[#3B82F6] transition-colors line-clamp-2 leading-snug">
                                        {{ $item->title }}
                                    </h3>
                                </a>

                                <div class="mt-auto pt-5 border-t border-slate-50 flex items-center justify-between">
                                    <div>
                                        <p
                                            class="text-[8px] font-black uppercase tracking-widest text-slate-400 mb-0.5">
                                            Biaya Pendaftaran
                                        </p>
                                        <p class="text-base font-black text-slate-900">
                                            {{ $item->price }}
                                        </p>
                                    </div>

                                    <a href="{{ $detailUrl }}" wire:navigate
                                        class="px-5 py-2.5 rounded-xl bg-slate-50 text-slate-900 text-[10px] font-bold uppercase tracking-widest hover:bg-slate-900 hover:text-white transition-all transform active:scale-95">
                                        Detail
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div
                        class="w-full py-12 flex flex-col items-center justify-center border-2 border-dashed border-slate-100 rounded-[2rem] bg-slate-50/50">
                        <svg class="w-12 h-12 text-slate-300 mb-4" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                        <p class="text-slate-500 font-bold text-sm text-center">Belum ada workshop yang tersedia saat
                            ini.</p>
                        <p class="text-slate-400 text-xs text-center mt-1">Silakan cek kembali di lain waktu.</p>
                    </div>
                @endforelse
            </div>
        </div>

        <template x-if="copied">
            <div x-show="copied" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-300"
                class="fixed bottom-10 left-1/2 -translate-x-1/2 z-[100] bg-slate-900 text-white px-6 py-3 rounded-2xl shadow-xl flex items-center gap-3">
                <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path d="M5 13l4 4L19 7" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <span class="text-sm font-bold">Link berhasil disalin!</span>
            </div>
        </template>
    </section>

    <section class="py-24 bg-[#F8FAFC]">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-12">
                <div class="max-w-xl">
                    <h2 class="text-[10px] font-black uppercase tracking-[0.3em] text-blue-600 mb-4">Agenda Resmi</h2>
                    <h3 class="text-3xl md:text-4xl font-extrabold text-slate-900 tracking-tighter">
                        Jadwal & <span class="text-slate-400 font-light">Kegiatan Internal</span>
                    </h3>
                </div>
                @if (count($events) > 0)
                    <a href="/agenda" wire:navigate
                        class="text-[11px] font-black uppercase tracking-widest text-slate-400 hover:text-blue-600 transition-colors flex items-center gap-2 group">
                        Arsip Agenda
                        <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M17 8l4 4m0 0l-4 4m4-4H3" stroke-width="2.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </a>
                @endif
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($events as $event)
                    <div
                        class="group bg-white rounded-[2.5rem] border border-slate-100 p-8 shadow-xl shadow-slate-200/40 transition-all duration-500">
                        <div class="flex justify-between items-start mb-8">
                            <div class="flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-blue-600 animate-pulse"></span>
                                <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Official
                                    Agenda</span>
                            </div>
                            <div class="text-right">
                                <span class="block text-2xl font-black text-slate-900 leading-none">
                                    {{ date('d', strtotime($event->date)) }}
                                </span>
                                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">
                                    {{ date('M Y', strtotime($event->date)) }}
                                </span>
                            </div>
                        </div>

                        <h4 class="text-lg font-black text-slate-900 mb-3 italic">
                            {{ $event->title }}
                        </h4>
                        <p class="text-slate-500 text-xs leading-relaxed mb-8 line-clamp-3 font-medium">
                            {{ $event->description }}
                        </p>

                        <div class="flex flex-col gap-3 py-6 border-t border-slate-50 mb-4">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-blue-50 flex items-center justify-center">
                                    <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" stroke-width="2"
                                            stroke-linecap="round" />
                                    </svg>
                                </div>
                                <span
                                    class="text-[10px] font-black text-slate-600 uppercase tracking-widest">{{ $event->time }}</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-slate-50 flex items-center justify-center">
                                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"
                                            stroke-width="2" stroke-linecap="round" />
                                    </svg>
                                </div>
                                <span
                                    class="text-[10px] font-black text-slate-600 uppercase tracking-widest">{{ $event->location }}</span>
                            </div>
                        </div>

                        <div class="mt-4 pt-4 border-t border-slate-50 flex items-center justify-end">
                            <a href="" wire:navigate
                                class="text-[10px] font-black text-blue-600 uppercase tracking-widest hover:text-slate-900 transition-colors flex items-center gap-2">
                                Detail Maklumat
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path d="M9 5l7 7-7 7" stroke-width="3" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                            </a>
                        </div>
                    </div>
                @empty
                    <div
                        class="col-span-full py-20 bg-white rounded-[3rem] border-2 border-dashed border-slate-100 flex flex-col items-center justify-center text-center px-6">
                        <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mb-6">
                            <svg class="w-10 h-10 text-slate-200" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"
                                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>
                        <h4 class="text-xl font-black text-slate-900 uppercase tracking-tighter mb-2">Belum Ada
                            Pengumuman</h4>
                        <p class="text-slate-400 text-sm max-w-sm font-medium leading-relaxed">
                            Tidak ada agenda resmi atau maklumat internal untuk saat ini.
                        </p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <section class="py-20">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-[10px] font-black uppercase tracking-[0.3em] text-blue-600 mb-4">Our Collaboration</h2>
                <h3 class="text-3xl md:text-4xl font-extrabold text-slate-900 tracking-tighter">
                    Dipercaya oleh Instansi & <span class="text-slate-400 font-light">Mitra Strategis</span>
                </h3>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8 lg:gap-12 items-center justify-center">

                @forelse($partners as $partner)
                    <div class="group flex justify-center">
                        <div
                            class="h-16 w-32 grayscale opacity-50 group-hover:grayscale-0 group-hover:opacity-100 transition-all duration-500 flex items-center justify-center">
                            {{-- Menampilkan Gambar dari Database --}}
                            <img src="{{ asset('storage/' . $partner->image) }}" alt="{{ $partner->name }}"
                                class="max-h-full max-w-full object-contain filter drop-shadow-sm"
                                title="{{ $partner->name }}">
                        </div>
                    </div>
                @empty
                    {{-- Tampilan jika database kosong (Opsional) --}}
                    <div class="col-span-full text-center">
                        <p class="text-slate-300 text-[10px] font-black uppercase tracking-widest">Partner data is
                            being updated</p>
                    </div>
                @endforelse

            </div>

            <div class="mt-16 pt-8 border-t border-slate-50 text-center">
                <p class="text-slate-400 text-xs font-medium italic">
                    Bekerja sama untuk membangun ekosistem teknologi dan edukasi yang lebih baik di Kalimantan Selatan.
                </p>
            </div>
        </div>
    </section>

    <section class="bg-[#0F172A] py-24">
        <div class="max-w-3xl mx-auto px-6">
            <div class="text-center mb-10">
                <h2 class="font-heading text-2xl font-bold text-white mb-2 uppercase tracking-widest italic">Career
                    Simulator</h2>
                <p class="text-slate-400 text-sm">
                    {{ count($selected) < 2 ? 'Pilih 2 hal yang paling kamu sukai:' : 'Hasil simulasi kamu:' }}
                </p>
            </div>

            <div class="bg-slate-900/40 border border-white/5 p-8 rounded-[2.5rem] backdrop-blur-sm">
                <div class="grid md:grid-cols-3 gap-5">
                    <button wire:click="toggleChoice('A')"
                        class="relative p-6 rounded-2xl border transition-all duration-300 text-left
                    {{ in_array('A', $selected) ? 'border-[#3B82F6] bg-[#3B82F6]/10' : 'border-slate-800 hover:border-slate-600' }}">
                        @if (in_array('A', $selected))
                            <div class="absolute -top-2 -right-2 bg-[#3B82F6] rounded-full p-1"><svg
                                    class="w-3 h-3 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                        d="M5 13l4 4L19 7" />
                                </svg></div>
                        @endif
                        <span
                            class="block text-[10px] font-black uppercase tracking-widest mb-2 {{ in_array('A', $selected) ? 'text-[#3B82F6]' : 'text-slate-500' }}">Visual</span>
                        <p class="text-sm text-slate-300 font-medium">Mendesain bentuk & tampilan.</p>
                    </button>

                    <button wire:click="toggleChoice('B')"
                        class="relative p-6 rounded-2xl border transition-all duration-300 text-left
                    {{ in_array('B', $selected) ? 'border-[#84CC16] bg-[#84CC16]/10' : 'border-slate-800 hover:border-slate-600' }}">
                        @if (in_array('B', $selected))
                            <div class="absolute -top-2 -right-2 bg-[#84CC16] rounded-full p-1"><svg
                                    class="w-3 h-3 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                        d="M5 13l4 4L19 7" />
                                </svg></div>
                        @endif
                        <span
                            class="block text-[10px] font-black uppercase tracking-widest mb-2 {{ in_array('B', $selected) ? 'text-[#84CC16]' : 'text-slate-500' }}">Logika</span>
                        <p class="text-sm text-slate-300 font-medium">Mengatur strategi & data.</p>
                    </button>

                    <button wire:click="toggleChoice('C')"
                        class="relative p-6 rounded-2xl border transition-all duration-300 text-left
                    {{ in_array('C', $selected) ? 'border-orange-500 bg-orange-500/10' : 'border-slate-800 hover:border-slate-600' }}">
                        @if (in_array('C', $selected))
                            <div class="absolute -top-2 -right-2 bg-orange-500 rounded-full p-1"><svg
                                    class="w-3 h-3 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                        d="M5 13l4 4L19 7" />
                                </svg></div>
                        @endif
                        <span
                            class="block text-[10px] font-black uppercase tracking-widest mb-2 {{ in_array('C', $selected) ? 'text-orange-500' : 'text-slate-500' }}">Mekanik</span>
                        <p class="text-sm text-slate-300 font-medium">Bongkar pasang alat fisik.</p>
                    </button>
                </div>

                <div class="mt-10 min-h-[80px] flex items-center justify-center border-t border-white/5">
                    @if ($simulatorResult)
                        <div class="pt-6 text-center animate-bounce-short">
                            <p class="text-[10px] text-[#84CC16] font-black uppercase tracking-[0.3em] mb-2">Karir Masa
                                Depanmu:</p>
                            <h4 class="text-2xl md:text-3xl font-heading font-black text-white italic">
                                {{ $simulatorResult }}
                            </h4>
                        </div>
                    @else
                        <p class="pt-6 text-slate-600 text-[10px] uppercase font-bold tracking-widest">Pilih 2 hal yang
                            kamu sukai
                            untuk melihat hasil...</p>
                    @endif
                </div>
            </div>
        </div>
    </section>
</div>
