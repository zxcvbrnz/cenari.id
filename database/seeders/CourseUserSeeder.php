<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = \App\Models\User::first();
        $package = \App\Models\CoursePackage::first();

        if ($user && $package) {
            $user->coursePackages()->attach($package->id, [
                'learning_methode' => 'Offline',
                'status' => 'Sedang Berjalan',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Menambahkan data kedua untuk testing
            $user->coursePackages()->attach(2, [
                'learning_methode' => 'Online',
                'status' => 'Diproses',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}