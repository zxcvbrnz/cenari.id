<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Collaboration;
use Illuminate\Support\Facades\Storage;

class ManageCollaboration extends Component
{
    use WithFileUploads;

    public $name, $image, $selectedId, $view = 'list';

    public function showForm($id = null)
    {
        $this->reset(['name', 'image', 'selectedId']);
        if ($id) {
            $collab = Collaboration::find($id);
            $this->selectedId = $collab->id;
            $this->name = $collab->name;
        }
        $this->view = 'form';
    }

    public function save()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'image' => $this->selectedId ? 'nullable|image|max:1024' : 'required|image|max:1024',
        ]);

        $data = ['name' => $this->name];

        if ($this->image) {
            // Hapus gambar lama jika sedang melakukan update untuk menghemat storage
            if ($this->selectedId) {
                $oldCollab = Collaboration::find($this->selectedId);
                if ($oldCollab && $oldCollab->image) {
                    Storage::disk('public')->delete($oldCollab->image);
                }
            }
            $data['image'] = $this->image->store('collaborations', 'public');
        }

        // Tentukan pesan berdasarkan aksi (Create atau Update)
        $message = $this->selectedId ? 'Data Kolaborasi Berhasil Diperbarui' : 'Data Kolaborasi Berhasil Ditambahkan';

        Collaboration::updateOrCreate(['id' => $this->selectedId], $data);

        $this->reset(['name', 'image', 'selectedId']);
        $this->view = 'list';

        // Pengiriman event ke browser
        $this->dispatch('swal:modal', [
            'title' => 'Data Diperbarui!',
            'icon'  => 'success',
            'text'  => $message
        ]);
    }

    public function delete($id)
    {
        $collab = Collaboration::find($id);
        if ($collab) {
            Storage::disk('public')->delete($collab->image);
            $collab->delete();

            $this->dispatch('swal:modal', [
                'title' => 'Terhapus!',
                'icon'  => 'success',
                'text'  => 'Partner berhasil dihapus dari daftar.'
            ]);
        }
    }

    public function render()
    {
        return view('livewire.admin.manage-collaboration', [
            'partners' => Collaboration::orderBy('sort_order')->get()
        ]);
    }
}
