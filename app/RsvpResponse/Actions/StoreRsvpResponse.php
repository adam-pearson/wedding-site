<?php

namespace App\RsvpResponse\Actions;

use App\Guest\Actions\StoreGuest;
use App\RsvpResponse\DTOs\RsvpSubmissionDto;
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

    public function execute(RsvpSubmissionDto $dto): void
    {
        $this->rsvpResponseRepository->store($dto);
    }
}