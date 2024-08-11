<?php

namespace App\Guest\Actions;

use App\Guest\Repositories\GuestRepository;
use Illuminate\Database\Eloquent\Collection;

readonly class GetAllGroupData
{
    public function __construct(private GuestRepository $guestRepository)
    {
        //
    }

    public function execute(): Collection
    {
        return $this->guestRepository->getGuestGroups();
    }
}
