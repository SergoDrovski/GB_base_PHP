<?php

namespace Src\Http\Controllers;

use Src\Http\Mysqli;
use Src\Http\Request;
use Src\Http\View;
use Src\Services\Auth;
use Src\Services\Validator;


class ProductController
{

    public function index(Request $request, $access)
    {
//        if ($access != true) {
//            header("location: /beget/login" );
//        }

        if (empty($request->get('id'))) {
            View::view('404');
            die();
        }
        $id = (int) $request->get('id');
        $sql = "SELECT goods.id , title_good, description, quantity, price, group_concat(title_img) as title_img
FROM goods INNER JOIN images ON goods.id = images.good_id where goods.id ={$id}";
        $connect = new Mysqli();
        $query = $connect->query($sql, 'SELECT');
        if (!$query) {
            View::view('404');
            die();
        }
        $param['product'] = $connect->result[0];

        $sql = "SELECT r.id,name,text,date,parent_id
FROM goods INNER JOIN reviews r on goods.id = r.goods_id where goods.id ={$id}";
        $query = $connect->query($sql, 'SELECT');
        $param['reviews'] = $connect->result;

        View::view('product', $param);
    }

    public function saveReviews(Request $request, $access)
    {
        $name = htmlspecialchars($request->get('name'));
        $text = htmlspecialchars($request->get('text'));
        $goods_id = (int) $request->get('goods_id');
        $sql = 'INSERT INTO reviews (name, text, goods_id) VALUES (?, ?, ?)';
        $data = ['ssi', [$name,$text,$goods_id]];

        $connect = new Mysqli();
        $query = $connect->query($sql, 'INSERT', $data);

        echo "<pre>";
        var_dump($query);
        exit();
    }

}