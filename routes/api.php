<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RoomApiController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\BookingApiController;

Route::get('/users', [UserController::class, 'index']);
Route::apiResource('rooms', RoomApiController::class);
Route::get('/bookings/{id}/pdf', [BookingApiController::class, 'generatePdf']);