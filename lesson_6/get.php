<?php

if ($request_method == 'GET') {
    if ($request_url === '/') {
        $sql = "SELECT goods.id , title_good, description, quantity, price, title_img
                FROM goods INNER JOIN images ON goods.id = images.good_id where preview = 1";
        $query = $connect->query($sql, 'SELECT');

        if (!$query) {
            header("HTTP/1.0 500 Internal Server Error" );
            die();
        }
        $collect = [];
        $param['collect'] = $connect->result;

        $content = $render->showPage('views/goods.phtml', $param);
        echo $render->showPage('layouts/index.phtml', ['content' => $content]);
        die();
    }

    if ($request_url === '/product/') {
        $request_data = $_GET;
        if (empty($request_data['id'])) {
            header("HTTP/1.1 404 Not Found" );
            die();
        }
        $id = (int) $request_data['id'];

        $sql = "SELECT goods.id , title_good, description, quantity, price, group_concat(title_img) as title_img
FROM goods INNER JOIN images ON goods.id = images.good_id where goods.id ={$id}";
        $query = $connect->query($sql, 'SELECT');

        if (!$query) {
            header("HTTP/1.1 404 Not Found" );
            die();
        }

        $param['product'] = $connect->result[0];

        $sql = "SELECT r.id,name,text,date,parent_id
FROM goods INNER JOIN reviews r on goods.id = r.goods_id where goods.id ={$id}";
        $query = $connect->query($sql, 'SELECT');

        $param['reviews'] = $connect->result;

        $content = $render->showPage('views/product.phtml', $param);
        echo $render->showPage('layouts/index.phtml', ['content' => $content]);
        die();
    }

}
