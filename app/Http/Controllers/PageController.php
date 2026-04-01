<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Gallery;
use App\Models\News;
use App\Models\Room;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        $rooms = Room::where('is_active', true)->with('facilities')->take(6)->get();
        $galleries = Gallery::orderBy('sort_order')->take(8)->get();
        $news = News::where('is_published', true)->orderByDesc('published_at')->take(3)->get();

        return view('welcome', compact('rooms', 'galleries', 'news'));
    }

    public function rooms(Request $request)
    {
        $query = Room::where('is_active', true)->with('facilities');

        // Filter berdasarkan ketersediaan tanggal
        if ($date = $request->get('date')) {
            $query->whereDoesntHave('bookings', function($q) use ($date) {
                // Room tidak tersedia jika ada booking dengan tanggal tsb dan bukan cancelled
                $q->where('payment_status', '!=', 'cancelled')
                  ->whereDate('check_in_date', '<=', $date)
                  ->whereDate('check_out_date', '>=', $date);
            });
        }

        $rooms = $query->paginate(9)->withQueryString();
        
        return view('rooms.index', compact('rooms', 'date'));
    }

    public function roomDetail(Room $room)
    {
        $room->load('facilities');
        return view('rooms.show', compact('room'));
    }

    public function roomAvailability(Request $request, Room $room)
    {
        $month = $request->get('month', now()->month);
        $year = $request->get('year', now()->year);

        $bookings = Booking::where('room_id', $room->id)
            ->where('payment_status', '!=', 'cancelled')
            ->whereYear('check_in_date', '<=', $year)
            ->whereYear('check_out_date', '>=', $year)
            ->get(['check_in_date', 'check_out_date']);

        $bookedDates = [];
        foreach ($bookings as $booking) {
            $start = $booking->check_in_date->copy();
            $end = $booking->check_out_date->copy();
            while ($start->lte($end)) {
                $bookedDates[] = $start->format('Y-m-d');
                $start->addDay();
            }
        }

        return response()->json([
            'booked_dates' => array_unique($bookedDates),
        ]);
    }

    public function newsIndex()
    {
        $news = News::where('is_published', true)->orderByDesc('published_at')->paginate(9);
        return view('news.index', compact('news'));
    }

    public function newsDetail(News $news)
    {
        if (!$news->is_published) {
            abort(404);
        }
        return view('news.show', compact('news'));
    }

    public function calendar()
    {
        return view('calendar');
    }

    public function calendarEvents(Request $request)
    {
        $start = $request->get('start');
        $end   = $request->get('end');

        // Ambil semua room aktif
        $allRooms = Room::where('is_active', true)->get(['id', 'name', 'slug']);
        $totalRooms = $allRooms->count();

        // Ambil booking aktif dalam rentang
        $query = Booking::with('room')->where('payment_status', '!=', 'cancelled');
        if ($start && $end) {
            $query->where(function ($q) use ($start, $end) {
                $q->whereBetween('check_in_date', [$start, $end])
                  ->orWhereBetween('check_out_date', [$start, $end])
                  ->orWhere(function ($sub) use ($start, $end) {
                      $sub->where('check_in_date', '<=', $start)
                          ->where('check_out_date', '>=', $end);
                  });
            });
        }
        $bookings = $query->get();

        // Hitung per-hari: rooms yang terpakai
        $startDate = $start ? \Carbon\Carbon::parse($start) : now()->startOfMonth();
        $endDate   = $end   ? \Carbon\Carbon::parse($end)->subDay() : now()->endOfMonth();

        $bookedByDate = [];
        foreach ($bookings as $booking) {
            $cur = $booking->check_in_date->copy();
            $fin = $booking->check_out_date->copy();
            while ($cur->lte($fin)) {
                $dateKey = $cur->format('Y-m-d');
                if (!isset($bookedByDate[$dateKey])) {
                    $bookedByDate[$dateKey] = [];
                }
                $bookedByDate[$dateKey][] = $booking->room->name ?? 'Unit';
                $cur->addDay();
            }
        }

        $events = [];

        // Event: kamar terpakai (merah)
        foreach ($bookings as $booking) {
            $checkOutMod = $booking->check_out_date->copy()->addDay()->format('Y-m-d');
            $events[] = [
                'title'           => $booking->room->name ?? 'Terpakai',
                'start'           => $booking->check_in_date->format('Y-m-d'),
                'end'             => $checkOutMod,
                'color'           => '#ef4444',
                'textColor'       => '#ffffff',
                'allDay'          => true,
                'display'         => 'block',
                'extendedProps'   => [
                    'type'      => 'booked',
                    'room_slug' => $booking->room->slug ?? null,
                ],
            ];
        }

        // Event: ringkasan kamar kosong per hari (hijau)
        $cur = $startDate->copy();
        while ($cur->lte($endDate)) {
            $dateKey    = $cur->format('Y-m-d');
            $bookedList = $bookedByDate[$dateKey] ?? [];
            $bookedCount = count(array_unique($bookedList));
            $freeCount   = $totalRooms - $bookedCount;

            if ($freeCount > 0 && $cur->gte(now()->startOfDay())) {
                $events[] = [
                    'title'         => $freeCount . ' unit tersedia',
                    'start'         => $dateKey,
                    'allDay'        => true,
                    'color'         => '#2d4a22',
                    'textColor'     => '#ffffff',
                    'display'       => 'block',
                    'extendedProps' => [
                        'type'       => 'available',
                        'free_count' => $freeCount,
                        'date'       => $dateKey,
                    ],
                ];
            }
            $cur->addDay();
        }

        return response()->json($events);
    }
}
