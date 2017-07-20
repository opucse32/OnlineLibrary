<?php
require_once('../public/config.php');
/*
$dbhost = "localhost";
$dbuser ="root";
$dbpass ="Melody@123";
$dbname ="library";
*/
$connection = mysqli_connect(dbhost, dbuser, dbpass, dbname);
if(mysqli_connect_errno()){
	die("Database connection failed: " .
		mysqli_connect_error() .
		" (" . mysqli_errno() . ")"
	);
}
?>
