<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\SchoolPartner;
use App\Models\InstitutionPartner;
use Livewire\WithPagination;

class PartnerManager extends Component
{
    use WithPagination;

    public $type = 'school'; // Default view

    public function setType($type)
    {
        $this->type = $type;
        $this->resetPage();
    }

    public function deletePartner($id)
    {
        if ($this->type === 'school') {
            SchoolPartner::findOrFail($id)->delete();
        } else {
            InstitutionPartner::findOrFail($id)->delete();
        }

        session()->flash('success', 'Data partner berhasil dihapus.');
    }

    public function render()
    {
        $partners = $this->type === 'school'
            ? SchoolPartner::latest()->paginate(10)
            : InstitutionPartner::latest()->paginate(10);

        return view('livewire.admin.partner-manager', [
            'partners' => $partners
        ]);
    }
}