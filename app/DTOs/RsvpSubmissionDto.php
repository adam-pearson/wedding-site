<?php

namespace App\DTOs;

use App\Models\Guest;
use Illuminate\Contracts\Support\Arrayable;
use JsonSerializable;
use Stringable;

final readonly class RsvpSubmissionDto implements JsonSerializable, Arrayable, Stringable
{

    public function __construct(
        public string $name,
        public bool $usingPlusOne,
        public bool $coming,
        public bool $alcohol,
        public int $guestId,
        public ?string $email = null,
        public ?string $phone = null,
        public ?string $dietaryRequirements = null,
        public ?string $plusOneName = null,
        public ?bool $plusOneAlcohol = null,
        public ?string $plusOneDietaryRequirements = null,
    ) {
    }

    public function getMainGuestFields(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
        ];
    }

    public function getMainGuestReceivedInviteFields(): array
    {
        return [
            'coming' => $this->coming,
            'alcohol' => $this->alcohol,
            'dietary_requirements' => $this->dietaryRequirements,
        ];
    }

    public function getPlusOneGuestFields(): array
    {
        return [
            'name' => $this->plusOneName,
            'parent_id' => $this->guestId,
        ];
    }

    public function getPlusOneReceivedInviteFields(): array
    {
        return [
            'name' => $this->plusOneName,
            'alcohol' => $this->plusOneAlcohol,
            'dietary_requirements' => $this->plusOneDietaryRequirements,
        ];
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'using_plus_one' => $this->usingPlusOne,
            'coming' => $this->coming,
            'alcohol' => $this->alcohol,
            'email' => $this->email,
            'phone' => $this->phone,
            'dietary_requirements' => $this->dietaryRequirements,
            'plus_one_name' => $this->plusOneName,
            'plus_one_alcohol' => $this->plusOneAlcohol,
            'plus_one_dietary_requirements' => $this->plusOneDietaryRequirements,
        ];
    }

    public function __toString(): string
    {
        return json_encode($this->jsonSerialize(), JSON_THROW_ON_ERROR);
    }
}