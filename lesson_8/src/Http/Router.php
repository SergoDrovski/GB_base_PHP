<?php

namespace Src\Http;


use Src\Http\Controllers\BasketController;
use Src\Http\Controllers\UserCabinetController;
use Src\Services\Auth;
use Src\Http\Controllers\AuthBegetController;
use Src\Http\Controllers\ProductController;
use Src\Http\Controllers\MainController;
use Src\Http\Controllers\ShopController;

class Router
{
    private static $routes = [
        '/' => [MainController::class, 'index', 'GET', ['indefinite', 'user']],
        '/shop' => [ShopController::class, 'index', 'GET', ['indefinite', 'user']],
        '/product/' => [ProductController::class, 'index', 'GET', ['indefinite', 'user']],
        '/product/rev' => [ProductController::class, 'saveReviews', 'POST', ['user']],
        '/cabinet' => [UserCabinetController::class, 'index', 'GET', ['user']],
        '/basket/index' => [BasketController::class, 'index', 'GET', ['indefinite', 'user']],
        '/basket/add' => [BasketController::class, 'add', 'POST', ['indefinite', 'user']],
        '/basket/del' => [BasketController::class, 'delete', 'POST', ['indefinite', 'user']],
    ];

    static function init()
    {
        $request_url = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
        $request_method = $_SERVER['REQUEST_METHOD'];
        foreach (self::$routes as $route => $controller) {
            if ($request_url == $route) {
                if (!class_exists($controller[0])) {
                    echo "Класс " . $controller[0] . " не найден.";
                    return [];
                }
                if (!method_exists($controller[0], $controller[1])) {
                    echo "Метод " . $controller[1] . " в " . $controller[0] . " не найден.";
                    return [];
                }

                if (strtoupper($request_method) == strtoupper($controller[2])) {
                    $class = new $controller[0];
                    $method = $controller[1];
                    $request_data = [];
                    $access = false;
                    if ($request_method == 'POST') {
                        if ($_SERVER['CONTENT_TYPE'] && $_SERVER['CONTENT_TYPE'] == 'application/json;charset=UTF-8') {
                            $request_data = json_decode(file_get_contents('php://input'), true);
                        } else {
                            $request_data = $_POST;
                        }
                    }
                    if ($request_method == 'GET') {
                        $request_data = $_GET;
                    }
                    if ($request_method == 'DELETE') {
                        $request_data = $_GET;
                    }
                    if ($request_method == 'PUT') {
                        $request_data = $_POST;
                    }
//                    $user = Auth::check();
//                    if (in_array($user, $controller[3])) {
//                        $access = true;
////                        if (!Auth::check($controller[3])) {
////                            $access = false;
////                        }
//                    }

                    return $class->$method(new Request($request_data, $_FILES), $access);
                    // TODO Доделать мердж данных
                }
            }
        }
        header("HTTP/1.0 404 Not Found");
        return [];
    }
}