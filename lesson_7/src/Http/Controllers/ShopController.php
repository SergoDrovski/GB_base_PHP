<?php

namespace Src\Http\Controllers;

use Src\Http\Request;
use Src\Http\View;
use Src\Services\Auth;
use Src\Services\Validator;


class ShopController
{

    public function index(Request $request, $access)
    {
//        if ($access != true) {
//            header("location: /beget/login" );
//        }
        View::view('shop');
    }


}