<div wire:poll.30s class="p-6 space-y-6">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
            <p class="text-sm font-medium text-gray-500">Total Pengunjung Hari Ini</p>
            <p class="text-3xl font-semibold text-gray-900 mt-2">{{ $todayCount }}</p>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
            <p class="text-sm font-medium text-gray-500">Pengunjung Unik Hari Ini</p>
            <p class="text-3xl font-semibold text-gray-900 mt-2">{{ $uniqueTodayCount }}</p>
        </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
        <h3 class="text-lg font-medium text-gray-900 mb-4">Statistik 7 Hari Terakhir</h3>
        <div class="h-64" wire:ignore>
            <canvas id="visitorChart"></canvas>
        </div>
    </div>

    @assets
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @endassets

    @script
        <script>
            const ctx = document.getElementById('visitorChart');

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: @js($chartLabels),
                    datasets: [{
                        label: 'Jumlah Kunjungan',
                        data: @js($chartValues),
                        borderColor: 'rgb(59, 130, 246)',
                        backgroundColor: 'rgba(59, 130, 246, 0.1)',
                        fill: true,
                        tension: 0.3
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1
                            }
                        }
                    }
                }
            });
        </script>
    @endscript
</div>
