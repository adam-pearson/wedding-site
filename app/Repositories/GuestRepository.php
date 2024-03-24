<?php

namespace App\Repositories;

use App\DTOs\AddGuestRequestDto;
use App\DTOs\EditGuestRequestDto;
use App\Enums\GuestType;
use App\Models\Guest;
use App\Models\ReceivedInvite;
use Illuminate\Database\Eloquent\Collection;

class GuestRepository
{
    public function find(int $id, array $relations = []): Guest
    {
        return Guest::with($relations)->find($id);
    }

    public function save(AddGuestRequestDto $guestDto): Guest
    {
        $newGuest = Guest::make($guestDto->getGuestColumns());


        if ($guestDto->plusOneOf) {
            $parentGuest = $this->find($guestDto->plusOneOf);

            if (!$parentGuest->plus_one_allowed) {
                throw new \Exception('Parent guest does not allow plus ones');
            } else {
                $newGuest->plusOneParent()->associate($parentGuest);
                $newGuest->save();
                
                try {
                ReceivedInvite::create(['guest_id' => $newGuest->id, ...$guestDto->getInviteColumns()]);
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

    public function update(EditGuestRequestDto $guestDto): Guest
    {
        $guest = $this->find($guestDto->id, ['receivedInvite', 'plusOneParent.receivedInvite', 'plusOneChild.receivedInvite']);

        $guest->update($guestDto->getGuestColumns());

        if ($guest->receivedInvite?->exists()) {
            $guest->receivedInvite()->update($guestDto->getInviteColumns());
        }

        if ($guest->plusOneChild?->exists()) {
            if ($guest->plus_one_allowed) {
                $guest->plusOneChild->update($guestDto->getPlusOneSharedGuestFields());
                $guest->plusOneChild->receivedInvite()->update($guestDto->getPlusOneSharedInviteFields());
            } else {
                $guest->plusOneChild->delete();
            }
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