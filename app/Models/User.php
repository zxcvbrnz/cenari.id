<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Notifications\CustomResetPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new CustomResetPassword($token));
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    // Di Model User.php
    protected $fillable = [
        'name',
        'nik',
        'gender',
        'born_place',
        'born_date',
        'address',
        'whatsapp',
        'email',
        'last_education',
        'current_status',
        'nama_ayah',
        'nama_ibu',
        'nisn',
        'agama',
        'rt',
        'rw',
        'kodepos',
        'provinsi',
        'kab_kota',
        'kecamatan',
        'kelurahan',
        'desa/kelurahan',
        'jenis_tinggal',
        'alat_transportasi',
        'password',
        'role'
    ];

    protected $casts = [
        'born_date' => 'date',
        'role' => 'string',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function coursePackages()
    {
        return $this->belongsToMany(CoursePackage::class)
            ->withPivot('learning_methode', 'status')
            ->withTimestamps();
    }

    public function addresses(): HasMany
    {
        return $this->hasMany(UserAddress::class);
    }
}
