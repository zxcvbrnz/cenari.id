<div class="max-w-7xl mx-auto p-4 md:p-8 space-y-6" x-data>

    <div
        class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm flex flex-col md:flex-row justify-between items-center gap-4">
        <div>
            <h1 class="text-2xl font-black italic uppercase tracking-tighter text-slate-800">Event <span
                    class="text-blue-600">Scheduler</span></h1>
            <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest mt-1 italic">Manage Workshops,
                Seminars & Bootcamps</p>
        </div>
        <button wire:click="{{ $view === 'list' ? 'showForm()' : '$set(\'view\', \'list\')' }}"
            class="w-full md:w-auto bg-slate-900 text-white px-8 py-4 rounded-2xl font-black uppercase text-[10px] tracking-[0.2em] shadow-lg hover:bg-blue-600 transition-all active:scale-95">
            {{ $view === 'list' ? '+ Create Event' : '← Back to List' }}
        </button>
    </div>

    @if ($view === 'list')
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 animate-fade-in">
            @foreach ($workshops as $w)
                <div
                    class="bg-white p-3 rounded-[2.5rem] border border-slate-100 shadow-sm relative group overflow-hidden transition-all hover:shadow-xl hover:border-blue-100">

                    <div class="absolute top-6 left-6 z-10">
                        <span
                            class="bg-white/90 backdrop-blur-md px-3 py-1.5 rounded-xl text-[8px] font-black uppercase tracking-widest shadow-sm text-slate-700 border border-slate-100">
                            {{ $w->type }}
                        </span>
                    </div>

                    <div class="aspect-[4/3] rounded-[2rem] overflow-hidden bg-slate-100 relative">
                        <img src="{{ asset('storage/' . $w->image) }}"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">

                        <div
                            class="absolute inset-0 bg-slate-900/60 opacity-0 group-hover:opacity-100 transition-all duration-300 flex items-center justify-center gap-3 backdrop-blur-[2px]">
                            <button wire:click="showForm({{ $w->id }})"
                                class="bg-white text-slate-900 px-5 py-2.5 rounded-xl font-black uppercase text-[9px] tracking-widest active:scale-90 transition-all hover:bg-blue-50">Edit</button>

                            <button type="button"
                                @click="Swal.fire({
                                    title: 'Hapus Event?',
                                    text: `Event '{{ $w->title }}' akan dihapus permanen.`,
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonColor: '#ef4444',
                                    confirmButtonText: 'Ya, Hapus!',
                                    cancelButtonText: 'Batal'
                                }).then((result) => { if (result.isConfirmed) $wire.deleteWorkshop({{ $w->id }}) })"
                                class="bg-red-500 text-white px-5 py-2.5 rounded-xl font-black uppercase text-[9px] tracking-widest active:scale-90 transition-all hover:bg-red-600">
                                Delete
                            </button>
                        </div>
                    </div>

                    <div class="p-5 space-y-3">
                        <div class="flex justify-between items-start gap-2">
                            <h3
                                class="font-black italic uppercase text-lg text-slate-800 leading-tight flex-1 line-clamp-2">
                                {{ $w->title }}</h3>
                            <span
                                class="text-[10px] font-black text-blue-600 bg-blue-50 px-3 py-1.5 rounded-lg whitespace-nowrap"
                                style="color: {{ $w->color }}; background-color: {{ $w->color }}15">
                                {{ $w->price }}
                            </span>
                        </div>

                        <div class="flex items-center gap-4 border-t border-slate-50 pt-4">
                            <div class="text-[9px] font-bold text-slate-500 uppercase">
                                <p class="flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5 text-blue-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"
                                            stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    {{ $w->date_string }}
                                </p>
                                <p class="italic text-slate-400 ml-5 mt-0.5">{{ $w->time_string }}</p>
                            </div>
                            <div class="ml-auto">
                                <span
                                    class="text-[8px] font-black uppercase px-2.5 py-1.5 rounded-lg {{ $w->status === 'Open' ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600' }}">
                                    {{ $w->status }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div
            class="bg-white p-6 md:p-12 rounded-[3rem] border border-slate-100 max-w-7xl mx-auto shadow-sm animate-fade-in overflow-hidden">
            <form wire:submit.prevent="save" class="space-y-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-12">

                    <div class="space-y-5">
                        <div class="space-y-2">
                            <label class="text-[10px] font-black uppercase text-slate-400 ml-1 tracking-widest">Event
                                Title</label>
                            <input type="text" wire:model="title"
                                class="w-full bg-slate-50 border-none rounded-2xl p-4 font-bold text-xs uppercase focus:ring-2 focus:ring-blue-500 shadow-inner"
                                placeholder="e.g Dasar IoT Laravel">
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div class="space-y-2">
                                <label class="text-[10px] font-black uppercase text-slate-400 ml-1 tracking-widest">Date
                                    (String)</label>
                                <input type="text" wire:model="date_string"
                                    class="w-full bg-slate-50 border-none rounded-2xl p-4 font-bold text-xs uppercase focus:ring-2 focus:ring-blue-500 shadow-inner"
                                    placeholder="25 Maret 2024">
                            </div>
                            <div class="space-y-2">
                                <label class="text-[10px] font-black uppercase text-slate-400 ml-1 tracking-widest">Time
                                    (String)</label>
                                <input type="text" wire:model="time_string"
                                    class="w-full bg-slate-50 border-none rounded-2xl p-4 font-bold text-xs uppercase focus:ring-2 focus:ring-blue-500 shadow-inner"
                                    placeholder="09:00 - 15:00 WIB">
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div class="space-y-2">
                                <label
                                    class="text-[10px] font-black uppercase text-slate-400 ml-1 tracking-widest">Type</label>
                                <select wire:model="type"
                                    class="w-full bg-slate-50 border-none rounded-2xl p-4 font-bold text-xs uppercase focus:ring-2 focus:ring-blue-500 shadow-inner">
                                    <option value="">Pilih...</option>
                                    <option value="Workshop">Workshop</option>
                                    <option value="Seminar">Seminar</option>
                                    <option value="Bootcamp">Bootcamp</option>
                                    <option value="OnSchool">OnSchool</option>
                                </select>
                            </div>
                            <div class="space-y-2">
                                <label
                                    class="text-[10px] font-black uppercase text-slate-400 ml-1 tracking-widest">Price /
                                    Cost</label>
                                <input type="text" wire:model="price"
                                    class="w-full bg-slate-50 border-none rounded-2xl p-4 font-bold text-xs uppercase focus:ring-2 focus:ring-blue-500 shadow-inner"
                                    placeholder="Free atau Rp 50.000">
                            </div>
                        </div>
                    </div>

                    <div class="space-y-5">
                        <div class="space-y-2 text-center">
                            <label
                                class="text-[10px] font-black uppercase text-slate-400 tracking-widest block text-left ml-1">Event
                                Poster</label>
                            <div
                                class="bg-slate-50 rounded-[2rem] border-4 border-dashed border-slate-200 p-4 min-h-[200px] flex flex-col items-center justify-center relative group transition-all hover:border-blue-300 overflow-hidden">

                                @if ($image)
                                    <img src="{{ $image->temporaryUrl() }}"
                                        class="w-full aspect-video object-cover rounded-2xl shadow-lg">
                                @elseif($old_image)
                                    <img src="{{ asset('storage/' . $old_image) }}"
                                        class="w-full aspect-video object-cover rounded-2xl opacity-60">
                                @endif

                                <input type="file" wire:model="image"
                                    class="absolute inset-0 opacity-0 cursor-pointer z-10">

                                <div wire:loading.remove wire:target="image" class="mt-2 flex flex-col items-center">
                                    <svg class="w-6 h-6 text-slate-300" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <p class="text-[8px] font-black uppercase text-slate-400 mt-1">Click to upload
                                        poster</p>
                                </div>

                                <div wire:loading wire:target="image"
                                    class="absolute inset-0 z-50 bg-white/90 backdrop-blur-sm">
                                    <div
                                        class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 flex flex-col items-center w-full">
                                        <svg class="animate-spin h-10 w-10 text-blue-600 mb-3"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10"
                                                stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor"
                                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                            </path>
                                        </svg>
                                        <span
                                            class="text-[10px] font-black uppercase tracking-[0.2em] text-blue-600">Uploading...</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div class="space-y-2">
                                <label
                                    class="text-[10px] font-black uppercase text-slate-400 ml-1 tracking-widest">Status</label>
                                <select wire:model="status"
                                    class="w-full bg-slate-50 border-none rounded-2xl p-4 font-bold text-xs uppercase focus:ring-2 focus:ring-blue-500 shadow-inner">
                                    <option value="Open">Open</option>
                                    <option value="Closed">Closed</option>
                                </select>
                            </div>
                            <div class="space-y-2">
                                <label
                                    class="text-[10px] font-black uppercase text-slate-400 ml-1 tracking-widest">Brand
                                    Color</label>
                                <div
                                    class="flex gap-2 items-center bg-slate-50 p-2 rounded-2xl border border-transparent focus-within:ring-2 focus-within:ring-blue-500 transition-all shadow-inner">
                                    <input type="color" wire:model="color"
                                        class="w-10 h-10 bg-transparent border-none cursor-pointer">
                                    <span
                                        class="text-[10px] font-mono font-bold text-slate-400 uppercase">{{ $color }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <button type="submit" wire:loading.attr="disabled"
                    class="w-full bg-blue-600 text-white py-6 rounded-3xl font-black uppercase text-xs tracking-[0.4em] shadow-2xl shadow-blue-200 hover:bg-blue-700 active:scale-95 transition-all disabled:opacity-50">
                    <span wire:loading.remove wire:target="save">
                        {{ $selectedId ? 'Update Event Schedule' : 'Publish Event Schedule' }}
                    </span>
                    <span wire:loading wire:target="save">Saving Schedule...</span>
                </button>
            </form>
        </div>
    @endif
</div>
