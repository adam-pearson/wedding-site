<?php

namespace App\Guest\Actions;

use App\Guest\Models\Guest;
use App\Guest\Repositories\GuestRepository;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

readonly class GetGuestByCode
{
    public function __construct(private GuestRepository $guestRepository)
    {
        //
    }

    public function execute(string $code): Guest
    {
        return $this->guestRepository->getGuestByCode($code);
    }
}
