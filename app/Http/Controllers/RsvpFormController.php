<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use App\Services\GuestService;
use Inertia\ResponseFactory as Inertia;
use Illuminate\Http\Request;

class RsvpFormController extends Controller
{
    public function __construct(
        private Inertia $inertia,
        private GuestService $guestService 
    ) {
        //
    }

    public function __invoke(Request $request)
    {
        // add new request class
        
        $guest = $this->guestService->getGuestByCode($request->code);

        return $this->inertia->render('RsvpFormPage', ['guest' => $guest]);
    }
}
