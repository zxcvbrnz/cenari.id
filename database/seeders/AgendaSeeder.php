<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AgendaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $agendas = [
            [
                'title' => 'Rapat Koordinasi Kurikulum Robotik',
                'date' => '2026-03-25',
                'time' => '09:00 WITA',
                'location' => 'Cenari Lab 1',
                'description' => 'Evaluasi leveling materi robotika untuk semester genap di Sekolah Robot Banjarmasin.',
            ],
            [
                'title' => 'Maintenance Server Tebar Kode',
                'date' => '2026-04-05',
                'time' => '23:00 WITA',
                'location' => 'Data Center',
                'description' => 'Peningkatan kapasitas database dan optimasi performa backend untuk layanan IoT.',
            ],
            [
                'title' => 'Sosialisasi Sertifikasi Siswa',
                'date' => '2026-04-12',
                'time' => '10:00 WITA',
                'location' => 'Aula Cenari ID',
                'description' => 'Penyampaian prosedur sertifikasi kompetensi untuk siswa tingkat smart home.',
            ],
        ];

        foreach ($agendas as $item) {
            \App\Models\Agenda::create([
                'title' => $item['title'],
                'slug' => \Illuminate\Support\Str::slug($item['title']),
                'date' => $item['date'],
                'time' => $item['time'],
                'location' => $item['location'],
                'description' => $item['description'],
            ]);
        }
    }
}