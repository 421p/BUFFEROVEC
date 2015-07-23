<?php
	session_start();
	unset($_SESSION['user_going_crazy']);
	session_destroy();
	header("location:login.php");
?>