<!-- Nav -->
<nav>
	<a id="home" href="index.php">Brisbane Parks</a>
	<?php
		if (isset($_SESSION['signedin'])){
			echo '<a class="nav-element">', $_SESSION['username'], '</a>';
			echo '<a class="nav-element" href="signout.php">Log Out</a>';
		}else{
			echo '<a class="nav-element" href="signup.php">Sign up</a>';
			echo '<a class="nav-element" href="signin.php">Log in</a>';
		}
	?>
</nav>