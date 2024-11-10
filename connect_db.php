<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gestion_de_vente";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if(!$conn) {
  die("connection failed: " .mysqli_connect_error());
}
// echo "connected succesfully";

?>
