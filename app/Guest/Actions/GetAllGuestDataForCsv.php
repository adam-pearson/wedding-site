<?php

namespace App\Guest\Actions;

use App\Guest\DTOs\GuestCsvDto;
use App\Guest\Enums\GuestType;
use App\Guest\Models\Guest;
use App\Guest\Repositories\GuestRepository;
use Exception;
use Illuminate\Config\Repository;
use Illuminate\Support\Collection;

readonly class GetAllGuestDataForCsv
{
    const string HAS_PLUS_ONE_TEXT = 'You are also invited to bring along a plus one, if you wish.';
    const string DAY_GUEST_TEXT = 'to join them on their wedding day';
    const string EVENING_GUEST_TEXT = 'to join them for an evening reception to celebrate their wedding';
    const string RECEPTION_TO_FOLLOW_TEXT = 'Reception to follow';
    const string DAY_GUEST_TIME = 'One O\'Clock in the Afternoon';
    const string EVENING_GUEST_TIME = 'Seven O\'Clock in the Evening';

    public function __construct(private GuestRepository $guestRepository, private Repository $config)
    {
        //
    }

    public function execute(): Collection
    {
        $ungroupedGuests = $this->guestRepository->getUngroupedMainGuests()
            ->map(function (Guest $guest) {
            $guestType = GuestType::tryFrom($guest->guest_type);

            if (!$guestType) {
                throw new Exception('Guest does not have a valid guest type');
            }

            return new GuestCsvDto(
                name: $guest->name,
                code: $guest->unique_code,
                qrCode: 'URL:' . $this->config->get('app.url') . '/rsvp/form?code=' . $guest->unique_code,
                plusOneText: $guest->plus_one_allowed ? self::HAS_PLUS_ONE_TEXT : '',
                inviteTypeText: $guestType === GuestType::ALL_DAY ? self::DAY_GUEST_TEXT : self::EVENING_GUEST_TEXT,
                receptionToFollowText: $guestType === GuestType::ALL_DAY ? self::RECEPTION_TO_FOLLOW_TEXT : '',
                time: $guestType === GuestType::ALL_DAY ? self::DAY_GUEST_TIME : self::EVENING_GUEST_TIME,
            );
        });

        $groupedGuests = $this->guestRepository->getGroupedMainGuests(['group.guests'])
            ->map(function (Guest $guest) {
                $group = $guest->group;
                $primaryGuest = $group->guests->first(); // this is the guest whose code we will use for the invite details & rsvp code

                $guestType = GuestType::tryFrom($primaryGuest->guest_type);

                if (!$guestType) {
                    throw new Exception('Guest does not have a valid guest type');
                }

                return new GuestCsvDto(
                    name: $primaryGuest->group->group_name,
                    code: $primaryGuest->unique_code,
                    qrCode: 'URL:' . $this->config->get('app.url') . '/rsvp/form?code=' . $primaryGuest->unique_code,
                    plusOneText: '', // if they're in a group, they can't have a plus one
                    inviteTypeText: $guestType === GuestType::ALL_DAY ? self::DAY_GUEST_TEXT : self::EVENING_GUEST_TEXT,
                    receptionToFollowText: $guestType === GuestType::ALL_DAY ? self::RECEPTION_TO_FOLLOW_TEXT : '',
                    time: $guestType === GuestType::ALL_DAY ? self::DAY_GUEST_TIME : self::EVENING_GUEST_TIME,
                );
        })->unique(function (GuestCsvDto $item) {
            return $item->name;
        });

        return $groupedGuests->merge($ungroupedGuests);
    }
}
