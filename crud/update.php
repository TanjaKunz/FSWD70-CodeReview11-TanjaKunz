<?php 

require_once 'actions/db_connect.php';

// if(!isset($_SESSION['user']) || !isset($_SESSION['admin'])) {
//  header("Location: login.php");
//  exit;
// } elseif (isset($_SESSION['user'])){
//   header("Location: home.php");
//   exit;
// }

if ($_GET['id']) {
   $id = $_GET['id'];

   $sql = "SELECT * FROM locations WHERE loc_id = {$id}" ;
   $result = $conn->query($sql);

   $data = $result->fetch_assoc();

   $conn->close();

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

   <style type= "text/css">
       fieldset {
           margin : auto;
           margin-top: 100px;
            width: 50%;
       }

       table  tr th {
           padding-top: 20px;
       }
   </style>

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
                    <li>
                      <a class="nav-link" href="actions/a_logout.php?logout">Logout</a>
                    </li>
            </div>
        </nav>
         
      </header><!-- /header -->

    <main>
      <fieldset>       
      <form action="actions/a_update.php"  method="post">
        <h1 class="h3 mb-3 font-weight-normal">Update Location</h1>

        <label>Location Name</label>
        <input type="text" name="loc_name" class="form-control" placeholder="Location Name" maxlength="50" value="<?php echo $data['name'] ?>" autofocus>

        <label>Description</label>
        <input type="text" name="loc_desc" class="form-control" placeholder="Description" maxlength="50" value="<?php echo $data['description'] ?>" autofocus>

        <label>Image</label>
        <input type="text" name="loc_img" class="form-control" placeholder="Image (Filename)" maxlength="50" value="<?php echo $data['image'] ?>" autofocus>

        <label>Type</label>
        <input type="text" name="loc_type" class="form-control" placeholder="Location Type (1-3)" maxlength="50" value="<?php echo $data['loc_type'] ?>" autofocus>

        <label>Address ID</label>
        <input type="text" name="address" class="form-control" placeholder="Address" maxlength="50" value="<?php echo $data['address'] ?>" autofocus>

        <div class="mt-3">
          <input type= "hidden" name= "id" value= "<?php echo $data['loc_id']?>" />
          <button class="btn btn-outline-secondary" type="submit">Save Changes</button>
          <a href="homeAdmin.php"><button class="btn btn-secondary" type="button" >Back</button></a>
        </div>      
      </form>
      </fieldset>
    </main>

    <footer class="footer fixed-bottom py-3">
         <div class="container text-center">
            <span class="text-muted">Tanja Kunz - CodeFactory 2019</span>
         </div>
      </footer>
  </div>
</body >
</html >

<?php 
}
?>