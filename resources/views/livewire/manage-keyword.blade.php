<div class="max-w-2xl mx-auto bg-white p-6 rounded-xl shadow-md border border-slate-200 my-8">
    <div class="mb-6">
        <h2 class="text-xl font-bold text-slate-800">Kelola SEO Keyword & Deskripsi</h2>
        <p class="text-sm text-slate-500">Pengaturan meta keyword dan description untuk halaman web.</p>
    </div>

    {{-- Notifikasi Sukses --}}
    @if (session()->has('success'))
        <div
            class="mb-4 p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-lg text-sm flex items-center justify-between">
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <form wire:submit="save" class="space-y-5">
        {{-- Input Keyword --}}
        <div>
            <label for="keyword" class="block text-sm font-semibold text-slate-700 mb-1">
                Keyword
            </label>
            <input type="text" id="keyword" wire:model="keyword"
                placeholder="Contoh: cenari id, konsultasi, rancang masa depan"
                class="w-full px-4 py-2 border rounded-lg text-slate-800 border-slate-300 focus:ring-2 focus:ring-blue-500 focus:outline-none text-sm @error('keyword') border-red-500 @enderror">
            @error('keyword')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
            <p class="text-xs text-slate-400 mt-1">Pisahkan kata kunci dengan koma.</p>
        </div>

        {{-- Input Description --}}
        <div>
            <label for="description" class="block text-sm font-semibold text-slate-700 mb-1">
                Deskripsi Meta
            </label>
            <textarea id="description" wire:model="description" rows="4"
                placeholder="Masukkan deskripsi singkat yang menggambarkan halaman web..."
                class="w-full px-4 py-2 border rounded-lg text-slate-800 border-slate-300 focus:ring-2 focus:ring-blue-500 focus:outline-none text-sm @error('description') border-red-500 @enderror"></textarea>
            @error('description')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Tombol Submit --}}
        <div class="flex items-center justify-end">
            <button type="submit"
                class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-medium text-sm rounded-lg transition duration-150 flex items-center space-x-2 disabled:opacity-50"
                wire:loading.attr="disabled">
                <span wire:loading.remove>Simpan Perubahan</span>
                <span wire:loading>Menyimpan...</span>
            </button>
        </div>
    </form>
</div>
