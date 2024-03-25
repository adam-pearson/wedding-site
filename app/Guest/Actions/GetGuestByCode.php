<?php

namespace App\Guest\Actions;

use App\Guest\Repositories\GuestRepository;

class GetGuestByCode
{
    public function __construct(private GuestRepository $guestRepository)
    {
        //
    }

    public function execute(string $code): string
    {
        return $this->guestRepository->getGuestByCode($code);
    }
}