<?php

namespace Src\Http\Controllers;

use Src\Http\Mysqli;
use Src\Http\Request;
use Src\Http\View;
use Src\Services\Auth;
use Src\Services\Validator;


class BasketController
{

    public function index(Request $request)
    {
        $basket_id = $request->cookie('basket_id');
        if (empty($basket_id)) {
            $param = null;
            View::view('cart');
        }


//        View::view('cart');
    }

    public function add(Request $request, $id) {
        $basket_id = $request->cookie('basket_id');
        $quantity = $request->input('quantity') ?? 1;
        if (empty($basket_id)) {
            // если корзина еще не существует — создаем объект
            $basket = Basket::create();
            // получаем идентификатор, чтобы записать в cookie
            $basket_id = $basket->id;
        } else {
            // корзина уже существует, получаем объект корзины
            $basket = Basket::findOrFail($basket_id);
            // обновляем поле `updated_at` таблицы `baskets`
            $basket->touch();
        }
        if ($basket->products->contains($id)) {
            // если такой товар есть в корзине — изменяем кол-во
            $pivotRow = $basket->products()->where('product_id', $id)->first()->pivot;
            $quantity = $pivotRow->quantity + $quantity;
            $pivotRow->update(['quantity' => $quantity]);
        } else {
            // если такого товара нет в корзине — добавляем его
            $basket->products()->attach($id, ['quantity' => $quantity]);
        }
        // выполняем редирект обратно на страницу, где была нажата кнопка «В корзину»
        return back()->withCookie(cookie('basket_id', $basket_id, 525600));
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

# SELECT title_img,
#        title_good,
#        description,
#        basket_goods.quantity,
#        price
# FROM basket_goods
#          INNER JOIN goods ON goods.id = product_id
#          INNER JOIN images ON goods.id = good_id
# where basket_id = 1