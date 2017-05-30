<?php require('connectToDB.php'); 
$username = $email = $children= $bday = $suburb = $password = "";
$usernameErr ="";

function validate($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
 if (empty($_POST["username"])) {
 $usernameErr = "Username is required";
} else {
 $username = validate($_POST["username"]);
}

  $email = validate($_POST["email"]);
  $children = validate($_POST["children"]);
  $bday = validate($_POST["bday"]);
  $suburb = validate($_POST["suburb"]);
  $password = validate($_POST["password"]);
  $salt = uniqid();
  try {
    $stmt =  $pdo ->prepare ('INSERT INTO members (Username, Email, NoOfChildren, Birthday, Suburb, Password, Salt)
           VALUES (:username, :email, :children, :bday, :suburb, SHA2(CONCAT(:password, :salt), 0), :salt)');
    $stmt ->bindParam(':username',$username);
    $stmt ->bindParam(':email',$email);
    $stmt ->bindParam(':children',$children);
    $stmt ->bindParam(':bday',$bday);
    $stmt ->bindParam(':suburb',$suburb);
    $stmt ->bindParam(':password',$password);
    $stmt ->bindParam(':salt', $salt);
    $stmt -> execute();
  
    echo ("<br> Account Creation Successful");
  }
  catch(PDOException $e) {
        //echo('<script language = "javascript">');
        echo('Please Try Again') //. $e->getMessage();
        //echo('</script>');
        
        //echo('<script language = "javascript">');
        //echo('alert(Please Try Again)'); //.$e->getMessage();
        //echo('</script>');
  }
}
$stmt = null;
?>