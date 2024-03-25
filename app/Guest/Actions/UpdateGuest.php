<?php

namespace App\Guest\Actions;

use App\Guest\DTOs\GuestDto;
use App\Guest\Models\Guest;
use App\Guest\Repositories\GuestRepository;
use App\RsvpResponse\DTOs\RsvpResponseDto;
use App\RsvpResponse\Repositories\RsvpResponseRepository;

class UpdateGuest
{
    public function __construct(private GuestRepository $guestRepository, private RsvpResponseRepository $rsvpResponseRepository)
    {
        //
    }

    public function execute(GuestDto $guestDto, ?RsvpResponseDto $rsvpResponseDto = null): Guest
    {
        $guest = $this->guestRepository->update($guestDto->id, $guestDto->toArray());

        if ($guest->rsvpResponse?->exists() && $rsvpResponseDto !== null) {
            $this->rsvpResponseRepository->update($guest->rsvpResponse->id, $rsvpResponseDto->toArray());
        }
    
        if ($guest->plusOne?->exists()) {
            if ($guest->plus_one_allowed) {
                $this->guestRepository->update($guest->plusOne->id, $guestDto->getValuesSharedWithPlusOne());
                    if ($rsvpResponseDto !== null) {
                        $this->rsvpResponseRepository->update($guest->plusOne->rsvpResponse->id, $rsvpResponseDto->getValuesSharedWithPlusOne());
                    }
            } else {
                $guest->plusOne->delete();
            }
        }

        return $guest;
    }
}