<div class="bg-white p-8 rounded-[3rem] border border-slate-100 shadow-sm space-y-8">

    <div class="flex justify-between items-center">
        <div>
            <h2 class="text-2xl font-black italic uppercase tracking-tighter">Manage <span class="text-blue-600">Main
                    Quote</span></h2>
            <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest mt-1">Configure the inspiring quote
                for your landing page</p>
        </div>
        <div class="px-4 py-2 bg-blue-50 rounded-xl border border-blue-100">
            <span class="text-[9px] font-black text-blue-600 uppercase tracking-widest leading-none">Single Data
                Mode</span>
        </div>
    </div>

    <form wire:submit.prevent="save" class="max-w-2xl mx-auto space-y-6 animate-fade-in">

        <div class="space-y-2">
            <label class="text-[10px] font-black uppercase text-slate-400 tracking-widest ml-1">Quote Content</label>
            <textarea wire:model="content" rows="5"
                class="w-full bg-slate-50 border-none rounded-[2.5rem] p-8 text-sm font-bold italic text-slate-700 focus:ring-2 focus:ring-blue-500 shadow-inner leading-relaxed"></textarea>
            @error('content')
                <span class="text-red-500 text-[10px] font-bold uppercase ml-2">{{ $message }}</span>
            @enderror
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-2">
                <label class="text-[10px] font-black uppercase text-slate-400 tracking-widest ml-1">Author Name</label>
                <input type="text" wire:model="author"
                    class="w-full bg-slate-50 border-none rounded-2xl p-5 text-xs font-black uppercase text-slate-700 focus:ring-2 focus:ring-blue-500 shadow-inner">
                @error('author')
                    <span class="text-red-500 text-[10px] font-bold uppercase ml-2">{{ $message }}</span>
                @enderror
            </div>

            <div class="space-y-2">
                <label class="text-[10px] font-black uppercase text-slate-400 tracking-widest ml-1">Source / Book
                    Title</label>
                <input type="text" wire:model="source"
                    class="w-full bg-slate-50 border-none rounded-2xl p-5 text-xs font-black uppercase text-slate-700 focus:ring-2 focus:ring-blue-500 shadow-inner">
                @error('source')
                    <span class="text-red-500 text-[10px] font-bold uppercase ml-2">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="pt-4">
            <button type="submit"
                class="w-full bg-slate-900 text-white py-6 rounded-3xl font-black uppercase text-xs tracking-[0.4em] shadow-2xl hover:bg-blue-600 transition-all transform active:scale-95 flex items-center justify-center gap-3">
                <span wire:loading.remove>Update Quote Now</span>
                <span wire:loading class="animate-pulse">Saving Changes...</span>
            </button>
        </div>
    </form>
</div>
