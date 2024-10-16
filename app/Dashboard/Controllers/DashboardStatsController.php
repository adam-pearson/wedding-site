<?php

namespace App\Dashboard\Controllers;

use App\Dashboard\Services\DashboardStatsService;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class DashboardStatsController extends Controller
{

    public function __construct(protected DashboardStatsService $dashboardStatsService)
    {
    }

    public function totalGuestAttendingCount(): JsonResponse
    {
        $count = $this->dashboardStatsService->getTotalGuestAttendingCount();
        return response()->json(['count' => $count]);
    }

    public function totalNonGuestAttendingCount(): JsonResponse
    {
        $count = $this->dashboardStatsService->getTotalNonGuestAttendingCount();
        return response()->json(['count' => $count]);
    }

    public function totalRemainingInvitesCount(): JsonResponse
    {
        $count = $this->dashboardStatsService->getTotalRemainingInvitesCount();
        return response()->json(['count' => $count]);
    }

    public function totalRemainingRsvpsCount(): JsonResponse
    {
        $count = $this->dashboardStatsService->getTotalRemainingRsvpsCount();
        return response()->json(['count' => $count]);
    }

    public function rsvpOverTime(): JsonResponse
    {
        $data = $this->dashboardStatsService->getRsvpOverTimeData();
        return response()->json($data);
    }

    public function totalChildrenAttendingCount(): JsonResponse
    {
        $count = $this->dashboardStatsService->getTotalChildrenAttendingCount();
        return response()->json(['count' => $count]);
    }

    public function attendanceRatio(): JsonResponse
    {
        $data = $this->dashboardStatsService->getAttendanceRatio();
        return response()->json($data);
    }

    public function alcoholRatio(): JsonResponse
    {
        $data = $this->dashboardStatsService->getAlcoholRatio();
        return response()->json($data);
    }

    public function dayAttendanceRatio(): JsonResponse
    {
        $data = $this->dashboardStatsService->getDayAttendanceRatio();
        return response()->json($data);
    }

    public function eveningAttendanceRatio(): JsonResponse
    {
        $data = $this->dashboardStatsService->getEveningAttendanceRatio();
        return response()->json($data);
    }

    public function plusOneUsage(): JsonResponse
    {
        $data = $this->dashboardStatsService->getPlusOneUsage();
        return response()->json($data);
    }

    public function notYetResponded(): JsonResponse
    {
        $data = $this->dashboardStatsService->getNotYetRespondedGuests();
        return response()->json($data);
    }

    public function notAttending(): JsonResponse
    {
        $data = $this->dashboardStatsService->getNotAttendingGuests();
        return response()->json($data);
    }
}
