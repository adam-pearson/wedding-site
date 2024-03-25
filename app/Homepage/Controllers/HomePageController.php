<?php

namespace App\Homepage\Controllers;

use App\Http\Controllers\Controller;
use Inertia\ResponseFactory;
use Inertia\Response as InertiaResponse;

class HomePageController extends Controller
{
    public function __construct(private ResponseFactory $inertia)
    {
        //
    }
    public function __invoke(): InertiaResponse
    {
        return $this->inertia->render('HomePage');
    }
}
