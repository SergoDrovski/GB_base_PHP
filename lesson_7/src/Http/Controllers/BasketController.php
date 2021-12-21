<?php

namespace Src\Http\Controllers;

use Src\Http\Cookie;
use Src\Http\CookieNew;
use Src\Http\Mysqli;
use Src\Http\Request;
use Src\Http\View;
use Src\Services\Auth;
use Src\Services\Validator;


class BasketController
{

    public function index(Request $request)
    {
        $connect = new Mysqli();
        $sql = "SELECT title_img,
                   title_good,
                   description,
                   basket_goods.quantity,
                   price
                FROM basket_goods
                     INNER JOIN goods ON goods.id = product_id
                     INNER JOIN images ON goods.id = good_id
                where basket_id = 1";
        $connect->query($sql, 'SELECT');

        $count = count($connect->result);


        $cooks = $request->cookie("basket_id");

        if (empty($cooks->get())) {
            $param['basket'] = [];
            View::view('cart', $param);
        }

        $basket_id = (int) $cooks->get();
        $connect = new Mysqli();
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
        View::view('cart', $param);
    }



    public function add(Request $request) {
        $connect = new Mysqli();
        $cooks = $request->cookie('basket_id');
        $product_id = (int) $request->get('id');
        $quantity = (int) $request->get('quantity') ?? 1;
        if (empty($cooks->get())) {
            // если корзина еще не существует — создаем
            $sql = "INSERT INTO basket () VALUES ()";
            $connect->query($sql, 'INSERT');
            // получаем идентификатор, чтобы записать в cookie
            $basket_id = $connect->result[0];
        } else {
            // корзина уже существует, получаем объект корзины
            $basket_id = (int) $cooks->get();
        }
        $sql = "SELECT
                    id,
                    product_id,
                    quantity
                 FROM basket_goods
                 where product_id = {$product_id} and basket_id = {$basket_id}";
        $connect->query($sql, 'SELECT');
        $prodInBasket = $connect->result;
        $result = false;

        if (count($prodInBasket)) {
            // если такой товар есть в корзине — изменяем кол-во
            $newQuantity = $prodInBasket[0]['quantity'] + $quantity;
            $sql = "UPDATE
                         basket_goods
                    SET quantity = {$newQuantity}
                    where basket_id = {$basket_id} and product_id = {$product_id}";
            // если всё ок, записываем id корзины в куку
            if ($connect->query($sql, 'UPDATE')) {
                $cooks->setValue("{$basket_id}");
                $cooks->create();
                $result = true;
            }
        } else {
            // если такого товара нет в корзине — добавляем его
            $sql = "INSERT INTO basket_goods (basket_id, product_id, quantity) VALUES (?, ?, ?)";
            $data = ['iii', [$basket_id,$product_id,$quantity]];
            if ($connect->query($sql, 'INSERT', $data)) {
                $cooks->setValue("{$basket_id}");
                $cooks->create();
                $result = true;
            }
        }
        if (!$result) {
            echo false;
            die();
        }
        $sql = "SELECT 
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
        // отправляем актуальные данные корзины на фронт
        echo json_encode($connect->result);
    }


    public function delete (Request $request)
    {
        $connect = new Mysqli();
        $cooks = $request->cookie('basket_id');
        $product_id = (int) $request->get('id');
        $basket_id = (int) $cooks->get() ?? null;
        if (empty($basket_id)) {
            echo false;
            die();
        }
        $sql = "SELECT
                    id
                 FROM basket_goods
                 where product_id = {$product_id} and basket_id = {$basket_id}";
        $connect->query($sql, 'SELECT');
        $prodInBasket = $connect->result;
        if (count($prodInBasket)) {
            //  Удаляем товар из корзины
            $sql = "DELETE FROM
                        basket_goods
                    where product_id = {$product_id} and basket_id = {$basket_id}";
            $connect->query($sql, 'DELETE');

            //  получаем новый список товаров
            $sql = "SELECT 
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
            // отправляем актуальные данные корзины на фронт
            echo json_encode($connect->result);
            die();
        }
        echo false;
    }

    public function change (Request $request)
    {
    }
}

# SELECT id,
#        product_id,
#        quantity
# FROM basket_goods
# where product_id = 1 and basket_id = 1

# UPDATE basket_goods
# SET quantity = 6
# where basket_id = 1 and product_id = 1

