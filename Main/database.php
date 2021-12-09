<?php

$host = "localhost";
$username = "111117";
$password = "saltaire";
$dbname = "111117";
$sel_area=$_SESSION['selectedRegion'];

$dsn = "mysql:host=$host;dbname=$dbname"; 
// get all users
$sql = "SELECT * FROM sma WHERE Region='$sel_area'";
   
try{
  $pdo = new PDO($dsn, $username, $password);
  $stmt = $pdo->query($sql);
   
  if($stmt === false){
   die("Error");
  }
   
}catch (PDOException $e){
  echo $e->getMessage();
}

?>
