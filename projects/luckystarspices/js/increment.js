
var increment = ()  => {
    var quantity = document.getElementById('itemQuantity');
    var message = document.getElementById('errMessage');
    var stock = quantity.getAttribute('max');

    if (quantity.value != stock) {
        quantity.value++;
        message.innerHTML = "";
    } else {
        message.innerHTML = "<br> Max quantity reached";
    }
}

var decrease = () => {
    var quantity = document.getElementById('itemQuantity');
    var message = document.getElementById('errMessage');

    if (quantity.value > 1) {
        quantity.value--;
        message.innerHTML = "";
    }

    if (quantity.value < 1 ) {
        message.innerHTML = "<br>Cannot take quantities less than or equal to zero.";
    }
}