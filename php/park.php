<?php require('connectToDB.php');
session_start();
$parkFetch = $pdo -> prepare("SELECT Name, Suburb, Street, ROUND(AVG(COALESCE(Rating, 0))) AS Rating, Latitude, Longitude
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
	$lat = $row['Latitude'];
	$lon = $row['Longitude'];
}
?>
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

	<!-- Scripts -->
	<script type="text/javascript" src="../js/selectGreyPlaceholder.js"></script>
</head>

<body>
	<!-- Nav -->
	<?php include('navbar.php'); ?>

	<main>
		<div id="wrapper">
			<div id="header">
				<div id="crumb">
					<p><a href="index.php">Search</a> > <a>Results</a> > <?php echo $parkName ?></p>
				</div>
				<h1 id="header-text"><?php echo $parkName ?></h1>
				<a id="search-again" href="index.php">Search again?</a>
			</div>
			<div id="left-side">
				<div id = "map">
				<script>
				/* Function for adding park marker */
				function initMap() {
					var bounds = new google.maps.LatLngBounds();
					var parkMap = new google.maps.Map(document.getElementById('map'), {
						zoom: 1
					});

					// Add marker for park
					var parkInfo = new google.maps.InfoWindow({
						<?php echo "content: '$parkName'" ?>
					});

					var markerObject = new google.maps.Marker({
						<?php echo "position: new google.maps.LatLng(parseFloat($lat), parseFloat($lon))," ?>
						map: parkMap,
						<?php "title: '$parkName'," ?>
						infowindow: parkInfo
					});

					// Add click listener to display info window
					google.maps.event.addListener(markerObject, 'click', function() {
							this.infowindow.open(parkMap, this);
					});

					bounds.extend(markerObject.position);

					parkMap.fitBounds(bounds);
				}
				</script>
				<script async defer
				src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBp8B74RCtcjM6j6sfn3JBF8kvBlhsXJ7Y&callback=initMap&sensor=false">
				</script>
				</div>

				<!-- overall rating -->
				<div id= "park-content">
					<h1><?php echo $ratingString ?></h1>
					<h2><?php echo $suburb ?></h2>
					<h3><?php echo $street ?></h3>
				</div>
			</div>
			
			<!-- Reviews -->
				<div id= "right-side">
				<h2>Reviews</h2>
				<ul id=review>
			
				<?php
				$commentSearch = $pdo->prepare('SELECT * FROM reviews WHERE parkID = :parkID');
				$commentSearch ->bindValue(":parkID", $_GET['id']);
				$commentSearch ->execute();

				foreach ($commentSearch as $row) {
					$ratingString = str_repeat("&#9733;", $row["Rating"]);
					$ratingString .= str_repeat("&#9734;", 5 - $row["Rating"]);

				echo '
				<li itemprop="review" itemscope itemtype="http://schema.org/Review">
					<span itemprop="itemReviewed" itemscope itemtype="http://schema.org/Place">
						<span itemprop="name" content="' . $parkName .'"/></span>
					</span>
					<div id= "user-information">
						<p itemprop="author">' . $row["Username"] . '</p>
						<span itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating">
							<p><span itemprop="ratingValue" content=' . $row["Rating"] . '></span>' . $ratingString . '</p>
						</span>
						<p><meta itemprop="datePublished" content="' . date('Y-m-d',strtotime($row["DatePosted"])) . '"/>' . $row["DatePosted"] . '</p>
					</div>
					<div id="user-review">
						<p itemprop="reviewBody">' . $row["Comment"] . '</p>
					</div>
				</li>';
				}
				?>

				<hr>
				
				<?php include('validatecomment.php');
				if (isset($_SESSION['signedin'])){
					echo '<div id="leave-review">
						<form id= "review-form" method="post" action="'. htmlspecialchars($_SERVER['PHP_SELF']) . "?id=" . $_GET['id'] . '"/>
							<h3>Leave a Review:</h3>
							<select id="rating" name="rating" required/>
								<option selected hidden>Select A Rating</option>
								<option value="0">&#9734;&#9734;&#9734;&#9734;&#9734;</option>
								<option value="1">&#9733;&#9734;&#9734;&#9734;&#9734;</option>
								<option value="2">&#9733;&#9733;&#9734;&#9734;&#9734;</option>
								<option value="3">&#9733;&#9733;&#9733;&#9734;&#9734;</option>
								<option value="4">&#9733;&#9733;&#9733;&#9733;&#9734;</option>
								<option value="5">&#9733;&#9733;&#9733;&#9733;&#9733;</option>
							</select><br>
							<textarea id="comment" name="comment" placeholder="Leave A Comment" required/></textarea><br>
							<button type = "submit" name = "leavereview" value= "leavereview">Submit Review</button>
						</form>
					</div>';
				}else{
					echo ('To Leave A Review, Please Login');
				}
					?>
				
				<hr>
			
				<ul id=review>
			
				<?php
				$commentSearch = $pdo->prepare('SELECT * FROM reviews WHERE parkID = :parkID');
				$commentSearch ->bindValue(":parkID", $_GET['id']);
				$commentSearch ->execute();

				foreach ($commentSearch as $row) {
					$ratingString = str_repeat("&#9733;", $row["Rating"]);
					$ratingString .= str_repeat("&#9734;", 5 - $row["Rating"]);
					
				echo '<li itemprop="review" itemscope itemtype="http://schema.org/Review">
						<div id= "user-information">
							<p itemprop="author">' . $row["Username"] . '</p>
							<p><span itemprop="reviewRating" content="' . $row["Rating"] . '" />' . $ratingString . '</p>
							<p><meta itemprop="datePublished" content="' . date('Y-m-d',strtotime($row["DatePosted"])) . '"' . $row["DatePosted"] . '</p>
						</div>
						<div id="user-review">
							<p itemprop="reviewBody">' . $row["Comment"] . '</p>
						</div>
					</li>';
				if ($commentSearch -> rowCount() == 0) {
					echo "<h3>No results found, please search again.</h3>";
				}
				}
				?>
			</ul>
			</div>
		</div>
	</main>
</body>
<?php include('footer.php'); ?>
</html>