<!-- Shopping cart section-->
<section id="cart"class="py-3" mb-5>
            <div class="container-fluid w-75">
                <h5 class="font-baloo font-size-20">Shopping Cart</h5>
            
        

        <!-- shopping cart items-->
            <div class="row">
                <hr>
                <div class="col-sm-9">
                    <!-- Empty Cart -->
                        <div class="row py-3 mt-3">
                            <div class="col-sm-12 text-center py-2">
                                <img src="./assets/empty_cart.png" alt="Empty Cart" class="img-fluid" style="height:200px">
                                <p class="font-baloo font-size-16 text-black-50">Empty Cart</p>
                            </div>
                        </div>
                    <!-- !Empty Cart -->
                </div>
                <!-- cart subtotal section -->
                <div class="col-sm-3">
                    <div class="sub-total border text-center mt-2">
                        <h6 class="font-size-14 font-rale text-success py-3"><i class="fas fa-check"></i>For this order you have FREE delivery</h6>
                        <div class="border-top py-4">
                            <h5>Cart Subtotal (<?php echo isset($subtotal) ? count($subtotal) : 0; ?> items)&nbsp;<span class="text-danger">$<span class="text-danger" id="deal-price"><?php echo isset($subtotal) ? $cart->getSum($subtotal) : 0;?></span><span></span></h5>
                            <button type="submit" class="btn btn-warning mt-3">Proceed to Buy</button>
                        </div>
                    </div>
                </div>
                <!-- !cart subtotal section -->
            </div>
        <!-- !shopping cart items-->
        </div>
        </section>
    <!-- !Shopping cart section-->