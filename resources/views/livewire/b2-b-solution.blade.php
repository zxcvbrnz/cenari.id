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
                <div class="absolute -bottom-6 -right-6 bg-blue-600 text-white p-8 rounded-3xl shadow-xl">
                    <p class="text-3xl font-black">All-in-One</p>
                    <p class="text-xs font-bold opacity-80 uppercase tracking-widest">School-in-a-Box</p>
                </div>
            </div>

            <div>
                <h2 class="text-3xl font-bold text-slate-900 mb-6">Solusi Terintegrasi Tanpa Celah.</h2>
                <p class="text-slate-500 leading-relaxed mb-8">
                    Kami tidak hanya menjual alat. Kami menyediakan ekosistem di mana perangkat lunak (desain & coding)
                    dan perangkat keras (robotik & sensor) bekerja dalam satu silabus yang koheren.
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
                <div class="absolute top-0 right-0 p-8 opacity-5">
                    <svg class="w-32 h-32" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                    </svg>
                </div>

                <div class="grid md:grid-cols-2 gap-12 relative z-10">
                    <div class="space-y-8">
                        <div>
                            <span
                                class="text-[10px] font-black text-blue-600 uppercase tracking-widest block mb-2">Semester
                                1</span>
                            <h4 class="text-xl font-bold text-slate-900">{{ $curriculums[$selectedLevel]['sem1'] }}</h4>
                        </div>
                        <div>
                            <span
                                class="text-[10px] font-black text-emerald-600 uppercase tracking-widest block mb-2">Semester
                                2</span>
                            <h4 class="text-xl font-bold text-slate-900">{{ $curriculums[$selectedLevel]['sem2'] }}</h4>
                        </div>
                    </div>
                    <div class="bg-slate-900 rounded-[2rem] p-8 text-white">
                        <span class="text-[10px] font-black text-blue-400 uppercase tracking-widest block mb-4">Expected
                            Learning Outcome</span>
                        <p class="text-lg leading-relaxed italic">"{{ $curriculums[$selectedLevel]['outcome'] }}"</p>
                    </div>
                </div>
            </div>

            <div class="mt-12 text-center">
                <button
                    class="bg-slate-900 text-white px-10 py-5 rounded-2xl font-bold hover:bg-blue-600 transition-colors shadow-xl">
                    Dapatkan Proposal Penawaran (PDF)
                </button>
            </div>
        </div>
    </section>
</div>
