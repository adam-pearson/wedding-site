<?php

namespace App\Guest\Repositories;

use App\DTOs\GuestContactDetailsDto;
use App\Guest\DTOs\GuestDto;
use App\Guest\Models\Guest;
use App\RsvpResponse\Models\RsvpResponse;
use Illuminate\Database\Eloquent\Collection;

class GuestRepository
{
    public function find(int $id, array $relations = []): Guest
    {
        return Guest::with($relations)->find($id);
    }

    public function save(GuestDto $guestDto): Guest
    {
        $newGuest = Guest::make($guestDto->getGuestColumns());


        if ($guestDto->plusOneOf) {
            $parentGuest = $this->find($guestDto->plusOneOf);

            if (!$parentGuest->plus_one_allowed) {
                throw new \Exception('Parent guest does not allow plus ones');
            } else {
                $newGuest->plusOneOwner()->associate($parentGuest);
                $newGuest->save();
                
                try {
                RsvpResponse::create(['guest_id' => $newGuest->id, ...$guestDto->getInviteColumns()]);
                } catch (\Exception $e) {
                    $newGuest->delete();
                    throw $e;
                }
            }
        } else {
            $newGuest->save();
        }        

        return $newGuest;
    }

    public function update(int $id, array $updatedDetails): Guest
    {
        $guest = $this->find($id, ['rsvpResponse', 'plusOneOwner.rsvpResponse', 'plusOne.rsvpResponse']);

        $guest->update($updatedDetails);

        return $guest;
    }

    public function updateContactDetails(GuestContactDetailsDto $dto): Guest
    {
        $guest = $this->find($dto->guestId);

        $guest->update($dto->toArray());

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

    public function delete(int $id): int
    {    
        return Guest::destroy($id);
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