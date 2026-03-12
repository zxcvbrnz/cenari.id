<?php

namespace App\Livewire;

use Livewire\Component;

use App\Models\Contact as ContactModel;
use Illuminate\Support\Facades\RateLimiter;
use Livewire\Attributes\Validate;

class Contact extends Component
{
    public function render()
    {
        return view('livewire.contact');
    }

    #[Validate('required|string|max:255')]
    public string $name = '';

    #[Validate('required|email|max:255')]
    public string $email = '';

    #[Validate('required|string')]
    public string $subject = '';

    #[Validate('required|min:10')]
    public string $message = '';

    public string $honeypot = '';
    public bool $success = false;

    // Data Kontak Statis (Mudah diubah dari sini)
    public array $info = [
        'wa_number' => '6289691884833',
        'wa_text'   => 'Halo Cenari, saya ingin bertanya mengenai...',
        'phone'     => '0511-12345678',
        'email_official' => 'cenari@gmail.com',
        'address'   => 'Jl. Cendana I No.38 RT.01 RW.01 Kayu Tangi Banjarmasin Kalimantan Selatan Indonesia'
    ];

    public function sendMessage()
    {
        // 1. Anti-Spam: Honeypot
        if (!empty($this->honeypot)) {
            return $this->reset();
        }

        // 2. Anti-Spam: Rate Limiter (2 pesan per 5 menit)
        $throttleKey = 'contact-attempt:' . request()->ip();
        if (RateLimiter::tooManyAttempts($throttleKey, 2)) {
            $this->addError('message', 'Terlalu banyak mencoba. Tunggu sejenak.');
            return;
        }

        // 3. Validasi & Simpan
        $validated = $this->validate();
        $validated['ip_address'] = request()->ip();

        ContactModel::create($validated);

        // 4. Hit Rate Limiter & Reset
        RateLimiter::hit($throttleKey, 300);
        $this->reset(['name', 'email', 'subject', 'message']);
        $this->success = true;
    }
}
