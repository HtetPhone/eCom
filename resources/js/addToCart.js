const addToCartForm = document.querySelector('#addToCartForm')
const addToCart = document.querySelector('#addToCart')

addToCart.addEventListener('click', function() {
    addToCartForm.submit()
})