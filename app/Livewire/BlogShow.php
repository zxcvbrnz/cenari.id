<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;

class BlogShow extends Component
{
    public $post;
    public $otherPosts;

    public function mount($slug)
    {
        // 1. Ambil detail artikel utama beserta gambarnya
        $this->post = Post::with('images')
            ->where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        // 2. Ambil artikel lainnya untuk sidebar kanan (kecuali artikel aktif saat ini)
        $this->otherPosts = Post::with('images')
            ->where('id', '!=', $this->post->id)
            ->where('is_published', true)
            ->latest()
            ->take(4)
            ->get();
    }

    public function render()
    {
        return view('livewire.blog-show');
    }
}