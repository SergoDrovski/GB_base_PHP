<?php

namespace Src\Http\Controllers;

use Src\Http\Mysqli;
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

        $sql = "SELECT goods.id , title_good, description, quantity, price, title_img
                FROM goods INNER JOIN images ON goods.id = images.good_id where preview = 1";
        $query = $connect->query($sql, 'SELECT');
        if (!$query) {
            View::view('404');
            die();
        }
        $param['collect'] = $connect->result;
        View::view('shop', $param);
    }


}