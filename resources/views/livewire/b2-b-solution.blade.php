<div class="bg-white">
    <section class="bg-[#0F172A] py-24">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <span class="text-blue-500 font-black tracking-[0.3em] uppercase text-xs">For Institutions</span>
            <h1 class="text-4xl md:text-6xl font-heading font-black text-white mt-6 mb-8">
                Transformasi Laboratorium <br> <span class="text-slate-400">Menjadi Ekosistem Inovasi.</span>
            </h1>
        </div>
    </section>

    <section class="py-24 max-w-7xl mx-auto px-6">
        <div class="grid md:grid-cols-2 gap-16 items-center">
            <div class="relative">
                <div class="relative rounded-[3rem] overflow-hidden shadow-2xl">
                    <img src="https://images.pexels.com/photos/2582937/pexels-photo-2582937.jpeg?auto=compress&cs=tinysrgb&w=800"
                        class="w-full h-[500px] object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent flex items-end p-12">
                        <p class="text-white font-medium text-lg italic">
                            "Siswa belajar desain di komputer sekolah, lalu mencetaknya menjadi casing robot."
                        </p>
                    </div>
                </div>
            </div>

            <div>
                <h2 class="text-3xl font-bold text-slate-900 mb-6">Solusi Terintegrasi Tanpa Celah.</h2>
                <p class="text-slate-500 leading-relaxed mb-8">
                    Kami tidak hanya menjual alat. Kami menyediakan ekosistem di mana perangkat lunak dan perangkat
                    keras bekerja dalam satu silabus yang koheren.
                </p>
                <ul class="space-y-4">
                    @foreach (['Kit Robotik Modular', 'Modul Komputer Standar Industri', 'Pelatihan Guru Tersertifikasi', 'Update Kurikulum Berkala'] as $feature)
                        <li class="flex items-center gap-3 font-bold text-slate-700">
                            <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            {{ $feature }}
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </section>

    <section class="py-24 bg-slate-50">
        <div class="max-w-5xl mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-slate-900 mb-4">Curriculum Mapper</h2>
                <p class="text-slate-500 uppercase text-xs font-black tracking-widest">Sesuaikan Kurikulum dengan
                    Jenjang Sekolah Anda</p>
            </div>

            <div class="flex justify-center gap-4 mb-12">
                @foreach (['SD', 'SMP', 'SMA'] as $level)
                    <button wire:click="selectLevel('{{ $level }}')"
                        class="px-8 py-4 rounded-2xl font-black transition-all {{ $selectedLevel == $level ? 'bg-blue-600 text-white shadow-xl shadow-blue-500/30' : 'bg-white text-slate-400 hover:bg-slate-100' }}">
                        {{ $level }}
                    </button>
                @endforeach
            </div>

            <div class="bg-white rounded-[3rem] p-12 shadow-sm border border-slate-100 relative overflow-hidden">
                @if ($data)
                    <div class="grid md:grid-cols-2 gap-12 relative z-10">
                        <div class="space-y-8">
                            <div>
                                <span
                                    class="text-[10px] font-black text-blue-600 uppercase tracking-widest block mb-2">Materi
                                    Pembelajaran</span>
                                <div class="text-lg font-medium text-slate-900 whitespace-pre-line leading-relaxed">
                                    {{ $data->materi }}
                                </div>
                            </div>
                        </div>

                        <div class="bg-slate-900 rounded-[2rem] p-8 text-white flex flex-col justify-center">
                            <span
                                class="text-[10px] font-black text-blue-400 uppercase tracking-widest block mb-4">Expected
                                Learning Outcome</span>
                            <p class="text-lg leading-relaxed italic">"{{ $data->outcome }}"</p>
                        </div>
                    </div>
                @else
                    <div class="text-center py-12 text-slate-400 italic">
                        Data kurikulum untuk jenjang ini belum tersedia.
                    </div>
                @endif
            </div>

            <div class="mt-12 text-center">
                <button
                    class="bg-slate-900 text-white px-10 py-5 rounded-2xl font-bold hover:bg-blue-600 transition-colors shadow-xl">
                    Dapatkan Proposal Penawaran Sekolah Anda
                </button>
            </div>
        </div>
    </section>
</div>
