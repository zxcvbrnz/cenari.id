<div class="min-h-screen bg-[#FBFDFF] py-12">
    <div class="max-w-3xl mx-auto px-6">
        <div class="bg-white border border-slate-100 rounded-[2.5rem] p-8 md:p-12 shadow-2xl shadow-slate-200/50">

            <div class="text-center mb-10">
                <span
                    class="px-3 py-1 bg-blue-50 text-[#3B82F6] text-[10px] font-black uppercase tracking-widest rounded-lg mb-4 inline-block">
                    Konfirmasi Pendaftaran
                </span>
                <h1 class="text-3xl font-black text-slate-900 tracking-tighter mb-2">
                    {{ $package->name }}
                </h1>
                <p class="text-slate-500 text-sm italic">Satu langkah lagi untuk memulai petualangan teknologi Anda.</p>
            </div>

            <div class="space-y-8">
                <div class="grid grid-cols-2 gap-4">
                    <div class="p-5 bg-slate-50 rounded-2xl border border-slate-100">
                        <p class="text-[9px] font-black uppercase text-slate-400 mb-1">Total Investasi</p>
                        <p class="text-xl font-black text-slate-900">Rp
                            {{ number_format($package->price, 0, ',', '.') }}</p>
                    </div>
                    <div class="p-5 bg-slate-50 rounded-2xl border border-slate-100">
                        <p class="text-[9px] font-black uppercase text-slate-400 mb-1">Durasi</p>
                        <p class="text-xl font-black text-slate-900">{{ $package->course_count }} Sesi</p>
                    </div>
                </div>

                <div class="space-y-4">
                    <h2 class="text-sm font-black text-slate-900 uppercase tracking-tight flex items-center gap-3">
                        <span class="w-6 h-[2px] bg-[#3B82F6]"></span>
                        Pilih Metode Pembelajaran
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        @foreach (['Offline', 'Online', 'Hybrid'] as $method)
                            <label class="relative cursor-pointer">
                                <input type="radio" wire:model.live="learning_methode" value="{{ $method }}"
                                    class="sr-only">

                                <div
                                    class="p-4 rounded-2xl border-2 transition-all flex flex-col items-center justify-center gap-2 relative overflow-hidden
                                            {{ $learning_methode === $method
                                                ? 'border-[#3B82F6] bg-blue-50/50 shadow-md'
                                                : 'bg-white border-slate-100 hover:border-slate-200' }}">
                                    <p
                                        class="text-center font-black text-[11px] uppercase tracking-wider transition-colors
                                                {{ $learning_methode === $method ? 'text-[#3B82F6]' : 'text-slate-400' }}">
                                        {{ $method }}
                                    </p>
                                </div>
                            </label>
                        @endforeach
                    </div>
                </div>

                <hr class="border-slate-100">

                @if (session()->has('error'))
                    <div class="p-4 bg-rose-50 text-rose-600 rounded-xl text-sm font-bold text-center">
                        {{ session('error') }}
                    </div>
                @endif

                <button wire:click="register" wire:loading.attr="disabled"
                    class="w-full bg-[#3B82F6] text-white py-6 rounded-2xl font-black uppercase tracking-[0.2em] text-[12px] hover:bg-slate-900 transition-all shadow-xl shadow-blue-500/25 active:scale-95 disabled:opacity-50">
                    <span wire:loading.remove>Konfirmasi & Daftar Sekarang</span>
                    <span wire:loading>Memproses...</span>
                </button>

                <p class="text-center text-[10px] text-slate-400 font-bold uppercase tracking-widest">
                    Dengan mendaftar, Anda menyetujui syarat & ketentuan yang berlaku
                </p>
            </div>
        </div>
    </div>
</div>
