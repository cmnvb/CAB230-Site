/*
 *
 *
 *
 *
 */
function initialise() {
	var suburb = document.getElementById("suburb");
	var DOB = document.getElementById("DOB");
	var rating = document.getElementById("rating");

	if (suburb) {
		suburb.addEventListener("change", function(){suburb.style.color = "black"});
	} else if (DOB) {
		DOB.addEventListener("change", function(){DOB.style.color = "black"});
	} else if (rating) {
		rating.addEventListener("change", function(){rating.style.color = "black"});
	}

}

window.addEventListener("load", initialise);