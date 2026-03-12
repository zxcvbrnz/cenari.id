<?php

use Illuminate\Support\Facades\Password;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new class extends Component {
    public string $email = '';

    public $honeypot = ''; // Properti jebakan

    public function sendPasswordResetLink(): void
    {
        // 1. Proteksi Honeypot (Jebakan Bot)
        if (!empty($this->honeypot)) {
            return; // Bot akan terjebak di sini
        }

        // 2. Validasi format email
        $this->validate([
            'email' => ['required', 'string', 'email'],
        ]);

        // 3. Proteksi IP Throttling (Maksimal 3 permintaan per jam)
        $throttleKey = 'password-reset-attempt:' . request()->ip();

        if (RateLimiter::tooManyAttempts($throttleKey, 3)) {
            $seconds = RateLimiter::availableIn($throttleKey);
            $minutes = ceil($seconds / 60);

            $this->addError('email', "Terlalu banyak permintaan reset password. Silakan coba lagi dalam $minutes menit.");
            return;
        }

        // 4. Proses Pengiriman Link
        $status = Password::sendResetLink($this->only('email'));

        if ($status != Password::RESET_LINK_SENT) {
            $this->addError('email', __($status));
            return;
        }

        // 5. Catat percobaan yang berhasil (Hit)
        RateLimiter::hit($throttleKey, 3600);

        $this->reset('email');

        session()->flash('status', __($status));
    }
}; ?>

<div class="min-h-screen bg-[#FDFDFD] flex items-center justify-center p-6">
    <div class="max-w-md w-full">
        <div class="text-center mb-10">
            <a href="/" wire:navigate class="inline-block">
                <h1 class="text-4xl font-black text-slate-900 tracking-tighter italic">CENARI<span
                        class="text-blue-600">ID</span></h1>
            </a>
            <div class="mt-6 p-6 bg-blue-50/50 rounded-[2rem] border border-blue-100/50">
                <p class="text-slate-500 text-xs font-bold leading-relaxed">
                    {{ __('Lupa password? Jangan khawatir. Masukkan alamat email Anda dan kami akan mengirimkan link reset password untuk membuat yang baru.') }}
                </p>
            </div>
        </div>

        <x-auth-session-status class="mb-6" :status="session('status')" />

        <div class="bg-white p-8 md:p-10 rounded-[3rem] border border-slate-100 shadow-2xl shadow-slate-200/50">
            <form wire:submit="sendPasswordResetLink" class="space-y-6">
                <div class="hidden" aria-hidden="true">
                    <input type="text" wire:model="honeypot" tabindex="-1" autocomplete="off">
                </div>
                <div>
                    <label for="email"
                        class="block text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 mb-2 ml-1">Alamat
                        Email Terdaftar</label>
                    <input wire:model="email" id="email"
                        class="block w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-blue-500 text-sm font-bold text-slate-700 placeholder:text-slate-300 transition-all"
                        type="email" name="email" required autofocus placeholder="nama@email.com" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 ml-1" />
                </div>

                <div class="pt-2">
                    <button type="submit" wire:loading.attr="disabled"
                        class="group relative w-full bg-blue-600 text-white py-5 rounded-2xl font-black uppercase tracking-[0.2em] text-[11px] hover:bg-slate-900 transition-all shadow-xl shadow-blue-500/20 active:scale-[0.98] disabled:opacity-70 disabled:cursor-not-allowed">

                        <span wire:loading.remove wire:target="sendPasswordResetLink">
                            Kirim Link Reset
                        </span>

                        <span wire:loading wire:target="sendPasswordResetLink"
                            class="flex items-center justify-center gap-2">
                            <svg class="inline-flex animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                </path>
                            </svg>
                            Mengirim...
                        </span>
                    </button>
                </div>
            </form>
        </div>

        <p class="text-center mt-8">
            <a href="{{ route('login') }}" wire:navigate
                class="text-slate-400 font-black uppercase tracking-widest text-[11px] hover:text-blue-600 transition-colors flex items-center justify-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path d="M15 19l-7-7 7-7" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                Kembali ke Login
            </a>
        </p>
    </div>
</div>
