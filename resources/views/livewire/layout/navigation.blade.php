<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component {
    public function logout(Logout $logout): void
    {
        $logout();
        $this->redirect('/', navigate: true);
    }
}; ?>

<div>
    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
        class="fixed top-0 left-0 z-50 w-64 h-screen transition-all duration-300 ease-in-out bg-slate-900 lg:translate-x-0 border-r border-slate-800 shadow-xl"
        aria-label="Sidebar">

        <!-- Logo Section -->
        <div class="flex items-center px-6 h-20 border-b border-slate-800">
            <a href="{{ route('dashboard') }}" wire:navigate class="flex items-center space-x-3">
                <img src="{{ asset('logoCenari2020 PATEN.png') }}" alt="Cenari ID Logo" class="h-8">
                {{-- <span class="text-lg font-bold tracking-tight text-white">Admin Panel</span> --}}
            </a>
        </div>

        <!-- Navigation Menu -->
        <nav class="mt-6 px-3 space-y-6 h-[calc(100vh-5rem)] overflow-y-auto pb-6">

            @php
                // Menu dikelompokkan berdasarkan kategori agar lebih terstruktur
                $menuGroups = [
                    'Dashboard & Utama' => [
                        [
                            'route' => 'dashboard',
                            'label' => 'Dashboard',
                            'icon' =>
                                'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6', // Home / Dashboard
                        ],
                        [
                            'route' => 'manage.instansi',
                            'label' => 'Instansi',
                            'icon' =>
                                'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4', // Office / Building
                        ],
                        [
                            'route' => 'manage.about',
                            'label' => 'Tentang Kami',
                            'icon' =>
                                'M11.25 11.25l.041-.02a.75.75 0 11.518 1.4L11.25 13v1.25A1.25 1.25 0 0012.5 15.5h1.5a1.25 1.25 0 001.25-1.25V13a1.25 1.25 0 00-1.25-1.25h-.25M12 9h.008v.008H12V9zm9.54 3.125a9 9 0 11-18 0 9 9 0 0118 0z', // Identification / Information Circle
                        ],
                    ],
                    'Manajemen Konten' => [
                        [
                            'route' => 'manage.program',
                            'label' => 'Program',
                            'icon' =>
                                'M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z', // Grid / Modules
                        ],
                        [
                            'route' => 'manage.portfolio',
                            'label' => 'Portfolio',
                            'icon' =>
                                'M4 16l4.586-4.586a1 1 0 011.414 0L14 16m6-2l-3-3a1 1 0 00-1.414 0L14 14m4-14H4a2 2 0 00-2 2v16a2 2 0 002 2h16a2 2 0 002-2V2a2 2 0 00-2-2z', // Image / Briefcase
                        ],
                        [
                            'route' => 'manage.blog',
                            'label' => 'Artikel',
                            'icon' =>
                                'M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10l5 5v11a2 2 0 01-2 2zM12 11h4m-4 4h4m-6-4h.01M9 15h.01', // Document Text
                        ],
                    ],
                    'Acara & Edukasi' => [
                        [
                            'route' => 'manage.workshop',
                            'label' => 'Workshop',
                            'icon' =>
                                'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z', // Users / Presentation
                        ],
                        [
                            'route' => 'manage.agenda',
                            'label' => 'Agenda',
                            'icon' =>
                                'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z', // Calendar
                        ],
                        [
                            'route' => 'manage.enrollment',
                            'label' => 'Pendaftaran Kursus',
                            'icon' =>
                                'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253', // Academic Book
                        ],
                    ],
                    'E-Commerce & Bisnis' => [
                        [
                            'route' => 'manage.shop',
                            'label' => 'Toko',
                            'icon' => 'M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z', // Shopping Bag
                        ],
                        [
                            'route' => 'manage.order',
                            'label' => 'Pesanan',
                            'icon' =>
                                'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01', // Clipboard List / Order
                        ],
                        [
                            'route' => 'manage.partner',
                            'label' => 'Partner',
                            'icon' =>
                                'M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z', // Briefcase / Business Partnership
                        ],
                    ],
                    'Utilitas & Sistem' => [
                        [
                            'route' => 'manage.missing.link',
                            'label' => 'Missing Link',
                            'icon' =>
                                'M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1', // Link / Broken Link
                        ],
                    ],
                ];
            @endphp

            <!-- Loop Grouping Menu -->
            @foreach ($menuGroups as $groupLabel => $items)
                <div class="space-y-1">
                    <p class="px-3 mb-2 text-xs font-semibold text-slate-500 uppercase tracking-wider">
                        {{ $groupLabel }}</p>
                    @foreach ($items as $menu)
                        <x-nav-link :href="route($menu['route'])" :active="request()->routeIs($menu['route'])" wire:navigate>
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="{{ $menu['icon'] }}">
                                </path>
                            </svg>
                            {{ __($menu['label']) }}
                        </x-nav-link>
                    @endforeach
                </div>
            @endforeach

            <!-- System Settings (Static) -->
            <div class="pt-4 border-t border-slate-800 space-y-1">
                <p class="px-3 mb-2 text-xs font-semibold text-slate-500 uppercase tracking-wider">System</p>
                <x-nav-link :href="route('manage.settings')" :active="request()->routeIs('manage.settings')" wire:navigate>
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                        </path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    {{ __('Setting') }}
                </x-nav-link>
            </div>
        </nav>
    </aside>

    <!-- Header Section -->
    <header
        class="fixed top-0 right-0 left-0 z-40 flex items-center justify-between px-8 h-20 bg-white/80 backdrop-blur-md border-b border-slate-200 lg:ml-64 transition-all">
        <button @click="sidebarOpen = !sidebarOpen"
            class="p-2 rounded-lg text-slate-600 hover:bg-slate-100 focus:outline-none lg:hidden">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path x-show="!sidebarOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 6h16M4 12h16M4 18h16" />
                <path x-show="sidebarOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>

        <div class="hidden lg:block text-sm font-medium text-slate-500">
            {{ date('l, d F Y') }}
        </div>

        <!-- User Dropdown Menu -->
        <div class="flex items-center space-x-4">
            <x-dropdown align="right" width="48">
                <x-slot name="trigger">
                    <button
                        class="group flex items-center space-x-3 p-1.5 rounded-full hover:bg-slate-100 transition duration-200">
                        <div
                            class="w-8 h-8 rounded-full bg-indigo-500 flex items-center justify-center text-white text-xs font-bold shadow-sm">
                            {{ substr(auth()->user()->name, 0, 2) }}
                        </div>
                        <div class="hidden md:block text-left">
                            <p class="text-sm font-semibold text-slate-700 leading-none">{{ auth()->user()->name }}</p>
                            <p class="text-xs text-slate-400 mt-1">Admin</p>
                        </div>
                        <svg class="w-4 h-4 text-slate-400 group-hover:text-slate-600" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                </x-slot>

                <x-slot name="content">
                    <div class="px-4 py-2 border-b border-slate-100">
                        <p class="text-xs text-slate-400">Signed in as</p>
                        <p class="text-sm font-medium text-slate-900 truncate">{{ auth()->user()->email }}</p>
                    </div>
                    <x-dropdown-link :href="route('profile')" wire:navigate class="flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        {{ __('My Profile') }}
                    </x-dropdown-link>
                    <div class="border-t border-slate-100"></div>
                    <button wire:click="logout" class="w-full text-start">
                        <x-dropdown-link class="text-red-600">
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                    </path>
                                </svg>
                                {{ __('Log Out') }}
                            </div>
                        </x-dropdown-link>
                    </button>
                </x-slot>
            </x-dropdown>
        </div>
    </header>

    <!-- Overlay Background Mobile -->
    <div x-show="sidebarOpen" @click="sidebarOpen = false"
        class="fixed inset-0 z-40 bg-slate-900/60 backdrop-blur-sm lg:hidden" x-cloak
        x-transition:enter="transition opacity-0" x-transition:enter-end="opacity-100"
        x-transition:leave="transition opacity-100" x-transition:leave-end="opacity-0"></div>
</div>
