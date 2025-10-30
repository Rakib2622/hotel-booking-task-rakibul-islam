<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\FrontendController;
use App\Http\Controllers\BookingController;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\RoomCategoryController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;

Route::get('/', [FrontendController::class, 'index'])->name('home');

// Booking flow
Route::get('/booking', [BookingController::class, 'create'])->name('booking.create');
Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
Route::get('/booking/thank-you/{id}', [BookingController::class, 'thankYou'])->name('booking.thankyou');

// Availability & Pricing (AJAX or normal POST)
Route::post('/check-availability', [BookingController::class, 'checkAvailability'])->name('booking.checkAvailability');
Route::post('/get-available-categories', [BookingController::class, 'getAvailableCategories'])->name('booking.getAvailableCategories');

Route::post('/get-blocked-dates', [BookingController::class, 'getBlockedDates'])->name('booking.getBlockedDates');


Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Manage room categories
    Route::resource('room-categories', RoomCategoryController::class);

    // Manage individual rooms (if used)
    Route::resource('rooms', RoomController::class);

    // Manage bookings
    Route::resource('bookings', AdminBookingController::class)->only(['index', 'show', 'destroy']);
});
