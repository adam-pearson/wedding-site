<?php

namespace App\Http\Controllers;

use App\Services\GuestService;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\ResponseFactory;

class ShowGuestsController extends Controller
{
    public function __construct(private GuestService $guestService, private ResponseFactory $response)
    {
        //
    }

    public function __invoke(): JsonResponse
    {
        $guests = $this->guestService->getGuestsAndReceivedInvites();

        return $this->response->json(['guests' => $guests]);
    }

}
