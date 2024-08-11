<?php

namespace App\Guest\Controllers\API;

use App\Guest\Actions\GetAllGroupData;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class GuestGroupsApiController extends Controller
{
    public function __construct(
        private readonly GetAllGroupData $getAllGroupData,
    ) {
        //
    }

    public function index(): JsonResponse
    {
        $groups = $this->getAllGroupData->execute();

        return response()->json(['groups' => $groups]);
    }
}
