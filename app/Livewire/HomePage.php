<?php

namespace App\Livewire;

use App\Models\Agenda;
use App\Models\Collaboration;
use App\Models\Program;
use App\Models\Quote;
use App\Models\Workshop;
use Livewire\Component;

class HomePage extends Component
{

    public $programs;
    public $seminars;
    public $events;
    public $selected = [];
    public $simulatorResult = null;
    public $partners;
    public $featuredQuote;
    public $posts;

    public $text = "Cenari ID adalah lembaga pendidikan teknologi terapan terdepan di Banjarmasin yang berkomitmen menjembatani dunia imajinasi digital dan realitas industri. Melalui program pelatihan intensif, ekosistem pembelajaran interaktif, dan kemitraan strategis, kami membekali generasi muda dengan keahlian teknis nyata yang siap kerja dan relevan terhadap perkembangan global.";

    public $stats = [
        [
            // Ikon Kalender / Jam
            'svg_path' => 'M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z',
            'title' => 'Didirikan Sejak',
            'value' => '2020'
        ],
        [
            // Ikon Toga / Kelulusan
            'svg_path' => 'M4.26 10.174c-.04-.224-.063-.458-.063-.694 0-2.485 3.582-4.5 8-4.5s8 2.015 8 4.5c0 .236-.022.47-.063.694m-15.874 0C2.07 10.593 1.5 11.254 1.5 12c0 1.18 1.43 2.14 3.44 2.418a14.24 14.24 0 0 0 14.12 0c2.01-.278 3.44-1.238 3.44-2.418 0-.746-.57-1.407-1.426-1.826M4.26 10.174a9.96 9.96 0 0 0 15.48 0M12 15.75v3m-3.75 0h7.5',
            'title' => 'Total Lulusan',
            'value' => '1.500+ Alumni'
        ],
        [
            // Ikon Bangunan Sekolah / Akademi
            'svg_path' => 'M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0 0 12 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75Z',
            'title' => 'Mitra Sekolah',
            'value' => '25 Sekolah'
        ],
        [
            // Ikon Tas Kerja / Kemitraan
            'svg_path' => 'M20.25 14.15v4.25c0 .414-.336.75-.75.75H4.5a.75.75 0 0 1-.75-.75v-4.25m16.5 0a3 3 0 0 0-3-3H6.75a3 3 0 0 0-3 3m16.5 0M3.75 14.15A3 3 0 0 1 6.75 11.15h10.5a3 3 0 0 1 3 3m-16.5 0-1.25-5.023A.75.75 0 0 1 3.73 8.25h16.54a.75.75 0 0 1 .73.877l-1.25 5.023M9 8.25v-1.5A2.25 2.25 0 0 1 11.25 4.5h1.5A2.25 2.25 0 0 1 15 6.75v1.5',
            'title' => 'Kemitraan Kerja',
            'value' => '40+ Perusahaan'
        ]
    ];

    public function mount()
    {
        $this->programs = Program::all();
        $this->seminars = Workshop::all();
        $this->events = Agenda::all();
        $this->posts = \App\Models\Post::with('featuredImage')
            ->where('is_published', true)
            ->latest()
            ->take(3)
            ->get();
        $this->partners = Collaboration::where('is_active', true)->orderBy('sort_order')->get();
        $this->featuredQuote = Quote::where('is_featured', true)->first()
            ?? Quote::latest()->first();
    }

    public function toggleChoice($choice)
    {
        // Jika sudah ada di array, hapus (toggle off)
        if (in_array($choice, $this->selected)) {
            $this->selected = array_diff($this->selected, [$choice]);
        }
        // Jika belum ada dan masih kurang dari 2, tambahkan
        elseif (count($this->selected) < 2) {
            $this->selected[] = $choice;
        }

        // Hitung hasil jika sudah memilih tepat 2
        $this->calculate();
    }

    private function calculate()
    {
        if (count($this->selected) < 2) {
            $this->simulatorResult = null;
            return;
        }

        // Logika Kombinasi: A (Visual), B (Logika), C (Mekanik)
        if (in_array('A', $this->selected) && in_array('B', $this->selected)) {
            $this->simulatorResult = "Web Programming";
        } elseif (in_array('A', $this->selected) && in_array('C', $this->selected)) {
            $this->simulatorResult = "Arsitektur + Smart Home";
        } elseif (in_array('B', $this->selected) && in_array('C', $this->selected)) {
            $this->simulatorResult = "Robotik & IoT";
        }
    }

    public function render()
    {
        return view('livewire.home-page');
    }
}
