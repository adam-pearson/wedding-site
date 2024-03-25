<?php

namespace App\Guest\Actions;

use App\Guest\Models\Guest;
use App\Guest\Repositories\GuestRepository;

class DestroyGuest
{
    public function __construct(private GuestRepository $guestRepository)
    {
        //
    }

    public function execute(int $id): int
    {
        $result = $this->guestRepository->delete($id);

        return $result;
    }
}