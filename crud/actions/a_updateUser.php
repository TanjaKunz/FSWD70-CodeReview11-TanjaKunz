<?php 

require_once 'db_connect.php';

if ($_POST) {
   $name = $_POST['name'];
   $email = $_POST['email'];
   $role = $_POST[ 'role'];

   $id = $_POST['id'];

   $sql = "UPDATE users SET name = '$name', email = '$email', role = '$role' WHERE user_id = {$id}" ;
   if($conn->query($sql) === TRUE) {
       echo  "<p>Successfully Updated</p>";
       echo "<a href='../updateUser.php?id=" .$id."'><button type='button'>Back</button></a>";
       echo  "<a href='../usersAdmin.php'><button type='button'>Home</button></a>";
   } else {
        echo "Error while updating record : ". $connect->error;
   }

   $conn->close();

}

?>