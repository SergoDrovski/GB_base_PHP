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
        $sql = "SELECT goods.id , title_good, description, quantity, price, title_img
                FROM goods INNER JOIN images ON goods.id = images.good_id where preview = 1";
        $connect = new Mysqli();
        $query = $connect->query($sql, 'SELECT');
        if (!$query) {
            View::view('404');
            die();
        }
        $param['collect'] = $connect->result;
        View::view('shop', $param);
    }


}