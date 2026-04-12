<div class="max-w-7xl mx-auto p-4 md:p-8 space-y-6">

    <div
        class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm flex flex-col md:flex-row justify-between items-center gap-4">
        <div>
            <h1 class="text-2xl font-black italic uppercase tracking-tighter">Curriculum <span
                    class="text-blue-600">Manager</span></h1>
            <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest mt-1">Update Learning Materials &
                Outcomes</p>
        </div>
        @if ($view === 'form')
            <button wire:click="cancel"
                class="w-full md:w-auto bg-slate-900 text-white px-8 py-4 rounded-2xl font-black uppercase text-[10px] tracking-[0.2em] shadow-lg hover:bg-blue-600 transition-all">
                ← Back to List
            </button>
        @endif
    </div>

    @if ($view === 'list')
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 animate-fade-in">
            @foreach ($curriculums as $item)
                <div
                    class="bg-white p-3 rounded-[2.5rem] border border-slate-100 shadow-sm relative group overflow-hidden">
                    <div class="p-6 space-y-6">
                        <div class="flex justify-between items-start">
                            <div
                                class="bg-blue-50 text-blue-600 px-4 py-2 rounded-xl text-[10px] font-black uppercase tracking-widest">
                                Level: {{ $item->level }}
                            </div>
                        </div>

                        <div class="space-y-3">
                            <h3 class="font-black italic uppercase text-xl text-slate-800 leading-tight">Materi
                                {{ $item->level }}</h3>
                            <div class="text-[11px] text-slate-500 font-medium leading-relaxed line-clamp-4 italic">
                                "{{ $item->materi }}"
                            </div>
                        </div>

                        <div class="bg-slate-50 rounded-2xl p-4 border border-slate-100">
                            <p class="text-[8px] font-black uppercase text-slate-400 mb-1 tracking-widest">Expected
                                Outcome</p>
                            <p class="text-[10px] font-bold text-slate-700 uppercase">{{ $item->outcome }}</p>
                        </div>

                        <button wire:click="edit({{ $item->id }})"
                            class="w-full bg-slate-900 text-white py-4 rounded-2xl font-black uppercase text-[9px] tracking-[0.2em] hover:bg-blue-600 transition-all shadow-md group-hover:shadow-blue-200">
                            Edit Curriculum
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div
            class="bg-white p-6 md:p-12 rounded-[3rem] border border-slate-100 max-w-7xl mx-auto shadow-sm animate-fade-in">
            <div class="mb-8 text-center">
                <span
                    class="bg-blue-100 text-blue-600 px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-widest">Editing
                    Mode</span>
                <h2 class="text-3xl font-black italic uppercase text-slate-800 mt-4 tracking-tighter">Level
                    {{ $level }}</h2>
            </div>

            <form wire:submit.prevent="save" class="space-y-8">
                <div class="space-y-6">
                    <div class="space-y-2">
                        <label
                            class="text-[10px] font-black uppercase text-slate-400 ml-2 tracking-widest text-center">Learning
                            Materials</label>
                        <textarea wire:model="materi" rows="10"
                            class="w-full bg-slate-50 border-none rounded-[2rem] p-6 font-bold text-xs leading-relaxed focus:ring-2 focus:ring-blue-500 transition-all"
                            placeholder="Tuliskan detail materi kurikulum di sini..."></textarea>
                        <p class="text-[8px] font-bold text-slate-300 uppercase ml-2 italic text-center">*Gunakan enter
                            untuk memisahkan baris materi</p>
                    </div>

                    <div class="space-y-2">
                        <label class="text-[10px] font-black uppercase text-slate-400 ml-2 tracking-widest">Expected
                            Outcome</label>
                        <input type="text" wire:model="outcome"
                            class="w-full bg-slate-50 border-none rounded-2xl p-4 font-bold text-xs uppercase focus:ring-2 focus:ring-blue-500"
                            placeholder="Target yang ingin dicapai">
                    </div>
                </div>

                <div class="flex flex-col gap-3">
                    <button type="submit"
                        class="w-full bg-blue-600 text-white py-6 rounded-3xl font-black uppercase text-xs tracking-[0.4em] shadow-2xl shadow-blue-100 hover:bg-blue-700 active:scale-95 transition-all">
                        Update Curriculum Data
                    </button>
                    <button type="button" wire:click="cancel"
                        class="w-full bg-slate-100 text-slate-500 py-4 rounded-2xl font-black uppercase text-[9px] tracking-[0.2em] hover:bg-slate-200 transition-all">
                        Discard Changes
                    </button>
                </div>
            </form>
        </div>
    @endif
</div>
