<?php
ob_start();
    //include header.php file
    include('header.php');
  
?>
<?php
    //include cart items if it is not empty
    count($product->getData('cart')) ? include('Template/cart-template.php') : include('Template/empty/emptyCart.php');

    //include new-phones.php file
    include('Template/new-phones.php');


?>
<?php
    //include footer.php file
    include('footer.php');
?>