<?php
session_start();
   unset($_SESSION["username"]);
   unset($_SESSION["signedin"]);
   
   echo 'successfully logged out';
   header("Location: http://localhost:1234/CAB230-Site/php/index.php");
?>