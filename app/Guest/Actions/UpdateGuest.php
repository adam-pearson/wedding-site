<?php

namespace App\Guest\Actions;

use App\Guest\DTOs\GuestContactDetailsDto;
use App\Guest\DTOs\GuestDto;
use App\Guest\Models\Guest;
use App\Guest\Repositories\GuestRepository;
use App\RsvpResponse\DTOs\RsvpSubmissionDto;
use App\RsvpResponse\Repositories\RsvpResponseRepository;

readonly class UpdateGuest
{
    public function __construct(
        private GuestRepository        $guestRepository,
        private RsvpResponseRepository $rsvpResponseRepository
    ){
        //
    }

    public function execute(GuestDto|GuestContactDetailsDto $guestDto, ?RsvpSubmissionDto $rsvpDto = null): Guest
    {
        $guest = $this->guestRepository->update($guestDto->id, $guestDto->toArray());
        
        if ($guestDto instanceof GuestDto) {
            $this->guestRepository->updateGuestGroup($guestDto->getGroupDetails());
            $this->handleGuestRelationshipUpdates($guest, $guestDto, $rsvpDto);
        }

        return $guest;
    }

    private function handleGuestRelationshipUpdates(Guest $guest, GuestDto $guestDto, ?RsvpSubmissionDto $rsvpDto = null): void
    {
        if ($guest->plusOne?->exists()) {
            if ($guest->plus_one_allowed) {
                $this->guestRepository->update($guest->plusOne->id, $guestDto->getValuesSharedWithPlusOne());
                if ($rsvpDto !== null) {
                    $this->rsvpResponseRepository->update($guest->plusOne->rsvpResponse->id, $rsvpDto->getValuesSharedWithPlusOne());
                }
            } else {
                $guest->plusOne->delete();
            }
        }
    }
}
