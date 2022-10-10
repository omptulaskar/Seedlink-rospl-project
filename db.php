<?php
define("SERVER",'localhost');
define("USERNAME",'root');
define("PASSWORD",'');
define("DATABASE",'seedlink');
$mysqli = new mysqli(SERVER, USERNAME, PASSWORD, DATABASE);
if ($mysqli->connect_errno)
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

function isLoggedin(){
	if(!isset($_SESSION['id'])){
		header('location:login.php');
		exit();
	}
}
?>