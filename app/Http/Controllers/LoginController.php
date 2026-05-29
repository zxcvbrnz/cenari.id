<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function redirectToPlatform($courseId)
    {
        // 1. Ambil data dari pivot
        $userCourse = Auth::user()->coursePackages()->findOrFail($courseId);
        $username = $userCourse->pivot->username;

        // 2. Tentukan waktu kedaluwarsa (1 menit dari sekarang)
        $expires = Carbon::now()->addMinute(1)->timestamp;

        // 3. Gabungkan data yang akan dikirim menjadi satu string bertipe plain text
        $dataToSign = "username=" . $username . "&expires=" . $expires;

        // 4. Buat signature/tanda tangan digital unik menggunakan Secret Key di .env
        $secretKey = env('PORTAL_SECRET_KEY');
        $signature = hash_hmac('sha256', $dataToSign, $secretKey);

        // 5. Susun URL akhir dengan aman
        $targetUrl = "https://kursus.cenari.sch.id/auto-login?" . $dataToSign . "&signature=" . $signature;

        return redirect()->away($targetUrl);
    }
}