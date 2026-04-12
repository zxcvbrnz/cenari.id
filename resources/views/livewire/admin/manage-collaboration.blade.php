<div class="bg-white p-8 rounded-[3rem] border border-slate-100 shadow-sm space-y-8">

    <div class="flex flex-col md:flex-row justify-between items-center gap-4">
        <div>
            <h2 class="text-2xl font-black italic uppercase tracking-tighter">Brand <span
                    class="text-blue-600">Collaborations</span></h2>
            <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest mt-1">Manage partner logos &
                associations</p>
        </div>
        <button wire:click="{{ $view === 'list' ? 'showForm()' : '$set(\'view\', \'list\')' }}"
            class="w-full md:w-auto bg-slate-900 text-white px-8 py-4 rounded-2xl font-black uppercase text-[10px] tracking-widest shadow-lg hover:bg-blue-600 transition-all">
            {{ $view === 'list' ? '+ Add Partner' : '← Back' }}
        </button>
    </div>

    @if ($view === 'list')
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-6 animate-fade-in">
            @forelse($partners as $partner)
                <div
                    class="aspect-square bg-slate-50 rounded-[2.5rem] border border-slate-100 flex flex-col items-center justify-center p-6 group relative overflow-hidden transition-all hover:border-blue-200 shadow-inner">
                    <img src="{{ asset('storage/' . $partner->image) }}"
                        class="max-h-full max-w-full object-contain grayscale group-hover:grayscale-0 transition-all duration-500 opacity-60 group-hover:opacity-100">

                    <div
                        class="absolute inset-0 bg-blue-600/90 opacity-0 group-hover:opacity-100 flex items-center justify-center gap-3 transition-all">
                        <button wire:click="showForm({{ $partner->id }})"
                            class="bg-white p-3 rounded-xl text-slate-900 hover:scale-110 transition-transform shadow-lg">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"
                                    stroke-width="2.5" />
                            </svg>
                        </button>
                        <button type="button"
                            @click="Swal.fire({
                                title: 'Hapus Partner?',
                                text: 'Logo {{ $partner->name }} akan dihapus permanen!',
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#ef4444',
                                cancelButtonColor: '#94a3b8',
                                confirmButtonText: 'Ya, Hapus!',
                                cancelButtonText: 'Batal',
                                borderRadius: '2.5rem',
                                customClass: {
                                    title: 'font-black uppercase italic tracking-tighter',
                                    confirmButton: 'rounded-2xl font-bold uppercase tracking-widest text-[10px] px-6 py-3',
                                    cancelButton: 'rounded-2xl font-bold uppercase tracking-widest text-[10px] px-6 py-3'
                                }
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    $wire.delete({{ $partner->id }})
                                }
                            })"
                            class="bg-red-500 p-3 rounded-xl text-white hover:scale-110 transition-transform shadow-lg">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
                                    stroke-width="2.5" />
                            </svg>
                        </button>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-20 text-center bg-slate-50 rounded-[3rem] border border-dashed">
                    <p class="text-[10px] font-black uppercase text-slate-300 tracking-widest">No partners registered
                    </p>
                </div>
            @endforelse
        </div>
    @else
        <form wire:submit.prevent="save" class="max-w-xl mx-auto space-y-6 animate-fade-in">
            <div class="space-y-2">
                <label class="text-[10px] font-black uppercase text-slate-400 tracking-widest ml-1">Partner Name</label>
                <input type="text" wire:model="name"
                    class="w-full bg-slate-50 border-none rounded-2xl p-5 text-sm font-black uppercase italic text-slate-700 focus:ring-2 focus:ring-blue-500 shadow-inner">
            </div>

            <div class="space-y-2">
                <label class="text-[10px] font-black uppercase text-slate-400 tracking-widest ml-1">Logo Image</label>
                <div class="relative group">
                    <input type="file" wire:model="image" class="absolute inset-0 opacity-0 cursor-pointer z-10">
                    <div
                        class="w-full bg-slate-50 border-2 border-dashed border-slate-200 rounded-[2rem] p-12 text-center transition-all group-hover:border-blue-400">
                        @if ($image)
                            <img src="{{ $image->temporaryUrl() }}" class="max-h-32 mx-auto rounded-xl shadow-md">
                        @else
                            <svg class="w-12 h-12 text-slate-200 mx-auto mb-2" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"
                                    stroke-width="2" />
                            </svg>
                            <p class="text-[9px] font-black uppercase text-slate-400">Click to upload logo</p>
                        @endif
                    </div>
                    <div wire:loading wire:target="image" class="absolute inset-0 z-50 bg-white/90 backdrop-blur-sm">
                        <div
                            class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 flex flex-col items-center w-full">
                            <svg class="animate-spin h-10 w-10 text-blue-600 mb-3" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4"></circle>
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

            <button type="submit"
                class="w-full bg-blue-600 text-white py-6 rounded-3xl font-black uppercase text-xs tracking-[0.4em] shadow-2xl hover:bg-blue-700 transition-all">
                Save Partner
            </button>
        </form>
    @endif
</div>
