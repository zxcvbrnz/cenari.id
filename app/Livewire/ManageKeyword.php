<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\KeyWord;

class ManageKeyword extends Component
{
    public $keyword;
    public $description;

    public function mount()
    {
        // Ambil data pertama dari database
        $data = KeyWord::first();

        if ($data) {
            $this->keyword = $data->keyword;
            $this->description = $data->description;
        }
    }

    public function save()
    {
        $this->validate([
            'keyword'     => 'nullable|string|max:255',
            'description' => 'nullable|string|max:1000',
        ]);

        // Simpan atau update record pertama
        KeyWord::updateOrCreate(
            ['id' => 1], // Mengunci ke record ID 1 (single data)
            [
                'keyword'     => $this->keyword,
                'description' => $this->description,
            ]
        );

        session()->flash('success', 'Keyword dan description berhasil diperbarui.');
    }

    public function render()
    {
        return view('livewire.manage-keyword');
    }
}
