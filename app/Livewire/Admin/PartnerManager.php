<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\SchoolPartner;
use App\Models\InstitutionPartner;
use Livewire\WithPagination;
use Silvanix\Wablas\Message;

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
            $partner = SchoolPartner::findOrFail($id);
            $nama = $partner->nama_lengkap;
            $partner->delete();
        } else {
            $partner = InstitutionPartner::findOrFail($id);
            $nama = $partner->nama_lengkap;
            $partner->delete();
        }

        $this->dispatch('swal:modal', [
            'title' => 'Partner Dihapus',
            'icon'  => 'warning',
            'text'  => 'Data partner "' . $nama . '" telah dihapus permanen.'
        ]);
    }

    public function toggleStatus($id)
    {
        if ($this->type === 'school') {
            $partner = SchoolPartner::findOrFail($id);
        } else {
            $partner = InstitutionPartner::findOrFail($id);
        }

        $partner->status = !$partner->status;
        $partner->save();

        $this->dispatch('swal:modal', [
            'title' => 'Status Diubah',
            'icon'  => 'success',
            'text'  => 'Status partner "' . $partner->nama_lengkap . '" telah diubah.'
        ]);
        $send = new Message();
        $queue = [
            [
                'phone' => $partner->whatsapp,
                'message' => "Halo " . $partner->nama_lengkap . " - " . ($this->type === 'school' ? $partner->nama_sekolah : $partner->nama_institusi) . "*\n" .
                    "Penawaran terkait " . $partner->penawaran . ".\n" .
                    "Sudah kami kirimkan lewat email " . $partner->email . ".\n" .
                    "*Cenari ID*\n" .
                    "www.cenari.id",
            ],
        ];
        foreach ($queue as $index => $item) {
            $send->multiple_text([$item]);

            if ($index < count($queue) - 1) {
                sleep(rand(10, 20));
            }
        }
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