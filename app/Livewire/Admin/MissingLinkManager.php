<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\MissingLink;
use App\Models\Program;
use Livewire\WithPagination;

class MissingLinkManager extends Component
{
    use WithPagination;

    // State untuk mengatur tampilan (index, create, edit)
    public $viewState = 'index';

    // Form Properties
    public $missingLinkId;
    public $text;
    public $cta;
    public $program_id; // Menggantikan $url

    protected $rules = [
        'text' => 'required|string|max:255',
        'cta' => 'required|string|max:255',
        'program_id' => 'required|exists:programs,id', // Validasi relasi ke tabel programs
    ];

    // Mengubah pesan validasi kustom (Opsional, agar user-friendly)
    protected $messages = [
        'program_id.required' => 'Kolom program tujuan wajib dipilih.',
        'program_id.exists' => 'Program yang dipilih tidak valid.',
    ];

    // Fungsi untuk reset form input
    public function resetForm()
    {
        $this->missingLinkId = null;
        $this->text = '';
        $this->cta = '';
        $this->program_id = ''; // Di-reset ke string kosong agar placeholder select aktif
        $this->resetErrorBag();
    }

    // Aksi Switch Halaman ke Form Tambah
    public function showCreateForm()
    {
        $this->resetForm();
        $this->viewState = 'create';
    }

    // Aksi Switch Halaman ke Form Edit
    public function showEditForm($id)
    {
        $this->resetForm();
        $missingLink = MissingLink::findOrFail($id);

        $this->missingLinkId = $missingLink->id;
        $this->text = $missingLink->text;
        $this->cta = $missingLink->cta;
        $this->program_id = $missingLink->program_id; // Mengambil data foreign id lama

        $this->viewState = 'edit';
    }

    // Kembali ke Halaman Utama (Tabel)
    public function showIndex()
    {
        $this->viewState = 'index';
    }

    // Simpan Data Baru atau Update Data
    public function save()
    {
        $this->validate();

        if ($this->viewState === 'create') {
            MissingLink::create([
                'text' => $this->text,
                'cta' => $this->cta,
                'program_id' => $this->program_id,
            ]);
            $message = 'Data berhasil ditambahkan!';
        } else {
            $missingLink = MissingLink::findOrFail($this->missingLinkId);
            $missingLink->update([
                'text' => $this->text,
                'cta' => $this->cta,
                'program_id' => $this->program_id,
            ]);
            $message = 'Data berhasil diperbarui!';
        }

        // Picu sweetalert global yang Anda punya di app.js
        $this->dispatch('swal:modal', [
            'title' => 'Berhasil!',
            'text' => $message,
            'icon' => 'success'
        ]);

        $this->showIndex();
    }

    // Hapus Data
    public function delete($id)
    {
        MissingLink::findOrFail($id)->delete();

        $this->dispatch('swal:modal', [
            'title' => 'Terhapus!',
            'text' => 'Data berhasil dihapus.',
            'icon' => 'success'
        ]);
    }

    public function render()
    {
        // $programs dikirim ke view agar select-option bisa melakukan loop data
        return view('livewire.admin.missing-link-manager', [
            'missingLinks' => MissingLink::with('program')->latest()->paginate(10),
            'programs' => Program::orderBy('title', 'asc')->get()
        ]);
    }
}