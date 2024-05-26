<?php

namespace App\TodoList\Controllers;

use App\Http\Controllers\Controller;
use Inertia\ResponseFactory;
use Inertia\Response as InertiaResponse;

class TodoListController extends Controller
{
    protected string $viewRoot = 'admin_facing/todo-list/views/';

    public function __construct(private ResponseFactory $inertia)
    {
        //
    }

    public function index(): InertiaResponse
    {
        return $this->inertia->render($this->viewRoot . 'TodoListPage');
    }
}
