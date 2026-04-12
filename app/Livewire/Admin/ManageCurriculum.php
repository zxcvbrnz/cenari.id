<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Curriculum;

class ManageCurriculum extends Component
{
    public $curriculums;
    public $level, $materi, $outcome, $curriculumId;
    public $isEdit = false;

    // Tambahkan properti untuk mengontrol tampilan list vs form
    public $view = 'list';

    protected $rules = [
        'level' => 'required',
        'materi' => 'required',
        'outcome' => 'required',
    ];

    public function render()
    {
        $this->curriculums = Curriculum::all();
        return view('livewire.admin.manage-curriculum');
    }

    public function edit($id)
    {
        $data = Curriculum::findOrFail($id);
        $this->curriculumId = $id;
        $this->level = $data->level;
        $this->materi = $data->materi;
        $this->outcome = $data->outcome;
        $this->isEdit = true;
        $this->view = 'form'; // Pindah ke tampilan form
    }

    public function save()
    {
        $this->validate();

        Curriculum::where('id', $this->curriculumId)->update([
            'level' => $this->level,
            'materi' => $this->materi,
            'outcome' => $this->outcome,
        ]);

        $this->dispatch('swal:modal', [
            'title' => 'Data Diperbarui!',
            'icon' => 'success',
            'text' => 'Perubahan pada kurikulum ' . $this->level . ' berhasil disimpan.'
        ]);

        $this->view = 'list'; // Kembali ke tabel
        $this->isEdit = false;
    }

    public function cancel()
    {
        $this->isEdit = false;
        $this->view = 'list';
    }
}