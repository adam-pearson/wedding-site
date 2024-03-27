<?php

namespace App\Guest\Repositories;

use App\Guest\DTOs\GuestDto;
use App\Guest\Models\Guest;
use Illuminate\Database\Eloquent\Collection;

class GuestRepository
{
    public function find(int $id, array $relations = []): Guest
    {
        return Guest::with($relations)->find($id);
    }

    public function store(GuestDto $guestDto): Guest
    {
        $newGuest = Guest::create($guestDto->toArray());

        return $newGuest;
    }

    public function update(int $id, array $updatedDetails): Guest
    {
        $guest = $this->find($id);

        $guest->update($updatedDetails);

        return $guest;
    }

    public function destroy(int $id): int
    {    
        return Guest::destroy($id);
    }

    public function getMainGuests(array $relations = []): Collection
    {
        return Guest::with($relations)
            ->whereNull('plus_one_of')
            ->get();
    }
    
    public function codeExists(string $code): bool
    {
        return Guest::where('unique_code', $code)->exists();
    }

    public function getGuestByCode(string $code, array $relations = []): Guest
    {
        return Guest::where('unique_code', $code)->with($relations)->first();
    }
}