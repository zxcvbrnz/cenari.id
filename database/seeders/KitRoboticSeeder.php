<?php

namespace Database\Seeders;

use App\Models\Item;
use App\Models\KitRobotic;
use App\Models\KitRoboticImage;
use App\Models\KitRoboticModul;
use Illuminate\Database\Seeder;

class KitRoboticSeeder extends Seeder
{
    public function run(): void
    {
        // Kit 1: Robot Line Follower
        $kit1 = KitRobotic::create([
            'name' => 'Advanced Line Follower Kit',
            'discount' => 5000,
            'description' => 'Kit robot pengikut garis dengan kecepatan tinggi.',
        ]);

        KitRoboticImage::create(['kit_robotic_id' => $kit1->id, 'image' => 'https://placehold.co/600x400?text=Line+Follower']);
        KitRoboticModul::create(['kit_robotic_id' => $kit1->id, 'name' => 'Panduan Coding PID', 'file' => 'pid.pdf', 'price' => 45000]);

        // Hubungkan Items ke Kit 1
        $kit1->items()->attach([
            1 => ['quantity' => 1], // Arduino
            5 => ['quantity' => 1], // L298N
            3 => ['quantity' => 2], // Ultrasonic
        ]);

        // Kit 2: Robotic Arm
        $kit2 = KitRobotic::create([
            'name' => '4-DOF Robotic Arm',
            'discount' => 5000,
            'description' => 'Lengan robot akrilik dengan 4 motor servo.',
        ]);

        KitRoboticImage::create(['kit_robotic_id' => $kit2->id, 'image' => 'https://placehold.co/600x400?text=Robotic+Arm']);
        KitRoboticModul::create(['kit_robotic_id' => $kit2->id, 'name' => 'Buku Rakit Mekanik', 'file' => 'rakit.pdf', 'price' => 30000]);

        $kit2->items()->attach([
            1 => ['quantity' => 1], // Arduino
            4 => ['quantity' => 4], // 4x Servo
        ]);
    }
}
