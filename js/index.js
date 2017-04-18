function initialise() {
	var findMeButton = document.getElementById("findme");
	findMeButton.addEventListener("click", findPosition);
}

function findPosition() {
	if (navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(postPosition, alertError);
	} else {
		alert("Geolocation is not supported by this browser.");
	}
}

function postPosition(position) {
	//TODO: Post to results page for searching

	/*Placeholder*/ alert("Latitude: " + position.coords.latitude + ", Longitude: " + position.coords.longitude);
	window.location.href = "results.html";
}

function alertError(error) {
	var msg = "";

	switch(error.code) {
		case error.PERMISSION_DENIED:
			msg = "User denied the request for Geolocation."
			break;
		case error.POSITION_UNAVAILABLE:
			msg = "Location information is unavailable."
			break;
		case error.TIMEOUT:
			msg = "The request to get user location timed out."
			break;
		case error.UNKNOWN_ERROR:
			msg = "An unknown error occurred."
			break;
	}

	alert(msg);
}

// Initialise event listeners after page loading
window.addEventListener("load", initialise);