import "/node_modules/bootstrap/dist/js/bootstrap.bundle.js";

setTimeout(function () {
    let message = document.querySelector("#flash-message");
    message.classList.add("d-none");
}, 3000);


//add minus input
const plus = document.querySelector("#plus");
const minus = document.querySelector("#minus");
const quantity = document.querySelector("#quantity");
const bQuantity = document.querySelector("#bQuantity");
let result = parseInt(quantity.value);

plus.addEventListener("click", function (e) {
    e.preventDefault();
    result += 1;
    quantity.value = result;
    bQuantity.value = result;
});

minus.addEventListener("click", (e) => {
    e.preventDefault();
    if (result > 0) {
        result -= 1;
        quantity.value = result;
        bQuantity.value = result;

    }
});
