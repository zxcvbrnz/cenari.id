<div class="p-6 max-w-7xl mx-auto">
    
    {{-- 1. HALAMAN UTAMA (INDEX / TABEL) --}}
    @if($viewState === 'index')
        <div class="bg-white shadow rounded-lg p-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold text-gray-800">Kelola Missing Links</h2>
                <button wire:click="showCreateForm" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm">
                    + Tambah Link
                </button>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-100 text-gray-700 uppercase text-xs tracking-wider">
                            <th class="p-3 border-b">Text</th>
                            <th class="p-3 border-b">CTA</th>
                            <th class="p-3 border-b">URL</th>
                            <th class="p-3 border-b text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 text-sm">
                        @forelse($missingLinks as $link)
                            <tr class="hover:bg-gray-50">
                                <td class="p-3 border-b">{{ $link->text }}</td>
                                <td class="p-3 border-b"><span class="bg-gray-200 px-2 py-1 rounded text-xs">{{ $link->cta }}</span></td>
                                <td class="p-3 border-b text-blue-500 break-all"><a href="{{ $link->url }}" target="_blank">{{ $link->url }}</a></td>
                                <td class="p-3 border-b text-center space-x-2">
                                    <button wire:click="showEditForm({{ $link->id }})" class="bg-amber-500 hover:bg-amber-600 text-white px-3 py-1 rounded text-xs">
                                        Edit
                                    </button>
                                    <button wire:click="delete({{ $link->id }})" wire:confirm="Apakah Anda yakin ingin menghapus data ini?" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-xs">
                                        Hapus
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="p-4 text-center text-gray-400">Belum ada data.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-4">
                {{ $missingLinks->links() }}
            </div>
        </div>

    {{-- 2. HALAMAN FORM (CREATE & EDIT) --}}
    @elseif($viewState === 'create' || $viewState === 'edit')
        <div class="bg-white shadow rounded-lg p-6 max-w-2xl mx-auto">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-bold text-gray-800">
                    {{ $viewState === 'create' ? 'Tambah Missing Link Baru' : 'Edit Missing Link' }}
                </h2>
                <button wire:click="showIndex" class="text-gray-500 hover:text-gray-700 text-sm flex items-center">
                    ← Kembali
                </button>
            </div>

            <form wire:submit.prevent="save" class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Text</label>
                    <input type="text" wire:model="text" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2.5 border">
                    @error('text') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Call To Action (CTA)</label>
                    <input type="text" wire:model="cta" placeholder="Contoh: Klik Disini, Daftar Sekarang" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2.5 border">
                    @error('cta') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">URL / Link Target</label>
                    <input type="url" wire:model="url" placeholder="https://..." class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2.5 border">
                    @error('url') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div class="flex justify-end space-x-3 pt-4">
                    <button type="button" wire:click="showIndex" class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-lg text-sm">
                        Batal
                    </button>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm">
                        {{ $viewState === 'create' ? 'Simpan Data' : 'Perbarui Data' }}
                    </button>
                </div>
            </form>
        </div>
    @endif

</div>