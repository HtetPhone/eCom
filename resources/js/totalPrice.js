//total price
const tPrice = document.querySelectorAll(".t-price");
const tAmount = document.querySelector('#tAmount');
const tInput = document.querySelector("#tInput");
// console.log(tPrice);
let totalAmount = 0;

tPrice.forEach((price) => {
    let inputString = price.innerText;
    let numericPart = parseFloat(inputString.replace(/[^0-9.]/g, ""));

    // console.log(numericPart);
    totalAmount += parseInt(numericPart);
});

tAmount.innerHTML = '$'+ totalAmount;
tInput.value = totalAmount;