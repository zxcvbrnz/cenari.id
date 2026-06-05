<?php

namespace App\Livewire\Admin; // Sesuaikan dengan namespace aplikasi Anda

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Visitor;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Carbon\Carbon;

class DashboardOverview extends Component
{
    use WithPagination;

    public $poll = true;
    public $period = '7_days'; // Pilihan: today, yesterday, 7_days, 30_days, this_month

    protected $paginationTheme = 'tailwind';

    // Mendengarkan query string agar filter tersimpan saat halaman di-refresh
    protected $queryString = [
        'period' => ['except' => '7_days'],
    ];

    public function updatedPeriod()
    {
        $this->resetPage();
    }

    /**
     * Fitur Ekspor Data Log ke CSV
     */
    public function exportCSV(): StreamedResponse
    {
        $subDays = $this->getStartDateByPeriod();

        $visitors = Visitor::where('created_at', '>=', $subDays)
            ->latest('id')
            ->get();

        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=log_pengunjung_" . now()->format('Y-m-d') . ".csv",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $columns = ['Waktu', 'Method', 'URL', 'IP Address', 'OS/Platform', 'Browser', 'Referer'];

        $callback = function () use ($visitors, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($visitors as $visit) {
                fputcsv($file, [
                    $visit->created_at->toDateTimeString(),
                    $visit->method ?? 'GET',
                    $visit->url,
                    $visit->ip ?? '0.0.0.0',
                    $visit->platform ?? 'Unknown OS',
                    $visit->browser ?? 'Unknown Browser',
                    $visit->referer ?? 'Direct'
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    private function getStartDateByPeriod()
    {
        switch ($this->period) {
            case 'today':
                return Carbon::now()->startOfDay();
            case 'yesterday':
                return Carbon::now()->subDay()->startOfDay();
            case '30_days':
                return Carbon::now()->subDays(29)->startOfDay();
            case 'this_month':
                return Carbon::now()->startOfMonth();
            case '7_days':
            default:
                return Carbon::now()->subDays(6)->startOfDay();
        }
    }

    public function render()
    {
        $subDays = $this->getStartDateByPeriod();
        $endDate = $this->period === 'yesterday' ? Carbon::now()->subDay()->endOfDay() : Carbon::now()->endOfDay();

        // --- 1. METRICS UTAMA ---
        $todayCount = Visitor::whereBetween('created_at', [Carbon::now()->startOfDay(), Carbon::now()->endOfDay()])->count();
        $yesterdayCount = Visitor::whereBetween('created_at', [Carbon::now()->subDay()->startOfDay(), Carbon::now()->subDay()->endOfDay()])->count();

        $growthRate = 0;
        if ($yesterdayCount > 0) {
            $growthRate = round((($todayCount - $yesterdayCount) / $yesterdayCount) * 100, 1);
        }

        // Total Kunjungan Sesuai Periode Terpilih
        $periodTotalHits = Visitor::whereBetween('created_at', [$subDays, $endDate])->count();
        $periodUniqueUsers = Visitor::whereBetween('created_at', [$subDays, $endDate])->distinct('ip')->count('ip');

        // Rasio Kunjungan Berulang (Stickiness Metric)
        $bounceRateEstimate = $periodUniqueUsers > 0 ? round(($periodTotalHits / $periodUniqueUsers), 1) : 0;

        // --- 2. DATA GRAFIK UTAMA ---
        $chartData = Visitor::select(
            DB::raw('DATE(created_at) as visit_date'),
            DB::raw('count(*) as total')
        )
            ->whereBetween('created_at', [$subDays, $endDate])
            ->groupBy(DB::raw('DATE(created_at)'))
            ->orderBy('visit_date', 'asc')
            ->get()
            ->pluck('total', 'visit_date');

        $chartLabels = [];
        $chartValues = [];

        // Menyesuaikan loop label berdasarkan tipe periode
        if ($this->period === 'today' || $this->period === 'yesterday') {
            // Grafik per jam jika memilih hari ini / kemarin
            $targetDay = $this->period === 'today' ? Carbon::today() : Carbon::yesterday();
            $hourlyData = Visitor::select(
                DB::raw('HOUR(created_at) as visit_hour'),
                DB::raw('count(*) as total')
            )
                ->whereDate('created_at', $targetDay)
                ->groupBy(DB::raw('HOUR(created_at)'))
                ->get()
                ->pluck('total', 'visit_hour');

            for ($i = 0; $i <= 23; $i++) {
                $chartLabels[] = sprintf('%02d:00', $i);
                $chartValues[] = $hourlyData->get($i, 0);
            }
        } else {
            // Grafik harian untuk rentang waktu lama
            $daysCount = $this->period === 'this_month' ? Carbon::now()->day - 1 : ($this->period === '30_days' ? 29 : 6);
            for ($i = $daysCount; $i >= 0; $i--) {
                $date = Carbon::now()->subDays($i)->toDateString();
                $chartLabels[] = Carbon::parse($date)->translatedFormat('d M');
                $chartValues[] = $chartData->get($date, 0);
            }
        }

        // --- 3. ANALISIS PLATFORM & BROWSER (BREAKDOWN) ---
        $topBrowsers = Visitor::select('browser', DB::raw('count(*) as total'))
            ->whereBetween('created_at', [$subDays, $endDate])
            ->whereNotNull('browser')
            ->groupBy('browser')
            ->orderBy('total', 'desc')
            ->take(4)
            ->get();

        $topPlatforms = Visitor::select('platform', DB::raw('count(*) as total'))
            ->whereBetween('created_at', [$subDays, $endDate])
            ->whereNotNull('platform')
            ->groupBy('platform')
            ->orderBy('total', 'desc')
            ->take(4)
            ->get();

        // --- 4. TOP CONTENT & SOURCES ---
        $topPages = Visitor::select('url', DB::raw('count(*) as total'))
            ->whereBetween('created_at', [$subDays, $endDate])
            ->groupBy('url')
            ->orderBy('total', 'desc')
            ->take(5)
            ->get();

        $topReferers = Visitor::select('referer', DB::raw('count(*) as total'))
            ->whereBetween('created_at', [$subDays, $endDate])
            ->whereNotNull('referer')
            ->where('referer', '!=', '')
            ->groupBy('referer')
            ->orderBy('total', 'desc')
            ->take(5)
            ->get();

        // --- 5. LOG REAL-TIME TABLE ---
        $recentVisits = Visitor::latest('id')->paginate(10);

        return view('livewire.admin.dashboard-overview', [
            'todayCount'         => $todayCount,
            'growthRate'         => $growthRate,
            'periodTotalHits'    => $periodTotalHits,
            'periodUniqueUsers'  => $periodUniqueUsers,
            'bounceRateEstimate' => $bounceRateEstimate,
            'chartLabels'        => $chartLabels,
            'chartValues'        => $chartValues,
            'topBrowsers'        => $topBrowsers,
            'topPlatforms'       => $topPlatforms,
            'topPages'           => $topPages,
            'topReferers'        => $topReferers,
            'recentVisits'       => $recentVisits,
        ]);
    }
}
