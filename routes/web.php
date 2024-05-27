<?php

use App\Dashboard\Controllers\DashboardController;
use App\Guest\Controllers\GuestController;
use App\Homepage\Controllers\HomePageController;
use App\RsvpResponse\Controllers\RsvpSuccessController;
use App\RsvpResponse\Middleware\RsvpSuccessMiddleware;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Authenticated;
use App\RsvpResponse\Controllers\RsvpResponseCodeController;
use App\RsvpResponse\Controllers\RsvpResponseFormController;
use App\RsvpResponse\Middleware\RsvpCodeCheckMiddleware;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get(uri: '/', action: [HomePageController::class, 'show'])
    ->name('home');

Route::get(uri: '/rsvp', action: [RsvpResponseCodeController::class, 'show'])
    ->name('guest.rsvp.code');

Route::get(uri: '/rsvp/form', action: [RsvpResponseFormController::class, 'show'])
    ->name('guest.rsvp.form')
    ->middleware(RsvpCodeCheckMiddleware::class);

Route::get(uri: '/rsvp/success', action: [RsvpSuccessController::class, 'show'])
    ->name('guest.rsvp.success')
    ->middleware(RsvpSuccessMiddleware::class);;

Route::middleware([Authenticated::class])->group(function () {
    Route::get(uri: '/dashboard', action: [DashboardController::class, 'show'])
        ->name('admin.dashboard');

    Route::get(uri: '/guests', action: [GuestController::class, 'index'])
        ->name('admin.guests.index');

    Route::get(uri: '/todo', action: [DashboardController::class, 'show'])
        ->name('admin.todo.index');

    Route::get(uri: '/budget', action: [DashboardController::class, 'show'])
        ->name('admin.budget');

    Route::get(uri: '/documents', action: [DashboardController::class, 'show'])
        ->name('admin.documents');

    Route::get(uri: '/settings', action: [DashboardController::class, 'show'])
        ->name('admin.settings');
});

