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
	<nav>
		<a id="home" href="index.php">Brisbane Parks</a>
		<a class="nav-element" href="signup.php">Sign up</a>
		<a class="nav-element" href="signin.php">Log in</a>
		<a class="nav-element" href="#">What's On</a>
		<a class="nav-element" href="#">About</a>
	</nav>

	<main>
		<!-- Search Background-->
		<div id="green-border"><p>Search for a park:</p></div>

		<!-- Search Area-->
		<div id="wrapper">
			<form action="results.php" method="get">
				<div>
					<select id="suburb" name="suburb" oninvalid="this.setCustomValidity('A suburb must be selected.')" oninput="setCustomValidity('')" required>
						<option value="" selected hidden>Select a suburb</option>
						<?php
						$suburbSearch = $pdo->query('SELECT DISTINCT Suburb FROM items');
						foreach ($result as $row) {
							echo "<option value=" . $row['Suburb'] . ">" . $row['Suburb'] . "</option>";
						}
						?>
					</select>
				</div>
				<div>
					<input type="search" name="name" placeholder=" Enter park name"/>
				</div>
				<div>
					<select name="rating">
						<option value="" selected>All Ratings</option>
						<option value="1">1*</option>
						<option value="2">2*</option>
						<option value="3">3*</option>
						<option value="4">4*</option>
						<option value="5">5*</option>
					</select>
				</div>
				<div>
					<input type="submit" value="Search" />
				</div>
			</form>
			<p id="autofind">Or just <a id="findme" href="results.php">find me!</a></p>
		</div>
	</main>

	<!-- Footer -->
	<footer>
	</footer>
</body>
</html>