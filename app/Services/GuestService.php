<?php

namespace App\Services;

use App\DTOs\AddGuestRequestDto;
use App\DTOs\EditGuestRequestDto;
use App\Models\Guest;
use App\Repositories\GuestRepository;
use Illuminate\Database\Eloquent\Collection;
use App\DTOs\RsvpSubmissionDto;
use App\DTOs\GuestContactDetailsDto;
use App\Enums\GuestType;

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

    public function updateGuestContactDetails(GuestContactDetailsDto $dto) {
        $guest = $this->guestRepository->updateContactDetails($dto);

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

    public function createReceivedInvites(Guest $guest, RsvpSubmissionDto $dto): void
    {
        $this->guestRepository->createReceivedInvite($guest, $dto->getMainGuestReceivedInviteFields());

        if ($guest->plus_one_allowed && $dto->usingPlusOne) {
            $plusOneDto = new AddGuestRequestDto(
                plusOneOf: $guest->id,
                name: $dto->plusOneName,
                guestType: GuestType::from($guest->guest_type),
                plusOneAllowed: false,
                isChild: false,
            );

            $plusOne = $this->saveGuest($plusOneDto);
        
            $this->guestRepository->createReceivedInvite($plusOne, $dto->getPlusOneReceivedInviteFields());
    }
}
}