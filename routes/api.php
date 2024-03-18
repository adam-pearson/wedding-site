<?php

use App\Http\Controllers\AddGuestController;
use App\Http\Controllers\ShowGuestsController;
use App\Http\Controllers\UpdateGuestController;
use App\Http\Controllers\DeleteGuestController;
use App\Http\Controllers\RsvpController;
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
    Route::post(uri: '/guests', action: AddGuestController::class)
        ->name('admin.guests.store');

    Route::put(uri: '/guests', action: UpdateGuestController::class)
    ->name('admin.guests.update');

    Route::delete(uri: '/guests', action: DeleteGuestController::class)
        ->name('admin.guests.destroy');

    Route::get(uri: '/guests/list', action: ShowGuestsController::class)
    ->name('admin.guests.list');
});

Route::post(uri: '/rsvp/{guest:code}', action: RsvpController::class)
    ->name('guest.rsvp.submit');