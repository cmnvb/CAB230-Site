<?php require('connectToDB.php');
	  require('validatePassword.php');
	  $msg= '';

if (isset($_POST['signin']) && !empty($_POST['username']) 
   && !empty($_POST['password'])) {
	
   if (validatePassword($_POST['username'], $_POST['password'])){
	$_SESSION['valid'] = true;
	$_SESSION['timeout'] = time();
	$_SESSION['username'] = 'username';
	$msg ="Successfully Logged In";
	header("Location: http://localhost:1234/CAB230-Site/php/index.php");
	exit();

   }else {
	  $msg ='Wrong username or password';
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
			<form id="registration-form" method="post" action = "signin.php">
				<h1 id="header-text">Log In To Your Account</h1>
				<input type="text" name="username" placeholder="Username" required/>
				<input type="password" name="password" placeholder="Insert Password" required/>
				<button type = "submit" name = "signin" value= "Signin">Sign in</button>
			</form>
			<?php echo $msg; ?>
		</div>
	</main>
</body>
</html>