<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cenari Education Center - Konvergensi Teknologi 2026</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="shortcut icon" href="{{ asset('logoCenari2020 PATEN.png') }}" type="image/x-icon">
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

<body class="font-body bg-[#F8FAFC] text-[#0F172A] scroll-smooth">
    <livewire:components.navbar />

    {{ $slot }}

    <livewire:footer />
    <div class="fixed bottom-8 right-8 z-[100]">

        {{-- floating button whatsapp dengan link langsung ke wa dan langsung memuat text --}}
        <a href="https://wa.me/6285103326061?text=Halo,%20saya%20ingin%20informasi%20lebih%20lanjut%20tentang%20cenari%20id."
            target="_blank"
            class="w-16 h-16 bg-[#25D366] rounded-full shadow-2xl flex items-center justify-center text-white hover:scale-110 transition group">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="currentColor" viewBox="0 0 256 256">
                <path
                    d="M187.58,144.84l-32-16a8,8,0,0,0-8,.5l-14.69,9.8a40.55,40.55,0,0,1-16-16l9.8-14.69a8,8,0,0,0,.5-8l-16-32A8,8,0,0,0,104,64a40,40,0,0,0-40,40,88.1,88.1,0,0,0,88,88,40,40,0,0,0,40-40A8,8,0,0,0,187.58,144.84ZM152,176a72.08,72.08,0,0,1-72-72A24,24,0,0,1,99.29,80.46l11.48,23L101,118a8,8,0,0,0-.73,7.51,56.47,56.47,0,0,0,30.15,30.15A8,8,0,0,0,138,155l14.61-9.74,23,11.48A24,24,0,0,1,152,176ZM128,24A104,104,0,0,0,36.18,176.88L24.83,210.93a16,16,0,0,0,20.24,20.24l34.05-11.35A104,104,0,1,0,128,24Zm0,192a87.87,87.87,0,0,1-44.06-11.81,8,8,0,0,0-6.54-.67L40,216,52.47,178.6a8,8,0,0,0-.66-6.54A88,88,0,1,1,128,216Z">
                </path>
            </svg>
            <span
                class="absolute right-20 bg-white text-[#0F172A] px-4 py-2 rounded-xl text-sm font-bold shadow-xl opacity-0 group-hover:opacity-100 transition whitespace-nowrap">Chat
                WhatsApp</span>
        </a>
        {{-- <button
            class="w-16 h-16 bg-[#3B82F6] rounded-full shadow-2xl flex items-center justify-center text-white hover:scale-110 transition group">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z">
                </path>
            </svg>
            <span
                class="absolute right-20 bg-white text-[#0F172A] px-4 py-2 rounded-xl text-sm font-bold shadow-xl opacity-0 group-hover:opacity-100 transition whitespace-nowrap">Cenari
                Bot</span>
        </button> --}}
    </div>

    @livewireScripts
</body>

</html>
