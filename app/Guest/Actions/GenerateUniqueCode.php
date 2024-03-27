<?php

namespace App\Guest\Actions;

use App\Guest\Repositories\GuestRepository;

class GenerateUniqueCode
{
    public function __construct(
        private GuestRepository $guestRepository
    ) {
        //
    }

    public function execute(): string
    {
        $code = strtoupper(bin2hex(random_bytes(3)));

        while ($this->guestRepository->codeExists($code)) {
            $code = strtoupper(bin2hex(random_bytes(3)));
        }

        return $code;
    }
}