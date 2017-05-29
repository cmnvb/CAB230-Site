<?php
require('connectToDB.php');
	
function validatePassword(){
	$checkPassword = $pdo ->prepare('SELECT Username, Password
		FROM members
		WHERE username = :username and
        password = SHA2(CONCAT(:password, salt), 0)');
	$checkPassword ->bindValue(':username', $_GET['username']);
	$checkPassword ->bindValue(':password', $_GET['password']);
	$checkPassword -> execute();
	
	//return $query->rowCount() > 0;

}
?>