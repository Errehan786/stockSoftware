<?php // logout
	session_start();
	unset($_SESSION['id']);
	unset($_SESSION['userName']);
	header("Location:index.php");
	exit();
?>