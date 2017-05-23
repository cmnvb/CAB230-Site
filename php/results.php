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
			$resultsSearch = $pdo -> prepare("SELECT Name, Suburb, COALESCE(Rating, 0) AS Rating
				FROM items LEFT JOIN reviews ON items.id = reviews.parkID
				WHERE Name LIKE :nameSearch AND Suburb = :suburb
				GROUP BY Name
				HAVING Rating >= :rating");

			$resultsSearch -> bindValue(":nameSearch", "%" . $_GET['name'] . "%");
			$resultsSearch -> bindValue(":suburb", $_GET['suburb']);
			$resultsSearch -> bindValue(":rating", $_GET['rating']);

			$resultsSearch -> execute();

			foreach ($resultsSearch as $row) {
				$ratingString;
				if (is_null($row["Rating"])) {
					$ratingString = str_repeat("&#9734;", 5);
				} else {
					$ratingString = str_repeat("&#9733;", $row["Rating"]);
					$ratingString .= str_repeat("&#9734;", 5 - $row["Rating"]);
				}

				echo '<li>
					<div class="details">
						<a href="park.php"><p class="park-name">' . $row["Name"] . '</p></a>
						<p class="location">' . $row["Suburb"] . '</p>
						<p class="rating">' . $ratingString . '</p>
					</div>
				</li>';
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