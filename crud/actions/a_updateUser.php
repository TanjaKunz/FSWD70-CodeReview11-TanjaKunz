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

  $id = $_POST['id'];

   $sql = "UPDATE users SET name = '$name', email = '$email', role = '$role' WHERE user_id = {$id}" ;
   if($conn->query($sql) === TRUE) {
       echo  "<p>Successfully Updated</p>";
       echo "<a href='../user.php?id=" .$id."'><button type='button'>Back</button></a>";
       echo  "<a href='../home.php'><button type='button'>Home</button></a>";
   } else {
        echo "Error while updating record : ". $conn->error;
   }

   $conn->close();

}

?>