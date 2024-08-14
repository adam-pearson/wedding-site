<?php

namespace App\Guest\Actions;

use App\Guest\Models\Guest;
use App\Guest\Repositories\GuestRepository;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Collection;

readonly class GetGuestsArrayByCode
{
    public function __construct(private GuestRepository $guestRepository)
    {
        //
    }

    public function execute(string $code): Collection
    {
        $guests = $this->guestRepository->getGuestByCode($code, ['rsvpResponse', 'group.guests.rsvpResponse']);

        if ($guests->group?->guests?->isNotEmpty()) {
            $guests = $guests->group->guests;
        } else {
            $guests = collect([$guests]);
        }

        return $guests->sortBy(['is_child', 'name'])->flatten();
    }
}
