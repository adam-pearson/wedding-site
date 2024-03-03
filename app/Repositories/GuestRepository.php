<?php

namespace App\Repositories;

use App\DTOs\AddGuestRequestDto;
use App\Models\Guest;

class GuestRepository
{
    public function save(AddGuestRequestDto $guestDto): Guest
    {
        return Guest::create($guestDto->toArray());
    }

    public function checkGuestCodeIsUnique(string $code): bool
    {
        return Guest::where('unique_code', $code)->doesntExist();
    }
}