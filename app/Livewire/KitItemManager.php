<?php

namespace App\Livewire;

use App\Models\Item;
use App\Models\ItemImage;
use App\Models\KitRobotic;
use App\Models\KitRoboticImage;
use App\Models\KitRoboticModul;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class KitItemManager extends Component
{
    use WithFileUploads;

    public $activeTab = 'kit';
    public $view = 'index';

    // Data Binding - KIT ROBOTIC
    public $kit_id, $k_name, $k_discount, $k_description, $k_pelatihan_price, $k_private_price;
    public $new_images_kit = [];
    public $modul_name, $modul_file, $modul_price;
    public $existing_modul_file;

    // Search & Add Items
    public $searchItem = '';
    public $selectedItems = [];

    // Data Binding - ITEM COMPONENT
    public $item_id, $i_name, $i_price, $i_description;
    public $new_images_item = [];

    public function render()
    {
        $searchResults = [];

        // Logika: Jika search kosong, tampilkan semua (rekomendasi), jika ada teks, gunakan LIKE
        $query = Item::whereNotIn('id', collect($this->selectedItems)->pluck('id'));

        if (strlen($this->searchItem) > 0) {
            $query->where('name', 'like', '%' . $this->searchItem . '%');
        }

        $searchResults = $query->take(10)->get();

        return view('livewire.kit-item-manager', [
            'kits' => KitRobotic::with(['items', 'images', 'moduls'])->get(),
            'all_items' => Item::with('images')->get(),
            'searchResults' => $searchResults
        ]);
    }

    public function addItem($id)
    {
        $item = Item::find($id);
        if ($item) {
            $this->selectedItems[] = ['id' => $item->id, 'name' => $item->name, 'price' => $item->price];
        }
        $this->searchItem = '';
    }

    public function removeItem($index)
    {
        unset($this->selectedItems[$index]);
        $this->selectedItems = array_values($this->selectedItems);
    }

    public function setTab($tab)
    {
        $this->activeTab = $tab;
        $this->view = 'index';
    }
    public function openKitCreate()
    {
        $this->resetInput();
        $this->view = 'kit-form';
    }
    public function openItemCreate()
    {
        $this->resetInput();
        $this->view = 'item-form';
    }

    public function openKitEdit($id)
    {
        $this->resetInput();
        $kit = KitRobotic::with(['items', 'moduls', 'images'])->findOrFail($id);
        $this->kit_id = $kit->id;
        $this->k_name = $kit->name;
        $this->k_discount = $kit->discount;
        $this->k_description = $kit->description;
        $this->k_pelatihan_price = (float) $kit->pelatihan_price;
        $this->k_private_price = (float) $kit->private_price;

        foreach ($kit->items as $item) {
            $this->selectedItems[] = ['id' => $item->id, 'name' => $item->name, 'price' => $item->price, 'quantity' => $item->pivot->quantity];
        }

        if ($kit->moduls) {
            $this->modul_name = $kit->moduls->name;
            $this->modul_price = $kit->moduls->price;
            $this->existing_modul_file = $kit->moduls->file;
        }
        $this->view = 'kit-form';
    }

    public function openItemEdit($id)
    {
        $this->resetInput();
        $item = Item::with('images')->findOrFail($id);
        $this->item_id = $item->id;
        $this->i_name = $item->name;
        $this->i_price = (float) $item->price;
        $this->i_description = $item->description;
        $this->view = 'item-form';
    }

    public function backToIndex()
    {
        $this->view = 'index';
        $this->resetInput();
    }

    public function saveKit()
    {
        $this->validate(['k_name' => 'required']);

        $kit = KitRobotic::updateOrCreate(['id' => $this->kit_id], [
            'name' => $this->k_name,
            'discount' => $this->k_discount ?? 0,
            'description' => $this->k_description,
            'pelatihan_price' => $this->k_pelatihan_price ? round($this->k_pelatihan_price, 2) : null,
            'private_price' => $this->k_private_price ? round($this->k_private_price, 2) : null,
        ]);

        // $kit->items()->sync(collect($this->selectedItems)->pluck('id'));

        $syncData = [];
        foreach ($this->selectedItems as $item) {
            $syncData[$item['id']] = [
                'quantity' => $item['quantity']
            ];
        }

        $kit->items()->sync($syncData);

        if ($this->new_images_kit) {
            foreach ($this->new_images_kit as $image) {
                KitRoboticImage::create([
                    'kit_robotic_id' => $kit->id,
                    'filename' => $image->store('kit-images', 'public')
                ]);
            }
        }

        if ($this->modul_name || $this->modul_file) {
            $dataModul = [
                'name' => $this->modul_name ?? 'Modul ' . $this->k_name,
                'price' => $this->modul_price ?? 0
            ];
            if ($this->modul_file) {
                if ($kit->moduls && $kit->moduls->file) Storage::disk('public')->delete($kit->moduls->file);
                $dataModul['file'] = $this->modul_file->store('kit-moduls', 'public');
            }
            $kit->moduls()->updateOrCreate(['kit_robotic_id' => $kit->id], $dataModul);
        }

        $this->dispatch('swal:modal', ['title' => 'Berhasil!', 'icon' => 'success', 'text' => 'Data Kit Berhasil Disimpan']);
        $this->backToIndex();
    }

    public function saveItem()
    {
        $this->validate(['i_name' => 'required', 'i_price' => 'required']);
        $item = Item::updateOrCreate(['id' => $this->item_id], [
            'name' => $this->i_name,
            'price' => round($this->i_price, 2),
            'description' => $this->i_description,
        ]);

        if ($this->new_images_item) {
            foreach ($this->new_images_item as $image) {
                ItemImage::create([
                    'item_id' => $item->id,
                    'filename' => $image->store('item-images', 'public')
                ]);
            }
        }
        $this->backToIndex();
    }

    public function deleteKit($id)
    {
        KitRobotic::find($id)->delete();
    }
    public function deleteItem($id)
    {
        Item::find($id)->delete();
    }
    public function deleteImageKit($id)
    {
        $img = KitRoboticImage::find($id);
        Storage::disk('public')->delete($img->filename);
        $img->delete();
    }
    public function deleteImageItem($id)
    {
        $img = ItemImage::find($id);
        Storage::disk('public')->delete($img->filename);
        $img->delete();
    }

    private function resetInput()
    {
        $this->reset([
            'kit_id',
            'k_name',
            'k_discount',
            'k_description',
            'k_pelatihan_price',
            'k_private_price',
            'selectedItems',
            'new_images_kit',
            'modul_name',
            'modul_file',
            'modul_price',
            'item_id',
            'i_name',
            'i_price',
            'i_description',
            'new_images_item',
            'searchItem',
            'existing_modul_file'
        ]);
    }
}