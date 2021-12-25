<?php

namespace Src\Http\Controllers;

use Src\Http\Mysqli;
use Src\Http\Request;
use Src\Http\View;
use Src\Services\AuthJwt;
use Src\Services\User;
use Src\Services\Validator;


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
        $form = $request->all()['user'] ?? ['error'];
        $validator = new Validator();
        $errors = $validator->validate($form, [ 'email', 'password']);
        if (!empty($errors)) {
            echo json_encode($errors);
            die();
        }
        $password = $form['password'];
        $email = $form['email'];
        $user = new User();
        if (!$user->findUserByEmail($email)) {
            $errors['email'] = 'Пользователь не найден!';
            echo json_encode($errors);
            die();
        }
        $verify = password_verify($password, $user->getPassword());
        if (!$verify) {
            $errors['password'] = 'Неверный пароль!';
            echo json_encode($errors);
            die();
        }
        $cooks = $request->cookie('token');
        $token = AuthJwt::create($user->getId());
        $cooks->setValue("{$token}");
        $cooks->create();
        echo json_encode(true);

//          $token = AuthJwt::create(2);
//          $id = AuthJwt::getUserId($token);
//          echo '<pre>';
//          var_dump(AuthJwt::checkUserInSistem($id));
//          die();
    }

    public function reg(Request $request, $access)
    {
        $form = $request->all()['user'] ?? ['error'];
        $validator = new Validator();
        $errors = $validator->validate($form, [ 'email', 'password', 'name']);
        if (!empty($errors)) {
            echo json_encode($errors);
            die();
        }
        $password = $form['password'];
        $email = $form['email'];
        $user = new User();
        if (!$user->findUserByEmail($email)) {
            $errors['email'] = 'Пользователь не найден!';
            echo json_encode($errors);
            die();
        }
        $verify = password_verify($password, $user->getPassword());
        if (!$verify) {
            $errors['password'] = 'Неверный пароль!';
            echo json_encode($errors);
            die();
        }
        $cooks = $request->cookie('token');
        $token = AuthJwt::create($user->getId());
        $cooks->setValue("{$token}");
        $cooks->create();
        echo json_encode(true);

//          $token = AuthJwt::create(2);
//          $id = AuthJwt::getUserId($token);
//          echo '<pre>';
//          var_dump(AuthJwt::checkUserInSistem($id));
//          die();
    }
}


//$token = $request->cookie("token")->get();
//$id = AuthJwt::getUserId($token);
//$connect = new Mysqli();
//$sql = "SELECT id FROM users where id = {$id}";
//$connect->query($sql, 'SELECT');