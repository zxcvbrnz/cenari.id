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
                {!! $post->formatted_body !!}
            </div>

            <footer
                class="mt-20 pt-10 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between gap-8">
                <div class="flex items-center gap-4">
                    <div x-data="{
                        copied: false,
                        shareUrl: '{{ request()->url() }}',
                        shareTitle: '{{ addslashes($post->title) }}'
                    }" class="flex flex-col gap-2">

                        <span class="text-[10px] font-black uppercase tracking-widest text-slate-400">Bagikan:</span>

                        <div class="flex gap-2">
                            <a :href="'https://api.whatsapp.com/send?text=' + encodeURIComponent(shareTitle + ' - ' + shareUrl)"
                                target="_blank" rel="noopener noreferrer" title="Bagikan ke WhatsApp"
                                class="w-10 h-10 rounded-2xl bg-slate-50 flex items-center justify-center text-slate-600 hover:bg-green-500 hover:text-white transition-all shadow-sm">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946C.06 5.348 5.397.01 12.008.01c3.202.001 6.212 1.246 8.477 3.514 2.266 2.268 3.507 5.28 3.505 8.484-.004 6.657-5.34 11.997-11.953 11.997-2.005-.001-3.973-.502-5.713-1.457L0 24zm6.59-4.846c1.66.986 3.288 1.479 5.342 1.48 5.432 0 9.865-4.437 9.868-9.877.001-2.636-1.026-5.112-2.892-6.98-1.866-1.867-4.346-2.894-6.984-2.895-5.436 0-9.87 4.438-9.874 9.879-.001 2.128.561 4.184 1.625 5.918L2.6 21.4l4.047-1.246zM17.421 14.34c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z" />
                                </svg>
                            </a>

                            <a :href="'https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(shareUrl)"
                                target="_blank" rel="noopener noreferrer" title="Bagikan ke Facebook"
                                class="w-10 h-10 rounded-2xl bg-slate-50 flex items-center justify-center text-slate-600 hover:bg-blue-600 hover:text-white transition-all shadow-sm">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                                </svg>
                            </a>

                            <button
                                @click="
                    navigator.clipboard.writeText(shareUrl); 
                    copied = true; 
                    setTimeout(() => copied = false, 2000)
                "
                                title="Salin tautan untuk Instagram"
                                class="w-10 h-10 rounded-2xl bg-slate-50 flex items-center justify-center text-slate-600 hover:bg-gradient-to-tr hover:from-yellow-500 hover:via-purple-600 hover:to-blue-500 hover:text-white transition-all shadow-sm relative">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.051.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z" />
                                </svg>
                            </button>
                        </div>

                        <div x-show="copied" x-transition
                            class="text-xs text-green-600 font-semibold bg-green-50 px-3 py-1.5 rounded-xl w-max shadow-sm border border-green-100"
                            style="display: none;">
                            ✓ Tautan disalin! Siap ditempel di Instagram.
                        </div>
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
                                        <svg class="w-8 h-8" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
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
