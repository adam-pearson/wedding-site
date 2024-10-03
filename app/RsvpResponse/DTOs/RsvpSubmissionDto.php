<?php

namespace App\RsvpResponse\DTOs;

use Illuminate\Contracts\Support\Arrayable;
use JsonSerializable;
use Stringable;

final readonly class RsvpSubmissionDto implements JsonSerializable, Arrayable, Stringable
{

    public function __construct(
        public bool $coming,
        public int $guestId,
        public ?bool $bringingPlusOne = false,
        public ?bool $alcohol = null,
        public ?string $dietaryRequirements = null,
        public ?string $songRequests = null,
        public ?string $hatedSongs = null,
    ) {
    }

    public function isUsingPlusOne(): bool
    {
        return $this->bringingPlusOne;
    }

    public function getRsvpData(): array
    {
        return [
            'guest_id' => $this->guestId,
            'coming' => $this->coming,
            'alcohol' => $this->alcohol,
            'dietary_requirements' => $this->dietaryRequirements,
            'song_requests' => $this->songRequests,
            'hated_songs' => $this->hatedSongs,
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
            'bringing_plus_one' => $this->bringingPlusOne,
            'coming' => $this->coming,
            'alcohol' => $this->alcohol,
            'dietary_requirements' => $this->dietaryRequirements,
            'song_requests' => $this->songRequests,
            'hated_songs' => $this->hatedSongs,
        ];
    }

    public function __toString(): string
    {
        return json_encode($this->jsonSerialize(), JSON_THROW_ON_ERROR);
    }
}
