<?php

namespace App\DTOs;

use App\Enums\GuestType;
use App\Services\GuestService;
use Carbon\Carbon;
use Illuminate\Contracts\Support\Arrayable;
use JsonSerializable;
use Stringable;

final readonly class EditGuestRequestDTO implements JsonSerializable, Arrayable, Stringable
{
    private GuestService $guestService;

    public function __construct(
        public int $id,
        public string $name,
        public bool $plusOneAllowed,
        public GuestType $guestType,
        public bool $isChild,
        public ?string $email,
        public ?string $phone,
        public ?string $address,
        public ?bool $coming,
        public ?bool $alcohol,
        public ?string $dietaryRequirements,
        public ?Carbon $inviteSentAt,
    ) {
        $this->guestService = app(GuestService::class);
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
            'invite_sent_at' => $this->inviteSentAt,
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
            'unique_code' => $this->guestService->generateUniqueCode(),
            'coming' => $this->coming,
            'alcohol' => $this->alcohol,
            'dietary_requirements' => $this->dietaryRequirements,
            'invite_sent_at' => $this->inviteSentAt,
        ];
    }

    public function __toString(): string
    {
        return json_encode($this->jsonSerialize(), JSON_THROW_ON_ERROR);
    }
}