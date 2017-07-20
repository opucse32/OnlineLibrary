
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/session.php"); ?>

<?php
	// v1: simple logout
	// session_start();
	$_SESSION["message"] = null;
	redirect_to("index.php");
?>
