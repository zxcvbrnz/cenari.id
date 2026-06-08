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
        if (empty($this->body)) {
            return '';
        }

        // 1. Amankan teks dari script HTML jahat (XSS Protection)
        $text = e($this->body);

        // 2. Pola Regex untuk mendeteksi URL (http, https, dan www)
        $urlPattern = '/(https?:\/\/[^\s]+|www\.[^\s]+)/i';

        // 3. Ubah teks URL menjadi tag HTML <a> dengan target="_blank"
        $text = preg_replace_callback($urlPattern, function ($matches) {
            $url = $matches[0];

            // Jika link diawali www. tanpa http, tambahkan http:// agar tidak rusak saat di-klik
            $href = preg_match('/^https?:\/\//i', $url) ? $url : 'http://' . $url;

            return '<a href="' . $href . '" target="_blank" rel="noopener noreferrer" class="text-blue-600 hover:underline font-medium break-all">' . $url . '</a>';
        }, $text);

        // 4. FITUR H1: Mengubah "# Judul" di awal baris menjadi tag <h1> dengan class Tailwind
        $text = preg_replace('/^#\s+(.+)$/m', '<h1 class="text-xl sm:text-2xl font-extrabold text-slate-950 tracking-tight mt-4 mb-2">$1</h1>', $text);

        // 5. FITUR BOLD: Mengubah **teks** menjadi <strong>teks</strong>
        $text = preg_replace('/\*\*(.*?)\*\*/s', '<strong class="font-bold text-slate-900">$1</strong>', $text);

        // 6. FITUR ITALIC: Mengubah *teks* atau _teks_ menjadi <em>teks</em>
        // Menggunakan negative lookahead/lookbehind agar bintang tunggal tidak bentrok dengan bintang ganda (bold)
        $text = preg_replace('/(?<!\*)\*(?!\*)(.*?)(?<!\*)\*(?!\*)/s', '<em class="italic">$1</em>', $text);
        $text = preg_replace('/_(.*?)_/s', '<em class="italic">$1</em>', $text);

        // 7. Ubah ketukan enter menjadi tag <br> untuk mempertahankan baris kosong pemisah paragraf
        return nl2br($text);
    }
}