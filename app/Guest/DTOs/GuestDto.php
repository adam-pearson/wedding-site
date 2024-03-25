<?php

namespace App\Guest\DTOs;

use App\Guest\Actions\GenerateUniqueCode;
use App\Guest\Enums\GuestType;
use Carbon\Carbon;
use Illuminate\Contracts\Support\Arrayable;
use JsonSerializable;
use Stringable;

final readonly class GuestDto implements JsonSerializable, Arrayable, Stringable
{
    private GenerateUniqueCode $generateUniqueCode;

    public function __construct(
        public string $name,
        public bool $plusOneAllowed,
        public GuestType $guestType,
        public bool $isChild,
        public ?string $email = null,
        public ?string $phone = null,
        public ?string $address = null,
        public ?int $plusOneOf = null,
        public ?int $id = null,
        public ?Carbon $inviteSentOn = null,
    ) {
        $this->generateUniqueCode = app(GenerateUniqueCode::class);
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
            'plus_one_allowed' => $this->plusOneAllowed,
            'guest_type' => $this->guestType,
            'is_child' => $this->isChild,
            'unique_code' => $this->generateUniqueCode->execute(),
            'plus_one_of' => $this->plusOneOf,
            'invite_sent_on' => $this->inviteSentOn,
        ];
    }

    public function getValuesSharedWithPlusOne(): array
    {
        return [
            'guest_type' => $this->guestType,
        ];
    }
    
    public function getParentId(): ?int
    {
        return $this->plusOneOf;
    }

    public function __toString(): string
    {
        return json_encode($this->jsonSerialize(), JSON_THROW_ON_ERROR);
    }
}