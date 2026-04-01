<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Public pages
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/rooms', [PageController::class, 'rooms'])->name('rooms.index');
Route::get('/rooms/{room:slug}', [PageController::class, 'roomDetail'])->name('rooms.show');
Route::get('/rooms/{room:slug}/availability', [PageController::class, 'roomAvailability'])->name('rooms.availability');
Route::get('/news', [PageController::class, 'newsIndex'])->name('news.index');
Route::get('/news/{news:slug}', [PageController::class, 'newsDetail'])->name('news.show');
Route::get('/availability', [PageController::class, 'calendar'])->name('availability');
Route::get('/api/availability-events', [PageController::class, 'calendarEvents'])->name('api.availability');

// Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Authenticated routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Booking routes
    Route::get('/booking/{room:slug}', [BookingController::class, 'create'])->name('bookings.create');
    Route::post('/booking/{room:slug}', [BookingController::class, 'store'])->name('bookings.store');
    Route::get('/my-bookings', [BookingController::class, 'myBookings'])->name('bookings.my');
    Route::get('/my-bookings/{booking}', [BookingController::class, 'show'])->name('bookings.show');
    Route::get('/my-bookings/{booking}/print', [BookingController::class, 'printTicket'])->name('bookings.print');
});

require __DIR__.'/auth.php';
