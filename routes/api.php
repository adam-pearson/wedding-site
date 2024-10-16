<?php

use App\Dashboard\Controllers\DashboardStatsController;
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

    // dashboard stats

    Route::get(uri: '/dashboard/stats/total-guest-attending-count', action: [DashboardStatsController::class, 'totalGuestAttendingCount'])
        ->name('admin.dashboard.stats.total-attending-count');
    // return { count }

    Route::get(uri: '/dashboard/stats/total-non-guest-attending-count', action: [DashboardStatsController::class, 'totalNonGuestAttendingCount'])
        ->name('admin.dashboard.stats.total-non-guest-attending-count');
    // return { count }

    Route::get(uri: '/dashboard/stats/total-remaining-invites-count', action: [DashboardStatsController::class, 'totalRemainingInvitesCount'])
        ->name('admin.dashboard.stats.total-remaining-invites-count');
    // return { count }

    Route::get(uri: '/dashboard/stats/total-remaining-rsvps-count', action: [DashboardStatsController::class, 'totalRemainingRsvpsCount'])
        ->name('admin.dashboard.stats.total-remaining-rsvps-count');
    // return { count }

    Route::get(uri: '/dashboard/stats/total-children-attending-count', action: [DashboardStatsController::class, 'totalChildrenAttendingCount'])
        ->name('admin.dashboard.stats.total-children-attending-count');

    Route::get(uri: '/dashboard/stats/rsvps-over-time', action: [DashboardStatsController::class, 'rsvpOverTime'])
        ->name('admin.dashboard.stats.rsvps-over-time');
    // return {
    //  total_rsvps_to_send: [count]
    //  invite_data_by_date: [
    //    {
    //      date: [date]
    //      rsvps_returned: [count]
    //      invites_sent: [count]
    //    }
    //  ]
    //}

    Route::get(uri: '/dashboard/stats/attendance-ratio', action: [DashboardStatsController::class, 'attendanceRatio'])
        ->name('admin.dashboard.stats.attendance-ratio');
    // return [
    //  { coming: [count] }
    //  { not_coming: [count] }
    //  { not_received_invite: [count] }
    //  { not_responded: [count] }
    //]

    Route::get(uri: '/dashboard/stats/alcohol-ratio', action: [DashboardStatsController::class, 'alcoholRatio'])
        ->name('admin.dashboard.stats.alcohol-ratio');
    // return [
    //  { alcohol: [count] }
    //  { no_alcohol: [count] }
    //  { not_received_invite: [count] }
    //  { not_responded: [count] }
    //]

    Route::get(uri: '/dashboard/stats/day-attendance-ratio', action: [DashboardStatsController::class, 'dayAttendanceRatio'])
        ->name('admin.dashboard.stats.day-attendance-ratio');
    // return [
    //  { coming: [count] }
    //  { not_coming: [count] }
    //  { not_received_invite: [count] }
    //  { not_responded: [count] }
    //]

    Route::get(uri: '/dashboard/stats/evening-attendance-ratio', action: [DashboardStatsController::class, 'eveningAttendanceRatio'])
        ->name('admin.dashboard.stats.evening-attendance-ratio');
    // return [
    //  { coming: [count] }
    //  { not_coming: [count] }
    //  { not_received_invite: [count] }
    //  { not_responded: [count] }
    //]

    Route::get(uri: '/dashboard/stats/plus-one-usage', action: [DashboardStatsController::class, 'plusOneUsage'])
        ->name('admin.dashboard.stats.plus-one-usage');
    // return [
    //  { using: [count] }
    //  { not_using: [count] }
    //  { not_received_invite: [count] }
    //  { not_responded: [count] }
    //]

    Route::get(uri: '/dashboard/stats/not-yet-responded', action: [DashboardStatsController::class, 'notYetResponded'])
        ->name('admin.dashboard.stats.not-yet-responded');
    // return [
    // { guest: ... },
    //  ...
    //]

    Route::get(uri: '/dashboard/stats/not-attending', action: [DashboardStatsController::class, 'notAttending'])
        ->name('admin.dashboard.stats.not-attending');
    // return [
    // { guest: ... },
    //  ...
    //]
});

Route::post(uri: '/rsvp/{guest:unique_code}', action: [RsvpResponseApiController::class, 'store'])
    ->middleware(RsvpRepeatedSubmissionCheckMiddleware::class)
    ->name('guest.rsvp.submit');
