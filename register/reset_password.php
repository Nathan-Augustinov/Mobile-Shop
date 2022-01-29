<?php
session_start();
    //register_header.php
    include('register_header.php');
    include('helper.php');
    include('mysqli_connect.php');
?>
<?php
    $user=array();
    $error=array();
    if(isset($_SESSION['user_id'])){
        $user=get_user_info($con,$_SESSION['user_id']);
    }
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $password=validate_input_text($_POST['password']);
        if(empty($password))
        {
            $error[]="You forgot to enter your password";
        }
        $confirm_password=validate_input_text($_POST['confirm_password']);
        if(empty($confirm_password))
        {
            $error[]="You forgot to confirm your password";
        }
        if(empty($error)){
            if($password!=$confirm_password){
                $error[]="The passwords you entered did not match";
            }
            else{
                $hashed_pass=password_hash($password,PASSWORD_DEFAULT);
                $user_id=$_GET['user'];
                print_r($user_id);
                $db = mysqli_connect('localhost', 'root', '', 'mobileshop');
                mysqli_query($db, "UPDATE user SET password='$hashed_pass' WHERE user_id='$user_id'");
                header("location: login.php");
            }
        }
        
    }   
?>
<!-- registration area -->
    <section id="login-form">
        <div class="row m-0">
            <div class="col-lg-8 offset-lg-2">
                <div class="text-center pb-5">
                <h1 class="login-title text-dark">Reset your password</h1>
            </div>
                <div class="d-flex justify-content-center">
                    <form action="" method="post" enctype="multipart/form-data" id="log-form">
                        <div class="form-row my-3">
                            <div class="col">
                                <input type="password" required name="password" id="password" style="width:100%" class="form-control" placeholder="Password*">
                            </div>
                        </div>
                        <div class="form-row my-3">
                            <div class="col">
                                <input type="password" required name="confirm_password" id="confirm_password" style="width:100%" class="form-control" placeholder="Confirm Password*">
                                <small id="confirm_error" class="text-danger"></small>
                            </div>
                        </div>
                        <div class="submit-btn text-center my-5">
                            <button type="submit" class="btn-warning rounded-pill text-dark px-5">Reset the password</button>
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
