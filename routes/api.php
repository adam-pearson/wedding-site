<?php

use App\Guest\Controllers\API\GuestApiController;
use App\Guest\Controllers\API\GuestGroupsApiController;
use App\RsvpResponse\Controllers\API\RsvpResponseApiController;
use App\RsvpResponse\Middleware\RsvpRepeatedSubmissionCheckMiddleware;
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
    Route::post(uri: '/guests', action: [GuestApiController::class, 'store'])
        ->name('admin.guests.store')
        ->middleware(RsvpRepeatedSubmissionCheckMiddleware::class);

    Route::patch(uri: '/guests/{guest}', action: [GuestApiController::class, 'update'])
        ->name('admin.guests.update');

    Route::delete(uri: '/guests', action: [GuestApiController::class, 'destroy'])
        ->name('admin.guests.destroy');

    Route::get(uri: '/guests/list', action: [GuestApiController::class, 'index'])
        ->name('admin.guests.list');

    Route::get('/guests/list/download', [GuestApiController::class, 'download'])
        ->name('admin.guests.download');

    Route::get(uri: '/groups/list', action: [GuestGroupsApiController::class, 'index'])
        ->name('admin.groups.list');
});

Route::post(uri: '/rsvp/{guest:unique_code}', action: [RsvpResponseApiController::class, 'store'])
    ->name('guest.rsvp.submit');
