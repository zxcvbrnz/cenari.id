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

                    {{-- Tombol Buat Akun di bagian atas area Akses --}}
                    <div class="flex justify-between items-center border-b border-slate-100 pb-3 mb-2">
                        <span class="text-[11px] font-black uppercase text-slate-800 tracking-wider">Kredensial
                            LMS</span>
                        @if (!$username || !$password)
                            <button type="button" wire:click="creating_peserta" wire:loading.attr="disabled"
                                class="bg-blue-50 text-blue-600 hover:bg-blue-100 disabled:opacity-50 disabled:cursor-not-allowed px-4 py-2 rounded-xl text-[9px] font-black uppercase tracking-widest transition-all flex items-center gap-1">

                                {{-- Ikon Default (Akan disembunyikan saat loading) --}}
                                <svg wire:loading.remove wire:target="creating_peserta" class="w-3 h-3" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                        d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                                </svg>

                                {{-- Ikon Spinner Animasi (Hanya muncul saat loading) --}}
                                <svg wire:loading wire:target="creating_peserta"
                                    class="animate-spin w-3 h-3 text-blue-600" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10"
                                        stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor"
                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                    </path>
                                </svg>

                                {{-- Teks Tombol yang Berganti Otomatis --}}
                                <span wire:loading.remove wire:target="creating_peserta">Create Akun Otomatis</span>
                                <span wire:loading wire:target="creating_peserta">Processing...</span>
                            </button>
                        @endif
                    </div>

                    <div class="grid grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-[10px] font-black uppercase text-slate-400 tracking-widest">Username
                                Akses</label>
                            <input type="text" wire:model="username" placeholder="Email/Username LMS" disabled
                                class="w-full bg-slate-50 border-transparent rounded-2xl p-4 text-sm font-bold focus:ring-[#3B82F6] focus:bg-white transition-all">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-black uppercase text-slate-400 tracking-widest">Password
                                Akses</label>
                            <input type="text" wire:model="password" placeholder="Password LMS" disabled
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

                    {{-- Group Tombol Aksi (Simpan Perubahan & Hapus Pendaftaran) --}}
                    <div class="pt-4 space-y-3">
                        <button type="submit"
                            class="w-full bg-[#3B82F6] text-white py-5 rounded-2xl font-black uppercase tracking-[0.2em] text-[11px] hover:bg-slate-900 transition-all shadow-xl shadow-blue-500/20">
                            Simpan Perubahan
                        </button>

                        {{-- tombol hilang saat username dan password sudah ada --}}
                        @if ($username && $password)
                            <button disabled
                                class="w-full bg-rose-50 text-rose-300 py-4 rounded-2xl font-black uppercase tracking-[0.2em] text-[10px] cursor-not-allowed">
                                Hapus Pendaftaran
                            </button>
                        @else
                            <button type="button" wire:click="destroy"
                                wire:confirm="Apakah Anda yakin ingin menghapus data pendaftaran ini secara permanen?"
                                class="w-full bg-rose-50 text-rose-600 py-4 rounded-2xl font-black uppercase tracking-[0.2em] text-[10px] hover:bg-rose-600 hover:text-white transition-all">
                                Hapus Pendaftaran
                            </button>
                        @endif
                    </div>
                </form>
            </div>
        @endif

    </div>
</div>
