<?php

namespace App\RsvpResponse\DTOs;

use Illuminate\Contracts\Support\Arrayable;
use JsonSerializable;
use Stringable;

final readonly class RsvpResponseDto implements JsonSerializable, Arrayable, Stringable
{

    public function __construct(
        public bool $coming,
        public int $guestId,
        public ?bool $usingPlusOne = false,
        public ?bool $alcohol = null,
        public ?string $dietaryRequirements = null,
    ) {
    }

    public function isUsingPlusOne(): bool
    {
        return $this->usingPlusOne;
    }

    public function getRsvpFields(): array
    {
        return [
            'guest_id' => $this->guestId,
            'coming' => $this->coming,
            'alcohol' => $this->alcohol,
            'dietary_requirements' => $this->dietaryRequirements,
        ];
    }

    public function getValuesSharedWithPlusOne(): array
    {
        return [
            'coming' => $this->coming,
        ];
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }

    public function toArray(): array
    {
        return [
            'guest_id' => $this->guestId,
            'using_plus_one' => $this->usingPlusOne,
            'coming' => $this->coming,
            'alcohol' => $this->alcohol,
            'dietary_requirements' => $this->dietaryRequirements,
        ];
    }

    public function __toString(): string
    {
        return json_encode($this->jsonSerialize(), JSON_THROW_ON_ERROR);
    }
}