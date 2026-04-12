<div class="max-w-6xl mx-auto p-4 md:p-8 space-y-6">

    <div
        class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm flex flex-col md:flex-row justify-between items-center gap-4">
        <div>
            <h1 class="text-2xl font-black italic uppercase tracking-tighter">Schedule <span
                    class="text-blue-600">Agendas</span></h1>
            <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest mt-1 italic">Organize your timeline
                efficiently</p>
        </div>
        <button wire:click="{{ $view === 'list' ? 'showForm()' : '$set(\'view\', \'list\')' }}"
            class="w-full md:w-auto bg-slate-900 text-white px-8 py-4 rounded-2xl font-black uppercase text-[10px] tracking-widest shadow-lg hover:bg-blue-600 transition-all">
            {{ $view === 'list' ? '+ New Agenda' : '← Back to List' }}
        </button>
    </div>

    @if ($view === 'list')
        <div class="space-y-4 animate-fade-in">
            @forelse($agendas as $agenda)
                <div
                    class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm flex flex-col md:flex-row items-center gap-6 group hover:border-blue-200 transition-all">

                    <div
                        class="flex flex-col items-center justify-center bg-slate-50 w-24 h-24 rounded-3xl group-hover:bg-blue-600 transition-all duration-500 shadow-inner">
                        <span
                            class="text-[10px] font-black uppercase text-slate-400 group-hover:text-white/70">{{ \Carbon\Carbon::parse($agenda->date)->format('M') }}</span>
                        <span
                            class="text-3xl font-black italic text-slate-800 group-hover:text-white leading-none">{{ \Carbon\Carbon::parse($agenda->date)->format('d') }}</span>
                    </div>

                    <div class="flex-1 space-y-2 text-center md:text-left">
                        <div class="flex flex-wrap justify-center md:justify-start items-center gap-3">
                            <h3
                                class="font-black italic uppercase text-lg text-slate-800 group-hover:text-blue-600 transition-colors">
                                {{ $agenda->title }}</h3>
                            <span
                                class="{{ $agenda->is_active ? 'bg-green-100 text-green-600' : 'bg-slate-100 text-slate-400' }} text-[8px] font-black uppercase px-2 py-1 rounded-lg">
                                {{ $agenda->is_active ? 'Active' : 'Closed' }}
                            </span>
                        </div>
                        <div
                            class="flex flex-wrap justify-center md:justify-start gap-4 text-[10px] font-bold text-slate-400 uppercase tracking-tight">
                            <span class="flex items-center gap-1.5">
                                <svg class="w-3.5 h-3.5 text-blue-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" stroke-width="2.5"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                {{ $agenda->time }}
                            </span>
                            <span class="flex items-center gap-1.5">
                                <svg class="w-3.5 h-3.5 text-blue-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"
                                        stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" stroke-width="2.5" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                                {{ $agenda->location }}
                            </span>
                        </div>
                        @if ($agenda->description)
                            <p class="text-[10px] text-slate-400 line-clamp-1 italic">{{ $agenda->description }}</p>
                        @endif
                    </div>

                    <div class="flex gap-2">
                        <button wire:click="showForm({{ $agenda->id }})"
                            class="bg-slate-900 text-white p-4 rounded-2xl hover:bg-blue-600 active:scale-90 transition-all shadow-md">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"
                                    stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </button>

                        <button type="button"
                            @click="Swal.fire({
                                title: 'Hapus Agenda?',
                                text: 'Agenda \'{{ $agenda->title }}\' akan dihapus secara permanen.',
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#ef4444',
                                confirmButtonText: 'Ya, Hapus!',
                                cancelButtonText: 'Batal',
                                borderRadius: '2rem'
                            }).then((result) => { if (result.isConfirmed) $wire.deleteAgenda({{ $agenda->id }}) })"
                            class="bg-red-50 text-red-400 p-4 rounded-2xl hover:bg-red-500 hover:text-white active:scale-90 transition-all shadow-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
                                    stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </button>
                    </div>
                </div>
            @empty
                <div class="text-center py-20 bg-slate-50 rounded-[3rem] border border-dashed border-slate-200">
                    <div
                        class="bg-white w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 shadow-sm">
                        <svg class="w-6 h-6 text-slate-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </div>
                    <p class="text-[10px] font-black uppercase text-slate-300 tracking-[0.3em]">No agenda found</p>
                </div>
            @endforelse
        </div>
    @else
        <div
            class="bg-white p-6 md:p-12 rounded-[3rem] border border-slate-100 max-w-4xl mx-auto shadow-sm animate-fade-in">
            <form wire:submit.prevent="save" class="space-y-8">
                <div class="space-y-6">
                    <div class="space-y-2">
                        <label class="text-[10px] font-black uppercase text-slate-400 ml-1 tracking-widest">Agenda
                            Title</label>
                        <input type="text" wire:model="title"
                            class="w-full bg-slate-50 border-none rounded-2xl p-5 text-sm font-black uppercase italic text-slate-700 focus:ring-2 focus:ring-blue-500 shadow-inner"
                            placeholder="Contoh: Rapat Kerja Internal">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label
                                class="text-[10px] font-black uppercase text-slate-400 ml-1 tracking-widest">Date</label>
                            <input type="date" wire:model="date"
                                class="w-full bg-slate-50 border-none rounded-2xl p-4 font-bold text-xs focus:ring-2 focus:ring-blue-500 shadow-inner text-slate-600">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-black uppercase text-slate-400 ml-1 tracking-widest">Time
                                (e.g 10:00 AM)</label>
                            <input type="text" wire:model="time"
                                class="w-full bg-slate-50 border-none rounded-2xl p-4 font-bold text-xs uppercase focus:ring-2 focus:ring-blue-500 shadow-inner"
                                placeholder="09:00 WIB - Selesai">
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label
                            class="text-[10px] font-black uppercase text-slate-400 ml-1 tracking-widest">Location</label>
                        <input type="text" wire:model="location"
                            class="w-full bg-slate-50 border-none rounded-2xl p-4 font-bold text-xs uppercase focus:ring-2 focus:ring-blue-500 shadow-inner"
                            placeholder="Sekolah Robot Banjarmasin / G-Meet">
                    </div>

                    <div class="space-y-2">
                        <label
                            class="text-[10px] font-black uppercase text-slate-400 ml-1 tracking-widest">Description</label>
                        <textarea wire:model="description" rows="4"
                            class="w-full bg-slate-50 border-none rounded-3xl p-6 text-xs font-medium text-slate-600 focus:ring-2 focus:ring-blue-500 shadow-inner"
                            placeholder="Detail agenda..."></textarea>
                    </div>

                    <div class="flex items-center gap-4 bg-slate-50 p-5 rounded-3xl border border-slate-100/50">
                        <div class="flex-1">
                            <span class="text-[10px] font-black uppercase text-slate-400 tracking-widest block">Status
                                Agenda</span>
                            <p class="text-[9px] text-slate-300 uppercase font-bold">Munculkan di timeline utama?</p>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" wire:model="is_active" class="sr-only peer">
                            <div
                                class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600">
                            </div>
                        </label>
                    </div>
                </div>

                <button type="submit"
                    class="w-full bg-blue-600 text-white py-6 rounded-3xl font-black uppercase text-xs tracking-[0.4em] shadow-2xl shadow-blue-100 hover:bg-blue-700 active:scale-95 transition-all">
                    {{ $selectedId ? 'Update Agenda' : 'Publish Agenda' }}
                </button>
            </form>
        </div>
    @endif
</div>
