<?php

namespace App\Guest\Actions;

use App\Guest\DTOs\GuestDto;
use App\Guest\Models\Guest;
use App\Guest\Repositories\GuestRepository;
use App\RsvpResponse\DTOs\RsvpSubmissionDto;

class StoreGuest
{
    public function __construct(private GuestRepository $guestRepository)
    {
        //
    }

    public function execute(GuestDto $guestDto): Guest
    {
        $guest = $this->guestRepository->store($guestDto);

        return $guest;
    }
}