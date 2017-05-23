<?php require('connectToDB.php'); 

$parkFetch = $pdo -> prepare("SELECT Name, Suburb, Street, AVG(COALESCE(Rating, 0)) AS Rating
	FROM items LEFT JOIN reviews ON items.id = reviews.parkID
	WHERE items.id = :parkID
	GROUP BY items.id");
$parkFetch -> bindValue(":parkID", $_GET['id']);
$parkFetch -> execute();

$parkName = $suburb = $street = $ratingString = "";

foreach ($parkFetch as $row) {
	$parkName = $row['Name'];
	$suburb = $row['Suburb'];
	$street = $row['Street'];
	$ratingString = str_repeat("&#9733;", $row["Rating"]);
	$ratingString .= str_repeat("&#9734;", 5 - $row["Rating"]);
}
?><!DOCTYPE html>
<html>
<head>
	<!-- Page Data -->
	<meta charset="utf-8">
	<meta name= "description" content= "Guide To Brisbane's Parks">
	<title>Park Name</title>

	<!-- Styling -->
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<link rel="stylesheet" type="text/css" href="../css/park.css">
	<link href="https://fonts.googleapis.com/css?family=Kaushan+Script|Open+Sans" rel="stylesheet">
</head>

<body>
	<!-- Nav -->
	<?php include('navbar.php'); ?>

	<main>
		<div id="wrapper">
			<div id="header">
				<div id="crumb">
					<p><a href="index.php">Search</a> > <a href="results.php">Results</a> > <?php echo $parkName ?></p>
				</div>
				<h1 id="header-text"><?php echo $parkName ?></h1>
				<a id="search-again" href="index.php">Search again?</a>
			</div>
			<div id="left-side">
				<div id=map-image></div
				<!-- overall rating -->
				<div id= "park-content">
					<h1><?php echo $ratingString ?></h1>
					<h2><?php echo $suburb ?></h2>
					<h3><?php echo $street ?></h3>
				</div>
			</div>
			
			<!-- Reviews -->
			<ul id=review>
				<li><h2>Reviews</h2></li>
				<li>
					<div id="leave-review">
						<h3>Leave a Review:</h3>
						<form id= "review-form" method="post">
							<input type="text" id="username" name="username" placeholder="Username" required/>
							<select id="stars" required/>
								<option value="" selected hidden>Select A Rating</option>
								<option value="1">&#9733;</option>
								<option value="2">&#9733;&#9733;</option>
								<option value="3">&#9733;&#9733;&#9733;</option>
								<option value="4">&#9733;&#9733;&#9733;&#9733;</option>
								<option value="5">&#9733;&#9733;&#9733;&#9733;&#9733;</option>
							</select><br>
							<textarea id="comment" name="comment" placeholder="Leave A Comment" required/></textarea><br>
							<input type="submit" value="Send" />
						</form>
					</div>
				</li><hr>
				<li>
					<div id= "user-information">
						<p class= "username">User Name</p>
						<p class= "rating">&#9733;&#9733;&#9733;&#9733;&#9734;</p>
						<p class= "Date">Date</p>
					</div>
					<div id="user-review">
						<p> This park was great</p>
					</div>
				</li>
				<li>
					<div id= "user-information">
						<p class= "username">User Name</p>
						<p class= "rating">&#9733;&#9733;&#9733;&#9733;&#9734;</p>
						<p class= "Date">Date</p>
					</div>
					<div id="user-review">
						<p> This park was great</p>
					</div>
				</li>
				<li>
					<div id= "user-information">
						<p class= "username">User Name</p>
						<p class= "rating">&#9733;&#9733;&#9733;&#9733;&#9734;</p>
						<p class= "Date">Date</p>
					</div>
					<div id="user-review">
						<p> This park was great</p>
					</div>
				</li>
				<li>
					<div id= "user-information">
						<p class= "username">User Name</p>
						<p class= "rating">&#9733;&#9733;&#9733;&#9733;&#9734;</p>
						<p class= "Date">Date</p>
					</div>
					<div id="user-review">
						<p> This park was great</p>
					</div>
				</li>
				<li>
					<div id= "user-information">
						<p class= "username">User Name</p>
						<p class= "rating">&#9733;&#9733;&#9733;&#9733;&#9734;</p>
						<p class= "Date">Date</p>
					</div>
					<div id="user-review">
						<p> This park was great</p>
					</div>
				</li>
				<li>
					<div id= "user-information">
						<p class= "username">User Name</p>
						<p class= "rating">&#9733;&#9733;&#9733;&#9733;&#9734;</p>
						<p class= "Date">Date</p>
					</div>
					<div id="user-review">
						<p> This park was great</p>
					</div>
				</li>
				<li>
					<div id= "user-information">
						<p class= "username">User Name</p>
						<p class= "rating">&#9733;&#9733;&#9733;&#9733;&#9734;</p>
						<p class= "Date">Date</p>
					</div>
					<div id="user-review">
						<p> This park was great</p>
					</div>
				</li>
			</ul>
		</div>
	</main>

	<!-- Footer -->
	<footer>
	</footer>
</body>
</html>