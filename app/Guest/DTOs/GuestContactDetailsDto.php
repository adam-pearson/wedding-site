<?php

namespace App\Guest\DTOs;

use App\Services\GuestService;
use Illuminate\Contracts\Support\Arrayable;
use JsonSerializable;
use Stringable;

final readonly class GuestContactDetailsDto implements JsonSerializable, Arrayable, Stringable
{
    public function __construct(
        public int $id,
        public string $name,
        public ?string $email = null,
        public ?string $phone = null,
        public ?string $address = null,
    ) {
        //
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
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