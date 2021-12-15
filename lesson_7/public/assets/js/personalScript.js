


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
