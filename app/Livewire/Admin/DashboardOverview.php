<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Visitor;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardOverview extends Component
{
    // Tambahkan properti jika Anda ingin mengontrol fitur polling dari luar
    public $poll = true;

    public function render()
    {
        // 1. Total Kunjungan (Hits) Hari Ini
        $todayCount = Visitor::whereDate('created_at', Carbon::today())->count();

        // 2. Total Pengunjung Unik Hari Ini (Dihitung berdasarkan keunikan Alamat IP)
        $uniqueTodayCount = Visitor::whereDate('created_at', Carbon::today())
            ->distinct('ip')
            ->count('ip');

        // 3. Mengambil Tren Kunjungan 7 Hari Terakhir untuk Grafik (Chart.js)
        $chartData = Visitor::select(
            DB::raw('DATE(created_at) as visit_date'),
            DB::raw('count(*) as total')
        )
            ->where('created_at', '>=', Carbon::now()->subDays(6)->startOfDay())
            ->groupBy(DB::raw('DATE(created_at)'))
            ->orderBy('visit_date', 'asc')
            ->get()
            ->pluck('total', 'visit_date'); // Mengubah format ke [ 'YYYY-MM-DD' => total ]

        // 4. Struktur data kosong untuk memastikan grafik memiliki 7 titik hari meskipun ada hari yang sepi (0 kunjungan)
        $chartLabels = [];
        $chartValues = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i)->toDateString();
            $label = Carbon::parse($date)->translatedFormat('d M'); // Contoh hasil: "30 Mei"

            $chartLabels[] = $label;
            $chartValues[] = $chartData->get($date, 0); // Jika tanggal tidak ada di DB, beri nilai default 0
        }

        // 5. Mengambil 5 Log Aktivitas Kunjungan Terbaru
        $recentVisits = Visitor::latest('id')
            ->take(5)
            ->get();

        // 6. Mengirim data ke View Blade
        return view('livewire.admin.dashboard-overview', [
            'todayCount'       => $todayCount,
            'uniqueTodayCount' => $uniqueTodayCount,
            'chartLabels'      => $chartLabels,
            'chartValues'      => $chartValues,
            'recentVisits'     => $recentVisits,
        ]);
    }
}
