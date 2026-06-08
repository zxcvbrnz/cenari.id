<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'slug', 'excerpt', 'body', 'is_published'];

    public function images()
    {
        return $this->hasMany(PostImage::class);
    }

    // Shortcut untuk mengambil gambar utama
    public function featuredImage()
    {
        return $this->hasOne(PostImage::class)->where('is_featured', true);
    }

    public function getFormattedBodyAttribute()
    {
        // 1. Amankan teks dari script HTML jahat (XSS Protection)
        $text = e($this->body);

        // 2. Pola Regex untuk mendeteksi URL (http, https, dan www)
        $pattern = '/(https?:\/\/[^\s]+|www\.[^\s]+)/i';

        // 3. Ubah teks URL menjadi tag HTML <a> dengan target="_blank" dan warna biru manual (jika prose-a ditimpa)
        $text = preg_replace_callback($pattern, function ($matches) {
            $url = $matches[0];

            // Jika link diawali www. tanpa http, tambahkan http:// agar tidak rusak saat di-klik
            $href = preg_match('/^https?:\/\//i', $url) ? $url : 'http://' . $url;

            return '<a href="' . $href . '" target="_blank" rel="noopener noreferrer" class="text-blue-600 hover:underline font-medium">' . $url . '</a>';
        }, $text);

        $boldPattern = '/\*\*(.*?)\*\*/s';
        $text = preg_replace($boldPattern, '<strong>$1</strong>', $text);

        // 4. Ubah ketukan enter menjadi tag <br> untuk mempertahankan baris kosong pemisah paragraf
        return nl2br($text);
    }
}