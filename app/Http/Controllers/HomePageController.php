<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class HomePageController extends Controller
{
    public function __invoke()
    {
        return Inertia::render('HomePage');
    }
}
