<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php
        $isbn =$_REQUEST["isbn"];
        global $connection;
	$safe_isbn = mysql_prep($isbn);
	$query  = "SELECT * ";
	$query .= "FROM book ";
	$query .= "WHERE isbn = '$safe_isbn'";
	$book_set = mysqli_query($connection, $query);
        if(mysqli_num_rows($book_set)> 0)
	echo 1;
	else echo 0;

?>