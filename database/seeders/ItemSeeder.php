<?php

namespace Database\Seeders;

use App\Models\Item;
use App\Models\ItemImage;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            ['name' => 'Arduino Uno R3', 'price' => 185000, 'description' => 'Mikrokontroler standar industri.'],
            ['name' => 'ESP32 DevKit V1', 'price' => 85000, 'description' => 'Module WiFi dan Bluetooth.'],
            ['name' => 'Ultrasonic HC-SR04', 'price' => 25000, 'description' => 'Sensor jarak akustik.'],
            ['name' => 'Servo MG996R', 'price' => 95000, 'description' => 'Servo metal gear high torque.'],
            ['name' => 'L298N Motor Driver', 'price' => 35000, 'description' => 'Driver motor DC dual channel.'],
            ['name' => 'LiPo Battery 11.1V', 'price' => 210000, 'description' => 'Baterai kapasitas tinggi 2200mAh.'],
        ];

        foreach ($items as $data) {
            $item = Item::create($data);
            ItemImage::create([
                'item_id' => $item->id,
                'image' => 'https://placehold.co/600x400?text=' . urlencode($item->name)
            ]);
        }
    }
}
