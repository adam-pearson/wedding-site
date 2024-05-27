<?php

namespace App\RsvpResponse\Controllers;

use App\Guest\Actions\GetGuestByCode;
use App\Http\Controllers\Controller;
use App\RsvpResponse\Requests\RsvpShowFormRequest;
use Inertia\ResponseFactory;
use Inertia\Response;
use Psr\Log\LoggerInterface;

class RsvpSuccessController extends Controller
{
    protected string $viewRoot = 'guest_facing/rsvp/form/views/';

    public function __construct(
        private readonly ResponseFactory $inertia,
        private readonly GetGuestByCode  $getGuestByCode,
    ) {
        //
    }

    public function show(RsvpShowFormRequest $request): Response
    {
        $guest = $this->getGuestByCode->execute($request->getCode());

        return $this->inertia->render($this->viewRoot . 'RsvpSuccessPage', ['guest' => $guest]);
    }
}
