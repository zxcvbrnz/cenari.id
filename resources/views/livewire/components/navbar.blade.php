<nav x-data="{ mobileMenu: false, profileOpen: false }"
    class="sticky top-0 z-[100] bg-white/80 backdrop-blur-xl border-b border-slate-100 transition-all duration-300">
    <div class="max-w-7xl mx-auto px-6 lg:px-8 h-20 flex justify-between items-center">

        <a href="/" wire:navigate
            class="font-heading font-extrabold text-xl tracking-tighter flex items-center gap-1 cursor-pointer shrink-0">
            <span class="bg-[#3B82F6] w-2 h-2 rounded-full mb-1"></span>
            CENARI<span class="text-slate-400 font-light">ID</span>
        </a>

        <div class="hidden lg:flex items-center space-x-8 h-full">
            <a href="/" wire:navigate
                class="group text-[11px] font-bold uppercase tracking-widest {{ request()->is('/') ? 'text-[#3B82F6]' : 'text-slate-500' }} hover:text-[#3B82F6] transition-colors relative h-full flex items-center">
                <span>Home</span>
            </a>

            <div x-data="{ open: false }" @mouseleave="open = false" class="relative h-full flex items-center group">
                <button @mouseenter="open = true"
                    class="group text-[11px] font-bold uppercase tracking-widest flex items-center gap-1 {{ request()->routeIs('program.*') ? 'text-[#3B82F6]' : 'text-slate-500' }} hover:text-[#3B82F6]">
                    Programs
                    <svg class="w-3 h-3 transition-transform" :class="open ? 'rotate-180' : ''" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M19 9l-7 7-7-7" stroke-width="3" />
                    </svg>
                </button>
                <div x-show="open" x-cloak x-transition class="absolute left-0 top-[70%] pt-4 w-64">
                    <div class="bg-white border border-slate-100 shadow-xl rounded-2xl py-3 overflow-hidden">
                        @foreach ($instansi as $inst)
                            <div class="px-6 py-2 text-[9px] font-black text-slate-400 uppercase tracking-tighter">
                                {{ $inst->name }}
                            </div>
                            @foreach ($inst->programs as $program)
                                <a href="{{ route('program.detail', $program->slug) }}" wire:navigate
                                    @class([
                                        'block px-6 py-2.5 text-[10px] font-bold uppercase tracking-widest transition-all duration-200',
                                        // Kondisi Active: Jika slug di URL sama dengan slug program
                                        'bg-blue-50 text-[#3B82F6] border-r-4 border-[#3B82F6]' =>
                                            request()->route('slug') == $program->slug,
                                        // Kondisi Normal: Jika tidak aktif
                                        'text-slate-600 hover:bg-slate-50 hover:text-[#3B82F6]' =>
                                            request()->route('slug') != $program->slug,
                                    ])>
                                    {{ $program->navigation }}
                                </a>
                            @endforeach
                        @endforeach
                    </div>
                </div>
            </div>

            <a href="{{ route('portfolio.gallery') }}" wire:navigate
                class="text-[11px] font-bold uppercase tracking-widest {{ request()->routeIs('portfolio.*') ? 'text-[#3B82F6]' : 'text-slate-500' }} hover:text-[#3B82F6]">Portfolio</a>

            <a href="{{ route('shop') }}" wire:navigate
                class="text-[11px] font-bold uppercase tracking-widest {{ request()->routeIs('shop*') ? 'text-[#3B82F6]' : 'text-slate-500' }} hover:text-[#3B82F6]">Toko</a>

            <a href="{{ route('blog.index') }}" wire:navigate
                class="text-[11px] font-bold uppercase tracking-widest {{ request()->routeIs('blog*') ? 'text-[#3B82F6]' : 'text-slate-500' }} hover:text-[#3B82F6]">Blog</a>

            {{-- <a href="{{ route('b2b.solution') }}" wire:navigate
                class="text-[11px] font-bold uppercase tracking-widest {{ request()->routeIs('b2b.*') ? 'text-[#3B82F6]' : 'text-slate-500' }} hover:text-slate-900">Mitra
                Sekolah</a> --}}

            <div x-data="{ open: false }" @mouseleave="open = false" class="relative h-full flex items-center group">
                <button @mouseenter="open = true"
                    class="text-[11px] font-bold uppercase tracking-widest flex items-center gap-1 {{ request()->routeIs('b2b.*') ? 'text-[#3B82F6]' : 'text-slate-500' }} hover:text-slate-900">
                    Mitra Kerjasama
                    <svg class="w-3 h-3 transition-transform" :class="open ? 'rotate-180' : ''" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M19 9l-7 7-7-7" stroke-width="3" />
                    </svg>
                </button>

                <div x-show="open" x-cloak x-transition class="absolute left-0 top-[70%] pt-4 w-52">
                    <div class="bg-white border border-slate-100 shadow-xl rounded-2xl py-3 overflow-hidden">
                        <a href="{{ route('b2b.solution') }}" wire:navigate @class([
                            'block px-6 py-2.5 text-[10px] font-bold uppercase tracking-widest transition-all duration-200',
                            'bg-blue-50 text-[#3B82F6] border-r-4 border-[#3B82F6]' => request()->routeIs(
                                'b2b.solution'),
                            'text-slate-600 hover:bg-slate-50 hover:text-[#3B82F6]' => !request()->routeIs(
                                'b2b.solution'),
                        ])>Mitra
                            Sekolah</a>

                        <a href="{{ route('b2b.institution') }}" wire:navigate @class([
                            'block px-6 py-2.5 text-[10px] font-bold uppercase tracking-widest transition-all duration-200',
                            'bg-blue-50 text-[#3B82F6] border-r-4 border-[#3B82F6]' => request()->routeIs(
                                'b2b.institution'),
                            'text-slate-600 hover:bg-slate-50 hover:text-[#3B82F6]' => !request()->routeIs(
                                'b2b.institution'),
                        ])>Mitra
                            Instansi</a>
                    </div>
                </div>
            </div>

            <div x-data="{ open: false }" @mouseleave="open = false" class="relative h-full flex items-center group">
                <button @mouseenter="open = true"
                    class="text-[11px] font-bold uppercase tracking-widest flex items-center gap-1 {{ request()->routeIs('course.packages') || request()->routeIs('workshops') ? 'text-[#3B82F6]' : 'text-slate-500' }} hover:text-slate-900">
                    Layanan Lain
                    <svg class="w-3 h-3 transition-transform" :class="open ? 'rotate-180' : ''" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M19 9l-7 7-7-7" stroke-width="3" />
                    </svg>
                </button>

                <div x-show="open" x-cloak x-transition class="absolute left-0 top-[70%] pt-4 w-52">
                    <div class="bg-white border border-slate-100 shadow-xl rounded-2xl py-3 overflow-hidden">
                        <a href="{{ route('course.packages') }}" wire:navigate @class([
                            'block px-6 py-2.5 text-[10px] font-bold uppercase tracking-widest transition-all duration-200',
                            'bg-blue-50 text-[#3B82F6] border-r-4 border-[#3B82F6]' => request()->routeIs(
                                'course.packages'),
                            'text-slate-600 hover:bg-slate-50 hover:text-[#3B82F6]' => !request()->routeIs(
                                'course.packages'),
                        ])>Paket
                            Kursus</a>

                        <a href="{{ route('workshops') }}" wire:navigate @class([
                            'block px-6 py-2.5 text-[10px] font-bold uppercase tracking-widest transition-all duration-200',
                            'bg-blue-50 text-[#3B82F6] border-r-4 border-[#3B82F6]' => request()->routeIs(
                                'workshops'),
                            'text-slate-600 hover:bg-slate-50 hover:text-[#3B82F6]' => !request()->routeIs(
                                'workshops'),
                        ])>Workshop</a>
                    </div>
                </div>
            </div>

            @if (auth()->check() && auth()->user()->role === 'admin')
                <a href="{{ route('dashboard') }}" wire:navigate
                    class="text-[10px] font-black uppercase tracking-widest text-white bg-slate-900 px-4 py-2 rounded-xl hover:bg-blue-600 transition-all">
                    Dashboard
                </a>
            @endif
        </div>

        <div class="flex items-center gap-3 lg:gap-6 shrink-0">
            @auth
                <div class="relative">
                    <button @click="profileOpen = !profileOpen" class="flex items-center gap-3 group">
                        <div class="hidden lg:flex flex-col items-end">
                            <span
                                class="text-[10px] font-black text-slate-900 leading-none">{{ auth()->user()->name }}</span>
                        </div>
                        <div
                            class="h-10 w-10 rounded-2xl bg-slate-50 border border-slate-200 flex items-center justify-center text-[#3B82F6] font-black text-xs group-hover:border-[#3B82F6] transition-all">
                            {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                        </div>
                    </button>

                    <div x-show="profileOpen" @click.away="profileOpen = false" x-cloak x-transition
                        class="absolute right-0 top-full mt-3 w-64 bg-white border border-slate-100 shadow-2xl rounded-[2rem] py-4 overflow-hidden z-50">

                        <div class="px-6 py-2 border-b border-slate-50 mb-2">
                            <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Akun Saya</p>
                        </div>

                        <a href="{{ route('profile') }}" wire:navigate
                            class="block px-6 py-3 text-[10px] font-bold uppercase tracking-widest transition-colors 
                                {{ request()->routeIs('profile')
                                    ? 'bg-blue-50 text-[#3B82F6] border-r-4 border-[#3B82F6]'
                                    : 'text-slate-600 hover:bg-slate-50' }}">
                            Pengaturan Profil
                        </a>

                        <a href="{{ route('course.packages.user.list') }}" wire:navigate
                            class="block px-6 py-3 text-[10px] font-bold uppercase tracking-widest transition-colors 
                                {{ request()->routeIs('course.packages.user.list')
                                    ? 'bg-blue-50 text-[#3B82F6] border-r-4 border-[#3B82F6]'
                                    : 'text-slate-600 hover:bg-slate-50' }}">
                            Kursus Saya
                        </a>

                        {{-- <div class="px-6 py-3 mt-2">
                            <p class="text-[9px] font-black text-blue-600 uppercase tracking-widest mb-3">Kursus Aktif</p>
                            <div class="space-y-2 max-h-56 overflow-y-auto pr-2 custom-scrollbar">
                                @forelse(auth()->user()->coursePackages as $course)
                                    <a href="/learning/{{ $course->id }}" wire:navigate
                                        class="group block p-3 rounded-2xl bg-slate-50 hover:bg-blue-50 transition-all border border-transparent hover:border-blue-100">
                                        <div class="flex flex-col">
                                            <span
                                                class="text-[9px] font-black text-slate-900 uppercase tracking-tighter truncate leading-tight group-hover:text-blue-600">
                                                {{ $course->name }}
                                            </span>

                                            <div class="flex items-center gap-2 mt-2">
                                                <span
                                                    class="px-2 py-0.5 rounded-md bg-white border border-slate-200 text-[7px] font-black text-slate-500 uppercase tracking-wider">
                                                    {{ $course->pivot->learning_methode }}
                                                </span>

                                                <span class="w-1 h-1 rounded-full bg-slate-300"></span>

                                                <div class="flex items-center gap-1">
                                                    <span
                                                        class="w-1.5 h-1.5 rounded-full {{ $course->pivot->status == 'Selesai' ? 'bg-green-500' : ($course->pivot->status == 'Sedang Berjalan' ? 'bg-blue-500' : 'bg-orange-500') }}"></span>
                                                    <span
                                                        class="text-[8px] font-bold text-slate-400 uppercase tracking-widest italic">
                                                        {{ $course->pivot->status }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                @empty
                                    <p class="text-[8px] font-medium text-slate-400 italic">Belum ada kursus aktif.</p>
                                @endforelse
                            </div>
                        </div> --}}

                        <div class="border-t border-slate-50 mt-2 pt-2">
                            <button wire:click="logout"
                                class="w-full text-left px-6 py-3 text-[10px] font-black text-red-500 hover:bg-red-50 transition-colors uppercase tracking-widest">
                                Logout
                            </button>
                        </div>
                    </div>
                </div>
            @else
                <div class="hidden lg:flex items-center gap-4">
                    <a href="{{ route('login') }}" wire:navigate
                        class="text-[11px] font-bold uppercase tracking-widest text-slate-500 hover:text-[#3B82F6]">Login</a>
                    <a href="{{ route('register') }}" wire:navigate
                        class="bg-[#3B82F6] text-white px-6 py-3 rounded-2xl font-black text-[10px] tracking-widest uppercase hover:bg-slate-900 transition-all shadow-xl shadow-blue-500/20">
                        Daftar Sekarang
                    </a>
                </div>
            @endauth

            <button @click="mobileMenu = !mobileMenu"
                class="lg:hidden p-2 text-slate-600 hover:bg-slate-50 rounded-xl transition-colors">
                <svg x-show="!mobileMenu" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                </svg>
                <svg x-show="mobileMenu" x-cloak class="w-6 h-6" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>

    <div x-show="mobileMenu" x-transition x-cloak
        class="lg:hidden bg-white border-b border-slate-100 absolute w-full left-0 z-[90] shadow-2xl px-6 py-8 overflow-y-auto max-h-[calc(100vh-80px)]">

        <div class="flex flex-col space-y-6">
            @if (auth()->check() && auth()->user()->role === 'admin')
                <a href="{{ route('dashboard') }}" wire:navigate @click="mobileMenu = false"
                    class="text-xs font-black uppercase tracking-widest text-blue-600 bg-blue-50 p-4 rounded-2xl text-center border border-blue-100 shadow-sm">
                    Dashboard Admin
                </a>
            @endif

            <a href="/" wire:navigate @click="mobileMenu = false"
                class="text-xs font-black uppercase tracking-widest {{ request()->is('/') ? 'text-[#3B82F6]' : 'text-slate-600' }}">
                Home
            </a>

            <div x-data="{ subOpen: false }">
                <button @click="subOpen = !subOpen"
                    class="w-full flex justify-between items-center text-xs font-black uppercase tracking-widest text-slate-600">
                    Programs
                    <svg class="w-4 h-4 transition-transform" :class="subOpen ? 'rotate-180' : ''" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M19 9l-7 7-7-7" stroke-width="2" />
                    </svg>
                </button>
                <div x-show="subOpen" x-transition class="mt-4 ml-4 space-y-4 border-l-2 border-slate-100 pl-4">
                    @foreach ($instansi as $inst)
                        <div class="text-[9px] font-black text-slate-400 uppercase tracking-widest">
                            {{ $inst->name }}
                        </div>
                        @foreach ($inst->programs as $program)
                            <a href="{{ route('program.detail', $program->slug) }}" wire:navigate
                                class="block text-[10px] font-bold uppercase tracking-widest text-slate-500">
                                {{ $program->navigation }}
                            </a>
                        @endforeach
                    @endforeach
                    {{-- <a href="{{ route('program.detail', 'smart-building') }}"
                        class="block text-[10px] font-bold uppercase tracking-widest text-slate-500">Desain</a>
                    <a href="{{ route('program.detail', 'business-intel') }}"
                        class="block text-[10px] font-bold uppercase tracking-widest text-slate-500">Bisnis & AI</a>
                    <a href="{{ route('program.detail', 'software-control') }}"
                        class="block text-[10px] font-bold uppercase tracking-widest text-slate-500">Web
                        Programming</a>
                    <a href="{{ route('program.detail', 'creative-design') }}"
                        class="block text-[10px] font-bold uppercase tracking-widest text-slate-500">Robotik &
                        Coding</a> --}}
                </div>
            </div>

            <a href="{{ route('portfolio.gallery') }}" wire:navigate @click="mobileMenu = false"
                class="text-xs font-black uppercase tracking-widest text-slate-600">Portfolio</a>
            <a href="{{ route('shop') }}" wire:navigate @click="mobileMenu = false"
                class="text-xs font-black uppercase tracking-widest text-slate-600">Toko</a>
            <a href="{{ route('blog.index') }}" wire:navigate @click="mobileMenu = false"
                class="text-xs font-black uppercase tracking-widest text-slate-600">Blog</a>
            <a href="{{ route('b2b.solution') }}" wire:navigate @click="mobileMenu = false"
                class="text-xs font-black uppercase tracking-widest text-slate-600">Mitra Sekolah</a>

            <div x-data="{ subOpen: false }">
                <button @click="subOpen = !subOpen"
                    class="w-full flex justify-between items-center text-xs font-black uppercase tracking-widest text-slate-600">
                    Layanan Lain
                    <svg class="w-4 h-4 transition-transform" :class="subOpen ? 'rotate-180' : ''" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M19 9l-7 7-7-7" stroke-width="2" />
                    </svg>
                </button>
                <div x-show="subOpen" x-transition class="mt-4 ml-4 space-y-4 border-l-2 border-slate-100 pl-4">
                    <a href="{{ route('course.packages') }}"
                        class="block text-[10px] font-bold uppercase tracking-widest text-slate-500">Paket Kursus</a>
                    <a href="{{ route('workshops') }}"
                        class="block text-[10px] font-bold uppercase tracking-widest text-slate-500">Workshop</a>
                </div>
            </div>

            <hr class="border-slate-100 my-2">

            @guest
                <div class="flex flex-col space-y-3 pt-2">
                    <a href="{{ route('login') }}" wire:navigate @click="mobileMenu = false"
                        class="w-full py-4 text-center text-xs font-black uppercase tracking-widest text-slate-600 border border-slate-200 rounded-2xl hover:bg-slate-50 transition-colors">
                        Login
                    </a>
                    <a href="{{ route('register') }}" wire:navigate @click="mobileMenu = false"
                        class="w-full py-4 text-center text-xs font-black uppercase tracking-widest text-white bg-[#3B82F6] rounded-2xl shadow-lg shadow-blue-500/20">
                        Daftar Sekarang
                    </a>
                </div>
            @endguest

            @auth
                <div class="flex flex-col space-y-4 pt-2">
                    <div class="px-4 py-3 bg-slate-50 rounded-2xl border border-slate-100">
                        <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">Logged in as</p>
                        <p class="text-xs font-black text-slate-900 uppercase tracking-tight">{{ auth()->user()->name }}
                        </p>
                    </div>
                    <a href="/profile" wire:navigate @click="mobileMenu = false"
                        class="text-xs font-black uppercase tracking-widest text-slate-600">Pengaturan Akun</a>
                    <button wire:click="logout"
                        class="text-xs font-black uppercase tracking-widest text-red-500 text-left">Keluar</button>
                </div>
            @endauth
        </div>
    </div>
</nav>
