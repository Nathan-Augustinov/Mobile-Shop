<?php
    //register_header.php
    include('register_header.php');
?>

<?php
    if($_SERVER['REQUEST_METHOD']=='POST'){
        require('register_process.php');
    }
?>
<!-- registration area -->
    <section id="register">
        <div class="row m-0">
            <div class="col-lg-8 offset-lg-2">
                <div class="text-center pb-5">
                <h1 class="login-title text-dark">Registration</h1>
                <p class="p-1 m-0 font-ubuntu text-black-50">Register and enjoy additional features</p>
                <span class="font-ubuntu text-black-50">I already have an account <a href="login.php"  style="text-decoration:none;">Login</a></span>
                </div>
                <div class="upload-profile-image d-flex justify-content-center pb-5">
                    <div class="text-center">
                        <div class="d-flex justify-content-center">
                            <img class="camera-icon" style="height:150px" src="../assets/profile-pictures/camera-solid.svg" alt="camera">
                        </div>
                        <img src="../assets/profile-pictures/profile/beard.png" style="width:200px;height:200px;" class="img rounded-circle" alt="profile">
                        <small class="form-text text-black-50"><figcaption>Choose Image</figcaption></small>
                        <input type="file" form="reg-form" class="form-control-file" name="profileUpload" id="upload-profile">
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    <form action="register.php" method="post" enctype="multipart/form-data" id="reg-form">
                        <div class="form-row">
                            <div class="col">
                                <input type="text" value="<?php if(isset($_POST['firstName'])) echo $_POST['firstName']; ?>" name="firstName" id="firstName" style="width:100%" class="form-control " placeholder="First Name">
                            </div>
                        </div>
                        <div class="form-row my-3">
                            <div class="col">
                                <input type="text" value="<?php if(isset($_POST['lastName'])) echo $_POST['lastName']; ?>" name="lastName" id="lastName" style="width:100%" class="form-control" placeholder="Last Name">
                            </div>
                        </div>
                        <div class="form-row my-3">
                            <div class="col">
                                <input type="email" value="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>" required name="email" id="email" style="width:100%" class="form-control" placeholder="Email*">
                                <small id="email_error" class="text-danger"></small>
                            </div>
                        </div>
                        <div class="form-row my-3">
                            <div class="col">
                                <input type="password" required name="password" id="password" style="width:100%" class="form-control" placeholder="Password*" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-row my-3">
                            <div class="col">
                                <input type="password" required name="confirm_pwd" id="confirm_pwd" style="width:100%" class="form-control" placeholder="Confirm Password*" autocomplete="off">
                                <small id="confirm_error" class="text-danger"></small>
                            </div>
                        </div>
                        <div class="form-check form-check-inline">
                            <input type="checkbox" name="agreement" class="form-check-input" required>
                            <label for="agreement" class="form-check-label font-ubuntu text-black-50">I agree with the <a style="text-decoration:none" href="#">terms,conditions and policies.</a>(*)</label>
                        </div>
                        <div class="submit-btn text-center my-5">
                            <button type="submit" class="btn-warning rounded-pill text-dark px-5">Register</button>
                        </div>
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
