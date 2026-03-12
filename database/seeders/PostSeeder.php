<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\PostImage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    public function run()
    {
        $post = Post::create([
            'title' => 'Masa Depan IoT di Banjarmasin',
            'slug' => 'masa-depan-iot-banjarmasin',
            'excerpt' => 'Melihat potensi perkembangan ekosistem Smart City dan peran anak muda Kalimantan.',
            'body' => 'Isi konten artikel lengkap di sini...',
            'is_published' => true,
        ]);

        PostImage::create([
            'post_id' => $post->id,
            'filename' => 'default-iot.jpg',
            'is_featured' => true
        ]);
    }
}