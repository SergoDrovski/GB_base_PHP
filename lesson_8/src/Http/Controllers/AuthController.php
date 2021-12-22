<?php

namespace Src\Http\Controllers;

use Src\Http\AuthJwt;
use Src\Http\Mysqli;
use Src\Http\Request;
use Src\Http\View;
use Src\Services\Validator;
use Src\Services\Auth;


class AuthController
{
    public function index(Request $request, $access)
    {
        $cooks = $request->cookie("basket_id");
        $connect = new Mysqli();
        if (empty($cooks->get())) {
            $param['basket'] = [];
        } else {
            $basket_id = (int) $cooks->get();
            $sql = " SELECT
        goods.id,
        title_img,
        title_good,
        description,
        basket_goods.quantity,
        price
 FROM basket_goods
          INNER JOIN goods ON goods.id = product_id
          INNER JOIN images ON goods.id = good_id
 where basket_id = {$basket_id}";
            $connect->query($sql, 'SELECT');
            $param['basket'] = $connect->result;
        }

        View::view('login', $param);
    }

    public function auth(Request $request, $access)
    {

          AuthJwt::create(25);
//        $validator = new Validator();
//        $errors = $validator->validate($request->get('user'), ['name', 'password']);
//        if (!empty($errors)) {
//            $params['errors'] = $errors;
//            View::view('beget/authBeg', $params);
//            die();
//        }
//        $BegetApi = new BegetApi($request->get('user'));
//        if($BegetApi->connectAPI()) {
//            $user = new Auth();
//            $user->saveSession('beget', $request->get('user'));
//            header("location: /beget" );
//        }
//        $params['errors'] = $BegetApi->errors;
//        View::view('beget/authBeg', $params);
//        die();
    }
}