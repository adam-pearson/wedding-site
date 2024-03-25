<?php

namespace App\RsvpResponse\Controllers\API;

use App\Guest\Actions\StoreGuest;
use App\Guest\Actions\UpdateGuest;
use App\Guest\Models\Guest;
use App\Http\Controllers\Controller;
use App\Services\GuestService;
use Inertia\ResponseFactory;
use App\Http\Requests\RsvpFormRequest;
use App\RsvpResponse\Actions\StoreRsvpResponse;
use App\RsvpResponse\Requests\RsvpResponseSubmissionRequest;
use Exception;
use Illuminate\Http\JsonResponse;
use Psr\Log\LoggerInterface;

class RsvpResponseApiController extends Controller
{
    public function __construct(
        private ResponseFactory $inertia,
        private StoreGuest $storeGuest,
        private UpdateGuest $updateGuest,
        private StoreRsvpResponse $storeRsvpResponse,
        private LoggerInterface $logger,
    ) {
        //
    }

    public function store(RsvpResponseSubmissionRequest $request, Guest $guest): JsonResponse
    {
        $rsvpDto = $request->getRsvpDto();

        $contactDetails = $request->getGuestContactDetailsDto();

        try {
            $this->updateGuest->execute($guest->id, $contactDetails->toArray());
            $this->storeRsvpResponse->execute($guest, $rsvpDto);
        } catch (Exception $e) {
            $this->logger->error('RSVP failed to submit', ['exception' => $e->getMessage()]);
            return response()->json(['success' => false, 'message' => 'RSVP failed to submit']);
        }


        if ($guest->plus_one_allowed && $rsvpDto->isUsingPlusOne()) {
            try {
                $plusOneDto = $request->getPlusOneDto();
                
                $plusOne = $this->storeGuest->execute($plusOneDto);
                $plusOneRsvpDto = $request->getPlusOneRsvpDto($plusOne->id);

                $plusOne->rsvpResponse->create($plusOneRsvpDto->getRsvpFields());
            } catch (Exception $e) {
                $this->logger->error('Plus one RSVP failed to submit', ['exception' => $e->getMessage()]);
                return response()->json(['success' => false, 'message' => 'Plus one RSVP failed to submit']);
            }
        }

        return response()->json(['success' => true, 'message' => 'RSVP submitted successfully']);
    }
}
