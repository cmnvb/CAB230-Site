<?php require('connectToDB.php'); 
$username = $email = $children= $bday = $suburb = $password = "";
$usernameErr = $emailErr =$childrenErr = $bdayErr = $passwordErr = "";

function validate($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function processSubmit(){
  global $pdo;
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
  //  $searchUsernames = $pdo->prepare('SELECT username FROM members');
  //  $searchUsernames ->execute();
    
 //   if (empty($_POST["username"])) {
 //     $usernameErr = "Username is required. ";
 //   }elseif ($searchUsernames->rowCount() > 0) {
 //     $usernameErr = "Username Taken, Please choose another. ";
 ///   }else {
      $username = validate($_POST["username"]);
 //   }
    
    if(empty($_POST["email"])) {
      $emailErr= "Email is required. ";
    }elseif (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) === false) {
      $emailErr = "Email must be valid";
    } else {
      $email = validate($_POST["email"]);
    }
    
    if(empty($_POST["children"])) {
      $childrenErr= "Number of children (can be 0) is required. ";
    }if (filter_var($_POST["children"], FILTER_VALIDATE_INT) === false) {
      $childrenErr = "Number of children must be a number";
    } else {
      $children = validate($_POST["children"]);
    }
    
    if(empty($_POST["bday"])) {
      $bdayErr= "Birthday is required. ";
    } else {
      $bday = validate($_POST["bday"]);
    }
    
  //  if(empty($_POST["password"])) {
    //  $passwordErr= "Password Requiredd. ";
    //}if (!preg_match("(?=.*[a-z])(?=.*[A-Z]).{4,}", $_POST["password"])) {
    //  $passwordErr = "Password invalid. Must be at least 4 characters long and contain a capital letter.";
   // } else {
      $password = validate($_POST["password"]);
    //}
    
    $suburb = validate($_POST["suburb"]);
    $salt = uniqid();
    
    try {
      $stmt =  $pdo ->prepare ('INSERT INTO members (Username, Email, NoOfChildren, Birthday, Suburb, Password, Salt)
            VALUES (:username, :email, :children, :bday, :suburb, SHA2(CONCAT(:password, :salt), 0), :salt)');
      $stmt ->bindParam(':username', $username);
      $stmt ->bindParam(':email', $email);
      $stmt ->bindParam(':children', $children);
      $stmt ->bindParam(':bday', $bday);
      $stmt ->bindParam(':suburb', $suburb);
      $stmt ->bindParam(':password', $password);
      $stmt ->bindParam(':salt', $salt);
      $stmt -> execute();
      
      echo ("<br> Account Creation Successful");
    }
    catch(PDOException $e) {
      echo ($usernameErr . $emailErr . $childrenErr . $bdayErr . $passwordErr ) . $e->getMessage();
    }
  }
}
$stmt = null;
?>