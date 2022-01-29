<?php  include('server.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Mobile Shop</title>
    <link rel="stylesheet" type="text/css" href="admin-style.css">
	<style>
body {
  margin: 0;
}
.see_order_btn {
    text-decoration: none;
    padding: 2px 5px;
    color: white;
    border-radius: 3px;
    background: #4D7EA8;
}

.topnav {
  overflow: hidden;
  background-color: #00A5C4;
  height:56px;
}

.topnav a {
  float: left;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 18px;
  height:60px;
  color:black;
  line-height:30px;
}

.topnav a:hover {
  color: black;
}

.topnav a.active {
  color: white;
  font-size: 21px;
}

</style>
</head>
<body>
    <?php include("../register/helper.php");?>
<?php
if (isset($_GET['order'])) { 
    $id = $_GET['order'];
    $results = mysqli_query($db, "SELECT * FROM `order-items` WHERE order_id=$id"); 
}
?>
<div class="topnav">
	<div style="float:left">
  		<a class="active" href="admin-index.php">Mobile Shop</a>
	</div>
	<div style="float:right">
  		<a class="logout" href="../index.php">Logout</a>
	</div>
	<div style="display:flex; justify-content:center;">
  		<a style="margin-right:70px" href="admin-products.php">Products</a>
  		<a style="margin-right:70px" href="admin-users.php">Users</a>
  		<a href="admin-orders.php">Orders</a>
  	</div>
</div>
<div>
<table>
	<thead>
		<tr>
            <th>Order ID</th>
			<th>Item ID</th>
			<th>Item Name</th>
            <th>Item Price</th>
            <th>Item Quantity</th>
		</tr>
	</thead>
	
	<?php while ($row = mysqli_fetch_array($results)) { ?>
		<tr>
            <td><?php echo $_GET['order']; ?></td>
			<td><?php echo $row['item_id']; ?></td>
			<td>
                <?php 
                    $order_item=get_product_info($db,$row['item_id']);
                    echo $order_item['item_name']; 
                ?>
            </td>
            <td><?php echo $row['currency'].' '.$row['item_price']; ?></td>
            <td><?php echo $row['item_quantity']; ?></td>
		</tr>
	<?php } ?>
</table>
</div>
</body>
</html>