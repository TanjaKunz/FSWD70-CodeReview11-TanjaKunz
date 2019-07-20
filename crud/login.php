<?php 
ob_start();
session_start();

require_once 'actions/db_connect.php';

if(isset($_SESSION['user']) != ""){
  header('Location: home.php');
  exit;
}

// if(isset($_SESSION['user']) != "" || isset($_SESSION['admin']) != ""){
//   header('Location: home.php');
//   exit;
// }

$error = false;

if(isset($_POST['btn-login'])){

  //define variables and clean them of whitespaces, entities, tags
  $email = trim($_POST['email']);
  $email = strip_tags($email);
  $email = htmlspecialchars($email);

  $passw = trim($_POST['passw']);
  $passw = strip_tags($passw);
  $passw = htmlspecialchars($passw);

  //checking email
  if(empty($email)){
    $error = true;
    $emailErr = "Please enter your email address.";
  } elseif ( !filter_var($email, FILTER_VALIDATE_EMAIL)){
    $error = true;
    $emailErr = "Please enter valid email address.";
  }

  //checking password
  if(empty($passw)){
    $error = true;
    $passErr = "Please enter your password.";
  }


  //in case of no error, login procedure
  if(!$error){
    $password = hash('sha256', $passw);
    // $user = 'user';
    // $admin = 'admin';

    $query = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");
    $row = mysqli_fetch_array($query, MYSQLI_ASSOC);
    $count = mysqli_num_rows($query);

    if($count == 1 && $row['passw'] == $password){
      $_SESSION['user'] = $row['user_id'];
      header("Location: home.php");
    } else {
      $errMSG = "Incorrect Credentials, Please try again...";
    }
  }

  //alternative login procedure for different roles
  // if(!$error){
  //   $password = hash('sha256', $passw);
  //   $user = 'user';
  //   $admin = 'admin';

  //   $query = mysqli_query($conn, "SELECT user_id, name, email, passw, role FROM users WHERE email = '$email'");
  //   $row = mysqli_fetch_array($query, MYSQLI_ASSOC);
  //   $count = mysqli_num_rows($query);

  //   if($count == 1 && $row['passw'] == $password && $row['role'] == $user){
  //     $_SESSION['user'] = $row['user_id'];
  //     header("Location: home.php");
  //   } elseif($count == 1 && $row['passw'] == $password && $row['role'] == $admin) {
  //     $_SESSION['admin'] = $row['user_id'];
  //     header("Location: home.php");
  //   } else {
  //     $errMSG = "Incorrect Credentials, Please try again...";
  //   }
  // }
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
   <!----- Required meta tags ----->
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

   <!-- Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!----- jQuery, Popper.js, Bootstrap.js ----->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script> -->

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <!-------- Font Awesome -------->
    <script src="https://kit.fontawesome.com/649b84c193.js"></script>

    <!-------- Additional Stylesheets -------->
    <link rel="stylesheet" href="css/style.css">
    
   <title>Travellog</title>
</head>
<body>
   <div class="container-fluid mb-5">
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
                        <a class="nav-link" href="create.php">Create</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="update.php">Update</a>
                    </li>
            </div>
        </nav>
         
      </header><!-- /header -->
      
   

      <main role="main" class="container-fluid p-3">
        <div class="row" id="login">
         <form class="form-signin" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete= "off">
          <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>

          <?php if($errMSG){
          echo $errMSG;
          } ?>

          <label class="sr-only">Email address</label>
          <input type="email" name="email"  class="form-control" placeholder="Email address" value="<?= $email; ?>" autofocus>
          <span class="text-danger"><?php echo $emailErr; ?></span>

          <label class="sr-only">Password</label>
          <input type="password" name="passw" id="inputPassword" class="form-control" placeholder="Password">
          <span class="text-danger"><?php echo $passErr; ?></span>

          <button class="btn btn-lg btn-primary btn-block" type="submit" name="btn-login">Sign in</button>
          <hr>
          <a  href="register.php">Sign Up Here...</a>

          </form>
        </div>
        <br>     
      </main>

      <footer class="footer fixed-bottom py-3">
         <div class="container text-center">
            <span class="text-muted">Tanja Kunz - CodeFactory 2019</span>
         </div>
      </footer>
   </div>

   
</body>
</html>
<?php ob_end_flush() ?>