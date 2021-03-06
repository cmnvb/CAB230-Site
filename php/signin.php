<?php
//sign in page for Brisbane Parks. Connects to validate password to allow the user to make a comment
require('connectToDB.php');
require('validatePassword.php');
session_start();
$msg= '';
// if the user presses the signin button, and the username and password are filled the password is then validated to
//make sure the password is correct. It also increases security through using prepared statements.
//if there is any errors with the input, the user is provided with a "wrong username or password error
if (isset($_POST['signin']) && !empty($_POST['username']) 
	&& !empty($_POST['password'])) {

	if (validatePassword($_POST['username'], $_POST['password'])){
		$_SESSION['signedin'] = true;
		$_SESSION['timeout'] = time();
		$_SESSION['username'] = $_POST['username'];
		$msg ="Successfully Logged In";
		header("Location: http://{$_SERVER['HTTP_HOST']}/CAB230-Site/php/");
		exit();
	}else {
		$msg ='Wrong username or password';
	}
}?>
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
	<script type="text/javascript" src="../js/selectGreyPlaceholder.js"></script>
</head>

<body>
	<!-- Nav -->
	<?php include('navbar.php'); ?>

	<main>
		<div id="wrapper">
			<div id="crumb">
				<p><a href="index.php">Search</a> > Log In</p>
			</div>
			<form id="registration-form" method="post" action = "signin.php">
				<h1 id="header-text">Log In To Your Account</h1>
				
				<?php if (isset($_POST['username'])){
							$prefill = htmlspecialchars($_POST['username']); //prefills the input so user can review and retry it. 
						} else {
							$prefill = "";
						}
						echo '<input type="text" name="username" placeholder="Username" value="' . $prefill . '" required/>';
				?>
				<input type="password" name="password" placeholder="Insert Password" required/>
				<button type = "submit" name = "signin" value= "Signin">Sign in</button>
			</form>
			<div id= "return-submit">
			<?php echo $msg; ?>
			</div>
		</div>
	</main>
	<?php include('footer.php'); ?>
</body>
</html>