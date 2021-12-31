<?php

namespace Src\Http\Controllers;

use Src\Http\Request;
use Src\Http\View;


class MainController
{

    public function index(Request $request)
    {
        header("location: /shop");
//        View::view('main');
    }

}