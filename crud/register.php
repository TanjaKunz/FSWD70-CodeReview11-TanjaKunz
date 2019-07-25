<?php
ob_start();
session_start();

include_once 'actions/db_connect.php';

if(isset($_SESSION['user'])!="" ){
 header("Location: home.php" );
}

// if(isset($_SESSION['user'])!="" || isset($_SESSION['admin'])!=""){
//  header("Location: home.php" );
// }

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
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Register form</title>

	<!-- Bootstrap -->
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

	<!-------- Font Awesome -------->
  	<script src="https://kit.fontawesome.com/649b84c193.js"></script>

  	<!-- Custom Stylesheet -->
  	<link rel="stylesheet" href="css/style.css">

  	
</head>
<body>	
  	<header class="fixed-top">
     	<div class="col-12 d-flex" id="header">
        	<p class="h1 align-self-center text-light"><i class="far fa-map pr-3"></i>Travelmatic</p>            
     	</div>


     	<nav class="navbar navbar-expand-md">
        	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            	<span class="navbar-toggler-icon"></span>
        	</button>
        	<div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="home.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="places.php">Places</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="concert.php">Concert</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="restaurants.php">Restaurants</a>
                    </li>
                    <li>
                      <a class="nav-link" href="actions/a_logout.php?logout">Logout</a>
                    </li>
                </ul>
        	</div>
    	</nav>        
	</header>
	
	<main role="main" class="container-fluid p-3">
        <div class="row" id="register">
			<form class="form-signin" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off" >
				<h1 class="h3 mb-3 font-weight-normal">Please register</h1>
				<?php
					if(isset($errMSG)){
						echo '<div class="alert alert-primary">'.$errMSG.'</div>';
					}
				?>		

				<label>Name</label>
				<input type="text" name="name"  class="form-control" placeholder="Enter Name" maxlength="50" value="<?php echo $name; ?>" autofocus>
				<span class="text-danger"><?php echo $nameErr; ?></span>

				<label>Email</label>
				<input type="email" name="email" class="form-control" placeholder="Enter Your Email"  maxlength="40" value="<?php echo $email; ?>" autofocus>
				<span class="text-danger"><?php echo $emailErr; ?></span>

				<label>Password</label>
				<input type="password" name="passw" id="inputPassword" class="form-control" placeholder="Enter Password" maxlength="15">
				<span class="text-danger"><?php echo $passErr; ?></span>	    
			          
			    <button type="submit" class="btn btn-block btn-primary" name="btn-signup">Sign Up</button >
			    <hr/>
			  
			    <a href="login.php">Sign in Here...</a>
		   	</form>
		</div>
		<br>
		
	</main>
	
	<footer class="footer fixed-bottom py-3">
         <div class="container text-center">
            <span class="text-muted">Tanja Kunz - CodeFactory 2019</span>
         </div>
      </footer>
</body>
</html>
<?php  ob_end_flush(); ?>