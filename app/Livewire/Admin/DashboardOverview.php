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
        $todayCount = Visitor::where('created_at', now()->toDateString())->count();

        // Total Pengunjung Unik Hari Ini (Berdasarkan IP)
        $uniqueTodayCount = Visitor::where('created_at', now()->toDateString())
            ->distinct('ip')
            ->count();

        // Data 7 Hari Terakhir untuk Grafik
        $chartData = Visitor::select('created_at', DB::raw('count(*) as total'))
            ->where('created_at', '>=', now()->subDays(6)->toDateString())
            ->groupBy('created_at')
            ->orderBy('created_at', 'asc')
            ->get();

        return view('livewire.admin.dashboard-overview', [
            'todayCount' => $todayCount,
            'uniqueTodayCount' => $uniqueTodayCount,
            'chartLabels' => $chartData->pluck('created_at')->map(fn($date) => date('d M', strtotime($date))),
            'chartValues' => $chartData->pluck('total'),
        ]);
    }
}
