<?php

namespace App\Http\Controllers;

use Inertia\ResponseFactory as Inertia;

class RsvpController extends Controller
{
    public function __construct(private Inertia $inertia)
    {
        //
    }

    public function __invoke()
    {
        return $this->inertia->render('RsvpPage');
    }
}
