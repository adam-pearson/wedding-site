<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use Inertia\ResponseFactory as Inertia;
use Illuminate\Http\Request;

class RsvpFormController extends Controller
{
    public function __construct(private Inertia $inertia)
    {
        //
    }

    public function __invoke(Request $request, Guest $guest)
    {
        dd($guest);
        return $this->inertia->render('RsvpPage');
    }
}
