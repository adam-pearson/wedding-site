<?php

namespace App\RsvpResponse\Actions;

use App\Guest\Actions\StoreGuest;
use App\Guest\DTOs\GuestDto;
use App\Guest\Enums\GuestType;
use App\Guest\Models\Guest;
use App\Guest\Repositories\GuestRepository;
use App\RsvpResponse\DTOs\RsvpResponseDto;
use App\RsvpResponse\Repositories\RsvpResponseRepository;

class StoreRsvpResponse
{
    public function __construct(
        private RsvpResponseRepository $rsvpResponseRepository,
        private StoreGuest $storeGuest,
        )
    {
        //
    }

    public function execute(Guest $guest, RsvpResponseDto $dto): void
    {
        $this->rsvpResponseRepository->store($dto);
    }
}