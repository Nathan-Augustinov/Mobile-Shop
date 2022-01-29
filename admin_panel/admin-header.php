<!-- start #header -->
<header id="header">
            <!-- Primary Navigation -->
            <nav class="navbar navbar-expand-lg navbar-dark color-second-bg">
                <div class="container-fluid">
                  <a class="navbar-brand" href="../index.php">Mobile Shop</a>
                  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                  </button>
                  <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav m-auto font-rubik">
                      <li class="nav-item px-5">
                        <a class="nav-link  text-dark" href="admin-products.php">Products</a>
                      </li>
                      <li class="nav-item px-5">
                        <a class="nav-link  text-dark" href="admin-users.php">Users</a>
                      </li>
                      <li class="nav-item px-5">
                        <a class="nav-link  text-dark" href="#">Orders</a>
                      </li>
                    </ul>
                    <div class="font-rale font-size-16">
                      <!--<?php
                        if(isset($_SESSION['user_id'])){
                          echo '<a href="WishList.php" class="px-3 border-right text-dark" style="text-decoration: none; margin-right:25px"><b>Wishlist'?> (<?php echo count($cart->getProductCart($_SESSION['user_id'],'wishlist')); ?>)<?php echo '</b></a> </div>';?>
                        <?php  echo '<form action="#" class="font-size-14 font-rale">
                        <a href="cart.php" class="py-2  rounded-pill color-primary-bg" style="text-decoration:none;">
                            <span class="font-size-16 px-3 text-white"><i class="fas fa-shopping-cart"></i></span>
                            <span class="px-3 py-2 rounded-pill text-dark bg-light">'?><?php echo count($cart->getProductCart($_SESSION['user_id'])); ?> <?php echo '</span>;
                        </a>
                    </form>'?>
                    <?php echo '<form method="post"><button type="submit" name="logout_submit" style="margin-left:20px;" class="btn font-size-16 text-dark"><b>Logout<b></button></form>';?>
                       <?php }?>
                       <?php 
                        if(!isset($_SESSION['user_id'])){ 
                          
                          echo '<div> <a href="register/register.php" class="px-3 border-right border-left text-dark" style="text-decoration: none;"><b>Register</b></a>';
                          echo '<a href="register/login.php" class="px-3 border-right border-left text-dark" style="text-decoration: none;"><b>Login</b></a>';
                          
                        }
                        ?>-->
                        
                        <form method="post"><button type="submit" name="logout_submit" style="margin-left:20px;" class="btn font-size-16 text-dark"><b>Logout<b></button></form>
                      
                    </div>
                  </div>
                </div>
              </nav>
              <!-- !Primary Navigation -->
        </header>
    <!-- !start #header -->