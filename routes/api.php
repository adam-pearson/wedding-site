<?php

use App\Http\Controllers\AddGuestController;
use App\Http\Middleware\Authenticated;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->group(function () {
    Route::post(uri: '/guests/store', action: AddGuestController::class)
        ->name('admin.guests.store');
});