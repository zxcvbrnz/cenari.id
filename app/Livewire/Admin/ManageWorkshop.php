<?php

namespace App\Livewire\Admin;

use App\Models\Workshop;
use Livewire\{Component, WithFileUploads};
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ManageWorkshop extends Component
{
    use WithFileUploads;

    public $view = 'list', $selectedId;
    public $title, $date_string, $time_string, $type, $status, $price, $color = '#3B82F6', $image, $old_image;

    public function render()
    {
        return view('livewire.admin.manage-workshop', [
            'workshops' => Workshop::latest()->get()
        ]);
    }

    public function showForm($id = null)
    {
        $this->reset(['selectedId', 'title', 'date_string', 'time_string', 'type', 'status', 'price', 'color', 'image', 'old_image']);

        if ($id) {
            $w = Workshop::findOrFail($id);
            $this->selectedId = $w->id;
            $this->title = $w->title;
            $this->date_string = $w->date_string;
            $this->time_string = $w->time_string;
            $this->type = $w->type;
            $this->status = $w->status;
            $this->price = $w->price;
            $this->color = $w->color;
            $this->old_image = $w->image;
        }
        $this->view = 'form';
    }

    public function save()
    {
        $this->validate([
            'title' => 'required',
            'type' => 'required',
            'status' => 'required',
        ]);

        $data = [
            'title' => $this->title,
            'slug' => Str::slug($this->title),
            'date_string' => $this->date_string,
            'time_string' => $this->time_string,
            'type' => $this->type,
            'status' => $this->status,
            'price' => $this->price,
            'color' => $this->color,
        ];

        if ($this->image) {
            // Hapus gambar lama jika ada upload gambar baru
            if ($this->old_image) {
                Storage::disk('public')->delete($this->old_image);
            }
            $data['image'] = $this->image->store('workshops', 'public');
        }

        Workshop::updateOrCreate(['id' => $this->selectedId], $data);

        $this->dispatch('swal:modal', [
            'title' => 'Workshop Berhasil Disimpan',
            'icon' => 'success',
            'text' => 'Data workshop "' . $this->title . '" telah berhasil diperbarui.'
        ]);

        $this->view = 'list';
    }

    public function deleteWorkshop($id)
    {
        $workshop = Workshop::find($id);

        if ($workshop) {
            $workshopTitle = $workshop->title;

            // Hapus file gambar dari storage
            if ($workshop->image) {
                Storage::disk('public')->delete($workshop->image);
            }

            $workshop->delete();

            $this->dispatch('swal:modal', [
                'title' => 'Workshop Dihapus',
                'icon' => 'warning',
                'text' => 'Workshop "' . $workshopTitle . '" telah dihapus permanen.'
            ]);
        }
    }
}