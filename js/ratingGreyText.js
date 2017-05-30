function initialise() {
	var rating = document.getElementById("rating");

	suburb.addEventListener("change", function(){suburb.style.color = "black"});

	if (DOB) {
		DOB.addEventListener("change", function(){suburb.style.color = "black"});
	}

}

window.addEventListener("load", initialise);