<?php

namespace App\Guest\DTOs;

use Illuminate\Contracts\Support\Arrayable;
use JsonSerializable;
use Stringable;

final readonly class GuestCsvDto implements JsonSerializable, Arrayable, Stringable
{
    public function __construct(
        public string $name,
        public string $code,
        public string $qrCode,
        public ?string $plusOneText,
        public string $inviteTypeText,
        public ?string $receptionToFollowText,
        public string $time,
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
            'code' => $this->code,
            'qr_code' => $this->qrCode,
            'plus_one_text' => $this->plusOneText,
            'invite_type_text' => $this->inviteTypeText,
            'reception_to_follow_text' => $this->receptionToFollowText,
            'time' => $this->time,
        ];
    }

    public function __toString(): string
    {
        return json_encode($this->jsonSerialize(), JSON_THROW_ON_ERROR);
    }
}
