<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('homepage');

Route::get('/infographic', function () {
    return view('infographic');
})->name('infographic');

Route::get('/adminlogin', function () {
    return view('admin.login');
})->name('admin.login'); 

Route::post('/managebookings/{id}/approve', [BookingController::class, 'approve'])->name('bookings.approve');
Route::post('/managebookings/{id}/reject', [BookingController::class, 'reject'])->name('bookings.reject');

Route::get('/adminsettings', function () {
    return view('admin.setting');
})->name('admin.setting'); 

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::get('/userprofile', [BookingController::class, 'myBookings'])->name('userprofile');
    Route::patch('/profile', [UserController::class, 'update'])->name('userprofile.update');

    Route::get('/admindashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/manageusers', [UserController::class, 'index'])->name('admin.manageuser');
    Route::get('/managebookings', [BookingController::class, 'index'])->name('admin.managebooking');
    Route::get('/admin/manage-bookings', [BookingController::class, 'manageBookings'])->name('admin.manage.bookings');
    Route::post('/managebookings/{id}/approve', [BookingController::class, 'approve'])->name('bookings.approve');
    Route::post('/managebookings/{id}/reject', [BookingController::class, 'reject'])->name('bookings.reject');
    Route::get('/adminsettings', function () {
        return view('admin.setting');
    })->name('admin.setting');

    Route::get('/managerooms', [RoomController::class, 'index'])->name('rooms.index');
    Route::post('/rooms', [RoomController::class, 'store'])->name('rooms.store');
    Route::delete('/rooms/{room}', [RoomController::class, 'destroy'])->name('rooms.destroy');
    Route::put('/rooms/{room}', [RoomController::class, 'update'])->name('rooms.update');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/booking', [BookingController::class, 'create'])->name('bookings.create');
    Route::post('/booking', [BookingController::class, 'store'])->name('bookings.store');
    Route::delete('/bookings/{id}', [BookingController::class, 'destroy'])->name('bookings.destroy');
    Route::post('/bookings/{id}/cancel', [BookingController::class, 'cancel'])->name('bookings.cancel');
});

Route::get('/pdfview/{id}', [BookingController::class, 'pdfview']);



require __DIR__.'/auth.php';
