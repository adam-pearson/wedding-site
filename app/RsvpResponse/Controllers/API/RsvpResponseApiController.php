<?php

namespace App\RsvpResponse\Controllers\API;

use App\Guest\Actions\StoreGuest;
use App\Guest\Actions\UpdateGuest;
use App\Guest\Models\Guest;
use App\Http\Controllers\Controller;
use Inertia\ResponseFactory;
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
        $guestContactDetailsDto = $request->getGuestContactDetailsDto();
        $rsvpDto = $request->getRsvpDto();

        try {
            $this->updateGuest->execute($guestContactDetailsDto, $rsvpDto);
            $this->storeRsvpResponse->execute($rsvpDto);
        } catch (Exception $e) {
            $this->logger->error('RSVP failed to submit', ['exception' => $e->getMessage()]);
            return response()->json(['success' => false, 'message' => 'RSVP failed to submit']);
        }


        if ($guest->plus_one_allowed && $rsvpDto->isUsingPlusOne()) {
            try {
                $plusOneGuestDto = $request->getPlusOneGuestDto();
                $plusOne = $this->storeGuest->execute($plusOneGuestDto);
                $plusOneRsvpDto = $request->getPlusOneRsvpDto($plusOne->id);

                $this->storeRsvpResponse->execute($plusOneRsvpDto);
            } catch (Exception $e) {
                $this->logger->error('Plus one RSVP failed to submit', ['exception' => $e->getMessage()]);
                return response()->json(['success' => false, 'message' => 'Plus one RSVP failed to submit']);
            }
        }

        return response()->json(['success' => true, 'message' => 'RSVP submitted successfully']);
    }
}
