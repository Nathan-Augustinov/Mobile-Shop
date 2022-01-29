<!DOCTYPE html>
<html lang="en">
<head>
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
    <link rel="stylesheet" href="style.css">

    <?php
        //require functions.php file
        require ('functions.php');

    ?>
<?php

session_start();
include('register/helper.php');

$user=array();
if(isset($_SESSION['user_id'])){
    require('register/mysqli_connect.php');
    $user=get_user_info($con,$_SESSION['user_id']);
    
}

if($_SERVER['REQUEST_METHOD']=="POST"){
  if(isset($_POST['search_submit'])){
    if(!empty($_POST['search'])){
      $search_input=$_POST['search'];
      header("location:searched_products.php?search=$search_input");
    }
   
  }
  if(isset($_POST['logout_submit'])){
     session_destroy();
     header("location:index.php");
  }

  if(isset($_POST['currency_submit'])){
    $selected_currency=$_POST['change_currency'];
    $_SESSION['currency']=$selected_currency;
    if(isset($_SESSION['currency'])){
      $currency=$_SESSION['currency'];
      $req_url = "https://api.exchangerate.host/convert?from=USD&to=$currency";
      $response_json = file_get_contents($req_url);
      if(false !== $response_json) {
         
              $response = json_decode($response_json);
              
      } 
  }
  $_SESSION['exchange_rate']=$response->info->rate;
  }
}




?>
</head>
<body style="position:relative;min-height:100vh;">
    <!-- start #header -->
        <header id="header">
            <!-- Primary Navigation -->
            <nav class="navbar navbar-expand-lg navbar-dark color-second-bg">
                <div class="container-fluid">
                  <a class="navbar-brand" href="index.php">Mobile Shop</a>
                  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                  </button>
                  <div class="collapse navbar-collapse" id="navbarNav">
                   <ul class="navbar-nav m-auto font-rubik ">
                     <form method="post" action="">
                     <div class="input-group">
                        <div class="form-outline">
                          <input name="search" type="search" id="form1" class="form-control" placeholder="Search" style="height:45px"/>
                        </div>
                        <button name="search_submit" type="submit" class="btn btn-primary" style="height:45px">
                          <i class="fas fa-search"></i>
                        </button>
                      </div>
                     </form>
                      <form style="display:flex;flex-direction:row" method="post" action="">
                      <select class="form-select" style="height:45px;width:100px;margin-left:300px" name="change_currency" id="change_currency">
                            <?php if($_SESSION['currency']=="USD"){
                              echo '<option selected value="USD">USD</option>';
                              echo '<option value="RON">RON</option>';
                              echo '<option value="EUR">EUR</option>';
                              echo '<option value="GBP">GBP</option>';
                            }else ?>
                            <?php if($_SESSION['currency']=="RON"){
                              echo '<option value="USD">USD</option>';
                              echo '<option selected value="RON">RON</option>';
                              echo '<option value="EUR">EUR</option>';
                              echo '<option value="GBP">GBP</option>';
                            }else ?>
                            <?php if($_SESSION['currency']=="EUR"){
                              echo '<option value="USD">USD</option>';
                              echo '<option value="RON">RON</option>';
                              echo '<option selected value="EUR">EUR</option>';
                              echo '<option value="GBP">GBP</option>';
                            }else ?>
                            <?php if($_SESSION['currency']=="GBP"){
                              echo '<option value="USD">USD</option>';
                              echo '<option value="RON">RON</option>';
                              echo '<option value="EUR">EUR</option>';
                              echo '<option selected value="GBP">GBP</option>';
                            }else
                            if(!isset($_SESSION['currency']))
                            {
                              echo '<option selected value="USD">USD</option>';
                              echo '<option value="RON">RON</option>';
                              echo '<option value="EUR">EUR</option>';
                              echo '<option value="GBP">GBP</option>';
                            } ?>
                        </select>
                      <button class="btn font-size-14 text-dark" type="submit" name="currency_submit" >Change Currency</button>
                      </form>
                    </ul>
                    <div class="font-rale font-size-16">
                      <?php
                        if(isset($_SESSION['user_id'])){
                          echo '<a href="WishList.php" class="px-3 border-right text-dark" style="text-decoration: none; margin-right:25px"><b>Wishlist'?> (<?php echo count($cart->getProductCart($_SESSION['user_id'],'wishlist')); ?>)<?php echo '</b></a> </div>';?>
                        <?php  echo '<form action="#" class="font-size-14 font-rale">
                        <a href="cart.php" class="py-2  rounded-pill color-primary-bg" style="text-decoration:none;">
                            <span class="font-size-16 px-3 text-white"><i class="fas fa-shopping-cart"></i></span>
                            <span class="px-3 py-2 rounded-pill text-dark bg-light">'?><?php echo count($cart->getProductCart($_SESSION['user_id'])); ?> <?php echo '</span>;
                        </a>
                    </form>'?>
                    <?php echo '<form method="post"><button type="submit"  name="logout_submit" id="logout_submit" style="margin-left:20px;" class="btn font-size-16 text-dark"><b>Logout<b></button></form>';?>
                       <?php }?>
                       <?php 
                        if(!isset($_SESSION['user_id'])){ 
                          echo '<div> <a href="register/register.php" class="px-3 border-right border-left text-dark" style="text-decoration: none;"><b>Register</b></a>';
                          echo '<a href="register/login.php" class="px-3 border-right border-left text-dark" style="text-decoration: none;"><b>Login</b></a>';
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
    
    <main id="main-site" style="padding-bottom:13rem">