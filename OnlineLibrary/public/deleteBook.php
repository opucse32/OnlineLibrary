<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/session.php"); ?>
<?php

    $isbn =$_REQUEST["isbn"];
    global $connection;
    $query  = "SELECT * ";
    $query .= "FROM checkout ";
    $query .= "WHERE isbn = '$isbn'";
    $checkout_set = mysqli_query($connection, $query);
        if(mysqli_num_rows($checkout_set)> 0){
	    $_SESSION["delete"] = "The book is being used by a user and cannot be deleted.";
            redirect_to("adminBooks.php");
        }    
        else{
                $query  = "DELETE ";
                $query .= "FROM book ";
                $query .= "WHERE isbn = '$isbn'";
                mysqli_query($connection, $query);
                $_SESSION["delete"] = "The book is deleted from library.";
                redirect_to("adminBooks.php");
        }

    
?>