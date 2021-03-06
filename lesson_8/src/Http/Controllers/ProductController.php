<?php

namespace Src\Http\Controllers;

use Src\Http\Mysqli;
use Src\Http\Request;
use Src\Http\View;


class ProductController
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

        if (empty($request->get('id'))) {
            View::view('404', $param);
            die();
        }
        $id = (int) $request->get('id');
        $sql = "SELECT goods.id,
               title_good,
               description,
               quantity,
               price,
               group_concat(title_img) as title_img
        FROM goods
                 INNER JOIN images ON goods.id = images.good_id
        where goods.id ={$id}";

        $query = $connect->query($sql, 'SELECT');
        if (!$query) {
            View::view('404', $param);
            die();
        }
        $param['product'] = $connect->result[0];

        $sql = "SELECT round(avg(rating)) as rating
        FROM goods left join reviews r on goods.id = r.goods_id
        where goods.id = {$id}";
        $query = $connect->query($sql, 'SELECT');
        $param['product']['rating'] = $connect->result[0]['rating'];

        $sql = "SELECT r.id,name,text,date,parent_id,rating
FROM goods INNER JOIN reviews r on goods.id = r.goods_id where goods.id ={$id}";
        $query = $connect->query($sql, 'SELECT');
        $param['reviews'] = $connect->result;

        View::view('product', $param);
    }


    public function saveReviews(Request $request, $access)
    {
        $name = htmlspecialchars($request->get('name'));
        $text = htmlspecialchars($request->get('text'));
        $rating = (int) $request->get('rating');
        $goods_id = (int) $request->get('goods_id');
        $sql = 'INSERT INTO reviews (name, text, goods_id, rating) VALUES (?, ?, ?, ?)';
        $data = ['ssii', [$name,$text,$goods_id,$rating]];

        $connect = new Mysqli();
        $query = $connect->query($sql, 'INSERT', $data);

        header( "location: /product/?id={$goods_id}");
    }
}