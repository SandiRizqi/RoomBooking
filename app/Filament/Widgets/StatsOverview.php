<?php

namespace App\Filament\Widgets;

use App\Models\Booking;
use App\Models\Room;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $totalBookings  = Booking::count();
        $paidBookings   = Booking::where('payment_status', 'paid')->count();
        $unpaidBookings = Booking::where('payment_status', 'unpaid')->count();
        $totalRevenue   = Booking::where('payment_status', 'paid')->sum('total_price');
        $activeRooms    = Room::where('is_active', true)->count();

        // Monthly bookings for sparkline
        $monthlyData = [];
        for ($i = 5; $i >= 0; $i--) {
            $monthlyData[] = Booking::whereYear('created_at', now()->subMonths($i)->year)
                ->whereMonth('created_at', now()->subMonths($i)->month)
                ->count();
        }

        return [
            Stat::make('Total Pemesanan', $totalBookings)
                ->description('Semua riwayat reservasi tamu')
                ->descriptionIcon('heroicon-m-calendar-days')
                ->chart($monthlyData)
                ->color('primary'),

            Stat::make('Pendapatan Lunas', 'Rp ' . number_format($totalRevenue, 0, ',', '.'))
                ->description("{$paidBookings} transaksi terkonfirmasi")
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('success'),

            Stat::make('Menunggu Pembayaran', $unpaidBookings)
                ->description('Reservasi belum terkonfirmasi')
                ->descriptionIcon('heroicon-m-clock')
                ->color('warning'),

            Stat::make('Unit Aktif', $activeRooms)
                ->description('Siap dipesan tamu')
                ->descriptionIcon('heroicon-m-home-modern')
                ->color('info'),
        ];
    }
}
