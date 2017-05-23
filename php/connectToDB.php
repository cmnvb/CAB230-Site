<?php
$pdo = new PDO('mysql:host=localhost;dbname=DBNAME', 'USER', 'PASS');
$pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>