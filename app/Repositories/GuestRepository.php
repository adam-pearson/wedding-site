<?php

namespace App\Repositories;

use App\DTOs\AddGuestRequestDto;
use App\DTOs\EditGuestRequestDTO;
use App\DTOs\GuestFormRequestDto;
use App\Models\Guest;
use Illuminate\Database\Eloquent\Collection;

class GuestRepository
{
    public function save(AddGuestRequestDto $guestDto): Guest
    {
        return Guest::create($guestDto->toArray());
    }

    public function update(EditGuestRequestDTO $guestDto): Guest
    {
        $guest = Guest::find($guestDto->id);

        $guest->update($guestDto->getGuestColumns());

        if ($guest->receivedInvite()->exists()) {
            $guest->receivedInvite()->update($guestDto->getInviteColumns());
        }

        return $guest;
    }

    public function checkGuestCodeIsUnique(string $code): bool
    {
        return Guest::where('unique_code', $code)->doesntExist();
    }

    public function getMainGuests(array $relations = []): Collection
    {
        return Guest::with($relations)
            ->whereNull('plus_one_of')
            ->get();
    }

    public function delete(int $guestId): int
    {
        $idsToDelete = [$guestId];
        
        if (Guest::find($guestId)->plusOneChild()->exists()) {
            $idsToDelete[] = Guest::find($guestId)->plusOneChild->id;
        }

        return Guest::destroy($idsToDelete);
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