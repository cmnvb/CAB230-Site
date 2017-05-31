<!--The navbar. if user is signed in they see their username and a logout button. if signed out they are given the option to sign in or register.-->
<nav>
	<a id="home" href="index.php">Brisbane Parks</a>
	<?php
		if (isset($_SESSION['username'])){
			echo '<a class="nav-element">', $_SESSION['username'], '</a>';
			echo '<a class="nav-element" href="signout.php">Log Out</a>';
		}else{
			echo '<a class="nav-element" href="signup.php">Sign up</a>';
			echo '<a class="nav-element" href="signin.php">Log in</a>';
		}
	?>
</nav>