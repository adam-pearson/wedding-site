<?php

namespace App\DTOs;

use App\Enums\GuestType;
use App\Services\GuestService;
use Illuminate\Contracts\Support\Arrayable;
use JsonSerializable;
use Stringable;

final readonly class AddGuestRequestDto implements JsonSerializable, Arrayable, Stringable
{
    private GuestService $guestService;

    public function __construct(
        public string $name,
        public bool $plusOneAllowed,
        public GuestType $guestType,
        public bool $isChild,
        public ?string $email = null,
        public ?string $phone = null,
        public ?string $address = null,
        public ?int $plusOneOf = null,
        public ?bool $coming = null,
        public ?bool $alcohol = null,
        public ?string $dietaryRequirements = null,
    ) {
        $this->guestService = app(GuestService::class);
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }

    public function toArray(): array
    {
        return [
            'id' => null,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'address' => $this->address,
            'plus_one_allowed' => $this->plusOneAllowed,
            'guest_type' => $this->guestType,
            'is_child' => $this->isChild,
            'unique_code' => $this->guestService->generateUniqueCode(),
            'plus_one_of' => $this->plusOneOf,
            'coming' => $this->coming,
            'alcohol' => $this->alcohol,
            'dietary_requirements' => $this->dietaryRequirements,
        ];
    }

    public function getGuestColumns(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'address' => $this->address,
            'plus_one_allowed' => $this->plusOneAllowed,
            'guest_type' => $this->guestType,
            'is_child' => $this->isChild,
            'unique_code' => $this->guestService->generateUniqueCode(),
        ];
    }

    public function getInviteColumns(): array
    {
        return [
            'coming' => $this->coming,
            'alcohol' => $this->alcohol,
            'dietary_requirements' => $this->dietaryRequirements,
        ];
    }
    
    public function getParentId(): int
    {
        return $this->plusOneOf;
    }

    public function __toString(): string
    {
        return json_encode($this->jsonSerialize(), JSON_THROW_ON_ERROR);
    }
}