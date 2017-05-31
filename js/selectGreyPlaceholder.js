/**
 * A method changing the colour of select tags to grey.
 * This enables a grey text colouring for placeholder values
 * similar to those found in text-type input tags.
 *
 * @author Patrick Chang n9703969
 */

/**
 * Detects whether select tag of specific id is on a page
 * and changes its colour to grey.
 */
function detectAndChange() {
	var suburb = document.getElementById("suburb");
	var DOB = document.getElementById("DOB");
	var rating = document.getElementById("rating");

	if (suburb && suburb.value == "") {
		suburb.addEventListener("change", function(){suburb.style.color = "black"});
	} else if (DOB) {
		DOB.addEventListener("change", function(){DOB.style.color = "black"});
	} else if (rating) {
		rating.addEventListener("change", function(){rating.style.color = "black"});
	}
}

// Detect id and change colour after page loaded
window.addEventListener("load", detectAndChange);