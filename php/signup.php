<?php require('connectToDB.php');
session_start();?>
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
	<!-- Nav-->
	<?php include('navbar.php'); ?>

	<main>
		<div id="wrapper">
			<div id="crumb">
				<p><a href="index.php">Search</a> > Create An Account</p>
				<form id="registration-form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
					<h1 id="header-text">Create An Account</h1>
					<?php
						if (isset($_POST['username'])){
							$prefill = htmlspecialchars($_POST['username']);
						} else {
							$prefill = "";
						}
						echo '<input type="text" name="username" placeholder="Username" value="' . $prefill . '" required/>';

						if (isset($_POST['email'])){
							$prefill = htmlspecialchars($_POST['email']);
						} else {
							$prefill = "";
						}
						echo '<input type="email" name="email" placeholder="Email Address" value="' . $prefill . '" required/>';

						if (isset($_POST['children'])){
							$prefill = htmlspecialchars($_POST['children']);
						} else {
							$prefill = "";
						}
						echo '<input type="number" name="children" placeholder="Number of Children" min="0" value="' . $prefill . '" required/>';

						if (isset($_POST['bday'])){
							$prefill = htmlspecialchars($_POST['bday']);
						} else {
							$prefill = "";
						}
						echo '<input id="DOB" type="date" name="bday" onchange="this.style.color=\'black\'" value="' . $prefill . '" required/>';

						if (isset($_POST['suburb'])){
							$prefill = htmlspecialchars($_POST['suburb']);
						} else {
							$prefill = "";
						}
						echo '<select id="suburb" name="suburb" required/>
							  <option value="' . $prefill . '" selected hidden>Select a suburb</option>';
						$suburbSearch = $pdo->query('SELECT DISTINCT Suburb FROM items');
						foreach ($suburbSearch as $row) {
							  echo "<option value='" . $row['Suburb'] . "'>" . $row['Suburb'] . "</option>";
						}
						echo '</select>'
					?>
					<input type="password" name="password" placeholder="Insert Password" title="Password must be contain at least 4 characters and include a capital letter" pattern="(?=.*[a-z])(?=.*[A-Z]).{4,}" onchange="form.passwordConfirm.pattern = this.value;" required/>
					<input type="password" name="passwordConfirm" placeholder="Confirm Password" title="Must match entered password" pattern="(?=.*[a-z])(?=.*[A-Z]).{4,}" required/>
					<br>
					<button type = "submit" name = "createaccount" value= "CreateAccount" id= "submit">Create Account</button>
					<?php include('validateSignUpForm.php');?>
				</form>
			</div>
		</div>
	</main>
	<?php include('footer.php'); ?>
</body>
</html>