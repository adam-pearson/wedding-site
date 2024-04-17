<?php

namespace App\RsvpResponse\Controllers;

use App\Guest\Actions\GetGuestByCode;
use App\Http\Controllers\Controller;
use App\RsvpResponse\Requests\RsvpShowFormRequest;
use Inertia\ResponseFactory;
use Inertia\Response;
use Psr\Log\LoggerInterface;

class RsvpResponseFormController extends Controller
{
    protected string $viewRoot = 'guest_facing/rsvp/form/views/';

    public function __construct(
        private ResponseFactory $inertia,
        private GetGuestByCode $getGuestByCode,
        private LoggerInterface $logger,
    ) {
        //
    }

    public function show(RsvpShowFormRequest $request): Response
    {        
        $guest = $this->getGuestByCode->execute($request->getCode());

        return $this->inertia->render($this->viewRoot . 'RsvpFormPage', ['guest' => $guest]);
    }
}
