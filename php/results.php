<?php require('connectToDB.php'); ?><!DOCTYPE html>
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
						( 6371 * acos( cos( radians(:userLatitide1) ) * cos( radians( Latitude ) ) * cos( radians( Longitude ) - radians(:userLongitude) ) + sin( radians(:userLatitide2) ) * sin( radians( Latitude ) ) ) ) AS distance
						FROM items LEFT JOIN reviews ON items.id = reviews.parkID
						GROUP BY Name
						HAVING distance < 10 AND Rating >= :rating
						ORDER BY Rating;");

					$resultsSearch -> bindValue(":userLatitide1", $_GET['latitude']);
					$resultsSearch -> bindValue(":userLongitude", $_GET['longitude']);
					$resultsSearch -> bindValue(":userLatitide2", $_GET['latitude']);
					$resultsSearch -> bindValue(":rating", $_GET['rating']);

				} else {
					$resultsSearch = $pdo -> prepare("SELECT items.id AS id, Name, Suburb, AVG(COALESCE(Rating, 0)) AS Rating
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

				foreach ($resultsSearch as $row) {
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
				}
			} else {
				echo "<h3>A valid search has not been made.</h3>";
			}
			?>
			</ul>
			
			
			<!-- Map -->
			<div id="map"></div>
		</div>
	</main>

	<!-- Footer -->
	<footer>
	</footer>
</body>
</html>