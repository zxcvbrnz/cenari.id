<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckProfileCompletion
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $user = Auth::user();

            // Semua kolom dari tabel users yang wajib diisi
            $requiredFields = [
                'name',
                'nik',
                'gender',
                'born_place',
                'born_date',
                'address',
                'whatsapp',
                'last_education',
                'current_status',
                'nama_ayah',
                'nama_ibu',
                'nisn',
                'agama',
                'rt',
                'rw',
                'kodepos',
                'desa/kelurahan', // Sesuai nama kolom di migration Anda
                'provinsi',
                'kab_kota',
                'kecamatan',
                'kelurahan',
                'jenis_tinggal',
                'alat_transportasi',
            ];

            $incompleteFields = [];

            foreach ($requiredFields as $field) {
                // Mengecek apakah value null, string kosong, atau hanya spasi
                if (is_null($user->$field) || trim($user->$field) === '') {
                    $incompleteFields[] = $field;
                }
            }

            // Jika ada kolom yang belum diisi
            if (!empty($incompleteFields)) {
                // Kecualikan halaman profil, logout, dan request internal Livewire/AJAX agar tidak loop
                if (!$request->is('profile*') && !$request->is('logout') && !$request->routeIs('livewire.*')) {
                    return redirect()->route('profile')
                        ->with('warning', 'Anda harus melengkapi seluruh data profil sebelum dapat mendaftar paket kursus.');
                }
            }
        }

        return $next($request);
    }
}