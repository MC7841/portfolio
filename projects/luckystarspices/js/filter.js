
// Variables used across all filters
const cards = document.getElementsByClassName("card");
const wholeCat = "1";
const groundCat = "2";

$('input[type="checkbox"]').on('change', function() {
    $(this).siblings('input[type="checkbox"]').not(this).prop('checked', false);
 });

// Whole Spice Filter
var wholeFilter = () => {
    // Whole Spice Check
    if (document.getElementById("whole_spice").checked) {

        for (let i =0; i < cards.length; i++) {
            let cat = cards[i].querySelector(".catID");

            if (cat.innerHTML == wholeCat) {
                cards[i].classList.remove("d-none");
            } else {
                cards[i].classList.add("d-none");
            }
        }
    }

    // Remove class if checkbox is unchecked
    if (!document.getElementById("whole_spice").checked) {
        for (let i=0; i < cards.length; i++) {
            cards[i].classList.remove("d-none");
        }
    }        
}

var groundFilter = () => {

    //Ground Spice Check
    if (document.getElementById("ground_spice").checked) {

        for (let i =0; i < cards.length; i++) {
            let cat = cards[i].querySelector(".catID");

            if (cat.innerHTML == groundCat) {
                cards[i].classList.remove("d-none");
            } else {
                cards[i].classList.add("d-none");
            }
        }
    }

    // Remove class if checkbox is unchecked
    if (!document.getElementById("ground_spice").checked) {
        for (let i=0; i < cards.length; i++) {
            cards[i].classList.remove("d-none");
        }
    } 
}