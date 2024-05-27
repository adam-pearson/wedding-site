<?php

namespace App\Guest\Actions;

use App\Guest\DTOs\GuestCsvDto;
use App\Guest\Models\Guest;
use App\Guest\Repositories\GuestRepository;
use Illuminate\Database\Eloquent\Collection;

readonly class GetGuestCsvData
{
    public function __construct(private GuestRepository $guestRepository)
    {
        //
    }

    public function execute(): Collection
    {
        $data = $this->guestRepository->getMainGuests();

        $data->transform(function (Guest $guest) {
           return new GuestCsvDto(
               name: $guest->name,
               email: $guest->email,
               phone: $guest->phone,
               address: $guest->address,
               guestType: $guest->guest_type,
               plusOneAllowed: $guest->plus_one_allowed,
               uniqueCode: $guest->unique_code,
               qrCodeString: 'URL:' . env('APP_URL') . '/rsvp/form?code=' . $guest->unique_code,
           );
        });

        return $data;
    }
}
