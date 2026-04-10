<?php
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

// API routes
Route::get('/availability-events', [PageController::class, 'calendarEvents'])->name('api.availability');