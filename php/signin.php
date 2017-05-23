<!DOCTYPE html>
<html>
<head>
	<!-- Page Data -->
	<meta charset="utf-8" />
	<title>Account Signup</title>

	<!-- Styling -->
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<link rel="stylesheet" type="text/css" href="../css/signup.css">
	<link href="https://fonts.googleapis.com/css?family=Kaushan+Script%7COpen+Sans" rel="stylesheet">

	<!-- Scripts -->
	<script type="text/javascript" src="../js/greyTextFix.js"></script>
</head>

<body>
	<!-- Nav -->
	<?php include('navbar.php'); ?>

	<main>
		<div id="wrapper">
			<div id="crumb">
				<p><a href="index.php">Search</a> > Log In</p>
			</div>
			<div id="header">
				<h1 id="header-text">Log In To Your Account</h1></div>
			<form id="registration-form" action="index.php" method="post">
				<input type="text" name="username" placeholder="Username" required/><hr>
				<input type="text" name="password" placeholder="Insert Password" required/><hr>
				<input type="submit" value="Sign In" />
			</form>
		</div>
	</main>

	<!-- Footer -->
	<footer>
	</footer>
</body>
</html>