<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;
use Illuminate\Support\Facades\RateLimiter;

new class extends Component {
    public string $name = '';
    public string $nik = '';
    public string $gender = '';
    public string $born_place = '';
    public string $born_date = '';
    public string $address = '';
    public string $whatsapp = '';
    public string $email = '';
    public string $last_education = '';
    public string $current_status = '';
    public string $password = '';
    public string $password_confirmation = '';

    public $honeypot = '';

    public function register(): void
    {
        if (!empty($this->honeypot)) {
            return;
        }

        $throttleKey = 'register-attempt:' . request()->ip();
        if (RateLimiter::tooManyAttempts($throttleKey, 3)) {
            $seconds = RateLimiter::availableIn($throttleKey);
            $this->addError('email', 'Terlalu banyak mencoba. Coba lagi dalam ' . ceil($seconds / 60) . ' menit.');
            return;
        }

        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'nik' => ['required', 'string', 'max:16', 'unique:users,nik'],
            'gender' => ['required', 'in:Laki-laki,Perempuan'],
            'born_place' => ['required', 'string', 'max:255'],
            'born_date' => ['required', 'date'],
            'address' => ['required', 'string'],
            'whatsapp' => ['required', 'string', 'max:20'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
            'last_education' => ['required', 'string'],
            'current_status' => ['required', 'string'],
            'password' => ['required', 'string', 'confirmed', \Illuminate\Validation\Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $validated['role'] = 'user';

        RateLimiter::hit($throttleKey, 3600);

        event(new Registered(($user = User::create($validated))));

        Auth::login($user);

        $this->redirect('/course-packages', navigate: true);
    }
}; ?>

<div class="min-h-screen bg-[#FDFDFD] flex items-center justify-center p-6 py-12">
    <div class="max-w-4xl w-full">
        <div class="text-center mb-10">
            <a href="/" wire:navigate class="inline-block">
                <h1 class="text-4xl font-black text-slate-900 tracking-tighter italic">CENARI<span
                        class="text-blue-600">ID</span></h1>
            </a>
            <p class="text-slate-400 text-sm mt-2 font-medium">Lengkapi data diri untuk mendaftarkan akun siswa.</p>
        </div>

        <div class="bg-white p-8 md:p-12 rounded-[3rem] border border-slate-100 shadow-2xl shadow-slate-200/50">
            <form wire:submit="register" class="space-y-6">
                <div class="hidden" aria-hidden="true">
                    <input type="text" wire:model="honeypot" tabindex="-1" autocomplete="off">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div class="space-y-5">
                        <h2
                            class="text-[11px] font-black uppercase tracking-[0.3em] text-blue-600 border-b border-slate-50 pb-2">
                            Informasi Pribadi</h2>

                        <div>
                            <label
                                class="block text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 mb-2 ml-1">Nama
                                Lengkap</label>
                            <input wire:model="name"
                                class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-blue-500 text-sm font-bold text-slate-700"
                                type="text" placeholder="John Doe" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div>
                            <label
                                class="block text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 mb-2 ml-1">NIK
                                (KTP/KK)</label>
                            <input wire:model="nik"
                                class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-blue-500 text-sm font-bold text-slate-700"
                                type="text" placeholder="6371..." />
                            <x-input-error :messages="$errors->get('nik')" class="mt-2" />
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label
                                    class="block text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 mb-2 ml-1">Jenis
                                    Kelamin</label>
                                <select wire:model="gender"
                                    class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-blue-500 text-sm font-bold text-slate-700">
                                    <option value="">Pilih</option>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                            <div>
                                <label
                                    class="block text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 mb-2 ml-1">Tgl
                                    Lahir</label>
                                <input wire:model="born_date"
                                    class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-blue-500 text-sm font-bold text-slate-700"
                                    type="date" />
                            </div>
                        </div>

                        <div>
                            <label
                                class="block text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 mb-2 ml-1">Tempat
                                Lahir</label>
                            <input wire:model="born_place"
                                class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-blue-500 text-sm font-bold text-slate-700"
                                type="text" placeholder="Banjarmasin" />
                        </div>

                        <div>
                            <label
                                class="block text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 mb-2 ml-1">WhatsApp</label>
                            <input wire:model="whatsapp"
                                class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-blue-500 text-sm font-bold text-slate-700"
                                type="text" placeholder="0812..." />
                        </div>
                    </div>

                    <div class="space-y-5">
                        <h2
                            class="text-[11px] font-black uppercase tracking-[0.3em] text-blue-600 border-b border-slate-50 pb-2">
                            Pendidikan & Akun</h2>

                        <div>
                            <label
                                class="block text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 mb-2 ml-1">Alamat
                                Domisili</label>
                            <input wire:model="address"
                                class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-blue-500 text-sm font-bold text-slate-700"
                                type="text" placeholder="Jl. Ahmad Yani..." />
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label
                                    class="block text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 mb-2 ml-1">Pend.
                                    Terakhir</label>
                                <input wire:model="last_education"
                                    class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-blue-500 text-sm font-bold text-slate-700"
                                    type="text" placeholder="SMA/D3/S1" />
                            </div>
                            <div>
                                <label
                                    class="block text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 mb-2 ml-1">Status
                                    Sekarang</label>
                                <input wire:model="current_status"
                                    class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-blue-500 text-sm font-bold text-slate-700"
                                    type="text" placeholder="Pelajar/Bekerja" />
                            </div>
                        </div>

                        <div>
                            <label
                                class="block text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 mb-2 ml-1">Email</label>
                            <input wire:model="email"
                                class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-blue-500 text-sm font-bold text-slate-700"
                                type="email" placeholder="nama@email.com" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label
                                    class="block text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 mb-2 ml-1">Password</label>
                                <input wire:model="password"
                                    class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-blue-500 text-sm font-bold text-slate-700"
                                    type="password" placeholder="••••" />
                            </div>
                            <div>
                                <label
                                    class="block text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 mb-2 ml-1">Konfirmasi</label>
                                <input wire:model="password_confirmation"
                                    class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-blue-500 text-sm font-bold text-slate-700"
                                    type="password" placeholder="••••" />
                            </div>
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-1" />
                    </div>
                </div>

                <div class="pt-6">
                    <button type="submit" wire:loading.attr="disabled"
                        class="w-full bg-blue-600 text-white py-5 rounded-2xl font-black uppercase tracking-[0.2em] text-[11px] hover:bg-slate-900 transition-all shadow-xl shadow-blue-500/20 active:scale-[0.98]">
                        <span wire:loading.remove>Selesaikan Pendaftaran</span>
                        <span wire:loading>Memproses...</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
