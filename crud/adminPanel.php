<?php
ob_start();
session_start();

require_once 'actions/db_connect.php';

if(!isset($_SESSION['user']) && !isset($_SESSION['admin'])) {
 header("Location: login.php");
 exit;
}

if(isset($_SESSION['user'])){
  header("Location: home.php");
  exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Travelmatic</title>

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
                        <a class="nav-link" href="event.php">Event</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="restaurant.php">Restaurants</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="usersAdmin.php">Update User</a>
                    </li>
                    <li>
                      <a class="nav-link" href="actions/a_logout.php?logout">Logout</a>
                    </li>
            </div>
        </nav>
         
      </header><!-- /header -->
	<span id="message"></span>

	<main class="container-fluid my-5" id="mainLoc">
    <div class="row d-flex justify-content-between">
      <div class="col-1 h4 d-inline">Locations</div>
    </div>    

    <table class="table mt-3 pt-5">     
      <thead class="thead-dark">
        <tr>
          <th scope="col-1">Location ID</th>
          <th scope="col-2">Location Name</th>
          <th scope="col-3">Description</th>
          <th scope="col-2">Image</th>
          <th scope="col-1">Type</th>
          <th scope="col-1">Address</th>
          <th scope="col-2"></th>
        </tr>
      </thead>
      <tbody>
      	<tr>
      		<form action='actions/a_createLoc.php' method="post" class="needs-validation" id="addLoc">
      			<td>
      				<input type="text" class="form-control" disabled name="loc_id" placeholder="auto" id="loc_id">
      			</td>
            <td>
              <input type="text" class="form-control" name="name" placeholder="Location Name" required id="name">
              <div class="invalid-feedback">Please enter the name.</div>
            </td>
      			<td>
      				<input type="text" class="form-control" name="desc" placeholder="Description" required id="desc">
      				<div class="invalid-feedback">Please enter a description.</div>
      			</td>
            <td>
              <input type="text" name="img" id="img" class="form-control" placeholder="Enter filename" maxlength="15" required>
              <div class="invalid-feedback">Please enter the filename.</div>
            </td>
      			<td>
      				<input type="text" class="form-control" name="type" placeholder="Type" id="type">  		
      			</td>
            <td>
              <input type="text" class="form-control" name="addr" placeholder="Address" id="addr">     
            </td>
      			<td>
      				<button type="submit" class="btn btn-secondary" name="addLoc">Add Loc</button>
      			</td>
      		</form>
      	</tr>

        <?php
           $sql = "SELECT * FROM loc";
           $result = $conn->query($sql);

            if($result->num_rows > 0) {
              while($row = $result->fetch_assoc()) {
                 echo "<tr>
                      <th scope='row' name='".$row['loc_id']."'>" .$row['loc_id']."</th>
                      <td>" .$row['name']."</td>
                      <td>" .$row['description']."</td>
                      <td>" .$row['image']."</td>
                      <td>" .$row['loc_type']."</td>                      
                      <td>" .$row['address']."</td>                      
                      <td>
                      	<a href='update.php?id=" .$row['loc_id']."'><button type= 'button' class='btn btn-outline-secondary edit'><i class='fas fa-pencil-alt'></i></button></a>
                        <a href='delete.php?id=" .$row['loc_id']."'><button type='button' class='btn btn-secondary delete'><i class='fas fa-times'></i></button></a>                        
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
	<!-- <script src="actions/a_create.js"  type="text/javascript"></script> -->
</body>
</html>
<?php  ob_end_flush(); ?>
