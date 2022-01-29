<?php 
	$db = mysqli_connect('localhost', 'root', '', 'mobileshop');

	// initialize variables
	$id = 0;
    if (isset($_GET['send'])) {
		$id = $_GET['send'];
		mysqli_query($db, "UPDATE orders SET order_status='Delivered' WHERE order_id=$id");
		header('location: admin-orders.php');
	}
	if (isset($_GET['del'])) {
		$id = $_GET['del'];
		mysqli_query($db, "DELETE FROM orders WHERE order_id=$id");
		mysqli_query($db, "DELETE FROM `order-items` WHERE order_id=$id");
		header('location: admin-orders.php');
	}
?>