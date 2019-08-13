<?php 
ob_start();
session_start();

require_once 'actions/db_connect.php';

if(!isset($_SESSION['user']) && !isset($_SESSION['admin'])) {
 header("Location: login.php");
 exit;
} 
if (isset($_SESSION['admin'])){
  header("Location: homeAdmin.php");
  exit;
}

$query = mysqli_query($conn, "SELECT * FROM users WHERE user_id =".$_SESSION['user']);
$user = mysqli_fetch_array($query, MYSQLI_ASSOC);

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
                        <a class="nav-link" href="places.php">Places</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="event.php">Event</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="restaurant.php">Restaurants</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="user.php">Update User</a>
                    </li>
                    <li>
                      <a class="nav-link" href="actions/a_logout.php?logout">Logout</a>
                    </li>
                  </ul>
                  <form class="form-inline mt-2 mt-md-0 search-box">
                    <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-secondary my-2 my-sm-0 search-box" type="submit">Search</button>
                  </form>
            </div>
        </nav>
         
      </header><!-- /header -->
      
   

      <main role="main" class="container-fluid p-3">
        <div class="text-right" id="status">Logged in as <?= $user['name']; ?></div>              
        
        <div class="row mt-5 result">
          

          <?php
           $sql = "SELECT * FROM loc ORDER BY locations.loc_type";

           $result = $conn->query($sql);

            if($result->num_rows > 0) {
              while($row = $result->fetch_assoc()) {
                // variants of display depending on loc_type
                if($row['loc_type'] == 'place'){
                  echo "<div class='col-lg-3 col-md-6 col-sm-12 py-3 h5 d-flex flex-wrap box'>
                  <span  name='".$row['loc_id']."'>".$row['loc_id']."</span>
                  <div class='col-lg-12 col-md-6 mb-3 p-0 d-none d-lg-block d-md-block img'>
                  <img class='img-fluid' src='img/".$row['image']."' alt='".$row['name']."''>
                  </div>

                  <div class='col-lg-12 col-md-6 col-sm-12 p-lg-0 px-md-3 info'>
                  <div class='col-12 p-0 h4 title'>" .$row['name']. "</div>

                  <hr class='col-12 my-0 px-0 py-1 hr'>

                  <p class='col-12 m-0 p-0 street'>" .$row['address']. "</p>
                  <p class='col-12 m-0 p-0 city'>" .$row['ZIP']." ".$row['city']. "</p>
                  </div>
                  </div>" ;
                } elseif ($row['loc_type'] == 'restaurant'){
                  echo "<div class='col-lg-3 col-md-6 col-sm-12 py-3 h5 d-flex flex-wrap box'>
                  <span  name='".$row['loc_id']."'>".$row['loc_id']."</span>
                  <div class='col-lg-12 col-md-6 mb-3 p-0 d-none d-lg-block d-md-block img'>
                  <img class='img-fluid' src='img/".$row['image']."' alt='".$row['name']."''>
                  </div>

                  <div class='col-lg-12 col-md-6 col-sm-12 p-lg-0 px-md-3 info'>
                  <div class='col-12 p-0 h4 title'>" .$row['name']. "</div>

                  <hr class='col-12 my-0 px-0 py-1 hr'>

                  <p class='col-12 m-0 p-0 street'>" .$row['address']. "</p>
                  <p class='col-12 m-0 p-0 city'>" .$row['ZIP']." ".$row['city']. "</p>

                  <p class='col-12 m-0 pt-2 px-0 tel'>Tel: ".$row['phone']."</p>
                  <p class='col-12 m-0 p-0 web'><a href='".$row['web']."'>Homepage</a></p>
                  </div>
                  </div>" ;
                } else {
                  echo "<div class='col-lg-3 col-md-6 col-sm-12 py-3 h5 d-flex flex-wrap box'>
                  <span  name='".$row['loc_id']."'>".$row['loc_id']."</span>
                  <div class='col-lg-12 col-md-6 mb-3 p-0 d-none d-lg-block d-md-block img'>
                  <img class='img-fluid' src='img/".$row['image']."' alt='".$row['name']."''>
                  </div>

                  <div class='col-lg-12 col-md-6 col-sm-12 p-lg-0 px-md-3 info'>
                  <div class='col-12 p-0 h4 title'>" .$row['name']. "</div>

                  <hr class='col-12 my-0 px-0 py-1 hr'>
                  <p class='col-12 m-0 px-0 pb-2 tel'>" .$row['con_date']. " " .$row['con_time']. "</p>

                  <p class='col-12 m-0 p-0 street'>" .$row['address']. "</p>
                  <p class='col-12 m-0 p-0 city'>" .$row['ZIP']." ".$row['city']. "</p>
                  
                  <p class='col-12 m-0 p-0 web'><a href='".$row['web']."'>Homepage</a></p>
                  </div>
                  </div>" ;
                }
              }              
          } else {
               echo  "<tr><td colspan='5'><center>No Data Avaliable</center></td></tr>";
          }
          ?> 
            
         </div>      
      </main>

      <footer class="footer fixed-bottom py-3">
         <div class="container text-center">
            <span class="text-muted">Tanja Kunz - CodeFactory 2019</span>
         </div>
      </footer>
   </div>

   <script type="text/javascript">
    $(document).ready(function(){
        $('.search-box input[type="text"]').on("keyup input", function(){
            /* Get input value on change */
            var inputVal = $(this).val();
            var resultDropdown = $(this).siblings(".result");
            if(inputVal.length){
                $.get("actions/a_search.php", {term: inputVal}).done(function(data){
                    // Display the returned data in browser
                    resultDropdown.html(data);
                });
            } else{
                resultDropdown.empty();
            }
        });
        
        // Set search input value on click of result item
        $(document).on("click", ".result p", function(){
            $(this).parents(".search-box").find('input[type="text"]').val($(this).text());
            $(this).parent(".result").empty();
        });
    });
    </script>   
</body>
</html>
<?php  ob_end_flush(); ?>