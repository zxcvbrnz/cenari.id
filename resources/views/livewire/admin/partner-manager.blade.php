<div class="max-w-7xl mx-auto px-6 py-12">
    <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
        <div>
            <h2 class="text-2xl font-black text-slate-900 uppercase tracking-tight">Manajemen Partner</h2>
            <p class="text-slate-500 text-xs font-bold uppercase tracking-widest mt-1">Daftar Pengajuan Kerja Sama</p>
        </div>

        <!-- Tab Switcher -->
        <div class="flex bg-slate-100 p-1 rounded-2xl">
            <button wire:click="setType('school')"
                class="px-6 py-2.5 rounded-xl text-[10px] font-black uppercase transition-all {{ $type === 'school' ? 'bg-white text-blue-600 shadow-sm' : 'text-slate-500 hover:text-slate-700' }}">
                Sekolah
            </button>
            <button wire:click="setType('institution')"
                class="px-6 py-2.5 rounded-xl text-[10px] font-black uppercase transition-all {{ $type === 'institution' ? 'bg-white text-blue-600 shadow-sm' : 'text-slate-500 hover:text-slate-700' }}">
                Institusi/Perusahaan
            </button>
        </div>
    </div>

    @if (session()->has('success'))
        <div
            class="mb-6 p-4 bg-emerald-50 text-emerald-600 rounded-2xl text-xs font-bold uppercase tracking-wider flex items-center gap-3">
            <span class="w-2 h-2 bg-emerald-400 rounded-full animate-ping"></span>
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/50 border-b border-slate-50">
                        <th class="p-6 text-[10px] font-black uppercase text-slate-400 tracking-widest">Informasi Dasar
                        </th>
                        <th class="p-6 text-[10px] font-black uppercase text-slate-400 tracking-widest">Kontak</th>
                        <th class="p-6 text-[10px] font-black uppercase text-slate-400 tracking-widest">Isi Penawaran
                        </th>
                        <th class="p-6 text-[10px] font-black uppercase text-slate-400 tracking-widest text-right">Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse ($partners as $item)
                        <tr class="hover:bg-slate-50/30 transition-colors">
                            <td class="p-6">
                                <p class="text-sm font-bold text-slate-900">{{ $item->nama_lengkap }}</p>
                                <p class="text-[10px] font-black text-blue-500 uppercase mt-1">
                                    {{ $type === 'school' ? $item->nama_sekolah : $item->nama_institusi }}
                                </p>
                            </td>
                            <td class="p-6">
                                <div class="flex flex-col gap-1">
                                    <span class="text-xs font-medium text-slate-600 flex items-center gap-2">
                                        <div class="w-1 h-1 rounded-full bg-slate-300"></div> {{ $item->email }}
                                    </span>
                                    <span class="text-xs font-medium text-slate-600 flex items-center gap-2">
                                        <div class="w-1 h-1 rounded-full bg-slate-300"></div> {{ $item->whatsapp }}
                                    </span>
                                </div>
                            </td>
                            <td class="p-6">
                                <p class="text-[10px] font-bold text-slate-400 uppercase mb-1">Kepada:
                                    {{ $item->tujuan_surat }}</p>
                                <p class="text-xs text-slate-600 line-clamp-2 max-w-xs">{{ $item->penawaran }}</p>
                            </td>
                            <td class="p-6 text-right">
                                <button onclick="confirm('Hapus data partner ini?') || event.stopImmediatePropagation()"
                                    wire:click="deletePartner({{ $item->id }})"
                                    class="inline-flex items-center justify-center w-9 h-9 rounded-xl bg-red-50 text-red-400 hover:bg-red-500 hover:text-white transition-all transform active:scale-90">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="p-12 text-center">
                                <p class="text-[10px] font-black uppercase text-slate-300 tracking-widest italic">Belum
                                    ada data masuk</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($partners->hasPages())
            <div class="p-6 border-t border-slate-50 bg-slate-50/30">
                {{ $partners->links() }}
            </div>
        @endif
    </div>
</div>
