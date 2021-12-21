
// Расчёт корзины
//Боковая
const Basket = document.querySelectorAll(`.offcanvas-cart-item-details`);
let totalSum = 0;
for (let i = 0; i < Basket.length; i++) {
    let price = Basket[i].children[1].dataset.price;
    let quantity = Basket[i].children[0].dataset.quantity;
    let elemSum = price * quantity;
    totalSum += elemSum;
}
document.querySelector('.offcanvas-cart-total-price-value').innerHTML = totalSum + ' руб.';

// Рейтинг оценок
const elemRatingAll = document.querySelectorAll(`.product-review`);
for (let i = 0; i < elemRatingAll.length; i++) {
    let rating = elemRatingAll[i].dataset.rating;
    let collect = elemRatingAll[i].querySelectorAll('.review-empty');
    for (let i = 0; i < rating; i++) {
        collect[i].classList.remove('review-empty');
        collect[i].classList.add('review-fill');
    }
}

//на основной странице
document.querySelector('.basket_price').innerHTML = totalSum + ' руб.';
let shipPrice = document.querySelector('.ship_price').dataset.ship;
document.querySelector('.total_price').innerHTML = totalSum + Number(shipPrice) + ' руб.';
