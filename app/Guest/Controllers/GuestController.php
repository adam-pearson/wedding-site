<?php

namespace App\Guest\Controllers;

use App\Guest\Actions\GetAllGuestData;
use App\Http\Controllers\Controller;
use Inertia\ResponseFactory as Inertia;
use Inertia\Response as InertiaResponse;

class GuestController extends Controller
{
    protected string $viewRoot = 'admin_facing/guest-list/views/';

    public function __construct(
        private Inertia $inertia,
        private GetAllGuestData $getAllGuestData,
    ) {
        //
    }

    public function index(): InertiaResponse
    {
        $guests = $this->getAllGuestData->execute();
        
        return $this->inertia->render($this->viewRoot . 'GuestListPage')->with(['guests' => $guests]);
    }

}
