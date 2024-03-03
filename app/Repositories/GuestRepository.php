<?php

namespace App\Repositories;

use App\DTOs\AddGuestRequestDto;
use App\Models\Guest;
use Illuminate\Database\Eloquent\Collection;

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

    public function get(array $relations): Collection
    {
        return Guest::with($relations)->get();
    }
}