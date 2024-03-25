<?php

namespace App\RsvpResponse\Controllers;

use App\Guest\Actions\GetGuestByCode;
use App\Http\Controllers\Controller;
use Inertia\ResponseFactory;
use Illuminate\Http\Request;
use Inertia\Response;
use Psr\Log\LoggerInterface;

class RsvpResponseFormController extends Controller
{
    public function __construct(
        private ResponseFactory $inertia,
        private GetGuestByCode $getGuestByCode,
        private LoggerInterface $logger,
    ) {
        //
    }

    public function show(Request $request): Response
    {
        // add new request class
        
        $guest = $this->getGuestByCode->execute($request->code);

        return $this->inertia->render('RsvpFormPage', ['guest' => $guest]);
    }
}
