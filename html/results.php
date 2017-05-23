<!DOCTYPE html>
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
	<nav>
		<a id="home" href="index.html">Brisbane Parks</a>
		<a class="nav-element" href="signup.html">Sign up</a>
		<a class="nav-element" href="signin.html">Log in</a>
		<a class="nav-element" href="#">What's On</a>
		<a class="nav-element" href="#">About</a>
	</nav>

	<main>
		<div id="wrapper">
			<!-- Results Header -->
			<div id="header">
				<div id="crumb">
					<p><a href="index.html">Search</a> > Results page</p>
				</div>
				<h1 id="header-text">Top Results</h1>
				<a id="search-again" href="index.html">Search again?</a>
			</div>

			<!-- Results List-->
			<div id= "results">
				<ul id="results">
					<li>
						<div class="details">
							<a href="park.html"><p class="park-name">Robertson Park</p></a>
							<p class="location">St Lucia</p>
							<p class="rating">&#9733;&#9733;&#9733;&#9734;&#9734;</p>
						</div>
					</li>
					<li>
						<div class="details">
							<a href="park.html"><p class="park-name">New Farm Park</p></a>
							<p class="location">New Farm</p>
							<p class="rating">&#9734;</p>
						</div>
					</li>
				</ul>
			</div>
			
			
			<!-- Map -->
			<div id="map"></div>
		</div>
	</main>

	<!-- Footer -->
	<footer>
	</footer>
</body>
</html>