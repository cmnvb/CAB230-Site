<?php
$username = $email = $children= $bday = $suburb = $password = $passwordConfirm = "";
$usernameErr = $emailErr = $childrenErr = $bdayErr = $suburbErr = $passwordErr = $passwordConfirmErr ="";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["username"])) {
    $usernameErr = "Username is required";
  } else {
    $username = validate($_POST["name"]);
  }
  
  if(empty($_POST['children'])){
    $childrenErr = "Number of Children is required";
    } else {
    $children = validate($_POST['children'])
  }
}

function validate($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>