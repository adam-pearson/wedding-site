<?php

namespace App\Services;

use App\DTOs\AddGuestRequestDto;
use App\DTOs\EditGuestRequestDto;
use App\Models\Guest;
use App\Repositories\GuestRepository;
use Illuminate\Database\Eloquent\Collection;
use App\DTOs\RsvpSubmissionDto;
use App\Models\ReceivedInvite;

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

    public function saveGuest(AddGuestRequestDto $guestDto): Guest
    {
        $guest = $this->guestRepository->save($guestDto);

        return $guest;
    }

    public function updateGuest(EditGuestRequestDto $guestDto): Guest
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

    public function submitRsvp(Guest $guest, RsvpSubmissionDto $dto): void
    {
        
        // $this->guestRepository->submitRsvp($guest, $dto);
    }
}