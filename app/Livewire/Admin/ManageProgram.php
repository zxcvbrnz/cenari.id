<?php

namespace App\Livewire\Admin;

use App\Models\Program;
use App\Models\Instansi;
use App\Models\CoursePackage;
use App\Models\ModulCoursePackage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ManageProgram extends Component
{
    use WithFileUploads;

    public $view = 'program-list';
    public $selectedProgramId;

    // Program Fields
    public $instansi_id, $title, $navigation, $hero_image, $old_hero_image;
    public $accent_color = '#3B82F6', $category = [], $badges = [], $icon;
    public $newCategoryItem, $newBadgeItem;

    // Package Fields
    public $pkg_id, $pkg_name, $pkg_level, $pkg_price, $pkg_description, $pkg_tool, $pkg_count, $pkg_during;

    public function render()
    {
        return view('livewire.admin.manage-program', [
            'programs' => Program::with('instansi')->latest()->get(),
            'instansis' => Instansi::all(),
            'currentProgram' => Program::with('coursePackages.moduls')->find($this->selectedProgramId),
        ]);
    }

    // --- NAVIGATION LOGIC ---
    public function showProgramForm($id = null)
    {
        $this->reset(['selectedProgramId', 'instansi_id', 'title', 'navigation', 'hero_image', 'old_hero_image', 'accent_color', 'category', 'badges']);
        if ($id) {
            $p = Program::findOrFail($id);
            $this->selectedProgramId = $p->id;
            $this->instansi_id = $p->instansi_id;
            $this->title = $p->title;
            $this->navigation = $p->navigation;
            $this->accent_color = $p->accent_color;
            $this->old_hero_image = $p->hero_image;
            $this->category = $p->category ?? [];
            $this->badges = $p->badges ?? [];
        }
        $this->view = 'program-form';
    }

    public function addCategory()
    {
        if ($this->newCategoryItem) {
            if (!in_array($this->newCategoryItem, $this->category)) {
                $this->category[] = $this->newCategoryItem;
            }
            $this->newCategoryItem = '';
        }
    }

    public function removeCategory($index)
    {
        unset($this->category[$index]);
        $this->category = array_values($this->category);
    }

    public function addBadge()
    {
        if ($this->newBadgeItem) {
            if (!in_array($this->newBadgeItem, $this->badges)) {
                $this->badges[] = $this->newBadgeItem;
            }
            $this->newBadgeItem = '';
        }
    }

    public function removeBadge($index)
    {
        unset($this->badges[$index]);
        $this->badges = array_values($this->badges);
    }

    public function showPackageDetail($id)
    {
        $this->selectedProgramId = $id;
        $this->reset(['pkg_id', 'pkg_name', 'pkg_level', 'pkg_price', 'pkg_description', 'pkg_tool', 'pkg_count', 'pkg_during']);
        $this->view = 'package-detail';
    }

    // --- PROGRAM CRUD ---
    public function saveProgram()
    {
        $this->validate([
            'instansi_id' => 'required',
            'title' => 'required',
            'navigation' => 'required',
        ]);

        $data = [
            'instansi_id' => $this->instansi_id,
            'title' => $this->title,
            'slug' => Str::slug($this->title),
            'navigation' => $this->navigation,
            'accent_color' => $this->accent_color,
            'category' => $this->category,
            'badges' => $this->badges,
        ];

        if ($this->hero_image) {
            if ($this->old_hero_image) Storage::disk('public')->delete($this->old_hero_image);
            $data['hero_image'] = $this->hero_image->store('programs', 'public');
        }

        Program::updateOrCreate(['id' => $this->selectedProgramId], $data);

        $this->dispatch('swal:modal', [
            'title' => 'Program Tersimpan!',
            'icon' => 'success',
            'text' => 'Data program ' . $this->title . ' berhasil diperbarui.'
        ]);

        $this->view = 'program-list';
    }

    public function deleteProgram($id)
    {
        $program = Program::find($id);
        if ($program) {
            if ($program->hero_image) {
                Storage::disk('public')->delete($program->hero_image);
            }
            $program->delete();

            $this->dispatch('swal:modal', [
                'title' => 'Program Dihapus',
                'icon' => 'warning',
                'text' => 'Data program telah dihapus secara permanen.'
            ]);
        }
    }

    // --- PACKAGE CRUD ---
    public function editPackage($id)
    {
        $pkg = CoursePackage::findOrFail($id);
        $this->pkg_id = $pkg->id;
        $this->pkg_name = $pkg->name;
        $this->pkg_level = $pkg->level;
        $this->pkg_price = $pkg->price;
        $this->pkg_description = $pkg->description;
        $this->pkg_tool = $pkg->tool;
        $this->pkg_count = $pkg->course_count;
        $this->pkg_during = $pkg->course_during;
    }

    public function savePackage()
    {
        $data = [
            'program_id' => $this->selectedProgramId,
            'name' => $this->pkg_name,
            'slug' => Str::slug($this->pkg_name) . '-' . rand(100, 999),
            'level' => $this->pkg_level,
            'description' => $this->pkg_description,
            'tool' => $this->pkg_tool,
            'course_count' => $this->pkg_count,
            'course_during' => $this->pkg_during,
            'price' => $this->pkg_price,
        ];

        CoursePackage::updateOrCreate(['id' => $this->pkg_id], $data);

        $this->dispatch('swal:modal', [
            'title' => 'Paket Berhasil!',
            'icon' => 'success',
            'text' => 'Detail paket kursus telah diperbarui.'
        ]);

        $this->reset(['pkg_id', 'pkg_name', 'pkg_level', 'pkg_price', 'pkg_description', 'pkg_tool', 'pkg_count', 'pkg_during']);
    }

    public function deletePackage($id)
    {
        CoursePackage::destroy($id);

        $this->dispatch('swal:modal', [
            'title' => 'Paket Dihapus',
            'icon' => 'error',
            'text' => 'Paket kursus telah berhasil dihapus.'
        ]);
    }

    // --- MODUL CRUD ---
    public function addModul($packageId)
    {
        ModulCoursePackage::create([
            'course_package_id' => $packageId,
            'title' => 'Judul Materi Baru',
        ]);

        $this->dispatch('swal:modal', [
            'title' => 'Modul Ditambahkan',
            'icon' => 'success',
            'text' => 'Satu baris materi baru telah dibuat.'
        ]);
    }

    public function updateModul($modulId, $field, $value)
    {
        ModulCoursePackage::where('id', $modulId)->update([$field => $value]);

        $this->dispatch('swal:modal', [
            'title' => 'Modul Diperbarui',
            'icon' => 'success',
            'text' => 'Konten materi berhasil disimpan.'
        ]);
    }

    public function deleteModul($id)
    {
        ModulCoursePackage::destroy($id);

        $this->dispatch('swal:modal', [
            'title' => 'Modul Dihapus',
            'icon' => 'info',
            'text' => 'Materi telah dihapus dari paket ini.'
        ]);
    }
}