<?php
 $product_shuffle=$product->getData();
 foreach($product_shuffle as $key=>$item){
    if($item['item_stock']==0){
        unset($product_shuffle[$key]);
    }
}
 shuffle($product_shuffle);

 $user=array();
 if(isset($_SESSION['user_id'])){
     $user=get_user_info($con,$_SESSION['user_id']);
     $in_cart=$cart->getCartId($cart->getProductCart($_SESSION['user_id']));
 }
 else{
    $in_cart=$cart->getCartId($product->getData('cart'));
    }
 //request post method
 if($_SERVER['REQUEST_METHOD']=="POST"){
     if(isset($_POST['special_price_submit'])){
        //call method addToCart
        if(isset($_SESSION['user_id']))
        {
            
            $cart->addToCart($_POST['user_id'], $_POST['item_id']);
        }
        else{
            header("location:register/login.php");
        }
     }
 }


 ?>
<!-- Special Price-->
<section id="special-price">
            <div class="container py-5">
                <h4 class="font-rubik font-size-20 ">Special Price</h4>
                <hr>
                <!-- owl carousel-->
                    <div class="owl-carousel owl-theme">
                        <?php array_map(function($item) use($in_cart){
                                if($item['item_section']=="Special Price"){
                            ?>
                        <div class="item py-2">
                            <div class="product font-rale">
                                <a href="<?php printf('%s?item_id=%s','product.php',$item['item_id']); ?>"><img style="height:223.2px;width:223.2px" src="<?php echo $item['item_image'] ?? "./assets/products/4.png"; ?>" alt="product4" class="img-fluid"></a>
                                <div class="text-center">
                                    <h6 style="margin-top:10px;"><?php echo $item['item_name'] ?? "Unknown"; ?></h6>
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
                                    
                                    ?>
                                    
                                        <?php 
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
                                            <input type="hidden" name="item_id" value="<?php echo $item['item_id']??'1'; ?>">
                                            <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id'] ?? 1; ?>">
                                            <?php 
                                                if(in_array($item['item_id'],$in_cart ?? []) && isset($_SESSION['user_id'])){
                                                        echo '<button type="submit" disabled class="btn btn-success font-size-12">Already in the cart</button>';
                                                }
                                                else{
                                                    echo '<button type="submit" name="top_sale_submit" class="btn btn-warning font-size-12">Add to Cart</button>';
                                                }
                                            ?>
                                    </form>    
                                     
                                </div>
                            </div>
                        </div>
                        <?php }},$product_shuffle) ?>
                    </div>
                <!-- !owl carousel-->
            </div>
        </section>
        <!-- !Special Price-->