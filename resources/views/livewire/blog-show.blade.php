<article class="max-w-4xl mx-auto px-6 py-12">

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

        {{-- <div class="flex items-center justify-between py-6 border-y border-slate-100">
            <div class="flex items-center gap-4">
                <div
                    class="w-12 h-12 rounded-full bg-blue-600 flex items-center justify-center text-white font-black text-xs">
                    C
                </div>
                <div>
                    <p class="text-[11px] font-black uppercase tracking-widest text-slate-900">Redaksi Cenari</p>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">
                        {{ $post->created_at->format('d F Y') }}</p>
                </div>
            </div>

            <div class="hidden md:flex items-center gap-6">
                <div class="text-right">
                    <p class="text-[10px] font-black uppercase tracking-widest text-slate-400">Waktu Baca</p>
                    <p class="text-[11px] font-black text-slate-900 uppercase">5 Menit</p>
                </div>
            </div>
        </div> --}}
    </header>

    <figure class="mb-16">
        <div class="rounded-[3rem] overflow-hidden shadow-2xl shadow-blue-500/10 aspect-[16/9] bg-slate-100">
            @if ($post->featuredImage)
                <img src="{{ asset('storage/' . $post->featuredImage->filename) }}" alt="{{ $post->title }}"
                    class="w-full h-full object-cover transition-transform duration-700 hover:scale-105">
            @else
                <div class="w-full h-full flex items-center justify-center text-slate-300">
                    <svg class="w-20 h-20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"
                            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
            @endif
        </div>
        @if ($post->excerpt)
            <figcaption class="mt-6 text-center text-sm italic text-slate-400 font-medium px-10">
                "{{ $post->excerpt }}"
            </figcaption>
        @endif
    </figure>

    <div
        class="prose prose-slate prose-lg max-w-none 
                prose-headings:font-black prose-headings:tracking-tighter prose-headings:italic 
                prose-p:text-slate-600 prose-p:leading-relaxed 
                prose-strong:text-slate-900 prose-a:text-blue-600 
                prose-img:rounded-[2rem] prose-img:shadow-lg">

        {!! nl2br($post->body) !!}

    </div>

    <footer class="mt-20 pt-10 border-t border-slate-100 flex flex-col md:flex-row items-center justify-between gap-8">
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
