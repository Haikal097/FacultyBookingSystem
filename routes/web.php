<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('homepage');

Route::get('/userprofile', function () {
    return view('userprofile');
})->name('userprofile'); 

Route::get('/infographic', function () {
    return view('infographic');
})->name('infographic'); 

Route::get('/adminlogin', function () {
    return view('admin.login');
})->name('admin.login'); 

Route::get('/admindashboard', function () {
    return view('admin.dashboard');
})->name('admin.dashboard'); 

Route::get('/manageusers', function () {
    return view('admin.manageuser');
})->name('admin.manageuser'); 

Route::get('/managerooms', function () {
    return view('admin.manageroom');
})->name('admin.manageroom');

Route::get('/managebookings', function () {
    return view('admin.managebooking');
})->name('admin.managebooking'); 

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
});

use App\Http\Controllers\BookingController;

Route::middleware(['auth'])->group(function () {
    Route::get('/booking', [BookingController::class, 'create'])->name('bookings.create');
    Route::post('/booking', [BookingController::class, 'store'])->name('bookings.store');
});

require __DIR__.'/auth.php';
