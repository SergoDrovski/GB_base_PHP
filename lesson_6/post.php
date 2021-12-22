<?php

if ($request_method == 'POST') {
    if ($request_url === '/product/rev') {
        $request_data = $_POST;
        $name = htmlspecialchars($request_data['name']);
        $text = htmlspecialchars($request_data['text']);
        $goods_id = (int) $request_data['goods_id'];
        $sql = 'INSERT INTO reviews (name, text, goods_id) VALUES (?, ?, ?)';
        $data = ['ssi', [$name,$text,$goods_id]];

        $query = $connect->query($sql, 'INSERT', $data);

        echo "<pre>";
        var_dump($query);
        exit();

    }
//    if (preg_match('/application\/x-www-form-urlencoded/m', $_SERVER['CONTENT_TYPE'])) {
//        $id = $_POST['idImg'];
//
//        $sql = 'DELETE FROM images WHERE id = ?';
//        $data = ['i', [$id]];
//        $result = $connect->query($sql, 'DELETE', $data);
//        if (!$result) {
//            echo 'что-то пошло не так!!!';
//            die();
//        }
//    }
}