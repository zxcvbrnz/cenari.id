<div class="max-w-7xl mx-auto p-4 md:p-8 space-y-6">

    {{-- HEADER UTAMA --}}
    <div
        class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm flex flex-col md:flex-row justify-between items-center gap-4">
        <div>
            <h1 class="text-2xl font-black italic uppercase tracking-tighter">
                Missing <span class="text-blue-600">Links</span>
            </h1>
            <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest mt-1">
                Manage Redirections, CTA, and Navigation Shortcuts
            </p>
        </div>
        @if ($viewState === 'index')
            <button wire:click="showCreateForm"
                class="w-full md:w-auto bg-blue-600 text-white px-8 py-4 rounded-2xl font-black uppercase text-[10px] tracking-[0.2em] shadow-lg shadow-blue-100 hover:bg-slate-900 transition-all">
                + Add New Link
            </button>
        @else
            <button wire:click="showIndex"
                class="w-full md:w-auto bg-slate-900 text-white px-8 py-4 rounded-2xl font-black uppercase text-[10px] tracking-[0.2em] shadow-lg hover:bg-blue-600 transition-all">
                ← Back to List
            </button>
        @endif
    </div>

    {{-- 1. HALAMAN UTAMA (GRID VIEW BERGAYA KARTU MODERN) --}}
    @if ($viewState === 'index')
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @forelse($missingLinks as $link)
                <div
                    class="bg-white p-3 rounded-[2.5rem] border border-slate-100 shadow-sm relative group overflow-hidden flex flex-col justify-between">
                    <div class="p-6 space-y-6 flex-1 flex flex-col justify-between">

                        {{-- Tag CTA Atas --}}
                        <div class="flex justify-between items-start">
                            <div
                                class="bg-blue-50 text-blue-600 px-4 py-2 rounded-xl text-[10px] font-black uppercase tracking-widest truncate max-w-full">
                                CTA: {{ $link->cta }}
                            </div>
                        </div>

                        {{-- Konten Text --}}
                        <div class="space-y-3 my-4">
                            <h3 class="font-black italic uppercase text-xl text-slate-800 leading-tight line-clamp-2">
                                {{ $link->text }}
                            </h3>
                            <div class="bg-slate-50 rounded-2xl p-4 border border-slate-50 break-all">
                                <p class="text-[8px] font-black uppercase text-slate-400 mb-1 tracking-widest">Target
                                    URL</p>
                                <a href="{{ $link->program ? url('programs/' . $link->program->slug) : '#' }}"
                                    target="_blank"
                                    class="text-[11px] text-blue-500 font-bold hover:underline italic flex items-center gap-1">
                                    {{ $link->program ? $link->program->slug : 'No Program Assigned' }}
                                    <span class="text-[9px]">↗</span>
                                </a>
                            </div>
                        </div>

                        {{-- Tombol Aksi --}}
                        <div class="grid grid-cols-2 gap-2 pt-2">
                            <button wire:click="showEditForm({{ $link->id }})"
                                class="bg-slate-900 text-white py-3 rounded-xl font-black uppercase text-[9px] tracking-[0.15em] hover:bg-blue-600 transition-all shadow-sm">
                                Edit
                            </button>
                            <button wire:click="delete({{ $link->id }})"
                                wire:confirm="Apakah Anda yakin ingin menghapus data ini?"
                                class="bg-slate-100 text-red-500 py-3 rounded-xl font-black uppercase text-[9px] tracking-[0.15em] hover:bg-red-50 hover:text-red-600 transition-all">
                                Delete
                            </button>
                        </div>

                    </div>
                </div>
            @empty
                <div
                    class="col-span-1 md:col-span-3 bg-white p-12 rounded-[2.5rem] border border-slate-100 text-center shadow-sm">
                    <p class="text-xs font-black uppercase tracking-widest text-slate-400 italic">No Shortcut Links
                        Found.</p>
                </div>
            @endforelse
        </div>

        {{-- Pagination Kontrol --}}
        @if ($missingLinks->hasPages())
            <div class="bg-white p-4 rounded-2xl border border-slate-100 shadow-sm px-6">
                {{ $missingLinks->links() }}
            </div>
        @endif

        {{-- 2. HALAMAN FORM (CREATE & EDIT BERGAYA EKSTREM MELENGKUNG) --}}
    @elseif($viewState === 'create' || $viewState === 'edit')
        <div class="bg-white p-6 md:p-12 rounded-[3rem] border border-slate-100 max-w-3xl mx-auto shadow-sm">

            <div class="mb-8 text-center">
                <span
                    class="bg-blue-100 text-blue-600 px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-widest">
                    {{ $viewState === 'create' ? 'Creation Mode' : 'Editing Mode' }}
                </span>
                <h2 class="text-3xl font-black italic uppercase text-slate-800 mt-4 tracking-tighter">
                    {{ $viewState === 'create' ? 'Add Link Shortcut' : 'Modify Link Data' }}
                </h2>
            </div>

            <form wire:submit.prevent="save" class="space-y-6">

                {{-- Input Text --}}
                <div class="space-y-2">
                    <label class="text-[10px] font-black uppercase text-slate-400 ml-2 tracking-widest">
                        Display Text
                    </label>
                    <input type="text" wire:model="text"
                        class="w-full bg-slate-50 border-none rounded-2xl p-4 font-bold text-xs uppercase tracking-tight focus:ring-2 focus:ring-blue-500 transition-all"
                        placeholder="Contoh: Bantuan pendaftaran aplikasi">
                    @error('text')
                        <p class="text-red-500 text-[10px] font-bold uppercase tracking-wider ml-2 mt-1">{{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Input CTA --}}
                <div class="space-y-2">
                    <label class="text-[10px] font-black uppercase text-slate-400 ml-2 tracking-widest">
                        Call To Action (CTA)
                    </label>
                    <input type="text" wire:model="cta"
                        class="w-full bg-slate-50 border-none rounded-2xl p-4 font-bold text-xs uppercase tracking-tight focus:ring-2 focus:ring-blue-500 transition-all"
                        placeholder="Contoh: Hubungi CS, Daftar Sekarang">
                    @error('cta')
                        <p class="text-red-500 text-[10px] font-bold uppercase tracking-wider ml-2 mt-1">
                            {{ $message }}</p>
                    @enderror
                </div>

                {{-- Input URL --}}
                <div class="space-y-2">
                    <label class="text-[10px] font-black uppercase text-slate-400 ml-2 tracking-widest">
                        Pilih Program Tujuan
                    </label>

                    <select wire:model="program_id"
                        class="w-full bg-slate-50 border-none rounded-2xl p-4 font-bold text-xs focus:ring-2 focus:ring-blue-500 transition-all text-blue-600 appearance-none cursor-pointer">

                        <option value="">-- Pilih Program --</option>

                        @foreach ($programs as $program)
                            <option value="{{ $program->id }}">{{ $program->title }}</option>
                        @endforeach

                    </select>

                    @error('program_id')
                        <p class="text-red-500 text-[10px] font-bold uppercase tracking-wider ml-2 mt-1">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Group Tombol Form --}}
                <div class="flex flex-col gap-3 pt-4">
                    <button type="submit"
                        class="w-full bg-blue-600 text-white py-5 rounded-3xl font-black uppercase text-xs tracking-[0.4em] shadow-2xl shadow-blue-100 hover:bg-blue-700 active:scale-[0.98] transition-all">
                        {{ $viewState === 'create' ? 'Save Link Database' : 'Update Link Shortcut' }}
                    </button>
                    <button type="button" wire:click="showIndex"
                        class="w-full bg-slate-100 text-slate-500 py-4 rounded-2xl font-black uppercase text-[9px] tracking-[0.2em] hover:bg-slate-200 transition-all">
                        Discard Changes
                    </button>
                </div>

            </form>
        </div>
    @endif
</div>
