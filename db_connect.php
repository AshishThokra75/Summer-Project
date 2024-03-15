<?php 	

$localhost = "localhost";
$username = "root";
$password = "";
$dbname = "apagros";
$farm_url = "http://localhost/AP-AGRO/";
// db connection
$connect = new mysqli($localhost, $username, $password, $dbname);
// check connection
if($connect->connect_error) {
  die("Connection Failed : " . $connect->connect_error);
} else {
  // echo "Successfully connected..";
}

?>