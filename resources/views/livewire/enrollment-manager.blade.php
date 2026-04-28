<div class="min-h-screen py-10">
    <div class="max-w-6xl mx-auto px-6">

        <div class="mb-8 flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-black text-slate-900 tracking-tighter uppercase">Manajemen Pendaftaran</h1>
                <p class="text-slate-500 text-xs font-medium italic">Kelola kursus peserta</p>
            </div>
            @if ($isEdit)
                <button wire:click="cancel"
                    class="bg-slate-100 text-slate-600 px-6 py-2 rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-slate-200 transition-all">
                    Kembali ke List
                </button>
            @endif
        </div>

        @if (!$isEdit)
            <div class="bg-white border border-slate-100 rounded-[2rem] shadow-xl shadow-slate-200/50 overflow-hidden">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-slate-50/80 border-b border-slate-100">
                            <th class="px-6 py-5 text-[10px] font-black uppercase text-slate-400 tracking-widest">Siswa
                                & Paket</th>
                            <th class="px-6 py-5 text-[10px] font-black uppercase text-slate-400 tracking-widest">Akses
                                Akun</th>
                            <th
                                class="px-6 py-5 text-[10px] font-black uppercase text-slate-400 tracking-widest text-center">
                                Status</th>
                            <th
                                class="px-6 py-5 text-[10px] font-black uppercase text-slate-400 tracking-widest text-right">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @foreach ($enrollments as $item)
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <td class="px-6 py-4">
                                    <p class="text-sm font-black text-slate-900 leading-tight">{{ $item->user->name }}
                                    </p>
                                    <p class="text-[10px] font-bold text-blue-500 uppercase">
                                        {{ $item->coursePackage->name }}</p>
                                </td>
                                <td class="px-6 py-4">
                                    @if ($item->username)
                                        <div class="flex flex-col">
                                            <code class="text-[10px] font-bold text-slate-600">U:
                                                {{ $item->username }}</code>
                                            <code class="text-[10px] font-bold text-slate-400">P:
                                                {{ $item->password }}</code>
                                        </div>
                                    @else
                                        <span class="text-[9px] text-rose-400 font-bold uppercase italic">Belum
                                            diset</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <span
                                        class="px-3 py-1 rounded-lg text-[8px] font-black uppercase tracking-widest 
                                        {{ $item->status == 'Selesai' ? 'bg-green-50 text-green-600' : ($item->status == 'Sedang Berjalan' ? 'bg-blue-50 text-blue-600' : 'bg-orange-50 text-orange-600') }}">
                                        {{ $item->status }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <button wire:click="edit({{ $item->id }})"
                                        class="p-2 hover:bg-blue-50 text-blue-500 rounded-lg transition-all">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="px-6 py-4 border-t border-slate-50">
                    {{ $enrollments->links() }}
                </div>
            </div>
        @else
            <div
                class="max-w-2xl bg-white border border-slate-100 rounded-[2.5rem] p-10 shadow-2xl shadow-slate-200/50 mx-auto">
                <form wire:submit.prevent="update" class="space-y-6">
                    <div class="grid grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-[10px] font-black uppercase text-slate-400 tracking-widest">Username
                                Akses</label>
                            <input type="text" wire:model="username" placeholder="Email/Username LMS"
                                class="w-full bg-slate-50 border-transparent rounded-2xl p-4 text-sm font-bold focus:ring-[#3B82F6] focus:bg-white transition-all">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-black uppercase text-slate-400 tracking-widest">Password
                                Akses</label>
                            <input type="text" wire:model="password" placeholder="Password LMS"
                                class="w-full bg-slate-50 border-transparent rounded-2xl p-4 text-sm font-bold focus:ring-[#3B82F6] focus:bg-white transition-all">
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="text-[10px] font-black uppercase text-slate-400 tracking-widest">Status
                            Pembayaran</label>
                        <select wire:model="payment_status"
                            class="w-full bg-slate-50 border-transparent rounded-2xl p-4 text-sm font-bold focus:ring-[#3B82F6] focus:bg-white">
                            <option value="Pending">Pending</option>
                            <option value="Paid">Paid (Lunas)</option>
                        </select>
                    </div>

                    <div class="grid grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label
                                class="text-[10px] font-black uppercase text-slate-400 tracking-widest">Metode</label>
                            <select wire:model="learning_methode"
                                class="w-full bg-slate-50 border-transparent rounded-2xl p-4 text-sm font-bold">
                                <option value="Offline">Offline</option>
                                <option value="Online">Online</option>
                                <option value="Hybrid">Hybrid</option>
                            </select>
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-black uppercase text-slate-400 tracking-widest">Status
                                Kursus</label>
                            <select wire:model="status"
                                class="w-full bg-slate-50 border-transparent rounded-2xl p-4 text-sm font-bold">
                                <option value="Diproses">Diproses</option>
                                <option value="Sedang Berjalan">Sedang Berjalan</option>
                                <option value="Selesai">Selesai</option>
                            </select>
                        </div>
                    </div>

                    <div class="pt-4">
                        <button type="submit"
                            class="w-full bg-[#3B82F6] text-white py-5 rounded-2xl font-black uppercase tracking-[0.2em] text-[11px] hover:bg-slate-900 transition-all shadow-xl shadow-blue-500/20">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        @endif

    </div>
</div>
