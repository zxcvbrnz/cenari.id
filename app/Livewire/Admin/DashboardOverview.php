<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination; // 1. Tambahkan Trait Pagination
use App\Models\Visitor;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardOverview extends Component
{
    use WithPagination; // 2. Gunakan Trait di dalam class

    public $poll = true;

    // Opsional: Gunakan styling pagination Tailwind bawaan Livewire
    protected $paginationTheme = 'tailwind';

    // Hook otomatis jika halaman berubah, fitur polling di-reset sementara agar halus
    public function updatingPage()
    {
        // Menjamin transisi halaman tidak berbenturan dengan polling data harian
    }

    public function render()
    {
        // 1. Total Kunjungan (Hits) Hari Ini
        $todayCount = Visitor::whereDate('created_at', Carbon::today())->count();

        // 2. Total Pengunjung Unik Hari Ini
        $uniqueTodayCount = Visitor::whereDate('created_at', Carbon::today())
            ->distinct('ip')
            ->count('ip');

        // 3. Mengambil Tren Kunjungan 7 Hari Terakhir untuk Grafik
        $chartData = Visitor::select(
            DB::raw('DATE(created_at) as visit_date'),
            DB::raw('count(*) as total')
        )
            ->where('created_at', '>=', Carbon::now()->subDays(6)->startOfDay())
            ->groupBy(DB::raw('DATE(created_at)'))
            ->orderBy('visit_date', 'asc')
            ->get()
            ->pluck('total', 'visit_date');

        $chartLabels = [];
        $chartValues = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i)->toDateString();
            $label = Carbon::parse($date)->translatedFormat('d M');

            $chartLabels[] = $label;
            $chartValues[] = $chartData->get($date, 0);
        }

        // 4. Ganti ->take(5)->get() menjadi ->paginate(10)
        // Menampilkan 10 data kunjungan per halaman
        $recentVisits = Visitor::latest('id')->paginate(10);

        return view('livewire.admin.dashboard-overview', [
            'todayCount'       => $todayCount,
            'uniqueTodayCount' => $uniqueTodayCount,
            'chartLabels'      => $chartLabels,
            'chartValues'      => $chartValues,
            'recentVisits'     => $recentVisits, // Variabel ini sekarang bertipe LengthAwarePaginator
        ]);
    }
}
