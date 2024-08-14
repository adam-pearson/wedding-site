<?php

namespace App\RsvpResponse\Controllers;

use App\Guest\Actions\GetGuestByCode;
use App\Guest\Actions\GetGuestsArrayByCode;
use App\Http\Controllers\Controller;
use App\RsvpResponse\Requests\RsvpShowFormRequest;
use Inertia\ResponseFactory;
use Inertia\Response;
use Psr\Log\LoggerInterface;

class RsvpResponseFormController extends Controller
{
    protected string $viewRoot = 'guest_facing/rsvp/form/views/';

    public function __construct(
        private readonly ResponseFactory $inertia,
        private readonly GetGuestsArrayByCode  $getGuestsArrayByCode,
    ) {
        //
    }

    public function show(RsvpShowFormRequest $request): Response
    {
        $guests = $this->getGuestsArrayByCode->execute($request->getCode());
        return $this->inertia->render($this->viewRoot . 'RsvpFormPage', ['guests' => $guests]);
    }
}
