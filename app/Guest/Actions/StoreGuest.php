<?php

namespace App\Guest\Actions;

use App\Guest\DTOs\GuestDto;
use App\Guest\Models\Guest;
use App\Guest\Repositories\GuestRepository;

class StoreGuest
{
    public function __construct(private GuestRepository $guestRepository)
    {
        //
    }

    public function execute(GuestDto $guestDto): Guest
    {
        $guest = $this->guestRepository->save($guestDto);

        return $guest;
    }
}