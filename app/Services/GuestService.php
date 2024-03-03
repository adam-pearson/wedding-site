<?php

namespace App\Services;

use App\DTOs\AddGuestRequestDto;
use App\Models\Guest;
use App\Repositories\GuestRepository;

class GuestService
{

    public function __construct(private GuestRepository $guestRepository)
    {
        //
    }

    public function generateUniqueCode(): string
    {
        $code = strtoupper(bin2hex(random_bytes(3)));

        while (!$this->guestRepository->checkGuestCodeIsUnique($code)) {
            $code = strtoupper(bin2hex(random_bytes(3)));
        }

        return $code;
    }

    public function saveGuest(AddGuestRequestDto $guestDto): Guest
    {
        $guest = $this->guestRepository->save($guestDto);

        return $guest;
    }
}