<?php

namespace App\Homepage\Controllers;

use App\Http\Controllers\Controller;
use Inertia\ResponseFactory;
use Inertia\Response as InertiaResponse;

class HomePageController extends Controller
{
    protected string $viewRoot = 'guest_facing/homepage/views/';

    public function __construct(private ResponseFactory $inertia)
    {
        //
    }
    
    public function show(): InertiaResponse
    {
        return $this->inertia->render($this->viewRoot . 'HomePage');
    }
}
