<?php
$user=array();
if(isset($_SESSION['user_id'])){
    $user=get_user_info($con,$_SESSION['user_id']);
    $in_cart=$cart->getCartId($cart->getProductCart($_SESSION['user_id']));
    $in_wishlist=$cart->getCartId($cart->getProductCart($_SESSION['user_id'],'wishlist'));
}
else{
    $in_cart=$cart->getCartId($product->getData('cart'));
    $in_wishlist=$cart->getCartId($product->getData('wishlist'));
}
//request post method
if($_SERVER['REQUEST_METHOD']=="POST"){
    if(isset($_POST['add_to_cart_submit'])){
       //call method addToCart
       if(isset($_SESSION['user_id']))
        {
            $cart->addToCart($_POST['user_id'], $_POST['item_id']);
        }
        else{
            header("location:register/login.php");
        }
    }

    if(isset($_POST['add_to_wishlist_submit'])){
        //call method addToWishlist
        if(isset($_SESSION['user_id']))
        {
            $wishlist->addToWishlist($_POST['user_id'],$_POST['item_id']);        }
        else{
            header("location:register/login.php");
        }
       
    }
}

?>
<?php
    $item_id=$_GET['item_id'] ?? 1;
    foreach($product->getData() as $item) :
        if($item['item_id']==$item_id):
?>

<!-- product -->
<section id="product" class="py-3">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6">
                            <img style="height:456px;width:456px;" src="<?php echo $item['item_image'] ?? "./assets/products/1.png";?>" alt="product1" class="img-fluid">
                            <div class="form-row pt-4 font-size-16 font-baloo">
                                <div class="col" style="margin-bottom: 15px;">
                                    <form method="post">
                                            <input type="hidden" name="item_id" value="<?php echo $item['item_id']??'1'; ?>">
                                            <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']??'0'; ?>";>
                                            <?php 
                                                if(in_array($item['item_id'],$in_wishlist ?? []) && isset($_SESSION['user_id'])){
                                                    echo '<button type="submit" disabled class="form-control btn btn-success font-size-16">Already in the wishlist</button>';
                                                }
                                                else{
                                                    echo '<button type="submit" name="add_to_wishlist_submit" class="form-control btn btn-danger font-size-16">Add to Wishlist</button>';
                                                }
                                            ?>
                                    </form>    
                                </div>
                                <div class="col">
                                <form method="post">
                                            <input type="hidden" name="item_id" value="<?php echo $item['item_id']??'0'; ?>">
                                            <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']??'0'; ?>">
                                            <?php 
                                                if(in_array($item['item_id'],$in_cart ?? []) && isset($_SESSION['user_id'])){
                                                    echo '<button type="submit" disabled class="form-control btn btn-success font-size-16">Already in the cart</button>';
                                                }
                                                else{
                                                    echo '<button type="submit" name="add_to_cart_submit" class="form-control btn btn-warning font-size-16">Add to Cart</button>';
                                                }
                                            ?>
                                    </form>    
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 py-5">
                            <h5 class="font-baloo font-size-20"><?php echo $item['item_name'] ?? "Unknown"; ?></h5>
                            <div class="d-flex">
                                <div class="rating text-warning font-size-12">
                                    <span><i class="fas fa-star"></i></span>
                                    <span><i class="fas fa-star"></i></span>
                                    <span><i class="fas fa-star"></i></span>
                                    <span><i class="fas fa-star"></i></span>
                                    <span><i class="far fa-star"></i></span>
                                </div>
                                <a href="#"class="px-3 font-rale font-size-14" style="text-decoration:none;">175 ratings</a>
                            </div>
                            <hr class="m-0">
                            <!-- product price-->
                            <table class="my-3">
                                <tr class="font-rale font-size-14">
                                    <td>Price:</td>
                                    <td class="font-size-20 text-danger">
                                    <span>
                                    <?php if(isset($_SESSION['currency'])){
                                        if($_SESSION['currency']=="USD"){
                                            echo '$ ';
                                        }
                                        else{
                                            if($_SESSION['currency']=="RON"){
                                                echo 'RON ';
                                            }
                                            else{
                                                if($_SESSION['currency']=="EUR"){
                                                    echo '€ ';
                                                }
                                                else{
                                                    if($_SESSION['currency']=="GBP"){
                                                        echo '£ ';
                                                    }
                                                }
                                            }
                                        }
                                    }
                                    else{
                                        echo '$ ';
                                    }
                                        if(isset($_SESSION['exchange_rate'])){
                                            echo number_format((double)(floor(($item['item_price'])*$_SESSION['exchange_rate'])),2,'.','') ?? '0'; 
                                        }
                                        else{
                                            echo $item['item_price'] ?? '0';
                                        }
                                        ?>
                                        </span>
                                    </td>
                                </tr>
                            </table>
                            <!-- !product price-->

                            <!-- policy -->
                            <div id="policy">
                                <div class="d-flex">
                                    <div class="return text-center mr-5">
                                        <div class="font-size-20 my-2 color-second">
                                            <span class="fas fa-retweet border p-3 rounded-pill"></span>
                                        </div>
                                        <a href="#" class="font-rale font-size-12" style="text-decoration: none;">30 Days <br>Replacement</a>
                                    </div>
                                    <div class="return text-center mr-5">
                                        <div class="font-size-20 my-2 color-second">
                                            <span class="fas fa-truck border p-3 mx-5 rounded-pill"></span>
                                        </div>
                                        <a href="#" class="font-rale font-size-12" style="text-decoration: none;">1-2 Days <br>Delivery</a>
                                    </div>
                                    <div class="return text-center mr-5">
                                        <div class="font-size-20 my-2 color-second">
                                            <span class="fas fa-check-double border p-3 rounded-pill"></span>
                                        </div>
                                        <a href="#" class="font-rale font-size-12" style="text-decoration: none;">1 Year <br>Warranty</a>
                                    </div>
                                </div>
                            </div>
                            <!-- !policy -->
                            <hr>
                        </div>
                        <!-- Product Description-->
                        <div class="col-12" style="margin-top: 75px;">
                            <h6 class="font-rubik">Product Description</h6>
                            <hr>
                            <p class="font-rale font-size-16">
                                <?php echo $item['item_description'] ?? ''; ?>
                            </p>
                        </div>
                        <!-- !Product Description-->
                    </div>
                </div>
            </section>
        <!-- !product -->
<?php 
    endif;
    endforeach; 
?>