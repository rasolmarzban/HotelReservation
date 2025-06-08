<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HotelsController;
use App\Http\Controllers\HotelItemsController;
use App\Http\Controllers\CitiesController;
use App\Http\Controllers\ProvincesController;
use App\Http\Controllers\CountriesController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\MyHotelsController;

use function Ramsey\Uuid\v1;

// Public routes
Route::get('/', [HotelsController::class, 'index'])->name('home');
Route::get('/about', function () {
    return view('about');
})->name('about');

// Hotel routes
Route::get('/hotels', [HotelsController::class, 'index'])->name('hotels.index');
Route::get('/hotels/{hotel}', [HotelsController::class, 'show'])->name('hotels.show');
Route::get('/makeHotel', [HotelsController::class, 'createHotel'])->name('hotels.create');

// Protected routes that require authentication
Route::middleware(['auth:sanctum'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [HotelsController::class, 'index'])->name('dashboard');

    // My Hotels Management
    Route::get('/my-hotels', [MyHotelsController::class, 'index'])->name('my-hotels.index');

    // Hotel management routes
    Route::post('/hotels', [HotelsController::class, 'store'])->name('hotels.store');
    Route::get('/hotels/{hotel}/edit', [HotelsController::class, 'edit'])->name('hotels.edit');
    Route::put('/hotels/{hotel}', [HotelsController::class, 'update'])->name('hotels.update');
    Route::delete('/hotels/{hotel}', [HotelsController::class, 'destroy'])->name('hotels.destroy');

    // Booking routes
    Route::post('/hotels/{hotel}/book', [BookingController::class, 'store'])->name('hotels.book');
    Route::get('/hotel/{hotelId}/book/{roomId}', [BookingController::class, 'create'])->name('hotel.book');
    Route::post('/hotel/book', [BookingController::class, 'store'])->name('hotel.book.store');
    Route::get('/bookings/{booking}', [BookingController::class, 'show'])->name('bookings.show');

    // Hotel Items Management
    Route::resource('hotel-items', HotelItemsController::class)->except(['index', 'create', 'show', 'edit']);

    // Location Management
    Route::resource('cities', CitiesController::class);
    Route::resource('provinces', ProvincesController::class);
    Route::resource('countries', CountriesController::class);
});
