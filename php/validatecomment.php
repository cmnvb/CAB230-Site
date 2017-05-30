<?php require('connectToDB.php'); 
$comment = "";
$rating="0";
$parkID = $_GET['id'];

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
    $stmt =  $pdo ->prepare ('INSERT INTO reviews (Username, ParkID, DatePosted, Rating, Comment)
           VALUES (:Username, :ParkID, :Date, :Rating, :Comment)');
    $stmt ->bindParam(':Username', $_SESSION['username']);
    $stmt ->bindParam(':ParkID', $ParkID);
    $stmt ->bindParam(':Date', $date);
    $stmt ->bindParam(':Rating', $rating);
    $stmt ->bindParam(':Comment',$comment);
    $stmt -> execute();
  
    echo ("comment successful");
  }
  catch(PDOException $e) {
    // make sure to edit this once it works!!!!!!
    echo($rating) .$e->getMessage();
  }
}
$stmt = null;

?>