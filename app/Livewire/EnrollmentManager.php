<?php

namespace App\Livewire;

use App\Models\CoursePackageUser;
use Livewire\Component;
use Livewire\WithPagination;

class EnrollmentManager extends Component
{
    use WithPagination;

    // State Management
    public $isEdit = false;
    public $selectedId;

    // Form Fields
    public $username, $password, $learning_methode, $payment_status, $status;

    public function render()
    {
        return view('livewire.enrollment-manager', [
            'enrollments' => CoursePackageUser::with('coursePackage', 'user')
                ->latest()
                ->paginate(10)
        ]);
    }

    public function edit($id)
    {
        $this->isEdit = true;
        $this->selectedId = $id;

        $enrollment = CoursePackageUser::findOrFail($id);
        $this->username = $enrollment->username;
        $this->password = $enrollment->password;
        $this->learning_methode = $enrollment->learning_methode;
        $this->payment_status = $enrollment->payment_status;
        $this->status = $enrollment->status;
    }

    public function update()
    {
        $this->validate([
            'learning_methode' => 'required',
            'payment_status' => 'required',
            'status' => 'required',
        ]);

        $enrollment = CoursePackageUser::findOrFail($this->selectedId);
        $enrollment->update([
            'username' => $this->username,
            'password' => $this->password,
            'learning_methode' => $this->learning_methode,
            'payment_status' => $this->payment_status,
            'status' => $this->status,
        ]);

        $this->cancel();
        $this->dispatch('swal:modal', [
            'title' => 'Berhasil!',
            'icon' => 'success',
            'text' => 'Data pendaftaran telah diperbarui.'
        ]);
    }

    public function cancel()
    {
        $this->isEdit = false;
        $this->reset(['username', 'password', 'learning_methode', 'payment_status', 'status', 'selectedId']);
    }
}