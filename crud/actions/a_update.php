<?php 

require_once 'db_connect.php';

if ($_POST) {
  $name = trim($_POST['name']);
  $name = strip_tags($name);
  $name = htmlspecialchars($name);

  $desc = trim($_POST['desc']);
  $desc = strip_tags($desc);
  $desc = htmlspecialchars($desc);

  $img = trim($_POST['img']);
  $img = strip_tags($img);
  $img = htmlspecialchars($img);

  $type = trim($_POST['type']);
  $addr = trim($_POST['addr']);

  $id = $_POST['id'];

   $sql = "UPDATE loc SET name = '$name', description = '$desc', image = '$img' WHERE loc_id = {$id}" ;
   if($conn->query($sql) === TRUE) {
       echo  "<p>Successfully Updated</p>";
       echo "<a href='../adminPanel.php'><button type='button'>Back to panel</button></a>";
       echo  "<a href='../homeAdmin.php'><button type='button'>Home</button></a>";
   } else {
        echo "Error while updating record : ". $conn->error;
   }

   $conn->close();

}

?>