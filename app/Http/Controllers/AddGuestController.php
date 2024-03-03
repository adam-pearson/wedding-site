<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddGuestRequest;
use App\Services\GuestService;
use Exception;
use Illuminate\Http\JsonResponse;

class AddGuestController extends Controller
{
    public function __construct(private GuestService $guestService)
    {
        //
    }
    
    public function __invoke(AddGuestRequest $request): JsonResponse
    {
        $guestDto = $request->getDto();

        try {
            $guest = $this->guestService->saveGuest($guestDto);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return response()->json(['success' => true, 'guest' => $guest]);
    }
}
