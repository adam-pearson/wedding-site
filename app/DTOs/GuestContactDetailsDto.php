<?php

namespace App\DTOs;

use Illuminate\Contracts\Support\Arrayable;
use JsonSerializable;
use Stringable;

final readonly class GuestContactDetailsDto implements JsonSerializable, Arrayable, Stringable
{

    public function __construct(
        public int $guestId,
        public ?string $email,
        public ?string $phone,
        public ?string $address,
    ) {
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }

    public function toArray(): array
    {
        return [
            'id' => $this->guestId,
            'email' => $this->email,
            'phone' => $this->phone,
            'address' => $this->address,
        ];
    }

    public function __toString(): string
    {
        return json_encode($this->jsonSerialize(), JSON_THROW_ON_ERROR);
    }
}