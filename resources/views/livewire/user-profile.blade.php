<div class="min-h-screen bg-[#f1f5f9] py-12 px-4">
    <div class="max-w-6xl mx-auto space-y-8">

        {{-- Header --}}
        <div class="border-l-8 border-blue-600 pl-6 py-2">
            <h1 class="text-4xl font-black text-slate-900 uppercase tracking-tighter italic">Cenari Profile System</h1>
            <p class="text-slate-500 font-semibold uppercase text-xs tracking-widest mt-1">Management Information System
                v2.0</p>
        </div>

        {{-- Alert Notifikasi --}}
        @if (session('warning'))
            <div class="bg-amber-50 border-2 border-amber-200 p-6 rounded-3xl flex items-center gap-4 animate-pulse">
                <div class="bg-amber-500 p-2 rounded-xl">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
                <div>
                    <h4 class="text-amber-900 font-black text-xs uppercase tracking-widest">Tindakan Diperlukan</h4>
                    <p class="text-amber-700 text-[10px] font-bold uppercase">{{ session('warning') }}</p>
                </div>
            </div>
        @endif

        {{-- Section 01: Account & Security --}}
        <div class="bg-white rounded-3xl shadow-xl shadow-slate-200/50 border border-slate-200 overflow-hidden">
            <div class="px-8 py-5 bg-slate-900 flex justify-between items-center">
                <h3 class="text-white text-[10px] font-black uppercase tracking-[0.3em]">01. Account & Security</h3>
            </div>
            <form wire:submit="updateAccount" class="p-8">
                <div class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label
                                class="required text-[10px] font-black text-slate-400 uppercase tracking-widest block">Email
                                Address</label>
                            <input type="email" wire:model="email"
                                class="w-full border-slate-200 rounded-2xl focus:ring-blue-600 focus:border-blue-600 font-bold text-slate-700 transition-all">
                            @error('email')
                                <span
                                    class="text-red-600 text-[10px] font-bold mt-1 block uppercase italic">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <label
                                class="required text-[10px] font-black text-slate-400 uppercase tracking-widest block">Current
                                Password (Old)</label>
                            <input type="password" wire:model="current_password"
                                placeholder="Masukkan password lama untuk konfirmasi"
                                class="w-full border-slate-200 rounded-2xl focus:ring-blue-600 focus:border-blue-600 transition-all">
                            @error('current_password')
                                <span
                                    class="text-red-600 text-[10px] font-bold mt-1 block uppercase italic">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label
                                class="required text-[10px] font-black text-slate-400 uppercase tracking-widest block">New
                                Password</label>
                            <input type="password" wire:model="new_password" placeholder="Minimal 8 karakter"
                                class="w-full border-slate-200 rounded-2xl focus:ring-blue-600 focus:border-blue-600 transition-all">
                            @error('new_password')
                                <span
                                    class="text-red-600 text-[10px] font-bold mt-1 block uppercase italic">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <label
                                class="required text-[10px] font-black text-slate-400 uppercase tracking-widest block">Confirm
                                New Password</label>
                            <input type="password" wire:model="new_password_confirmation"
                                placeholder="Ulangi password baru"
                                class="w-full border-slate-200 rounded-2xl focus:ring-blue-600 focus:border-blue-600 transition-all">
                        </div>
                    </div>

                    <div
                        class="pt-4 border-t border-slate-50 flex flex-col md:flex-row items-center justify-between gap-4">
                        <div class="flex items-center gap-2 text-slate-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <p class="text-[9px] italic font-medium">Kosongkan kolom password jika hanya ingin mengubah
                                email.</p>
                        </div>

                        <button type="submit"
                            class="w-full md:w-auto bg-slate-900 hover:bg-black text-white px-12 py-4 rounded-2xl text-[10px] font-black uppercase tracking-widest transition-all shadow-xl shadow-slate-200 active:scale-95 flex items-center justify-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-400" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Update Account Settings
                        </button>
                    </div>
                </div>
            </form>
        </div>

        {{-- Section 02: Personal Data --}}
        <div class="bg-white rounded-3xl shadow-xl shadow-slate-200/50 border border-slate-200 overflow-hidden">
            <div class="px-8 py-5 bg-blue-600 flex justify-between items-center">
                <h3 class="text-white text-[10px] font-black uppercase tracking-[0.3em]">02. Personal Data Instruments
                </h3>
                <div wire:loading wire:target="updateProfile" class="flex items-center gap-2">
                    <div class="w-2 h-2 bg-white rounded-full animate-bounce"></div>
                    <span class="text-[10px] font-black text-white uppercase italic">Processing...</span>
                </div>
            </div>

            <form wire:submit="updateProfile" class="p-8 space-y-12">

                {{-- Biodata --}}
                <div class="space-y-6">
                    <h4 class="text-xs font-black text-blue-600 uppercase border-b border-blue-100 pb-2">Biodata Pribadi
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                        <div class="md:col-span-2">
                            <label
                                class="required text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-2">Nama
                                Lengkap</label>
                            <input type="text" wire:model="name"
                                class="w-full border-slate-200 rounded-2xl focus:ring-blue-600">
                            @error('name')
                                <span
                                    class="text-red-600 text-[9px] font-bold mt-1 block uppercase italic">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label
                                class="required text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-2">NIK
                                (KTP)</label>
                            <input type="text" wire:model="nik" class="w-full border-slate-200 rounded-2xl">
                            @error('nik')
                                <span
                                    class="text-red-600 text-[9px] font-bold mt-1 block uppercase italic">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label
                                class="required text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-2">WhatsApp</label>
                            <input type="text" wire:model="whatsapp" class="w-full border-slate-200 rounded-2xl">
                            @error('whatsapp')
                                <span
                                    class="text-red-600 text-[9px] font-bold mt-1 block uppercase italic">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label
                                class="required text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-2">NISN</label>
                            <input type="text" wire:model="nisn" class="w-full border-slate-200 rounded-2xl">
                            @error('nisn')
                                <span
                                    class="text-red-600 text-[9px] font-bold mt-1 block uppercase italic">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label
                                class="required text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-2">Gender</label>
                            <select wire:model="gender" class="w-full border-slate-200 rounded-2xl font-bold">
                                <option value="">Pilih</option>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                            @error('gender')
                                <span
                                    class="text-red-600 text-[9px] font-bold mt-1 block uppercase italic">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label
                                class="required text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-2">Tempat
                                Lahir</label>
                            <input type="text" wire:model="born_place"
                                class="w-full border-slate-200 rounded-2xl">
                            @error('born_place')
                                <span
                                    class="text-red-600 text-[9px] font-bold mt-1 block uppercase italic">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label
                                class="required text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-2">Tanggal
                                Lahir</label>
                            <input type="date" wire:model="born_date"
                                class="w-full border-slate-200 rounded-2xl focus:ring-blue-600 font-bold text-slate-700">
                            @error('born_date')
                                <span
                                    class="text-red-600 text-[9px] font-bold mt-1 block uppercase italic">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Pendidikan --}}
                <div class="space-y-6">
                    <h4 class="text-xs font-black text-blue-600 uppercase border-b border-blue-100 pb-2">Pendidikan &
                        Keluarga</h4>
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                        <div>
                            <label
                                class="required text-[10px] font-black text-slate-400 uppercase block mb-2">Pendidikan
                                Terakhir</label>
                            <input type="text" wire:model="last_education"
                                class="w-full border-slate-200 rounded-2xl">
                            @error('last_education')
                                <span
                                    class="text-red-600 text-[9px] font-bold mt-1 block uppercase italic">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label class="required text-[10px] font-black text-slate-400 uppercase block mb-2">Status
                                Pekerjaan</label>
                            <input type="text" wire:model="current_status"
                                class="w-full border-slate-200 rounded-2xl">
                            @error('current_status')
                                <span
                                    class="text-red-600 text-[9px] font-bold mt-1 block uppercase italic">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label
                                class="required text-[10px] font-black text-slate-400 uppercase block mb-2">Agama</label>
                            <input type="text" wire:model="agama" class="w-full border-slate-200 rounded-2xl">
                            @error('agama')
                                <span
                                    class="text-red-600 text-[9px] font-bold mt-1 block uppercase italic">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label class="required text-[10px] font-black text-slate-400 uppercase block mb-2">Jenis
                                Tinggal</label>
                            <input type="text" wire:model="jenis_tinggal"
                                class="w-full border-slate-200 rounded-2xl">
                            @error('jenis_tinggal')
                                <span
                                    class="text-red-600 text-[9px] font-bold mt-1 block uppercase italic">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="md:col-span-2">
                            <label class="required text-[10px] font-black text-slate-400 uppercase block mb-2">Nama
                                Lengkap Ayah</label>
                            <input type="text" wire:model="nama_ayah" class="w-full border-slate-200 rounded-2xl">
                            @error('nama_ayah')
                                <span
                                    class="text-red-600 text-[9px] font-bold mt-1 block uppercase italic">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="md:col-span-2">
                            <label class="required text-[10px] font-black text-slate-400 uppercase block mb-2">Nama
                                Lengkap Ibu</label>
                            <input type="text" wire:model="nama_ibu" class="w-full border-slate-200 rounded-2xl">
                            @error('nama_ibu')
                                <span
                                    class="text-red-600 text-[9px] font-bold mt-1 block uppercase italic">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Lokasi --}}
                <div class="space-y-6">
                    <h4 class="text-xs font-black text-blue-600 uppercase border-b border-blue-100 pb-2">Lokasi
                        Domisili (Auto-Complete)</h4>
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                        <div>
                            <div class="flex justify-between items-center mb-2">
                                <label
                                    class="required text-[10px] font-black text-slate-400 uppercase block">Provinsi</label>
                                <div wire:loading wire:target="provinsi" class="flex items-center gap-1">
                                    <div class="w-1.5 h-1.5 bg-blue-600 rounded-full animate-ping inline-block"></div>
                                    <span class="text-[9px] font-bold text-blue-600 uppercase italic">Loading...</span>
                                </div>
                            </div>
                            <select wire:model.live="provinsi"
                                class="w-full border-slate-200 rounded-2xl font-bold focus:ring-blue-600 transition-all">
                                <option value="">-- Pilih Provinsi --</option>
                                @foreach ($list_provinsi as $p)
                                    <option value="{{ $p['id'] . '-' . $p['text'] }}">{{ $p['text'] }}</option>
                                @endforeach
                            </select>
                            @error('provinsi')
                                <span
                                    class="text-red-600 text-[9px] font-bold mt-1 block uppercase italic">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <div class="flex justify-between items-center mb-2">
                                <label class="required text-[10px] font-black text-slate-400 uppercase block">Kabupaten
                                    / Kota</label>
                                <div wire:loading wire:target="kab_kota" class="flex items-center gap-1">
                                    <div class="w-1.5 h-1.5 bg-blue-600 rounded-full animate-ping inline-block"></div>
                                    <span class="text-[9px] font-bold text-blue-600 uppercase italic">Loading...</span>
                                </div>
                            </div>
                            <select wire:model.live="kab_kota" class="w-full border-slate-200 rounded-2xl font-bold"
                                {{ empty($list_kabupaten) ? 'disabled' : '' }}>
                                <option value="">
                                    {{ $provinsi ? '-- Pilih Kabupaten --' : 'Pilih Provinsi Dahulu' }}</option>
                                @foreach ($list_kabupaten as $k)
                                    <option value="{{ $k['id'] . '-' . $k['text'] }}">{{ $k['text'] }}</option>
                                @endforeach
                            </select>
                            @error('kab_kota')
                                <span
                                    class="text-red-600 text-[9px] font-bold mt-1 block uppercase italic">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <div class="flex justify-between items-center mb-2">
                                <label
                                    class="required text-[10px] font-black text-slate-400 uppercase block">Kecamatan</label>
                                <div wire:loading wire:target="kecamatan" class="flex items-center gap-1">
                                    <div class="w-1.5 h-1.5 bg-blue-600 rounded-full animate-ping inline-block"></div>
                                    <span class="text-[9px] font-bold text-blue-600 uppercase italic">Loading...</span>
                                </div>
                            </div>
                            <select wire:model.live="kecamatan" class="w-full border-slate-200 rounded-2xl font-bold"
                                {{ empty($list_kecamatan) ? 'disabled' : '' }}>
                                <option value="">
                                    {{ $kab_kota ? '-- Pilih Kecamatan --' : 'Pilih Kabupaten Dahulu' }}</option>
                                @foreach ($list_kecamatan as $kc)
                                    <option value="{{ $kc['id'] . '-' . $kc['text'] }}">{{ $kc['text'] }}</option>
                                @endforeach
                            </select>
                            @error('kecamatan')
                                <span
                                    class="text-red-600 text-[9px] font-bold mt-1 block uppercase italic">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <div class="flex justify-between items-center mb-2">
                                <label class="required text-[10px] font-black text-slate-400 uppercase block">Desa /
                                    Kelurahan</label>
                                <div wire:loading wire:target="kelurahan" class="flex items-center gap-1">
                                    <div class="w-1.5 h-1.5 bg-blue-600 rounded-full animate-ping inline-block"></div>
                                    <span class="text-[9px] font-bold text-blue-600 uppercase italic">Loading...</span>
                                </div>
                            </div>
                            <select wire:model.live="kelurahan" class="w-full border-slate-200 rounded-2xl font-bold"
                                {{ empty($list_kelurahan) ? 'disabled' : '' }}>
                                <option value="">
                                    {{ $kecamatan ? '-- Pilih Kelurahan --' : 'Pilih Kecamatan Dahulu' }}</option>
                                @foreach ($list_kelurahan as $kl)
                                    <option value="{{ $kl['id'] . '-' . $kl['text'] }}">{{ $kl['text'] }}</option>
                                @endforeach
                            </select>
                            @error('kelurahan')
                                <span
                                    class="text-red-600 text-[9px] font-bold mt-1 block uppercase italic">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                        <div class="md:col-span-2">
                            <label class="required text-[10px] font-black text-slate-400 uppercase block mb-2">Alamat
                                Lengkap Jalan</label>
                            <input type="text" wire:model="address" placeholder="Contoh: Jl. Merdeka No. 12"
                                class="w-full border-slate-200 rounded-2xl">
                            @error('address')
                                <span
                                    class="text-red-600 text-[9px] font-bold mt-1 block uppercase italic">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="grid grid-cols-2 gap-2">
                            <div>
                                <label
                                    class="required text-[10px] font-black text-slate-400 uppercase block mb-2 text-center">RT</label>
                                <input type="text" wire:model="rt"
                                    class="w-full border-slate-200 rounded-2xl text-center font-bold">
                                @error('rt')
                                    <span
                                        class="text-red-600 text-[9px] font-bold mt-1 block uppercase italic text-center">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label
                                    class="required text-[10px] font-black text-slate-400 uppercase block mb-2 text-center">RW</label>
                                <input type="text" wire:model="rw"
                                    class="w-full border-slate-200 rounded-2xl text-center font-bold">
                                @error('rw')
                                    <span
                                        class="text-red-600 text-[9px] font-bold mt-1 block uppercase italic text-center">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div>
                            <label
                                class="required text-[10px] font-black text-slate-400 uppercase block mb-2 text-center">Kodepos</label>
                            <input type="text" wire:model="kodepos"
                                class="w-full border-slate-200 rounded-2xl text-center font-bold">
                            @error('kodepos')
                                <span
                                    class="text-red-600 text-[9px] font-bold mt-1 block uppercase italic text-center">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Lainnya --}}
                <div class="space-y-6">
                    <h4 class="text-xs font-black text-blue-600 uppercase border-b border-blue-100 pb-2">Lainnya</h4>
                    <div>
                        <label
                            class="required text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-2">Alat
                            Transportasi</label>
                        <input type="text" wire:model="alat_transportasi" placeholder="Contoh: Sepeda Motor"
                            class="w-full border-slate-200 rounded-2xl">
                        @error('alat_transportasi')
                            <span
                                class="text-red-600 text-[9px] font-bold mt-1 block uppercase italic">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                {{-- Submit --}}
                <div
                    class="pt-10 flex flex-col md:flex-row items-center justify-between gap-4 bg-slate-50 p-6 rounded-3xl border border-slate-100">
                    <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest">Pastikan data yang
                        diinput sesuai dengan dokumen resmi (KTP/KK).</p>
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-16 py-4 rounded-2xl font-black text-xs uppercase tracking-[0.2em] shadow-2xl shadow-blue-200 transition-all active:scale-95">
                        Save Complete Profile
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>
