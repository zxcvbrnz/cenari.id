<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Visitor; // Sesuaikan dengan model yang Anda gunakan
use Illuminate\Support\Facades\DB;

class DashboardOverview extends Component
{
    public function render()
    {
        // Total Pengunjung Hari Ini
        $todayCount = Visitor::where('visit_date', now()->toDateString())->count();

        // Total Pengunjung Unik Hari Ini (Berdasarkan IP)
        $uniqueTodayCount = Visitor::where('visit_date', now()->toDateString())
            ->distinct('ip_address')
            ->count();

        // Data 7 Hari Terakhir untuk Grafik
        $chartData = Visitor::select('visit_date', DB::raw('count(*) as total'))
            ->where('visit_date', '>=', now()->subDays(6)->toDateString())
            ->groupBy('visit_date')
            ->orderBy('visit_date', 'asc')
            ->get();

        return view('livewire.admin.dashboard-overview', [
            'todayCount' => $todayCount,
            'uniqueTodayCount' => $uniqueTodayCount,
            'chartLabels' => $chartData->pluck('visit_date')->map(fn($date) => date('d M', strtotime($date))),
            'chartValues' => $chartData->pluck('total'),
        ]);
    }
}
