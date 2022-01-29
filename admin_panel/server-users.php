<?php 
	session_start();
	$db = mysqli_connect('localhost', 'root', '', 'mobileshop');

	// initialize variables
	$id = 0;
	if (isset($_GET['del'])) {
		$id = $_GET['del'];
		mysqli_query($db, "DELETE FROM user WHERE user_id=$id");
		mysqli_query($db,"DELETE FROM cart WHERE user_id=$id");
		header('location: admin-users.php');
	}
?>