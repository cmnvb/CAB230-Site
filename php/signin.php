<?php require('connectToDB.php');
	  require('validatePassword.php');

if (isset($_POST['signin']) && !empty($_POST['username']) 
   && !empty($_POST['password'])) {
	
   if (validatePassword($_POST['username'], $_POST['password'])){
	  echo 'You have entered valid username and password';
	  start_session();
	  $_SESSION['LoggedIn'] = true;

   }else {
	  echo 'Wrong username or password';
   }
}
?>
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
	
			<form id="registration-form" method="post" action = "signin.php">
				<input type="text" name="username" placeholder="Username" required/><hr>
				<input type="password" name="password" placeholder="Insert Password" required/><hr>
				<button type = "submit" name = "signin" value= "Signin">Sign in</button>
			</form>
		</div>
	</main>
</body>
</html>