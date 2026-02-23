<?php

namespace Database\Seeders;

use App\Models\Program;
use App\Models\CoursePackage;
use App\Models\MissingLink;
use App\Models\Workshop;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProgramSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            'smart-building' => [
                'title' => 'Smart Architecture & BIM',
                'category' => ['Architecture'],
                'hero_image' => 'https://images.pexels.com/photos/323705/pexels-photo-323705.jpeg',
                'accent_color' => '#3B82F6',
                'icon' => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4',
                'badges' => ['BIM Ready', 'IoT Integration'],
                'course_packages' => [
                    ['level' => 1, 'name_ref' => '2D Drafting', 'tool' => 'AutoCAD', 'count' => 12, 'price' => 1500000],
                    ['level' => 2, 'name_ref' => '3D Modeling', 'tool' => 'Revit', 'count' => 12, 'price' => 2000000],
                    ['level' => 3, 'name_ref' => 'IoT Integration', 'tool' => 'Smart Home Kit', 'count' => 12, 'price' => 2500000],
                ],
                'missing_link' => [
                    'text' => 'Desainmu belum hidup? Tambahkan nyawa dengan belajar sensor di kelas Smart Home Automation.',
                    'cta' => 'Lihat Kelas Robotik',
                    'url' => 'creative-design'
                ]
            ],
            'creative-design' => [
                'title' => 'Visual Branding & UI Design',
                'category' => ['Desain', 'Robotik'],
                'hero_image' => 'https://images.pexels.com/photos/3183150/pexels-photo-3183150.jpeg',
                'accent_color' => '#84CC16',
                'icon' => 'M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z',
                'badges' => ['UI/UX Focus', 'Tech-Driven'],
                'course_packages' => [
                    ['level' => 1, 'name_ref' => 'Visual Branding', 'tool' => 'Corel/Canva', 'count' => 10, 'price' => 1200000],
                    ['level' => 2, 'name_ref' => 'UI Design', 'tool' => 'Figma', 'count' => 10, 'price' => 1800000],
                    ['level' => 3, 'name_ref' => 'Interactive App', 'tool' => 'Robot Controller', 'count' => 10, 'price' => 2200000],
                ],
                'missing_link' => [
                    'text' => 'Desainer Grafis di Cenari tidak cuma gambar, tapi belajar mendesain antarmuka aplikasi untuk mengontrol Robot.',
                    'cta' => 'Pelajari Kontroler Robot',
                    'url' => 'software-control'
                ]
            ],
            'business-intel' => [
                'title' => 'Digital Business Productivity',
                'category' => ['Office', 'AI'],
                'hero_image' => 'https://images.pexels.com/photos/669615/pexels-photo-669615.jpeg',
                'accent_color' => '#3B82F6',
                'icon' => 'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0h6m-6 0H5m6 0h1m6 0H9m3 0h2m3 0h2m-2 0v-4a2 2 0 00-2-2h-2a2 2 0 00-2 2v4a2 2 0 012 2h2a2 2 0 012-2z',
                'badges' => ['AI Powered', 'Automation Ready'],
                'course_packages' => [
                    ['level' => 1, 'name_ref' => 'Advanced Office', 'tool' => 'Excel Advanced', 'count' => 8, 'price' => 1000000],
                    ['level' => 2, 'name_ref' => 'AI Prompting', 'tool' => 'ChatGPT for Business', 'count' => 8, 'price' => 1500000],
                    ['level' => 3, 'name_ref' => 'Data Analytics', 'tool' => 'Business Intelligence', 'count' => 8, 'price' => 2000000],
                ],
                'missing_link' => [
                    'text' => 'Gunakan data suhu dari Robot Cuaca untuk diolah di Excel. Belajar integrasi data real-time sekarang.',
                    'cta' => 'Cek Ekosistem IoT',
                    'url' => 'smart-building'
                ]
            ],
            'software-control' => [
                'title' => 'Software & Hardware Control',
                'category' => ['Web', 'Microcontroller'],
                'hero_image' => 'https://images.pexels.com/photos/546819/pexels-photo-546819.jpeg',
                'accent_color' => '#84CC16',
                'icon' => 'M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4',
                'badges' => ['Fullstack', 'Hardware Interaction'],
                'course_packages' => [
                    ['level' => 1, 'name_ref' => 'Web Foundation', 'tool' => 'HTML, CSS, JS', 'count' => 15, 'price' => 2000000],
                    ['level' => 2, 'name_ref' => 'Microcontroller', 'tool' => 'Arduino & ESP32', 'count' => 15, 'price' => 2500000],
                    ['level' => 3, 'name_ref' => 'IoT Dashboard', 'tool' => 'Real-time Control', 'count' => 15, 'price' => 3000000],
                ],
                'missing_link' => [
                    'text' => 'Webmu bisa mengontrol lampu dunia nyata? Pelajari integrasi Web dengan Smart Home.',
                    'cta' => 'Lihat Smart Architecture',
                    'url' => 'smart-building'
                ]
            ],
        ];

        foreach ($data as $slug => $item) {
            $program = Program::create([
                'slug' => $slug,
                'title' => $item['title'],
                'category' => $item['category'],
                'hero_image' => $item['hero_image'],
                'accent_color' => $item['accent_color'],
                'icon' => $item['icon'],
                'badges' => $item['badges'],
            ]);

            foreach ($item['course_packages'] as $pkg) {
                CoursePackage::create([
                    'program_id' => $program->id,
                    'slug' => Str::slug($pkg['name_ref']),
                    'name' => $pkg['name_ref'], // Menggunakan isi description sebelumnya
                    'level' => $pkg['level'], // Sekarang Integer (1, 2, atau 3)
                    'description' => "Kuasai keahlian " . $pkg['name_ref'] . " secara mendalam dengan standar industri menggunakan tools " . $pkg['tool'] . ".",
                    'tool' => $pkg['tool'],
                    'course_count' => $pkg['count'], // Sekarang Integer
                    'course_during' =>  2, // Sekarang Integer
                    'price' => $pkg['price'],
                ]);
            }

            MissingLink::create([
                'text' => $item['missing_link']['text'],
                'cta' => $item['missing_link']['cta'],
                'url' => $item['missing_link']['url'],
            ]);
        }

        $seminars = [
            [
                'title' => 'Mastering BIM for Smart Building Architecture',
                'date_string' => '25 Maret 2024',
                'time_string' => '09:00 - 15:00 WIB',
                'type' => 'Workshop',
                'image' => 'https://images.pexels.com/photos/3183186/pexels-photo-3183186.jpeg',
                'status' => 'Registration Open',
                'price' => 'Free',
                'color' => '#3B82F6'
            ],
            [
                'title' => 'AI Transformation in Digital Business 2024',
                'date_string' => '12 April 2024',
                'time_string' => '13:00 - 17:00 WIB',
                'type' => 'Seminar',
                'image' => 'https://images.pexels.com/photos/8386440/pexels-photo-8386440.jpeg',
                'status' => 'Upcoming',
                'price' => 'Rp 50.000',
                'color' => '#84CC16'
            ],
            [
                'title' => 'IoT Development: From Zero to Prototype',
                'date_string' => '05 Mei 2024',
                'time_string' => '08:00 - 16:00 WIB',
                'type' => 'Bootcamp',
                'image' => 'https://images.pexels.com/photos/2582937/pexels-photo-2582937.jpeg',
                'status' => 'Upcoming',
                'price' => 'Rp 250.000',
                'color' => '#F59E0B'
            ]
        ];

        foreach ($seminars as $data) {
            // Menambahkan slug secara dinamis sebelum create
            $data['slug'] = Str::slug($data['title']);

            Workshop::create($data);
        }
    }
}