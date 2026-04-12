<div class="bg-white min-h-screen">

    <section id="home" class="relative h-[85vh] flex items-center bg-[#0F172A] overflow-hidden">
        <div class="absolute inset-0">
            <img src="{{ asset('storage/' . $program->hero_image) }}"
                class="w-full h-full object-cover opacity-20 scale-105">
            {{-- Gradient overlay menggunakan warna Instansi untuk kedalaman --}}
            <div class="absolute inset-0 bg-gradient-to-b from-[#0F172A]/50 via-transparent to-white"></div>
        </div>

        <div class="max-w-7xl mx-auto px-6 relative z-10 w-full text-center md:text-left">
            <div
                class="inline-flex items-center gap-3 mb-8 bg-white/5 backdrop-blur-md px-4 py-2 rounded-full border border-white/10">
                <span class="w-2 h-2 rounded-full animate-pulse"
                    style="background-color: {{ $program->accent_color }}"></span>
                <span class="text-[10px] font-black uppercase tracking-[0.3em] text-white">New Enrollment Open
                    2026</span>
            </div>

            <h1
                class="text-6xl md:text-8xl font-heading font-black text-white mb-6 leading-[0.9] italic uppercase tracking-tighter">
                {{ $program->title }}
            </h1>

            <p class="text-white/60 max-w-xl text-lg font-medium italic mb-10 leading-relaxed">
                Membangun masa depan teknologi dari Banjarmasin. Kurikulum berbasis industri untuk generasi inovator
                berikutnya.
            </p>

            <div class="flex flex-wrap gap-4 justify-center md:justify-start">
                {{-- Tombol Utama: Warna Program dengan Glow dari Warna Instansi --}}
                <a href="#packages"
                    @click.prevent="document.getElementById('packages').scrollIntoView({ behavior: 'smooth' })"
                    style="background-color: {{ $program->accent_color }}; box-shadow: 0 20px 25px -5px {{ $program->instansi->colour }}50"
                    class="px-10 py-5 text-white rounded-2xl font-black uppercase text-xs tracking-[0.2em] hover:scale-105 transition-all duration-300">
                    Mulai Belajar
                </a>
                <a href="#profile"
                    @click.prevent="document.getElementById('profile').scrollIntoView({ behavior: 'smooth' })"
                    class="px-10 py-5 bg-white/10 backdrop-blur-md text-white border border-white/20 rounded-2xl font-black uppercase text-xs tracking-[0.2em] hover:bg-white/20 transition-all">
                    Tentang Kami
                </a>
            </div>
        </div>
    </section>

    <section id="profile" class="py-32 max-w-7xl mx-auto px-6">
        <div class="grid lg:grid-cols-2 gap-20 items-center">
            <div class="relative">
                {{-- Ornamen belakang menggunakan warna Instansi --}}
                <div class="absolute -top-10 -left-10 w-40 h-40 rounded-full blur-3xl opacity-20"
                    style="background-color: {{ $program->instansi->colour }}"></div>

                <div
                    class="relative rounded-[4rem] overflow-hidden shadow-2xl rotate-2 hover:rotate-0 transition-transform duration-700">
                    <img src="{{ asset('storage/' . $program->instansi->image) }}"
                        class="w-full aspect-[4/5] object-cover">
                </div>
            </div>
            <div class="space-y-8">
                <h2 class="text-xs font-black uppercase tracking-[0.5em] italic"
                    style="color: {{ $program->accent_color }}">The Core Profile</h2>

                <h3 class="text-5xl font-black text-slate-900 leading-tight uppercase italic tracking-tighter">
                    {{ $program->instansi->name }}.
                </h3>

                {{-- Garis dekoratif menggunakan warna Instansi --}}
                <div class="h-1.5 w-24 rounded-full" style="background-color: {{ $program->instansi->colour }}"></div>

                <p class="text-slate-500 text-lg leading-relaxed font-medium">
                    {{ $program->instansi->profile }}
                </p>

                <div class="grid grid-cols-2 gap-8 pt-6">
                    <div>
                        <p class="text-4xl font-black text-slate-900 mb-1">500+</p>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Alumni Terdaftar</p>
                    </div>
                    <div>
                        <p class="text-4xl font-black text-slate-900 mb-1">12+</p>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Partner Industri</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="packages" class="py-32 bg-slate-50">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-20">
                <h2 class="text-4xl md:text-6xl font-black text-slate-900 uppercase italic tracking-tighter mb-4">
                    Pilih Jalur Belajarmu
                </h2>
                <p class="text-slate-600 font-medium tracking-widest uppercase text-sm inline-block pb-2"
                    style="border-bottom: 3px solid {{ $program->instansi->colour }}">
                    {{ $program->title }}
                </p>
            </div>

            <div class="grid lg:grid-cols-12 gap-20">
                <div class="lg:col-span-7">
                    <h2 class="font-heading text-3xl font-bold mb-12 flex items-center gap-4 italic">
                        Curriculum Path
                        <span class="h-[1px] flex-grow bg-slate-200"></span>
                    </h2>

                    <div class="space-y-6" x-data="{ activeAccordion: 1 }">
                        @foreach ($program->coursePackages as $index => $package)
                            <div class="group p-8 rounded-[2rem] border transition-all duration-500 bg-white"
                                :style="activeAccordion === {{ $package->level }} ?
                                    'border-color: {{ $program->accent_color }}; box-shadow: 0 20px 25px -5px {{ $program->accent_color }}15' :
                                    'border-color: #f1f5f9'">

                                <div class="flex gap-8 cursor-pointer"
                                    @click="activeAccordion = (activeAccordion === {{ $package->level }} ? null : {{ $package->level }})">

                                    <span class="text-5xl font-black transition-colors duration-500"
                                        :style="activeAccordion === {{ $package->level }} ?
                                            'color: {{ $program->accent_color }}' : ''"
                                        :class="activeAccordion === {{ $package->level }} ? '' :
                                            'text-slate-100 group-hover:text-slate-300'">
                                        0{{ $package->level }}
                                    </span>

                                    <div class="flex-grow">
                                        <div class="flex justify-between items-start">
                                            <div>
                                                <h4 class="text-xl font-bold text-slate-900 mb-2">{{ $package->name }}
                                                </h4>
                                                <p class="text-slate-500 mb-4">{{ $package->description }}</p>
                                            </div>
                                            <svg class="w-6 h-6 text-slate-300 transition-transform duration-300"
                                                :style="activeAccordion === {{ $package->level }} ?
                                                    'color: {{ $program->accent_color }}' : ''"
                                                :class="activeAccordion === {{ $package->level }} ? 'rotate-180' : ''"
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
                                            <span class="px-3 py-1 text-[10px] font-bold uppercase rounded-lg"
                                                style="background-color: {{ $program->accent_color }}15; color: {{ $program->accent_color }}">
                                                {{ $package->course_count }} Sesi Belajar
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
                                                    Investasi</p>
                                                <p class="text-lg font-bold text-slate-900">Rp
                                                    {{ number_format($package->price, 0, ',', '.') }}</p>
                                            </div>
                                            <div>
                                                <p
                                                    class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-1">
                                                    Durasi</p>
                                                <p class="text-lg font-bold text-slate-900">
                                                    {{ $package->course_during }} Jam / Sesi</p>
                                            </div>
                                            <div>
                                                <p
                                                    class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-1">
                                                    Kurikulum</p>
                                                <p class="text-lg font-bold text-slate-900">Level
                                                    0{{ $package->level }}</p>
                                            </div>
                                        </div>

                                        <div class="mt-8 flex justify-end">
                                            <a href="{{ route('program.course.detail', ['slug' => $program->slug, 'course_slug' => $package->slug]) }}"
                                                style="background-color: #0F172A"
                                                onmouseover="this.style.backgroundColor='{{ $program->accent_color }}'"
                                                onmouseout="this.style.backgroundColor='#0F172A'"
                                                class="px-8 py-3 text-white text-[11px] font-bold uppercase tracking-widest rounded-xl transition-all flex items-center gap-2">
                                                Pelajari Kurikulum
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
                            <div
                                class="relative p-10 rounded-[3rem] bg-[#0F172A] text-white overflow-hidden shadow-2xl">
                                {{-- Glow menggunakan warna Instansi --}}
                                <div class="absolute top-0 right-0 w-40 h-40 blur-[80px] opacity-40"
                                    style="background-color: {{ $program->instansi->colour }}"></div>

                                <div class="relative z-10">
                                    <div class="mb-10 inline-flex items-center gap-2">
                                        <div class="w-2 h-2 rounded-full animate-ping"
                                            style="background-color: {{ $program->accent_color }}"></div>
                                        <span
                                            class="text-[10px] font-black uppercase tracking-widest text-white/50">The
                                            Missing Link</span>
                                    </div>

                                    <p class="text-2xl font-medium leading-relaxed mb-12 italic">
                                        "{{ $missingLink->text }}"</p>

                                    <a href="{{ url('programs/' . $missingLink->url) }}" style="color: #0F172A"
                                        class="group flex items-center justify-between p-6 bg-white rounded-2xl font-bold transition-all hover:scale-[1.02]">
                                        <span class="uppercase tracking-widest text-xs">{{ $missingLink->cta }}</span>
                                        <svg class="w-5 h-5 group-hover:translate-x-2 transition-transform"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
        </div>
    </section>

    <section id="gallery" class="py-32 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="mb-16 text-center">
                <h2 class="text-xs font-black uppercase tracking-[0.5em] mb-4 italic"
                    style="color: {{ $program->instansi->colour }}">Our Atmosphere</h2>
                <h3 class="text-5xl font-black text-slate-900 italic uppercase tracking-tighter">
                    Learning in <span class="text-outline" style="color: {{ $program->accent_color }}">Action.</span>
                </h3>
            </div>

            <div class="columns-1 sm:columns-2 lg:columns-3 gap-6 space-y-6">
                @foreach ($program->instansi->galleries as $image)
                    <div
                        class="break-inside-avoid relative group rounded-[2.5rem] overflow-hidden shadow-lg border border-slate-100">
                        <img src="{{ asset('storage/' . $image->image) }}"
                            class="w-full h-auto object-cover group-hover:scale-105 transition-transform duration-1000">
                        {{-- Overlay: Gradasi dari warna Instansi ke Program --}}
                        <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-500 flex items-end p-8"
                            style="background: linear-gradient(to top, {{ $program->accent_color }}DD, {{ $program->instansi->colour }}44)">
                            <p class="text-white text-sm font-bold italic uppercase tracking-wider">
                                {{ $image->caption }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section id="testimoni" class="py-32 bg-slate-50 overflow-hidden" x-data="{
        active: 0,
        total: {{ $program->instansi->testimonis->count() }},
        get max() { return window.innerWidth < 1024 ? this.total - 1 : this.total - 3; }
    }">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex justify-between items-end mb-16">
                <div>
                    <h2 class="text-xs font-black uppercase tracking-[0.5em] mb-4 italic"
                        style="color: {{ $program->instansi->colour }}">Testimonials</h2>
                    <h3 class="text-5xl font-black text-slate-900 italic uppercase tracking-tighter">Voice of Success.
                    </h3>
                </div>

                <div class="flex gap-4">
                    <button @click="if(active > 0) active--"
                        class="w-14 h-14 rounded-full border-2 border-slate-200 flex items-center justify-center transition-all"
                        :class="active === 0 ? 'opacity-30 cursor-not-allowed' : 'hover:text-white'"
                        :style="active !== 0 ? `border-color: ${active !== 0 ? '{{ $program->accent_color }}' : ''}` : ''"
                        onmouseover="this.style.backgroundColor='{{ $program->accent_color }}'; this.style.color='white'"
                        onmouseout="this.style.backgroundColor=''; this.style.color=''">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M15 19l-7-7 7-7" stroke-width="2.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </button>
                    <button @click="if(active < max) active++"
                        class="w-14 h-14 rounded-full border-2 border-slate-200 flex items-center justify-center transition-all"
                        :class="active >= max ? 'opacity-30 cursor-not-allowed' : 'hover:text-white'"
                        onmouseover="this.style.backgroundColor='{{ $program->accent_color }}'; this.style.color='white'"
                        onmouseout="this.style.backgroundColor=''; this.style.color=''">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M9 5l7 7-7 7" stroke-width="2.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </button>
                </div>
            </div>

            <div class="relative py-10">
                <div class="flex transition-transform duration-700 ease-[cubic-bezier(0.25,1,0.5,1)]"
                    :style="`transform: translateX(-${active * (window.innerWidth < 1024 ? 100 : 33.3333)}%)`">

                    @foreach ($program->instansi->testimonis as $testi)
                        <div class="w-full lg:w-1/3 flex-shrink-0 px-4">
                            <div class="bg-white p-10 rounded-[3rem] border border-slate-100 shadow-xl h-full flex flex-col justify-between transition-all duration-500"
                                onmouseover="this.style.borderColor='{{ $program->accent_color }}'"
                                onmouseout="this.style.borderColor=''">
                                <div>
                                    <div class="flex gap-1 mb-6" style="color: {{ $program->accent_color }}">
                                        @for ($i = 0; $i < $testi->rating; $i++)
                                            <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                                                <path
                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                        @endfor
                                    </div>
                                    <p class="text-xl font-medium italic leading-relaxed text-slate-700 line-clamp-4">
                                        "{{ $testi->content }}"</p>
                                </div>

                                <div class="mt-8 flex items-center gap-4 border-t border-slate-50 pt-8">
                                    <div class="w-12 h-12 text-white rounded-2xl flex items-center justify-center font-black italic transition-all"
                                        style="background-color: #0F172A"
                                        onmouseover="this.style.backgroundColor='{{ $program->accent_color }}'"
                                        onmouseout="this.style.backgroundColor='#0F172A'">
                                        {{ substr($testi->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <p class="font-black text-xs uppercase text-slate-900">{{ $testi->name }}</p>
                                        <p class="text-[9px] text-slate-400 uppercase tracking-widest font-bold">
                                            {{ $testi->role }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
</div>
