<?php require('connectToDB.php');

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