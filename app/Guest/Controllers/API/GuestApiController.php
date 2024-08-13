<?php

namespace App\Guest\Controllers\API;

use App\Guest\Actions\GenerateGuestCsv;
use App\Guest\Actions\GetAllGuestDataForCsv;
use App\Guest\Actions\StoreGuest;
use App\Guest\Actions\DestroyGuest;
use App\Guest\Actions\GetAllGuestData;
use App\Guest\Actions\UpdateGuest;
use App\Guest\Models\Guest;
use App\Guest\Requests\AddGuestRequest;
use App\Guest\Requests\DeleteGuestRequest;
use App\Guest\Requests\UpdateGuestRequest;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class GuestApiController extends Controller
{
    public function __construct(
        private readonly StoreGuest      $createGuest,
        private readonly UpdateGuest     $updateGuest,
        private readonly GetAllGuestData $getAllGuestData,
        private readonly DestroyGuest    $destroyGuest,
        private readonly GetAllGuestDataForCsv $getGuestDataForCsv,
        private readonly GenerateGuestCsv $generateCsv,
    ) {
        //
    }

    public function index(): JsonResponse
    {
        $guests = $this->getAllGuestData->execute();

        return response()->json(['guests' => $guests]);
    }

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

    public function update(UpdateGuestRequest $request, Guest $guest): JsonResponse
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

    public function download(): BinaryFileResponse
    {
        $guests = $this->getGuestDataForCsv->execute();
        $csv = $this->generateCsv->execute($guests);

        return response()->download($csv)->deleteFileAfterSend();
    }
}
