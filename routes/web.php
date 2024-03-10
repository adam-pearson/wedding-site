<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminGuestListController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Authenticated;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\RsvpController;
use App\Http\Controllers\RsvpFormController;
use App\Http\Middleware\RsvpCodeCheckMiddleware;

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

Route::get(uri: '/', action: HomePageController::class)
    ->name('home');

Route::get(uri: '/rsvp', action: RsvpController::class)
    ->name('guest.rsvp.code');

Route::get(uri: '/rsvp/form', action: RsvpFormController::class)
    ->name('guest.rsvp.form')
    ->middleware(RsvpCodeCheckMiddleware::class);


Route::middleware([Authenticated::class])->group(function () {
    Route::get(uri: '/dashboard', action: AdminDashboardController::class)
        ->name('admin.dashboard');

    Route::get(uri: '/guests', action: AdminGuestListController::class)
        ->name('admin.guests.index');

    Route::get(uri: '/todo', action: AdminDashboardController::class)
        ->name('admin.todo.index');

    Route::get(uri: '/budget', action: AdminDashboardController::class)
        ->name('admin.budget');

    Route::get(uri: '/documents', action: AdminDashboardController::class)
        ->name('admin.documents');

    Route::get(uri: '/settings', action: AdminDashboardController::class)
        ->name('admin.settings');
});

