<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-[10px] font-black uppercase tracking-[0.3em] text-blue-600 mb-4">Warta & Artikel</h2>
            <h3 class="text-4xl font-black text-slate-900 tracking-tighter italic">CENARI<span
                    class="text-blue-600">JOURNAL</span></h3>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
            @forelse($posts as $post)
                <article class="group">
                    <div
                        class="relative aspect-[16/10] overflow-hidden rounded-[2.5rem] bg-slate-100 mb-6 shadow-2xl shadow-slate-200/50">
                        @if ($post->featuredImage)
                            <img src="{{ asset('storage/' . $post->featuredImage->file_path) }}"
                                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                                alt="{{ $post->title }}">
                        @else
                            <div class="flex items-center justify-center h-full text-slate-300">
                                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"
                                        stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </div>
                        @endif
                    </div>

                    <div class="px-2">
                        <div class="flex items-center gap-3 mb-4">
                            <span
                                class="text-[10px] font-black text-blue-600 uppercase tracking-widest">{{ $post->created_at->format('d M Y') }}</span>
                        </div>

                        <h4
                            class="text-xl font-black text-slate-900 mb-3 group-hover:text-blue-600 transition-colors leading-tight">
                            {{ $post->title }}
                        </h4>

                        <p class="text-slate-500 text-sm leading-relaxed mb-6 line-clamp-2">
                            {{ $post->excerpt }}
                        </p>

                        <a href="{{ route('blog.show', [$post->slug]) }}" wire:navigate
                            class="inline-flex items-center gap-2 text-[11px] font-black uppercase tracking-widest text-slate-900 hover:text-blue-600 transition-colors">
                            Baca Selengkapnya
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M17 8l4 4m0 0l-4 4m4-4H3" stroke-width="2.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                        </a>
                    </div>
                </article>
            @empty
                <div
                    class="col-span-full text-center py-20 bg-slate-50 rounded-[3rem] border-2 border-dashed border-slate-100">
                    <p class="text-slate-400 font-bold uppercase tracking-widest text-xs">Belum ada artikel yang
                        diterbitkan.</p>
                </div>
            @endforelse
        </div>

        <div class="mt-20">
            {{ $posts->links() }}
        </div>
    </div>
</section>
