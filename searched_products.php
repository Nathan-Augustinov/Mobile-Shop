<?php
ob_start();
    //include header.php file
    include('header.php');
?>

<?php
    $product_shuffle=$product->getData();
    foreach($product_shuffle as $key=>$item){
      if($item['item_stock']==0){
          unset($product_shuffle[$key]);
      }
    }
    shuffle($product_shuffle);
    $at_least_one_product=false;
?>
<section id="searched-products">
    <div class="container mb-5">
        <h4 class="font-rubik font-size-20 mt-3">Results</h4>
        <div class="grid">
            <?php array_map(function ($item){ 
              if(strpos($item['item_brand'],$_GET['search'])!==false or strpos($item['item_name'],$_GET['search'])!==false or strpos($item['item_description'],$_GET['search'])!==false){
                $at_least_one_product=true;
              ?>
            <div class="grid-item border m-2 <?php echo $item['item_brand'] ?? "Brand" ; ?>">
                <div class="item m-3" style="width: 200px;">
                    <div class="product font-rale">
                        <a href="<?php printf('%s?item_id=%s', 'product.php',  $item['item_id']); ?>"><img style="height:200px;width:200px;" src="<?php echo $item['item_image'] ?? "./assets/products/13.png"; ?>" alt="product1" class="img-fluid"></a>
                        <div class="text-center">
                            <h6><?php echo $item['item_name'] ?? "Unknown"; ?></h6>
                            <div class="rating text-warning font-size-12">
                                <span><i class="fas fa-star"></i></span>
                                <span><i class="fas fa-star"></i></span>
                                <span><i class="fas fa-star"></i></span>
                                <span><i class="fas fa-star"></i></span>
                                <span><i class="far fa-star"></i></span>
                            </div>
                            <div class="price py-2">
                                <span>
                                    <?php if(isset($_SESSION['currency'])){
                                        if($_SESSION['currency']=="USD"){
                                            echo '$';
                                        }
                                        else{
                                            if($_SESSION['currency']=="RON"){
                                                echo 'RON';
                                            }
                                            else{
                                                if($_SESSION['currency']=="EUR"){
                                                    echo '€';
                                                }
                                                else{
                                                    if($_SESSION['currency']=="GBP"){
                                                        echo '£';
                                                    }
                                                }
                                            }
                                        }
                                    }
                                    else{
                                        echo '$';
                                    }
                                        if(isset($_SESSION['exchange_rate'])){
                                            echo number_format((double)(floor(($item['item_price'])*$_SESSION['exchange_rate'])),2,'.','') ?? '0'; 
                                        }
                                        else{
                                            echo $item['item_price'] ?? '0';
                                        }
                                        ?>
                                        </span>
                            </div>
                            <form method="post">
                                <input type="hidden" name="item_id" value="<?php echo $item['item_id'] ?? '1'; ?>">
                                <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id'] ??1; ?>">
                                <?php
                                    if (in_array($item['item_id'], $in_cart ?? []) && isset($_SESSION['user_id']) ){
                                            echo '<button type="submit" disabled class="btn btn-success font-size-12">Already in the Cart</button>';
                                        
                                    }else{
                                        echo '<button type="submit" name="all_products_submit" class="btn btn-warning font-size-12">Add to Cart</button>';
                                    }
                                ?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php }}, $product_shuffle) ?>
        </div>
    </div>
</section>
<!-- !Searched Products -->

<?php
  //include footer.php file
  include('footer.php');
?>