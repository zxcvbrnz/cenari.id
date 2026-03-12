<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;
use Illuminate\Support\Facades\RateLimiter;

new class extends Component {
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        // 1. Validasi input dasar
        $this->validate();

        // 2. Terapkan Rate Limiting
        $throttleKey = 'login-attempt:' . request()->ip();

        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            $seconds = RateLimiter::availableIn($throttleKey);
            $this->addError('form.email', "Terlalu banyak percobaan masuk. Silakan coba lagi dalam $seconds detik.");
            return;
        }

        try {
            $this->form->authenticate();

            // --- CEK ROLE DISINI ---
            // Kita ambil user yang baru saja diautentikasi
            $user = auth()->user();

            // Jika sukses autentikasi, bersihkan limiter
            RateLimiter::clear($throttleKey);
            Session::regenerate();

            // Logika Pengalihan Berdasarkan Role
            // Asumsi: kolom di database adalah 'role' dengan nilai 'admin'
            if ($user->role === 'admin') {
                $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
            } else {
                // Jika bukan admin, arahkan ke home ("/")
                $this->redirect('/', navigate: true);
            }
            // -----------------------
        } catch (\Illuminate\Validation\ValidationException $e) {
            RateLimiter::hit($throttleKey, 60);
            throw $e;
        }
    }
}; ?>

<div class="min-h-screen bg-[#FDFDFD] flex items-center justify-center p-6">
    <div class="max-w-md w-full">
        <div class="text-center mb-10">
            <a href="/" wire:navigate class="inline-block">
                <h1 class="text-4xl font-black text-slate-900 tracking-tighter italic">CENARI<span
                        class="text-blue-600">ID</span></h1>
            </a>
            <p class="text-slate-400 text-sm mt-2 font-medium">Selamat datang kembali, silakan masuk ke akun Anda.</p>
        </div>

        <x-auth-session-status class="mb-6" :status="session('status')" />

        <div class="bg-white p-8 md:p-10 rounded-[3rem] border border-slate-100 shadow-2xl shadow-slate-200/50">
            <form wire:submit="login" class="space-y-6">

                <div>
                    <label for="email"
                        class="block text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 mb-2 ml-1">Alamat
                        Email</label>
                    <input wire:model="form.email" id="email"
                        class="block w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-blue-500 text-sm font-bold text-slate-700 placeholder:text-slate-300 transition-all"
                        type="email" name="email" required autofocus placeholder="nama@email.com" />
                    <x-input-error :messages="$errors->get('form.email')" class="mt-2 ml-1" />
                </div>

                <div>
                    <div class="flex justify-between items-center mb-2 ml-1">
                        <label for="password"
                            class="block text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">Password</label>
                        @if (Route::has('password.request'))
                            <a class="text-[10px] font-black uppercase tracking-widest text-blue-600 hover:text-slate-900 transition-colors"
                                href="{{ route('password.request') }}" wire:navigate>
                                Lupa?
                            </a>
                        @endif
                    </div>
                    <input wire:model="form.password" id="password"
                        class="block w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-blue-500 text-sm font-bold text-slate-700 placeholder:text-slate-300 transition-all"
                        type="password" name="password" required placeholder="••••••••" />
                    <x-input-error :messages="$errors->get('form.password')" class="mt-2 ml-1" />
                </div>

                <div class="flex items-center justify-between">
                    <label for="remember" class="inline-flex items-center cursor-pointer group">
                        <div class="relative">
                            <input wire:model="form.remember" id="remember" type="checkbox" class="sr-only">
                            <div
                                class="w-10 h-6 bg-slate-200 rounded-full shadow-inner transition-colors group-has-[:checked]:bg-blue-600">
                            </div>
                            <div
                                class="absolute left-1 top-1 bg-white w-4 h-4 rounded-full shadow transition-transform group-has-[:checked]:translate-x-4">
                            </div>
                        </div>
                        <span
                            class="ms-3 text-[11px] font-black uppercase tracking-widest text-slate-400 group-hover:text-slate-600 transition-colors">Ingat
                            Saya</span>
                    </label>
                </div>

                <div class="pt-2">
                    <button type="submit" wire:loading.attr="disabled"
                        class="group relative w-full bg-blue-600 text-white py-5 rounded-2xl font-black uppercase tracking-[0.2em] text-[11px] hover:bg-slate-900 transition-all shadow-xl shadow-blue-500/20 active:scale-[0.98] disabled:opacity-70 disabled:cursor-not-allowed">

                        <span wire:loading.remove wire:target="login">
                            Masuk Sekarang
                        </span>

                        <span wire:loading wire:target="login" class="flex items-center justify-center gap-2">
                            <svg class="inline-flex animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                </path>
                            </svg>
                            Menyambungkan...
                        </span>
                    </button>
                </div>
            </form>
        </div>

        <p class="text-center mt-8 text-sm font-medium text-slate-400">
            Belum punya akun?
            <a href="{{ route('register') }}" wire:navigate
                class="text-blue-600 font-black uppercase tracking-widest text-[11px] hover:underline ml-1">Daftar</a>
        </p>
    </div>
</div>
