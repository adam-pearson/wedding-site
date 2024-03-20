<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use App\Services\GuestService;
use Inertia\ResponseFactory as Inertia;
use Illuminate\Http\Request;
use App\Http\Requests\RsvpFormRequest;
use App\DTOs\RsvpSubmissionDto;
use App\DTOs\AddGuestRequestDto;
use App\Enums\GuestType;

class RsvpFormController extends Controller
{
    public function __construct(
        private Inertia $inertia,
        private GuestService $guestService 
    ) {
        //
    }

    public function __invoke(Request $request)
    {
        // add new request class
        
        $guest = $this->guestService->getGuestByCode($request->code);

        return $this->inertia->render('RsvpFormPage', ['guest' => $guest]);
    }

    public function submit(RsvpFormRequest $request, Guest $guest)
    {
        $dto = $request->getDto();
        // dd($dto);

// update main guest's details in the guest table
        // create a received_invite record for the main guest
        // if the main guest is allowed a plus one, and if they have submitted a true value for using_plus_one, and if they have submitted plus one details, then create a guest record for the plus one
        // if the main guest is allowed a plus one, and if they have submitted a true value for using_plus_one, and if they have submitted plus one details, then create a received_invite record for the plus one

        $guest->update($dto->getMainGuestFields());
        $receivedInvite = $guest->receivedInvite()->create($dto->getMainGuestReceivedInviteFields());

        if ($guest->plus_one_allowed && $dto->usingPlusOne) {
            $plusOneDto = new AddGuestRequestDto(
                plusOneOf: $guest->id,
                name: $dto->plusOneName,
                guestType: GuestType::from($guest->guest_type),
                plusOneAllowed: false,
                isChild: false,
            );
            $plusOne = $this->guestService->saveGuest($plusOneDto);
        
            $plusOneReceivedInvite = $plusOne->receivedInvite()->create($dto->getPlusOneReceivedInviteFields());
        }

        // make new rsvp service
        // make new rsvp repository

        return $this->inertia->render('RsvpSuccessPage', ['guest' => $guest->with('receivedInvite', 'plusOneChild.receivedInvite')->first()]);
    }
}
