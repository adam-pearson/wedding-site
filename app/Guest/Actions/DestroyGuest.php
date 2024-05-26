<?php

namespace App\Guest\Actions;

use App\Guest\Repositories\GuestRepository;

class DestroyGuest
{
    public function __construct(private GuestRepository $guestRepository)
    {
        //
    }

    public function execute(int $id): int
    {
        return $this->guestRepository->destroy($id);
    }
}
