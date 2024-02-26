<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class AdminGuestListController extends Controller
{
    public function __invoke()
    {
        return Inertia::render('admin/GuestListPage');
    }
}
