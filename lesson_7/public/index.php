<?php

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

error_reporting(E_ALL);
ini_set("display_errors", 1);

define('ROOT_PATH', dirname(__DIR__));
define('VIEWS_PATH', ROOT_PATH . '/templates/views/');
define('LAYOUTS_PATH', ROOT_PATH . '/templates/layouts/');


require __DIR__ . '/../vendor/autoload.php';

use Src\Http\Router;

session_set_cookie_params(3600);
session_start();

//var_dump($_SESSION);
//die();

//$_SESSION['user'] = [
//    'isp' => [
//        'auth' => 12333,
//        'date' => time(),
//        'ip' => '123.4534.6788'],
//
//    'beget' => [
//        'log' => 'root',
//        'pass' => 'root',
//        'date' => time()
//];

Router::init();