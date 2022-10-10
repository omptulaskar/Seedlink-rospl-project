<?php 
	require('db.php'); 
	session_destroy();
	header('location:login.php');
	exit();
?>