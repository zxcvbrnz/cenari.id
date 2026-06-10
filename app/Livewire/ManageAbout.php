<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\AboutUs;
use App\Models\BusinessLine;
use App\Models\Stat;
use Illuminate\Support\Facades\Storage;

class ManageAbout extends Component
{
    use WithFileUploads;

    // Properti Form About Us
    public $aboutId, $homepage_text, $text_1, $text_2, $image_1, $image_2, $pdf_url, $video_url;
    public $new_image_1, $new_image_2, $new_pdf; // Sementara penampung upload

    // Properti Manajerial Data Jamak (Lini Bisnis & Stats)
    public $businessLines = [], $stats = [];

    // Properti Form Input Tambah/Edit Data Jamak
    public $business_id, $business_name, $business_description, $business_link;
    public $stat_id, $stat_svg_path, $stat_title, $stat_value;

    public function mount()
    {
        $this->loadAboutData();
        $this->loadSecondaryData();
    }

    public function loadAboutData()
    {
        $about = AboutUs::first();
        if ($about) {
            $this->aboutId = $about->id;
            $this->homepage_text = $about->homepage_text;
            $this->text_1 = $about->text_1;
            $this->text_2 = $about->text_2;
            $this->image_1 = $about->image_1;
            $this->image_2 = $about->image_2;
            $this->pdf_url = $about->pdf_url;
            $this->video_url = $about->video_url;
        }
    }

    public function loadSecondaryData()
    {
        $this->businessLines = BusinessLine::latest()->get();
        $this->stats = Stat::latest()->get();
    }

    // --- PROSES SIMPAN DATA TUNGGAL (ABOUT US) ---
    public function saveAbout()
    {
        $this->validate([
            'homepage_text' => 'required',
            'text_1' => 'required',
            'text_2' => 'required',
            'video_url' => 'required',
            'new_image_1' => 'nullable|image|max:2048',
            'new_image_2' => 'nullable|image|max:2048',
            'new_pdf' => 'nullable|mimes:pdf|max:5120',
        ]);

        $data = [
            'homepage_text' => $this->homepage_text,
            'text_1' => $this->text_1,
            'text_2' => $this->text_2,
            'video_url' => $this->video_url,
        ];

        // Handle uploads jika ada file baru
        if ($this->new_image_1) {
            if ($this->image_1) Storage::disk('public')->delete($this->image_1);
            $data['image_1'] = $this->new_image_1->store('about', 'public');
        }
        if ($this->new_image_2) {
            if ($this->image_2) Storage::disk('public')->delete($this->image_2);
            $data['image_2'] = $this->new_image_2->store('about', 'public');
        }
        if ($this->new_pdf) {
            if ($this->pdf_url) Storage::disk('public')->delete($this->pdf_url);
            $data['pdf_url'] = $this->new_pdf->store('documents', 'public');
        }

        // Operasi Upsert (Update or Create)
        AboutUs::updateOrCreate(['id' => $this->aboutId], $data);

        $this->new_image_1 = $this->new_image_2 = $this->new_pdf = null;
        $this->loadAboutData();

        session()->flash('success', 'Data Profile Utama Berhasil Diperbarui!');
    }

    // --- PROSES CRUD BUSINESS LINES ---
    public function saveBusinessLine()
    {
        $this->validate([
            'business_name' => 'required|string|max:255',
            'business_description' => 'required',
            'business_link' => 'nullable|url',
        ]);

        BusinessLine::updateOrCreate(
            ['id' => $this->business_id],
            ['name' => $this->business_name, 'description' => $this->business_description, 'link' => $this->business_link]
        );

        $this->resetBusinessForm();
        $this->loadSecondaryData();
    }

    public function editBusinessLine($id)
    {
        $bl = BusinessLine::find($id);
        $this->business_id = $bl->id;
        $this->business_name = $bl->name;
        $this->business_description = $bl->description;
        $this->business_link = $bl->link;
    }

    public function deleteBusinessLine($id)
    {
        BusinessLine::destroy($id);
        $this->loadSecondaryData();
    }

    public function resetBusinessForm()
    {
        $this->reset(['business_id', 'business_name', 'business_description', 'business_link']);
    }

    // --- PROSES CRUD STATS ---
    public function saveStat()
    {
        $this->validate([
            'stat_svg_path' => 'required',
            'stat_title' => 'required|string|max:255',
            'stat_value' => 'required|string|max:255',
        ]);

        Stat::updateOrCreate(
            ['id' => $this->stat_id],
            ['svg_path' => $this->stat_svg_path, 'title' => $this->stat_title, 'value' => $this->stat_value]
        );

        $this->resetStatForm();
        $this->loadSecondaryData();
    }

    public function editStat($id)
    {
        $st = Stat::find($id);
        $this->stat_id = $st->id;
        $this->stat_svg_path = $st->svg_path;
        $this->stat_title = $st->title;
        $this->stat_value = $st->value;
    }

    public function deleteStat($id)
    {
        Stat::destroy($id);
        $this->loadSecondaryData();
    }

    public function resetStatForm()
    {
        $this->reset(['stat_id', 'stat_svg_path', 'stat_title', 'stat_value']);
    }

    public function render()
    {
        return view('livewire.manage-about');
    }
}