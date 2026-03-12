<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::create([
            'name'           => 'Muhammad Sabirin',
            'nik'            => '6371010101010001', // Sesuaikan NIK dummy
            'gender'         => 'Laki-laki',
            'born_place'     => 'Banjarmasin',
            'born_date'      => '2004-05-20',
            'address'        => 'Jl. Ahmad Yani KM 5, Banjarmasin',
            'whatsapp'       => '081234567890',
            'email'          => 'muhammadsabirin2004@gmail.com',
            'last_education' => 'SMA',
            'current_status' => 'Mahasiswa',
            'role'           => 'user',
            'password'       => Hash::make('12345678'),
        ]);

        // Akun Admin / Tebar Kode Teknologi
        User::create([
            'name'           => 'Tebar Kode Teknologi',
            'nik'            => '6371000000000000',
            'gender'         => 'Laki-laki',
            'born_place'     => 'Indonesia',
            'born_date'      => '2020-01-01',
            'address'        => 'Kantor Tebar Kode Teknologi',
            'whatsapp'       => '081122334455',
            'email'          => 'tebarkode@gmail.com',
            'last_education' => 'Professional',
            'current_status' => 'Founder',
            'role'           => 'admin',
            'password'       => Hash::make('12345678'),
        ]);

        $this->call([
            ProgramSeeder::class,
            ItemSeeder::class,
            KitRoboticSeeder::class,
            AgendaSeeder::class,
            PostSeeder::class,
            CourseUserSeeder::class,
        ]);
    }
}