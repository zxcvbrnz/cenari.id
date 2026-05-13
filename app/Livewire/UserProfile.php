<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class UserProfile extends Component
{
    // Akun & Keamanan
    public $email, $current_password, $new_password, $new_password_confirmation;

    // Identitas Pribadi
    public $name, $nik, $gender, $born_place, $born_date = '', $whatsapp;
    public $last_education, $current_status, $nama_ayah, $nama_ibu, $nisn, $agama;
    public $jenis_tinggal, $alat_transportasi;

    // Alamat & Lokasi
    public $address, $rt, $rw, $kodepos, $provinsi, $kab_kota, $kecamatan, $kelurahan;

    // API State
    public $list_provinsi = [], $list_kabupaten = [], $list_kecamatan = [], $list_kelurahan = [];

    public function mount()
    {
        $user = User::find(Auth::id());
        if (!$user) return redirect()->route('login');

        if ($user->born_date) {
            $this->born_date = $user->born_date->format('Y-m-d');
        }

        // Mapping Data dari Database
        $this->email = $user->email;
        $this->name = $user->name;
        $this->nik = $user->nik;
        $this->gender = $user->gender;
        $this->born_place = $user->born_place;
        $this->whatsapp = $user->whatsapp;
        $this->last_education = $user->last_education;
        $this->current_status = $user->current_status;
        $this->nama_ayah = $user->nama_ayah;
        $this->nama_ibu = $user->nama_ibu;
        $this->nisn = $user->nisn;
        $this->agama = $user->agama;
        $this->jenis_tinggal = $user->jenis_tinggal;
        $this->alat_transportasi = $user->alat_transportasi;
        $this->address = $user->address;
        $this->rt = $user->rt;
        $this->rw = $user->rw;
        $this->kodepos = $user->kodepos;
        $this->provinsi = $user->provinsi;
        $this->kab_kota = $user->kab_kota;
        $this->kecamatan = $user->kecamatan;
        $this->kelurahan = $user->kelurahan;

        $this->fetchProvinsi();
        // Load data dropdown jika user sudah punya data alamat sebelumnya
        if ($this->provinsi) $this->fetchKabupaten();
        if ($this->kab_kota) $this->fetchKecamatan();
        if ($this->kecamatan) $this->fetchKelurahan();
    }

    /** Logic API dengan SSL Bypass **/
    private function getApi($url)
    {
        return Http::withoutVerifying()->get($url);
    }

    public function fetchProvinsi()
    {
        $response = $this->getApi("https://alamat.thecloudalert.com/api/provinsi/get/");
        $this->list_provinsi = $response->json()['result'] ?? [];
    }

    public function updatedProvinsi($value)
    {
        sleep(1);
        $this->reset(['kab_kota', 'kecamatan', 'kelurahan', 'list_kabupaten', 'list_kecamatan', 'list_kelurahan']);
        if ($value) $this->fetchKabupaten();
    }

    public function fetchKabupaten()
    {
        $id_provinsi = explode('-', $this->provinsi)[0];
        $response = $this->getApi("https://alamat.thecloudalert.com/api/kabkota/get/?d_provinsi_id={$id_provinsi}");
        $this->list_kabupaten = $response->json()['result'] ?? [];
    }

    public function updatedKabKota($value)
    {
        sleep(1);
        $this->reset(['kecamatan', 'kelurahan', 'list_kecamatan', 'list_kelurahan']);
        if ($value) $this->fetchKecamatan();
    }

    public function fetchKecamatan()
    {
        $id_kabkota = explode('-', $this->kab_kota)[0];
        $response = $this->getApi("https://alamat.thecloudalert.com/api/kecamatan/get/?d_kabkota_id={$id_kabkota}");
        $this->list_kecamatan = $response->json()['result'] ?? [];
    }

    public function updatedKecamatan($value)
    {
        sleep(1);
        $this->reset(['kelurahan', 'list_kelurahan']);
        if ($value) $this->fetchKelurahan();
    }

    public function fetchKelurahan()
    {
        $id_kecamatan = explode('-', $this->kecamatan)[0];
        $response = $this->getApi("https://alamat.thecloudalert.com/api/kelurahan/get/?d_kecamatan_id={$id_kecamatan}");
        $this->list_kelurahan = $response->json()['result'] ?? [];
    }

    /** Simpan Akun (Email & Password) **/
    public function updateAccount()
    {
        $rules = [
            'email' => ['required', 'email', Rule::unique('users')->ignore(Auth::id())],
        ];

        if ($this->new_password) {
            $rules['current_password'] = 'required';
            $rules['new_password'] = 'required|min:8|confirmed';
        }

        $this->validate($rules);

        $user = User::find(Auth::id());

        // Cek password lama jika user ingin ganti password
        if ($this->new_password) {
            if (!Hash::check($this->current_password, $user->password)) {
                throw ValidationException::withMessages(['current_password' => 'Password lama tidak sesuai.']);
            }
            $user->password = Hash::make($this->new_password);
        }

        $user->email = $this->email;
        $user->save();

        $this->reset(['current_password', 'new_password', 'new_password_confirmation']);
        $this->dispatch('swal:modal', [
            'title' => 'Data Akun Diperbarui',
            'icon' => 'success',
            'text' => 'Data akun telah diperbarui!'
        ]);
    }

    /** Simpan Profil Lengkap **/
    public function updateProfile()
    {
        $validated = $this->validate([
            // Informasi Pribadi
            'name' => 'required|string|max:255',
            'nik' => 'required|numeric|digits:16',
            'gender' => 'required|in:Laki-laki,Perempuan',
            'born_place' => 'required|string',
            'born_date' => 'required|date',
            'agama' => 'required',
            'whatsapp' => 'required|numeric|digits_between:10,15',

            // Pendidikan & Status
            'last_education' => 'required',
            'current_status' => 'required',
            'nisn' => 'required|numeric|digits:10',

            // Orang Tua
            'nama_ayah' => 'required|string|max:255',
            'nama_ibu' => 'required|string|max:255',

            // Alamat Lengkap
            'address' => 'required|string',
            'rt' => 'required|numeric|digits_between:1,3',
            'rw' => 'required|numeric|digits_between:1,3',
            'kodepos' => 'required|numeric|digits:5',
            'provinsi' => 'required',
            'kab_kota' => 'required',
            'kecamatan' => 'required',
            'kelurahan' => 'required',

            // Tambahan Informasi Tinggal
            'jenis_tinggal' => 'required',
            'alat_transportasi' => 'required',
        ]);

        // menambahkan field desa/kelurahan yang memiliki value sama dengan kelurahan untuk memudahkan penyimpanan di database
        $validated['desa/kelurahan'] = $validated['kelurahan'];

        User::find(Auth::id())->update($validated);
        $this->dispatch('swal:modal', [
            'title' => 'Profil Diperbarui',
            'icon' => 'success',
            'text' => 'Profil lengkap telah diperbarui!'
        ]);
    }

    public function render()
    {
        return view('livewire.user-profile');
    }
}
