<?php
require_once 'actions/db_connect.php';

$error = false;

if (isset($_POST['btn-signup']) ) { 

$name = trim($_POST['name']);
$name = strip_tags($name);
$name = htmlspecialchars($name);

$email = trim($_POST['email']);
$email = strip_tags($email);
$email = htmlspecialchars($email);

$passw = trim($_POST['passw']);
$passw = strip_tags($passw);
$passw = htmlspecialchars($passw);

	if (empty($name)) {
		$error = true ;
		$nameErr = "Please enter your full name.";
	} else if (strlen($name) < 3) {
		$error = true;
		$nameErr = "Name must have at least 3 characters.";
	} else if (!preg_match("/^[a-zA-Z ]+$/",$name)) {
		$error = true ;
		$nameErr = "Name must contain alphabets and space.";
	}


	if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
		$error = true;
		$emailErr = "Please enter valid email address." ;
	} else {
		$query = "SELECT email FROM users WHERE email='$email'";
		$result = mysqli_query($conn, $query);
		$count = mysqli_num_rows($result);
		if($count!=0){
			$error = true;
			$emailErr = "Provided Email is already in use.";
		}
	}
 
	if (empty($passw)){
		$error = true;
		$passErr = "Please enter password.";
	} else if(strlen($passw) < 6) {
		$error = true;
		$passErr = "Password must have atleast 6 characters." ;
	}

	$password = hash('sha256' , $passw);

 
	if( !$error ) {  
		$query = "INSERT INTO users(name,email,passw) VALUES('$name','$email','$password')";
		$res = mysqli_query($conn, $query);

		if ($res) {
			$errTyp = "success";
			$errMSG = "Successfully registered, you may login now";
			unset($name);
			unset($email);
			unset($passw);
		} else  {
			$errTyp = "danger";
			$errMSG = "Something went wrong, try again later..." ;
	  	}  
	}
}
?>