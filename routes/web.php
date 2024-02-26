<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminGuestListController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Authenticated;
use App\Http\Controllers\HomePageController;

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

Route::get(uri: '/', action: HomePageController::class)->name('home');

Route::middleware([Authenticated::class])->group(function () {
    Route::get(uri: '/dashboard', action: AdminDashboardController::class)
        ->name('admin.dashboard');

    Route::get(uri: '/guests', action: AdminGuestListController::class)
        ->name('admin.guests.list');

    Route::get(uri: '/todo', action: AdminDashboardController::class)
        ->name('admin.todo.list');

    Route::get(uri: '/budget', action: AdminDashboardController::class)
        ->name('admin.budget');

    Route::get(uri: '/documents', action: AdminDashboardController::class)
        ->name('admin.documents');

    Route::get(uri: '/settings', action: AdminDashboardController::class)
        ->name('admin.settings');
});