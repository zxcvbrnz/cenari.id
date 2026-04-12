<?php

namespace App\Livewire\Admin;

use App\Models\{Portfolio, PortfolioCategory, PortfolioImage};
use Illuminate\Support\Facades\Storage;
use Livewire\{Component, WithFileUploads};
use Illuminate\Support\Str;

class ManagePortfolio extends Component
{
    use WithFileUploads;

    public $view = 'list', $selectedId;
    public $title, $author, $description, $tech = [], $newTech, $images = [], $oldImages = [];
    public $newCategoryName, $selectedCategories = [];

    public function render()
    {
        return view('livewire.admin.manage-portfolio', [
            'portfolios' => Portfolio::with(['categories', 'images'])->latest()->get(),
            'allCategories' => PortfolioCategory::all()
        ]);
    }

    public function updatedImages()
    {
        $this->validate([
            'images.*' => 'image|max:2048',
        ]);
    }

    public function showForm($id = null)
    {
        $this->reset(['selectedId', 'title', 'author', 'description', 'tech', 'newTech', 'selectedCategories', 'images', 'oldImages']);
        $this->resetValidation();

        if ($id) {
            $p = Portfolio::with(['categories', 'images'])->findOrFail($id);
            $this->selectedId = $p->id;
            $this->title = $p->title;
            $this->author = $p->author;
            $this->description = $p->description;
            $this->tech = $p->tech ?? [];
            $this->selectedCategories = $p->categories->pluck('id')->toArray();
            $this->oldImages = $p->images;
        }
        $this->view = 'form';
    }

    // Logic Tech Stack (Tagging)
    public function addTech()
    {
        if ($this->newTech && !in_array($this->newTech, $this->tech)) {
            $this->tech[] = $this->newTech;
            $this->reset('newTech');
        }
    }

    public function removeTech($index)
    {
        unset($this->tech[$index]);
        $this->tech = array_values($this->tech);
    }

    public function removeUpload($index)
    {
        unset($this->images[$index]);
        $this->images = array_values($this->images);
    }

    public function saveCategory()
    {
        $this->validate(['newCategoryName' => 'required|unique:portfolio_categories,name']);
        PortfolioCategory::create(['name' => $this->newCategoryName]);
        $this->reset('newCategoryName');

        $this->dispatch('swal:modal', [
            'title' => 'Tersimpan!',
            'icon' => 'success',
            'text' => 'Kategori baru berhasil ditambahkan.'
        ]);
    }

    public function deleteCategory($id, $name)
    {
        PortfolioCategory::destroy($id);
        $this->dispatch('swal:modal', [
            'title' => 'Terhapus!',
            'icon' => 'warning',
            'text' => "Kategori '$name' berhasil dihapus."
        ]);
    }

    public function setFeatured($imageId)
    {
        PortfolioImage::where('portfolio_id', $this->selectedId)->update(['is_featured' => false]);
        PortfolioImage::where('id', $imageId)->update(['is_featured' => true]);
        $this->oldImages = PortfolioImage::where('portfolio_id', $this->selectedId)->get();

        $this->dispatch('swal:modal', [
            'title' => 'Thumbnail Diatur!',
            'icon' => 'success',
            'text' => 'Gambar utama berhasil diperbarui.'
        ]);
    }

    public function deleteImage($id)
    {
        $img = PortfolioImage::find($id);
        if ($img) {
            Storage::disk('public')->delete($img->filename);
            $img->delete();
            $this->oldImages = PortfolioImage::where('portfolio_id', $this->selectedId)->get();

            $this->dispatch('swal:modal', [
                'title' => 'Terhapus!',
                'icon' => 'success',
                'text' => 'Gambar berhasil dihapus dari server.'
            ]);
        }
    }

    public function save()
    {
        $this->validate([
            'title' => 'required',
            'author' => 'required',
            'images.*' => 'nullable|image|max:2048',
        ]);

        $p = Portfolio::updateOrCreate(['id' => $this->selectedId], [
            'title' => $this->title,
            'slug' => Str::slug($this->title),
            'author' => $this->author,
            'description' => $this->description,
            'tech' => $this->tech, // Pastikan cast array di model
        ]);

        $p->categories()->sync($this->selectedCategories);

        if (!empty($this->images)) {
            foreach ($this->images as $img) {
                $filename = $img->store('portfolio', 'public');
                $p->images()->create(['filename' => $filename]);
            }
            $this->reset('images');
        }

        $this->dispatch('swal:modal', [
            'title' => 'Berhasil!',
            'icon' => 'success',
            'text' => 'Data Project Berhasil Disimpan'
        ]);

        $this->view = 'list';
    }

    public function deletePortfolio($id, $title)
    {
        $p = Portfolio::find($id);
        if ($p) {
            foreach ($p->images as $img) {
                Storage::disk('public')->delete($img->filename);
            }
            $p->delete();

            $this->dispatch('swal:modal', [
                'title' => 'Dihapus!',
                'icon' => 'error',
                'text' => "Project '$title' berhasil dihapus permanen."
            ]);
        }
    }
}
