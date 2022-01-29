<?php
    $user=array();
    if(isset($_SESSION['user_id'])){
        $user=get_user_info($con,$_SESSION['user_id']);
    
    $product_shuffle=$cart->getProductCart($_SESSION['user_id'],'wishlist');
     if($_SERVER['REQUEST_METHOD']=='POST'){
         if(isset($_POST['delete-from-wishlist-submit'])){
             $deletedrecord=$wishlist->deleteFromWishlist($_POST['item_id'],$_SESSION['user_id']);
         }

         if(isset($_POST['wishlist-submit'])){
            $cart->saveForLater($_POST['item_id'],$_SESSION['user_id'],'cart','wishlist');
         }
     }
     $in_cart=$cart->getCartId($cart->getProductCart($_SESSION['user_id']));
    }
?>

<!-- Shopping cart section-->
<section id="cart" class="py-3" style="min-height:182px">
            <div class="container-fluid w-75">
                <h5 class="font-baloo font-size-20">Wishlist</h5>
            
        

        <!-- shopping cart items-->
            <div class="row">
                <hr>
                <?php
                    if(isset($_SESSION['user_id'])){
                ?>
                <div class="col-sm-9">
                    <?php 
                    foreach($product_shuffle as $item):
                        $Cart=$product->getProduct($item['item_id']);
                        $subtotal[]=array_map(function($item) use($in_cart){
                    ?>
                    <div class="row py-3 mt-3 ">
                        <div class="col-sm-2" style="margin-left:90px">
                            <img src="<?php echo $item['item_image'] ?? "./assets/products/1.png" ?>" style="height:135px;" alt="cart1" class="img-fluid">
                        </div>
                        <div class="col-sm-6">
                            <h5 class="font-baloo font-size-20"><?php echo $item['item_name'] ?? "Unknown" ?></h5>
                            <div class="d-flex">
                                <div class="rating text-warning font-size-12">
                                    <span><i class="fas fa-star"></i></span>
                                    <span><i class="fas fa-star"></i></span>
                                    <span><i class="fas fa-star"></i></span>
                                    <span><i class="fas fa-star"></i></span>
                                    <span><i class="far fa-star"></i></span>
                                </div>
                                <a href="#" class="px-2 font-rale font-size-14" style="text-decoration: none;">175 ratings</a>
                            </div>

                            <!-- product quantity-->
                            <div class="qty d-flex pt-2">
                                <form method="post">
                                    <input type="hidden" value="<?php echo $item['item_id'] ?? 0; ?>" name="item_id">
                                    <button type="submit" name="delete-from-wishlist-submit" class="btn font-baloo text-danger border-right" style="padding-left:0px;padding-right:5px">Delete from Wishlist</button>
                                </form>
                                <form method="post">
                                    <input type="hidden" value="<?php echo $item['item_id'] ?? 0; ?>" name="item_id">
                                    <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
                                    <?php 
                                        if(in_array($item['item_id'],$in_cart ?? [])){
                                            echo '<button type="submit" disabled class="btn text-success font-baloo">Already in the Cart</button>';
                                        }
                                        else{
                                            echo '<button type="submit" name="wishlist-submit" class="btn text-danger font-baloo">Add to Cart</button>';
                                        }
                                    ?>
                                </form>
                                
                            </div>
                            <!-- !product quantity-->
                        </div>
                        <div class="col-sm-2 text-end">
                            <div class="font-size-20 text-danger font-baloo">
                            <?php 
                            if(isset($_SESSION['currency'])){
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
                            <span class="product_price" data-id="<?php echo $item['item_id'] ?? '0'; ?>">
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
                        </div>
                    </div>
                    <?php 
                    },$Cart); //closing array_map function
                        endforeach; 
                    ?>
                </div>
            </div>
            <?php } ?>
        <!-- !shopping cart items-->
        </div>
        </section>
    <!-- !Shopping cart section-->