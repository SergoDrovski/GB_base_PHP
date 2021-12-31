<?php

namespace Src\Http\Controllers;

use Src\Http\Mysqli;
use Src\Http\Request;
use Src\Http\View;
use Src\Services\AuthJwt;
use Src\Services\AuthJwt2;

class UserCabinetController
{

    /**
     * @throws \SodiumException
     */
    public function index(Request $request)
    {
        $cooks = $request->cookie("token");
        $token1 = '';
        $token2 ='';
        $id = AuthJwt2::create(2);
//        $keyPair = sodium_crypto_sign_keypair();
//        $private_key = openssl_pkey_new();
//        $private_key_pem = openssl_pkey_get_private($private_key);
//        $public_key_pem = openssl_pkey_get_details($private_key)['key'];
//        $id = AuthJwt2::getUserId($token);
//        var_dump($private_key_pem);
        echo '<br>';
        echo '<br>';
        var_dump($id);
        die();


        if (!AuthJwt::checkUserInSistem($id)) {
            var_dump(AuthJwt::checkUserInSistem($id));
            die();
//            header("location: /login" );
        }
        $cooks = $request->cookie("basket_id");
        if (empty($cooks->get())) {
            $param['basket'] = [];
        } else {
            $connect = new Mysqli();
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

        View::view('account', $param);
    }

}