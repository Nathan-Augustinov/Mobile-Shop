</main>
    <!-- !start #main-site -->

    <!-- start #footer -->
    <footer id="footer" class="bg-dark text-white py-5" style="position:absolute;bottom:0;width:100%;height:13rem">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-12">
                    <h4 class="font-rubik font-size-20">Mobile Shop</h4>
                    <p class="font-rale font-size-14 text-white-50">
                        Telefon: +40700000000
                    </p>
                    <p class="font-rale font-size-14 text-white-50">
                        E-mail: office.mobileshop@gmail.com
                    </p>
                    <p class="font-rale font-size-14 text-white-50">
                        Address: Romania
                    </p>
                </div>
                <div class="col-lg-4 col-12">
                    <h4 class="font-rubik font-size-20">Information</h4>
                    <div class="d-flex flex-column flex-wrap">
                        <a href="#" class="font-rale font-size-14 text-white-50 pb-1">About Us</a>
                        <a href="#" class="font-rale font-size-14 text-white-50 pb-1">Privacy Policy</a>
                        <a href="#" class="font-rale font-size-14 text-white-50 pb-1">Terms and Conditions</a>                 
                    </div>
                </div>
                <div class="col-lg-4 col-12">
                    <h4 class="font-rubik font-size-20">Account</h4>
                    <div class="d-flex flex-column flex-wrap">
                        <a href=<?php if(isset($_SESSION['user_id'])) echo "my-account.php"; else echo "register/login.php"; ?> class="font-rale font-size-14 text-white-50 pb-1">My Account</a>
                        <a href="<?php if(isset($_SESSION['user_id'])) echo "admin_panel/user-orders.php"; else echo "register/login.php"; ?>" class="font-rale font-size-14 text-white-50 pb-1">Order History</a>
                        <a href="<?php if(isset($_SESSION['user_id'])) echo "WishList.php"; else echo "register/login.php"; ?>" class="font-rale font-size-14 text-white-50 pb-1">Wishlist</a>                 
                    </div>
                </div>
            </div>
        </div>
            
    </footer>
    <!-- !start #footer -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

    <!-- Owl Carousel JS File-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Isotope plugin CDN-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.isotope/3.0.6/isotope.pkgd.min.js" integrity="sha512-Zq2BOxyhvnRFXu0+WE6ojpZLOU2jdnqbrM1hmVdGzyeCa1DgM3X5Q4A/Is9xA1IkbUeDd7755dNNI/PzSf2Pew==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- !Isotope plugin CDN-->

    <!-- Custom JavaScript-->
    <script src="index.js"></script>
</body>
</html>