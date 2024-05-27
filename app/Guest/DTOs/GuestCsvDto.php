<?php

namespace App\Guest\DTOs;

use App\Guest\Enums\GuestType;
use Illuminate\Contracts\Support\Arrayable;
use JsonSerializable;
use Stringable;

final readonly class GuestCsvDto implements JsonSerializable, Arrayable, Stringable
{
    public function __construct(
        public string $name,
        public ?string $email,
        public ?string $phone,
        public ?string $address,
        public string $guestType,
        public bool $plusOneAllowed,
        public string $uniqueCode,
        public string $qrCodeString,
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
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'address' => $this->address,
            'guest_type' => $this->guestType,
            'plus_one_allowed' => $this->plusOneAllowed,
            'unique_code' => $this->uniqueCode,
            'qr_code_string' => $this->qrCodeString,
        ];
    }

    public function __toString(): string
    {
        return json_encode($this->jsonSerialize(), JSON_THROW_ON_ERROR);
    }
}
