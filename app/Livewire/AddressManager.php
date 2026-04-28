<?php

namespace App\Livewire;

use App\Models\UserAddress;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class AddressManager extends Component
{
    public $addresses;
    public $addressId, $recipient_name, $phone_number, $full_address, $postal_code;
    public $province_id, $city_id, $district_id, $village_id;
    public $province, $city, $district, $village;

    // Pastikan ini diinisialisasi sebagai array kosong
    public $provinces = [], $cities = [], $districts = [], $villages = [];
    public $isEditing = false;
    public $showForm = false;

    protected $rules = [
        'recipient_name' => 'required|min:3',
        'phone_number'   => 'required|numeric',
        'full_address'   => 'required',
        'postal_code'    => 'required',
        'province'       => 'required',
        'city'           => 'required',
        'district'       => 'required',
        'village'        => 'required',
    ];

    public function mount()
    {
        $this->loadProvinces();
    }

    private function getApi($url)
    {
        // Menggunakan timeout agar jika API lambat tidak membuat aplikasi hang
        return Http::timeout(10)->withoutVerifying()->get($url);
    }

    public function loadProvinces()
    {
        $response = $this->getApi('https://alamat.thecloudalert.com/api/provinsi/get/');
        $this->provinces = $response->json()['result'] ?? [];
    }

    public function updatedProvinceId($value)
    {
        $this->reset(['city_id', 'district_id', 'village_id', 'cities', 'districts', 'villages', 'city', 'district', 'village']);

        if ($value) {
            $response = $this->getApi("https://alamat.thecloudalert.com/api/kabkota/get/?d_provinsi_id={$value}");
            $this->cities = $response->json()['result'] ?? [];
            $this->province = collect($this->provinces)->firstWhere('id', $value)['text'] ?? '';
        }
    }

    public function updatedCityId($value)
    {
        $this->reset(['district_id', 'village_id', 'districts', 'villages', 'district', 'village']);

        if ($value) {
            $response = $this->getApi("https://alamat.thecloudalert.com/api/kecamatan/get/?d_kabkota_id={$value}");
            $this->districts = $response->json()['result'] ?? [];
            $this->city = collect($this->cities)->firstWhere('id', $value)['text'] ?? '';
        }
    }

    public function updatedDistrictId($value)
    {
        $this->reset(['village_id', 'villages', 'village']);

        if ($value) {
            $response = $this->getApi("https://alamat.thecloudalert.com/api/kelurahan/get/?d_kecamatan_id={$value}");
            $this->villages = $response->json()['result'] ?? [];
            $this->district = collect($this->districts)->firstWhere('id', $value)['text'] ?? '';
        }
    }

    public function updatedVillageId($value)
    {
        if ($value) {
            $this->village = collect($this->villages)->firstWhere('id', $value)['text'] ?? '';
        }
    }

    public function render()
    {
        $this->addresses = Auth::user()->addresses()->latest()->get();
        return view('livewire.address-manager');
    }

    public function resetFields()
    {
        $this->reset([
            'recipient_name',
            'phone_number',
            'full_address',
            'postal_code',
            'province',
            'city',
            'district',
            'village',
            'province_id',
            'city_id',
            'district_id',
            'village_id',
            'cities',
            'districts',
            'villages', // Tambahkan reset array juga
            'addressId',
            'isEditing',
            'showForm'
        ]);
        $this->resetValidation();
    }

    public function saveAddress()
    {
        $validated = $this->validate();

        if ($this->isEditing) {
            UserAddress::find($this->addressId)->update($validated);
            $msg = 'Alamat berhasil diperbarui';
        } else {
            Auth::user()->addresses()->create($validated);
            $msg = 'Alamat baru berhasil ditambahkan';
        }

        $this->resetFields();
        $this->dispatch('swal:modal', [
            'title' => 'Berhasil!',
            'text'  => $msg,
            'icon'  => 'success'
        ]);
    }

    public function edit($id)
    {
        $address = UserAddress::findOrFail($id);
        $this->addressId = $id;
        $this->recipient_name = $address->recipient_name;
        $this->phone_number = $address->phone_number;
        $this->full_address = $address->full_address;
        $this->postal_code = $address->postal_code;

        // 1. Simpan Nama ke Properti
        $this->province = $address->province;
        $this->city = $address->city;
        $this->district = $address->district;
        $this->village = $address->village;

        // 2. Cari ID berdasarkan Nama dari List yang sudah ada (Provinsi sudah di-load di mount)
        $this->province_id = collect($this->provinces)->firstWhere('text', $address->province)['id'] ?? null;

        // 3. Load City secara manual dan cari ID-nya
        if ($this->province_id) {
            $resCity = $this->getApi("https://alamat.thecloudalert.com/api/kabkota/get/?d_provinsi_id={$this->province_id}");
            $this->cities = $resCity->json()['result'] ?? [];
            $this->city_id = collect($this->cities)->firstWhere('text', $address->city)['id'] ?? null;
        }

        // 4. Load District secara manual dan cari ID-nya
        if ($this->city_id) {
            $resDist = $this->getApi("https://alamat.thecloudalert.com/api/kecamatan/get/?d_kabkota_id={$this->city_id}");
            $this->districts = $resDist->json()['result'] ?? [];
            $this->district_id = collect($this->districts)->firstWhere('text', $address->district)['id'] ?? null;
        }

        // 5. Load Village secara manual dan cari ID-nya
        if ($this->district_id) {
            $resVill = $this->getApi("https://alamat.thecloudalert.com/api/kelurahan/get/?d_kecamatan_id={$this->district_id}");
            $this->villages = $resVill->json()['result'] ?? [];
            $this->village_id = collect($this->villages)->firstWhere('text', $address->village)['id'] ?? null;
        }

        $this->isEditing = true;
        $this->showForm = true;
    }

    public function delete($id)
    {
        UserAddress::find($id)->delete();
        $this->dispatch('swal:modal', [
            'title' => 'Dihapus!',
            'text'  => 'Alamat telah dihapus.',
            'icon'  => 'warning'
        ]);
    }
}
