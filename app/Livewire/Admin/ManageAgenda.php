<?php

namespace App\Livewire\Admin;

use App\Models\Agenda;
use Livewire\Component;
use Illuminate\Support\Str;

class ManageAgenda extends Component
{
    public $view = 'list', $selectedId;
    public $title, $date, $time, $location, $description, $is_active = true;

    public function render()
    {
        return view('livewire.admin.manage-agenda', [
            'agendas' => Agenda::orderBy('date', 'desc')->get()
        ]);
    }

    public function showForm($id = null)
    {
        $this->reset(['selectedId', 'title', 'date', 'time', 'location', 'description', 'is_active']);

        if ($id) {
            $a = Agenda::findOrFail($id);
            $this->selectedId = $a->id;
            $this->title = $a->title;
            $this->date = $a->date;
            $this->time = $a->time;
            $this->location = $a->location;
            $this->description = $a->description;
            $this->is_active = $a->is_active;
        }
        $this->view = 'form';
    }

    public function save()
    {
        $this->validate([
            'title' => 'required',
            'date' => 'required|date',
            'location' => 'required',
        ]);

        Agenda::updateOrCreate(['id' => $this->selectedId], [
            'title' => $this->title,
            'slug' => Str::slug($this->title),
            'date' => $this->date,
            'time' => $this->time,
            'location' => $this->location,
            'description' => $this->description,
            'is_active' => $this->is_active,
        ]);

        // Menggunakan swal:modal agar konsisten dengan Portfolio
        $this->dispatch('swal:modal', [
            'title' => 'Agenda Berhasil Disimpan',
            'icon' => 'success',
            'text' => 'Jadwal agenda ' . $this->title . ' telah diperbarui.'
        ]);

        $this->view = 'list';
    }

    public function deleteAgenda($id)
    {
        $agenda = Agenda::find($id);
        if ($agenda) {
            $agendaName = $agenda->title;
            $agenda->delete();

            $this->dispatch('swal:modal', [
                'title' => 'Agenda Dihapus',
                'icon' => 'warning',
                'text' => 'Agenda "' . $agendaName . '" telah dihapus dari sistem.'
            ]);
        }
    }

    // Tambahan: Method untuk toggle status aktif dengan cepat jika dibutuhkan
    public function toggleStatus($id)
    {
        $agenda = Agenda::findOrFail($id);
        $agenda->is_active = !$agenda->is_active;
        $agenda->save();

        $this->dispatch('swal:modal', [
            'title' => 'Status Diperbarui',
            'icon' => 'success',
            'text' => 'Status aktif agenda telah diubah.'
        ]);
    }
}