<?php
session_start();
    //register_header.php
    include('register_header.php');
    include('helper.php');
    include('mysqli_connect.php');
?>
<?php
    
    $user=array();
    if(isset($_SESSION['user_id'])){
        $user=get_user_info($con,$_SESSION['user_id']);
    }
    if($_SERVER['REQUEST_METHOD']=='POST'){
        require('login-process.php');
    }   
    //require('mysqli_connect.php');
?>
<!-- registration area -->
    <section id="login-form">
        <div class="row m-0">
            <div class="col-lg-8 offset-lg-2">
                <div class="text-center pb-5">
                <h1 class="login-title text-dark">Login</h1>
                <p class="p-1 m-0 font-ubuntu text-black-50">Login and enjoy additional features</p>
                <span class="font-ubuntu text-black-50">New customer? <a href="register.php"  style="text-decoration:none;">Register here!</a></span>
                </div>
                <div class="upload-profile-image d-flex justify-content-center pb-5">
                    <div class="text-center">
                    <img src="<?php echo isset($user['profileImage']) ? $user['profileImage']: '../assets/profile-pictures/profile/beard.png'; ?> " style="width:200px;height:200px;" class="img rounded-circle" alt="profile">
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    <form action="login.php" method="post" enctype="multipart/form-data" id="log-form">
                        <div class="form-row my-3">
                            <div class="col">
                                <input type="email" required name="email" id="email" style="width:100%" class="form-control" placeholder="Email*">
                                <small id="email_error" class="text-danger"></small>
                            </div>
                        </div>
                        <div class="form-row my-3">
                            <div class="col">
                                <input type="password" required name="password" id="password" style="width:100%" class="form-control" placeholder="Password*">
                            </div>
                        </div>
                        <div class="submit-btn text-center my-5">
                            <button type="submit" class="btn-warning rounded-pill text-dark px-5">Login</button>
                        </div>
                        <span class="font-ubuntu text-black-50">Forgot Password? <a href="forgot-password.php" style="text-decoration:none;">Click here!</a></span>
                    </form>
                </div>
            </div>
        </div>
    </section>
<!-- registration area -->
<?php
    //register_header.php
    include('register_footer.php');
?>
