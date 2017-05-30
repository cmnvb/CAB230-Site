function initialise() {
	var suburb = document.getElementById("suburb");
	var DOB = document.getElementById("DOB");

	suburb.addEventListener("change", function(){suburb.style.color = "black"});

	if (DOB) {
		DOB.addEventListener("change", function(){suburb.style.color = "black"});
	}

}

window.addEventListener("load", initialise);