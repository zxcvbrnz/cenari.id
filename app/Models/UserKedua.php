<?php

namespace App\Models;

// Menggunakan Authenticatable, bukan Model biasa
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;

// Tambahkan "implements MustVerifyEmail" jika ingin otomatis kirim email verifikasi
class UserKedua extends Authenticatable
{
    use Notifiable;

    // Tetap pertahankan koneksi dan tabel khusus Anda
    protected $connection = 'mysql_kedua';
    protected $table = 'users';

    protected $guarded = ['id'];

    /**
     * Menyembunyikan atribut sensitif saat model diubah menjadi array/JSON
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Memastikan password di-hash otomatis (Laravel 11 / 12)
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }
}