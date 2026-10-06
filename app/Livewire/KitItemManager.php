<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use App\Models\KitRobotic;
use App\Models\Item;
use App\Models\Souvenir;
use App\Models\Modul;
use App\Models\KitRoboticImage;
use App\Models\ItemImage;
use App\Models\SouvenirImage;
use Illuminate\Support\Facades\Storage;

class KitItemManager extends Component
{
    use WithFileUploads, WithPagination;

    public $view = 'list'; // 'list', 'kit-form', 'item-form', 'souvenir-form'
    public $search = '';

    // Form Souvenir
    public $souvenir_id, $s_name, $s_price, $s_stock, $s_description;
    public $s_new_images = [];

    // Form Kit
    public $kit_id, $k_name, $k_discount = 0, $k_description;
    public $k_pelatihan_price, $k_private_price;
    public $k_new_images = [];

    // Form Item
    public $item_id, $i_name, $i_price, $i_stock, $i_description;
    public $i_new_images = [];

    // Modul & Selected Items (pivot Kit - Item)
    public $modul_name, $modul_price, $modul_file, $existing_modul_file;
    public $selectedItems = [];

    public function updatingSearch()
    {
        $this->resetPage('kitsPage');
        $this->resetPage('itemsPage');
        $this->resetPage('souvenirsPage');
    }

    public function render()
    {
        $searchTerm = '%' . $this->search . '%';

        return view('livewire.kit-item-manager', [
            'kits' => KitRobotic::with(['items', 'moduls', 'images'])
                ->where('name', 'like', $searchTerm)
                ->orWhere('description', 'like', $searchTerm)
                ->latest()
                ->paginate(5, ['*'], 'kitsPage'),

            'items' => Item::with('images')
                ->where('name', 'like', $searchTerm)
                ->orWhere('description', 'like', $searchTerm)
                ->latest()
                ->paginate(5, ['*'], 'itemsPage'),

            'souvenirs' => Souvenir::with('images')
                ->where('name', 'like', $searchTerm)
                ->orWhere('description', 'like', $searchTerm)
                ->latest()
                ->paginate(5, ['*'], 'souvenirsPage'),

            'allItems' => Item::all(),
        ]);
    }

    public function setView($view)
    {
        $this->resetInput();
        $this->view = $view;
    }

    public function resetInput()
    {
        $this->kit_id = null;
        $this->k_name = '';
        $this->k_discount = 0;
        $this->k_description = '';
        $this->k_pelatihan_price = null;
        $this->k_private_price = null;
        $this->k_new_images = [];

        $this->item_id = null;
        $this->i_name = '';
        $this->i_price = null;
        $this->i_stock = null;
        $this->i_description = '';
        $this->i_new_images = [];

        $this->souvenir_id = null;
        $this->s_name = '';
        $this->s_price = null;
        $this->s_stock = null;
        $this->s_description = '';
        $this->s_new_images = [];

        $this->modul_name = '';
        $this->modul_price = null;
        $this->modul_file = null;
        $this->existing_modul_file = null;
        $this->selectedItems = [];
    }

    // ==================== SOUVENIR HANDLERS ====================

    public function openSouvenirEdit($id)
    {
        $this->resetInput();
        $souvenir = Souvenir::with('images')->findOrFail($id);
        $this->souvenir_id = $souvenir->id;
        $this->s_name = $souvenir->name;
        $this->s_price = $souvenir->price ? round((float) $souvenir->price) : null;
        $this->s_stock = $souvenir->stock;
        $this->s_description = $souvenir->description;
        $this->view = 'souvenir-form';
    }

    public function saveSouvenir()
    {
        $this->validate([
            's_name' => 'required|string|max:255',
            's_price' => 'required|numeric',
            's_stock' => 'required|integer',
            's_new_images.*' => 'nullable|image|max:2048',
        ]);

        $souvenir = Souvenir::updateOrCreate(['id' => $this->souvenir_id], [
            'name' => $this->s_name,
            'price' => round((float) $this->s_price),
            'stock' => $this->s_stock,
            'description' => $this->s_description,
        ]);

        if (!empty($this->s_new_images)) {
            foreach ($this->s_new_images as $image) {
                $path = $image->store('souvenirs', 'public');
                SouvenirImage::create([
                    'souvenir_id' => $souvenir->id,
                    'image_path' => $path,
                ]);
            }
        }

        session()->flash('message', 'Souvenir berhasil disimpan.');
        $this->setView('list');
    }

    public function deleteSouvenir($id)
    {
        $souvenir = Souvenir::with('images')->findOrFail($id);
        foreach ($souvenir->images as $img) {
            Storage::disk('public')->delete($img->image_path);
            $img->delete();
        }
        $souvenir->delete();
        session()->flash('message', 'Souvenir berhasil dihapus.');
    }

    public function deleteSouvenirImage($imageId)
    {
        $img = SouvenirImage::findOrFail($imageId);
        Storage::disk('public')->delete($img->image_path);
        $img->delete();
        session()->flash('message', 'Gambar souvenir dihapus.');
    }

    // ==================== ITEM HANDLERS ====================

    public function openItemEdit($id)
    {
        $this->resetInput();
        $item = Item::with('images')->findOrFail($id);
        $this->item_id = $item->id;
        $this->i_name = $item->name;
        $this->i_price = $item->price ? round((float) $item->price) : null;
        $this->i_stock = $item->stock;
        $this->i_description = $item->description;
        $this->view = 'item-form';
    }

    public function saveItem()
    {
        $this->validate([
            'i_name' => 'required|string|max:255',
            'i_price' => 'required|numeric',
            'i_stock' => 'required|integer',
            'i_new_images.*' => 'nullable|image|max:2048',
        ]);

        $item = Item::updateOrCreate(['id' => $this->item_id], [
            'name' => $this->i_name,
            'price' => round((float) $this->i_price),
            'stock' => $this->i_stock,
            'description' => $this->i_description,
        ]);

        if (!empty($this->i_new_images)) {
            foreach ($this->i_new_images as $image) {
                $path = $image->store('items', 'public');
                ItemImage::create([
                    'item_id' => $item->id,
                    'image_path' => $path,
                ]);
            }
        }

        session()->flash('message', 'Item berhasil disimpan.');
        $this->setView('list');
    }

    public function deleteItem($id)
    {
        $item = Item::with('images')->findOrFail($id);
        foreach ($item->images as $img) {
            Storage::disk('public')->delete($img->image_path);
            $img->delete();
        }
        $item->delete();
        session()->flash('message', 'Item berhasil dihapus.');
    }

    public function deleteItemImage($imageId)
    {
        $img = ItemImage::findOrFail($imageId);
        Storage::disk('public')->delete($img->image_path);
        $img->delete();
        session()->flash('message', 'Gambar item dihapus.');
    }

    // ==================== KIT HANDLERS ====================

    public function openKitEdit($id)
    {
        $this->resetInput();
        $kit = KitRobotic::with(['items', 'moduls', 'images'])->findOrFail($id);
        $this->kit_id = $kit->id;
        $this->k_name = $kit->name;
        $this->k_discount = $kit->discount ?? 0;
        $this->k_description = $kit->description;
        $this->k_pelatihan_price = $kit->pelatihan_price ? round((float) $kit->pelatihan_price) : null;
        $this->k_private_price = $kit->private_price ? round((float) $kit->private_price) : null;

        foreach ($kit->items as $item) {
            $this->selectedItems[] = [
                'id' => $item->id,
                'name' => $item->name,
                'price' => $item->price,
                'quantity' => $item->pivot->quantity
            ];
        }

        if ($kit->moduls) {
            $this->modul_name = $kit->moduls->name;
            $this->modul_price = $kit->moduls->price ? round((float) $kit->moduls->price) : null;
            $this->existing_modul_file = $kit->moduls->file;
        }

        $this->view = 'kit-form';
    }

    public function addItemToKit($itemId)
    {
        $item = Item::find($itemId);
        if (!$item) return;

        foreach ($this->selectedItems as $selected) {
            if ($selected['id'] == $itemId) return;
        }

        $this->selectedItems[] = [
            'id' => $item->id,
            'name' => $item->name,
            'price' => $item->price,
            'quantity' => 1
        ];
    }

    public function removeItemFromKit($index)
    {
        unset($this->selectedItems[$index]);
        $this->selectedItems = array_values($this->selectedItems);
    }

    public function saveKit()
    {
        $this->validate([
            'k_name' => 'required|string|max:255',
            'k_pelatihan_price' => 'nullable|numeric',
            'k_private_price' => 'nullable|numeric',
            'k_new_images.*' => 'nullable|image|max:2048',
            'modul_file' => 'nullable|file|mimes:pdf,docx,zip|max:10240',
        ]);

        $kit = KitRobotic::updateOrCreate(['id' => $this->kit_id], [
            'name' => $this->k_name,
            'discount' => $this->k_discount ?? 0,
            'description' => $this->k_description,
            'pelatihan_price' => $this->k_pelatihan_price ? round((float) $this->k_pelatihan_price) : null,
            'private_price' => $this->k_private_price ? round((float) $this->k_private_price) : null,
        ]);

        // Sync Items Pivot
        $syncData = [];
        foreach ($this->selectedItems as $item) {
            $syncData[$item['id']] = ['quantity' => $item['quantity']];
        }
        $kit->items()->sync($syncData);

        // Modul Handler
        if ($this->modul_name) {
            $filePath = $this->existing_modul_file;
            if ($this->modul_file) {
                if ($filePath) Storage::disk('public')->delete($filePath);
                $filePath = $this->modul_file->store('moduls', 'public');
            }

            Modul::updateOrCreate(['kit_robotic_id' => $kit->id], [
                'name' => $this->modul_name,
                'price' => $this->modul_price ? round((float) $this->modul_price) : 0,
                'file' => $filePath,
            ]);
        }

        // Multiple Images
        if (!empty($this->k_new_images)) {
            foreach ($this->k_new_images as $image) {
                $path = $image->store('kits', 'public');
                KitRoboticImage::create([
                    'kit_robotic_id' => $kit->id,
                    'image_path' => $path,
                ]);
            }
        }

        session()->flash('message', 'Kit Robotic berhasil disimpan.');
        $this->setView('list');
    }

    public function deleteKit($id)
    {
        $kit = KitRobotic::with(['images', 'moduls'])->findOrFail($id);

        foreach ($kit->images as $img) {
            Storage::disk('public')->delete($img->image_path);
            $img->delete();
        }

        if ($kit->moduls) {
            Storage::disk('public')->delete($kit->moduls->file);
            $kit->moduls->delete();
        }

        $kit->items()->detach();
        $kit->delete();

        session()->flash('message', 'Kit Robotic berhasil dihapus.');
    }

    public function deleteKitImage($imageId)
    {
        $img = KitRoboticImage::findOrFail($imageId);
        Storage::disk('public')->delete($img->image_path);
        $img->delete();
        session()->flash('message', 'Gambar kit dihapus.');
    }
}
