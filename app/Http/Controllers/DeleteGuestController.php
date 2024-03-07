<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeleteGuestRequest;
use App\Services\GuestService;
use Exception;
use Illuminate\Http\JsonResponse;

class DeleteGuestController extends Controller
{
    public function __construct(private GuestService $guestService)
    {
        //
    }
    
    public function __invoke(DeleteGuestRequest $request): JsonResponse
    {
        $guestId = $request->id;

        try {
            $deleteCount = $this->guestService->deleteGuest($guestId);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return response()->json(['success' => true, 'deleteCount' => $deleteCount]);
    }
}
