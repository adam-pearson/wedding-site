<?php

namespace App\Dashboard\Controllers;

use App\Http\Controllers\Controller;
use Inertia\ResponseFactory;
use Inertia\Response as InertiaResponse;

class DashboardController extends Controller
{
    protected string $viewRoot = 'admin_facing/dashboard/views/';

    public function __construct(private ResponseFactory $inertia)
    {
        //
    }

    public function show(): InertiaResponse
    {
        return $this->inertia->render($this->viewRoot . 'DashboardPage');
    }
}
