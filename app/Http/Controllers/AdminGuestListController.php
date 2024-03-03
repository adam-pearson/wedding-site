<?php

namespace App\Http\Controllers;

use App\Services\GuestService;
use Inertia\ResponseFactory as Inertia;
use Inertia\Response as InertiaResponse;

class AdminGuestListController extends Controller
{
    public function __construct(
        private GuestService $guestService,
        private Inertia $inertia
    ) {
        //
    }

    public function __invoke(): InertiaResponse
    {
        $guests = $this->guestService->getGuestsAndReceivedInvites();
        
        return $this->inertia->render('admin/GuestListPage')->with(['guests' => $guests]);
    }
}
