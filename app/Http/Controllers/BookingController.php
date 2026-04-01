<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function create(Room $room)
    {
        $room->load('facilities');
        return view('bookings.create', compact('room'));
    }

    public function store(Request $request, Room $room)
    {
        $validated = $request->validate([
            'check_in_date' => 'required|date|after_or_equal:today',
            'check_out_date' => 'required|date|after:check_in_date',
            'guests' => 'required|integer|min:1|max:' . $room->capacity,
            'notes' => 'nullable|string|max:500',
        ]);

        // Check for date conflicts
        $conflict = Booking::where('room_id', $room->id)
            ->where('payment_status', '!=', 'cancelled')
            ->where(function ($query) use ($validated) {
                $query->whereBetween('check_in_date', [$validated['check_in_date'], $validated['check_out_date']])
                    ->orWhereBetween('check_out_date', [$validated['check_in_date'], $validated['check_out_date']])
                    ->orWhere(function ($q) use ($validated) {
                        $q->where('check_in_date', '<=', $validated['check_in_date'])
                          ->where('check_out_date', '>=', $validated['check_out_date']);
                    });
            })
            ->exists();

        if ($conflict) {
            return back()->withErrors(['check_in_date' => 'Tanggal yang dipilih sudah terisi oleh booking lain.'])->withInput();
        }

        $checkIn = \Carbon\Carbon::parse($validated['check_in_date']);
        $checkOut = \Carbon\Carbon::parse($validated['check_out_date']);
        $days = $checkIn->diffInDays($checkOut);
        $totalPrice = $days * $room->price_per_day;

        $booking = Booking::create([
            'user_id' => Auth::id(),
            'room_id' => $room->id,
            'check_in_date' => $validated['check_in_date'],
            'check_out_date' => $validated['check_out_date'],
            'guests' => $validated['guests'],
            'total_price' => $totalPrice,
            'notes' => $validated['notes'] ?? null,
            'payment_status' => 'unpaid',
        ]);

        return redirect()->route('bookings.show', $booking)->with('success', 'Booking berhasil dibuat! Kode booking Anda: ' . $booking->booking_code);
    }

    public function myBookings()
    {
        $bookings = Auth::user()->bookings()->with('room')->orderByDesc('created_at')->paginate(10);
        return view('bookings.index', compact('bookings'));
    }

    public function show(Booking $booking)
    {
        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }
        $booking->load('room', 'user');
        return view('bookings.show', compact('booking'));
    }

    public function printTicket(Booking $booking)
    {
        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }

        if ($booking->payment_status !== 'paid') {
            return back()->with('error', 'Tiket hanya bisa dicetak jika pembayaran sudah lunas.');
        }

        $booking->load('room', 'user');

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('bookings.ticket', compact('booking'));

        return $pdf->download('ticket-' . $booking->booking_code . '.pdf');
    }
}
