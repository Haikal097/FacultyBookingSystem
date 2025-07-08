<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RoomApiController;
use App\Http\Controllers\Api\UserController;


Route::get('/users', [UserController::class, 'index']);
Route::apiResource('rooms', RoomApiController::class);