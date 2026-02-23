<?php

// App/Livewire/PortfolioGallery.php
namespace App\Livewire;

use Livewire\Component;

class PortfolioGallery extends Component
{
    public $filter = 'all';

    public function setFilter($category)
    {
        $this->filter = $category;
    }

    public function getProjectsProperty()
    {
        $projects = [
            [
                'title' => 'Smart City Dashboard',
                'category' => 'hybrid',
                'author' => 'Tim SMA 1 Blue City',
                'desc' => 'Web Dashboard yang menampilkan data kualitas udara dan CCTV real-time dari robot patroli.',
                'image' => 'https://images.pexels.com/photos/3183150/pexels-photo-3183150.jpeg',
                'tech' => ['Laravel', 'ESP32', 'MQTT']
            ],
            [
                'title' => 'Branding Identity: EcoBot',
                'category' => 'software',
                'author' => 'Andini - Kelas Desain',
                'desc' => 'Desain poster, logo, dan UI App untuk produk robot pembersih lingkungan.',
                'image' => 'https://images.pexels.com/photos/196644/pexels-photo-196644.jpeg',
                'tech' => ['CorelDraw', 'Figma']
            ],
            [
                'title' => 'Heavy-Lifter Robot Arm',
                'category' => 'hardware',
                'author' => 'Rizky - Kelas Robotik',
                'desc' => 'Lengan robot 4-DOF yang mampu memindahkan beban hingga 1kg secara presisi.',
                'image' => 'https://images.pexels.com/photos/2599244/pexels-photo-2599244.jpeg',
                'tech' => ['Arduino', 'Servo MG996R']
            ],
            // Tambahkan lebih banyak data di sini...
        ];

        if ($this->filter === 'all') return $projects;

        return array_filter($projects, fn($p) => $p['category'] === $this->filter);
    }

    public function render()
    {
        return view('livewire.portfolio-gallery', [
            'projects' => $this->projects
        ]);
    }
}
