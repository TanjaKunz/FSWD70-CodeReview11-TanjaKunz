<?php
error_reporting( ~E_DEPRECATED & ~E_NOTICE );

define ('DBHOST', 'localhost');
define ('DBUSER', 'root');
define ('DBPASS', '');
define ('DBNAME', 'cr11_yourname_travelmatic');

$conn = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);

if($conn->connect_error){
	die('Unable to connect: ' . mysqli_connect_error());
}

?>