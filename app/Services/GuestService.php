<?php

namespace App\Services;

use App\DTOs\AddGuestRequestDTO;
use App\DTOs\EditGuestRequestDTO;
use App\DTOs\GuestFormRequestDto;
use App\Models\Guest;
use App\Repositories\GuestRepository;
use Illuminate\Database\Eloquent\Collection;

class GuestService
{

    public function __construct(private GuestRepository $guestRepository)
    {
        //
    }

    public function generateUniqueCode(): string
    {
        $code = strtoupper(bin2hex(random_bytes(3)));

        while (!$this->guestRepository->checkGuestCodeIsUnique($code)) {
            $code = strtoupper(bin2hex(random_bytes(3)));
        }

        return $code;
    }

    public function saveGuest(AddGuestRequestDTO $guestDto): Guest
    {
        $guest = $this->guestRepository->save($guestDto);

        return $guest;
    }

    public function updateGuest(EditGuestRequestDTO $guestDto): Guest
    {
        $guest = $this->guestRepository->update($guestDto);

        return $guest;
    }

    /**
     * Returns a count of deleted guests
     */
    public function deleteGuest(int $guestId): int
    {        
        $result = $this->guestRepository->delete($guestId);

        return $result;
    }

    public function getGuestsAndReceivedInvites(): Collection
    {
        return $this->guestRepository->getMainGuests([
            'receivedInvite',
            'plusOneChild.receivedInvite'
        ]);
    }

    public function getGuestByCode(string $code): Guest
    {
        return $this->guestRepository->getGuestByCode($code);
    }
}