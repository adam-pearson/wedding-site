<?php

namespace App\RsvpResponse\Repositories;

use App\Guest\Models\Guest;
use App\RsvpResponse\DTOs\RsvpSubmissionDto;
use App\RsvpResponse\Models\RsvpResponse;

class RsvpResponseRepository
{
    public function __construct()
    {
        //
    }

    public function store(RsvpSubmissionDto $dto)
    {
        RsvpResponse::create($dto->getRsvpData());
    }

    public function update(int $id, array $updatedDetails): RsvpResponse
    {
        $rsvpResponse = RsvpResponse::find($id);

        $rsvpResponse->update($updatedDetails);

        return $rsvpResponse;
    }
}