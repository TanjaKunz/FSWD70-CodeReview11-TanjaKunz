<?php
session_start();

	if (!isset($_SESSION['user'])) {
		header( "Location: login.php");
	} else if(isset($_SESSION['user'])!="") {
		header("Location: ../home.php");
	// } else if(isset($_SESSION['admin']) !=""){
	// 	header("Loacation: ../homeAdmin.php")
	}

	if  (isset($_GET['logout'])) {
		 unset($_SESSION['user']);
		 session_unset();
		 session_destroy();
		 header("Location: ../login.php");
		 exit;
	}
?>