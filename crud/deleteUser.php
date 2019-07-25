<?php 

require_once 'actions/db_connect.php';

if ($_GET['id']) {
   $id = $_GET['id'];

   $sql = "SELECT * FROM users WHERE user_id = {$id}";
   $result = $conn->query($sql);
   $data = $result->fetch_assoc();

   $conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
   <title >Delete Data</title>

   <!-- Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!----- jQuery, Popper.js, Bootstrap.js ----->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script> -->

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <!-------- Font Awesome -------->
    <script src="https://kit.fontawesome.com/649b84c193.js"></script>
</head>
<body>

<h3>Do you really want to delete this user?</h3>
<form action ="actions/a_deleteUser.php" method="post">

   <input type="hidden" name="id" value="<?php echo $data['user_id'] ?>" />
   <button class="btn btn-info" type="submit">Yes, delete it!</button >
   <a href="usersAdmin.php"><button class="btn btn-outline-info" type="button">No, go back!</button ></a>
</form>

</body>
</html>

<?php
}
?>