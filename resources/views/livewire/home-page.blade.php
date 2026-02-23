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
                        class="font-heading text-base md:text-xl font-bold text-white mb-2 uppercase tracking-widest whitespace-nowrap">
                        Kuasai Teknologi. <span class="text-[#84CC16]">Kendalikan Masa Depan.</span>
                    </h1>

                    <p
                        class="text-slate-400 text-[9px] md:text-[11px] mb-4 max-w-md mx-auto opacity-80 leading-relaxed font-light whitespace-nowrap px-4">
                        Pusat Edukasi <span class="text-white/80">Coding</span> & <span
                            class="text-white/80">Robotik</span> Terpadu di Banjarmasin.
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
                        <img src="{{ $item->hero_image }}" alt="{{ $item->title }}" {{-- Scale diperkecil agar tidak terlalu berat saat ditarik --}}
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
                        <div class="flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full"
                                style="background-color: {{ $item->accent_color }}"></span>
                            <p class="text-[10px] font-black tracking-[0.15em] uppercase text-slate-400">
                                {{ is_array($item->category) ? $item->category[0] : $item->category }}
                            </p>
                        </div>
                    </div>

                    <div class="relative z-10 mt-auto">
                        <p class="text-[9px] font-bold text-slate-300 uppercase tracking-widest mb-3">Core Programs</p>
                        <div class="flex flex-wrap gap-2">
                            @foreach ($item->badges as $badge)
                                <span
                                    class="text-[10px] font-bold bg-slate-50 text-slate-500 group-hover:bg-slate-900 group-hover:text-white px-3 py-1.5 rounded-xl border border-slate-100 group-hover:border-slate-900 transition-all duration-300">
                                    {{ $badge }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </section>

    <section class="relative py-24 px-6 md:py-32 overflow-hidden bg-gray-900">
        <div class="absolute inset-0">
            {{-- Gambar Latar Belakang --}}
            <img src="https://images.pexels.com/photos/3861972/pexels-photo-3861972.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2"
                alt="Inspiring background" class="w-full h-full object-cover opacity-20 scale-105">

            {{-- Overlay Gradient untuk Keterbacaan Teks --}}
            <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/70 to-transparent"></div>
        </div>

        <div class="max-w-4xl mx-auto relative z-10 text-center">
            {{-- Ikon Quote --}}
            <svg class="w-16 h-16 text-gray-500 mx-auto mb-8 opacity-70" fill="currentColor" viewBox="0 0 24 24">
                <path
                    d="M9.707 16.707a1 1 0 01-1.414 0L6 14.414l-2.293 2.293a1 1 0 01-1.414-1.414l3-3a1 1 0 011.414 0L9 13.586l2.293-2.293a1 1 0 011.414 1.414l-3 3zM16.707 16.707a1 1 0 01-1.414 0L13 14.414l-2.293 2.293a1 1 0 01-1.414-1.414l3-3a1 1 0 011.414 0L16 13.586l2.293-2.293a1 1 0 011.414 1.414l-3 3z"
                    clip-rule="evenodd" fill-rule="evenodd" />
            </svg>


            {{-- Teks Quote --}}
            <blockquote class="text-4xl md:text-5xl font-heading font-extrabold leading-tight text-white mb-10 italic">
                "The future belongs to those who learn more skills and combine them in creative ways."
            </blockquote>

            {{-- Penulis Quote --}}
            <p class="text-lg font-medium text-gray-300">
                — Robert Greene, <span class="font-normal">Mastery</span>
            </p>

            {{-- Tombol CTA (Opsional) --}}
            <div class="mt-16">
                <a href="/about-us"
                    class="inline-flex items-center px-8 py-4 bg-[#3B82F6] text-white font-bold rounded-full shadow-lg hover:bg-blue-600 transition-colors duration-300 transform hover:-translate-y-1">
                    Explore Our Philosophy
                    <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M17 8l4 4m0 0l-4 4m4-4H3" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </a>
            </div>
        </div>
    </section>

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
                    Empower Your Skills with Our <span class="text-[#3B82F6]">Exclusive Workshops</span>
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

                @foreach ($seminars as $item)
                    @php
                        $detailUrl = route('workshop.detail', ['slug' => $item->slug]);
                    @endphp

                    <div
                        class="flex-shrink-0 w-[85vw] md:w-[calc(50%-1.5rem)] lg:w-[calc(33.333%-1rem)] snap-start group/card">
                        <div
                            class="flex flex-col h-full bg-white rounded-[2rem] border border-slate-100 overflow-hidden hover:shadow-xl transition-all duration-300">

                            <div class="relative h-56 overflow-hidden">
                                <img src="{{ $item->image }}" alt="{{ $item->title }}"
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
                                            Registration Fee
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
                @endforeach
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
