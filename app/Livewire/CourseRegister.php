<?php

namespace App\Livewire;

use App\Models\CoursePackage;
use App\Models\CoursePackageUser;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\On;
use Silvanix\Wablas\Message;


class CourseRegister extends Component
{
    public $package;
    public $learning_methode = 'Offline'; // Default value

    public function mount($slug, $course_slug)
    {
        // Mencari package berdasarkan slug
        $this->package = CoursePackage::where('slug', $course_slug)->firstOrFail();
    }

    public function register($userInput = null)
    {
        $confirmationWord = "DAFTAR";

        if (!$userInput) {
            // Kirim event ke browser
            $this->dispatch('swal:confirm-registration', [
                'word' => $confirmationWord
            ]);
            return;
        }
        if (strtoupper($userInput) !== $confirmationWord) {
            $this->dispatch('swal:modal', [
                'icon' => 'error',
                'title' => 'Gagal!',
                'text' => 'Kata kunci konfirmasi salah.'
            ]);
            return;
        }

        // Pastikan user sudah login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Cek apakah sudah pernah mendaftar di paket yang sama (mencegah double)
        $exists = CoursePackageUser::where('user_id', Auth::id())
            ->where('course_package_id', $this->package->id)
            ->exists();

        if ($exists) {

            session()->flash('error', 'Anda sudah terdaftar di kelas ini.');
            $this->dispatch('swal:modal', ['title' => 'Gagal!', 'icon' => 'error', 'text' => 'Anda sudah terdaftar di kelas ini.']);
            return;
        }

        CoursePackageUser::create([
            'user_id' => Auth::id(),
            'course_package_id' => $this->package->id,
            'learning_methode' => $this->learning_methode,
            'payment_status' => 'Pending',
            'status' => 'Diproses',
            // username & password dibiarkan null sesuai instruksi
        ]);
        $this->dispatch('swal:modal-redirect', [
            'title' => 'Berhasil!',
            'icon' => 'success',
            'text' => 'Anda sudah terdaftar di kelas ini.',
            'redirectUrl' => route('course.packages.user.list')
        ]);

        $send = new Message();

        $queue = [
            [
                'phone' => Auth::user()->whatsapp,
                'message' => "Halo *" . Auth::user()->name . "*\n" .
                    "Anda sudah melakukan pendaftaran untuk\n" .
                    "```\n" .
                    "Kursus        : " . $this->package->name . "\n" .
                    "Biaya         : " . 'Rp ' . number_format($this->package->price, 0, ',', '.') . "\n" .
                    "```\n" .
                    "Mohon tunggu kofirmasi dari kami untuk selanjutnya.\n" .
                    "*Cenari ID*\n" .
                    "www.cenari.id",
            ],
            [
                'phone' => '089691884833', // Nomor admin
                'message' => "Halo *Admin*\n" .
                    "Terdapat pendaftaran kursus dari web Cenari ID\n" .
                    "```\n" .
                    "Nama      : " . Auth::user()->name . "\n" .
                    "Kursus    : " . $this->package->name . "\n" .
                    "Biaya     : " . 'Rp ' . number_format($this->package->price, 0, ',', '.') . "\n" .
                    "Whatsapp  : " . Auth::user()->whatsapp . "\n" .
                    "```\n" .
                    "```\n" .
                    "www.cenari.id",
            ],
            [
                'phone' => '085103326061', // Nomor admin
                'message' => "Halo *Admin*\n" .
                    "Terdapat pendaftaran kursus dari web Cenari ID\n" .
                    "```\n" .
                    "Nama      : " . Auth::user()->name . "\n" .
                    "Kursus    : " . $this->package->name . "\n" .
                    "Biaya     : " . 'Rp ' . number_format($this->package->price, 0, ',', '.') . "\n" .
                    "Whatsapp  : " . Auth::user()->whatsapp . "\n" .
                    "```\n" .
                    "```\n" .
                    "www.cenari.id",
            ],
        ];

        foreach ($queue as $index => $item) {
            $send->multiple_text([$item]);

            // Beri jeda 5-9 detik kecuali setelah pesan terakhir
            if ($index < count($queue) - 1) {
                sleep(rand(10, 20));
            }
        }

        // return redirect()->route('course.packages.user.list');
    }

    public function render()
    {
        return view('livewire.course-register');
    }


    #[On('confirmed-registration')]
    public function confirmedRegistration($value)
    {
        $this->register($value);
    }
}