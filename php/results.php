<?php require('connectToDB.php');
session_start();
?>
<html>
<head>
	<!-- Page Data -->
	<meta charset="utf-8" />
	<title>Park Results</title>

	<!-- Styling -->
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<link rel="stylesheet" type="text/css" href="../css/results.css">
	<link href="https://fonts.googleapis.com/css?family=Kaushan+Script%7COpen+Sans" rel="stylesheet">
</head>

<body>
	<!-- Nav -->
	<?php include('navbar.php'); ?>

	<main>
		<div id="wrapper">
			<!-- Results Header -->
			<div id="header">
				<div id="crumb">
					<p><a href="index.php">Search</a> > Results page</p>
				</div>
				<h1 id="header-text">Top Results</h1>
				<a id="search-again" href="index.php">Search again?</a>
			</div>

			<!-- Results List-->
			<ul id="results">
			<?php
			if (isset($_GET['latitude']) || isset($_GET['suburb'])) {
				if ($_GET['latitude'] != '' && $_GET['longitude'] != '') {
					$resultsSearch = $pdo -> prepare("SELECT items.id AS id, Name, Suburb, AVG(COALESCE(Rating, 0)) AS Rating,
						( 6371 * acos( cos( radians(:userLatitide1) ) * cos( radians( Latitude ) ) * cos( radians( Longitude ) - radians(:userLongitude) ) + sin( radians(:userLatitide2) ) * sin( radians( Latitude ) ) ) ) AS distance, Latitude, Longitude
						FROM items LEFT JOIN reviews ON items.id = reviews.parkID
						GROUP BY Name
						HAVING distance < 2 AND Rating >= :rating
						ORDER BY Rating;");

					$resultsSearch -> bindValue(":userLatitide1", $_GET['latitude']);
					$resultsSearch -> bindValue(":userLongitude", $_GET['longitude']);
					$resultsSearch -> bindValue(":userLatitide2", $_GET['latitude']);
					$resultsSearch -> bindValue(":rating", $_GET['rating']);

				} else {
					$resultsSearch = $pdo -> prepare("SELECT items.id AS id, Name, Suburb, AVG(COALESCE(Rating, 0)) AS Rating, Latitude, Longitude
						FROM items LEFT JOIN reviews ON items.id = reviews.parkID
						WHERE Name LIKE :nameSearch AND Suburb = :suburb
						GROUP BY Name
						HAVING Rating >= :rating
						ORDER BY Rating;");

					$resultsSearch -> bindValue(":nameSearch", "%" . strtoupper($_GET['name']) . "%");
					$resultsSearch -> bindValue(":suburb", $_GET['suburb']);
					$resultsSearch -> bindValue(":rating", $_GET['rating']);
				}

				$resultsSearch -> execute();
				$resultsArray = $resultsSearch->fetchAll(PDO::FETCH_ASSOC);
				$PHPtoJSON = json_encode($resultsArray);

				foreach ($resultsArray as $row) {
					$ratingString = str_repeat("&#9733;", $row["Rating"]);
					$ratingString .= str_repeat("&#9734;", 5 - $row["Rating"]);

					echo '<li>
						<div class="details">
							<a href="park.php?id=' . $row["id"] . '"><p class="park-name">' . $row["Name"] . '</p></a>
							<p class="location">' . $row["Suburb"] . '</p>
							<p class="rating">' . $ratingString . '</p>
						</div>
					</li>';
				}

				if ($resultsSearch -> rowCount() == 0) {
					echo "<h3>No results found, please search again.</h3>";
					echo $_GET["suburb"];
				}
			} else {
				echo "<h3>A valid search has not been made.</h3>";
			}
			?>
			</ul>
			
			
			<!-- Map -->
			<div id="map">
				<script>
				/* Function for adding markers using search parameters */
				function initMap() {
					<?php try {
						echo "var markersJSON = $PHPtoJSON;";
					} catch (Exception $e) {} ?>

					var bounds = new google.maps.LatLngBounds();
					var parksMap = new google.maps.Map(document.getElementById('map'), {
						zoom: 1
					});


					// Add markers from data
					for (var i = 0; i < markersJSON.length; i++) {
					 var star = "&#9733;".repeat(parseInt(markersJSON[i]["Rating"])) + "&#9734;".repeat(parseInt(5 - markersJSON[i]["Rating"]))
						var parkInfo = new google.maps.InfoWindow({
							content: "<a href='park.php?id=" + markersJSON[i]["id"] + "'><p class='park-name'>" + markersJSON[i]["Name"] + "</p></a>" +
							"<p class='location'>" + markersJSON[i]["Suburb"] + "</p>" +
							"<p class='rating'>" + star + "</p>" +
							"</div>"
						});

						var markerObject = new google.maps.Marker({
							position: new google.maps.LatLng(parseFloat(markersJSON[i]["Latitude"]), parseFloat(markersJSON[i]["Longitude"])),
							map: parksMap,
							title: markersJSON[i]["Name"],
							infowindow: parkInfo
						});

						// Add click listener to display info window
						google.maps.event.addListener(markerObject, 'click', function() {
								this.infowindow.open(map, this);
						});

						bounds.extend(markerObject.position);
					}

					parksMap.fitBounds(bounds);
				}
				</script>
				<script async defer
				src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBp8B74RCtcjM6j6sfn3JBF8kvBlhsXJ7Y&callback=initMap&sensor=false">
				</script>
			</div>
		</div>
	</main>

	<!-- Footer -->
<?php include('footer.php'); ?>
</body>
</html>