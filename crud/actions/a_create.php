<?php
require_once 'db_connect.php';

if ($_POST) { 

$name = trim($_POST['name']);
$name = strip_tags($name);
$name = htmlspecialchars($name);

$email = trim($_POST['email']);
$email = strip_tags($email);
$email = htmlspecialchars($email);

$passw = trim($_POST['passw']);
$passw = strip_tags($passw);
$passw = htmlspecialchars($passw);

$role = trim($_POST['role']);

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


	if (!filter_var($email,FILTER_VALIDATE_EMAIL) ) {
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
		$query = "INSERT INTO users(name,email,passw,role) VALUES('$name','$email','$password','$role')";
		$res = mysqli_query($conn, $query);

		if ($res) {
			$errTyp = "success";
			$errMSG = "The User was successfully added.";
			unset($name);
			unset($email);
			unset($passw);
			echo "<p>New Record Successfully Created</p>" ;
       		echo "<a href='../usersAdmin.php'><button type='button'>Back</button></a>";
        	echo "<a href='../homeAdmin.php'><button type='button'>Home</button></a>";

		} else  {
			$errTyp = "danger";
			$errMSG = "Something went wrong, try again later..." ;
	  	}  
	}
}


?>