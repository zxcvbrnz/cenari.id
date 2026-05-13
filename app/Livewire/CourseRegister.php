<?php

namespace App\Livewire;

use App\Models\CoursePackage;
use App\Models\CoursePackageUser;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\On;

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
        $this->dispatch('swal:modal', ['title' => 'Berhasil!', 'icon' => 'success', 'text' => 'Anda sudah terdaftar di kelas ini.']);

        return redirect()->route('home'); // Sesuaikan dengan route dashboard Anda
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
