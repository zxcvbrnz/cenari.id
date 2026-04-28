<div class="min-h-screen bg-[#FBFDFF] py-12">
    <div class="max-w-6xl mx-auto px-6">

        <div class="mb-10 text-center">
            <span
                class="px-3 py-1 bg-blue-50 text-[#3B82F6] text-[10px] font-black uppercase tracking-widest rounded-lg mb-4 inline-block">
                Portal Siswa
            </span>
            <h1 class="text-4xl font-black text-slate-900 tracking-tighter">Daftar Kursus Saya</h1>
            <p class="text-slate-500 text-sm italic mt-2">Kelola akses pembelajaran dan pantau status pendaftaran Anda.
            </p>
        </div>

        <div class="bg-white border border-slate-100 rounded-[2.5rem] shadow-xl shadow-slate-200/50 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/50 border-b border-slate-100">
                            <th class="px-8 py-6 text-[10px] font-black uppercase text-slate-400 tracking-widest">
                                Informasi Kursus</th>
                            <th
                                class="px-8 py-6 text-[10px] font-black uppercase text-slate-400 tracking-widest text-center">
                                Status</th>
                            <th
                                class="px-8 py-6 text-[10px] font-black uppercase text-slate-400 tracking-widest text-center">
                                Metode</th>
                            <th class="px-8 py-6 text-[10px] font-black uppercase text-slate-400 tracking-widest">Akses
                                Login</th>
                            <th
                                class="px-8 py-6 text-[10px] font-black uppercase text-slate-400 tracking-widest text-right">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @forelse($myCourses as $course)
                            <tr class="group hover:bg-slate-50/50 transition-colors">
                                <td class="px-8 py-6">
                                    <p class="text-sm font-black text-slate-900 leading-tight mb-1">{{ $course->name }}
                                    </p>
                                    <span class="text-[9px] font-bold text-blue-500 uppercase tracking-tighter">
                                        Pembayaran: <span
                                            class="{{ $course->pivot->payment_status == 'Paid' ? 'text-green-600' : 'text-rose-500' }}">
                                            {{ $course->pivot->payment_status }}
                                        </span>
                                    </span>
                                </td>

                                <td class="px-8 py-6 text-center">
                                    <span
                                        class="px-3 py-1 rounded-full text-[9px] font-black uppercase tracking-widest 
                                        {{ $course->pivot->status == 'Selesai' ? 'bg-green-100 text-green-600' : ($course->pivot->status == 'Sedang Berjalan' ? 'bg-blue-100 text-blue-600' : 'bg-orange-100 text-orange-600') }}">
                                        {{ $course->pivot->status }}
                                    </span>
                                </td>

                                <td class="px-8 py-6 text-center">
                                    <span
                                        class="text-[10px] font-bold text-slate-600 uppercase">{{ $course->pivot->learning_methode }}</span>
                                </td>

                                <td class="px-8 py-6">
                                    @if ($course->pivot->username)
                                        <div class="space-y-1">
                                            <div class="flex items-center gap-2">
                                                <span
                                                    class="text-[8px] font-black text-slate-400 uppercase w-12">User:</span>
                                                <code
                                                    class="text-[10px] font-bold text-[#3B82F6] bg-blue-50 px-2 py-0.5 rounded">{{ $course->pivot->username }}</code>
                                            </div>
                                            <div class="flex items-center gap-2">
                                                <span
                                                    class="text-[8px] font-black text-slate-400 uppercase w-12">Pass:</span>
                                                <code
                                                    class="text-[10px] font-bold text-slate-600 bg-slate-100 px-2 py-0.5 rounded">{{ $course->pivot->password }}</code>
                                            </div>
                                        </div>
                                    @else
                                        <span class="text-[9px] text-slate-400 italic">Akun belum tersedia</span>
                                    @endif
                                </td>

                                <td class="px-8 py-6 text-right">
                                    @if ($course->pivot->username)
                                        <button
                                            class="bg-slate-900 text-white px-5 py-2.5 rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-[#3B82F6] transition-all active:scale-95">
                                            Login Platform
                                        </button>
                                    @else
                                        <button disabled
                                            class="bg-slate-100 text-slate-400 px-5 py-2.5 rounded-xl text-[10px] font-black uppercase tracking-widest cursor-not-allowed">
                                            Pending
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-8 py-20 text-center">
                                    <p class="text-slate-400 text-xs italic">Anda belum memiliki pendaftaran kursus
                                        apapun.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
