<?php

namespace App\Dashboard\Services;

use App\Guest\Enums\GuestType;
use App\Guest\Models\Guest;
use Carbon\Carbon;

class DashboardStatsService
{
    public function getTotalGuestAttendingCount(): int
    {
        // get Guest models where they have an RSVP response, and rsvp response is_coming = true
        return Guest::whereHas('rsvpResponse', function ($query) {
            $query->where('coming', true);
        })->count();
    }

    public function getTotalNonGuestAttendingCount(): int
    {
        // hardcoded temporarily until we can add a page for this

        $nonGuests = collect([
            'Adam',
            'Heather',
            'Iain (photographer)',
            'Suz (photographer)',
        ]);

        return $nonGuests->count();
    }

    public function getTotalRemainingInvitesCount(): int
    {
        return Guest::whereNull('invite_sent_on')->count();
    }

    public function getTotalRemainingRsvpsCount(): int
    {
        return Guest::whereNotNull('invite_sent_on')->whereDoesntHave('rsvpResponse')->count();
    }

    public function getRsvpOverTimeData(): array
    {
        $totalInvitesToSend = Guest::count();

        $firstInviteSent = Carbon::parse(Guest::min('invite_sent_on'));
        $today = Carbon::today();

        $data = [];
        $cumulativeRsvpsReturned = 0;
        $cumulativeInvitesSent = 0;

        for ($date = $firstInviteSent; $date->lte($today); $date->addDay()) {
            $dailyRsvpsReturned = Guest::whereHas('rsvpResponse', function ($query) use ($date) {
                $query->whereDate('created_at', $date);
            })->count();

            $dailyInvitesSent = Guest::whereDate('invite_sent_on', $date)->count();

            $cumulativeRsvpsReturned += $dailyRsvpsReturned;
            $cumulativeInvitesSent += $dailyInvitesSent;

            $data[] = [
                'date' => $date->toDateString(),
                'rsvps_returned' => $cumulativeRsvpsReturned,
                'invites_sent' => $cumulativeInvitesSent,
            ];
        }


        return [
            'total_invites_to_send' => $totalInvitesToSend,
            'invite_data_by_date' => $data,
        ];
    }

    public function getAttendanceRatio(): array
    {
        return [
            [
                'coming' =>
                    Guest::whereHas('rsvpResponse', function ($query) {
                        $query->where('coming', true);
                    })->count()
            ],
            [
                'not_coming' =>
                    Guest::whereHas('rsvpResponse', function ($query) {
                        $query->where('coming', false);
                    })->count()
            ],
            [
                'not_received_invite' =>
                    Guest::whereNull('invite_sent_on')
                        ->count()
            ],
            [
                'not_responded' =>
                    Guest::whereDoesntHave('rsvpResponse')
                        ->whereNotNull('invite_sent_on')
                        ->count()
            ],
        ];
    }

    /** NOTE: this should exclude any children or evening guests, as they are automatically no-alcohol */
    public function getAlcoholRatio(): array
    {
        return [
            [
                'alcohol' =>
                    Guest::whereHas('rsvpResponse', function ($query) {
                        $query->where('alcohol', true);
                    })->count()
            ],
            [
                'no_alcohol' =>
                    Guest::whereHas('rsvpResponse', function ($query) {
                        $query->where('alcohol', false);
                    })->count()
            ],
            [
                'not_received_invite' =>
                    Guest::whereNull('invite_sent_on')
                        ->count()
            ],
            [
                'not_responded' =>
                    Guest::whereDoesntHave('rsvpResponse')
                        ->whereNotNull('invite_sent_on')
                        ->count()
            ],
        ];
    }

    public function getTotalChildrenAttendingCount(): int
    {
        return Guest::whereHas('rsvpResponse', function ($query) {
            $query->where('is_child', true);
        })->count();
    }

    public function getDayAttendanceRatio(): array
    {
        return [
            [
                'coming' =>
                    Guest::where('guest_type', GuestType::ALL_DAY->value)
                        ->whereHas('rsvpResponse', function ($query) {
                            $query->where('coming', true);
                        })->count()
            ],
            [
                'not_coming' =>
                    Guest::where('guest_type', GuestType::ALL_DAY->value)
                        ->whereHas('rsvpResponse', function ($query) {
                            $query->where('coming', true);
                        })->count()
            ],
            [
                'not_received_invite' =>
                    Guest::where('guest_type', GuestType::ALL_DAY->value)
                        ->whereNull('invite_sent_on')
                        ->count()
            ],
            [
                'not_responded' =>
                    Guest::where('guest_type', GuestType::ALL_DAY->value)
                        ->whereDoesntHave('rsvpResponse')
                        ->whereNotNull('invite_sent_on')
                        ->count()
            ],
        ];
    }

    public function getEveningAttendanceRatio(): array
    {
        return [
            [
                'coming' =>
                    Guest::where('guest_type', GuestType::EVENING->value)
                        ->whereHas('rsvpResponse', function ($query) {
                            $query->where('coming', true);
                        })->count()
            ],
            [
                'not_coming' =>
                    Guest::where('guest_type', GuestType::EVENING->value)
                        ->whereHas('rsvpResponse', function ($query) {
                            $query->where('coming', true);
                        })->count()
            ],
            [
                'not_received_invite' =>
                    Guest::where('guest_type', GuestType::EVENING->value)
                        ->whereNull('invite_sent_on')
                        ->count()
            ],
            [
                'not_responded' =>
                    Guest::where('guest_type', GuestType::EVENING->value)
                        ->whereDoesntHave('rsvpResponse')
                        ->whereNotNull('invite_sent_on')
                        ->count()
            ],
        ];
    }

    public function getPlusOneUsage(): array
    {
        return [
            [
                'using' =>
                    Guest::whereHas('plusOneOwner')
                        ->whereHas('rsvpResponse', function ($query) {
                            $query->where('coming', true);
                        })->count()
            ],
            [
                'not_using' =>
                    Guest::whereDoesntHave('plusOneOwner')
                        ->whereHas('rsvpResponse', function ($query) {
                            $query->where('coming', true);
                        })->count()
            ],
            [
                'not_allowed' =>
                    Guest::where('plus_one_allowed', false)
                        ->count()
            ],
            [
                'not_received_invite' =>
                    Guest::where('plus_one_allowed', true)
                        ->whereNull('invite_sent_on')
                        ->count()
            ],
            [
                'not_responded' =>
                    Guest::where('plus_one_allowed', true)
                        ->whereNotNull('invite_sent_on')
                        ->count()
            ],
        ];
    }

    public function getNotYetRespondedGuests(): array
    {
        $results = Guest::whereNotNull('invite_sent_on')
            ->whereDoesntHave('rsvpResponse')
            ->get(['name', 'unique_code', 'invite_sent_on', 'group_id'])
            ->mapToGroups(function ($item) {
                $groupId = $item->group_id ?? 'ungrouped';
                return [$groupId => $item];
            });

        return [
            'total' => count($results->flatten()),
            'guests' => $results->toArray()
        ];
    }

    public function getNotAttendingGuests(): array
    {
        $results = Guest::whereHas('rsvpResponse', function ($query) {
            $query->where('coming', false);
        })->get(['name', 'unique_code', 'invite_sent_on', 'group_id'])
            ->mapToGroups(function ($item) {
                $groupId = $item->group_id ?? 'ungrouped';
                return [$groupId => $item];
            });

        return [
            'total' => count($results->flatten()),
            'guests' => $results->toArray(),
        ];
    }
}
