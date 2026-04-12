<?php

namespace App\Livewire;

use App\Models\InstansiTestimoni;
use App\Models\MissingLink;
use App\Models\Program;
use Livewire\Component;

class DetailProgram extends Component
{
    public $slug;
    public $program;
    public $missingLink;
    public $testimonials;
    public $galleryImages;

    public function mount($slug)
    {
        $this->slug = $slug;
        // Mengambil data dari Database berdasarkan slug
        $this->program = Program::with(['coursePackages.moduls'])
            ->where('slug', $slug)
            ->first();

        if (!$this->program) {
            abort(404);
        }

        $this->missingLink = MissingLink::inRandomOrder()->first();

        // $this->testimonials = InstansiTestimoni::all();

        // $this->testimonials = collect([
        //     (object) [
        //         'id' => 1,
        //         'name' => 'Ahmad Fauzi',
        //         'role' => 'Orang Tua Siswa',
        //         'avatar' => null, // Bisa diisi URL foto jika ada
        //         'content' => 'Anak saya jadi lebih antusias belajar logika sejak ikut kursus robotik di sini. Kurikulumnya sangat terstruktur.',
        //         'rating' => 5
        //     ],
        //     (object) [
        //         'id' => 2,
        //         'name' => 'Siti Aminah',
        //         'role' => 'Mahasiswa IT',
        //         'avatar' => null,
        //         'content' => 'Materi web development-nya sangat praktis. Sangat membantu saya dalam memahami framework Laravel secara mendalam.',
        //         'rating' => 5
        //     ],
        //     (object) [
        //         'id' => 3,
        //         'name' => 'Budi Santoso',
        //         'role' => 'Siswa SMA',
        //         'avatar' => null,
        //         'content' => 'Instrukturnya sangat sabar menjelaskan materi IoT yang cukup kompleks menjadi jauh lebih mudah dipahami.',
        //         'rating' => 5
        //     ],
        //     (object) [
        //         'id' => 4,
        //         'name' => 'Rina Wijaya',
        //         'role' => 'Instruktur',
        //         'avatar' => null,
        //         'content' => 'Fasilitas lab yang disediakan sangat menunjang kreativitas siswa dalam mengerjakan proyek-proyek inovatif.',
        //         'rating' => 5
        //     ],
        // ]);

        // Simulasi data Gallery
        // Nantinya tinggal diganti: $this->galleryImages = Gallery::where('program_id', $this->program->id)->get();
        // $this->galleryImages = collect([
        //     (object) ['id' => 1, 'url' => 'https://images.unsplash.com/photo-1561557944-6e7860d1a7eb?auto=format&fit=crop&q=80', 'caption' => 'Kegiatan Belajar'],
        //     (object) ['id' => 2, 'url' => 'https://images.unsplash.com/photo-1531297484001-80022131f5a1?auto=format&fit=crop&q=80', 'caption' => 'Lab Komputer'],
        //     (object) ['id' => 3, 'url' => 'https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?auto=format&fit=crop&q=80', 'caption' => 'Proyek Robotik'],
        //     (object) ['id' => 4, 'url' => 'https://images.unsplash.com/photo-1517048676732-d65bc937f952?auto=format&fit=crop&q=80', 'caption' => 'Diskusi Kelompok'],
        //     (object) ['id' => 5, 'url' => 'https://images.unsplash.com/photo-1485827404703-89b55fcc595e?auto=format&fit=crop&q=80', 'caption' => 'Showcase Proyek'],
        // ]);
    }

    public function render()
    {
        return view('livewire.detail-program');
    }
}
