<?php require('connectToDB.php'); 
$username = $email = $children= $bday = $suburb = $password = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = validate($_POST["username"]);
  $email = validate($_POST["email"]);
  $children = validate($_POST["children"]);
  $bday = validate($_POST["bday"]);
  $suburb = validate($_POST["suburb"]);
  $password = validate($_POST["password"]);
  sendInfo();


function validate($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function sendInfo(){
$stmt =  $pdo ->prepare ('INSERT INTO members (Username, Email, NoOfChildren, Birthday, Suburb, Password, Salt)
       VALUES (:username, :email, :children, :bday, :suburb, :password)');
$stmt ->bindParam(':username',$username);
$stmt ->bindParam(':email',$email);
$stmt ->bindParam(':children',$children);
$stmt ->bindParam(':bday',$bday);
$stmt ->bindParam(':suburb',$suburb);
$stmt ->bindParam(':password',$password);
$stmt -> execute();
}
?>