<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutUs extends Model
{
    protected $table = 'about_us';

    protected $fillable = [
        'homepage_text',
        'text_1',
        'text_2',
        'image_1',
        'image_2',
        'pdf_url',
        'video_url',
    ];

    /**
     * Accessor untuk Formatted Text 1
     */
    public function getFormattedText1Attribute()
    {
        return $this->formatTextWithLinks($this->text_1);
    }

    public function getFormattedHomepageTextAttribute()
    {
        return $this->formatTextWithLinks($this->homepage_text);
    }

    /**
     * Accessor untuk Formatted Text 2
     */
    public function getFormattedText2Attribute()
    {
        return $this->formatTextWithLinks($this->text_2);
    }

    /**
     * Helper Method Internal untuk memproses formatting teks
     */
    protected function formatTextWithLinks($rawText)
    {
        if (empty($rawText)) {
            return '';
        }

        // 1. Amankan teks dari script HTML jahat (XSS Protection)
        $text = e($rawText);

        // 2. Pola Regex untuk mendeteksi URL (http, https, dan www)
        $urlPattern = '/(https?:\/\/[^\s]+|www\.[^\s]+)/i';
        $text = preg_replace_callback($urlPattern, function ($matches) {
            $url = $matches[0];
            $href = preg_match('/^https?:\/\//i', $url) ? $url : 'http://' . $url;
            return '<a href="' . $href . '" target="_blank" rel="noopener noreferrer" class="text-indigo-600 hover:underline font-medium break-all">' . $url . '</a>';
        }, $text);

        // 3. FITUR H1: Mengubah "# Judul Teks" menjadi tag <h1> dengan styling Tailwind
        // Pola ini mendeteksi tanda # di awal baris yang diikuti oleh spasi
        $text = preg_replace('/^#\s+(.+)$/m', '<h1 class="text-2xl sm:text-3xl font-extrabold text-slate-950 tracking-tight mt-4 mb-2">$1</h1>', $text);

        // 4. FITUR BOLD: Mengubah **teks** menjadi <strong>teks</strong>
        $text = preg_replace('/\*\*(.*?)\*\*/s', '<strong class="font-bold text-slate-900">$1</strong>', $text);

        // 5. FITUR ITALIC: Mengubah *teks* atau _teks_ menjadi <em>teks</em>
        // Menggunakan pola yang tidak bentrok dengan bintang ganda (bold)
        $text = preg_replace('/(?<!\*)\*(?!\*)(.*?)(?<!\*)\*(?!\*)/s', '<em class="italic">$1</em>', $text);
        $text = preg_replace('/_(.*?)_/s', '<em class="italic">$1</em>', $text);

        // 6. Ubah ketukan enter menjadi tag <br> untuk mempertahankan paragraf
        return nl2br($text);
    }
}