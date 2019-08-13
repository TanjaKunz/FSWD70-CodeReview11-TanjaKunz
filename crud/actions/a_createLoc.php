<?php
require_once 'db_connect.php';

if ($_POST) { 

	$name = ($_POST['name']);
	$desc = ($_POST['desc']);	
	$img = ($_POST['img']);
	$type = ($_POST['type']);
	$addr = ($_POST['addr']);
  
	$query = "INSERT INTO loc (name,description,image,loc_type,address) VALUES('$name','$desc','$img','$type','$addr')";
	
	if($conn->query($query) === TRUE) {
		echo "<p>New Record Successfully Created</p>" ;
   		echo "<a href='../adminPanel.php'><button type='button'>Back</button></a>";
    	echo "<a href='../homeAdmin.php'><button type='button'>Home</button></a>";
    } else  {
		echo "Error " . $query . ' ' . $conn->connect_error;
  	}
  	$conn->close();	 
}

?>