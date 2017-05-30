var latitude, longitude;

function findPosition() {
	if (navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(function(position) {
			latitude = position.coords.latitude;
			longitude = position.coords.longitude;
		}, alertError);
	} else {
		alert("Geolocation is not supported by this browser.");
	}
}

function returnPosition(position) {
	document.getElementById('lat').value = latitude;
	document.getElementById('lon').value = longitude;
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
window.addEventListener("load", findPosition);