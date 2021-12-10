<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
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

// По-хорошему, тут нужно было переделать логику через маршрутизацию и контроллеры
// но пока, так как это базовый курс, оставим через подключение файлов


require_once("get.php");
require_once("post.php");

