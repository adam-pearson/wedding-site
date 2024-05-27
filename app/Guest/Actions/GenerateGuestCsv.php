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
        fputcsv($handle, ['name', 'email', 'phone', 'address', 'guest_type', 'plus_one_allowed', 'unique_code', 'qr_code_string']);

        foreach ($guestData as $guest) {
            fputcsv($handle, $guest->toArray());
        }

        fclose($handle);

        return $filename;
    }
}
