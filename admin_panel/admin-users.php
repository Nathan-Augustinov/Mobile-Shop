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
<?php $results = mysqli_query($db, "SELECT * FROM user"); ?>
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
			<th>First name</th>
			<th>Last name</th>
            <th>Email</th>
			<th>Profile image</th>
            <th>Register date</th>
			<th colspan="2">Action</th>
		</tr>
	</thead>
	
	<?php while ($row = mysqli_fetch_array($results)) { ?>
		<tr>
			<td><?php echo $row['first_name']; ?></td>
			<td><?php echo $row['last_name']; ?></td>
            <td><?php echo $row['email']; ?></td>
			<td><?php echo $row['profileImage']; ?></td>
            <td><?php echo $row['register_date']; ?></td>
			<td>
				<a href="server-users.php?del=<?php echo $row['user_id']; ?>" class="del_btn">Delete</a>
			</td>
		</tr>
	<?php } ?>
</table>
</div>
</body>
</html>