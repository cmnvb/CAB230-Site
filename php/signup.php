<?php require('connectToDB.php');
	session_start();
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
		<!-- Nav-->
		<?php include('navbar.php'); ?>
	
		<main>
			<div id="wrapper">
				<div id="crumb">
					<p><a href="index.php">Search</a> > Create An Account</p>
					<form id="registration-form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
						<h1 id="header-text">Create An Account</h1>
						<input type="text" name="username" placeholder="Username" required/>
					
						<input type="email" name="email" placeholder="Email Address" required/>
						
						<input type="number" name="children" placeholder="Number of Children" min="0" required/>
						
						<input id="DOB" type="date" name="bday" placeholder="Date of Birth dd/mm/yy" onchange="this.style.color = 'black'" required/>
						
						<select id="suburb" name="suburb" required>
						<option value="" selected hidden>Select a suburb</option>
						<?php
						$suburbSearch = $pdo->query('SELECT DISTINCT Suburb FROM items');
						foreach ($suburbSearch as $row) {
							echo "<option value=" . $row['Suburb'] . ">" . $row['Suburb'] . "</option>";
						}
						?>
						</select>
						
						<input type="password" name="password" placeholder="Insert Password" title="Password must be contain at least 4 characters and include a capital letter" pattern="(?=.*[a-z])(?=.*[A-Z]).{4,}" onchange="form.passwordConfirm.pattern = this.value;" required/>
						
						<input type="password" name="passwordConfirm" placeholder="Confirm Password" title="Must match entered password" pattern="(?=.*[a-z])(?=.*[A-Z]).{4,}" required/>
						<br>
						
						<button type = "submit" name = "createaccount" value= "CreateAccount" id= "submit">Create Account</button>
						<?php include('validatesignupform.php');?>
					</form>
				</div>
			</div>
		</main>
	</body>
	<?php include('footer.php'); ?>
</html>