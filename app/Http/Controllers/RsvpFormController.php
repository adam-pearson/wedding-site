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
        return redirect()->back()->withErrors(['Page not yet implemented']);
        // dd($guest->load(['plusOneChild', 'receivedInvite']));
        // make this render form page with guest details
        // add new request class
        // return $this->inertia->render('RsvpFormPage', ['guest' => $guest]);
    }
}
