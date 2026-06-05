<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Visitor;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardOverview extends Component
{
    use WithPagination;

    public $poll = true;
    public $period = '7_days'; // Default period filter: 'today', '7_days', '30_days', 'this_month'

    protected $paginationTheme = 'tailwind';

    // Reset pagination ketika filter waktu diubah agar tidak bug
    public function updatedPeriod()
    {
        $this->resetPage();
    }

    public function updatingPage()
    {
        // Menjamin transisi halaman tidak berbenturan dengan polling data
    }

    public function render()
    {
        // --- 1. METRICS & TRENDS ---
        $todayCount = Visitor::whereDate('created_at', Carbon::today())->count();
        $yesterdayCount = Visitor::whereDate('created_at', Carbon::yesterday())->count();

        // Hitung persentase kenaikan/penurunan dibanding kemarin
        $growthRate = 0;
        if ($yesterdayCount > 0) {
            $growthRate = (($todayCount - $yesterdayCount) / $yesterdayCount) * 180; // Menggunakan perhitungan standar persen
            $growthRate = round((($todayCount - $yesterdayCount) / $yesterdayCount) * 100, 1);
        }

        $uniqueTodayCount = Visitor::whereDate('created_at', Carbon::today())
            ->distinct('ip')
            ->count('ip');

        // --- 2. CONFIG FILTER PERIODE WAKTU ---
        switch ($this->period) {
            case 'today':
                $daysCount = 0;
                $subDays = Carbon::now()->startOfDay();
                break;
            case '30_days':
                $daysCount = 29;
                $subDays = Carbon::now()->subDays(29)->startOfDay();
                break;
            case 'this_month':
                $daysCount = Carbon::now()->day - 1;
                $subDays = Carbon::now()->startOfMonth();
                break;
            case '7_days':
            default:
                $daysCount = 6;
                $subDays = Carbon::now()->subDays(6)->startOfDay();
                break;
        }

        // --- 3. AMBIL DATA GRAFIK (TREN KUNJUNGAN) ---
        $chartData = Visitor::select(
            DB::raw('DATE(created_at) as visit_date'),
            DB::raw('count(*) as total')
        )
            ->where('created_at', '>=', $subDays)
            ->groupBy(DB::raw('DATE(created_at)'))
            ->orderBy('visit_date', 'asc')
            ->get()
            ->pluck('total', 'visit_date');

        $chartLabels = [];
        $chartValues = [];

        for ($i = $daysCount; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i)->toDateString();
            $label = Carbon::parse($date)->translatedFormat($this->period === 'today' ? 'H:i' : 'd M');

            $chartLabels[] = $label;
            $chartValues[] = $chartData->get($date, 0);
        }

        // --- 4. TOP STATS (KONTEN & REFERER POPULER) ---
        $topPages = Visitor::select('url', DB::raw('count(*) as total'))
            ->where('created_at', '>=', $subDays)
            ->groupBy('url')
            ->orderBy('total', 'desc')
            ->take(5)
            ->get();

        $topReferers = Visitor::select('referer', DB::raw('count(*) as total'))
            ->where('created_at', '>=', $subDays)
            ->whereNotNull('referer')
            ->where('referer', '!=', '')
            ->groupBy('referer')
            ->orderBy('total', 'desc')
            ->take(5)
            ->get();

        // --- 5. LOG AKTIVITAS REAL-TIME PAGINATED ---
        $recentVisits = Visitor::latest('id')->paginate(10);

        return view('livewire.admin.dashboard-overview', [
            'todayCount'       => $todayCount,
            'yesterdayCount'   => $yesterdayCount,
            'growthRate'       => $growthRate,
            'uniqueTodayCount' => $uniqueTodayCount,
            'chartLabels'      => $chartLabels,
            'chartValues'      => $chartValues,
            'topPages'         => $topPages,
            'topReferers'      => $topReferers,
            'recentVisits'     => $recentVisits,
        ]);
    }
}
