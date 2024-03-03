<?php

namespace App\Http\Controllers;

use Inertia\ResponseFactory as Inertia;
use Inertia\Response as InertiaResponse;

class AdminDashboardController extends Controller
{
    public function __construct(private Inertia $inertia)
    {
        //
    }
    public function __invoke(): InertiaResponse
    {
        return $this->inertia->render('admin/DashboardPage');
    }
}
