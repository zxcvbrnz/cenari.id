<div class="space-y-6 min-h-screen" @if (isset($poll) && $poll) wire:poll.30s @endif>

    <div
        class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bg-white p-5 rounded-2xl shadow-sm border border-gray-100">
        <div>
            <h1 class="text-xl font-bold text-gray-900 tracking-tight">Pusat Analitik Kontrol</h1>
            <p class="text-xs text-gray-500 mt-0.5">Metrik real-time lalu lintas data, performa server, dan log
                aktivitas.</p>
        </div>
        <div class="flex flex-wrap items-center gap-2 w-full sm:w-auto">
            <select wire:model.live="period"
                class="text-sm bg-gray-50 border border-gray-200 rounded-xl p-2.5 text-gray-700 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all">
                <option value="today">Hari Ini (Per Jam)</option>
                <option value="yesterday">Kemarin</option>
                <option value="7_days">7 Hari Terakhir</option>
                <option value="30_days">30 Hari Terakhir</option>
                <option value="this_month">Bulan Ini</option>
            </select>

            <button wire:click="exportCSV"
                class="inline-flex items-center space-x-1.5 px-3.5 py-2.5 bg-gray-900 hover:bg-gray-800 text-white rounded-xl text-xs font-semibold shadow-sm transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                </svg>
                <span>Ekspor CSV</span>
            </button>

            <button wire:click="$toggle('poll')"
                class="p-2.5 border rounded-xl text-xs font-bold transition-all {{ $poll ? 'bg-green-50 text-green-700 border-green-200 animate-pulse' : 'bg-gray-50 text-gray-500 border-gray-200' }}">
                {{ $poll ? '● Live Tracker ON' : '○ Tracker Paused' }}
            </button>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 flex items-center justify-between">
            <div class="space-y-2">
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Total Hits (Periode)</p>
                <p class="text-2xl font-bold text-gray-900">{{ number_format($periodTotalHits) }}</p>
                <p class="text-xs text-gray-400 flex items-center">
                    <span class="font-bold {{ $growthRate >= 0 ? 'text-green-500' : 'text-red-500' }} mr-1">
                        {{ $growthRate >= 0 ? '▲' : '▼' }} {{ abs($growthRate) }}%
                    </span>
                    vs Hari Kemarin
                </p>
            </div>
            <div class="p-3.5 bg-blue-50 text-blue-600 rounded-2xl">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0zm-10.542 7C5.732 16.057 9.523 13 14 13c4.478 0 8.268 3.057 9.542 7" />
                </svg>
            </div>
        </div>

        <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 flex items-center justify-between">
            <div class="space-y-2">
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Pengunjung Unik (IP)</p>
                <p class="text-2xl font-bold text-gray-900">{{ number_format($periodUniqueUsers) }}</p>
                <p class="text-xs text-gray-400">Total alamat IP terdaftar</p>
            </div>
            <div class="p-3.5 bg-emerald-50 text-emerald-600 rounded-2xl">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
            </div>
        </div>

        <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 flex items-center justify-between">
            <div class="space-y-2">
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Rasio Interaksi</p>
                <p class="text-2xl font-bold text-gray-900">{{ $bounceRateEstimate }} <span
                        class="text-xs text-gray-400 font-normal">X / User</span></p>
                <p class="text-xs text-gray-400">Rata-rata halaman dibuka/user</p>
            </div>
            <div class="p-3.5 bg-amber-50 text-amber-600 rounded-2xl">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                </svg>
            </div>
        </div>

        <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 flex items-center justify-between">
            <div class="space-y-2">
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Sesi Terakhir</p>
                <p class="text-xl font-bold text-gray-900 truncate max-w-[160px] capitalize">
                    {{ $recentVisits->first()->platform ?? 'Desktop OS' }}</p>
                <p class="text-xs text-gray-400 truncate">{{ $recentVisits->first()->browser ?? 'Unknown Browser' }}</p>
            </div>
            <div class="p-3.5 bg-purple-50 text-purple-600 rounded-2xl">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
            </div>
        </div>
    </div>

    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h3 class="text-sm font-bold text-gray-900">Grafik Laju Interaksi Pengunjung</h3>
                <p class="text-xs text-gray-400">Statistik visual fluktuasi grafik kunjungan database.</p>
            </div>
            <span class="text-[11px] bg-blue-50 text-blue-600 px-3 py-1 rounded-xl font-bold uppercase tracking-wider">
                Mode: {{ str_replace('_', ' ', $period) }}
            </span>
        </div>
        <div class="h-80" wire:ignore>
            <canvas id="visitorChart"></canvas>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
            <h3 class="text-sm font-bold text-gray-900 mb-4">Akses Peramban (Browsers)</h3>
            <div class="space-y-4">
                @forelse($topBrowsers as $browser)
                    <div>
                        <div class="flex justify-between text-xs font-semibold text-gray-600 mb-1.5">
                            <span>{{ $browser->browser ?: 'Unknown Browser' }}</span>
                            <span>{{ number_format($browser->total) }} Hits</span>
                        </div>
                        <div class="w-full bg-gray-100 h-2 rounded-full overflow-hidden">
                            <div class="bg-blue-500 h-2 rounded-full"
                                style="width: {{ ($browser->total / max($periodTotalHits, 1)) * 100 }}%"></div>
                        </div>
                    </div>
                @empty
                    <p class="text-xs text-gray-400 text-center py-6">Tidak ada statistik browser.</p>
                @endforelse
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
            <h3 class="text-sm font-bold text-gray-900 mb-4">Sistem Operasi (Platforms)</h3>
            <div class="space-y-4">
                @forelse($topPlatforms as $plat)
                    <div>
                        <div class="flex justify-between text-xs font-semibold text-gray-600 mb-1.5">
                            <span>{{ $plat->platform ?: 'Unknown OS' }}</span>
                            <span>{{ number_format($plat->total) }} Hits</span>
                        </div>
                        <div class="w-full bg-gray-100 h-2 rounded-full overflow-hidden">
                            <div class="bg-purple-500 h-2 rounded-full"
                                style="width: {{ ($plat->total / max($periodTotalHits, 1)) * 100 }}%"></div>
                        </div>
                    </div>
                @empty
                    <p class="text-xs text-gray-400 text-center py-6">Tidak ada statistik platform.</p>
                @endforelse
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
            <h3 class="text-sm font-bold text-gray-900 mb-3">5 Konten / URL Terlaris</h3>
            <div class="divide-y divide-gray-100">
                @forelse($topPages as $page)
                    <div class="flex justify-between items-center py-3 text-xs">
                        <span class="text-gray-600 truncate max-w-xs bg-gray-50 px-2 py-1 rounded font-mono">
                            {{ Str::replaceFirst(url('/'), '', $page->url) ?: '/' }}
                        </span>
                        <span class="font-bold text-gray-800">{{ number_format($page->total) }} <span
                                class="text-gray-400 font-normal">views</span></span>
                    </div>
                @empty
                    <p class="text-xs text-gray-400 text-center py-4">Belum ada rekaman lalu lintas halaman.</p>
                @endif
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
            <h3 class="text-sm font-bold text-gray-900 mb-3">5 Sumber Rujukan Eksternal</h3>
            <div class="divide-y divide-gray-100">
                @forelse($topReferers as $ref)
                    <div class="flex justify-between items-center py-3 text-xs">
                        <span class="text-gray-600 truncate max-w-xs font-medium" title="{{ $ref->referer }}">
                            {{ Str::limit($ref->referer, 50) }}
                        </span>
                        <span class="font-bold text-gray-800">{{ number_format($ref->total) }} <span
                                class="text-gray-400 font-normal">asal</span></span>
                    </div>
                @empty
                    <p class="text-xs text-gray-400 text-center py-4">Semua akses sejauh ini masuk secara langsung
                        (Direct).</p>
                @endif
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div
            class="p-6 border-b border-gray-100 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-2">
            <div>
                <h3 class="text-sm font-bold text-gray-900">Aliran Log Aktivitas Sistem (Live)</h3>
                <p class="text-xs text-gray-400 mt-0.5">Urutan data mentah entri audit hit yang masuk ke repositori.
                </p>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse whitespace-nowrap">
                <thead>
                    <tr
                        class="bg-gray-50/70 text-gray-400 text-[11px] font-bold uppercase tracking-wider border-b border-gray-100">
                        <th class="px-6 py-3.5">Waktu Ambil</th>
                        <th class="px-6 py-3.5">Metode & Endpoint Path</th>
                        <th class="px-6 py-3.5">IP Address</th>
                        <th class="px-6 py-3.5">User Agent Detail</th>
                        <th class="px-6 py-3.5">Rujukan (Referer)</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-xs text-gray-600">
                    @forelse($recentVisits as $visit)
                        <tr class="hover:bg-gray-50/80 transition-colors">
                            <td class="px-6 py-4">
                                <span
                                    class="font-semibold text-gray-700">{{ $visit->created_at->diffForHumans() }}</span>
                                <span
                                    class="block text-[10px] text-gray-400 mt-0.5">{{ $visit->created_at->format('d M, H:i:s') }}</span>
                            </td>

                            <td class="px-6 py-4">
                                <div class="flex items-center space-x-2">
                                    <span
                                        class="px-2 py-0.5 text-[10px] font-bold rounded-md {{ $visit->method === 'GET' ? 'bg-blue-50 text-blue-600 border border-blue-100' : 'bg-green-50 text-green-600 border border-green-100' }}">
                                        {{ $visit->method ?? 'GET' }}
                                    </span>
                                    <span class="font-medium text-gray-800 max-w-xs truncate block"
                                        title="{{ $visit->url }}">
                                        {{ Str::replaceFirst(url('/'), '', $visit->url) ?: '/' }}
                                    </span>
                                </div>
                            </td>

                            <td class="px-6 py-4 font-mono text-xs text-gray-500">
                                {{ $visit->ip ?? '127.0.0.1' }}
                            </td>

                            <td class="px-6 py-4">
                                <span
                                    class="text-gray-800 font-semibold block">{{ $visit->platform ?? 'Unknown OS' }}</span>
                                <span
                                    class="text-gray-400 text-[11px] block mt-0.5">{{ $visit->browser ?? 'Unknown Browser' }}</span>
                            </td>

                            <td class="px-6 py-4 text-gray-400 max-w-xs truncate">
                                {{ $visit->referer ? Str::limit($visit->referer, 45) : 'Direct / Langsung' }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-gray-400 text-sm">
                                Tidak ditemukan berkas data entri log.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-4 bg-gray-50/70 border-t border-gray-100">
            {{ $recentVisits->links() }}
        </div>
    </div>

    @assets
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @endassets

    @script
        <script>
            let chartInstance = null;

            function initChart() {
                const ctx = document.getElementById('visitorChart');
                if (!ctx) return;

                if (chartInstance) {
                    chartInstance.destroy();
                }

                chartInstance = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: @js($chartLabels),
                        datasets: [{
                            label: 'Laju Klik',
                            data: @js($chartValues),
                            borderColor: '#3b82f6',
                            backgroundColor: 'rgba(59, 130, 246, 0.03)',
                            borderWidth: 2.5,
                            fill: true,
                            tension: 0.25,
                            pointBackgroundColor: '#3b82f6',
                            pointHoverBackgroundColor: '#1d4ed8',
                            pointRadius: 3,
                            pointHoverRadius: 5
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false
                            }
                        },
                        scales: {
                            x: {
                                grid: {
                                    display: false
                                },
                                ticks: {
                                    color: '#9ca3af',
                                    font: {
                                        size: 11
                                    }
                                }
                            },
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    color: '#9ca3af',
                                    font: {
                                        size: 11
                                    },
                                    precision: 0
                                },
                                grid: {
                                    color: '#f3f4f6'
                                }
                            }
                        }
                    }
                });
            }

            initChart();

            // Interseptor Request Livewire v3 (Sangat Halus Tanpa Flicker Saat Mengganti Halaman/Filter)
            Livewire.hook('request', ({
                respond
            }) => {
                respond(() => {
                    setTimeout(() => {
                        initChart();
                    }, 40);
                });
            });
        </script>
    @endscript
</div>
