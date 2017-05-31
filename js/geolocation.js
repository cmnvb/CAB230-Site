/**
 * A set of method allowing the browser to find the user's location.
 * 
 * @author Patrick Chang n9703969
 */

var latitude, longitude;

/**
 * Finds the position of the user after the page has loaded.
 * Assigns user position to global variables for later use.
 */
function findPosition() {
	if (navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(function(position) {
			// Assign latitude and longitude to global variables
			latitude = position.coords.latitude;
			longitude = position.coords.longitude;
		}, alertError);
	} else {
		alert("Geolocation is not supported by this browser.");
	}
}

/**
 * Empties value of suburb and changes value of hidden
 * inputs for latitude and longitude.
 */
function postPosition() {
	document.getElementById('suburb').value = "";
	document.getElementById('lat').value = latitude;
	document.getElementById('lon').value = longitude;
}

/**
 * Empties value hidden inputs for latitude and longitude.
 */
function postSuburb() {
	document.getElementById('lat').value = "";
	document.getElementById('lon').value = "";
}

/**
 * Alerts user if an error has occured in finding their location.
 *
 * @param error - error object returned from geolocation.
 */
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

// Find user position after page loaded
window.addEventListener("load", findPosition);