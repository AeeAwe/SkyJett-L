<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\AdminController;

Route::get('/', [IndexController::class, 'index'])->name('home');
Route::get('/catalog', [FlightController::class, 'index'])->name('flights.index');

Route::middleware('guest')->group(function () {
    Route::get('/auth', [AuthController::class, 'index'])->name('auth.index');
    Route::post('/register', [AuthController::class, 'register'])->name('auth.register');
    Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('/profile/logout', [ProfileController::class, 'logout'])->name('profile.logout');
    Route::delete('/profile/delete', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::delete('/bookings/{booking}/delete', [BookingController::class, 'destroy'])->name('booking.destroy');
    Route::post('/flights/{flight}/book', [BookingController::class, 'store'])->name('flights.book');
});

Route::middleware('admin')->group(function () {
    Route::get('/admin/users', [AdminController::class, 'indexUsers'])->name('admin.users');
    Route::get('/admin/flights', [AdminController::class, 'indexFlights'])->name('admin.flights');
    Route::get('/admin/flights/create', [AdminController::class, 'create'])->name('admin.flights.create');
    Route::get('/admin/flights/edit',  [AdminController::class, 'edit'])->name('admin.flights.edit');
    Route::post('/admin/flights/store', [AdminController::class, 'store'])->name('admin.flights.store');
    Route::get('/admin/flights/{flight}/edit', [AdminController::class, 'edit'])->name('admin.flights.edit');
    Route::put('/admin/flights/{flight}/update', [AdminController::class, 'update'])->name('admin.flights.update');
    Route::delete('/admin/flights/{flight}/delete', [AdminController::class, 'flightDestroy'])->name('admin.flights.destroy');
    Route::delete('/admin/users/{user}/delete', [AdminController::class, 'userDestroy'])->name('admin.users.destroy');
    Route::delete('/admin/users/{user}/bookings/{booking}/delete', [AdminController::class, 'bookingDestroy'])->name('admin.booking.destroy');
});