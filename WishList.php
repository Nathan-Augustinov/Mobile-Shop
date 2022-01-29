<?php
ob_start();
    //include header.php file
    include('header.php');
?>
<?php
  
  //include wishlist.php file
  count($product->getData('wishlist')) ? include('Template/wishlist.php') : include('Template/empty/emptyWishlist.php');

  //include special-price.php file
  include('Template/special-price.php');


?>
<?php
  //include footer.php file
  include('footer.php');
?>