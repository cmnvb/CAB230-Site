<?php
//the function that validates the password for the sign in page. Gets the username and the password, takes out the salt. then uses
//bindValue for added security. If a row match is greater than 1, the user is able to sign in.  
require('connectToDB.php');

function validatePassword(){
	global $pdo;
	$checkPassword = $pdo ->prepare('SELECT Username, Password
		FROM members
		WHERE username = :username and
		password = SHA2(CONCAT(:password, salt), 0)');

	$checkPassword ->bindValue(':username', $_POST['username']);
	$checkPassword ->bindValue(':password', $_POST['password']);

	$checkPassword -> execute();

	return $checkPassword->rowCount() > 0;
}
?>