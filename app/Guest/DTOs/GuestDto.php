<?php

namespace App\Guest\DTOs;

use App\Guest\Actions\GenerateUniqueCode;
use App\Guest\Enums\GuestType;
use App\Guest\Models\Guest;
use Carbon\Carbon;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Collection;
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
        public ?int $groupId = null,
        public ?string $groupName = null,
        public ?array $groupMembers = null,
        public ?string $email = null,
        public ?string $phone = null,
        public ?string $address = null,
        public ?int $plusOneOf = null,
        public ?int $id = null,
        public ?Carbon $inviteSentOn = null,
        public ?Carbon $saveTheDateSentOn = null,
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
            'unique_code' => $this->getGuestUniqueCode(),
            'plus_one_of' => $this->plusOneOf,
            'invite_sent_on' => $this->inviteSentOn,
            'save_the_date_sent_on' => $this->saveTheDateSentOn,
            'group_id' => $this->groupId,
        ];
    }

    public function getGuestUniqueCode(): string
    {
        $guest = Guest::find($this->id);
        if ($guest->unique_code) {
            return $guest->unique_code;
        }
        return $this->generateUniqueCode->execute();
    }

    public function getValuesSharedWithPlusOne(): array
    {
        return [
            'guest_type' => $this->guestType,
        ];
    }

    public function getGroupDetails(): array
    {
        return [
            'group_id' => $this->groupId,
            'group_name' => $this->groupName,
            'group_members' => $this->groupMembers,
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
