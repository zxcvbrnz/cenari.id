<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cenari Education Center - Konvergensi Teknologi 2026</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@800&family=Inter:wght@400;600&display=swap"
        rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <style>
        [v-cloak] {
            display: none;
        }

        .font-heading {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .font-body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="font-body bg-[#F8FAFC] text-[#0F172A]">
    <nav x-data="{ mobileMenu: false }"
        class="sticky top-0 z-[100] bg-white/80 backdrop-blur-xl border-b border-slate-100 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 h-20 flex justify-between items-center">

            <a href="/" wire:navigate
                class="font-heading font-extrabold text-xl tracking-tighter flex items-center gap-1 cursor-pointer shrink-0">
                <span class="bg-[#3B82F6] w-2 h-2 rounded-full mb-1"></span>
                CENARI<span class="text-slate-400 font-light">ID</span>
            </a>

            <div class="hidden lg:flex items-center space-x-10 h-full">
                <a href="/" wire:navigate
                    class="group text-[11px] font-bold uppercase tracking-widest {{ request()->is('/') ? 'text-[#3B82F6]' : 'text-slate-500' }} hover:text-[#3B82F6] transition-colors relative h-full flex items-center">
                    <span class="relative py-1">Home</span>
                </a>

                <div x-data="{ open: false }" @mouseleave="open = false" class="relative h-full flex items-center group">
                    <button @mouseenter="open = true"
                        class="group text-[11px] font-bold uppercase tracking-widest flex items-center gap-1 {{ request()->routeIs('program.*') ? 'text-[#3B82F6]' : 'text-slate-500' }} hover:text-[#3B82F6]">
                        Programs <svg class="w-3 h-3 transition-transform" :class="open ? 'rotate-180' : ''"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M19 9l-7 7-7-7" stroke-width="3" />
                        </svg>
                    </button>
                    <div x-show="open" x-cloak x-transition class="absolute left-0 top-[70%] pt-4 w-56">
                        <div class="bg-white border border-slate-100 shadow-xl rounded-2xl py-3 overflow-hidden">
                            @php
                                $programs = [
                                    ['route' => 'smart-building', 'label' => 'Desain'],
                                    ['route' => 'business-intel', 'label' => 'Bisnis & AI'],
                                    ['route' => 'software-control', 'label' => 'Web Programming'],
                                    ['route' => 'creative-design', 'label' => 'Robotik & Coding'],
                                ];
                            @endphp
                            @foreach ($programs as $p)
                                <a href="{{ route('program.detail', $p['route']) }}" wire:navigate
                                    class="block px-6 py-3 text-[10px] font-bold uppercase tracking-widest {{ request()->is('programs/' . $p['route'] . '*') ? 'text-[#3B82F6] bg-slate-50' : 'text-slate-600' }} hover:bg-slate-50 hover:text-[#3B82F6]">
                                    {{ $p['label'] }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>

                <a href="{{ route('portfolio.gallery') }}" wire:navigate
                    class="text-[11px] font-bold uppercase tracking-widest {{ request()->routeIs('portfolio.*') ? 'text-[#3B82F6]' : 'text-slate-500' }} hover:text-[#3B82F6]">Portfolio</a>

                <a href="{{ route('shop') }}" wire:navigate
                    class="text-[11px] font-bold uppercase tracking-widest {{ request()->routeIs('shop*') ? 'text-[#3B82F6]' : 'text-slate-500' }} hover:text-[#3B82F6]">Toko</a>

                <a href="{{ route('b2b.solution') }}" wire:navigate
                    class="text-[11px] font-bold uppercase tracking-widest {{ request()->routeIs('b2b.*') ? 'text-[#3B82F6]' : 'text-slate-500' }} hover:text-slate-900">Mitra
                    Sekolah</a>

                <div x-data="{ open: false }" @mouseleave="open = false" class="relative h-full flex items-center group">
                    <button @mouseenter="open = true"
                        class="text-[11px] font-bold uppercase tracking-widest flex items-center gap-1 {{ request()->routeIs('course.*') || request()->routeIs('workshops*') ? 'text-[#3B82F6]' : 'text-slate-500' }} hover:text-slate-900">
                        Layanan Lain <svg class="w-3 h-3 transition-transform" :class="open ? 'rotate-180' : ''"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M19 9l-7 7-7-7" stroke-width="3" />
                        </svg>
                    </button>
                    <div x-show="open" x-cloak x-transition class="absolute left-0 top-[70%] pt-4 w-52">
                        <div class="bg-white border border-slate-100 shadow-xl rounded-2xl py-3 overflow-hidden">
                            <a href="{{ route('course.packages') }}" wire:navigate
                                class="block px-6 py-3 text-[10px] font-bold uppercase tracking-widest {{ request()->routeIs('course.*') ? 'text-[#3B82F6] bg-slate-50' : 'text-slate-600' }} hover:bg-slate-50">
                                Paket Kursus
                            </a>
                            <a href="{{ route('workshops') }}" wire:navigate
                                class="block px-6 py-3 text-[10px] font-bold uppercase tracking-widest {{ request()->routeIs('workshops*') ? 'text-[#3B82F6] bg-slate-50' : 'text-slate-600' }} hover:bg-slate-50">
                                Workshop
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-3 lg:gap-6 shrink-0">
                <button
                    class="bg-[#3B82F6] text-white px-5 lg:px-7 py-2.5 rounded-full font-bold text-[9px] lg:text-[10px] tracking-widest uppercase hover:bg-[#0F172A] transition-all shadow-lg shadow-blue-500/20">
                    Daftar Sekarang
                </button>

                <button @click="mobileMenu = !mobileMenu"
                    class="lg:hidden p-2 text-slate-600 hover:bg-slate-50 rounded-xl transition-colors">
                    <svg x-show="!mobileMenu" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16m-7 6h7" />
                    </svg>
                    <svg x-show="mobileMenu" x-cloak class="w-6 h-6" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        <div x-show="mobileMenu" x-transition
            class="lg:hidden bg-white border-b border-slate-100 absolute w-full left-0 z-[90] shadow-2xl px-6 py-8 overflow-y-auto max-h-[calc(100vh-80px)]"
            x-cloak>
            <div class="flex flex-col space-y-6">
                <a href="/" wire:navigate @click="mobileMenu = false"
                    class="text-xs font-black uppercase tracking-widest {{ request()->is('/') ? 'text-[#3B82F6]' : 'text-slate-600' }}">Home</a>

                <div x-data="{ subOpen: {{ request()->routeIs('program.*') ? 'true' : 'false' }} }">
                    <button @click="subOpen = !subOpen"
                        class="w-full flex justify-between items-center text-xs font-black uppercase tracking-widest {{ request()->routeIs('program.*') ? 'text-[#3B82F6]' : 'text-slate-600' }}">
                        Programs <svg class="w-4 h-4 transition-transform" :class="subOpen ? 'rotate-180' : ''"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M19 9l-7 7-7-7" stroke-width="2" />
                        </svg>
                    </button>
                    <div x-show="subOpen" x-cloak class="mt-4 ml-4 space-y-4 border-l-2 border-slate-100 pl-4">
                        @foreach ($programs as $p)
                            <a href="{{ route('program.detail', $p['route']) }}" wire:navigate
                                @click="mobileMenu = false"
                                class="block text-[10px] font-bold uppercase tracking-widest {{ request()->is('programs/' . $p['route'] . '*') ? 'text-[#3B82F6]' : 'text-slate-500' }}">
                                {{ $p['label'] }}
                            </a>
                        @endforeach
                    </div>
                </div>

                <a href="{{ route('portfolio.gallery') }}" wire:navigate @click="mobileMenu = false"
                    class="text-xs font-black uppercase tracking-widest {{ request()->routeIs('portfolio.*') ? 'text-[#3B82F6]' : 'text-slate-600' }}">Portfolio</a>

                <a href="{{ route('shop') }}" wire:navigate @click="mobileMenu = false"
                    class="text-xs font-black uppercase tracking-widest {{ request()->routeIs('shop*') ? 'text-[#3B82F6]' : 'text-slate-600' }}">Toko</a>

                <div x-data="{ otherOpen: {{ request()->routeIs('course.*') || request()->routeIs('workshops*') ? 'true' : 'false' }} }">
                    <button @click="otherOpen = !otherOpen"
                        class="w-full flex justify-between items-center text-xs font-black uppercase tracking-widest {{ request()->routeIs('course.*') || request()->routeIs('workshops*') ? 'text-[#3B82F6]' : 'text-slate-600' }}">
                        Layanan Lain <svg class="w-4 h-4 transition-transform" :class="otherOpen ? 'rotate-180' : ''"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M19 9l-7 7-7-7" stroke-width="2" />
                        </svg>
                    </button>
                    <div x-show="otherOpen" x-cloak class="mt-4 ml-4 space-y-4 border-l-2 border-slate-100 pl-4">
                        <a href="{{ route('course.packages') }}" wire:navigate @click="mobileMenu = false"
                            class="block text-[10px] font-bold uppercase tracking-widest {{ request()->routeIs('course.*') ? 'text-[#3B82F6]' : 'text-slate-500' }}">Paket
                            Kursus</a>
                        <a href="{{ route('workshops') }}" wire:navigate @click="mobileMenu = false"
                            class="block text-[10px] font-bold uppercase tracking-widest {{ request()->routeIs('workshops*') ? 'text-[#3B82F6]' : 'text-slate-500' }}">Workshop</a>
                    </div>
                </div>

                <hr class="border-slate-100">
            </div>
        </div>
    </nav>

    {{ $slot }}

    <footer class="bg-white pt-20 pb-10 border-t border-slate-100">
        <div class="max-w-7xl mx-auto px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-16">
                <div class="col-span-1">
                    <div class="font-heading font-extrabold text-xl tracking-tighter text-[#0F172A] mb-5">
                        CENARI<span class="text-[#3B82F6]">ID</span>
                    </div>
                    <p class="text-slate-500 text-[11px] leading-relaxed mb-6 max-w-[240px]">
                        Menghubungkan imajinasi dan realitas melalui pendidikan teknologi terapan di Banjarmasin.
                    </p>
                    <div class="flex gap-3">
                        <a href="#"
                            class="w-8 h-8 rounded-full border border-slate-100 flex items-center justify-center hover:bg-slate-50 transition-colors">
                            <span class="text-[10px] font-bold text-slate-400">IG</span>
                        </a>
                        <a href="#"
                            class="w-8 h-8 rounded-full border border-slate-100 flex items-center justify-center hover:bg-slate-50 transition-colors">
                            <span class="text-[10px] font-bold text-slate-400">YT</span>
                        </a>
                    </div>
                </div>

                <div>
                    <h4 class="text-[#0F172A] text-[10px] font-black uppercase tracking-[0.2em] mb-6">Program</h4>
                    <ul class="space-y-3 text-slate-500 text-[11px] font-semibold">
                        <li><a href="#" class="hover:text-[#3B82F6] transition-colors">Coding Academy</a></li>
                        <li><a href="#" class="hover:text-[#3B82F6] transition-colors">Robotik Pro</a></li>
                        <li><a href="#" class="hover:text-[#3B82F6] transition-colors">Digital Bisnis</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-[#0F172A] text-[10px] font-black uppercase tracking-[0.2em] mb-6">Lembaga</h4>
                    <ul class="space-y-3 text-slate-500 text-[11px] font-semibold">
                        <li><a href="#" class="hover:text-[#3B82F6] transition-colors">Tentang Kami</a></li>
                        <li><a href="#" class="hover:text-[#3B82F6] transition-colors">Mitra Sekolah</a></li>
                        <li><a href="#" class="hover:text-[#3B82F6] transition-colors">Kontak</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-[#0F172A] text-[10px] font-black uppercase tracking-[0.2em] mb-6">Newsletter</h4>
                    <div class="flex flex-col gap-3">
                        <input type="email" placeholder="Email Anda"
                            class="bg-slate-50 border border-slate-100 rounded-xl py-2.5 px-4 text-[11px] focus:outline-none focus:border-[#3B82F6] transition-all">
                        <button
                            class="bg-slate-100 text-slate-600 py-2.5 rounded-xl text-[9px] font-bold uppercase tracking-widest hover:bg-[#3B82F6] hover:text-white transition-all">Berlangganan</button>
                    </div>
                </div>
            </div>

            <div class="pt-8 border-t border-slate-50 flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-[9px] text-slate-400 font-bold uppercase tracking-[0.15em]">
                    &copy; 2026 CENARI EDUCATION CENTER.
                </p>
                <div class="flex gap-6 text-[9px] text-slate-400 font-bold uppercase tracking-[0.15em]">
                    <a href="#" class="hover:text-slate-900 transition-colors">Privasi</a>
                    <a href="#" class="hover:text-slate-900 transition-colors">Ketentuan</a>
                </div>
            </div>
        </div>
    </footer>
    <div class="fixed bottom-8 right-8 z-[100]">
        <button
            class="w-16 h-16 bg-[#3B82F6] rounded-full shadow-2xl flex items-center justify-center text-white hover:scale-110 transition group">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z">
                </path>
            </svg>
            <span
                class="absolute right-20 bg-white text-[#0F172A] px-4 py-2 rounded-xl text-sm font-bold shadow-xl opacity-0 group-hover:opacity-100 transition whitespace-nowrap">Cenari
                Bot</span>
        </button>
    </div>

    @livewireScripts
</body>

</html>
