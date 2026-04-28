<?php

namespace App\Livewire;

use App\Models\InstitutionPartner as ModelsInstitutionPartner;
use Livewire\Component;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Request;

class InstitutionPartner extends Component
{
    public $nama_lengkap, $nama_institusi, $whatsapp, $email, $tujuan_surat, $penawaran;
    public $honeypot;

    protected function rules()
    {
        return [
            'nama_lengkap' => 'required|min:3',
            'nama_institusi' => 'required',
            'whatsapp'     => 'required|numeric',
            'email'        => 'required|email',
            'tujuan_surat' => 'required',
            'penawaran'    => 'required|min:20',
        ];
    }

    public function saveMitra()
    {
        // 1. Honeypot Check
        if (!empty($this->honeypot)) {
            return;
        }

        // 2. Laravel Native Rate Limiting
        // Membuat kunci unik berdasarkan IP pengunjung
        $throttleKey = 'submit-school-partner:' . Request::ip();

        // Batasi: Maksimal 2 kali (maxAttempts) dalam 3600 detik (1 jam)
        if (RateLimiter::tooManyAttempts($throttleKey, $maxAttempts = 2)) {
            $seconds = RateLimiter::availableIn($throttleKey);
            $minutes = ceil($seconds / 60);

            $this->dispatch('swal:modal', [
                'title' => 'Tunggu Sebentar!',
                'icon' => 'error',
                'text' => "Anda terlalu sering mengirim penawaran. Silakan coba lagi dalam {$minutes} menit."
            ]);
            return;
        }

        // 3. Validation
        $validated = $this->validate();

        // 4. Save to Database
        ModelsInstitutionPartner::create($validated);

        // 5. Hit Rate Limiter (Catat percobaan berhasil)
        RateLimiter::hit($throttleKey, 3600);

        $this->reset();

        $this->dispatch('swal:modal', [
            'title' => 'Terima Kasih!',
            'icon' => 'success',
            'text' => 'Penawaran Anda telah kami terima!'
        ]);
    }

    public function render()
    {
        return view('livewire.institution-partner');
    }
}
