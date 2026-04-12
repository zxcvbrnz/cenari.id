<x-app-layout>
    <div class="py-8" x-data="{ tab: 'curriculum' }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div
                class="bg-white p-3 rounded-[2.5rem] border border-slate-100 shadow-sm inline-flex items-center gap-2 mb-4 overflow-x-auto max-w-full">
                <button @click="tab = 'curriculum'"
                    :class="tab === 'curriculum' ? 'bg-blue-600 text-white shadow-lg shadow-blue-100' :
                        'text-slate-400 hover:text-slate-600'"
                    class="px-6 py-3 rounded-2xl text-[10px] font-black uppercase tracking-widest transition-all whitespace-nowrap">
                    Curriculum
                </button>
                <button @click="tab = 'collaboration'"
                    :class="tab === 'collaboration' ? 'bg-blue-600 text-white shadow-lg shadow-blue-100' :
                        'text-slate-400 hover:text-slate-600'"
                    class="px-6 py-3 rounded-2xl text-[10px] font-black uppercase tracking-widest transition-all whitespace-nowrap">
                    Collaborations
                </button>
                <button @click="tab = 'quotes'"
                    :class="tab === 'quotes' ? 'bg-blue-600 text-white shadow-lg shadow-blue-100' :
                        'text-slate-400 hover:text-slate-600'"
                    class="px-6 py-3 rounded-2xl text-[10px] font-black uppercase tracking-widest transition-all whitespace-nowrap">
                    Quotes
                </button>
            </div>

            <div class="relative min-h-[400px]">

                <div x-show="tab === 'curriculum'" x-transition:enter="transition ease-out duration-300 transform"
                    x-transition:enter-start="opacity-0 translate-y-4">
                    <livewire:admin.manage-curriculum />
                </div>

                <div x-show="tab === 'collaboration'" x-transition:enter="transition ease-out duration-300 transform"
                    x-transition:enter-start="opacity-0 translate-y-4" x-cloak>
                    <livewire:admin.manage-collaboration />
                </div>

                <div x-show="tab === 'quotes'" x-transition:enter="transition ease-out duration-300 transform"
                    x-transition:enter-start="opacity-0 translate-y-4" x-cloak>
                    <livewire:admin.manage-quotes />
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
