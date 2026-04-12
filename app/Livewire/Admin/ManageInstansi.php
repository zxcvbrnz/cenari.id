<?php

namespace App\Livewire\Admin;

use App\Models\Instansi;
use App\Models\InstansiGallery;
use App\Models\InstansiTestimoni;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class ManageInstansi extends Component
{
    use WithFileUploads;

    public $view = 'list';
    public $activeTab = 'info';
    public $selectedInstansiId;

    // Fields Instansi
    public $name, $colour = '#3B82F6', $profile, $image, $oldImage;

    // Fields Gallery
    public $galleryImage, $caption;

    // Fields Testimoni
    public $testiName, $testiRole, $testiContent, $testiRating = 5;

    public function render()
    {
        return view('livewire.admin.manage-instansi', [
            'instansis' => Instansi::withCount(['galleries', 'testimonis'])->latest()->get(),
            'currentInstansi' => $this->selectedInstansiId ? Instansi::with(['galleries', 'testimonis'])->find($this->selectedInstansiId) : null
        ]);
    }

    public function createNew()
    {
        $this->reset(['selectedInstansiId', 'name', 'colour', 'profile', 'image', 'oldImage']);
        $this->view = 'edit';
        $this->activeTab = 'info';
    }

    public function editInstansi($id)
    {
        $instansi = Instansi::findOrFail($id);
        $this->selectedInstansiId = $instansi->id;
        $this->name = $instansi->name;
        $this->colour = $instansi->colour;
        $this->profile = $instansi->profile;
        $this->oldImage = $instansi->image;
        $this->view = 'edit';
    }

    public function goBack()
    {
        $this->view = 'list';
    }

    // --- CRUD INSTANSI ---
    public function saveInstansi()
    {
        $this->validate([
            'name' => 'required',
            'profile' => 'required',
            'image' => $this->selectedInstansiId ? 'nullable|image|max:1024' : 'required|image|max:1024'
        ]);

        $data = ['name' => $this->name, 'colour' => $this->colour, 'profile' => $this->profile];

        if ($this->image) {
            if ($this->oldImage) Storage::disk('public')->delete($this->oldImage);
            $data['image'] = $this->image->store('logos', 'public');
        }

        $instansi = Instansi::updateOrCreate(['id' => $this->selectedInstansiId], $data);
        $this->selectedInstansiId = $instansi->id;
        $this->oldImage = $instansi->image;


        $this->dispatch('swal:modal', [
            'title' => 'Tersimpan!',
            'icon' => 'success',
            'text' => 'Data identitas instansi berhasil diperbarui.'
        ]);
    }

    public function deleteInstansi()
    {
        $instansi = Instansi::findOrFail($this->selectedInstansiId);

        // Hapus Logo
        if ($instansi->image) Storage::disk('public')->delete($instansi->image);

        // Hapus Galeri (file & data)
        foreach ($instansi->galleries as $gal) {
            Storage::disk('public')->delete($gal->image);
        }

        $instansi->delete(); // Testimoni & Galeri otomatis terhapus jika pakai onCascadeDelete di DB

        $this->view = 'list';
        $this->dispatch('swal:modal', [
            'title' => 'Instansi Dihapus',
            'text' => 'Seluruh data instansi berhasil dibersihkan dari sistem.',
            'icon' => 'success'
        ]);
    }

    // --- CRUD GALLERY ---
    public function addGallery()
    {
        $this->validate(['galleryImage' => 'required|image|max:2048']);

        InstansiGallery::create([
            'instansi_id' => $this->selectedInstansiId,
            'image' => $this->galleryImage->store('gallery', 'public'),
            'caption' => $this->caption,
        ]);

        $this->reset(['galleryImage', 'caption']);

        $this->dispatch('swal:modal', [
            'title' => 'Berhasil!',
            'icon' => 'success',
            'text' => 'Foto telah ditambahkan ke galeri.'
        ]);
    }

    public function deleteGallery($id)
    {
        $g = InstansiGallery::find($id);
        if ($g) {
            Storage::disk('public')->delete($g->image);
            $g->delete();

            $this->dispatch('swal:modal', [
                'title' => 'Terhapus!',
                'icon' => 'success',
                'text' => 'Foto galeri telah dihapus.'
            ]);
        }
    }

    // --- CRUD TESTIMONI ---
    public function addTestimoni()
    {
        $this->validate(['testiName' => 'required', 'testiContent' => 'required']);

        InstansiTestimoni::create([
            'instansi_id' => $this->selectedInstansiId,
            'name' => $this->testiName,
            'role' => $this->testiRole,
            'content' => $this->testiContent,
            'rating' => $this->testiRating,
        ]);

        $this->reset(['testiName', 'testiRole', 'testiContent']);

        $this->dispatch('swal:modal', [
            'title' => 'Ulasan Terkirim!',
            'icon' => 'success',
            'text' => 'Data ulasan berhasil disimpan.'
        ]);
    }

    public function deleteTesti($id)
    {
        InstansiTestimoni::destroy($id);

        $this->dispatch('swal:modal', [
            'title' => 'Dihapus!',
            'icon' => 'success',
            'text' => 'Ulasan telah dihapus dari sistem.'
        ]);
    }
}
