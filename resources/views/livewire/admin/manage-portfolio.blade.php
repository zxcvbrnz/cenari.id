<div class="max-w-7xl mx-auto p-4 md:p-8 space-y-8 pb-24" x-data>
    <div
        class="flex flex-col md:flex-row justify-between items-start md:items-center bg-white p-6 md:p-8 rounded-[2.5rem] border border-slate-100 shadow-sm gap-4">
        <div>
            <h1 class="text-2xl md:text-4xl font-black italic uppercase tracking-tighter text-slate-800">
                Project <span class="text-blue-600">Console</span>
            </h1>
            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1 italic">Tebar Kode Teknologi -
                Management System</p>
        </div>
        <div class="flex gap-2 w-full md:w-auto">
            @if ($view !== 'list')
                <button wire:click="$set('view', 'list')"
                    class="flex-1 md:flex-none bg-slate-100 text-slate-600 px-8 py-4 rounded-2xl font-black uppercase text-[10px] tracking-widest hover:bg-slate-200 transition-all">←
                    Back to List</button>
            @else
                <button wire:click="showForm()"
                    class="flex-1 md:flex-none bg-slate-900 text-white px-10 py-4 rounded-2xl font-black uppercase text-[10px] tracking-widest shadow-xl shadow-slate-200 hover:bg-blue-600 transition-all">+
                    New Project</button>
            @endif
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        <div class="lg:col-span-4 space-y-6">
            <div class="bg-white p-6 rounded-[2.5rem] border border-slate-100 shadow-sm">
                <h2
                    class="text-lg font-black italic uppercase mb-6 text-slate-800 underline decoration-blue-500 decoration-4 underline-offset-4">
                    Quick Categories</h2>
                <form wire:submit.prevent="saveCategory" class="flex gap-2 mb-6">
                    <input type="text" wire:model="newCategoryName" placeholder="Category Name..."
                        class="flex-1 bg-slate-50 border-none rounded-xl p-3 text-[11px] font-bold focus:ring-2 focus:ring-blue-500 shadow-inner">
                    <button type="submit" class="bg-slate-900 text-white px-4 rounded-xl font-black">+</button>
                </form>

                <div class="space-y-2 max-h-[400px] overflow-y-auto pr-2 custom-scrollbar">
                    @foreach ($allCategories as $cat)
                        <div
                            class="flex justify-between items-center bg-slate-50 p-3 rounded-2xl border border-transparent hover:border-blue-100 transition-all group">
                            <span
                                class="text-[11px] font-black uppercase italic text-slate-700">{{ $cat->name }}</span>
                            <button type="button"
                                @click="Swal.fire({
                                    title: 'Hapus Kategori?',
                                    text: 'Menghapus kategori \'{{ $cat->name }}\'?',
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonText: 'Ya, Hapus'
                                }).then((result) => { if (result.isConfirmed) $wire.deleteCategory({{ $cat->id }}, '{{ $cat->name }}') })"
                                class="opacity-0 group-hover:opacity-100 text-red-300 hover:text-red-500 transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
                                        stroke-width="2" stroke-linecap="round" />
                                </svg>
                            </button>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="lg:col-span-8">
            @if ($view === 'list')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 animate-fade-in">
                    @foreach ($portfolios as $p)
                        <div
                            class="bg-white p-3 rounded-[2.5rem] border border-slate-100 shadow-sm hover:shadow-xl transition-all group">
                            <div class="aspect-video rounded-[2rem] overflow-hidden relative bg-slate-100">
                                @php $featured = $p->images->where('is_featured', true)->first() ?? $p->images->first(); @endphp
                                @if ($featured)
                                    <img src="{{ asset('storage/' . $featured->filename) }}"
                                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                                @endif
                                <div
                                    class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition-opacity flex items-end p-6 gap-2">
                                    <button wire:click="showForm({{ $p->id }})"
                                        class="flex-1 bg-white text-slate-900 py-3 rounded-xl font-black uppercase text-[10px]">Edit
                                        Project</button>
                                    <button type="button"
                                        @click="Swal.fire({
                                            title: 'Hapus Project?',
                                            text: 'Project \'{{ $p->title }}\' akan dihapus permanen!',
                                            icon: 'error',
                                            showCancelButton: true,
                                            confirmButtonColor: '#ef4444'
                                        }).then((result) => { if (result.isConfirmed) $wire.deletePortfolio({{ $p->id }}, '{{ $p->title }}') })"
                                        class="bg-red-500 text-white p-3 rounded-xl">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
                                                stroke-width="2" stroke-linecap="round" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <div class="p-5">
                                <h3 class="font-black italic uppercase text-lg text-slate-800">{{ $p->title }}</h3>
                                <div class="flex flex-wrap gap-1 mt-2">
                                    @foreach ($p->tech ?? [] as $t)
                                        <span
                                            class="text-[7px] font-bold bg-slate-100 text-slate-500 px-2 py-0.5 rounded uppercase">#{{ $t }}</span>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="bg-white p-6 md:p-10 rounded-[3rem] border border-slate-100 shadow-sm animate-fade-in">
                    <form wire:submit.prevent="save" class="space-y-8">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="text-[10px] font-black uppercase text-slate-400 ml-1 italic">Project
                                    Title</label>
                                <input type="text" wire:model="title"
                                    class="w-full bg-slate-50 border-none rounded-2xl p-4 font-bold text-xs focus:ring-2 focus:ring-blue-500 shadow-inner">
                            </div>
                            <div class="space-y-2">
                                <label class="text-[10px] font-black uppercase text-slate-400 ml-1 italic">Client /
                                    Author</label>
                                <input type="text" wire:model="author"
                                    class="w-full bg-slate-50 border-none rounded-2xl p-4 font-bold text-xs focus:ring-2 focus:ring-blue-500 shadow-inner">
                            </div>
                        </div>

                        <div class="space-y-3">
                            <label
                                class="text-[10px] font-black uppercase text-blue-600 ml-1 tracking-widest italic">Project
                                Categories</label>
                            <div class="flex flex-wrap gap-2">
                                @foreach ($allCategories as $cat)
                                    <label class="cursor-pointer">
                                        <input type="checkbox" wire:model="selectedCategories"
                                            value="{{ $cat->id }}" class="hidden peer">
                                        <div
                                            class="px-4 py-2 rounded-xl border border-slate-100 bg-slate-50 text-[9px] font-black uppercase transition-all peer-checked:bg-blue-600 peer-checked:text-white">
                                            {{ $cat->name }}
                                        </div>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <div class="space-y-4 bg-slate-50 p-6 rounded-[2rem] border border-slate-100">
                            <label class="text-[10px] font-black uppercase text-slate-500 ml-1 italic">Technology
                                Stack</label>
                            <div class="flex gap-2">
                                <input type="text" wire:model="newTech" wire:keydown.enter.prevent="addTech"
                                    placeholder="Type & press Enter..."
                                    class="flex-1 bg-white border-none rounded-2xl p-4 font-bold text-xs focus:ring-2 focus:ring-blue-500 shadow-sm">
                                <button type="button" wire:click="addTech"
                                    class="bg-slate-900 text-white px-6 rounded-2xl font-black uppercase text-[10px]">Add</button>
                            </div>
                            <div class="flex flex-wrap gap-2">
                                @foreach ($tech as $index => $t)
                                    <div
                                        class="flex items-center gap-2 bg-white border px-3 py-1.5 rounded-xl shadow-sm italic">
                                        <span class="text-[9px] font-black uppercase text-slate-700">#
                                            {{ $t }}</span>
                                        <button type="button" wire:click="removeTech({{ $index }})"
                                            class="text-red-400 hover:text-red-600">×</button>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label class="text-[10px] font-black uppercase text-slate-400 ml-1 italic">Detailed
                                Description</label>
                            <textarea wire:model="description" rows="4"
                                class="w-full bg-slate-50 border-none rounded-2xl p-4 font-bold text-xs focus:ring-2 focus:ring-blue-500 shadow-inner"
                                placeholder="Explain the project goal and process..."></textarea>
                        </div>

                        <div class="space-y-4">
                            <label
                                class="text-[10px] font-black uppercase text-slate-400 tracking-widest italic">Project
                                Gallery</label>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                @foreach ($oldImages as $img)
                                    <div
                                        class="aspect-square rounded-2xl overflow-hidden relative group {{ $img->is_featured ? 'ring-4 ring-blue-500 ring-offset-2' : '' }}">
                                        <img src="{{ asset('storage/' . $img->filename) }}"
                                            class="w-full h-full object-cover">
                                        <div
                                            class="absolute inset-0 bg-black/70 opacity-0 group-hover:opacity-100 transition-all flex flex-col justify-center items-center gap-2 p-2">
                                            <button type="button" wire:click="setFeatured({{ $img->id }})"
                                                class="text-[7px] font-black uppercase bg-white px-3 py-1.5 rounded-xl w-full">{{ $img->is_featured ? 'Cover Photo' : 'Set as Cover' }}</button>
                                            <button type="button"
                                                @click="Swal.fire({ title: 'Hapus Gambar?', icon: 'error', showCancelButton: true }).then((result) => { if (result.isConfirmed) $wire.deleteImage({{ $img->id }}) })"
                                                class="text-[7px] font-black uppercase bg-red-500 text-white px-3 py-1.5 rounded-xl w-full">Delete</button>
                                        </div>
                                    </div>
                                @endforeach

                                @foreach ($images as $index => $image)
                                    <div
                                        class="aspect-square rounded-2xl overflow-hidden relative border-2 border-dashed border-blue-400">
                                        <img src="{{ $image->temporaryUrl() }}"
                                            class="w-full h-full object-cover opacity-60">
                                        <button type="button" wire:click="removeUpload({{ $index }})"
                                            class="absolute top-1 right-1 bg-red-500 text-white w-5 h-5 rounded-full text-xs">×</button>
                                    </div>
                                @endforeach

                                <label
                                    class="aspect-square rounded-2xl border-4 border-dashed border-slate-100 flex items-center justify-center cursor-pointer hover:bg-blue-50 transition-all relative overflow-hidden">
                                    <input type="file" wire:model="images" multiple class="hidden"
                                        accept="image/*">
                                    <div wire:loading.remove wire:target="images" class="text-center">
                                        <svg class="w-8 h-8 text-slate-300 mx-auto" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 4v16m8-8H4" stroke-width="3" stroke-linecap="round" />
                                        </svg>
                                        <span
                                            class="text-[8px] font-black uppercase text-slate-300 mt-2 block">Upload</span>
                                    </div>
                                    <div wire:loading wire:target="images"
                                        class="absolute inset-0 bg-white/90 backdrop-blur-sm z-50">
                                        <div
                                            class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 flex flex-col items-center">
                                            <div
                                                class="w-8 h-8 border-4 border-blue-600 border-t-transparent rounded-full animate-spin">
                                            </div>
                                            <span
                                                class="text-[7px] font-black text-blue-600 uppercase mt-2 tracking-widest">Processing</span>
                                        </div>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <button type="submit" wire:loading.attr="disabled"
                            class="w-full bg-blue-600 text-white py-6 rounded-3xl font-black uppercase text-xs tracking-[0.4em] shadow-2xl hover:bg-blue-700 transition-all disabled:opacity-50">
                            {{ $selectedId ? 'Update Project Console' : 'Publish New Project' }}
                        </button>
                    </form>
                </div>
            @endif
        </div>
    </div>
</div>
