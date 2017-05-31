<?php
// Signout function for Brisbane parks. ends the session and redirects back to the index. 
session_start();
   unset($_SESSION["username"]);
   unset($_SESSION["signedin"]);
   
   echo 'successfully logged out';
   header("Location: http://{$_SERVER['HTTP_HOST']}/CAB230-Site/php");
?>