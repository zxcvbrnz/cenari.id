<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Quote;

class ManageQuotes extends Component
{
    public $content, $author, $source, $selectedId;
    public $view = 'form'; // Set default langsung ke form karena tidak ada list

    public function mount()
    {
        // Ambil data pertama atau buat jika belum ada (agar tidak error)
        $quote = Quote::first();

        if (!$quote) {
            $quote = Quote::create([
                'content' => 'The future belongs to those who learn more skills...',
                'author' => 'Robert Greene',
                'source' => 'Mastery'
            ]);
        }

        $this->selectedId = $quote->id;
        $this->content = $quote->content;
        $this->author = $quote->author;
        $this->source = $quote->source;
    }

    public function save()
    {
        $this->validate([
            'content' => 'required|string',
            'author' => 'required|string|max:255',
        ]);

        // Selalu update ID yang sama
        Quote::where('id', $this->selectedId)->update([
            'content' => $this->content,
            'author' => $this->author,
            'source' => $this->source,
        ]);

        $this->dispatch('swal:modal', [
            'title' => 'Berhasil!',
            'icon' => 'success',
            'text' => 'Quote Utama Berhasil Diperbarui'
        ]);
    }

    // Hapus method delete dan showForm karena tidak diperlukan lagi

    public function render()
    {
        return view('livewire.admin.manage-quotes');
    }
}
