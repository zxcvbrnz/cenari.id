<?php

namespace App\Livewire;

use App\Models\CoursePackageUser;
use App\Models\Peserta;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;
use Silvanix\Wablas\Message;
use App\Models\Sertifikat;
use App\Models\Pembayaran;
use App\Models\UserKedua;

class EnrollmentManager extends Component
{
    use WithPagination;

    // State Management
    public $isEdit = false;
    public $selectedId;

    // Form Fields
    public $username, $password, $learning_methode, $payment_status, $status;

    public function render()
    {
        return view('livewire.enrollment-manager', [
            'enrollments' => CoursePackageUser::with('coursePackage', 'user')
                ->latest()
                ->paginate(10)
        ]);
    }

    public function edit($id)
    {
        $this->isEdit = true;
        $this->selectedId = $id;

        $enrollment = CoursePackageUser::findOrFail($id);
        $this->username = $enrollment->username;
        $this->password = $enrollment->password;
        $this->learning_methode = $enrollment->learning_methode;
        $this->payment_status = $enrollment->payment_status;
        $this->status = $enrollment->status;
    }

    public function creating_peserta($id)
    {
        $enrollment = CoursePackageUser::findOrFail($id);
        $user = $enrollment->user;

        $str = Str::random(30) . Carbon::now()->getTimestamp();

        $id_instruktur = 20;
        $id_mapel = 5;
        // if ($request->instruktur) {
        //     $insmap = explode('-', $request->instruktur);
        //     $id_instruktur = $insmap[0];
        //     $id_mapel = $insmap[1];
        // }
        $status_pembayaran = 'Belum Bayar';
        $data = Peserta::create([
            'id_instruktur' => $id_instruktur,
            'id_group' => null,
            'id_mapel' => $id_mapel,
            'tempat_lahir' => $user->born_place,
            'tanggal_lahir' => $user->born_date,
            'nama_ibu' => $user->nama_ibu,
            'nama_ayah' => $user->nama_ayah,
            'nisn' => $user->nisn,
            'nik' => $user->nik,
            'jenis_kelamin' => $user->gender,
            'pendidikan' => $user->last_education,
            'agama' => $user->agama,
            'kewarganegaraan' => 'WNI',
            'penerima_kps' => '',
            'no_kps' => '',
            'layak_pip' => '',
            'alasan_pip' => '',
            'penerima_kip' => '',
            'no_kip' => '',
            'alamat' => $user->address,
            'rt' => $user->rt,
            'rw' => $user->rw,
            'kode_pos' => $user->kodepos,
            'nama_desa_kelurahan' => $user->kelurahan,
            'provinsi' => $user->provinsi,
            'kab_kota' => $user->kab_kota,
            'kecamatan' => $user->kecamatan,
            'kelurahan' => $user->kelurahan,
            'jenis_tinggal' => $user->jenis_tinggal,
            'alat_transportasi' => $user->alat_transportasi,
            'nomor_telepon' => $user->whatsapp,
            'email' => $user->email,
            'status_saat_ini' => $user->current_status,
            'status' => 'aktif',
            'status_pembayaran' => $status_pembayaran,
            'unique_code' => $str,
        ]);
        Sertifikat::create(['id_peserta' => $data->id]);
        Pembayaran::create([
            'id_peserta' => $data->id,
            'jumlah_dibayar' => 0,
            'tanggal_dibayar' => $data->created_at,
            'deskripsi' => 'Belum ada pembayaran',
        ]);
        $username = '';
        $nameParts = explode(' ', $user->name);
        if (count($nameParts) > 0) {
            $firstName = $nameParts[0];
            $secondName = count($nameParts) > 1 ? $nameParts[1] : '';
            $nameToUse = $secondName ?: $firstName;
            $username = Str::of($nameToUse . ' ' . $data->id)->slug('-');
        }
        $akun = [
            'name' => $user->name,
            'role' => 'peserta',
            'id_peserta' => $data->id,
            'username' => $username,
            'password' => 'cenarikursus'
        ];
        $akun['password'] = Hash::make($akun['password']);
        event(new Registered((UserKedua::create($akun))));

        $send = new Message();

        // $nomor_ins = $data->id_group ? Group::findOrFail($data->id_group)->instruktur : Instruktur::findOrFail($id_instruktur);

        // $nomor_ins = Instruktur::findOrFail($id_instruktur)->nomor_telepon;
        // $wa = [
        //     [
        //         'phone' => $request->nomor_telepon,
        //         'message' => 'Halo *' . $request->name . '*<br><br>' .
        //             'Pendaftaranmu Telah Terverifikasi, Berikut Username Dan Passwordmu' .
        //             '<br><br>' . 'Username : ' . $username .
        //             '<br>' . 'Password : cenarikursus' .
        //             '<br><br>' . 'Tutorial untuk menggunakan aplikasi kursus.cenari.sch.id silahkan kunjungi web http://cenari.sch.id/modul-tutorial',
        //     ],
        //     [
        //         'phone' => $nomor_ins->nomor_telepon,
        //         'message' => 'Halo *' . $nomor_ins->user->name . '*<br><br>' .
        //             'Murid Bernama *' . $request->name . '* Telah Menjadi Murid Didik Anda, Untuk Lebih Lanjut' . "<br><br>" .
        //             'Silahkan Buka www.kursus.cenari.sch.id' . "<br>" .
        //             'Tutorial untuk menggunakan aplikasi kursus.cenari.sch.id silahkan kunjungi web http://cenari.sch.id/modul-tutorial',
        //     ],
        //     [
        //         'phone' => env('ADMIN_NUMBER'),
        //         'message' => 'Halo *Admin*' . '<br>' . 'Peserta Bernama *' . $request->name . '* Telah Didaftarkan Pada Aplikasi Dengan Akun Seperti Berikut' .
        //             '<br><br>' . 'Username : ' . $username .
        //             '<br>' . 'Password : cenarikursus' .
        //             '<br><br>' . 'Untuk Lebih Lanjut' .
        //             "<br>" . 'Silahkan Buka www.kursus.cenari.sch.id' . "<br>" .
        //             'Tutorial untuk menggunakan aplikasi kursus.cenari.sch.id silahkan kunjungi web http://cenari.sch.id/modul-tutorial',
        //     ],

        // ];
        // $send->multiple_text($wa);

        // return redirect()->route('admin.data.peserta');

        $this->dispatch('swal:modal', [
            'title' => 'Sukses!',
            'icon' => 'success',
            'text' => 'Peserta berhasil dibuat dan akun telah dikirim ke WhatsApp.'
        ]);
    }

    public function update()
    {
        $this->validate([
            'learning_methode' => 'required',
            'payment_status' => 'required',
            'status' => 'required',
        ]);

        $enrollment = CoursePackageUser::findOrFail($this->selectedId);
        $enrollment->update([
            'username' => $this->username,
            'password' => $this->password,
            'learning_methode' => $this->learning_methode,
            'payment_status' => $this->payment_status,
            'status' => $this->status,
        ]);

        $this->cancel();
        $this->dispatch('swal:modal', [
            'title' => 'Berhasil!',
            'icon' => 'success',
            'text' => 'Data pendaftaran telah diperbarui.'
        ]);
    }

    public function cancel()
    {
        $this->isEdit = false;
        $this->reset(['username', 'password', 'learning_methode', 'payment_status', 'status', 'selectedId']);
    }
}
