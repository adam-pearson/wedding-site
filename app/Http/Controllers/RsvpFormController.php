<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use App\Services\GuestService;
use Inertia\ResponseFactory;
use Illuminate\Http\Request;
use App\Http\Requests\RsvpFormRequest;
use App\DTOs\RsvpSubmissionDto;
use App\DTOs\AddGuestRequestDto;
use App\DTOs\GuestContactDetailsDto;
use App\Enums\GuestType;
use Exception;
use Illuminate\Http\JsonResponse;
use Inertia\Response;
use Psr\Log\LoggerInterface;

class RsvpFormController extends Controller
{
    public function __construct(
        private ResponseFactory $inertia,
        private GuestService $guestService,
        private LoggerInterface $logger,
    ) {
        //
    }

    public function __invoke(Request $request): Response
    {
        // add new request class
        
        $guest = $this->guestService->getGuestByCode($request->code);

        return $this->inertia->render('RsvpFormPage', ['guest' => $guest]);
    }

    public function submit(RsvpFormRequest $request, Guest $guest): JsonResponse
    {
        $dto = $request->getDto();
        $contactDetails = $request->getContactDetailsDto();

        try {
            $this->guestService->updateGuestContactDetails($contactDetails);
            $this->guestService->createReceivedInvites($guest, $dto);
        } catch (Exception $e) {
            dd($e->getMessage());
            $this->logger->error('RSVP failed to submit', ['exception' => $e->getMessage()]);
            return response()->json(['success' => false, 'message' => 'RSVP failed to submit']);
        }

        return response()->json(['success' => true, 'message' => 'RSVP submitted successfully']);
    }
}
