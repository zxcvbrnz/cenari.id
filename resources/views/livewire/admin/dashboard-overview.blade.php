<div class="space-y-6 min-h-screen" @if (isset($poll) && $poll) wire:poll.30s @endif>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center space-x-4">
            <div class="p-3 bg-blue-50 text-blue-600 rounded-lg">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500">Total Kunjungan Hari Ini</p>
                <p class="text-2xl font-bold text-gray-900 mt-1">{{ $todayCount }}</p>
            </div>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center space-x-4">
            <div class="p-3 bg-green-50 text-green-600 rounded-lg">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500">Pengunjung Unik (IP)</p>
                <p class="text-2xl font-bold text-gray-900 mt-1">{{ $uniqueTodayCount }}</p>
            </div>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center space-x-4">
            <div class="p-3 bg-purple-50 text-purple-600 rounded-lg">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                </svg>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500">Kunjungan Terakhir Melalui</p>
                <p class="text-xl font-bold text-gray-900 mt-1 capitalize">
                    {{ $recentVisits->first()->device ?? 'Desktop' }}
                </p>
            </div>
        </div>
    </div>

    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold text-gray-900">Grafik Tren Kunjungan</h3>
            <span class="text-xs bg-gray-100 text-gray-600 px-2.5 py-1 rounded-md font-medium">7 Hari Terakhir</span>
        </div>
        <div class="h-72" wire:ignore>
            <canvas id="visitorChart"></canvas>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-100">
            <h3 class="text-lg font-semibold text-gray-900">Log Aktivitas Real-Time</h3>
            <p class="text-xs text-gray-400 mt-1">Menampilkan catatan data kunjungan sistem</p>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse whitespace-nowrap">
                <thead>
                    <tr
                        class="bg-gray-50 text-gray-500 text-xs font-semibold uppercase tracking-wider border-b border-gray-100">
                        <th class="px-6 py-3">Waktu</th>
                        <th class="px-6 py-3">Method & URL</th>
                        <th class="px-6 py-3">IP Address</th>
                        <th class="px-6 py-3">Platform / Browser</th>
                        <th class="px-6 py-3">Referer</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm text-gray-700">
                    @forelse($recentVisits as $visit)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 text-xs text-gray-500">
                                {{ $visit->created_at->diffForHumans() }}
                                <span
                                    class="block text-[10px] text-gray-400 mt-0.5">{{ $visit->created_at->format('d/m H:i') }}</span>
                            </td>

                            <td class="px-6 py-4">
                                <div class="flex items-center space-x-2">
                                    <span
                                        class="px-2 py-0.5 text-[10px] font-bold rounded {{ $visit->method === 'GET' ? 'bg-blue-50 text-blue-600' : 'bg-green-50 text-green-600' }}">
                                        {{ $visit->method ?? 'GET' }}
                                    </span>
                                    <span class="font-medium text-gray-800 max-w-xs truncate block"
                                        title="{{ $visit->url }}">
                                        {{ Str::replaceFirst(url('/'), '', $visit->url) ?: '/' }}
                                    </span>
                                </div>
                            </td>

                            <td class="px-6 py-4 font-mono text-xs text-gray-600">
                                {{ $visit->ip ?? '0.0.0.0' }}
                            </td>

                            <td class="px-6 py-4 text-xs">
                                <span
                                    class="text-gray-800 font-medium block">{{ $visit->platform ?? 'Unknown OS' }}</span>
                                <span
                                    class="text-gray-400 block mt-0.5">{{ $visit->browser ?? 'Unknown Browser' }}</span>
                            </td>

                            <td class="px-6 py-4 text-xs text-gray-400 max-w-xs truncate">
                                {{ $visit->referer ? Str::limit($visit->referer, 40) : 'Direct / Langsung' }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-10 text-center text-gray-400 text-sm">
                                Belum ada data kunjungan yang terekam.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-4 bg-gray-50 border-t border-gray-100">
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

                // Jika instance chart sudah ada, hancurkan (destroy) dulu agar tidak tumpang tindih saat dirender ulang oleh poller
                if (chartInstance) {
                    chartInstance.destroy();
                }

                chartInstance = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: @js($chartLabels),
                        datasets: [{
                            label: 'Klik Harian',
                            data: @js($chartValues),
                            borderColor: 'rgba(59, 130, 246, 1)',
                            backgroundColor: 'rgba(59, 130, 246, 0.05)',
                            borderWidth: 2,
                            fill: true,
                            tension: 0.35,
                            pointBackgroundColor: 'rgba(59, 130, 246, 1)',
                            pointRadius: 4
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
                                }
                            },
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    stepSize: 1,
                                    color: '#9ca3af'
                                },
                                grid: {
                                    color: '#f3f4f6'
                                }
                            }
                        }
                    }
                });
            }

            // Jalankan inisialisasi pertama kali halaman di-load
            initChart();

            // Dengarkan perubahan data (karena polling wire:poll) agar chart ikut diperbarui datanya
            $wire.on('echo:*', () => {
                initChart();
            });

            // Mengatasi siklus hidup render ulang komponen Livewire v3 harian
            document.addEventListener('livewire:update', () => {
                // Pastikan canvas tetap menggambar ulang datanya pasca manipulasi DOM dari pagination
                initChart();
            });
        </script>
    @endscript
</div>
