<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;

class BlogShow extends Component
{
    public $post;

    public function mount($slug)
    {
        $this->post = Post::with('images')
            ->where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();
    }
    public function render()
    {
        return view('livewire.blog-show');
    }
}