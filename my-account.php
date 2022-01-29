<?php
ob_start();
include('header.php');

$user=array();
if(isset($_SESSION['user_id'])){
    $user=get_user_info($con,$_SESSION['user_id']); 
}
if(isset($user['profileImage'])){
    $string=substr($user['profileImage'],-(strlen($user['profileImage'])-3));
}
$confirmError=null;
if($_SERVER['REQUEST_METHOD']=='POST'){
    $error=array();
    
    $password=validate_input_text($_POST['currentPassword']);
    if(empty($password))
    {
        $error[]="You forgot to enter your curent password";
    }
    $new_pwd=validate_input_text($_POST['newPassword']);
    if(empty($new_pwd))
    {
        $error[]="You forgot to enter your new password";
    }
    $confirm_pwd=validate_input_text($_POST['confirmPassword']);
    if(empty($confirm_pwd))
    {
        $error[]="You forgot to enter your confirmed new password";
    }
    if(!password_verify($password,$user['password'])){
        $confirmError="The current password you entered is not corect!";
    }
    if($new_pwd!=$confirm_pwd){
        $confirmError="Passwords did not match!";
    }
    if(empty($error) && empty($confirmError)){
        //update the user with the new password
        $hashed_pass=password_hash($new_pwd,PASSWORD_DEFAULT);
        //make a query
        $query="UPDATE user SET password = ? WHERE user_id = ?";
        //initialize statement
        $q=mysqli_stmt_init($con);
    
        //prepare sql statement
        mysqli_stmt_prepare($q,$query);
    
        //bind values
        mysqli_stmt_bind_param($q,'si',$hashed_pass,$_SESSION['user_id']);
    
        //execute statement
        mysqli_stmt_execute($q);
    
        if(mysqli_stmt_affected_rows($q)==1)
        {
            header('location:my-account.php');
            exit(); 
        }
        else
        {
            print "Error while changing the password! Please try again!";
        }
        $confirmError=null;
    }
    else{
        foreach($error as $item):
            echo $item;
        endforeach;
    } 
}

?>

<section id="#main" style="padding-bottom:165px">
    <div class="container py-5">
        <div class="row">
            <div class="col-4 offset-4 py-4">
                <div class="upload-profile-image d-flex justify-content-center pb-5">
                  <div class="text-center">
                  <img class="img rounded-circle" style="width:200px;height:200px" src="<?php echo isset($user['profileImage']) ? $string : 'assets/profile-pictures/profile/beard.png'; ?>" alt="">
                    <h4 class="py-3">
                        <?php 
                            if(isset($user['first_name'])){
                                printf('%s %s',$user['first_name'],$user['last_name']); 
                            }
                        ?>
                    </h4>
                  </div>
                </div>
                <div class="user-info px-3">
                    <ul class="font-ubuntu navbar-nav" >
                        <li class="nav-link" style="color:black;"><b>First name:<b> <span style="font-weight:normal;"><?php echo isset($user['first_name']) ? $user['first_name'] : ''; ?></span></li>
                        <li class="nav-link" style="color:black;"><b>Last name: </b><span style="font-weight:normal;"><?php echo isset($user['last_name']) ? $user['last_name'] : ''; ?></span></li>
                        <li class="nav-link" style="color:black;"><b>E-mail: </b><span style="font-weight:normal;"><?php echo isset($user['email']) ? $user['email'] : ''; ?></span></li>
                    </ul>
                </div>

            </div>
        </div>
        <hr>
        <div class="d-flex justify-content-center">
            <div class="text-center">
                <h1 class="text-dark" style="font-size:20px">Change Password</h1>
                    <form action="my-account.php" method="post" id="changePasswordForm">
                    <div class="form-row my-3">
                            <div class="col">
                                <input type="password" required name="currentPassword" id="currentPassword" style="width:100%" class="form-control" placeholder="Curent Password*" autocomplete="off">
                            </div>
                    </div>
                    <div class="form-row my-3">
                            <div class="col">
                                <input type="password" required name="newPassword" id="newPassword" style="width:100%" class="form-control" placeholder="New Password*" autocomplete="off">
                            </div>
                    </div>
                    <div class="form-row my-3">
                            <div class="col">
                                <input type="password" required name="confirmPassword" id="confirmPassword" style="width:100%" class="form-control" placeholder="Confirm New Password*" autocomplete="off">
                                <small id="confirmError" class="text-danger"><?php echo $confirmError;?></small>
                            </div>
                    </div>
                    <div class="submit-btn text-center my-5">
                            <button type="submit" class="btn-warning rounded-pill text-dark px-5">Submit</button>
                    </div>
                    </form>
            </div>
        </div>
    </div>
</section>
<?php
include("footer.php");
?>