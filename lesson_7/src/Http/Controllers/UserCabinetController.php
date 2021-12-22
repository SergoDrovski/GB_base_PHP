<?php

namespace Src\Http\Controllers;

use Src\Http\Request;
use Src\Http\View;


class UserCabinetController
{

    public function index(Request $request)
    {
        echo "<pre>";
        var_dump($_SESSION);
        echo "<br>";
        echo 'Добро пожаловать';
    }

}