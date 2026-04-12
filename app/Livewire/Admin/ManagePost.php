<?php

namespace App\Livewire\Admin;

use App\Models\{Post, PostImage};
use Livewire\{Component, WithFileUploads};
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ManagePost extends Component
{
    use WithFileUploads;

    public $view = 'list', $selectedId;
    public $title, $excerpt, $body, $is_published = false;
    public $images = [], $oldImages = [];

    public function render()
    {
        return view('livewire.admin.manage-post', [
            'posts' => Post::with('featuredImage')->latest()->get()
        ]);
    }

    public function updatedImages()
    {
        $this->validate([
            'images.*' => 'image|max:2048', // Validasi file gambar
        ]);
    }

    public function showForm($id = null)
    {
        $this->reset(['selectedId', 'title', 'excerpt', 'body', 'is_published', 'images', 'oldImages']);
        $this->resetValidation();

        if ($id) {
            $p = Post::with('images')->findOrFail($id);
            $this->selectedId = $p->id;
            $this->title = $p->title;
            $this->excerpt = $p->excerpt;
            $this->body = $p->body;
            $this->is_published = $p->is_published;
            $this->oldImages = $p->images;
        }
        $this->view = 'form';
    }

    public function removeUpload($index)
    {
        unset($this->images[$index]);
        $this->images = array_values($this->images);
    }

    public function save()
    {
        $this->validate([
            'title' => 'required',
            'excerpt' => 'required',
            'body' => 'required',
            'images.*' => 'nullable|image|max:2048',
        ]);

        $post = Post::updateOrCreate(['id' => $this->selectedId], [
            'title' => $this->title,
            'slug' => Str::slug($this->title),
            'excerpt' => $this->excerpt,
            'body' => $this->body,
            'is_published' => $this->is_published,
        ]);

        if (!empty($this->images)) {
            foreach ($this->images as $img) {
                $path = $img->store('posts', 'public');
                $post->images()->create(['filename' => $path]);
            }
            $this->reset('images');
        }

        $this->dispatch('swal:modal', [
            'title' => 'Artikel Berhasil Disimpan',
            'icon' => 'success',
            'text' => 'Konten artikel "' . $this->title . '" telah diperbarui.'
        ]);

        $this->view = 'list';
    }

    public function setFeatured($imageId)
    {
        PostImage::where('post_id', $this->selectedId)->update(['is_featured' => false]);
        PostImage::where('id', $imageId)->update(['is_featured' => true]);
        $this->oldImages = PostImage::where('post_id', $this->selectedId)->get();

        $this->dispatch('swal:modal', [
            'title' => 'Thumbnail Diatur',
            'icon' => 'success',
            'text' => 'Gambar utama artikel telah berhasil diubah.'
        ]);
    }

    public function deleteImage($id)
    {
        $img = PostImage::find($id);
        if ($img) {
            Storage::disk('public')->delete($img->filename);
            $img->delete();
            $this->oldImages = PostImage::where('post_id', $this->selectedId)->get();

            $this->dispatch('swal:modal', [
                'title' => 'Gambar Dihapus',
                'icon' => 'success',
                'text' => 'File gambar artikel telah dihapus.'
            ]);
        }
    }

    public function deletePost($id)
    {
        $post = Post::find($id);
        if ($post) {
            $postTitle = $post->title;
            foreach ($post->images as $img) {
                Storage::disk('public')->delete($img->filename);
            }
            $post->delete();

            $this->dispatch('swal:modal', [
                'title' => 'Artikel Dihapus',
                'icon' => 'warning',
                'text' => 'Artikel "' . $postTitle . '" telah dihapus permanen.'
            ]);
        }
    }
}
