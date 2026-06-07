<div class="bg-gray-50 text-gray-800 font-sans min-h-screen flex flex-col antialiased">

    <header class="bg-white border-b border-gray-100 sticky top-0 z-50 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 py-4 flex flex-col sm:flex-row justify-between items-center gap-4">
            <div class="flex items-center space-x-3">
                <div
                    class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center text-white font-black text-xl shadow-md shadow-blue-500/20">
                    C
                </div>
                <div>
                    <span class="text-lg font-bold text-slate-900 tracking-tight">kursus.<span
                            class="text-blue-600">cenari</span>.sch.id</span>
                    <p class="text-[10px] text-gray-400 uppercase tracking-widest font-semibold">Pusat Panduan Sistem</p>
                </div>
            </div>
            <a href="https://kursus.cenari.sch.id" target="_blank"
                class="text-xs font-semibold text-white bg-blue-600 hover:bg-blue-700 px-4 py-2.5 rounded-xl shadow-sm transition-all">
                Buka Aplikasi →
            </a>
        </div>
    </header>

    <main class="flex-grow max-w-7xl w-full mx-auto px-4 py-8 space-y-10">

        <section
            class="bg-white p-5 sm:p-8 rounded-3xl shadow-sm border border-gray-100 grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
            <div class="lg:col-span-5 space-y-4">
                <span
                    class="text-[11px] bg-amber-50 text-amber-700 border border-amber-200 font-bold px-3 py-1 rounded-full uppercase tracking-wider">
                    Video Panduan
                </span>
                <h2 class="text-2xl font-extrabold text-slate-900 tracking-tight leading-tight">
                    Mari Pelajari Cara Kerja Aplikasi Kursus
                </h2>
                <p class="text-sm text-gray-500 leading-relaxed">
                    Tonton video singkat di samping untuk memahami alur manajemen kelas, pengajuan jadwal, absensi
                    berbasis QR Code, hingga sistem penilaian akhir.
                </p>
            </div>
            <div class="lg:col-span-7">
                <div class="relative w-full aspect-video rounded-2xl overflow-hidden shadow-lg border border-gray-100 bg-slate-900"
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

        <section class="space-y-6">

            <div class="flex justify-center p-1.5 bg-slate-100 rounded-2xl max-w-md mx-auto">
                <button wire:click="setTab('instruktur')"
                    class="w-1/2 py-3 rounded-xl text-sm font-bold transition-all outline-none {{ $tab === 'instruktur' ? 'bg-white text-slate-900 shadow-sm' : 'text-gray-500 hover:text-slate-900' }}">
                    👨‍🏫 Untuk Instruktur
                </button>
                <button wire:click="setTab('peserta')"
                    class="w-1/2 py-3 rounded-xl text-sm font-bold transition-all outline-none {{ $tab === 'peserta' ? 'bg-white text-slate-900 shadow-sm' : 'text-gray-500 hover:text-slate-900' }}">
                    👨‍🎓 Untuk Peserta
                </button>
            </div>

            @if ($tab === 'instruktur')
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 animate-fade-in">

                    <div
                        class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center space-x-2.5 mb-4">
                                <span class="p-2 bg-blue-50 text-blue-600 rounded-xl font-bold text-sm">01</span>
                                <h3 class="font-bold text-slate-900 text-sm uppercase tracking-wider">Sebelum Kursus
                                </h3>
                            </div>
                            <ul class="space-y-3 text-xs text-gray-600 list-none pl-0">
                                <li class="flex items-start gap-2"><span class="text-blue-500 font-bold">1.</span> Login
                                    ke <code class="bg-gray-50 px-1 rounded text-blue-600">kursus.cenari.sch.id</code>
                                    menggunakan akun yang dikirim via WhatsApp.</li>
                                <li class="flex items-start gap-2"><span class="text-blue-500 font-bold">2.</span> Lihat
                                    nomor WA peserta di dalam aplikasi, kemudian hubungi peserta.</li>
                                <li class="flex items-start gap-2"><span class="text-blue-500 font-bold">3.</span>
                                    Lakukan komunikasi untuk menyusun kesepakatan jadwal bersama.</li>
                                <li class="flex items-start gap-2"><span class="text-blue-500 font-bold">4.</span> Klik
                                    <strong class="text-slate-800">Buat</strong> pada menu aplikasi, isi Nama Peserta,
                                    Keterangan, Tanggal & Jam, lalu klik <strong class="text-slate-800">Submit</strong>.
                                </li>
                                <li class="flex items-start gap-2"><span class="text-blue-500 font-bold">5.</span>
                                    Jadwal masuk ke kolom <strong class="text-slate-800">DAFTAR PERMOHON</strong> dengan
                                    status <span class="text-amber-600 font-semibold">Pending</span> menunggu verifikasi
                                    Admin.</li>
                                <li class="flex items-start gap-2"><span class="text-blue-500 font-bold">6.</span> Jika
                                    disetujui, jadwal pindah ke kolom <strong class="text-slate-800">JADWAL
                                        KURSUS</strong>. Jika ditolak, status berubah menjadi <span
                                        class="text-red-600 font-semibold">Rejected</span>.</li>
                                <li class="flex items-start gap-2"><span class="text-blue-500 font-bold">7.</span>
                                    Pelatihan dapat dilaksanakan sesuai jadwal yang disetujui di <strong
                                        class="text-slate-800">JADWAL KURSUS</strong>.</li>
                            </ul>
                        </div>
                    </div>

                    <div
                        class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center space-x-2.5 mb-4">
                                <span class="p-2 bg-amber-50 text-amber-600 rounded-xl font-bold text-sm">02</span>
                                <h3 class="font-bold text-slate-900 text-sm uppercase tracking-wider">Saat Berlangsung
                                </h3>
                            </div>
                            <ul class="space-y-3 text-xs text-gray-600 list-none pl-0">
                                <li class="flex items-start gap-2"><span class="text-amber-500 font-bold">1.</span>
                                    Login ke aplikasi <code
                                        class="bg-gray-50 px-1 rounded text-blue-600">kursus.cenari.sch.id</code> di
                                    lokasi pertemuan.</li>
                                <li class="flex items-start gap-2"><span class="text-amber-500 font-bold">2.</span>
                                    Tunjukkan <strong class="text-slate-800">QR CODE</strong> yang muncul di layar
                                    aplikasi Anda kepada peserta.</li>
                                <li class="flex items-start gap-2"><span class="text-amber-500 font-bold">3.</span>
                                    Setelah discan oleh peserta, pantau data kehadiran di kolom <strong
                                        class="text-slate-800">RIWAYAT ABSENSI</strong> dengan mengklik tombol <strong
                                        class="text-slate-800">Detail</strong>.</li>
                            </ul>
                        </div>
                    </div>

                    <div
                        class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center space-x-2.5 mb-4">
                                <span class="p-2 bg-emerald-50 text-emerald-600 rounded-xl font-bold text-sm">03</span>
                                <h3 class="font-bold text-slate-900 text-sm uppercase tracking-wider">Setelah Selesai
                                </h3>
                            </div>
                            <ul class="space-y-3 text-xs text-gray-600 list-none pl-0">
                                <li class="flex items-start gap-2"><span class="text-emerald-500 font-bold">1.</span>
                                    Login kembali ke aplikasi setelah seluruh rangkaian pertemuan selesai.</li>
                                <li class="flex items-start gap-2"><span class="text-emerald-500 font-bold">2.</span>
                                    Cari nama peserta kursus yang bersangkutan, lalu klik tombol <strong
                                        class="text-slate-800">Detail</strong>.</li>
                                <li class="flex items-start gap-2"><span class="text-emerald-500 font-bold">3.</span>
                                    Pada kolom <strong class="text-slate-800">NILAI</strong>, klik <strong
                                        class="text-slate-800">Buat Nilai</strong>, masukkan angka nilai di kolom kanan
                                    sesuai dengan materi, kemudian klik <strong class="text-slate-800">Submit</strong>.
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
            @endif

            @if ($tab === 'peserta')
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 animate-fade-in">

                    <div
                        class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center space-x-2.5 mb-4">
                                <span class="p-2 bg-blue-50 text-blue-600 rounded-xl font-bold text-sm">01</span>
                                <h3 class="font-bold text-slate-900 text-sm uppercase tracking-wider">Sebelum Kursus
                                </h3>
                            </div>
                            <ul class="space-y-3 text-xs text-gray-600 list-none pl-0">
                                <li class="flex items-start gap-2"><span class="text-blue-500 font-bold">1.</span> Login
                                    ke <code class="bg-gray-50 px-1 rounded text-blue-600">kursus.cenari.sch.id</code>
                                    dengan akun dari WA.</li>
                                <li class="flex items-start gap-2"><span class="text-blue-500 font-bold">2.</span> Cari
                                    nomor kontak Instruktur di aplikasi, lalu hubungi via WhatsApp.</li>
                                <li class="flex items-start gap-2"><span class="text-blue-500 font-bold">3.</span>
                                    Berdiskusi dan lakukan perjanjian menyusun jadwal bersama instruktur.</li>
                                <li class="flex items-start gap-2"><span class="text-blue-500 font-bold">4.</span>
                                    Tunggu instruktur membuat permohonan jadwal. Jadwal akan muncul di kolom <strong
                                        class="text-slate-800">JADWAL KURSUS</strong> Anda dengan status <span
                                        class="text-amber-600 font-semibold">Pending</span>.</li>
                                <li class="flex items-start gap-2"><span class="text-blue-500 font-bold">5.</span>
                                    Admin akan memverifikasi permohonan tersebut. Selalu cek status aplikasi Anda secara
                                    berkala.</li>
                                <li class="flex items-start gap-2"><span class="text-blue-500 font-bold">6.</span>
                                    Jika diterima, keterangan Pending hilang. Jika ditolak, akan muncul keterangan <span
                                        class="text-red-600 font-semibold">Rejected</span> pada kolom jadwal.</li>
                                <li class="flex items-start gap-2"><span class="text-blue-500 font-bold">7.</span>
                                    Jika jadwal sudah disetujui tanpa status pending, kelas siap dimulai sesuai waktu
                                    tersebut.</li>
                            </ul>
                        </div>
                    </div>

                    <div
                        class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center space-x-2.5 mb-4">
                                <span class="p-2 bg-amber-50 text-amber-600 rounded-xl font-bold text-sm">02</span>
                                <h3 class="font-bold text-slate-900 text-sm uppercase tracking-wider">Saat Berlangsung
                                </h3>
                            </div>
                            <ul class="space-y-3 text-xs text-gray-600 list-none pl-0">
                                <li class="flex items-start gap-2"><span class="text-amber-500 font-bold">1.</span>
                                    Login ke aplikasi saat tatap muka atau pelatihan dimulai.</li>
                                <li class="flex items-start gap-2"><span class="text-amber-500 font-bold">2.</span>
                                    Masuk ke kolom <strong class="text-slate-800">KAMERA</strong>, lalu klik tombol
                                    <strong class="text-blue-600 font-semibold">Request Camera Permissions</strong>
                                    untuk mengaktifkan kamera.
                                </li>
                                <li class="flex items-start gap-2"><span class="text-amber-500 font-bold">3.</span>
                                    Pindai/Scan <strong class="text-slate-800">QR CODE</strong> yang ada di aplikasi
                                    instruktur. Jika sukses, status kehadiran langsung terekam di <strong
                                        class="text-slate-800">RIWAYAT ABSENSI</strong>.</li>
                            </ul>
                        </div>
                    </div>

                    <div
                        class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center space-x-2.5 mb-4">
                                <span class="p-2 bg-emerald-50 text-emerald-600 rounded-xl font-bold text-sm">03</span>
                                <h3 class="font-bold text-slate-900 text-sm uppercase tracking-wider">Setelah Selesai
                                </h3>
                            </div>
                            <ul class="space-y-3 text-xs text-gray-600 list-none pl-0">
                                <li class="flex items-start gap-2"><span class="text-emerald-500 font-bold">1.</span>
                                    Login kembali ke aplikasi setelah kelas atau pelatihan selesai di hari terakhir.
                                </li>
                                <li class="flex items-start gap-2"><span class="text-emerald-500 font-bold">2.</span>
                                    Periksa capaian nilai yang diinput oleh instruktur pada bagian kolom <strong
                                        class="text-slate-800">NILAI</strong>.</li>
                                <li class="flex items-start gap-2"><span class="text-emerald-500 font-bold">3.</span>
                                    Silakan menunggu proses penerbitan dan pencetakan sertifikat resmi kursus/pelatihan
                                    Anda.</li>
                            </ul>
                        </div>
                    </div>

                </div>
            @endif

        </section>
    </main>

    <footer class="bg-slate-900 text-slate-400 text-xs py-6 mt-12 border-t border-slate-800">
        <div class="max-w-5xl mx-auto px-4 text-center space-y-2">
            <p class="font-medium text-slate-300">© 2026 cenari.id. Hak Cipta Dilindungi.</p>
            <p class="text-slate-500">Jika mengalami kendala login atau akses QR Code, silakan hubungi Admin Lembaga.
            </p>
        </div>
    </footer>

</div>
