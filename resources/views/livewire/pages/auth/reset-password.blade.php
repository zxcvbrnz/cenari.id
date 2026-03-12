<?php

use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use Livewire\Volt\Component;
use Illuminate\Support\Facades\RateLimiter;

new class extends Component {
    #[Locked]
    public string $token = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Mount the component.
     */
    public function mount(string $token): void
    {
        $this->token = $token;

        $this->email = request()->string('email');
    }

    /**
     * Reset the password for the given user.
     */
    public $honeypot = ''; // Properti jebakan

    public function resetPassword(): void
    {
        // 1. Proteksi Honeypot (Jebakan Bot)
        if (!empty($this->honeypot)) {
            return;
        }

        // 2. Proteksi IP Throttling (Maksimal 5 percobaan per jam)
        $throttleKey = 'password-update-attempt:' . request()->ip();

        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            $seconds = RateLimiter::availableIn($throttleKey);
            $minutes = ceil($seconds / 60);

            $this->addError('password', "Terlalu banyak percobaan reset. Silakan coba lagi dalam $minutes menit.");
            return;
        }

        // 3. Validasi Data
        $this->validate([
            'token' => ['required'],
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string', 'confirmed', \Illuminate\Validation\Rules\Password::defaults()],
        ]);

        // 4. Eksekusi Reset Password
        $status = Password::reset($this->only('email', 'password', 'password_confirmation', 'token'), function ($user) {
            $user
                ->forceFill([
                    'password' => Hash::make($this->password),
                    'remember_token' => Str::random(60),
                ])
                ->save();

            event(new PasswordReset($user));
        });

        // 5. Handling Response
        if ($status != Password::PASSWORD_RESET) {
            // Jika gagal (token expired atau salah), catat satu percobaan
            RateLimiter::hit($throttleKey, 3600);

            $this->addError('email', __($status));
            return;
        }

        // Jika sukses, hapus batasan IP
        RateLimiter::clear($throttleKey);

        Session::flash('status', __($status));

        $this->redirectRoute('login', navigate: true);
    }
}; ?>
<div class="min-h-screen bg-[#FDFDFD] flex items-center justify-center p-6 py-12">
    <div class="max-w-md w-full">
        <div class="text-center mb-10">
            <a href="/" wire:navigate class="inline-block">
                <h1 class="text-4xl font-black text-slate-900 tracking-tighter italic">CENARI<span
                        class="text-blue-600">STORE</span></h1>
            </a>
            <p class="text-slate-400 text-sm mt-2 font-medium">Buat password baru yang aman untuk akun Anda.</p>
        </div>

        <div class="bg-white p-8 md:p-10 rounded-[3rem] border border-slate-100 shadow-2xl shadow-slate-200/50">
            <form wire:submit="resetPassword" class="space-y-5">

                <div class="hidden" aria-hidden="true">
                    <input type="text" wire:model="honeypot" tabindex="-1" autocomplete="off">
                </div>

                <div>
                    <label for="email"
                        class="block text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 mb-2 ml-1">Konfirmasi
                        Email</label>
                    <input wire:model="email" id="email"
                        class="block w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-blue-500 text-sm font-bold text-slate-700 placeholder:text-slate-300 transition-all opacity-70"
                        type="email" name="email" required readonly autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 ml-1" />
                </div>

                <div>
                    <label for="password"
                        class="block text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 mb-2 ml-1">Password
                        Baru</label>
                    <input wire:model="password" id="password"
                        class="block w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-blue-500 text-sm font-bold text-slate-700 placeholder:text-slate-300 transition-all"
                        type="password" name="password" required autocomplete="new-password" placeholder="••••••••" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2 ml-1" />
                </div>

                <div>
                    <label for="password_confirmation"
                        class="block text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 mb-2 ml-1">Konfirmasi
                        Password Baru</label>
                    <input wire:model="password_confirmation" id="password_confirmation"
                        class="block w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-blue-500 text-sm font-bold text-slate-700 placeholder:text-slate-300 transition-all"
                        type="password" name="password_confirmation" required autocomplete="new-password"
                        placeholder="••••••••" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 ml-1" />
                </div>

                <div class="pt-4">
                    <button type="submit" wire:loading.attr="disabled"
                        class="group relative w-full bg-blue-600 text-white py-5 rounded-2xl font-black uppercase tracking-[0.2em] text-[11px] hover:bg-slate-900 transition-all shadow-xl shadow-blue-500/20 active:scale-[0.98] disabled:opacity-70 disabled:cursor-not-allowed">

                        <span wire:loading.remove wire:target="resetPassword">
                            Simpan Password Baru
                        </span>

                        <span wire:loading wire:target="resetPassword" class="flex items-center justify-center gap-2">
                            <svg class="inline-flex animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                </path>
                            </svg>
                            Memproses...
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
