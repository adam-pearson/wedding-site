<?php

namespace App\Guest\Actions;

use App\Guest\Repositories\GuestRepository;
use Illuminate\Database\Eloquent\Collection;

readonly class GetAllGuestData
{
    public function __construct(private GuestRepository $guestRepository)
    {
        //
    }

    public function execute(): Collection
    {
        return $this->guestRepository->getMainGuests([
            'rsvpResponse',
            'plusOne.rsvpResponse',
            'group.guests'
        ])
            ->groupBy('group_id');
    }
}
