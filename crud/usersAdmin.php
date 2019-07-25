<?php
ob_start();
session_start();

require_once 'actions/db_connect.php';

// if(!isset($_SESSION['user']) || !isset($_SESSION['admin']){
// 	header('Location: login.php');
// 	exit;
// } elseif (isset($_SESSION['user'])) {
//   header('Location: user.php');
// }


$query = mysqli_query($conn, "SELECT * FROM users WHERE user_id = ".$_SESSION['user']);
$userRow = mysqli_fetch_array($query, MYSQLI_ASSOC);

if ($_GET['id']) {
   $id = $_GET['id'];

   $sql = "SELECT * FROM users WHERE user_id = {$id}" ;
   $result = $conn->query($sql);
   $data = $result->fetch_assoc();

   $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Books</title>

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
            </div>
        </nav>
         
      </header><!-- /header -->
	<span id="message"></span>

	<main class="container-fluid my-5" id="main">
    <div class="row d-flex justify-content-between">
      <div class="col-1 h4 d-inline">Users</div>
    </div>    

    <table class="table mt-3 pt-5">     
      <thead class="thead-dark">
        <tr>
          <th>User ID</th>
          <th>Name</th>
          <th>Email</th>
          <th>Password</th>
          <th>Role</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
      	<tr>
      		<form action='actions/a_create.php' method="post" class="needs-validation" id="addUser">
      			<td>
      				<input type="text" class="form-control" disabled name="user_id" placeholder="auto" required id="user_id">
      			</td>
            <td>
              <input type="text" class="form-control" name="name" placeholder="Name" required id="name">
              <div class="invalid-feedback">Please enter the name.</div>
            </td>
      			<td>
      				<input type="text" class="form-control" name="email" placeholder="Email" required id="email">
      				<div class="invalid-feedback">Please enter an Email.</div>
      			</td>
            <td>
              <input type="password" name="passw" id="inputPassword" class="form-control" placeholder="Enter Password" maxlength="15">
              <div class="invalid-feedback">Please enter a password.</div>
            </td>
      			<td>
      				<input type="text" class="form-control" name="role" placeholder="Role" required id="role">
      				<div class="invalid-feedback">Please enter the role.</div>
      			</td>
      			<td>
      				<button type="submit" class="btn btn-secondary" id="submit">Add User</button>
      			</td>
      		</form>
      	</tr>

        <?php
           $sql = "SELECT * FROM users";
           $result = $conn->query($sql);

            if($result->num_rows > 0) {
              while($row = $result->fetch_assoc()) {
                 echo "<tr>
                      <td name='".$row['user_id']."'>" .$row['user_id']."</td>
                      <td>" .$row['name']."</td>
                      <td>" .$row['email']."</td>
                      <td>*****</td>
                      <td>" .$row['role']."</td>                      
                      <td>
                      	<a href='updateUser.php?id=" .$row['user_id']."'><button type= 'button' class='btn btn-outline-secondary edit'><i class='fas fa-pencil-alt'></i></button></a>
                        <a href='deleteUser.php?id=" .$row['user_id']."'><button type='button' class='btn btn-secondary delete'><i class='fas fa-times'></i></button></a>                        
                      </td>
                    </tr>" ;
              }
          } else {
               echo  "<tr><td colspan='5'><center>No Data Avaliable</center></td></tr>";
          }
          ?>     
        
      </tbody>
    </table>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js" ></script>
	<script src="actions/a_create.js"  type="text/javascript"></script>
</body>
</html>
<?php  ob_end_flush(); ?>


