<?php

require_once("src/Render.php");
require_once("src/Mysql.php");

use Src\Mysql;
use src\Render;

define('ROOT_PATH', $_SERVER['DOCUMENT_ROOT']);

$render = new Render('templates/');
$connect = new Mysql();
$request_method = $_SERVER['REQUEST_METHOD'];
$request_url = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
$param = [];


if ($request_method == 'GET') {
    if ($request_url === '/') {
        $sql = "SELECT goods.id , title_good, description, quantity, price, title_img
                FROM goods INNER JOIN images ON goods.id = images.good_id where preview = 1";
        $query = $connect->query($sql, 'SELECT');
        $collect = [];
        $param['collect'] = $query;

        $content = $render->showPage('views/goods.phtml', $param);
        echo $render->showPage('layouts/index.phtml', ['content' => $content]);
        die();
    }
    if ($request_url === '/product/') {
        $request_data = $_GET;
        $id = (int) $request_data['id'];

        $sql = "SELECT goods.id , title_good, description, quantity, price, group_concat(title_img) as title_img
FROM goods INNER JOIN images ON goods.id = images.good_id where goods.id ={$id}";
        $query = $connect->query($sql, 'SELECT');
        $param = $query[0];

//        echo "<pre>";
//        var_dump($param);
//        exit();

        $content = $render->showPage('views/product.phtml', $param);
        echo $render->showPage('layouts/index.phtml', ['content' => $content]);
        die();
    }

}

if ($request_method == 'POST') {
    if ($request_url === '/product/') {
        $request_data = $_FILES;
        $pathPhoto = ROOT_PATH . "/photo/big/";
        $name = basename($request_data['photo']['name']);
        $type = $request_data['photo']['type'];
        $size = $request_data['photo']['size'];
        if (move_uploaded_file($request_data['photo']['tmp_name'], $pathPhoto.$name)) {
            $pathPhotoSmall = ROOT_PATH . "/photo/small/";
            $filename= $pathPhoto.$name;
            $img = imagecreatefromjpeg($filename);
            imagejpeg($img,$pathPhotoSmall.$name,65);

            $sql = 'INSERT INTO images (title, alt, count, size) VALUES (?, ?, ?, ?)';
            $data = ['ssii', [$name,'img',13,$size]];
            $result = $connect->query($sql, 'INSERT', $data);
            if (!$result) {
                echo 'что-то пошло не так!!!';
                die();
            }
        }
        Header("location: ./");
    }
    if (preg_match('/application\/x-www-form-urlencoded/m', $_SERVER['CONTENT_TYPE'])) {
        $id = $_POST['idImg'];

        $sql = 'DELETE FROM images WHERE id = ?';
        $data = ['i', [$id]];
        $result = $connect->query($sql, 'DELETE', $data);
        if (!$result) {
            echo 'что-то пошло не так!!!';
            die();
        }
    }
}




