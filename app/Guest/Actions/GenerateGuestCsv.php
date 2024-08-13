<?php

namespace App\Guest\Actions;

use Illuminate\Support\Collection;
use App\Guest\DTOs\GuestCsvDto;
readonly class GenerateGuestCsv
{
    /**
     * @param Collection<GuestCsvDto> $guestData
     * @return string
     */
    public function execute(Collection $guestData): string
    {
        $filename = 'guests.csv';
        $handle = fopen($filename, 'w+');
        fputcsv($handle, ['name', 'code', '#qr_code', 'plus_one_text', 'invite_type_text', 'reception_to_follow_text', 'time']);

        $guestData->each(function (GuestCsvDto $guest) use ($handle) {
            fputcsv($handle, $guest->toArray());
        });

        fclose($handle);

        return $filename;
    }
}
