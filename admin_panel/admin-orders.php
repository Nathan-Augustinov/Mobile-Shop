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
<?php $results = mysqli_query($db, "SELECT * FROM orders"); ?>
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
			<th>User ID</th>
            <th>Total Price</th>
            <th>Order date</th>
            <th>Order status</th>
			<th colspan="3">Action</th>
		</tr>
	</thead>
	
	<?php while ($row = mysqli_fetch_array($results)) { ?>
		<tr>
			<td><?php echo $row['order_id']; ?></td>
			<td><?php echo $row['user_id']; ?></td>
            <td><?php echo $row['currency'].' '.$row['total_price']; ?></td>
            <td><?php echo $row['order_date']; ?></td>
            <td>
                <?php
                    echo $row['order_status'];
                ?>
            </td>   
            <td>
              <?php 
                if($row['order_status']=='Pending'){
                  ?><a href="server-orders.php?send=<?php echo $row['order_id']; ?>" class="edit_btn">Send</a><?php
                }
                else{
                  ?><a href='javascript:void(0);' class="edit_btn">Send</a><?php
                }

              ?>

			</td>
      <td>
            <a href="admin-order-items.php?order=<?php echo $row['order_id']; ?>" class="see_order_btn" >See Order</a>
			</td>
		</tr>
	<?php } ?>
</table>
</div>
</body>
</html>