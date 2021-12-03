<?php

require_once("src/Render.php");
require_once("src/Mysql.php");

use Src\Mysql;
use src\Render;


$render = new Render('templates/');

$conect = new Mysql();

$conect->
$conect = (new Mysql())->query("SELECT * from images where ;",[]);

var_dump($conect);
die();

$dir = 'photo/';
$collection = array_diff(scandir($dir), array('..', '.'));

$param['path'] = $dir;
$param['collect'] = $collection;

echo $render->showPage('gallery.php', $param);



