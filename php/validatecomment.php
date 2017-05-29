<?php require('connectToDB.php'); 
$username = $rating = $comment = "";

$date= date("d/m/y");
//ger userID From the session
function validate($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $comment =validate($_POST["comment"]);

  try {
    $stmt =  $pdo ->prepare ('INSERT INTO reviews (UserID, DatePosted, Rating, Comment)
           VALUES (:UserID, :Date, :Rating, :Comment)');
    //$stmt ->bindParam(':ParkID', $ParkID);
    $stmt ->bindParam(':Date', $date);
    $stmt ->bindParam(':Rating', $rating);
    $stmt ->bindParam(':Comment',$comment);
    $stmt -> execute();
  
    echo ("comment successful");
  }
  catch(PDOException $e) {
    echo($rating) .$e->getMessage();
  }
}
$stmt = null;

?>