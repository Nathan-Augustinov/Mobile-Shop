<!DOCTYPE html>
<html lang="en">
<head >
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mobile Shop</title>

    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- Owl Carousel CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- font awesome icons-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <!-- Custom CSS file -->
    <link rel="stylesheet" href="../style.css">
  <style>

.see_order_btn {
    text-decoration: none;
    padding: 2px 5px;
    color: white;
    border-radius: 3px;
    background: #4D7EA8;
}
</style>

    <?php
        //require functions.php file
        require ('../functions.php');

    ?>
<?php

session_start();
include('../register/helper.php');

$user=array();
if(isset($_SESSION['user_id'])){
    require('../register/mysqli_connect.php');
    $user=get_user_info($con,$_SESSION['user_id']);
    
}

if($_SERVER['REQUEST_METHOD']=="POST"){
  if(isset($_POST['logout_submit'])){
     session_destroy();
     header("location:../index.php");
  }
}
$user_id=$_SESSION['user_id'];
$results = mysqli_query($con, "SELECT * FROM orders WHERE user_id=$user_id"); 
?>
</head>
<body style="position:relative;min-height:100vh;">
    <!-- start #header -->
        <header id="header">
            <!-- Primary Navigation -->
            <nav class="navbar navbar-expand-lg navbar-dark color-second-bg">
                <div class="container-fluid">
                  <a class="navbar-brand" href="../index.php">Mobile Shop</a>
                  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                  </button>
                  <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav m-auto font-rubik">
                    </ul>
                    <div class="font-rale font-size-16">
                      <?php
                        if(isset($_SESSION['user_id'])){
                          echo '<a href="../WishList.php" class="px-3 border-right text-dark" style="text-decoration: none; margin-right:25px"><b>Wishlist'?> (<?php echo count($cart->getProductCart($_SESSION['user_id'],'wishlist')); ?>)<?php echo '</b></a> </div>';?>
                        <?php  echo '<form action="#" class="font-size-14 font-rale">
                        <a href="../cart.php" class="py-2  rounded-pill color-primary-bg" style="text-decoration:none;">
                            <span class="font-size-16 px-3 text-white"><i class="fas fa-shopping-cart"></i></span>
                            <span class="px-3 py-2 rounded-pill text-dark bg-light">'?><?php echo count($cart->getProductCart($_SESSION['user_id'])); ?> <?php echo '</span>;
                        </a>
                    </form>'?>
                    <?php echo '<form method="post"><button type="submit" name="logout_submit" style="margin-left:20px;" class="btn font-size-16 text-dark"><b>Logout<b></button></form>';?>
                       <?php }?>
                       <?php 
                        if(!isset($_SESSION['user_id'])){ 
                          echo '<div> <a href="../register/register.php" class="px-3 border-right border-left text-dark" style="text-decoration: none;"><b>Register</b></a>';
                          echo '<a href="../register/login.php" class="px-3 border-right border-left text-dark" style="text-decoration: none;"><b>Login</b></a>';
                        }
                        ?>
                    </div>
                  </div>
                </div>
              </nav>
              <!-- !Primary Navigation -->
        </header>
    <!-- !start #header -->

    <!-- start #main-site -->
    
<main id="main-admin-panel" style="padding-bottom:12rem">
<div>
<table class="table">
	<thead style="font-size:20px">
		<tr>
			<th scope="col">Order ID</th>
      <th scope="col">Total Price</th>
      <th scope="col">Order date</th>
      <th scope="col">Order status</th>
			<th scope="col" colspan="1">Action</th>
		</tr>
	</thead>
	<tbody style="font-weight:normal;font-size:16px">
	<?php while ($row = mysqli_fetch_array($results)) { ?>
		<tr>
			<th style="font-weight:normal;" scope="row"><?php echo $row['order_id']; ?></td>
            <td><?php echo $row['currency'].' '.$row['total_price']; ?></td>
            <td><?php echo $row['order_date']; ?></td>
            <td>
                <?php
                    echo $row['order_status'];
                ?>
            </td>   
            <td>
            <a href="user-order-items.php?order=<?php echo $row['order_id']; ?>" class="see_order_btn" >See Order</a>
			</td>
		</tr>
	<?php } ?>
  </tbody>
</table>               
</div>
</main>
    <!-- !start #main-site -->

    <!-- start #footer -->
    <footer id="footer" class="bg-dark text-white py-5" style="position:absolute;bottom:0;width:100%;height:13rem">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-12">
                    <h4 class="font-rubik font-size-20">Mobile Shop</h4>
                    <p class="font-rale font-size-14 text-white-50">
                        Telefon: +40700000000
                    </p>
                    <p class="font-rale font-size-14 text-white-50">
                        E-mail: mobileshop@gmail.com
                    </p>
                    <p class="font-rale font-size-14 text-white-50">
                        Address: Romania
                    </p>
                </div>
                <div class="col-lg-2 col-12"></div>
                <div class="col-lg-3 col-12">
                    <h4 class="font-rubik font-size-20">Information</h4>
                    <div class="d-flex flex-column flex-wrap">
                        <a href="#" class="font-rale font-size-14 text-white-50 pb-1">About Us</a>
                        <a href="#" class="font-rale font-size-14 text-white-50 pb-1">Privacy Policy</a>
                        <a href="#" class="font-rale font-size-14 text-white-50 pb-1">Terms and Conditions</a>                 
                    </div>
                </div>
                <div class="col-lg-3 col-12">
                    <h4 class="font-rubik font-size-20">Account</h4>
                    <div class="d-flex flex-column flex-wrap">
                        <a href=<?php if(isset($_SESSION['user_id'])) echo "../my-account.php"; else echo "register/login.php"; ?> class="font-rale font-size-14 text-white-50 pb-1">My Account</a>
                        <a href="<?php if(isset($_SESSION['user_id'])) echo "user-orders.php"; else echo "register/login.php"; ?>" class="font-rale font-size-14 text-white-50 pb-1">Order History</a>
                        <a href="<?php if(isset($_SESSION['user_id'])) echo "../WishList.php"; else echo "register/login.php"; ?>" class="font-rale font-size-14 text-white-50 pb-1">Wishlist</a>                 
                    </div>
                </div>
            </div>
        </div>
            
    </footer>
    <!-- !start #footer -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

    <!-- Owl Carousel JS File-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Isotope plugin CDN-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.isotope/3.0.6/isotope.pkgd.min.js" integrity="sha512-Zq2BOxyhvnRFXu0+WE6ojpZLOU2jdnqbrM1hmVdGzyeCa1DgM3X5Q4A/Is9xA1IkbUeDd7755dNNI/PzSf2Pew==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- !Isotope plugin CDN-->

    <!-- Custom JavaScript-->
    <script src="../index.js"></script>
</body>
</html>