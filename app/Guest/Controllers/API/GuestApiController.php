<?php

namespace App\Guest\Controllers\API;

use App\Guest\Actions\StoreGuest;
use App\Guest\Actions\DestroyGuest;
use App\Guest\Actions\GetAllGuestData;
use App\Guest\Actions\UpdateGuest;
use App\Guest\Requests\AddGuestRequest;
use App\Guest\Requests\DeleteGuestRequest;
use App\Guest\Requests\UpdateGuestRequest;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\JsonResponse;

class GuestApiController extends Controller
{
    public function __construct(
        private StoreGuest $createGuest,
        private UpdateGuest $updateGuest,
        private GetAllGuestData $getAllGuestData,
        private DestroyGuest $destroyGuest,
    ) {
        //
    }

    public function index(): JsonResponse
    {
        $guests = $this->getAllGuestData->execute();

        return response()->json(['guests' => $guests]);
    }

    // public function show(int $id): JsonResponse
    // {
    //     $guest = $this->guestService->getGuestById($id);

    //     return response()->json(['guest' => $guest]);
    // }

    public function store(AddGuestRequest $request): JsonResponse
    {
        $guestDto = $request->getDto();

        try {
            $guest = $this->createGuest->execute($guestDto);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return response()->json(['success' => true, 'guest' => $guest]);
    }

    public function update(UpdateGuestRequest $request): JsonResponse
    {
        try {
            $guest = $this->updateGuest->execute($request->getGuestDto(), $request->getRsvpDto());
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return response()->json(['success' => true, 'guest' => $guest]);
    }

    public function destroy(DeleteGuestRequest $request): JsonResponse
    {
        $guestId = $request->id;

        try {
            $deleteCount = $this->destroyGuest->execute($guestId);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return response()->json(['success' => true, 'deleteCount' => $deleteCount]);
    }
}
