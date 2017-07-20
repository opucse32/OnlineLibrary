<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php
        $username =$_REQUEST["username"];
        global $connection;
	$safe_user = mysql_prep($username);
	$query  = "SELECT * ";
	$query .= "FROM user ";
	$query .= "WHERE uID = '$safe_user'";
	$user_set = mysqli_query($connection, $query);
        if(mysqli_num_rows($user_set)> 0)
	echo 1;
	else echo 0;

?>