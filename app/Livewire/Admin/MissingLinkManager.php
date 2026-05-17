<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\MissingLink;
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
    public $url;

    protected $rules = [
        'text' => 'required|string|max:255',
        'cta' => 'required|string|max:255',
        'url' => 'required|url|max:255',
    ];

    // Fungsi untuk reset form input
    public function resetForm()
    {
        $this->missingLinkId = null;
        $this->text = '';
        $this->cta = '';
        $this->url = '';
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
        $this->url = $missingLink->url;

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
                'url' => $this->url,
            ]);
            $message = 'Data berhasil ditambahkan!';
        } else {
            $missingLink = MissingLink::findOrFail($this->missingLinkId);
            $missingLink->update([
                'text' => $this->text,
                'cta' => $this->cta,
                'url' => $this->url,
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
        return view('livewire.admin.missing-link-manager', [
            'missingLinks' => MissingLink::latest()->paginate(10)
        ]);
    }
}