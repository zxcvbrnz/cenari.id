<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;

class Blog extends Component
{
    // Mengurangi trait pagination yang tidak lagi digunakan
    public function render()
    {
        return view('livewire.blog', [
            'posts' => Post::with('featuredImage')
                ->where('is_published', true)
                ->latest()
                ->get() // Mengubah paginate menjadi get untuk menarik seluruh data
        ]);
    }
}