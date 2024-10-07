<?php

namespace App\Guest\Repositories;

use App\Guest\DTOs\GuestDto;
use App\Guest\Models\Guest;
use App\Guest\Models\GuestGroup;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\Collection as SupportCollection;

class GuestRepository
{
    public function find(int|array $ids, array $relations = []): Guest|EloquentCollection
    {
        return Guest::with($relations)->find($ids);
    }

    public function store(GuestDto $guestDto): Guest
    {
        return Guest::create($guestDto->toArray());
    }

    public function update(int $id, array $updatedDetails): Guest
    {
        $guest = $this->find($id);

        $guest->update($updatedDetails);

        return $guest;
    }

    public function updateGuestGroup(array $groupDetails): void
    {
        $guests = $this->find($groupDetails['group_members']);

        if ($groupDetails['group_id'] !== null) {
            Guest::where('group_id', $groupDetails['group_id'])
                ->whereNotIn('id', $groupDetails['group_members'])
                ->update(['group_id' => null]);

            $guests->each(function (Guest $guest) use ($groupDetails) {
                if ($guest->group_id !== $groupDetails['group_id']) {
                    $guest->update(['group_id' => $groupDetails['group_id']]);
                }
            });
        } elseif ($groupDetails['group_name'] !== null) {
            $newGroup = GuestGroup::create(['group_name' => $groupDetails['group_name']]);
            $guests->each(function (Guest $guest) use ($newGroup) {
                $guest->update(['group_id' => $newGroup->id]);
            });
        }
    }

    public function destroy(int $id): int
    {
        return Guest::destroy($id);
    }

    public function getGroupedMainGuests(array $relations = []): EloquentCollection
    {
        return Guest::with($relations)
            ->whereNotNull('group_id')
            ->whereNull('plus_one_of')
            ->get();
    }

    public function getUngroupedMainGuests(array $relations = [])
    {
        return Guest::with($relations)
            ->whereNull('group_id')
            ->whereNull('plus_one_of')
            ->get();
    }

    public function getMainGuests(array $relations = []): EloquentCollection
    {
        return Guest::with($relations)
            ->whereNull('plus_one_of')
            ->orderBy('name')
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

    public function getGuestGroups(): EloquentCollection
    {
        return GuestGroup::all();
    }
}
