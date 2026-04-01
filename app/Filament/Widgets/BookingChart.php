<?php

namespace App\Filament\Widgets;

use App\Models\Booking;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Illuminate\Support\Carbon;

class BookingChart extends ChartWidget
{
    protected static ?string $heading = 'Jumlah Pemesanan per Bulan';
    
    protected static ?int $sort = 2;

    protected int | string | array $columnSpan = 'full';

    public ?string $filter = null;

    protected function getFilters(): ?array
    {
        $years = range(date('Y'), date('Y') - 4);
        return array_combine($years, $years);
    }

    protected function getData(): array
    {
        $year = $this->filter ?? date('Y');
        $labels = [
            'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 
            'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'
        ];

        // Ambil semua data ruangan
        $rooms = \App\Models\Room::select('id', 'name')->get();
        
        $datasets = [];
        $colorPalette = [
            '#6366f1', '#a855f7', '#ec4899', '#f43f5e', '#f59e0b', '#10b981', '#06b6d4', '#3b82f6'
        ];

        $totalMonthlyData = array_fill(0, 12, 0);

        foreach ($rooms as $index => $room) {
            $monthlyData = [];
            for ($month = 1; $month <= 12; $month++) {
                $count = \App\Models\Booking::whereMonth('created_at', $month)
                    ->whereYear('created_at', $year)
                    ->where('room_id', $room->id)
                    ->count();
                $monthlyData[] = $count;
                $totalMonthlyData[$month - 1] += $count;
            }

            $datasets[] = [
                'label' => $room->name,
                'data' => $monthlyData,
                'backgroundColor' => $colorPalette[$index % count($colorPalette)],
                'borderRadius' => 6,
                'borderWidth' => 0,
            ];
        }

        // Tambahkan dataset Line untuk Total
        $datasets[] = [
            'label' => 'Total Keseluruhan',
            'data' => $totalMonthlyData,
            'type' => 'line',
            'borderColor' => '#334155', // Slate-700
            'borderWidth' => 3,
            'pointRadius' => 4,
            'pointBackgroundColor' => '#334155',
            'fill' => false,
            'tension' => 0.4,
            'zIndex' => 10,
        ];

        return [
            'datasets' => $datasets,
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
