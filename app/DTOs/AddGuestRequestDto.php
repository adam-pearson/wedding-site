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
        public ?string $email,
        public ?string $phone,
        public ?string $address,
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
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'address' => $this->address,
            'plus_one_allowed' => $this->plusOneAllowed,
            'guest_type' => $this->guestType,
            'unique_code' => $this->guestService->generateUniqueCode(),
        ];
    }

    public function __toString(): string
    {
        return json_encode($this->jsonSerialize(), JSON_THROW_ON_ERROR);
    }
}