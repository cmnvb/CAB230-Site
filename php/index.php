<?php require('connectToDB.php'); ?><!DOCTYPE html>
<html>
<head>
	<!-- Page Data -->
	<meta charset="utf-8" />
	<title>Park Search</title>

	<!-- Styling -->
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<link rel="stylesheet" type="text/css" href="../css/index.css">
	<link href="https://fonts.googleapis.com/css?family=Kaushan+Script%7COpen+Sans" rel="stylesheet">

	<!-- Scripts -->
	<script type="text/javascript" src="../js/index.js"></script>
	<script type="text/javascript" src="../js/greyTextFix.js"></script>
</head>

<body>
	<!-- Nav -->
	<?php include('navbar.php'); ?>

	<main>
		<!-- Search Background-->
		<div id="green-border"><p>Search for a park:</p></div>

		<!-- Search Area-->
		<div id="wrapper">
			<form name="search" action="results.php" method="get">
				<div id="autofind">
					<p >Or just <input id="findme" type="submit" value="find me!" onclick="returnPosition();" formnovalidate/></p>
				</div>
				<div>
					<select id="suburb" name="suburb">
						<option value="" selected hidden>Select a suburb</option>
						<?php
						$suburbSearch = $pdo->query('SELECT DISTINCT Suburb FROM items');
						foreach ($suburbSearch as $row) {
							echo "<option value='" . $row['Suburb'] . "'>" . $row['Suburb'] . "</option>";
						}
						?>
					</select>
				</div>
				<div>
					<input id="nameSearch" type="search" name="name" placeholder="Enter park name"/>
				</div>
				<div>
					<select name="rating">
						<option value="0" selected>All Ratings</option>
						<option value="1">&#9733;&#9734;&#9734;&#9734;&#9734;</option>
						<option value="2">&#9733;&#9733;&#9734;&#9734;&#9734;</option>
						<option value="3">&#9733;&#9733;&#9733;&#9734;&#9734;</option>
						<option value="4">&#9733;&#9733;&#9733;&#9733;&#9734;</option>
						<option value="5">&#9733;&#9733;&#9733;&#9733;&#9733;</option>
					</select>
				</div>
				<input id="lat" type="hidden" name="latitude" value=''>
				<input id="lon" type="hidden" name="longitude" value=''>
				<div>
					<input type="submit" value="Search" />
				</div>
			</form>
		</div>
	</main>

	<!-- Footer -->
	<footer>
	</footer>
</body>
</html>