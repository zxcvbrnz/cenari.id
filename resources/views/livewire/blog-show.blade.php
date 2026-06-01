<div class="max-w-7xl mx-auto px-4 sm:px-6 py-12">
    <!-- Grid Utama: Kiri Konten (2 Kolom), Kanan Sidebar (1 Kolom) -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-12 items-start">

        <!-- KOLOM KIRI: DETAIL ARTIKEL & SLIDER -->
        <article class="lg:col-span-2">
            <nav class="flex items-center gap-4 mb-8">
                <a href="{{ route('blog.index') }}" wire:navigate
                    class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 hover:text-blue-600 transition-colors">Journal</a>
                <svg class="w-3 h-3 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path d="M9 5l7 7-7 7" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <span class="text-[10px] font-black uppercase tracking-[0.2em] text-blue-600">Blog Detail</span>
            </nav>

            <header class="mb-12">
                <h1 class="text-4xl md:text-5xl font-black text-slate-900 tracking-tighter leading-[1.1] mb-8 italic">
                    {{ $post->title }}
                </h1>
            </header>

            <!-- SLIDER GALLERY (Menggunakan Alpine.js) -->
            <figure class="mb-16">
                @if ($post->images && $post->images->isNotEmpty())
                    <div x-data="{ activeSlide: 0, slidesCount: {{ $post->images->count() }} }" class="relative group w-full">

                        <!-- Wrapper Slide (Ukuran Diperbesar dengan aspect-[16/10]) -->
                        <div
                            class="rounded-[3rem] overflow-hidden shadow-2xl shadow-blue-500/10 aspect-[16/10] bg-slate-100 relative">
                            @foreach ($post->images as $index => $image)
                                <div x-show="activeSlide === {{ $index }}"
                                    x-transition:enter="transition ease-out duration-500"
                                    x-transition:enter-start="opacity-0 scale-95"
                                    x-transition:enter-end="opacity-100 scale-100"
                                    class="absolute inset-0 w-full h-full">
                                    <img src="{{ asset('storage/' . $image->filename) }}" alt="{{ $post->title }}"
                                        class="w-full h-full object-cover">
                                </div>
                            @endforeach

                            <!-- Tombol Navigasi Kiri (Hanya muncul jika gambar > 1) -->
                            <template x-if="slidesCount > 1">
                                <button @click="activeSlide = activeSlide === 0 ? slidesCount - 1 : activeSlide - 1"
                                    class="absolute left-6 top-1/2 -translate-y-1/2 w-12 h-12 rounded-2xl bg-white/90 backdrop-blur-sm flex items-center justify-center text-slate-800 opacity-0 group-hover:opacity-100 transition-all hover:bg-blue-600 hover:text-white shadow-lg">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path d="M15 19l-7-7 7-7" stroke-width="2.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </button>
                            </template>

                            <!-- Tombol Navigasi Kanan (Hanya muncul jika gambar > 1) -->
                            <template x-if="slidesCount > 1">
                                <button @click="activeSlide = activeSlide === slidesCount - 1 ? 0 : activeSlide + 1"
                                    class="absolute right-6 top-1/2 -translate-y-1/2 w-12 h-12 rounded-2xl bg-white/90 backdrop-blur-sm flex items-center justify-center text-slate-800 opacity-0 group-hover:opacity-100 transition-all hover:bg-blue-600 hover:text-white shadow-lg">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path d="M9 5l7 7-7 7" stroke-width="2.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </button>
                            </template>
                        </div>

                        <!-- Indikator Titik Slider (Hanya muncul jika gambar > 1) -->
                        <template x-if="slidesCount > 1">
                            <div class="flex justify-center gap-2 mt-4">
                                <template x-for="(slide, index) in slidesCount" :key="index">
                                    <button @click="activeSlide = index"
                                        class="h-1.5 rounded-full transition-all duration-300"
                                        :class="activeSlide === index ? 'w-8 bg-blue-600' :
                                            'w-2 bg-slate-300 hover:bg-slate-400'">
                                    </button>
                                </template>
                            </div>
                        </template>
                    </div>
                @else
                    <!-- Placeholder jika tidak ada gambar -->
                    <div
                        class="rounded-[3rem] overflow-hidden shadow-2xl shadow-blue-500/10 aspect-[16/10] bg-slate-100 flex items-center justify-center text-slate-300">
                        <svg class="w-20 h-20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"
                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </div>
                @endif

                {{-- @if ($post->excerpt)
                    <figcaption class="mt-6 text-center text-sm italic text-slate-400 font-medium px-10">
                        "{{ $post->excerpt }}"
                    </figcaption>
                @endif --}}
            </figure>

            <!-- Isi Body Artikel -->
            <div
                class="prose prose-slate prose-lg max-w-none 
            prose-headings:font-black prose-headings:tracking-tighter prose-headings:italic 
            prose-p:text-slate-600 prose-p:leading-relaxed 
            prose-strong:text-slate-900 prose-a:text-blue-600 
            prose-img:rounded-[2rem] prose-img:shadow-lg">

                {!! Str::inlineMarkdown($post->body) !!}

            </div>

            <footer
                class="mt-20 pt-10 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between gap-8">
                <div class="flex items-center gap-4">
                    <span class="text-[10px] font-black uppercase tracking-widest text-slate-400">Bagikan:</span>
                    <div class="flex gap-2">
                        <button
                            class="w-10 h-10 rounded-2xl bg-slate-50 flex items-center justify-center hover:bg-blue-600 hover:text-white transition-all">
                            <span class="text-[10px] font-black text-slate-600 hover:text-white">WA</span>
                        </button>
                        <button
                            class="w-10 h-10 rounded-2xl bg-slate-50 flex items-center justify-center hover:bg-blue-600 hover:text-white transition-all">
                            <span class="text-[10px] font-black text-slate-600 hover:text-white">FB</span>
                        </button>
                    </div>
                </div>

                <a href="{{ route('blog.index') }}" wire:navigate
                    class="text-[10px] font-black uppercase tracking-widest text-slate-400 hover:text-blue-600 transition-colors">
                    &larr; Kembali ke Daftar Artikel
                </a>
            </footer>
        </article>

        <!-- KOLOM KANAN: SIDEBAR ARTIKEL LAINNYA -->
        <aside class="space-y-8 lg:sticky lg:top-8 lg:border-l lg:border-slate-100 lg:pl-8">
            <div>
                <h2
                    class="text-[11px] font-black uppercase tracking-[0.2em] text-slate-400 mb-6 flex items-center gap-2">
                    <span class="w-1.5 h-1.5 rounded-full bg-blue-600"></span>
                    Artikel Lainnya
                </h2>

                <div class="space-y-6">
                    @forelse($otherPosts as $other)
                        <a href="{{ route('blog.show', $other->slug) }}" wire:navigate class="group block space-y-3">
                            <div class="rounded-2xl overflow-hidden aspect-[16/10] bg-slate-100 shadow-sm">
                                @if ($other->images && $other->images->isNotEmpty())
                                    <img src="{{ asset('storage/' . $other->images->first()->filename) }}"
                                        alt="{{ $other->title }}"
                                        class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-slate-300">
                                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"
                                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </div>
                                @endif
                            </div>

                            <h3
                                class="text-sm font-bold text-slate-800 tracking-tight leading-snug group-hover:text-blue-600 transition-colors line-clamp-2">
                                {{ $other->title }}
                            </h3>
                        </a>
                    @empty
                        <p class="text-xs italic text-slate-400">Tidak ada artikel lain saat ini.</p>
                    @endforelse
                </div>
            </div>
        </aside>

    </div>
</div>
