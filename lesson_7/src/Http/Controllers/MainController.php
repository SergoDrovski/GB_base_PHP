<?php

namespace Src\Http\Controllers;

use Src\Http\Request;
use Src\Http\View;


class MainController
{

    public function index(Request $request)
    {
        View::view('main');
    }

}