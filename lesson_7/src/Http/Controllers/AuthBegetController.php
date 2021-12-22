<?php

namespace Src\Http\Controllers;

use Src\Http\Request;
use Src\Http\View;
use Src\Services\BegetApi;
use Src\Services\Validator;
use Src\Services\Auth;


class AuthBegetController
{
    public function index(Request $request, $access)
    {
        View::view('beget/authBeg');
    }

    public function save(Request $request, $access)
    {
        $validator = new Validator();
        $errors = $validator->validate($request->get('user'), ['name', 'password']);
        if (!empty($errors)) {
            $params['errors'] = $errors;
            View::view('beget/authBeg', $params);
            die();
        }
        $BegetApi = new BegetApi($request->get('user'));
        if($BegetApi->connectAPI()) {
            $user = new Auth();
            $user->saveSession('beget', $request->get('user'));
            header("location: /beget" );
        }
        $params['errors'] = $BegetApi->errors;
        View::view('beget/authBeg', $params);
        die();
    }
}