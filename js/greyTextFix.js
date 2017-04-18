function initialise() {
	var suburb = document.getElementById("suburb");

	suburb.addEventListener("change", function(){checkValid(suburb)});
}

function checkValid(suburb) {
	if (suburb.value != "") {
		suburb.style.color = "black";
	}
}

window.addEventListener("load", initialise);