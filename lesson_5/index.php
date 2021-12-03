<?php

require_once("src/Render.php");
require_once("src/Mysql.php");

use Src\Mysql;
use src\Render;

$render = new Render('templates/');
$connect = new Mysql();
$request_method = $_SERVER['REQUEST_METHOD'];
$param = [];


if (empty($_GET) && empty($_POST)) {
    $connect = new Mysql();
    $sql = "SELECT title from images";
    $query = $connect->query($sql);
    $param['collect'] = $query;
    echo $render->showPage('gallery.php', $param);
    exit();
}

if ($request_method == 'POST') {
    echo "<pre>";
    var_dump($_SERVER);
    exit();
//    if ($_SERVER['CONTENT_TYPE'] && $_SERVER['CONTENT_TYPE'] == 'application/json;charset=UTF-8') {
//        $request_data = json_decode(file_get_contents('php://input'), true);
//    } else {
//        $request_data = $_POST;
//    }
}




