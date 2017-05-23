<?php
$username = $email = $children= $bday = $suburb = $password = "";
//$usernameErr = $emailErr = $childrenErr = $bdayErr = $suburbErr = $passwordErr = $passwordConfirmErr ="";
//  if (empty($_POST["username"])) {
//    $usernameErr = "Username is required";
//  } else {
//    $username = validate($_POST["username"]);
//  }
//  
//  if(empty($_POST['children'])){
//    $childrenErr = "Number of Children is required";
//    } else {
//    $children = validate($_POST['children'])
//  }
//}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = validate($_POST["username"]);
  $email = validate($_POST["email"]);
  $children = validate($_POST["children"]);
  $bday = validate($_POST["bday"]);
  $suburb = validate($_POST["suburb"]);
  $password = validate($_POST["password"]);

function validate($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

//$sql = "INSERT INTO members (Username, Email, NoOfChildren, Birthday, Suburb, Password, Salt)
//        VALUES ('$username', '$email', '$children', '$bday', '$suburb', '$password')";
?>