<?php require('connectToDB.php'); 
$comment = "";

$date= date("y/m/d");
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
    $stmt ->bindParam(':ParkID', $_GET['id']);
    $stmt ->bindParam(':Date', $date);
    $stmt ->bindParam(':Rating', $_POST['rating']);
    $stmt ->bindParam(':Comment',$comment);
    $stmt -> execute();

  }
  catch(PDOException $e) {
    echo('<script language = "javascript">');
    echo('alert("Comment unsuccessful, please try again.")') .$e->getMessage();
    echo('</script>');
  }
}
$stmt = null;

?>