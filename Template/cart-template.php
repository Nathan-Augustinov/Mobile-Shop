<?php
 $user=array();
 $items_quantity=array();
 if(isset($_SESSION['user_id'])){
     $user=get_user_info($con,$_SESSION['user_id']);

     $product_shuffle=$cart->getProductCart($_SESSION['user_id']);
     if($_SERVER['REQUEST_METHOD']=='POST'){
         if(isset($_POST['delete-from-cart-submit'])){
             $deletedrecord=$cart->deleteFromCart($_POST['item_id'],$_SESSION['user_id']);
         }
         //save for later
         if(isset($_POST['wishlist-submit'])){
            $cart->saveForLater($_POST['item_id'],$_SESSION['user_id']);
         }
         
         
         
     }
     
     $in_cart=$cart->getCartId($cart->getProductCart($_SESSION['user_id'],'wishlist'));
}
?>

<!-- Shopping cart section-->

<section id="cart" class="py-3">
            <div class="container-fluid w-75">
                <h5 class="font-baloo font-size-20">Shopping Cart</h5>
            
        

        <!-- shopping cart items-->
            <div class="row">
                <hr>
                <?php
                    if(isset($_SESSION['user_id'])){
                ?>
                <div class="col-sm-9">
                <?php 
                    $items_id=array();
                    foreach($product_shuffle as $item):
                        $Cart=$product->getProduct($item['item_id']);
                        array_push($items_id,$item['item_id']);
                        
                        $subtotal[]=array_map(function($item) use ($in_cart){
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
                                <div class="d-flex font-rale w-25">
                                
                                    <button id="up" class="qty-up border bg-light" data-id="<?php echo $item['item_id'] ?? '0'; ?>">
                                        <i class="fas fa-angle-up"></i>
                                    </button>
                                    <input form="checkout" style="height:38px" type="text"  id="quantity" name="quantity[]" data-id="<?php echo $item['item_id'] ?? '0'; ?>" class="qty_input border px-2 w-50 bg-light" readonly="readonly" value="1" placeholder="1">
                                    <button id="down" class="qty-down border bg-light" data-id="<?php echo $item['item_id'] ?? '0'; ?>">
                                        <i class="fas fa-angle-down"></i>
                                    </button>  
                                    
                                </div>
                                <form method="post">
                                    <input type="hidden" value="<?php echo $item['item_id'] ?? 0; ?>" name="item_id">
                                    <button type="submit" name="delete-from-cart-submit" class="btn font-baloo text-danger px-3 border-right">Delete from Cart</button>
                                </form>
                                <form method="post">
                                    <input type="hidden" name="item_id" value="<?php echo $item['item_id'] ??'1'; ?>">
                                    <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']??1; ?>">
                                    <?php 
                                        if(in_array($item['item_id'],$in_cart ?? [])){
                                            echo '<button type="submit" disabled class="btn text-success font-baloo">Already in the Wishlist</button>';
                                        }
                                        else{
                                            echo '<button type="submit" name="wishlist-submit" class="btn text-danger font-baloo">Add to Wishlist</button>';
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
                            <span id="product_price" class="product_price" data-id="<?php echo $item['item_id'] ?? '0'; ?>">
                            <?php 
                                if(isset($_SESSION['exchange_rate'])){
                                    echo number_format((double)(floor(($item['item_price'])*$_SESSION['exchange_rate'])),2,'.','') ?? '0'; 
                                }
                                else{
                                    echo $item['item_price'] ?? '0';
                                }
                                
                            ?>
                            </span>
                            <input form="checkout" type="hidden" id="exchange_rate" name="exchange_rate" data-id="<?php echo $item['item_id'] ?? '0'; ?>" class="exchange_rate border px-2 w-50 bg-light" value="<?php echo isset($_SESSION['exchange_rate']) ? $_SESSION['exchange_rate'] : 1; ?>">
                            </div>
                        </div>
                    </div>
                    <?php 
                    return $item['item_price'];
                    },$Cart); //closing array_map function 
                    endforeach;

                    if(isset($_SESSION['user_id'])){
                        if(isset($_POST['command-submit'])){
                            $db = mysqli_connect('localhost', 'root', '', 'mobileshop');
                            $user_id=$_SESSION['user_id'];
                            if(isset($subtotal)){
                                $total_price=0;
                                foreach($subtotal as $key=>$item){
                                    $total_price=$total_price+(double)$item[0]*(double)$_POST['quantity'][$key];
                                }
                            $total_price=$total_price*(double)$_POST['exchange_rate'];
                            $currency=$_SESSION['currency'];
                            mysqli_query($db,"INSERT INTO orders (user_id,total_price,currency,order_date,order_status) VALUES ('$user_id','$total_price','$currency',NOW(),'Pending')");
                            $order_id=mysqli_insert_id($db);
                            foreach($items_id as $key => $id):
                                $cart_product=get_product_info($db,$id);
                                $item_price=$cart_product['item_price']*(double)$_POST['exchange_rate'];
                                $item_quantity=$_POST['quantity'][$key];
                                $new_stock=$cart_product['item_stock']-$item_quantity;
                                mysqli_query($db,"INSERT INTO `order-items` (order_id,item_id,currency,item_price,item_quantity) VALUES ('$order_id','$id','$currency','$item_price',$item_quantity)");
                                mysqli_query($db,"UPDATE product SET item_stock='$new_stock' WHERE item_id='$id'");
                                mysqli_query($db,"DELETE FROM cart WHERE (item_id=$id AND user_id=$user_id)");
                            endforeach;
                            header("location: ./index.php");
                            }
                        }
                    }
                    
                ?>
                </div>
                <?php } ?>
                <!-- cart subtotal section -->
                <div class="col-sm-3">
                <?php
                    if(isset($_SESSION['user_id'])){
                ?>
                    <div class="sub-total border text-center mt-2">
  
                        <h6 class="font-size-14 font-rale text-success py-3"><i class="fas fa-check"></i>For this order you have FREE delivery</h6>

                        <div class="border-top py-4">
                            <h5>Cart Subtotal (<?php echo isset($subtotal) ? count($subtotal) : 0; ?> items)&nbsp;<span class="text-danger">
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
                                <span class="text-danger" id="deal-price">
                                <?php 
                                if(isset($_SESSION['exchange_rate'])){
                                    if(isset($subtotal)){
                                        echo number_format((double)(floor(($cart->getSum($subtotal))*$_SESSION['exchange_rate'])),2,'.','') ?? '0'; 
                                    }
                                    else{
                                        echo '0';
                                    }
                                }
                                else{
                                    echo $cart->getSum($subtotal) ?? '0';
                                }
                                ?>
                                </span>
                            </h5>
                            <form id="checkout" method="post">
                                <button type="submit" name="command-submit" id="command-submit" class="btn btn-warning mt-3">Command the products</button>
                            </form>
                        </div>
                        
                    </div>
                    <?php } ?>
                </div>
                <!-- !cart subtotal section -->
                                           
            </div>
        <!-- !shopping cart items-->
        
        </div>
</section>
<script> 
            let input=document.querySelector(".qty_input");
            let button_up=document.querySelector(".qty-up");
            let button_down=document.querySelector(".qty-down");
            button_up.disabled=false;
            input.addEventListener("change",stateHandle);
            function stateHandle(){
                if(document.querySelector(".qty_input").value>=$item['item_stock']){
                    button_up.disabled=true;
                }
                else{
                    button_up.disabled=false;
                }
            } 
            

</script>
<!-- !Shopping cart section-->