<?php

define('EMAIL','office.mobileshop@gmail.com');
define('PASSWORD','mobileshop2021');

define('ADMIN_EMAIL','admin@admin.com');
define('ADMIN_PASSWORD','admin');

 //require MySQL connection
 require ('database/DBController.php');

  //require Product class
  require ('database/Product.php');

  //require Cart class
  require ('database/Cart.php');

    //require Wishlist class
    require ('database/Wishlist.php');

 //DBController object
    $db=new DBController(); 

 //Product object
    $product=new Product($db); 

// Cart object
$cart=new Cart($db);

// Wishlist object
$wishlist=new Wishlist($db);