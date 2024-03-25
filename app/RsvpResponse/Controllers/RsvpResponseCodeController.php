<?php

namespace App\RsvpResponse\Controllers;

use App\Http\Controllers\Controller;
use Inertia\ResponseFactory as Inertia;

class RsvpResponseCodeController extends Controller
{
    public function __construct(private Inertia $inertia)
    {
        //
    }

    public function show()
    {
        return $this->inertia->render('RsvpCodePage');
    }
}
