<?php

namespace App\RsvpResponse\Repositories;

use App\Guest\Models\Guest;
use App\RsvpResponse\DTOs\RsvpResponseDto;
use App\RsvpResponse\Models\RsvpResponse;

class RsvpResponseRepository
{
    public function __construct()
    {
        //
    }

    public function store(RsvpResponseDto $dto)
    {
        RsvpResponse::create($dto->getRsvpFields());
    }

    public function update(int $id, array $updatedDetails): RsvpResponse
    {
        $rsvpResponse = RsvpResponse::find($id);

        $rsvpResponse->update($updatedDetails);

        return $rsvpResponse;
    }
}