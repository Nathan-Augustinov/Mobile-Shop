<?php
ob_start();
    //include header.php file
    include('header.php');
?>

<?php
    //include banner-area.php file
    include('Template/banner-area.php');

      //include all-products.php file
      include('Template/all-products.php');

    //include top-sale.php file
    include('Template/top-sale.php');

    //include special-price.php file
    include('Template/special-price.php');

    //include banner-adds.php file
    include('Template/banner-adds.php');

    //include new-phones.php file
    include('Template/new-phones.php');

?>
  
<?php
    //include footer.php file
    include('footer.php');
?>

    