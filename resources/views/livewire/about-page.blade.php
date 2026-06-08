<div
    class="bg-slate-50 text-slate-800 font-sans min-h-screen flex flex-col antialiased selection:bg-blue-500 selection:text-white">

    <main class="w-full mx-auto space-y-20 py-12 sm:py-20">

        @if ($about)
            <section class="max-w-7xl mx-auto px-6 grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                <div class="lg:col-span-6 space-y-5 order-2 lg:order-1">
                    <span
                        class="inline-block text-[10px] bg-blue-50 text-blue-600 border border-blue-200 font-extrabold px-3 py-1 rounded-full uppercase tracking-wider">
                        Visi & Filosofi
                    </span>
                    <h1 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight leading-tight">
                        Membangun Fondasi Teknologi Masa Depan
                    </h1>
                    <p class="text-sm sm:text-base text-slate-600 leading-relaxed">
                        {!! $about->formatted_text_1 !!}
                    </p>
                </div>
                <div class="lg:col-span-6 order-1 lg:order-2">
                    <div
                        class="relative aspect-[4/3] rounded-3xl overflow-hidden shadow-md border border-slate-100 bg-slate-200 group">
                        <img src="{{ asset('storage/' . $about->image_1) }}" alt="Tentang Kami - Ilustrasi 1"
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    </div>
                </div>
            </section>

            <section class="max-w-7xl mx-auto px-6 grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                <div class="lg:col-span-6">
                    <div
                        class="relative aspect-[4/3] rounded-3xl overflow-hidden shadow-md border border-slate-100 bg-slate-200 group">
                        <img src="{{ asset('storage/' . $about->image_2) }}" alt="Tentang Kami - Ilustrasi 2"
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    </div>
                </div>
                <div class="lg:col-span-6 space-y-5">
                    <span
                        class="inline-block text-[10px] bg-amber-50 text-amber-700 border border-amber-200 font-extrabold px-3 py-1 rounded-full uppercase tracking-wider">
                        Komitmen & Implementasi
                    </span>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight leading-tight">
                        Mendukung Transformasi Digital Berkelanjutan
                    </h2>
                    <p class="text-sm sm:text-base text-slate-600 leading-relaxed">
                        {!! $about->formatted_text_2 !!}
                    </p>
                </div>
            </section>
        @endif

        <section class="bg-white py-16 sm:py-24 border-y border-slate-100">
            <div class="max-w-7xl mx-auto px-6 space-y-12">
                <div class="max-w-2xl space-y-2">
                    <span
                        class="inline-block text-[10px] bg-emerald-50 text-emerald-700 border border-emerald-200 font-extrabold px-3 py-1 rounded-full uppercase tracking-wider">
                        Fokus Utama
                    </span>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">
                        Lini Bisnis & Sektor Industri
                    </h2>
                    <p class="text-xs sm:text-sm text-slate-500 leading-relaxed">
                        Membawahi berbagai institusi dan layanan inovatif untuk menghadirkan solusi teknologi
                        terintegrasi secara berkelanjutan.
                    </p>
                </div>

                <div class="w-full overflow-visible">

                    <div
                        class="inline-flex flex-nowrap items-stretch bg-slate-50 border border-slate-200 rounded-2xl divide-x divide-slate-200 shadow-sm min-w-full">

                        @forelse($businessLines as $line)
                            <div
                                class="w-80 sm:w-96 p-6 sm:p-8 flex flex-col justify-between space-y-4 hover:bg-white transition-all group first:rounded-l-2xl last:rounded-r-2xl">
                                <div class="space-y-3">
                                    <div
                                        class="w-10 h-10 bg-white rounded-xl flex items-center justify-center shadow-sm border border-slate-100 group-hover:bg-blue-50 group-hover:border-blue-100 transition-colors">
                                        <span class="text-blue-600 font-black text-sm">#{{ $loop->iteration }}</span>
                                    </div>

                                    <h3
                                        class="text-lg font-bold text-slate-900 tracking-tight group-hover:text-blue-600 transition-colors">
                                        {{ $line->name }}
                                    </h3>

                                    <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                                        {{ $line->description }}
                                    </p>
                                </div>
                            </div>
                        @empty
                            <div class="w-full text-center py-12 text-slate-400 text-xs font-medium px-6">
                                Belum ada data lini bisnis yang tersedia.
                            </div>
                        @endforelse

                    </div>
                </div>
            </div>
        </section>

        @if ($about && ($about->pdf_url || $about->video_url))
            <section class="max-w-7xl mx-auto px-6">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-stretch">

                    @if ($about->pdf_url)
                        <div
                            class="lg:col-span-5 bg-white p-6 sm:p-8 rounded-3xl border border-slate-100 flex flex-col justify-between shadow-sm space-y-6">
                            <div class="space-y-3">
                                <div
                                    class="w-10 h-10 bg-red-50 text-red-600 rounded-xl flex items-center justify-center border border-red-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                    </svg>
                                </div>
                                <h3 class="text-lg font-bold text-slate-900 tracking-tight">Company Profile & Legalitas
                                </h3>
                                <p class="text-xs sm:text-sm text-slate-500 leading-relaxed">
                                    Unduh dokumen resmi profil perusahaan kami untuk mempelajari struktur kelembagaan,
                                    legalitas hukum, dan portofolio teknologi terapan secara komprehensif.
                                </p>
                            </div>
                            <a href="{{ asset('storage/' . $about->pdf_url) }}" target="_blank"
                                class="inline-flex items-center justify-center gap-2 text-xs font-bold text-white bg-red-600 hover:bg-red-700 px-5 py-3 rounded-xl transition-all shadow-sm shadow-red-600/10 tracking-wide w-full">
                                Unduh Company Profile (PDF)
                            </a>
                        </div>
                    @endif

                    @if ($about->video_url)
                        <div
                            class="lg:col-span-7 bg-white p-4 sm:p-6 rounded-3xl border border-slate-100 shadow-sm flex flex-col justify-center">
                            <div
                                class="relative w-full aspect-video rounded-2xl overflow-hidden shadow-sm bg-slate-900 border border-slate-100">
                                <iframe class="absolute top-0 left-0 w-full h-full"
                                    src="https://www.youtube.com/embed/{{ $about->video_url }}"
                                    title="Company Video Profile" frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                    allowfullscreen>
                                </iframe>
                            </div>
                        </div>
                    @endif

                </div>
            </section>
        @endif

    </main>
</div>
