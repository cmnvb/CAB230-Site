<?php require('connectToDB.php'); 
$username = $rating = $comment = "";

//$collectParkID = $pdo-> prepare("SELECT Name, Suburb, Street, AVG(COALESCE(Rating, 0)) AS Rating
//	FROM items LEFT JOIN reviews ON items.id = reviews.parkID
//	WHERE items.id = :parkID
//	GROUP BY items.id");
//$collectParkID -> bindValue(":ParkID", $_GET['id']);
//$ParkID = $collectParkID;

$date= date("d/m/y");

function validate($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = validate($_POST["username"]);
  $comment =validate($_POST["comment"]);

  try {
    $stmt =  $pdo ->prepare ('INSERT INTO reviews (UserID, DatePosted, Rating, Comment)
           VALUES (:UserID, :Date, :Rating, :Comment)');
    $stmt ->bindParam(':UserID',$username);
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