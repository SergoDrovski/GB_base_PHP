
//Добавляем товар в корзину из страницы товара
$( document ).ready(function(){
    $("#cart_send").click(function(){
        const request = $(".cart_quantity").serialize();
        $.ajax({
            method: "POST",
            url: "/basket/add",
            data: request,
            success: function(data){
                let basket = JSON.parse(data);
                renderMassageBasket(basket);
                createRightModalBasket(basket);
            }
        })
    });
});

//путь к папке с картинками товара
const path = $(".img_basket").attr('src');

// id товара которого увеличиваем количество
const id = $("input[name='id']").attr('value');



//функция формирование модального окна после добавления товара
function renderMassageBasket(basket) {
    let countBasket = basket.length;
    let totalSum = 0;

    for (let i = 0; i < countBasket; i++) {
        let quantity = basket[i]['quantity'];
        let price = basket[i]['price'];
        let elemSum = price * quantity;
        totalSum += elemSum;

        //создаём путь изображения для modalAddcart
        if (Number(id) === basket[i]['id']) {
            let nameImg = path + basket[i]['title_img'];
            $(".img_basket").attr('src', nameImg);
        }
    }
    document.querySelector('.count_basket').innerHTML = countBasket;
    document.querySelector('.totalSum_basket').innerHTML = totalSum + ' руб.';
}



//функция формирование бокового-модального окна после добавления товара
function createRightModalBasket(basket) {
    let countBasket = basket.length;
    const prodList = document.querySelector('.offcanvas-cart');
    while (prodList.firstChild) {
        prodList.removeChild(prodList.firstChild);
    }

    let totalSum = 0;
    for (let i = 0; i < countBasket; i++) {
        let id = basket[i]['id'];
        let name = basket[i]['title_good'];
        let quantity = basket[i]['quantity'];
        let price = basket[i]['price'];
        let elemSum = price * quantity;
        let nameImg = path + basket[i]['title_img'];
        totalSum += elemSum;

        let itemEl = document.createElement('li');
        itemEl.setAttribute('class', `offcanvas-cart-item-single`);
        itemEl.innerHTML = `
                <div class="offcanvas-cart-item-block">
                    <a href="/product/?id=${id}" class="offcanvas-cart-item-image-link">
                        <img src="${nameImg}" alt="img" class="offcanvas-cart-image">
                    </a>
                    <div class="offcanvas-cart-item-content">
                        <a href="/product/?id=${id}" class="offcanvas-cart-item-link">${name}</a>
                        <div class="offcanvas-cart-item-details">
                            <span class="offcanvas-cart-item-details-quantity" data-quantity="${quantity}">${quantity} x </span>
                            <span class="offcanvas-cart-item-details-price" data-price="${price}">${price} руб.</span>
                        </div>
                    </div>
                </div>
                <div class="offcanvas-cart-item-delete text-right">
                    <a href="#" class="offcanvas-cart-item-delete"><i class="fa fa-trash-o"></i></a>
                </div>`;
        prodList.append(itemEl);
    }
    document.querySelector('.offcanvas-cart-total-price-value').innerHTML = totalSum + ' руб.';
    document.querySelector('.header-action-icon-item-count').innerHTML = countBasket;
}


//функция формирование таблицы списка товаров корзины
function createBasketDesc(basket) {
    let countBasket = basket.length;

    //Если корзина пуста выводим сообщение
    if(countBasket === 0){
        const content = document.querySelector('.cart-section');
        while (content.firstChild) {
            content.removeChild(content.firstChild);
        }
        content.innerHTML = `
            <div class="container" data-widget="emptyCart">
              <h4 class="title">Корзина пуста</h4>
              <p>Воспользуйтесь поиском, чтобы найти всё что нужно.</p>
              <br>
            </div>`;
        return
    }

    const prodList = document.querySelector('.basket_product_list');
    while (prodList.firstChild) {
        prodList.removeChild(prodList.firstChild);
    }

    let totalSum = 0;
    for (let i = 0; i < countBasket; i++) {
        let id = basket[i]['id'];
        let name = basket[i]['title_good'];
        let quantity = basket[i]['quantity'];
        let price = basket[i]['price'];
        let elemSum = price * quantity;
        let nameImg = path + basket[i]['title_img'];
        totalSum += elemSum;

        let itemEl = document.createElement('tr');
        itemEl.setAttribute('class', '.basket_row_product');
        itemEl.innerHTML = `
            <td class="product_remove"><a class="product_delete" data-id="${id}"><i class="fa fa-trash-o"></i></a></td>
            <td class="product_thumb"><a href="/product/?id=${id}"><img src="${nameImg}" alt="img"></a></td>
            <td class="product_name"><a href="/product/?id=${id}">${name}</a></td>
            <td class="product-price" data-price="${price}">${price} руб.</td>
            <td class="product_quantity" data-quantity="${quantity}"><input min="1" max="100" value="${quantity}" type="number"><label>/шт.</label></td>
            <td class="product_total">${totalSum} руб.</td>`;
        prodList.append(itemEl);
    }
    document.querySelector('.basket_price').innerHTML = totalSum + ' руб.';
    let shipPrice = document.querySelector('.ship_price').dataset.ship;
    document.querySelector('.total_price').innerHTML = totalSum + Number(shipPrice) + ' руб.';
}


//Удаляем товар из корзины
$( document ).ready(function(){
    $(".product_delete").click(function(){
        const id = $(this).attr('data-id');
        $.ajax({
            method: "POST",
            url: "/basket/del",
            data: `id=${id}`,
            success: function(data){
                let basket = JSON.parse(data);
                createRightModalBasket(basket);
                createBasketDesc(basket);
            }
        })
    });
});

//Изменение количества товаров в корзине
// $( document ).ready(function(){
//     $(".cart_submit_change").click(function(){
//         const list = document.querySelectorAll('.basket_row_product');
//         let request = '';
//
//         for (let i = 0; i < list.length; i++) {
//             let quantity = basket[i]['quantity'];
//             let price = basket[i]['price'];
//             let elemSum = price * quantity;
//             totalSum += elemSum;
//
//             //создаём путь изображения для modalAddcart
//             if (Number(id) === basket[i]['id']) {
//                 let nameImg = path + basket[i]['title_img'];
//                 $(".img_basket").attr('src', nameImg);
//             }
//         }
//         console.log(list);
//
//
//
//         // $.ajax({
//         //     method: "POST",
//         //     url: "/basket/del",
//         //     data: `prod[one]=1&a[two]=2&a[three]=3&b[]=1&b[]=2&b[]=3`,
//         //     success: function(data){
//         //         let basket = JSON.parse(data);
//         //         createRightModalBasket(basket);
//         //         createBasketDesc(basket);
//         //     }
//         // })
//     });
// });