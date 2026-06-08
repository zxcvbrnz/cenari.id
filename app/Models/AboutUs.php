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
        $pattern = '/(https?:\/\/[^\s]+|www\.[^\s]+)/i';

        // 3. Ubah teks URL menjadi tag HTML <a> dengan target="_blank"
        $text = preg_replace_callback($pattern, function ($matches) {
            $url = $matches[0];

            // Jika link diawali www. tanpa http, tambahkan http:// agar tidak rusak saat di-klik
            $href = preg_match('/^https?:\/\//i', $url) ? $url : 'http://' . $url;

            return '<a href="' . $href . '" target="_blank" rel="noopener noreferrer" class="text-blue-600 hover:underline font-medium break-all">' . $url . '</a>';
        }, $text);

        // 4. Ubah ketukan enter menjadi tag <br> untuk mempertahankan paragraf
        return nl2br($text);
    }
}