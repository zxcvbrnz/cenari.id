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
        // 1. Ambil data pivot course user yang sedang login
        $userCourse = Auth::user()->coursePackages()->findOrFail($courseId);

        $username = $userCourse->pivot->username;
        $password = $userCourse->pivot->password; // Pastikan ini plain-text/bisa dibaca jika dikirim, atau gunakan ID unik sistem target

        // 2. Buat query data yang ingin dikirim (bisa username, email, atau ID eksternal)
        $payload = [
            'username' => $username,
            'expires' => Carbon::now()->addMinute(1)->timestamp, // Berlaku 1 menit saja
        ];

        // 3. Buat signature/hash pengaman menggunakan APP_KEY bersama agar tidak bisa dimanipulasi
        // Anda bisa menggunakan enkripsi bawaan Laravel
        $encryptedPayload = encrypt($payload);

        // 4. Alihkan user ke web target beserta payload aman tersebut
        $targetUrl = "https://kursus.cenari.sch.id/auto-login?token=" . urlencode($encryptedPayload);

        return redirect()->away($targetUrl);
    }
}