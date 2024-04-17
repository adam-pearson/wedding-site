<?php

namespace App\RsvpResponse\Controllers;

use App\Http\Controllers\Controller;
use Inertia\ResponseFactory as Inertia;

class RsvpResponseCodeController extends Controller
{
    protected string $viewRoot = 'guest_facing/rsvp/code/views/';

    public function __construct(private Inertia $inertia)
    {
        //
    }

    public function show()
    {
        return $this->inertia->render($this->viewRoot . 'RsvpCodePage');
    }
}
