<div class="bg-slate-50 text-slate-800 font-sans min-h-screen flex flex-col antialiased">

    <!-- HEADER -->
    <header class="bg-white border-b border-slate-100 sticky top-0 z-50 shadow-sm">
        <div class="max-w-7xl mx-auto px-6 py-4 flex flex-col sm:flex-row justify-between items-center gap-4">
            <div class="flex items-center space-x-3.5">
                <div
                    class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center text-white font-black text-xl shadow-md shadow-blue-500/20">
                    C
                </div>
                <div>
                    <span class="text-lg font-bold text-slate-900 tracking-tight block">
                        kursus.<span class="text-blue-600">cenari</span>.sch.id
                    </span>
                    <p class="text-[10px] text-slate-400 uppercase tracking-widest font-bold mt-0.5">Pusat Panduan Sistem
                    </p>
                </div>
            </div>
            <a href="https://kursus.cenari.sch.id" target="_blank"
                class="text-xs font-bold text-white bg-blue-600 hover:bg-blue-700 px-5 py-2.5 rounded-xl shadow-sm transition-all tracking-wide">
                Buka Aplikasi →
            </a>
        </div>
    </header>

    <!-- MAIN CONTENT -->
    <main class="flex-grow max-w-7xl w-full mx-auto px-6 py-10 space-y-12">

        <!-- HERO / VIDEO SECTION -->
        <section
            class="bg-white p-6 sm:p-10 rounded-3xl shadow-sm border border-slate-100 grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
            <div class="lg:col-span-5 space-y-4">
                <span
                    class="inline-block text-[10px] bg-amber-50 text-amber-700 border border-amber-200 font-extrabold px-3 py-1 rounded-full uppercase tracking-wider">
                    Video Panduan
                </span>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight leading-tight">
                    Mari Pelajari Cara Kerja Aplikasi Kursus
                </h2>
                <p class="text-sm text-slate-500 leading-relaxed pt-1">
                    Tonton video singkat di samping untuk memahami alur manajemen kelas, pengajuan jadwal, absensi
                    berbasis QR Code, hingga sistem penilaian akhir.
                </p>
            </div>
            <div class="lg:col-span-7">
                <div class="relative w-full aspect-video rounded-2xl overflow-hidden shadow-md border border-slate-100 bg-slate-900"
                    wire:ignore>
                    <iframe class="absolute top-0 left-0 w-full h-full"
                        src="https://www.youtube.com/embed/{{ $youtubeVideoId }}" title="Tutorial kursus.cenari.sch.id"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        allowfullscreen>
                    </iframe>
                </div>
            </div>
        </section>

        <!-- TABS & STEPS SECTION -->
        <section class="space-y-8">
            <!-- TABS SWITCHER -->
            <div class="flex justify-center p-1.5 bg-slate-100 rounded-2xl max-w-md mx-auto border border-slate-200/50">
                <button wire:click="setTab('instruktur')"
                    class="w-1/2 py-3 rounded-xl text-sm font-extrabold transition-all outline-none {{ $tab === 'instruktur' ? 'bg-white text-slate-900 shadow-sm' : 'text-slate-500 hover:text-slate-800' }}">
                    👨‍🏫 Untuk Instruktur
                </button>
                <button wire:click="setTab('peserta')"
                    class="w-1/2 py-3 rounded-xl text-sm font-extrabold transition-all outline-none {{ $tab === 'peserta' ? 'bg-white text-slate-900 shadow-sm' : 'text-slate-500 hover:text-slate-800' }}">
                    👨‍🎓 Untuk Peserta
                </button>
            </div>

            <!-- CONTENT: INSTRUKTUR -->
            @if ($tab === 'instruktur')
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 animate-fade-in">

                    <!-- Langkah 01 -->
                    <div
                        class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center space-x-3 mb-6 border-b border-slate-50 pb-3">
                                <span
                                    class="px-2.5 py-1 bg-blue-50 text-blue-600 rounded-lg font-black text-xs">01</span>
                                <h3 class="font-black text-slate-900 text-xs uppercase tracking-wider">Sebelum Kursus
                                </h3>
                            </div>
                            <ul class="space-y-3.5 text-xs text-slate-600 leading-relaxed">
                                <li class="flex items-start gap-2.5">
                                    <span class="text-blue-500 font-bold mt-0.5">•</span>
                                    <span>Login ke <code
                                            class="bg-slate-50 border border-slate-200 px-1.5 py-0.5 rounded text-blue-600 font-mono text-[11px]">kursus.cenari.sch.id</code>
                                        menggunakan akun dari WhatsApp.</span>
                                </li>
                                <li class="flex items-start gap-2.5">
                                    <span class="text-blue-500 font-bold mt-0.5">•</span>
                                    <span>Lihat nomor WhatsApp peserta di dalam sistem, kemudian hubungi peserta
                                        tersebut.</span>
                                </li>
                                <li class="flex items-start gap-2.5">
                                    <span class="text-blue-500 font-bold mt-0.5">•</span>
                                    <span>Lakukan komunikasi untuk menyusun <strong>kesepakatan jadwal
                                            bersama</strong>.</span>
                                </li>
                                <li class="flex items-start gap-2.5">
                                    <span class="text-blue-500 font-bold mt-0.5">•</span>
                                    <span>Klik menu <strong class="text-slate-900 font-bold">"Buat"</strong> pada
                                        aplikasi, isi nama, keterangan, tanggal & jam, lalu klik <strong
                                            class="text-slate-900 font-bold">"Submit"</strong>.</span>
                                </li>
                                <li class="flex items-start gap-2.5">
                                    <span class="text-blue-500 font-bold mt-0.5">•</span>
                                    <span>Jadwal masuk ke kolom <strong class="text-slate-900 font-bold">DAFTAR
                                            PERMOHONAN</strong> dengan status <span
                                            class="bg-amber-50 text-amber-700 border border-amber-200 text-[10px] px-1.5 py-0.5 rounded font-bold uppercase tracking-wide">Pending</span>
                                        menunggu verifikasi Admin.</span>
                                </li>
                                <li class="flex items-start gap-2.5">
                                    <span class="text-blue-500 font-bold mt-0.5">•</span>
                                    <span>Jika disetujui, jadwal pindah ke <strong
                                            class="text-slate-900 font-bold">JADWAL KURSUS</strong>. Jika ditolak,
                                        status berubah menjadi <span
                                            class="bg-red-50 text-red-700 border border-red-200 text-[10px] px-1.5 py-0.5 rounded font-bold uppercase tracking-wide">Rejected</span>.</span>
                                </li>
                                <li class="flex items-start gap-2.5">
                                    <span class="text-blue-500 font-bold mt-0.5">•</span>
                                    <span>Pelatihan siap dilaksanakan sesuai waktu yang tertera di kolom <strong
                                            class="text-slate-900 font-bold">JADWAL KURSUS</strong>.</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Langkah 02 -->
                    <div
                        class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center space-x-3 mb-6 border-b border-slate-50 pb-3">
                                <span
                                    class="px-2.5 py-1 bg-amber-50 text-amber-600 rounded-lg font-black text-xs">02</span>
                                <h3 class="font-black text-slate-900 text-xs uppercase tracking-wider">Saat Berlangsung
                                </h3>
                            </div>
                            <ul class="space-y-3.5 text-xs text-slate-600 leading-relaxed">
                                <li class="flex items-start gap-2.5">
                                    <span class="text-amber-500 font-bold mt-0.5">•</span>
                                    <span>Login ke aplikasi di lokasi pertemuan atau ruang kelas pelatihan.</span>
                                </li>
                                <li class="flex items-start gap-2.5">
                                    <span class="text-amber-500 font-bold mt-0.5">•</span>
                                    <span>Tunjukkan <strong class="text-slate-900 font-bold text-blue-600">QR
                                            CODE</strong> yang muncul di layar utama aplikasi Anda kepada
                                        peserta.</span>
                                </li>
                                <li class="flex items-start gap-2.5">
                                    <span class="text-amber-500 font-bold mt-0.5">•</span>
                                    <span>Setelah discan oleh peserta, pantau data kehadiran di kolom <strong
                                            class="text-slate-900 font-bold">RIWAYAT ABSENSI</strong> dengan menekan
                                        tombol <strong class="text-slate-900 font-bold">"Detail"</strong>.</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Langkah 03 -->
                    <div
                        class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center space-x-3 mb-6 border-b border-slate-50 pb-3">
                                <span
                                    class="px-2.5 py-1 bg-emerald-50 text-emerald-600 rounded-lg font-black text-xs">03</span>
                                <h3 class="font-black text-slate-900 text-xs uppercase tracking-wider">Setelah Selesai
                                </h3>
                            </div>
                            <ul class="space-y-3.5 text-xs text-slate-600 leading-relaxed">
                                <li class="flex items-start gap-2.5">
                                    <span class="text-emerald-500 font-bold mt-0.5">•</span>
                                    <span>Login kembali ke aplikasi setelah seluruh rangkaian pertemuan kelas selesai
                                        dipenuhi.</span>
                                </li>
                                <li class="flex items-start gap-2.5">
                                    <span class="text-emerald-500 font-bold mt-0.5">•</span>
                                    <span>Cari nama peserta kursus yang bersangkutan, lalu klik tombol <strong
                                            class="text-slate-900 font-bold">"Detail"</strong>.</span>
                                </li>
                                <li class="flex items-start gap-2.5">
                                    <span class="text-emerald-500 font-bold mt-0.5">•</span>
                                    <span>Pada bagian <strong class="text-slate-900 font-bold">NILAI</strong>, klik
                                        <strong class="text-blue-600 font-bold">"Buat Nilai"</strong>, masukkan skor
                                        angka sesuai dengan pencapaian materi, lalu klik <strong
                                            class="text-slate-900 font-bold">"Submit"</strong>.</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
            @endif

            <!-- CONTENT: PESERTA -->
            @if ($tab === 'peserta')
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 animate-fade-in">

                    <!-- Langkah 01 -->
                    <div
                        class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center space-x-3 mb-6 border-b border-slate-50 pb-3">
                                <span
                                    class="px-2.5 py-1 bg-blue-50 text-blue-600 rounded-lg font-black text-xs">01</span>
                                <h3 class="font-black text-slate-900 text-xs uppercase tracking-wider">Sebelum Kursus
                                </h3>
                            </div>
                            <ul class="space-y-3.5 text-xs text-slate-600 leading-relaxed">
                                <li class="flex items-start gap-2.5">
                                    <span class="text-blue-500 font-bold mt-0.5">•</span>
                                    <span>Login ke <code
                                            class="bg-slate-50 border border-slate-200 px-1.5 py-0.5 rounded text-blue-600 font-mono text-[11px]">kursus.cenari.sch.id</code>
                                        dengan akun dari WhatsApp.</span>
                                </li>
                                <li class="flex items-start gap-2.5">
                                    <span class="text-blue-500 font-bold mt-0.5">•</span>
                                    <span>Cari nomor kontak Instruktur di aplikasi, lalu hubungi via WhatsApp untuk
                                        konfirmasi.</span>
                                </li>
                                <li class="flex items-start gap-2.5">
                                    <span class="text-blue-500 font-bold mt-0.5">•</span>
                                    <span>Berdiskusi dan buat <strong>kesepakatan jadwal bersama</strong> instruktur
                                        Anda.</span>
                                </li>
                                <li class="flex items-start gap-2.5">
                                    <span class="text-blue-500 font-bold mt-0.5">•</span>
                                    <span>Tunggu instruktur mengajukan jadwal. Jadwal baru akan muncul di kolom <strong
                                            class="text-slate-900 font-bold">JADWAL KURSUS</strong> dengan label <span
                                            class="bg-amber-50 text-amber-700 border border-amber-200 text-[10px] px-1.5 py-0.5 rounded font-bold uppercase tracking-wide">Pending</span>.</span>
                                </li>
                                <li class="flex items-start gap-2.5">
                                    <span class="text-blue-500 font-bold mt-0.5">•</span>
                                    <span>Admin akan memverifikasi permohonan tersebut. Harap periksa status aplikasi
                                        Anda secara berkala.</span>
                                </li>
                                <li class="flex items-start gap-2.5">
                                    <span class="text-blue-500 font-bold mt-0.5">•</span>
                                    <span>Jika disetujui, status pending hilang. Jika ditolak, akan muncul keterangan
                                        <span
                                            class="bg-red-50 text-red-700 border border-red-200 text-[10px] px-1.5 py-0.5 rounded font-bold uppercase tracking-wide">Rejected</span>.</span>
                                </li>
                                <li class="flex items-start gap-2.5">
                                    <span class="text-blue-500 font-bold mt-0.5">•</span>
                                    <span>Jika jadwal sudah disetujui penuh (tanpa teks pending), kelas siap dimulai
                                        sesuai waktu tersebut.</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Langkah 02 -->
                    <div
                        class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center space-x-3 mb-6 border-b border-slate-50 pb-3">
                                <span
                                    class="px-2.5 py-1 bg-amber-50 text-amber-600 rounded-lg font-black text-xs">02</span>
                                <h3 class="font-black text-slate-900 text-xs uppercase tracking-wider">Saat Berlangsung
                                </h3>
                            </div>
                            <ul class="space-y-3.5 text-xs text-slate-600 leading-relaxed">
                                <li class="flex items-start gap-2.5">
                                    <span class="text-amber-500 font-bold mt-0.5">•</span>
                                    <span>Login ke aplikasi saat sesi tatap muka atau pelatihan dimulai oleh
                                        instruktur.</span>
                                </li>
                                <li class="flex items-start gap-2.5">
                                    <span class="text-amber-500 font-bold mt-0.5">•</span>
                                    <span>Masuk ke menu <strong class="text-slate-900 font-bold">KAMERA</strong>, lalu
                                        klik tombol <span class="text-blue-600 font-bold underline">"Request Camera
                                            Permissions"</span> untuk memberikan akses kamera perangkat.</span>
                                </li>
                                <li class="flex items-start gap-2.5">
                                    <span class="text-amber-500 font-bold mt-0.5">•</span>
                                    <span>Pindai/Scan <strong class="text-slate-900 font-bold">QR CODE</strong> yang
                                        ditunjukkan oleh instruktur. Jika sukses, absensi langsung tercatat di <strong
                                            class="text-slate-900 font-bold">RIWAYAT ABSENSI</strong>.</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Langkah 03 -->
                    <div
                        class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center space-x-3 mb-6 border-b border-slate-50 pb-3">
                                <span
                                    class="px-2.5 py-1 bg-emerald-50 text-emerald-600 rounded-lg font-black text-xs">03</span>
                                <h3 class="font-black text-slate-900 text-xs uppercase tracking-wider">Setelah Selesai
                                </h3>
                            </div>
                            <ul class="space-y-3.5 text-xs text-slate-600 leading-relaxed">
                                <li class="flex items-start gap-2.5">
                                    <span class="text-emerald-500 font-bold mt-0.5">•</span>
                                    <span>Login kembali ke aplikasi setelah seluruh sesi kelas/pelatihan selesai di hari
                                        terakhir.</span>
                                </li>
                                <li class="flex items-start gap-2.5">
                                    <span class="text-emerald-500 font-bold mt-0.5">•</span>
                                    <span>Periksa capaian nilai akhir yang telah diinput oleh instruktur pada bagian
                                        kolom <strong class="text-slate-900 font-bold">NILAI</strong>.</span>
                                </li>
                                <li class="flex items-start gap-2.5">
                                    <span class="text-emerald-500 font-bold mt-0.5">•</span>
                                    <span>Silakan menunggu proses validasi, penerbitan, dan pencetakan sertifikat resmi
                                        kursus Anda.</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
            @endif

        </section>
    </main>
</div>
