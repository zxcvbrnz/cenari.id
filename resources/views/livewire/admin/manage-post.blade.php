<div class="max-w-7xl mx-auto p-4 md:p-8 space-y-6" x-data>

    <div
        class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm flex justify-between items-center transition-all">
        <div>
            <h1 class="text-2xl font-black italic uppercase tracking-tighter text-slate-800">Post <span
                    class="text-blue-600">Manager</span></h1>
            <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest mt-1 italic">Tebar Kode Teknologi •
                Content System</p>
        </div>
        <button wire:click="{{ $view === 'list' ? 'showForm()' : '$set(\'view\', \'list\')' }}"
            class="bg-slate-900 text-white px-6 py-3 rounded-xl font-black uppercase text-[10px] tracking-widest transition-all hover:bg-blue-600 shadow-lg shadow-slate-100 active:scale-95">
            {{ $view === 'list' ? '+ Create Post' : '← Cancel & Back' }}
        </button>
    </div>

    @if ($view === 'list')
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 animate-fade-in">
            @foreach ($posts as $post)
                <div
                    class="bg-white p-3 rounded-[2.5rem] border border-slate-100 shadow-sm hover:border-blue-200 hover:shadow-xl transition-all group">
                    <div class="aspect-video rounded-[2rem] overflow-hidden bg-slate-100 relative">
                        @if ($post->featuredImage)
                            <img src="{{ asset('storage/' . $post->featuredImage->filename) }}"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-slate-300">
                                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </div>
                        @endif
                        <div class="absolute top-4 right-4">
                            <span
                                class="{{ $post->is_published ? 'bg-green-500' : 'bg-amber-500' }} text-white text-[7px] font-black uppercase px-3 py-1 rounded-full shadow-lg">
                                {{ $post->is_published ? 'Published' : 'Draft' }}
                            </span>
                        </div>
                    </div>
                    <div class="p-5 space-y-4">
                        <div>
                            <h3
                                class="font-black italic uppercase text-lg text-slate-800 leading-tight mb-2 line-clamp-1">
                                {{ $post->title }}</h3>
                            <p class="text-[10px] text-slate-400 font-medium line-clamp-2 italic leading-relaxed">
                                {{ $post->excerpt }}</p>
                        </div>
                        <div class="flex gap-2 pt-2">
                            <button wire:click="showForm({{ $post->id }})"
                                class="flex-1 bg-slate-900 text-white py-3 rounded-xl font-black uppercase text-[9px] tracking-widest active:scale-95 transition-all">Edit
                                Post</button>

                            <button type="button"
                                @click="Swal.fire({
                                    title: 'Hapus Artikel?',
                                    text: `Artikel '{{ $post->title }}' akan dihapus permanen.`,
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonColor: '#ef4444',
                                    confirmButtonText: 'Ya, Hapus!',
                                    cancelButtonText: 'Batal'
                                }).then((result) => { if (result.isConfirmed) $wire.deletePost({{ $post->id }}) })"
                                class="bg-red-50 text-red-400 p-3 rounded-xl hover:bg-red-500 hover:text-white transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="bg-white p-6 md:p-12 rounded-[3rem] border border-slate-100 shadow-sm animate-fade-in">
            <form wire:submit.prevent="save" class="space-y-10">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">

                    <div class="lg:col-span-2 space-y-6">
                        <div class="space-y-2">
                            <label class="text-[10px] font-black uppercase text-slate-400 ml-1 tracking-widest">Post
                                Title</label>
                            <input type="text" wire:model="title"
                                class="w-full bg-slate-50 border-none rounded-2xl p-5 text-base font-black uppercase italic text-slate-700 focus:ring-2 focus:ring-blue-500 shadow-inner">
                        </div>

                        <div class="space-y-2">
                            <label class="text-[10px] font-black uppercase text-slate-400 ml-1 tracking-widest">Main
                                Content (Body)</label>
                            <textarea wire:model="body" rows="15"
                                class="w-full bg-slate-50 border-none rounded-3xl p-6 text-sm font-medium leading-relaxed text-slate-600 focus:ring-2 focus:ring-blue-500 shadow-inner"
                                placeholder="Tulis artikel lengkap di sini..."></textarea>
                        </div>
                    </div>

                    <div class="space-y-8">
                        <div class="bg-slate-50 p-6 rounded-[2rem] space-y-6 border border-slate-100 shadow-sm">
                            <div class="flex items-center justify-between">
                                <div class="flex flex-col">
                                    <span
                                        class="text-[10px] font-black uppercase text-slate-800 tracking-widest">Visibility</span>
                                    <span
                                        class="text-[8px] font-bold text-slate-400 uppercase italic">{{ $is_published ? 'Post is Live' : 'Post is Hidden' }}</span>
                                </div>
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" wire:model="is_published" class="sr-only peer">
                                    <div
                                        class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600">
                                    </div>
                                </label>
                            </div>

                            <div class="space-y-2">
                                <label
                                    class="text-[10px] font-black uppercase text-slate-400 ml-1 tracking-widest">Excerpt
                                    (Ringkasan)</label>
                                <textarea wire:model="excerpt"
                                    class="w-full bg-white border-none rounded-xl p-4 text-[11px] font-bold italic text-slate-500 leading-normal shadow-sm"
                                    rows="4" placeholder="Brief summary of the article..."></textarea>
                            </div>
                        </div>

                        <div class="space-y-4">
                            <label
                                class="text-[10px] font-black uppercase text-slate-400 ml-1 tracking-widest italic">Images
                                Gallery</label>
                            <div class="grid grid-cols-2 gap-3">
                                @foreach ($oldImages as $img)
                                    <div
                                        class="aspect-square rounded-2xl overflow-hidden relative group border-2 {{ $img->is_featured ? 'border-blue-500 shadow-lg' : 'border-transparent' }}">
                                        <img src="{{ asset('storage/' . $img->filename) }}"
                                            class="w-full h-full object-cover">
                                        <div
                                            class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition-all flex flex-col items-center justify-center gap-2 p-2">
                                            <button type="button" wire:click="setFeatured({{ $img->id }})"
                                                class="w-full bg-blue-600 text-white text-[7px] font-black uppercase py-2 rounded-lg shadow-xl hover:bg-blue-700">Set
                                                Cover</button>
                                            <button type="button"
                                                @click="Swal.fire({ title: 'Hapus Gambar?', icon: 'warning', showCancelButton: true }).then((r) => { if(r.isConfirmed) $wire.deleteImage({{ $img->id }}) })"
                                                class="w-full bg-red-500 text-white text-[7px] font-black uppercase py-2 rounded-lg shadow-xl hover:bg-red-600">Delete</button>
                                        </div>
                                    </div>
                                @endforeach

                                @foreach ($images as $index => $image)
                                    <div
                                        class="aspect-square rounded-2xl overflow-hidden relative border-2 border-dashed border-blue-400 animate-pulse">
                                        <img src="{{ $image->temporaryUrl() }}"
                                            class="w-full h-full object-cover opacity-60">
                                        <button type="button" wire:click="removeUpload({{ $index }})"
                                            class="absolute top-1 right-1 bg-red-500 text-white w-5 h-5 rounded-full text-xs font-black">×</button>
                                    </div>
                                @endforeach

                                <label
                                    class="aspect-square rounded-2xl border-4 border-dashed border-slate-100 flex flex-col items-center justify-center cursor-pointer hover:bg-blue-50 hover:border-blue-200 transition-all relative overflow-hidden">
                                    <input type="file" wire:model="images" multiple class="hidden" accept="image/*">

                                    <div wire:loading.remove wire:target="images" class="flex flex-col items-center">
                                        <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path d="M12 4v16m8-8H4" stroke-width="3" stroke-linecap="round" />
                                        </svg>
                                        <span class="text-[8px] font-black uppercase text-slate-300 mt-2">Upload</span>
                                    </div>

                                    <div wire:loading wire:target="images"
                                        class="absolute inset-0 bg-white/90 backdrop-blur-sm z-50">
                                        <div
                                            class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 flex flex-col items-center">
                                            <div
                                                class="w-8 h-8 border-4 border-blue-600 border-t-transparent rounded-full animate-spin">
                                            </div>
                                            <span
                                                class="text-[7px] font-black text-blue-600 uppercase mt-2 tracking-widest text-center">Processing...</span>
                                        </div>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <button type="submit" wire:loading.attr="disabled"
                    class="w-full bg-blue-600 text-white py-6 rounded-3xl font-black uppercase text-xs tracking-[0.4em] shadow-2xl shadow-blue-100 hover:bg-blue-700 active:scale-95 transition-all disabled:opacity-50">
                    <span wire:loading.remove
                        wire:target="save">{{ $selectedId ? 'Update Article' : 'Publish Article' }}</span>
                    <span wire:loading wire:target="save">Saving Project...</span>
                </button>
            </form>
        </div>
    @endif
</div>
