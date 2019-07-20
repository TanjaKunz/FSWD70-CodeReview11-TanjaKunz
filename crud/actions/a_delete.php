<?php 
require_once 'db_connect.php';

if ($_POST) {
   $id = $_POST['id'];

   $sql = "DELETE FROM locations WHERE loc_id = {$id}";
    if($conn->query($sql) === TRUE) {
       echo "<p>Successfully deleted!!</p>" ;
       echo "<a href='../home.php'><button type='button'>Back</button></a>";
   } else {
       echo "Error deleting record : " . $conn->error;
   }

   $conn->close();
}

?>